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
        $user_id = get_current_user_id();

        $token = get_user_meta($user_id, 'jwt_token', true);

        if (!$token) {
            echo 'Token không tồn tại. Vui lòng đăng nhập lại.';
            return;
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
        $file_path = ABSPATH . 'ads.txt';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['adsTxt'])) {
            if (!file_put_contents($file_path, ($_POST['adsTxt'] ?? '')) !== false) {
                return new WP_REST_Response('Failed to create ads.txt.', 500);
            }
        }

        if ( file_exists( $file_path ) ) {
            $contentAdsTxt = file_get_contents( $file_path );
        } else {
            $contentAdsTxt = '';
        }
        include AAP_PLUGIN_DIR . 'templates/adsTxt.php';
    }

    public static function wallets()
    {
        include AAP_PLUGIN_DIR . 'templates/wallets.php';
    }

    public static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = sanitize_email($_POST['email']);
            $password = sanitize_text_field($_POST['password']);

            $response = wp_remote_post('https://stg-publisher.maxvalue.media/api/login-jwt', array(
                'body' => json_encode(array(
                    'email' => $email,
                    'password' => $password,
                )),
                'headers' => array(
                    'Content-Type' => 'application/json',
                ),
            ));

            if (is_wp_error($response)) {
                echo 'Error during API request: ' . $response->get_error_message();
                return;
            }

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            print_r($data);

            // if (!empty($data['token'])) {
            //     $user = AAP_Model_Users::get_user_by_email($email);

            //     if ($user) {
            //         AAP_Model_Users::update_user_token($email, $data['token']);
            //     } else {
            //         AAP_Model_Users::insert_user($email, $password, $data['token']);
            //     }

            //     echo json_encode(array('token' => $data['token'], 'user_info' => $data['user'], 'redirect' => admin_url('admin.php?page=aap-dashboard')));
            //     exit;
            // } else {
            //     echo 'Login failed: Invalid credentials or API error';
            // }
        }

        include AAP_PLUGIN_DIR . 'templates/login.php';
    }

    public static function referral()
    {
        include AAP_PLUGIN_DIR . 'templates/referral.php';
    }

    public static function logout()
    {
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();

            delete_user_meta($user_id, 'jwt_token');
            delete_transient('user_info');
        }

        include AAP_PLUGIN_DIR . 'templates/logout.php';
        exit;
    }
}
