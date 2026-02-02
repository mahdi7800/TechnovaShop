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

            <ul class="top-menu mt-1">
                <li>
                    <a href="#">لینک ها</a>
                    <ul class="dropdown-links">
                        <li>
                            <div class="social-icons social-icons-color">
                                <?php
                                $whatsapp = get_option('_tnm_social_media_website')['whatsapp'] ?? '';
                                $instagram = get_option('_tnm_social_media_website')['instagram'] ?? '';
                                $telegram = get_option('_tnm_social_media_website')['telegram'] ?? '';
                                ?>
                                <a href="<?php echo esc_url($whatsapp); ?>" class="social-icon social-facebook"
                                   title="واتسپ" target="_blank"><i
                                            class="icon-whatsapp"></i></a>
                                <a href="<?php echo esc_url($telegram); ?>" class="social-icon social-twitter"
                                   title="تلگرام" target="_blank"><i
                                            class="icon-telegram"></i></a>
                                <a href="<?php echo esc_url($instagram); ?>" class=icon-instagram" title="اینستاگرام"
                                   target="_blank"><i
                                            class="icon-instagram"></i></a>
                            </div><!-- End .soial-icons -->
                        </li>
                        <?php if (!is_user_logged_in()): ?>
                            <li><a href="#signin-modal" data-toggle="modal">ورود / ثبت نام</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
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

            <a href="<?php echo home_url(); ?>" class="logo">
                <?php if (!empty(get_site_icon_url())): ?>
                    <img src="<?php site_icon_url(); ?>" alt="<?php bloginfo('name'); ?>" width="105" height="25">
                <?php else : ?>
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-20/logo.png' ?>"
                         alt="<?php bloginfo('name'); ?>" width="105" height="25">
                <?php endif; ?>
            </a>
        </div><!-- End .header-left -->

        <div class="header-right">
            <div class="header-search header-search-extended header-search-visible header-search-no-radius">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="s" class="sr-only">جستجو</label>
                        <input type="search" class="form-control" name="s" id="s"
                               placeholder="جستجوی محصول ..." required VALUE="<?php echo get_search_query(); ?>">
                        <input type="hidden" name="post_type" value="product"/>
                        <?php
                        $exclude_category = get_option('_tnm_settings_set_general');
                        $args = [
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'exclude' => $exclude_category['exclude_category_id'],
                            'parent' => 0,
                            'orderby' => 'id',
                            'order' => 'ASC'
                        ];
                        $product_main_cats = get_categories($args);

                        if ($product_main_cats): ?>
                            <div class="select-custom">
                                <select id="product_cat" name="product_cat">
                                    <option value="">همه دسته ها</option>
                                    <?php foreach ($product_main_cats as $product_main_cat):
                                        $main_category_link = get_term_link($product_main_cat); ?>
                                        <option value="<?php echo $product_main_cat->slug; ?>">
                                            <?php echo esc_html($product_main_cat->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div><!-- End .select-custom -->
                        <?php endif; ?>
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->

            <div class="header-dropdown-link">
                <?php if (is_user_logged_in()): ?>
                    <div class="account">
                        <a href="<?php echo site_url('/my-account/'); ?>" title="پروفایل من">
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                            <p>حساب کاربری</p>
                        </a>
                    </div><!-- End .compare-dropdown -->
                <?php endif; ?>
                <?php if (is_user_logged_in()) :
                    $active_wishlist = get_option('_tnm_settings_set_general');
                    if ($active_wishlist['wishlist_enable'] === 'yes') :
                        $user_id = get_current_user_id();
                        $wishlist_count = 0;

                        if ($user_id) {
                            global $wpdb;
                            $table = $wpdb->prefix . 'tns_wishlist';
                            $wishlist_count = $wpdb->get_var(
                                $wpdb->prepare("SELECT COUNT(*) FROM {$table} WHERE u_id = %d", $user_id)
                            );
                        } ?>
                        <div class="wishlist">
                            <a href="<?php echo site_url('wishlist'); ?>" title="لیست علاقه مندی">
                                <div class="icon">
                                    <i class="icon-heart-o"></i>
                                    <span class="wishlist-count badge"><?php echo esc_html($wishlist_count); ?></span>
                                </div>
                                <p>موردعلاقه</p>
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
                    </div>
                </div><!-- End .cart-dropdown -->
            </div>
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-middle -->