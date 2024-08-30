<?php
class AAP_Controller
{
    public static function create_tables()
    {
        AAP_Model_Zones::create_table();
        AAP_Model_Users::create_table();
        AAP_Model_AdsTxt::create_row();
    }

    public static function drop_tables()
    {
        AAP_Model_Zones::aap_uninstall();
        AAP_Model_Users::aap_uninstall();

        // remove file ads.txt
        unlink(ABSPATH . 'ads.txt');

    }

    public static function dashboard()
    {
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
        $ads_file = ABSPATH . 'ads.txt';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['adsTxt'])) {
            file_put_contents($ads_file, $_POST['adsTxt']);
        }
        $contentAdsTxt = file_get_contents($ads_file);
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

        if (isset($input['email'], $input['password'], $input['user_id'])) {
            $email = sanitize_email($input['email']);
            $password = sanitize_text_field($input['password']);
            $user_id = intval($input['user_id']);

            $current_user_id = get_current_user_id();
            update_user_meta($current_user_id, 'api_user_id', $user_id);

            $user = AAP_Model_Users::get_user_by_email($email);

            if (!$user) {
                $inserted = AAP_Model_Users::insert_user($user_id, $email, $password);
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
}

add_action('wp_ajax_aap_save_user_data', 'AAP_Controller::save_user_data');
add_action('wp_ajax_nopriv_aap_save_user_data', 'AAP_Controller::save_user_data');
