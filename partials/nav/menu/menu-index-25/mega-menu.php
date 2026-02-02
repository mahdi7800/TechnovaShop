<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
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

                    if ($product_main_cats):
                        foreach ($product_main_cats as $product_main_cat):
                            $main_category_link = get_term_link($product_main_cat);?>
                            <li>

                                <a href="<?php echo  esc_url($main_category_link); ?>" class="sf-with-ul"><?php echo esc_html($product_main_cat->name) ?></a>

                                <div class="megamenu megamenu-sm">
                                    <div class="row no-gutters">
                                        <div class="col-md-6">
                                            <div class="menu-col">
                                                <div class="menu-title">دسته‌بندی‌های مرتبط</div><!-- End .menu-title -->
                                                <?php
                                                $child_args = [
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => false,
                                                    'parent' => $product_main_cat->term_id,
                                                    'orderby' => 'id',
                                                    'order' => 'ASC'
                                                ];
                                                $product_child_cats = get_categories($child_args); ?>
                                                <?php if ($product_child_cats): ?>
                                                    <ul>
                                                        <?php foreach ($product_child_cats as $product_child_cat):
                                                            $child_category_link = get_term_link($product_child_cat); ?>
                                                            <li><a href="<?php echo  esc_url($child_category_link);?>"><?php echo esc_html($product_child_cat->name); ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php else: ?>
                                                    <div class="alert alert-info">زیر دسته ، دسته اصلی رو انتخاب کن!!</div>
                                                <?php endif; ?>
                                            </div><!-- End .menu-col -->
                                        </div><!-- End .col-md-6 -->

                                        <div class="col-md-6">
                                            <div class="banner banner-overlay">
                                                <?php
                                                // بررسی وجود تصویر برای دسته‌بندی
                                                $thumbnail_id = get_term_meta($product_main_cat->term_id, 'thumbnail_id', true);
                                                $image = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : TNM_URL . '/assets/images/menu/banner-2.jpg';
                                                ?>

                                                <a href="<?php echo  esc_url($child_category_link);?>">
                                                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($product_main_cat->name); ?>">

                                                    <div class="banner-content banner-content-bottom">
                                                        <div class="banner-title text-white">محصولات<br><span><strong><?php echo $product_main_cat->name; ?></strong></span></div>
                                                        <!-- End .banner-title -->
                                                    </div><!-- End .banner-content -->
                                                </a>
                                            </div><!-- End .banner -->
                                        </div><!-- End .col-md-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .megamenu megamenu-sm -->
                            </li>
                        <?php endforeach; ?>
                     <?php else : ?>
                     <div class="alert alert-info">مگا منو خود رو از طریق دسته بندی های محصول مگا منو خود را ایجاد کنید!</div>
                    <?php endif; ?>
                </ul><!-- End .menu -->
            </nav><!-- End .main-nav -->

            <button class="mobile-menu-toggler">
                <span class="sr-only">فهرست</span>
                <i class="icon-bars"></i>
            </button>
        </div><!-- End .header-left -->

        <div class="header-right">
            <i class="la la-lightbulb-o"></i>
            <p>محصولات تخفیف‌دار را همین حالا ببینید</span></p>
        </div>
    </div><!-- End .container -->
</div><!-- End .header-bottom -->