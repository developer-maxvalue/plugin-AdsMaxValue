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

    public static function wallets()
    {
        include AAP_PLUGIN_DIR . 'templates/wallets.php';
    }

    public static function login()
    {
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();

            $token = get_user_meta($user_id, 'jwt_token', true);

            if ($token) {
                wp_redirect(admin_url('admin.php?page=aap-dashboard'));
                exit;
            }
        }

        include AAP_PLUGIN_DIR . 'templates/login.php';
    }

    public static function logout()
    {
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();

            delete_user_meta($user_id, 'jwt_token');

            wp_logout();
        }

        wp_redirect(home_url('/login'));
        exit;
    }
}
