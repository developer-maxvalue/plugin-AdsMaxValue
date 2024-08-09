<?php
/*
Plugin Name: Ads Max Value Plugin
Plugin URI: https://maxvalue.media
Description: Tools adsMaxValue.media
Version: 1.0
Author: MaxValue.Media
Author URI: https://maxvalue.media
License: GPL2
*/

// Đảm bảo không ai trực tiếp truy cập vào file PHP
if ( !defined( 'ABSPATH' ) ) exit;

// Định nghĩa các hằng số
define( 'AAP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AAP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
require_once plugin_dir_path(__FILE__) . 'includes/controllers/controller.php';
require_once plugin_dir_path(__FILE__) . 'includes/models/zones.php';
require_once plugin_dir_path(__FILE__) . 'includes/models/users.php';

// Tự động tải các file cần thiết
function aap_autoload($class_name) {
    if (false !== strpos($class_name, 'AAP_')) {
        $class_name = strtolower(str_replace('_', '-', $class_name));
        $file = AAP_PLUGIN_DIR . 'includes/controllers/' . $class_name . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
}
spl_autoload_register('aap_autoload');

// Kích hoạt plugin
function aap_activate() {
    AAP_Controller::create_tables();
}
register_activation_hook(__FILE__, 'aap_activate');

// Xóa bảng cơ sở dữ liệu khi plugin bị xóa
function aap_uninstall() {
    AAP_Controller::drop_tables();
}
register_uninstall_hook(__FILE__, 'aap_uninstall');

// Tạo các mục menu trong admin
function aap_admin_menu() {
    add_menu_page('AdMaxValue Media', 'Ad MaxValue', 'manage_options', 'aap-dashboard', 'AAP_Controller::dashboard', 'dashicons-admin-generic');
    add_submenu_page('aap-dashboard', 'Manage Zones', 'Zones', 'manage_options', 'aap-zones', 'AAP_Controller::zones');
    add_submenu_page('aap-dashboard', 'Reports', 'Reports', 'manage_options', 'aap-reports', 'AAP_Controller::reports');
    add_submenu_page('aap-dashboard', 'Wallets', 'Wallets', 'manage_options', 'aap-wallets', 'AAP_Controller::wallets');
    add_submenu_page('aap-dashboard', 'Logins', 'Login', 'manage_options', 'aap-login', 'AAP_Controller::login');
}
add_action('admin_menu', 'aap_admin_menu');

// Tải các file CSS và JS cần thiết
function aap_enqueue_assets() {
    wp_enqueue_style('aap-admin-css', AAP_PLUGIN_URL . 'assets/css/admin.css');
    wp_enqueue_script('aap-admin-js', AAP_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'aap_enqueue_assets');
