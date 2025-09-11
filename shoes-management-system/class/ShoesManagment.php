<?php

class ShoesManagement
{

    private $message = "";

    public function __construct()
    {

        // Add Menu
        add_action("admin_menu", array($this, "addSMSMenus"));

        // Add Plugin Scripts
        add_action("admin_enqueue_scripts", array($this, "addSMSPluginScripts"));
    }

    // Setup Menus and Submenus
    public function addSMSMenus()
    {

        add_menu_page("Shoes Management System", "Shoes System", "manage_options", "shoes-system", array($this, "smsAddShoeHandler"), "dashicons-format-image", 14);

        add_submenu_page("shoes-system", "Add Shoe Page", "Add Shoe", "manage_options", "shoes-system", array($this, "smsAddShoeHandler"));

        add_submenu_page("shoes-system", "List Shoes Page", "List Shoes", "manage_options", "list-shoes", array($this, "smsListShoesHandler"));
    }

    public function addShoesSystemHandler()
    {

        echo "This is a sample message";
    }

    public function smsAddShoeHandler()
    {

        $this->saveShoeData();

        $response = $this->message;

        //echo "<h3 class='sms-h3'>This is Add Shoe Page</h3>";
        ob_start(); // PHP Buffer Start
        include_once SMS_PLUGIN_PATH . 'pages/add-shoe.php'; // Read Content
        $content = ob_get_contents(); // Content stored in variable
        ob_end_clean(); // Buffer clean

        echo $content; // Content print
    }

    private function saveShoeData()
    {

        global $wpdb;

        $tablePrefix = $wpdb->prefix; // wp_

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST['btn_form_submit'])) {

            // Sanitize
            $shoe_name = sanitize_text_field($_REQUEST['shoe_name']);
            $shoe_author = sanitize_text_field($_REQUEST['author_name']);
            $shoe_price = sanitize_text_field($_REQUEST['shoe_price']);
            $shoe_image = sanitize_text_field($_REQUEST['cover_image']);

            // Insert data
            $wpdb->insert("{$tablePrefix}shoes_system", [
                "name" => $shoe_name,
                "author" => $shoe_author,
                "shoe_price" => $shoe_price,
                "profile_image" => $shoe_image
            ]);

            $shoe_id = $wpdb->insert_id;

            if ($shoe_id > 0) {

                $this->message = "Successfully, shoe has been created";
            } else {

                $this->message = "Failed to create shoe";
            }
        }
    }

    public function smsListShoesHandler()
    {

        //echo "<h3 class='sms-h3'>This is List Shoe Page</h3>";

        ob_start();

        include_once SMS_PLUGIN_PATH . 'pages/list-shoe.php';
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;

    }

    // Create table structure
    public function smsCreateTable()
    {

        global $wpdb;

        $table_prefix = $wpdb->prefix; // wp_, tbl_

        $tableSql = 'CREATE TABLE `' . $table_prefix . 'shoes_system` (
      `id` int NOT NULL AUTO_INCREMENT,
      `name` varchar(120) NOT NULL,
      `author` varchar(120) NOT NULL,
      `profile_image` text,
      `shoe_price` int DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';

        include_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta($tableSql);
    }

    // Drop Table
    public function smsDropTable()
    {

        global $wpdb;

        $tablePrefix = $wpdb->prefix; // wp_, tbl_

        $tableDropMySQL = "DROP TABLE IF EXISTS {$tablePrefix}shoes_system";

        $wpdb->query($tableDropMySQL);
    }

    // Add Plugin Scripts
    public function addSMSPluginScripts()
    {

        // CSS
        wp_enqueue_style("sms-style", SMS_PLUGIN_URL . 'assets/css/style.css', array(), "1.0", "all");

        // JS
        wp_enqueue_media();
        wp_enqueue_script("sms-validation", SMS_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array("jquery"), "1.0");
        wp_enqueue_script("sms-script", SMS_PLUGIN_URL . 'assets/js/script.js', array("jquery"), "1.0");
    }
}