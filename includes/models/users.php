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
            user_id int(11) NOT NULL,
            email varchar(255) NOT NULL,
            password varchar(255) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        if ($wpdb->last_error) {
            error_log("Error creating table $table_name: " . $wpdb->last_error);
        }
    }

    public static function aap_uninstall()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        $sql = "DROP TABLE IF EXISTS $table_name;";
        $wpdb->query($sql);
    }

    public static function insert_user($user_id, $email, $password)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';

        $inserted = $wpdb->insert($table_name, [
            'user_id' => $user_id,
            'email' => $email,
            'password' => wp_hash_password($password)
        ]);

        if (false === $inserted) {
            error_log('Failed to insert user: ' . $wpdb->last_error);
        }

        return $inserted;
    }

    public static function update_user($user_id, $email)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';

        $updated = $wpdb->update($table_name, [
            'user_id' => $user_id,
        ], ['email' => $email]);

        if (false === $updated) {
            error_log('Failed to update user: ' . $wpdb->last_error);
        }

        return $updated;
    }

    public static function get_users()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        return $wpdb->get_results("SELECT * FROM $table_name");
    }

    public static function get_user_by_email($email)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email));
    }

    public static function logout_user($user_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';

        $wpdb->update(
            $table_name,
            array('user_id' => $user_id)
        );

        wp_logout();
    }
}
