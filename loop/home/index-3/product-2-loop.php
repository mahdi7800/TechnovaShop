<?php
$exclude = get_option('_tnm_settings_set_general')['exclude_category_id'];
$args_cat = [
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'exclude'    => $exclude,
    'parent'     => 0,
    'orderby'    => 'id',
    'order'      => 'ASC'
];
$cat_products = get_categories($args_cat);
if ($cat_products) : ?>
<div class="heading heading-flex mb-3">
    <div class="heading-left">
        <h2 class="title">محصولات ما</h2><!-- End .title -->
    </div><!-- End .heading-left -->

    <div class="heading-right">
        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="trending-all-link" data-toggle="tab"
                   href="#trending-all-tab" role="tab" aria-controls="trending-all-tab"
                   aria-selected="true">همه</a>
            </li>
            <?php foreach ($cat_products as $cat_product) : ?>
            <li class="nav-item">
                <a class="nav-link"
                   id="cat-<?php echo esc_attr($cat_product->slug); ?>-link"
                   data-toggle="tab"
                   href="#cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
                   role="tab"
                   aria-controls="cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
                   aria-selected="false">
                    <?php echo esc_html($cat_product->name); ?>
                </a>
            </li>
            <?php endforeach; ?>

        </ul>
    </div><!-- End .heading-right -->
</div><!-- End .heading -->

<div class="row">
    <div class="col-xl-5col d-none d-xl-block">
        <div class="banner">
            <a href="#">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/banners/banner-4.jpg'?>" alt="بنر">
            </a>
        </div><!-- End .banner -->
    </div><!-- End .col-xl-5col -->

    <div class="col-xl-4-5col">
        <div class="tab-content tab-content-carousel just-action-icons-sm">
            <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel"
                 aria-labelledby="trending-all-link">
                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                     data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
                    <?php
            $args_all = ['limit' => 8,
                'status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
                'stock_status' => 'instock',
                'tax_query' => [
                    [
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => ['bulk_purchase'],
                        'operator' => 'NOT IN'
                    ]
                ]
            ];
            $product_allies = wc_get_products($args_all);
            foreach ($product_allies as $product_ally) :
                $regular = $product_ally->get_regular_price();
                $sale = $product_ally->get_sale_price();
                $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
                    <div class="product product-2">
                        <figure class="product-media">
                            <?php if (!$product_ally->is_in_stock()) : ?>
                                <span class="product-label label-primary">ناموجود</span>
                            <?php endif; ?>
                            <?php if ($discount > 0) : ?>
                                <span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
                            <?php elseif ($product_ally->is_on_sale()) : ?>
                                <span class="product-label label-sale">فروش ویژه</span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($product_ally->get_permalink()); ?>">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url($product_ally->get_id())); ?>"
                                     alt="<?php echo esc_attr($product_ally->get_name()); ?>" class="product-image">
                            </a>

                            <div class="product-action-vertical">

                            </div><!-- End .product-action -->

                            <div class="product-action product-action-dark">
                                <a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>" class="btn-product btn-cart"
                                   title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                <a href="popup/quickView.html" class="btn-product btn-quickview"
                                   title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <?php
                                $terms = get_the_terms($product_ally->get_id(), 'product_cat');
                                if (!empty($terms) && !is_wp_error($terms)) {
                                    $term_links = array_map(function ($term) {
                                        return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                    }, $terms);
                                    echo implode(', ', $term_links);
                                }
                                ?>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="<?php echo get_permalink($product_ally->get_id()); ?>"><?php echo $product_ally->get_name(); ?></a></h3>
                            <!-- End .product-title -->
                            <div class="product-price">
                                <?php if ($product_ally->is_type('variable')) :
                                    $min_price = $product_ally->get_variation_price('min');
                                    $max_price = $product_ally->get_variation_price('max'); ?>
                                    <span class="new-price"><?php echo wc_price($min_price); ?></span>
                                    <?php if ($min_price != $max_price) : ?>
                                    <span class="new-price"><?php echo wc_price($max_price); ?></span>
                                <?php endif; ?>
                                <?php elseif ($product_ally->is_on_sale()) : ?>
                                    <span class="new-price"><?php echo wc_price($product_ally->get_sale_price()); ?></span>
                                    <del><span class="old-price"><?php echo wc_price($product_ally->get_regular_price()); ?></span></del>
                                <?php else : ?>
                                    <span class="new-price"><?php echo wc_price($product_ally->get_price()); ?></span>
                                <?php endif; ?>
                            </div><!-- End .product-price -->
                            <div class="ratings-container">
                                <?php
                                $avg = $product_ally->get_average_rating();
                                $count = $product_ally->get_rating_count();
                                ?>
                                <div class="ratings">
                                    <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
                                    <!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
                            </div><!-- End .rating-container -->
                    <?php if ($product_ally->is_type('variable')) :
                                $variations = $product_ally->get_available_variations(); ?>
                        <div class="product-nav product-nav-dots">
                             <?php foreach ($variations as $i => $var) :
                                if (!empty($var['attributes']['attribute_pa_color'])) : ?>
                                       <a href="#" class="<?php echo $i === 0 ? 'active' : ''; ?>"
                                        style="background: <?php echo esc_attr($var['attributes']['attribute_pa_color']); ?>">
                                         <span class="sr-only">نام رنگ</span>
                                       </a>
                                 <?php endif;
                              endforeach; ?>
                        </div><!-- End .product-nav -->
                    <?php endif ;?>
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
              <?php endforeach; ?>
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
    <?php foreach ($cat_products as $cat_product) : ?>
        <?php
        $args_cat_loop = [
            'limit'        => 8,
            'status'       => 'publish',
            'orderby'      => 'date',
            'order'        => 'DESC',
            'stock_status' => 'instock',
            'category'     => [$cat_product->slug],
        ];
        $product_cats = wc_get_products($args_cat_loop); ?>
            <div class="tab-pane p-0 fade"
                 id="cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
                 role="tabpanel"
                 aria-labelledby="cat-<?php echo esc_attr($cat_product->slug); ?>-link">
                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                     data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
        <?php foreach ($product_cats as $product_ally) :
            $regular  = $product_ally->get_regular_price();
            $sale     = $product_ally->get_sale_price();
            $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
                    <div class="product product-2">
                        <figure class="product-media">
                            <?php if (!$product_ally->is_in_stock()) : ?>
                                <span class="product-label label-primary">ناموجود</span>
                            <?php endif; ?>

                            <?php if ($discount > 0) : ?>
                                <span class="product-label label-circle label-sale">تخفیف <?php echo esc_html($discount); ?>%</span>
                            <?php elseif ($product_ally->is_on_sale()) : ?>
                                <span class="product-label label-sale">فروش ویژه</span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($product_ally->get_permalink()); ?>">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url($product_ally->get_id())); ?>"
                                     alt="<?php echo esc_attr($product_ally->get_name()); ?>"
                                     class="product-image">
                            </a>

                            <div class="product-action-vertical">

                            </div><!-- End .product-action -->

                            <div class="product-action product-action-dark">
                                <a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>" class="btn-product btn-cart"
                                   title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                <a href="<?php echo esc_url(get_permalink($product_ally->get_id())); ?>" class="btn-product icon-eye"
                                   title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <?php
                                $terms = get_the_terms($product_ally->get_id(), 'product_cat');
                                if (!empty($terms) && !is_wp_error($terms)) {
                                    echo implode(', ', array_map(function ($term) {
                                        return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                    }, $terms));
                                }
                                ?>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a href="<?php echo esc_url(get_permalink($product_ally->get_id())); ?>">
                                    <?php echo esc_html($product_ally->get_name()); ?> </a></h3><!-- End .product-title -->
                            <div class="product-price">
                                <?php if ($product_ally->is_type('variable')) :
                                    $min_price = $product_ally->get_variation_price('min');
                                    $max_price = $product_ally->get_variation_price('max'); ?>
                                    <span class="new-price"><?php echo wc_price($min_price); ?></span>
                                    <?php if ($min_price != $max_price) : ?>
                                    <span class="new-price"><?php echo wc_price($max_price); ?></span>
                                <?php endif; ?>
                                <?php elseif ($product_ally->is_on_sale()) : ?>
                                    <span class="new-price"><?php echo wc_price($product_ally->get_sale_price()); ?></span>
                                    <span class="old-price"><?php echo wc_price($product_ally->get_regular_price()); ?></span>
                                <?php else : ?>
                                    <span class="new-price"><?php echo wc_price($product_ally->get_price()); ?></span>
                                <?php endif; ?>
                            </div><!-- End .product-price -->
                            <div class="ratings-container">
                                <?php
                                $avg = $product_ally->get_average_rating();
                                $count = $product_ally->get_rating_count();
                                ?>
                                <div class="ratings">
                                    <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
                                    <!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
                            </div><!-- End .rating-container -->

                            <?php if ($product_ally->is_type('variable')) :
                                $variations = $product_ally->get_available_variations(); ?>
                                <div class="product-nav product-nav-dots">
                                    <?php foreach ($variations as $i => $var) :
                                        if (!empty($var['attributes']['attribute_pa_color'])) : ?>
                                            <a href="#" class="<?php echo $i === 0 ? 'active' : ''; ?>"
                                               style="background: <?php echo esc_attr($var['attributes']['attribute_pa_color']); ?>">
                                                <span class="sr-only">نام رنگ</span>
                                            </a>
                                        <?php endif;
                                    endforeach; ?>
                                </div><!-- End .product-nav -->
                            <?php endif ;?>
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
        <?php endforeach; ?>
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
        <?php endforeach; ?>

        </div><!-- End .tab-content -->

    </div><!-- End .col-xl-4-5col -->
</div><!-- End .row -->

<?php else : ?>
    <div class="heading heading-flex mb-3">
        <div class="heading-left">
            <h2 class="title">محصولات ما</h2><!-- End .title -->
        </div><!-- End .heading-left -->

        <div class="heading-right">
            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="trending-all-link" data-toggle="tab"
                       href="#trending-all-tab" role="tab" aria-controls="trending-all-tab"
                       aria-selected="true">همه</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="trending-tv-link" data-toggle="tab" href="#trending-tv-tab"
                       role="tab" aria-controls="trending-tv-tab" aria-selected="false">TV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-computers-link" data-toggle="tab"
                       href="#trending-computers-tab" role="tab" aria-controls="trending-computers-tab"
                       aria-selected="false">کامپیوتر</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-phones-link" data-toggle="tab"
                       href="#trending-phones-tab" role="tab" aria-controls="trending-phones-tab"
                       aria-selected="false">موبایل و تبلت</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-watches-link" data-toggle="tab"
                       href="#trending-watches-tab" role="tab" aria-controls="trending-watches-tab"
                       aria-selected="false">ساعت هوشمند</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="trending-acc-link" data-toggle="tab" href="#trending-acc-tab"
                       role="tab" aria-controls="trending-acc-tab" aria-selected="false">لوازم جانبی</a>
                </li>
            </ul>
        </div><!-- End .heading-right -->
    </div><!-- End .heading -->

    <div class="row">
        <div class="col-xl-5col d-none d-xl-block">
            <div class="banner">
                <a href="#">
                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/banners/banner-4.jpg'?>" alt="بنر">
                </a>
            </div><!-- End .banner -->
        </div><!-- End .col-xl-5col -->

        <div class="col-xl-4-5col">
            <div class="tab-content tab-content-carousel just-action-icons-sm">
                <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel"
                     aria-labelledby="trending-all-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-7.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">هدفون و هندزفری</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لطفا محصولات خود را وارد کنید!!</a></h3>
                                <!-- End .product-title -->
                                <div class="product-price">
                                    159,999 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #69b4ff;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span
                                                class="sr-only">نام رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-8.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">بازی ویدئویی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لطفا محصولات خود را وارد کنید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    1,250,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 6 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">جدید</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-9.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">ساعت هوشمند</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لطفا محصولات خود را وارد کنید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    420,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #edd2c8;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span
                                                class="sr-only">نام رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <span class="product-label label-circle label-sale">فروش ویژه</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-10.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تلویزیون و سینما خانگی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لطفا محصولات خود را وارد کنید!!</a>
                                </h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">2,320,999 تومان</span>
                                    <span class="old-price">2,850,000 تومان</span>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 10 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-15.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تلویزیون و سینما خانگی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لطفا محصولات خود را وارد کنید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    1,220,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 5 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لطفا محصولات خود را وارد کنید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    2,860,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-tv-tab" role="tabpanel"
                     aria-labelledby="trending-tv-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">جدید</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-13.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تب لت</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Apple - 11 Inch iPad Pro
                                        with Wi-Fi 256GB </a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    890,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #edd2c8;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span
                                                class="sr-only">نام رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-12.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لوازم صوتی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Bose - SoundLink Bluetooth
                                        Speaker</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    170,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 6 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <span class="product-label label-circle label-sale">فروش ویژه</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-14.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">موبایل</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Google - Pixel 3 XL
                                        128GB</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">1,890,000 تومان</span>
                                    <span class="old-price">2,250,000 تومان</span>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 10 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #edd2c8;"><span
                                                class="sr-only">نام رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="assets/images/demos/demo-3/products/product-15.jpg"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تلویزیون و سینما خانگی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">تلویزیون سامسونگ 55
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    2,870,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 5 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لپ تاپ مک بوک پرو - 13
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    4,380,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-computers-tab" role="tabpanel"
                     aria-labelledby="trending-computers-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-15.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تلویزیون و سینما خانگی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">تلویزیون سامسونگ 55
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    2,100,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 5 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لپ تاپ مک بوک پرو - 13
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    3,320,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">جدید</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-13.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تب لت</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Apple - 11 Inch iPad Pro
                                        with Wi-Fi 256GB </a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    780,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #edd2c8;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span
                                                class="sr-only">نام رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-12.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لوازم صوتی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Bose - SoundLink Bluetooth
                                        Speaker</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    290,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 6 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <span class="product-label label-circle label-sale">فروش ویژه</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-14.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">موبایل</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Google - Pixel 3 XL
                                        128GB</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">1,350,000 تومان</span>
                                    <span class="old-price">1,540,000 تومان</span>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 10 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #edd2c8;"><span
                                                class="sr-only">نام رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-phones-tab" role="tabpanel"
                     aria-labelledby="trending-phones-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لپ تاپ مک بوک پرو - 13
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    1,970,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-12.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لوازم صوتی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Bose - SoundLink Bluetooth
                                        Speaker</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    120,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 6 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">جدید</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-13.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تب لت</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Apple - 11 Inch iPad Pro
                                        with Wi-Fi 256GB </a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    540,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #edd2c8;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span
                                                class="sr-only">نام رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-15.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تلویزیون و سینما خانگی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">تلویزیون سامسونگ 55
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    1,900,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 5 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لپ تاپ مک بوک پرو - 13
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    2,490,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <span class="product-label label-circle label-sale">فروش ویژه</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-14.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title=" "><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">موبایل</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Google - Pixel 3 XL
                                        128GB</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">2,430,000 تومان</span>
                                    <span class="old-price">2,850,000 تومان</span>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 10 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #edd2c8;"><span
                                                class="sr-only">نام رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-watches-tab" role="tabpanel"
                     aria-labelledby="trending-watches-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <span class="product-label label-circle label-sale">فروش ویژه</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-14.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">موبایل</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Google - Pixel 3 XL
                                        128GB</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">2,430,000 تومان</span>
                                    <span class="old-price">2,850,000 تومان</span>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 10 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #edd2c8;"><span
                                                class="sr-only">نام رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">لپ تاپ مک بوک پرو - 13
                                        اینچ</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    3,850,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-12.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لوازم صوتی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    560,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 6 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">جدید</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-13.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تب لت</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    1,260,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #edd2c8;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span
                                                class="sr-only">نام رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-acc-tab" role="tabpanel"
                     aria-labelledby="trending-acc-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                        "nav": true,
                                        "dots": false,
                                        "margin": 20,
                                        "loop": false,
                                        "rtl": true,
                            "responsive": {
                                            "0": {
                                                "items":2
                                            },
                                            "480": {
                                                "items":2
                                            },
                                            "768": {
                                                "items":3
                                            },
                                            "992": {
                                                "items":4
                                            }
                                        }
                                    }'>
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    3,850,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-15.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تلویزیون و سینما خانگی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    1,260,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 5 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-top">برتر</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لپ تاپ</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    3,850,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 100%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-12.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">لوازم صوتی</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    560,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 6 بازدید )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->

                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">جدید</span>
                                <a href="product.html">
                                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-13.jpg'?>"
                                         alt="تصویر محصول" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#"
                                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                                </div><!-- End .product-action -->

                                <div class="product-action product-action-dark">
                                    <a href="#" class="btn-product btn-cart"
                                       title="افزودن به سبد خرید"><span>افزودن
                                                        به سبد خرید</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                                       title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">تب لت</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    1,260,000 تومان
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 بازدید )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" style="background: #edd2c8;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">نام
                                                        رنگ</span></a>
                                    <a href="#" class="active" style="background: #333333;"><span
                                                class="sr-only">نام رنگ</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .col-xl-4-5col -->
    </div><!-- End .row -->
<?php endif; ?>