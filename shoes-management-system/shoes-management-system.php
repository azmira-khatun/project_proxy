<?php

/*
 * Plugin name: Shoes Management System
 * Plugin URI: https://example.com/shoes-management-system
 * Description: This is a plugin to Manage all Shoes.
 * Author: Farhana
 * Author URI: https://techfarhana.com/
 * Version: 1.0
 * Requires PHP: 7.2
 * Requires at least: 6.2
 */

// Constants
define("SMS_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("SMS_PLUGIN_URL", plugin_dir_url(__FILE__));
define("SMS_PLUGIN_BASENMAE", plugin_basename(__FILE__));

include_once SMS_PLUGIN_PATH . 'class/ShoesManagment.php';

$shoesManagementObject = new ShoesManagement();

register_activation_hook(__FILE__, array($shoesManagementObject, "smsCreateTable"));

register_deactivation_hook(__FILE__, array($shoesManagementObject, "smsDropTable"));