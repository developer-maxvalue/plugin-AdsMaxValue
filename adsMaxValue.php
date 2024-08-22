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
define( 'AAP_MAXVALUE_URL', 'https://publisher.maxvalue.media');
define('MY_WEBHOOK_SECRET_KEY', 'SaYoWRY6B9uIgL3QJNBkLw5wiEodXzm7');

require_once plugin_dir_path(__FILE__) . 'includes/controllers/controller.php';
require_once plugin_dir_path(__FILE__) . 'includes/models/zones.php';
require_once plugin_dir_path(__FILE__) . 'includes/models/users.php';
require_once plugin_dir_path(__FILE__) . 'includes/models/adstxt.php';

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
    add_menu_page('Ad MaxValue', 'Ad MaxValue', 'manage_options', 'mv-dashboard', 'AAP_Controller::dashboard', 'dashicons-welcome-widgets-menus');
    add_submenu_page('mv-dashboard', 'Manage Zones', 'Zones', 'manage_options', 'mv-zones', 'AAP_Controller::zones');
    add_submenu_page('mv-dashboard', 'Reports', 'Reports', 'manage_options', 'mv-reports', 'AAP_Controller::reports');
    // add_submenu_page('mv-dashboard', 'Wallets', 'Wallets', 'manage_options', 'mv-wallets', 'AAP_Controller::wallets');
    add_submenu_page('mv-dashboard', 'Ads.txt', 'Ads.txt', 'manage_options', 'mv-adstxt', 'AAP_Controller::adsTxt');
    add_submenu_page('mv-dashboard', 'Referral', 'Referral', 'manage_options', 'mv-referral', 'AAP_Controller::referral');
    add_submenu_page('mv-dashboard', 'Logout', 'Logout', 'manage_options', 'mv-logout', 'AAP_Controller::logout');
}

function register_webhook()
{
    if (isset($_SERVER['REQUEST_URI']) && '/ads.txt' == $_SERVER['REQUEST_URI']) {
        header('Content-Type: text/plain');
        $post_id = get_option('adstxt_post', 0);
        if ($post_id) {
            $post_content = get_post_field('post_content', $post_id);
            echo esc_textarea($post_content);
            exit;
        }
    } else{
        add_action('rest_api_init', function () {
            register_rest_route('mv', '/webhook', array(
                'methods' => 'POST',
                'callback' => 'handle_my_webhook',
                'permission_callback' => '__return_true',
            ));
        });
    }
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
                        return new WP_REST_Response([
                            'success' => true,
                            'messages' => 'Content is required.'
                        ], 400);
                    }
                    return addAdsTxt($content);
                case 'CHECK':
                    return new WP_REST_Response([
                        'success' => true,
                        'messages' => 'Connect success'
                    ], 200);
                default:
                    break;
            }
        }
    }
}

function addAdsTxt($content)
{
    $post_id = get_option('adstxt_post', 0);
    if ($post_id) {
        $post_data = array(
            'ID'           => $post_id,
            'post_content' => wp_kses_post($content),
        );
        wp_update_post($post_data);
    } else {
        $new_post = array(
            'post_title'   => 'Ads.txt',
            'post_content' => wp_kses_post($content),
            'post_status'  => 'publish',
            'post_type'    => 'adstxt',
        );
        $post_id = wp_insert_post($new_post);
        update_option('adstxt_post', $post_id);
    }
    return new WP_REST_Response([
        'success' => true,
        'messages' => 'ads.txt created successfully.'
    ], 200);
}

add_action('admin_menu', 'aap_admin_menu');
add_action('init', 'register_webhook');

// Tải các file CSS và JS cần thiết
function aap_enqueue_assets() {
//    wp_enqueue_style('mv-admin-css', AAP_PLUGIN_URL . 'assets/css/admin.css');
//    wp_enqueue_script('mv-admin-js', AAP_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), null, true);
}

function enqueue_custom_scripts() {
    die('test');
    wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);

    wp_localize_script('custom-script', 'myAjax', array(
        'ajaxurl' => admin_url('client-ajax.php'),  // URL for AJAX requests
        'security' => wp_create_nonce('my-special-string')  // Security nonce
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

add_action('admin_enqueue_scripts', 'aap_enqueue_assets');
