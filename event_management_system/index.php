<?php
// Start a new session at the very beginning of the script.
session_start();

// Include the database configuration file.
include("config.php");

// Redirect to login page if the database connection object is not set.
// This is a basic check to ensure the user is logged in or the connection is valid.
if (!isset($conn)) {
    header("location:login.php");
    exit();
}

// Initialize the shopping cart session variable if it doesn't already exist.
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// --- Handle User Actions: Add to Cart, Remove from Cart ---

// Handle the "add to cart" action initiated by a GET request.
if (isset($_GET['add_to_cart'])) {
    $event_id = intval($_GET['add_to_cart']);

    // Check if the event ID is already in the cart to prevent adding duplicates.
    if (!in_array($event_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $event_id;
    }

    // Redirect to the same page after adding to cart to prevent form resubmission on page refresh.
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle the "remove from cart" action.
if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);

    // Find the event in the cart array and remove it.
    if (($key = array_search($remove_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }

    // Redirect back to the same page to prevent resubmission.
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// --- Database Queries to Fetch Events ---

// Fetch all upcoming events from the database to display on the main page.
$events = $conn->query("
    SELECT e.id, e.event_name, e.type, e.date, v.name AS venue_name, e.image
    FROM event e
    JOIN venue v ON e.venue_id = v.id
    ORDER BY e.id DESC
");

// Fetch the events that are currently in the cart for the sidebar display.
$events_in_cart = [];
if (!empty($_SESSION['cart'])) {
    // Convert the cart array into a comma-separated string for the SQL IN clause.
    $ids = implode(',', array_map('intval', $_SESSION['cart']));

    // Use a prepared statement to securely fetch cart items.
    $sql = "
        SELECT e.id, e.event_name, e.date, v.name AS venue_name, e.image 
        FROM event e 
        JOIN venue v ON e.venue_id = v.id 
        WHERE e.id IN ($ids)
    ";

    $result = $conn->query($sql);
    if ($result) {
        $events_in_cart = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daily Event - Your Event Management Partner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="antialiased text-gray-800">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-gray-900">Daily Event</a>

            <ul class="hidden md:flex space-x-8 text-gray-600 font-medium items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- <li><a href="my_account.php"
                            class="hover:text-indigo-600 transition duration-300 font-bold text-black">My Account</a></li> -->
                    <li><a href="logout.php"
                            class="hover:text-indigo-600 transition duration-300 font-bold text-black">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php"
                            class="hover:text-indigo-600 transition duration-300 font-bold text-black">Login</a></li>
                    <li><a href="registration.php"
                            class="hover:text-indigo-600 transition duration-300 font-bold text-black">Registration</a></li>
                <?php endif; ?>
                <li>
                    <button id="toggleCart" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Cart (<?= count($_SESSION['cart']) ?>)
                    </button>
                </li>
            </ul>

            <div class="md:hidden flex items-center">
                <button id="toggleCartMobile" class="px-4 py-2 bg-blue-600 text-white rounded-lg mr-2">
                    Cart (<?= count($_SESSION['cart']) ?>)
                </button>
                <button id="mobile-menu-btn" class="text-gray-600 hover:text-indigo-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>

        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg border-t border-gray-200">
            <ul class="flex flex-col p-4 space-y-2 text-gray-600 font-medium">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="my_account.php" class="block p-2 hover:bg-gray-100 rounded-md">My Account</a></li>
                    <li><a href="logout.php" class="block p-2 hover:bg-gray-100 rounded-md">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="block p-2 hover:bg-gray-100 rounded-md">Login</a></li>
                    <li><a href="registration.php" class="block p-2 hover:bg-gray-100 rounded-md">Registration</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>

    <div id="cartSection"
        class="fixed inset-y-0 right-0 w-80 bg-gray-900 text-white p-6 shadow-xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Your Cart</h2>
            <button id="closeCart" class="text-gray-400 hover:text-white">&times;</button>
        </div>
        <div class="space-y-4">
            <?php if (empty($events_in_cart)): ?>
                <p class="text-gray-400">Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($events_in_cart as $event): ?>
                    <div class="flex items-center space-x-4 bg-gray-800 p-3 rounded-lg">
                        <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['event_name']) ?>"
                            class="w-16 h-16 rounded object-cover">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg"><?= htmlspecialchars($event['event_name']) ?></h3>
                            <p class="text-sm text-gray-400"><?= htmlspecialchars($event['date']) ?> |
                                <?= htmlspecialchars($event['venue_name']) ?>
                            </p>
                        </div>
                        <a href="?remove=<?= $event['id'] ?>" class="text-red-400 hover:text-red-500 transition-colors">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="mt-8 pt-4 border-t border-gray-700">
            <a href="pages/bookingevent/checkout.php"
                class="block w-full text-center py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition duration-300">
                Proceed to Checkout
            </a>
        </div>
    </div>

    <section class="relative bg-cover bg-center h-screen" style="background-image: url('dist/image/home-view.jpg')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-4">
            <div>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">Plan. Promote. Manage.</h1>
                <p class="mt-4 text-lg md:text-xl font-light max-w-2xl mx-auto">
                    Everything you need to manage events seamlessly in one powerful and intuitive platform.
                </p>
                <a href="#events"
                    class="mt-8 inline-block px-8 py-3 bg-indigo-600 text-white font-bold rounded-full shadow-lg hover:bg-indigo-700 transition duration-300 transform hover:scale-105">
                    Explore Events
                </a>
            </div>
        </div>
    </section>

    <section id="features" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Why Choose Daily Event?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-[url('uploads/images (1).jpg')] bg-cover bg-center p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                    <div class="text-indigo-600 text-4xl mb-4"><i class="fas fa-edit"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Easy Event Setup</h3>
                    <p class="text-white">Create and publish your events in minutes with our intuitive dashboard.</p>
                </div>
                <div
                    class="bg-[url('image2.jpg')] bg-cover bg-center p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                    <div class="text-indigo-600 text-4xl mb-4"><i class="fas fa-credit-card"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Ticketing & Payments</h3>
                    <p class="text-white">Handle registrations and ticket sales with integrated payment options.</p>
                </div>
                <div
                    class="bg-[url('image3.jpg')] bg-cover bg-center p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                    <div class="text-indigo-600 text-4xl mb-4"><i class="fas fa-chart-line"></i></div>
                    <h3 class="text-xl font-semibold mb-2">Real-time Analytics</h3>
                    <p class="text-white">Track attendee data, revenue, and engagement in real-time.</p>
                </div>
            </div>
        </div>
    </section>



    <section id="events" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Upcoming Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php while ($row = $events->fetch_assoc()):
                    $is_in_cart = in_array($row['id'], $_SESSION['cart']);

                    // Fix for "Array to string conversion" warning.
                    // If the database query returns an array for some reason, implode it.
                    $display_date = is_array($row['date']) ? implode(", ", $row['date']) : $row['date'];
                    $display_venue = is_array($row['venue_name']) ? implode(", ", $row['venue_name']) : $row['venue_name'];
                    ?>
                    <div class="relative rounded-2xl overflow-hidden shadow-xl transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 bg-cover bg-center"
                        style="background-image: url('<?= htmlspecialchars($row['image']) ?>'); height:300px;">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                        <div class="relative p-6 text-white flex flex-col justify-end h-full">
                            <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($row['event_name']) ?></h3>
                            <p class="text-sm mb-4">
                                <i class="fas fa-calendar-alt mr-2"></i><?= htmlspecialchars($display_date) ?> |
                                <i class="fas fa-map-marker-alt mr-2"></i><?= htmlspecialchars($display_venue) ?>
                            </p>
                            <?php if ($is_in_cart): ?>
                                <button disabled
                                    class="inline-block px-4 py-2 text-sm font-medium rounded-full bg-gray-500 text-white cursor-not-allowed">Added
                                    to Cart</button>
                            <?php else: ?>
                                <a href="?add_to_cart=<?= $row['id'] ?>"
                                    class="inline-block px-4 py-2 text-sm font-medium rounded-full border border-white hover:bg-white hover:text-black transition duration-300">Book
                                    Now</a>
                            <?php endif; ?>
                            <a href="event_details.php?id=<?= $row['id'] ?>"
                                class="inline-block mt-2 px-4 py-2 text-sm font-medium rounded-full border border-white hover:bg-white hover:text-black transition duration-300">More
                                Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <section id="pricing" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">Simple, transparent pricing</h2>
            <p class="text-center text-gray-500 mb-12">Choose the plan that's right for you.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="bg-white p-8 rounded-2xl shadow-xl transition-shadow duration-300 hover:shadow-2xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Basic</h3>
                    <p class="text-gray-500">For small teams and side projects.</p>
                    <div class="my-6">
                        <span class="text-5xl font-extrabold">$29</span>
                        <span class="text-gray-500">/month</span>
                    </div>
                    <ul class="text-gray-600 space-y-3 mb-8">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>5 Events per month</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Basic Ticketing</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Email Support</li>
                        <li class="text-gray-400"><i class="fas fa-times text-red-400 mr-2"></i>Advanced Analytics</li>
                        <li class="text-gray-400"><i class="fas fa-times text-red-400 mr-2"></i>Dedicated Account
                            Manager</li>
                    </ul>
                    <a href="#"
                        class="block w-full text-center px-6 py-3 bg-gray-200 text-gray-800 font-bold rounded-full hover:bg-gray-300 transition duration-300">Choose
                        Plan</a>
                </div>
                <div
                    class="bg-indigo-600 p-10 rounded-2xl shadow-xl text-white transform scale-105 relative z-10 transition-all duration-300">
                    <span
                        class="absolute top-0 right-0 m-4 px-3 py-1 text-xs font-bold text-indigo-600 bg-white rounded-full">Most
                        Popular</span>
                    <h3 class="text-2xl font-bold mb-2">Pro</h3>
                    <p class="text-indigo-100">For growing businesses and event managers.</p>
                    <div class="my-6">
                        <span class="text-5xl font-extrabold">$99</span>
                        <span class="text-indigo-100">/month</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li><i class="fas fa-check mr-2"></i>Unlimited Events</li>
                        <li><i class="fas fa-check mr-2"></i>Customizable Ticketing</li>
                        <li><i class="fas fa-check mr-2"></i>Advanced Analytics</li>
                        <li><i class="fas fa-check mr-2"></i>Priority Support</li>
                        <li class="text-indigo-100"><i class="fas fa-times text-indigo-200 mr-2"></i>Dedicated Account
                            Manager</li>
                    </ul>
                    <a href="#"
                        class="block w-full text-center px-6 py-3 bg-white text-indigo-600 font-bold rounded-full hover:bg-gray-100 transition duration-300">Choose
                        Plan</a>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl transition-shadow duration-300 hover:shadow-2xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                    <p class="text-gray-500">For large organizations with complex needs.</p>
                    <div class="my-6">
                        <span class="text-5xl font-extrabold">$249</span>
                        <span class="text-gray-500">/month</span>
                    </div>
                    <ul class="text-gray-600 space-y-3 mb-8">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Unlimited Events</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Custom Ticketing & APIs</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Advanced Analytics</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Priority Support</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Dedicated Account Manager</li>
                    </ul>
                    <a href="#"
                        class="block w-full text-center px-6 py-3 bg-gray-200 text-gray-800 font-bold rounded-full hover:bg-gray-300 transition duration-300">Choose
                        Plan</a>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">What Our Customers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md">
                    <p class="text-gray-700 italic mb-4">"Daily Event completely transformed our event planning. The
                        analytics are a game-changer!"</p>
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://placehold.co/48x48/6b7280/FFFFFF?text=J"
                            alt="John Doe">
                        <div>
                            <p class="font-bold">John Doe</p>
                            <p class="text-sm text-gray-500">CEO, Tech Innovators</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-8 rounded-2xl shadow-md">
                    <p class="text-gray-700 italic mb-4">"The platform is so easy to use. We were able to set up our
                        conference in record time."</p>
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full mr-4" src="https://placehold.co/48x48/6b7280/FFFFFF?text=A"
                            alt="Jane Smith">
                        <div>
                            <p class="font-bold">Jane Smith</p>
                            <p class="text-sm text-gray-500">Event Manager, Creative Labs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-indigo-600 text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to simplify your events?</h2>
            <p class="text-lg mb-8">Join thousands of event managers who trust Daily Event to deliver exceptional
                experiences.</p>
            <a href="#"
                class="inline-block px-10 py-4 bg-white text-indigo-600 font-bold rounded-full shadow-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                Start Your Free Trial
            </a>
        </div>
    </section>

    <footer id="contact" class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 text-center md:text-left">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">Daily Event</h3>
                    <p class="text-sm">Your partner in seamless event management.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-3">Quick Links</h4>
                    <ul class="space-y-1">
                        <li><a href="#features" class="hover:text-white transition-colors duration-300">Features</a>
                        </li>
                        <li><a href="#events" class="hover:text-white transition-colors duration-300">Events</a></li>
                        <li><a href="#pricing" class="hover:text-white transition-colors duration-300">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white mb-3">Get in Touch</h4>
                    <p class="flex items-center justify-center md:justify-start mb-1"><i
                            class="fas fa-envelope mr-2 text-indigo-400"></i>support@dailyevent.com</p>
                    <p class="flex items-center justify-center md:justify-start"><i
                            class="fas fa-phone-alt mr-2 text-indigo-400"></i>+1 234 567 890</p>
                </div>
            </div>
            <hr class="border-gray-700 my-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; 2025 Daily Event. All rights reserved.</p>
                <div class="mt-4 md:mt-0 space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300"><i
                            class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Cart toggle functionality
        const toggleCart = document.getElementById('toggleCart');
        const toggleCartMobile = document.getElementById('toggleCartMobile');
        const cartSection = document.getElementById('cartSection');
        const closeCart = document.getElementById('closeCart');

        toggleCart.addEventListener('click', () => {
            cartSection.classList.toggle('translate-x-full');
        });

        toggleCartMobile.addEventListener('click', () => {
            cartSection.classList.toggle('translate-x-full');
        });

        closeCart.addEventListener('click', () => {
            cartSection.classList.add('translate-x-full');
        });
    </script>
</body>

</html>