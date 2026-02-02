<?php

define('TNM_DIR',get_template_directory());
define('TNM_URL',get_template_directory_uri());

include_once '_inc/assets/register-assets.php';
include_once '_inc/theme-setup/theme_setup.php';
include_once '_inc/post_thumbnail/post_thumbnail.php';
include_once '_inc/sidebar/register_sidebar.php';
include_once '_inc/sidebar/CatWidget.php';
include_once '_inc/comment/tns_comment_func.php';
include_once '_inc/email/config-email.php';
include_once '_inc/setting/add-menu-setting.php';
include_once '_inc/setting/custom-logo.php';
include_once '_inc/short-code/short-code-wishlist.php';
include_once '_inc/short-code/short-code-compare.php';
include_once '_inc/db/tns-active-themes.php';
include_once '_inc/meta-box/tns_add_meta_box.php';


include_once 'class/breadcrumb/Breadcrumb.php';
include_once 'class/nav_walker/bootstrap_5_wp_nav_menu_walker.php';
include_once 'utility/utility.php';


include_once 'helper/PostView.php';
include_once 'helper/GoogleReferer.php';
include_once 'helper/Pagination.php';
include_once 'helper/PostExcerpt.php';
include_once 'helper/Tns_Mail_Layout.php';


remove_action('woocommerce_before_main_content','WC_Structured_Data::generate_website_data()','30');
remove_action('woocommerce_sidebar','woocommerce_get_sidebar','10');
remove_action('woocommerce_before_shop_loop','woocommerce_output_all_notices','10');
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb','20');
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash','20');
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images','20');
remove_action('woocommerce_single_product_summary','woocommerce_template_single_title','5');
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating','10');
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);


//_INC/AJAX_Function

include_once '_inc/ajax_function/tns-contact-us.php';
include_once '_inc/ajax_function/tns-wishlist.php';
include_once '_inc/ajax_function/tns-newsletter.php';
include_once '_inc/ajax_function/tns-compare.php';






if (add_theme_support('woocommerce')) {
    add_filter( 'loop_shop_per_page', function( $cols ) {
        return 18;
    }, 20 );

    add_filter('woocommerce_checkout_fields', 'custom_checkout_fields_classes');
    function custom_checkout_fields_classes($fields) {
        foreach ($fields as &$fieldset) {
            foreach ($fieldset as &$field) {
                $field['input_class'] = ['form-control']; // بوت‌استرپ یا هرچی خواستی
                $field['label_class'] = ['form-label'];
                $field['class'] = ['mb-3'];
            }
        }
        return $fields;
    }
    add_action('pre_get_posts', 'filter_shop_by_category');
    function filter_shop_by_category($query)
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (is_post_type_archive('product') || is_shop()) {

            $query->set('tax_query', [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => ['bulk_purchase'],
                    'operator' => 'NOT IN'
                ]
            ]);
        }
    }
    add_filter( 'woocommerce_billing_fields', 'tns_make_billing_phone_required' );
    function tns_make_billing_phone_required( $fields )
    {
        $fields['billing_phone']['required'] = true;
        return $fields;
    }
}





