<?php

/**
 *  Contants
 */
if (!function_exists('fw_ext_article_sp_prepare_constants')) {

    function fw_ext_article_sp_prepare_constants() {

        wp_localize_script('fw_ext_articles_callback', 'fw_ext_articles_scripts_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'delete_article_title' => esc_html__('Article Delete Notification.', 'cannalisting_core'),
            'delete_article_msg' => esc_html__('Are you sure, you want to delete this article.', 'cannalisting_core'),
			'cannalisting_featured_nounce' => wp_create_nonce ( 'cannalisting_featured_nounce' ),
			'file_upload_title' => esc_html__('Feature image upload','cannalisting_core'),
			'theme_path_uri' => get_template_directory_uri(),
			'theme_path' => get_template_directory(),
        ));
    }

    add_action('wp_enqueue_scripts', 'fw_ext_article_sp_prepare_constants', 90);
}