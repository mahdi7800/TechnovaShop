<div id="heder-edit" class="header-top">
    <div class="container">
        <div class="header-left">
            <div class="header-dropdown">
                <a href="#"><?php bloginfo('name')?>  پلاس  </a>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => 'div',
                    'container_class' => 'header-menu',
                    'menu_class' => '',
                    'items_wrap' => '<ul>%3$s</ul>',
                    'fallback_cb' => function() {
                        echo '<li><a href="#">منو تنظیم نشده است</a></li>';
                    },
                    'depth' => 2,
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                ));
                ?>

            </div><!-- End .header-dropdown -->
            <div id="edit-social" class="social-icons social-icons-color">
                <?php
                $social_media_options = get_option('_tns_social_media_website', []);
                $telegram = !empty($social_media_options['telegram']) ?  $social_media_options['telegram'] : '';
                $instagram = !empty($social_media_options['instagram']) ? $social_media_options['instagram'] : '';
                $whatsapp = !empty($social_media_options['discord']) ? $social_media_options['discord'] : '';

                ?>
                <a href="<?php echo esc_url($telegram) ?>" class="social-icon social-facebook" title="تلگرام" target="_blank"><i class="icon-telegram"></i></a>
                <a href="<?php echo esc_url($whatsapp) ?>" class="social-icon social-whatsapp" title="واتساپ" target="_blank"><i class="icon-whatsapp"></i></a>
                <a href="<?php echo esc_url($instagram) ?>" class="social-icon social-instagram" title="اینستاگرام" target="_blank"><i class="icon-instagram"></i></a>
            </div>
        </div>

        <div class="header-right">
            <ul class="top-menu">
                <li>
                    <a href="#">لینک ها</a>
                    <ul>
                        <?php $setting_data = get_option('_tns_settings_set_contact_us');
                        $phone_number = !empty($setting_data['phone_number_mobile']) ? $setting_data['phone_number_mobile'] : '09123456789' ; ?>
                        <li><a href="tel:<?php echo $phone_number; ?>"><i class="icon-phone"></i>تلفن تماس :   <?php echo $phone_number ; ?></a></li>
                        <?php
                        if (is_user_logged_in()) :
                            $active_wishlist = get_option('_tnm_settings_set_general');
                            if ($active_wishlist['wishlist_enable'] === 'yes') : ?>
                                <?php
                                $user_id = get_current_user_id();
                                $wishlist_count = 0;

                                if ( $user_id ) {
                                    global $wpdb;
                                    $table = $wpdb->prefix . 'tns_wishlist';
                                    $wishlist_count = $wpdb->get_var(
                                        $wpdb->prepare("SELECT COUNT(*) FROM {$table} WHERE u_id = %d", $user_id)
                                    );
                                }
                                ?>
                                <li><a href="<?php echo site_url('wishlist'); ?>"><i class="icon-heart-o"></i>لیست علاقه مندی من<span>( <?php echo esc_html($wishlist_count); ?> )</span></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ( is_user_logged_in() ): ?>
                            <?php $current_user = wp_get_current_user();
                            $avatar            = get_avatar( $current_user->user_email, '24', 'mystery',esc_attr($current_user->nickname) , [ 'class' => 'user-avatar' ] ); ?>
                            <li id="mr-d" class="dropdown-account">
                                <div class="header-left">
                                    <div class="header-dropdown">
                                        <a>
                                            <?php echo $avatar; ?>
                                            <?php echo $current_user->display_name; ?>
                                        </a>
                                        <div class="header-menu">
                                            <ul class="dropdown-menu text-end min-size">
                                                <!-- Profile info -->
                                                <li class="px-3 pt-2 pb-1 border-bottom">
                                                    <div class="fw-bold large-text">نام کاربری: <?php echo $current_user->display_name; ?></div>
                                                    <div class="text-muted large-text"> <span class="fw-bold"> ایمیل : </span> <?php echo $current_user->user_email; ?></div>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2" href="<?php echo site_url('/my-account/'); ?>">
                                                        <i class="icon-user"></i> پیشخوان
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2" href="<?php echo site_url('/my-account/orders/'); ?>">
                                                        <i class="icon-list"></i> سفارش‌ها
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2" href="<?php echo site_url('/my-account/edit-account/'); ?>">
                                                        <i class="icon-edit"></i> اطلاعات حساب کاربری
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="<?php echo wp_logout_url(home_url()); ?>">
                                                        <i class="icon-sign-out"></i> خروج
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- End .header-menu -->
                                    </div><!-- End .header-dropdown -->
                                </div>
                            </li>
                        <?php else : ?>
                            <?php if ( ! is_page( 'my-account' ) ) : ?>
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>ورود</a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-top -->