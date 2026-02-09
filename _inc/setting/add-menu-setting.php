<?php
add_action( 'admin_menu', 'tns_register_menu' );

function tns_register_menu() {
	add_menu_page(
		  'تنظیمات  قالب'
		, 'تنظیمات  قالب'
		, 'manage_options'
		, 'setting_shop'
		, 'setting_shop_layout'
		, 'dashicons-sos'
		, 25
	);
    add_submenu_page(
         'setting_shop'
        ,'تنظیمات عمومی'
        ,'تنظیمات عمومی'
        ,'manage_options'
        ,'setting_shop_tab_one'
        ,'setting_shop_layout'
    );
	add_submenu_page(
		'setting_shop'
		, 'مدریت اسلایدر'
		, 'مدیریت اسلایدر'
		, 'manage_options'
		, 'setting_shop_tab_two'
		, 'setting_shop_layout' ///slider_setting_html_layout
		, ''

	);
	add_submenu_page(
		'setting_shop'
		, 'مدیریت بنر ها'
		, 'مدیریت بنر ها'
		, 'manage_options'
		, 'setting_shop_tab_three'
		, 'setting_shop_layout' //banner_setting_html_layout
		, ''
	);
	add_submenu_page(
		'setting_shop'
		, 'تماس با ما'
		, 'تماس با ما'
		, 'manage_options'
		, 'setting_shop_tab_four'
		, 'setting_shop_layout'
		, ''
	);
	add_submenu_page(
		'setting_shop'
		, 'مدریت شبکه های اجتماعی'
		, 'مدریت شبکه های اجتماعی'
		, 'manage_options'
		, 'setting_shop_tab_five'
		, 'setting_shop_layout'
		, ''
	);
    add_submenu_page(
        'setting_shop'
        , 'سوالات متداول'
        , 'سوالات متداول'
        , 'manage_options'
        , 'setting_shop_tab_six'
        , 'setting_shop_layout'
        , ''
    );
}

function setting_shop_layout() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'دسترسی غیرمجاز!' );
	}

	$page = isset( $_GET['page'] ) ? $_GET['page'] : 'setting_shop_tab_one';
	$tab  = str_replace( 'setting_shop_', '', $page );
	?>
    <div class="wrap">
        <h1 class="nav-tab-wrapper">
            <a href="?page=setting_shop_tab_one"
               class="nav-tab <?php echo $tab === 'tab_one' ? 'nav-tab-active' : ''; ?>">تنظیمات عمومی</a>
            <a href="?page=setting_shop_tab_two"
               class="nav-tab <?php echo $tab === 'tab_two' ? 'nav-tab-active' : ''; ?>">مدیریت اسلایدر</a>
            <a href="?page=setting_shop_tab_three"
               class="nav-tab <?php echo $tab === 'tab_three' ? 'nav-tab-active' : ''; ?>">منتخب بنر ها</a>
            <a href="?page=setting_shop_tab_four"
               class="nav-tab <?php echo $tab === 'tab_four' ? 'nav-tab-active' : ''; ?>">تماس با ما</a>
            <a href="?page=setting_shop_tab_five"
               class="nav-tab <?php echo $tab === 'tab_five' ? 'nav-tab-active' : ''; ?>">شبکه‌های اجتماعی</a>
            <a href="?page=setting_shop_tab_six"
               class="nav-tab <?php echo $tab === 'tab_six' ? 'nav-tab-active' : ''; ?>">سوالات متداول</a>
        </h1>

        <div class="tab-content" style="margin-top: 20px;">
			<?php
			switch ( $tab ) {
				case 'tab_one':
					tnm_general_setting_html_layout();
					break;
				case 'tab_two':
					tnm_slider_setting_html_layout();
					break;
				case 'tab_three':
                    tnm_banner_setting_html_layout();
					break;
				case 'tab_four':
                    tnm_contact_us_setting_layout();
					break;
				case 'tab_five':
                    tnm_social_media_html_layout();
					break;
                case 'tab_six':
                    tnm_faq_html_layout();
                break;
				default:
                    tnm_info_setup_theme();
			}
			?>
        </div>
    </div>
	<?php
}
/// TAB ONE
function tnm_general_setting_html_layout() {
	require_once 'view/general-setting-html-layout.php';
}
/// TAB TWO
function tnm_slider_setting_html_layout() {
	require_once 'view/slider-setting-html-layout.php';
}
//TAB THREE
function tnm_banner_setting_html_layout() {
	require_once 'view/banner-setting-html-layout.php';
}
//TAB FOUR
function tnm_contact_us_setting_layout() {
	require_once 'view/contact-us-setting-layout.php';
}
//TAB FIVE
function tnm_social_media_html_layout() {
	require_once 'view/social-media-html-layout.php';
}
//TAB SIX
function tnm_foq_html_layout() {
    require_once 'view/faq-setting-html-layout.php';
}
//DEFAULT
function tnm_info_setup_theme() {
	require_once 'view/info-setup-theme.php';
}
