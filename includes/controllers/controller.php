<?php
class AAP_Controller
{
    public static function create_tables()
    {
        AAP_Model_Zones::create_table();
        AAP_Model_Users::create_table();
        // Tạo thêm các bảng khác nếu cần
    }

    public static function drop_tables()
    {
        AAP_Model_Zones::aap_uninstall();
        AAP_Model_Users::aap_uninstall();
    }

    public static function dashboard()
    {
        $user_id = get_user_meta(get_current_user_id(), 'api_user_id', true);

        if (!$user_id) {
            exit;
        }

        $token = get_user_meta($user_id, 'mv_jwt_token', true);

        if (!$token) {
            exit;
        }

        $website_id = isset($_GET['website_id']) ? sanitize_text_field($_GET['website_id']) : '';
        $date_option = isset($_GET['date_option']) ? sanitize_text_field($_GET['date_option']) : '';
        $start = isset($_GET['start']) ? sanitize_text_field($_GET['start']) : '';
        $end = isset($_GET['end']) ? sanitize_text_field($_GET['end']) : '';

        $api_url = add_query_arg(array(
            'website_id' => $website_id,
            'date_option' => $date_option,
            'start' => $start,
            'end' => $end,
        ), 'https://stg-publisher.maxvalue.media/api/dashboard');

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $token,
            ),
        );

        $response = wp_remote_get($api_url, $args);

        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            error_log("API Request Failed: $error_message");
            echo 'Không thể kết nối tới API';
            return;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Failed to decode JSON: " . json_last_error_msg());
            echo 'Dữ liệu nhận được từ API không hợp lệ';
            return;
        }

        $dashboardData = $data['data'] ?? [];
        include AAP_PLUGIN_DIR . 'templates/dashboard.php';
    }

    public static function zones()
    {
        if ($_POST['action'] == 'add_zone') {
            AAP_Model_Zones::insert_zone($_POST['zone_name'], $_POST['zone_description']);
        }
        $zones = AAP_Model_Zones::get_zones();
        include AAP_PLUGIN_DIR . 'templates/zones.php';
    }

    public static function reports()
    {
        include AAP_PLUGIN_DIR . 'templates/reports.php';
    }

    public static function adsTxt()
    {
        $post_id = get_option('adstxt_post', 0);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['adsTxt'])) {
            if ($post_id) {
                $post_data = array(
                    'ID'           => $post_id,
                    'post_content' => wp_kses_post($_POST['adsTxt']),
                );
                wp_update_post($post_data);
            } else {
                $new_post = array(
                    'post_title'   => 'Ads.txt',
                    'post_content' => wp_kses_post($_POST['adsTxt']),
                    'post_status'  => 'publish',
                    'post_type'    => 'adstxt',
                );
                $post_id = wp_insert_post($new_post);
                update_option('adstxt_post', $post_id);
            }
        }
        $contentAdsTxt = get_post_field('post_content', $post_id);
        include AAP_PLUGIN_DIR . 'templates/adsTxt.php';
    }

    public static function wallets()
    {
        include AAP_PLUGIN_DIR . 'templates/wallets.php';
    }

    public static function login()
    {
        include AAP_PLUGIN_DIR . 'templates/login.php';
    }

    public static function referral()
    {
        include AAP_PLUGIN_DIR . 'templates/referral.php';
    }

    public static function logout()
    {
        include AAP_PLUGIN_DIR . 'templates/logout.php';
        exit;
    }

    public static function save_user_data()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['email'], $input['password'], $input['token'], $input['user_id'])) {
            $email = sanitize_email($input['email']);
            $password = sanitize_text_field($input['password']);
            $token = sanitize_text_field($input['token']);
            $user_id = intval($input['user_id']);

            $current_user_id = get_current_user_id();
            update_user_meta($current_user_id, 'api_user_id', $user_id);
            update_user_meta($user_id, 'mv_jwt_token', $token);

            $user = AAP_Model_Users::get_user_by_email($email);

            if ($user) {
                $updated = AAP_Model_Users::update_user($user_id, $email, $token);
                if ($updated !== false) {
                    wp_send_json_success(['message' => 'User data updated successfully']);
                } else {
                    wp_send_json_error(['message' => 'Failed to update user data']);
                }
            } else {
                $inserted = AAP_Model_Users::insert_user($user_id, $email, $password, $token);
                if ($inserted) {
                    wp_send_json_success(['message' => 'User inserted successfully']);
                } else {
                    wp_send_json_error(['message' => 'Failed to insert user']);
                }
            }
        } else {
            wp_send_json_error(['message' => 'Invalid data']);
        }

        wp_die();
    }

    public static function verify_token()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $token = sanitize_text_field($input['token']);

        global $wpdb;
        $user_id = $wpdb->get_var($wpdb->prepare("
            SELECT user_id FROM {$wpdb->prefix}mv_users WHERE token = %s
        ", $token));

        if ($user_id) {
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }

        wp_die();
    }
}

add_action('wp_ajax_aap_save_user_data', 'AAP_Controller::save_user_data');
add_action('wp_ajax_nopriv_aap_save_user_data', 'AAP_Controller::save_user_data');
add_action('wp_ajax_verify_token', 'AAP_Controller::verify_token');
add_action('wp_ajax_nopriv_verify_token', 'AAP_Controller::verify_token');
