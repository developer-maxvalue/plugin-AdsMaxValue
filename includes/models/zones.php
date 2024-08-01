<?php

class AAP_Model_Zones
{
    public static function create_table()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_zones';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            name varchar(255) DEFAULT NULL,
            code text DEFAULT NULL,
            status varchar(255) DEFAULT NULL,
            width int(11) DEFAULT NULL,
            height int(11) DEFAULT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        // Ghi log lỗi
        if ($wpdb->last_error) {
            error_log("Error creating table $table_name: " . $wpdb->last_error);
        }
    }

    // Xóa bảng cơ sở dữ liệu khi plugin bị xóa
    public static function aap_uninstall() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_zones';
        $sql = "DROP TABLE IF EXISTS $table_name;";
        $wpdb->query($sql);
    }

    public static function insert_zone($zone_name, $zone_description)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_zones';
        $wpdb->insert(
            $table_name,
            array(
                'zone_name' => $zone_name,
                'zone_description' => $zone_description
            )
        );
    }

    public static function get_zones()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'aap_zones';
        return $wpdb->get_results("SELECT * FROM $table_name");
    }
}