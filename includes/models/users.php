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
            token text DEFAULT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY email (email)
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

    public static function insert_user($user_id, $email, $password, $token = null)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';

        $inserted = $wpdb->insert($table_name, [
            'user_id' => $user_id,
            'email' => $email,
            'password' => wp_hash_password($password),
            'token' => $token,
        ]);

        if (false === $inserted) {
            error_log('Failed to insert user: ' . $wpdb->last_error);
        }

        return $inserted;
    }

    public static function update_user($user_id, $email, $token)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';

        $updated = $wpdb->update($table_name, [
            'user_id' => $user_id,
            'token' => $token,
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

    public static function update_user_token($email, $token)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        return $wpdb->update($table_name, ['token' => $token], ['email' => $email]);
    }

    public static function get_user_token_by_user_id($user_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';
        return $wpdb->get_var($wpdb->prepare("SELECT token FROM $table_name WHERE user_id = %d", $user_id));
    }

    public static function user_has_valid_token($user_id)
    {
        $token = self::get_user_token_by_user_id($user_id);
        return !empty($token);
    }

    public static function redirect_if_logged_in_with_token()
    {
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();

            if (self::user_has_valid_token($user_id)) {
                wp_redirect(admin_url('admin.php?page=mv-dashboard'));
                exit;
            }
        }
    }

    public static function logout_user($user_id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'mv_users';

        $wpdb->update(
            $table_name,
            array('token' => null),
            array('user_id' => $user_id)
        );

        wp_logout();
    }
}
