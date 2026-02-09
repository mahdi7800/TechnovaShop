<?php
function tns_activation_file() {
	global $wpdb;

	$table_newsletter = $wpdb->prefix .'tns_newsletter';
	$tns_newsletter = "CREATE TABLE IF NOT EXISTS `$table_newsletter` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `email` varchar(256) NOT NULL,
        `status` int(1) NOT NULL DEFAULT 1 COMMENT 'active: 1, deactive: 0',
        `create_at` datetime NOT NULL DEFAULT current_timestamp(),
        `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

	$table_banner = $wpdb->prefix . 'tns_banner';
	$tns_banner = "CREATE TABLE IF NOT EXISTS `$table_banner` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `image_url` varchar(256) NOT NULL,
        `title` varchar(256) NOT NULL,
        `link_url` varchar(256) NOT NULL,
        `create_at` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

	$table_sliders = $wpdb->prefix . 'tns_sliders';
	$tns_sliders = "CREATE TABLE IF NOT EXISTS `$table_sliders` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `top_title` varchar(256) NOT NULL,
        `main_title` varchar(256) NOT NULL,
        `sub_title` varchar(256) NOT NULL,
        `p_thumbnail` varchar(256) NOT NULL,
        `p_image` varchar(256) NOT NULL,
        `create_at` datetime NOT NULL DEFAULT current_timestamp(),
        `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

	$table_wishlist = $wpdb->prefix .'tns_wishlist';
	$tns_wishlist = "CREATE TABLE IF NOT EXISTS `$table_wishlist` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `p_id` int(11) NOT NULL,
        `u_id` int(11) NOT NULL,
        `p_title` varchar(256) NOT NULL,
        `p_thumbnail` varchar(256) NOT NULL,
        `p_permalink` varchar(256) NOT NULL,
        `create_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $table_compare = $wpdb->prefix .'tns_compare';
    $tns_compare = "CREATE TABLE IF NOT EXISTS `$table_compare` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `u_id` int(11) NOT NULL,
    `p_id` int(11) NOT NULL,
    `p_title` varchar(256) NOT NULL,
    `p_thumbnail` varchar(256) NOT NULL,
    `p_permalink` varchar(256) NOT NULL,
    `create_at` datetime NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $table_faq = $wpdb->prefix .'tns_faq';
    $tns_faq = "CREATE TABLE IF NOT EXISTS `$table_faq` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(256) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
   PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    $table_faq_details = $wpdb->prefix .'tns_faq_detail';
    $tns_faq_details = "CREATE TABLE IF NOT EXISTS `$table_faq_details` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `faq_question` varchar(256) NOT NULL,
    `faq_answer` text NOT NULL,
    `faq_id` int(11) NOT NULL,
    `create_at` datetime NOT NULL DEFAULT current_timestamp(),
    `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($tns_newsletter);
	dbDelta($tns_banner);
	dbDelta($tns_sliders);
	dbDelta($tns_wishlist);
    dbDelta($tns_compare);
    dbDelta($tns_faq);
    dbDelta($tns_faq_details);

	$options = [
		     '_tnm_social_media_website'  => [
			     'telegram' => '',
			     'instagram' => '',
                 'whatsapp' => '',
			     'discord' => '',
			     'linkedin' => '',
			     'youtube' =>'',
			     'x'=> ''
		     ]
			,'_tnm_settings_set_general'  => [
			'wishlist_enable'=>'no',
			'newsletter_enable'=>'no',
            'compare_enable'=> 'no',
			'exclude_category_id'=>'',
			'link_enamad' => '',
			'link_zarinpal' => ''
		]
			,'_tnm_settings_set_smtp'     => [
			'host'     =>'',
			'port'     =>'',
			'username' =>'',
			'password' =>'',
			'from'     =>'',
			'FormName' =>''
		]
			,'_tnm_settings_set_contact_us'=>[
			'email_contact'       => '',
			'phone_number_store'  => '',
			'phone_number_mobile' => '',
			'start_work_h'        => '',
			'end_work_h'          => '',
			'start_work'          => '',
			'end_work'            =>'',
			'working_time_raw'    => '',
			'address'             => '',
			'iframe_map_url'      => '',
		]
            ,'_tnm_set_index_website'=> 'in10'
		];
	foreach ($options as $key => $value) {
		if (get_option($key) === false) {
			update_option($key, $value);
		}
	}

    if (version_compare(get_bloginfo('version'), '6.0.0', '>')) {
        wp_die('این قالب نیاز به وردپرس نسخه 6.0 یا بالاتر دارد.');
    }

}
function tns_deactivation() {

}


add_action('after_switch_theme', 'tns_activation_file');
register_deactivation_hook('switch_theme', 'tns_deactivation');
