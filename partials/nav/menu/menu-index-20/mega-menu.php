<div class="header-bottom sticky-header">
    <div class="container">
        <div style="background-color: #333; display: flex; width: 100%;">
            <div class="header-left">
                <div class="dropdown category-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" data-display="static"
                       title="دسته بندی فروشگاه">
                        دسته بندی های فروشگاه
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <?php
                            $exclude_category = get_option('_tnm_settings_set_general');
                            $args = [
                                'taxonomy'   => 'product_cat',
                                'hide_empty' => false,
                                'exclude'    => $exclude_category['exclude_category_id'],
                                'parent'     => 0,
                                'orderby'    => 'id',
                                'order'      => 'ASC'
                            ];
                            $product_main_cats = get_categories( $args );

                            if ($product_main_cats): ?>
                            <ul class="menu-vertical sf-arrows">
                                <?php  foreach ($product_main_cats as $product_main_cat):
                                $main_category_link = get_term_link($product_main_cat);?>
                                <li class="item-lead"><a href="<?php echo  esc_url($main_category_link); ?>"><?php echo esc_html($product_main_cat->name); ?></a></li>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <li class="item-lead"><a href="<?php echo  home_url('/wp-admin/edit-tags.php?taxonomy=product_cat&post_type=product') ?>">دسته بندی محصولات خود را ایجاد کنید!</a></li>
                            <?php endif; ?>
                            </ul><!-- End .menu-vertical -->
                        </nav><!-- End .side-nav -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .category-dropdown -->
            </div><!-- End .header-left -->

            <div class="header-center">

                <nav class="main-nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'container' => false,
                        'menu_class' => 'menu sf-arrows',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'fallback_cb' => function() {
                            echo '<ul class="menu sf-arrows"><li class="megamenu-container active"><a href="#">منو تنظیم نشده است</a></li></ul>';
                        },
                        'depth' => 3,
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    )); ?>
                </nav><!-- End .main-nav -->
            </div>

            <div class="header-right">
                <i class="la la-lightbulb-o"></i>
                <a href="<?php echo site_url('/shop/?on_sale=1'); ?>"><p><span class="highlight">محصولات تخفیف‌دار را همین حالا ببینید</span></p></a>
            </div>
        </div>
    </div><!-- End .container -->
</div><!-- End .header-bottom -->