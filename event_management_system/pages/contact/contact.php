<?php
// contact.php — Beautiful Contact Page (PHP + Bootstrap 5)
// Assumes you have a mysqli $conn in config.php and a table `communication`
// communication(id INT PK AI, name VARCHAR(120), email VARCHAR(120), phone VARCHAR(30), subject VARCHAR(150), message TEXT, created_at DATETIME, status ENUM('new','read') DEFAULT 'new')

session_start();
require_once __DIR__ . '/config.php';

// ---- CSRF TOKEN ----
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// ---- FORM HANDLER ----
$alert = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic CSRF check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $alert = '<div class="alert alert-danger shadow-sm">Security check failed. Please reload the page and try again.</div>';
    } else {
        // Honeypot (invisible) anti-bot field
        if (!empty($_POST['website'])) {
            $alert = '<div class="alert alert-danger shadow-sm">Bot detected.</div>';
        } else {
            // Collect & sanitize
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            // Validate
            $errors = [];
            if ($name === '' || mb_strlen($name) < 2)
                $errors[] = 'Please enter your full name.';
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL))
                $errors[] = 'Please enter a valid email address.';
            if ($subject === '' || mb_strlen($subject) < 3)
                $errors[] = 'Subject must be at least 3 characters.';
            if ($message === '' || mb_strlen($message) < 10)
                $errors[] = 'Message must be at least 10 characters.';
            if ($phone !== '' && !preg_match('/^[0-9+\-()\s]{6,}$/', $phone))
                $errors[] = 'Please enter a valid phone number.';

            if ($errors) {
                $alert = '<div class="alert alert-warning"><ul class="mb-0">' . implode('', array_map(fn($e) => "<li>$e</li>", $errors)) . '</ul></div>';
            } else {
                // Insert into DB
                $stmt = $conn->prepare("INSERT INTO communication (name, email, phone, subject, message, created_at, status) VALUES (?,?,?,?,?,NOW(),'new')");
                if ($stmt) {
                    $stmt->bind_param('sssss', $name, $email, $phone, $subject, $message);
                    if ($stmt->execute()) {
                        $alert = '<div class="alert alert-success shadow-sm">✅ Thanks! Your message has been sent successfully.</div>';
                        // Reset form fields after success
                        $name = $email = $phone = $subject = $message = '';
                    } else {
                        $alert = '<div class="alert alert-danger">Database error: could not save your message.</div>';
                    }
                    $stmt->close();
                } else {
                    $alert = '<div class="alert alert-danger">Database error: prepare failed.</div>';
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us — EventEase</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --brand: #6366f1;
            /* indigo-500 */
            --brand-2: #a78bfa;
            /* violet-400 */
        }

        body {
            background: radial-gradient(1200px 600px at 10% 10%, rgba(99, 102, 241, .15), transparent),
                radial-gradient(1000px 500px at 90% 20%, rgba(167, 139, 250, .14), transparent),
                linear-gradient(180deg, #f8fafc, #f1f5f9);
        }

        .glass {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, .6);
            border: 1px solid rgba(255, 255, 255, .6);
            box-shadow: 0 20px 40px rgba(2, 6, 23, .08);
            border-radius: 1.25rem;
        }

        .hero {
            position: relative;
            padding: 6rem 0 3rem;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(800px 200px at 50% -10%, rgba(99, 102, 241, .15), transparent);
            z-index: -1;
        }

        .badge-soft {
            background: rgba(99, 102, 241, .12);
            color: #4338ca;
        }

        .form-control,
        .form-select {
            border-radius: .9rem;
        }

        .shadow-soft {
            box-shadow: 0 14px 30px rgba(2, 6, 23, .08);
        }

        .btn-brand {
            background: linear-gradient(90deg, var(--brand), var(--brand-2));
            border: 0;
        }

        .btn-brand:hover {
            filter: brightness(.95);
        }

        .map-card iframe {
            border: 0;
            width: 100%;
            height: 100%;
            min-height: 320px;
            border-radius: 1rem;
        }
    </style>
</head>

<body>

    <header class="hero text-center">
        <div class="container">
            <span class="badge rounded-pill badge-soft px-3 py-2">We'd love to hear from you</span>
            <h1 class="display-5 fw-bold mt-3">Contact <span class="text-primary">EventEase</span></h1>
            <p class="lead text-secondary mb-0">Questions, bookings, or feedback — send us a message and we'll get back
                to you.</p>
            <p class="text-muted">প্রশ্ন বা বুকিং সংক্রান্ত যেকোনো সাহায্যের জন্য আমাদের সাথে যোগাযোগ করুন।</p>
        </div>
    </header>

    <main class="container pb-5">
        <div class="row g-4 align-items-stretch">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="glass p-4 p-md-5 h-100">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-envelope-paper-fill fs-3 text-primary"></i>
                        <h2 class="h4 mb-0">Send us a message</h2>
                    </div>
                    <?php if ($alert)
                        echo $alert; ?>
                    <form method="post" class="needs-validation" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                        <!-- Honeypot -->
                        <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Your name" value="<?= htmlspecialchars($name ?? '') ?>" required>
                                    <label for="name">Full Name / নাম</label>
                                    <div class="invalid-feedback">Please enter your name.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="name@example.com" value="<?= htmlspecialchars($email ?? '') ?>"
                                        required>
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback">Please enter a valid email.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
                                        value="<?= htmlspecialchars($phone ?? '') ?>">
                                    <label for="phone">Phone / মোবাইল</label>
                                    <div class="invalid-feedback">Please enter a valid phone number.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        placeholder="Subject" value="<?= htmlspecialchars($subject ?? '') ?>" required>
                                    <label for="subject">Subject / বিষয়</label>
                                    <div class="invalid-feedback">Subject is required.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message"
                                        name="message" style="height: 160px"
                                        required><?= htmlspecialchars($message ?? '') ?></textarea>
                                    <label for="message">Your Message / বার্তা</label>
                                    <div class="invalid-feedback">Please write at least a few words.</div>
                                </div>
                            </div>
                            <div class="col-12 d-grid d-sm-flex gap-2">
                                <button class="btn btn-brand text-white px-4 py-2 shadow-soft" type="submit"><i
                                        class="bi bi-send-fill me-2"></i>Send Message</button>
                                <button class="btn btn-outline-secondary px-4 py-2" type="reset"><i
                                        class="bi bi-arrow-counterclockwise me-2"></i>Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Info + Map -->
            <div class="col-lg-5">
                <div class="d-flex flex-column h-100 gap-4">
                    <div class="glass p-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-geo-alt-fill fs-4 text-danger"></i>
                            <h3 class="h5 mb-0">Visit our office</h3>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="p-3 rounded border bg-white">
                                    <div class="fw-semibold">EventEase HQ</div>
                                    <div class="text-muted">Road 10, Banani, Dhaka, Bangladesh</div>
                                    <div class="small text-muted">Sun–Thu, 10:00 AM – 6:00 PM</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="p-3 rounded border bg-white d-flex align-items-center gap-3">
                                            <i class="bi bi-telephone-inbound-fill fs-5 text-primary"></i>
                                            <div>
                                                <div class="small text-muted">Call us</div>
                                                <a href="tel:+8801700000000"
                                                    class="fw-semibold text-decoration-none">+880 1700-000000</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 rounded border bg-white d-flex align-items-center gap-3">
                                            <i class="bi bi-envelope-plus-fill fs-5 text-primary"></i>
                                            <div>
                                                <div class="small text-muted">Email</div>
                                                <a href="mailto:support@eventease.com"
                                                    class="fw-semibold text-decoration-none">support@eventease.com</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 rounded border bg-white d-flex align-items-center gap-3">
                                            <i class="bi bi-share fs-5 text-primary"></i>
                                            <div>
                                                <div class="small text-muted">Follow</div>
                                                <div class="d-flex gap-3">
                                                    <a class="text-decoration-none" href="#" aria-label="Facebook"><i
                                                            class="bi bi-facebook"></i></a>
                                                    <a class="text-decoration-none" href="#" aria-label="Instagram"><i
                                                            class="bi bi-instagram"></i></a>
                                                    <a class="text-decoration-none" href="#" aria-label="X / Twitter"><i
                                                            class="bi bi-twitter-x"></i></a>
                                                    <a class="text-decoration-none" href="#" aria-label="YouTube"><i
                                                            class="bi bi-youtube"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass p-2 map-card flex-grow-1">
                        <!-- Replace src with your actual map or venue location -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.588847589131!2d90.4031033!3d23.7979141!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c71ea17e7fed%3A0x5f14f9d6e88709b9!2sBanani!5e0!3m2!1sen!2sbd!4v1696080000000"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ -->
        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="glass p-4 p-md-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-question-circle-fill fs-3 text-warning"></i>
                        <h2 class="h5 mb-0">Frequently Asked Questions</h2>
                    </div>
                    <div class="accordion" id="faq">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="q1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a1" aria-expanded="true" aria-controls="a1">
                                    How soon will you reply to my message?
                                </button>
                            </h2>
                            <div id="a1" class="accordion-collapse collapse show" aria-labelledby="q1"
                                data-bs-parent="#faq">
                                <div class="accordion-body">We usually respond within 24 business hours.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="q2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a2" aria-expanded="false" aria-controls="a2">
                                    Do you offer on-site event visits before booking?
                                </button>
                            </h2>
                            <div id="a2" class="accordion-collapse collapse" aria-labelledby="q2" data-bs-parent="#faq">
                                <div class="accordion-body">Yes, our team can schedule a venue walkthrough upon request.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="q3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#a3" aria-expanded="false" aria-controls="a3">
                                    Can you customize packages for birthdays/weddings/corporate?
                                </button>
                            </h2>
                            <div id="a3" class="accordion-collapse collapse" aria-labelledby="q3" data-bs-parent="#faq">
                                <div class="accordion-body">Absolutely. Share your requirements and we’ll tailor a
                                    package within your budget.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-4 text-center text-muted small">
        <div class="container">© <?php echo date('Y'); ?> EventEase — All rights reserved.</div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Client-side form validation (Bootstrap)
        (() => {
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>