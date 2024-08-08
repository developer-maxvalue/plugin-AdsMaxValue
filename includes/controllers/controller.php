<?php
class AAP_Controller
{
    public static function create_tables()
    {
        AAP_Model_Zones::create_table();
        // Tạo thêm các bảng khác nếu cần
    }

    public static function drop_tables()
    {
        AAP_Model_Zones::aap_uninstall();
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
        include AAP_PLUGIN_DIR . 'templates/login.php';
    }
}
