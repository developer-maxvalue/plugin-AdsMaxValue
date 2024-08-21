<?php

class AAP_Model_AdsTxt
{
    public static function create_row()
    {
        $post_id = get_option('adstxt_post', 0);
        if (empty($post_id)) {
            $new_post = array(
                'post_title'   => 'Ads.txt',
                'post_content' => wp_kses_post(''),
                'post_status'  => 'publish',
                'post_type'    => 'adstxt',
            );
            $post_id = wp_insert_post($new_post);
            update_option('adstxt_post', $post_id);
        }
    }
}
