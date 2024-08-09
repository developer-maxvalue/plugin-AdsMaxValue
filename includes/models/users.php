<?php

class AAP_Model_Users
{
    public static function create_table()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id int(11) NOT NULL AUTO_INCREMENT,
            email varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            token text DEFAULT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY email (email)
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
        $table_name = $wpdb->prefix . 'mv_users';
        $sql = "DROP TABLE IF EXISTS $table_name;";
        $wpdb->query($sql);
    }

    // Thêm người dùng vào bảng wp_mv_users
    public static function insert_user($email, $password, $token = null)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        $wpdb->insert(
            $table_name,
            array(
                'email' => $email,
                'password' => $password,
                'token' => $token
            )
        );

        // Ghi log lỗi
        if ($wpdb->last_error) {
            error_log("Error inserting user into $table_name: " . $wpdb->last_error);
        }
    }

    // Lấy tất cả người dùng
    public static function get_users()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        return $wpdb->get_results("SELECT * FROM $table_name");
    }

    // Lấy người dùng theo email
    public static function get_user_by_email($email)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email));
    }

    // Cập nhật token cho người dùng
    public static function update_user_token($email, $token)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        $wpdb->update(
            $table_name,
            array('token' => $token),
            array('email' => $email)
        );

        // Ghi log lỗi
        if ($wpdb->last_error) {
            error_log("Error updating token for user $email in $table_name: " . $wpdb->last_error);
        }
    }
}
