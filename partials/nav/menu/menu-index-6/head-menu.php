<div class="header-top">
    <div class="container">
        <div class="header-left">
            <ul class="top-menu top-link-menu d-none d-md-block">
                <li>
                    <a href="#">لینک ها</a>
                    <ul>
                        <?php $phone_number = get_option('_tnm_settings_set_contact_us')['phone_number_mobile'];
                        if (empty($phone_number)) : ?>
                            <li><a href="tel_3A#"><i class="icon-phone"></i>تلفن تماس : 02155667788</a></li>
                        <?php else: ?>
                            <li><a href="tel_3A#"><i class="icon-phone"></i>تلفن تماس : <?php echo $phone_number; ?></a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-left -->

        <div class="header-right">
            <div class="social-icons social-icons-color">
                <?php
                $whatsapp =   get_option('_tnm_social_media_website')['whatsapp'] ?? '' ;
                $instagram =  get_option('_tnm_social_media_website')['instagram']?? '';
                $telegram =   get_option('_tnm_social_media_website')['telegram']?? '';
                ?>
                <a href="<?php echo esc_url($whatsapp) ; ?>" class="social-icon social-facebook" title="واتسپ" target="_blank"><i
                            class="icon-whatsapp"></i></a>
                <a href="<?php echo esc_url($telegram) ; ?>" class="social-icon social-twitter" title="تلگرام" target="_blank"><i
                            class="icon-telegram"></i></a>
                <a href="<?php echo esc_url($instagram) ; ?>" class=icon-instagram" title="اینستاگرام" target="_blank"><i
                            class="icon-instagram"></i></a>
            </div><!-- End .soial-icons -->
            <ul class="top-menu top-link-menu">
                <li>
                    <?php if ( is_user_logged_in() ): ?>
                    <?php
                    $current_user = wp_get_current_user();
                    $avatar = get_avatar( $current_user->user_email, '24', 'mystery',esc_attr($current_user->nickname) , [ 'class' => 'user-avatar' ] ); ?>
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
                    <a href="#">لینک ها</a>
                    <ul>
                        <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>ورود</a>
                        </li>
                    </ul>
                    <?php endif; ?>
                <?php endif; ?>
            </ul><!-- End .top-menu -->

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
                        echo '<div class="header-menu"><ul><li><a href="#">منو تنظیم نشده است</a></li></ul></div>';
                    },
                    'depth' => 2,
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                ));
                ?>

            </div><!-- End .header-dropdown -->
        </div> <!-- End .header-right -->
    </div>
</div>
<div class="header-middle">
    <div class="container">
        <div class="header-left">
            <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="woocommerce-product-search-field" class="sr-only">جستجو</label>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        <input type="search" class="form-control" name="s" id="woocommerce-product-search-field"
                               placeholder="جستجوی محصول ..." required VALUE="<?php echo get_search_query(); ?>">
                        <input type="hidden" name="post_type" value="product" />
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->
        </div>
        <div class="header-center">

            <a href="<?php echo  home_url(); ?>" class="logo">
                <?php if(!empty(get_site_icon_url())): ?>
                    <img src="<?php site_icon_url(); ?>" alt="<?php bloginfo('name'); ?>" width="82" height="20">
                <?php else : ?>
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/logo.png'?>" alt="<?php echo  bloginfo('name'); ?>" width="82" height="20">
                <?php endif; ?>
            </a>
        </div><!-- End .header-left -->
        <div class="header-right">
            <?php if (is_user_logged_in()) :
                $active_wishlist = get_option('_tnm_settings_set_general');
                if ($active_wishlist['wishlist_enable'] === 'yes') :
                    $user_id = get_current_user_id();
                    $wishlist_count = 0;

                    if ( $user_id ) {
                        global $wpdb;
                        $table = $wpdb->prefix . 'tns_wishlist';
                        $wishlist_count = $wpdb->get_var(
                            $wpdb->prepare("SELECT COUNT(*) FROM {$table} WHERE u_id = %d", $user_id)
                        );
                    } ?>
                    <a href="<?php echo site_url('wishlist'); ?>" class="wishlist-link">
                        <i class="icon-heart-o"></i>
                        <span class="wishlist-count"><?php echo esc_html($wishlist_count); ?></span>
                        <span class="wishlist-txt">علاقه مندی</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <div class="dropdown cart-dropdown">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" data-display="static">
                    <i class="icon-shopping-cart"></i>
                    <span class="cart-count"><?php echo wc()->cart->get_cart_contents_count() ?></span>
                    <span class="cart-txt"><?php echo wc()->cart->get_cart_contents_total(); ?></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <?php woocommerce_mini_cart(); ?>
                </div><!-- End .dropdown-menu -->
            </div><!-- End .cart-dropdown -->
        </div>
    </div><!-- End .container -->
</div><!-- End .header-middle -->