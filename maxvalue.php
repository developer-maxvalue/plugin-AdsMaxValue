<?php
/*
Plugin Name:
Plugin URI: https://maxvalue.media
Description: A simple plugin to insert ads into WordPress.
Version: 1.0
Author: Your Name
Author URI: http://example.com
License: GPL2
*/

// Đảm bảo không ai trực tiếp truy cập vào file PHP
if ( !defined( 'ABSPATH' ) ) exit;

// Hàm để hiển thị quảng cáo
function sap_display_ad() {
    // Thay thế đoạn mã này bằng mã quảng cáo thực tế của bạn
    $ad_code = '<div class="ad-container">
                   <img src="https://via.placeholder.com/300x250" alt="Ad">
                </div>';
    echo $ad_code;
}

// Tạo shortcode để dễ dàng chèn quảng cáo
function sap_register_shortcodes() {
    add_shortcode('simple_ad', 'sap_display_ad');
}
add_action('init', 'sap_register_shortcodes');

// Thêm quảng cáo vào cuối mỗi bài viết
function sap_add_ad_to_content($content) {
    if (is_single() && !is_admin()) {
        $ad_code = '<div class="ad-container">
                       <img src="https://via.placeholder.com/300x250" alt="Ad">
                    </div>';
        $content .= $ad_code;
    }
    return $content;
}
add_filter('the_content', 'sap_add_ad_to_content');