<div class="header-top">
    <div class="container">
        <div class="header-left">
            <?php $phone_number = get_option('_tnm_settings_set_contact_us')['phone_number_mobile'];
            if (empty($phone_number)) : ?>
               <a href="tel_3A#"><i class="icon-phone"></i>تلفن تماس : 02155667788</a>
            <?php else: ?>
                <a href="tel_3A#"><i class="icon-phone"></i>تلفن تماس : <?php echo $phone_number; ?></a>
            <?php endif; ?>
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
            <ul class="top-menu mr-3" id="header-index3">
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
                <li>
                    <a href="#">لینک ها</a>
                    <ul>
                        <li><a href="#signin-modal" data-toggle="modal">ورود / ثبت نام</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul><!-- End .top-menu -->
            <?php endif; ?>
        </div><!-- End .header-right -->

    </div><!-- End .container -->
</div><!-- End .header-top -->

<div class="header-middle">
    <div class="container">
        <div class="header-left">
            <button class="mobile-menu-toggler">
                <span class="sr-only">فهرست</span>
                <i class="icon-bars"></i>
            </button>

            <a href="<?php echo  home_url(); ?>" class="logo">
                <?php if(!empty(get_site_icon_url())): ?>
                    <img src="<?php site_icon_url(); ?>" alt="<?php bloginfo('name'); ?>" width="105" height="20">
                <?php else : ?>
                <img src="<?php echo  TNM_URL . '/assets/images/demos/demo-3/logo.png'?>" alt="<?php bloginfo('name'); ?>" width="105" height="25">
                <?php endif; ?>
            </a>
        </div><!-- End .header-left -->

        <div class="header-center">
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
        <?php if (is_user_logged_in()) : ?>
        <?php if (get_option('_tnm_settings_set_general')['compare_enable'] === 'yes') : ?>
        <div class="header-right">
            <div class="dropdown compare-dropdown">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" data-display="static" title="مقایسه محصولات"
                   aria-label="Compare Products">
                    <div class="icon">
                        <i class="icon-random"></i>
                    </div>
                    <p>مقایسه</p>
                </a>

                <div class="dropdown-menu dropdown-menu-right">

                    <ul class="compare-products">
                        <?php
                        global $wpdb;
                        $user_id = get_current_user_id();
                        $table   = $wpdb->prefix . 'tns_compare';

                        $items = $wpdb->get_results(
                            $wpdb->prepare("SELECT * FROM {$table} WHERE u_id = %d", $user_id)
                        );
                        if ($items):
                        foreach ($items as $item): ?>
                        <li class="compare-product">
                            <h4 class="compare-product-title">
                                <a href="<?php echo esc_url($item->p_permalink); ?>">
                                    <?php echo esc_html($item->p_title); ?>
                                </a>
                            </h4>
                        </li>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <li class="compare-product empty">هیچ محصولی برای مقایسه وجود ندارد.</li>
                        <?php endif; ?>
                    </ul>
                    <div class="compare-actions">
                        <a href="#" class="action-link">حذف همه</a>
                        <a href="<?php echo site_url('compare') ?>" class="btn btn-outline-primary-2"><span>مقایسه</span><i
                                    class="icon-long-arrow-left"></i></a>
                    </div>
                </div><!-- End .dropdown-menu -->

            </div><!-- End .compare-dropdown -->
            <?php endif; ?>
            <?php endif; ?>
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
            <div class="wishlist">
                <a href="<?php echo site_url('wishlist'); ?>" title="لیست محصولات مورد علاقه شما">
                    <div class="icon">
                        <i class="icon-heart-o"></i>
                        <span class="wishlist-count badge"><?php echo esc_html($wishlist_count); ?></span>
                    </div>
                    <p>مورد علاقه</p>
                </a>
            </div><!-- End .compare-dropdown -->
         <?php endif; ?>
            <?php endif; ?>
            <div class="dropdown cart-dropdown">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" data-display="static">
                    <div class="icon">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count"><?php echo wc()->cart->get_cart_contents_count() ?></span>
                    </div>
                    <p>سبد خرید</p>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <?php woocommerce_mini_cart(); ?>
                </div><!-- End .dropdown-menu -->
            </div><!-- End .cart-dropdown -->
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-middle -->