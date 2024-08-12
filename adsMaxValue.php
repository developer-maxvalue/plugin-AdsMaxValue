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
define('MY_WEBHOOK_SECRET_KEY', 'SaYoWRY6B9uIgL3QJNBkLw5wiEodXzm7');

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
    add_menu_page('Ad MaxValue', 'Ad MaxValue', 'manage_options', 'aap-dashboard', 'AAP_Controller::dashboard', 'dashicons-welcome-widgets-menus');
    add_submenu_page('aap-dashboard', 'Manage Zones', 'Zones', 'manage_options', 'aap-zones', 'AAP_Controller::zones');
    add_submenu_page('aap-dashboard', 'Reports', 'Reports', 'manage_options', 'aap-reports', 'AAP_Controller::reports');
    add_submenu_page('aap-dashboard', 'Wallets', 'Wallets', 'manage_options', 'aap-wallets', 'AAP_Controller::wallets');
    add_submenu_page('aap-dashboard', 'Ads.txt', 'Ads.txt', 'manage_options', 'aap-adstxt', 'AAP_Controller::adsTxt');
    add_submenu_page('aap-dashboard', 'Referral', 'Referral', 'manage_options', 'aap-referral', 'AAP_Controller::referral');
    add_submenu_page('aap-dashboard', 'Logins', 'Login', 'manage_options', 'aap-login', 'AAP_Controller::login');
    add_submenu_page('aap-dashboard', 'Logout', 'Logout', 'manage_options', 'aap-logout', 'AAP_Controller::logout');
}

function register_webhook()
{
    add_action('rest_api_init', function () {
        register_rest_route('mv', '/webhook', array(
            'methods' => 'POST',
            'callback' => 'handle_my_webhook',
            'permission_callback' => '__return_true',
        ));
    });
}

function handle_my_webhook(WP_REST_Request $request)
{
    $type = $request->get_param('type');
    $secretKey = $request->get_param('secretKey');
    if (!empty($secretKey))
    {
        if (!empty($type))
        {
            switch ($type){
                case 'ADS.TXT':
                    $content = $request->get_param('content');
                    if (empty($content)) {
                        return new WP_REST_Response('Content is required.', 400);
                    }
                    return addAdsTxt($content);
                default:
                    break;
            }
        }
    }
}

function addAdsTxt($content)
{
    $file_path = ABSPATH . 'ads.txt';
    if (file_put_contents($file_path, $content) !== false) {
        return new WP_REST_Response('ads.txt created successfully.', 200);
    } else {
        return new WP_REST_Response('Failed to create ads.txt.', 500);
    }
}

add_action('admin_menu', 'aap_admin_menu');
add_action('init', 'register_webhook');

// Tải các file CSS và JS cần thiết
function aap_enqueue_assets() {
    wp_enqueue_style('aap-admin-css', AAP_PLUGIN_URL . 'assets/css/admin.css');
    wp_enqueue_script('aap-admin-js', AAP_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), null, true);
}

function update_send_mail() {
    check_ajax_referer('update_send_mail_nonce', 'nonce');

    $send_mail = isset($_POST['sendMail']) ? intval($_POST['sendMail']) : 0;

    $user_id = get_current_user_id();
    update_user_meta($user_id, 'send_mail', $send_mail);

    wp_send_json_success(array('message' => 'Send mail status updated successfully.'));
}

add_action('admin_enqueue_scripts', 'aap_enqueue_assets');
add_action('wp_ajax_update_send_mail', 'update_send_mail');
add_action('wp_ajax_nopriv_update_send_mail', 'update_send_mail');
