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
<div class="heading heading-center mb-3">
    <h2 class="title text-center">محصولات برتر</h2><!-- End .title -->

    <ul class="nav nav-pills justify-content-center" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab"
               role="tab" aria-controls="trending-all-tab" aria-selected="true">همه</a>
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
</div><!-- End .heading -->

<div class="tab-content tab-content-carousel">
    <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel"
         aria-labelledby="trending-all-link">
        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
             data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
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
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
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
            <div class="product product-7 text-center">
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
                             alt="<?php echo esc_attr($product_ally->get_name()); ?>"
                             class="product-image">
                        <?php $image_gallery = $product_ally->get_gallery_image_ids();
                        if (is_array($image_gallery) && !empty($image_gallery)) :
                        $image_gallery_url = wp_get_attachment_url($image_gallery[0]);?>
                        <img src="<?php echo esc_url($image_gallery_url); ?>"
                             alt="<?php echo esc_attr($product_ally->get_name()); ?>"
                             class="product-image-hover">
                    </a>
                    <?php endif; ?>

                    <div class="product-action">
                        <a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat text-center">
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
                    <h3 class="product-title text-center"><a href="<?php echo get_permalink($product_ally->get_id()); ?>"><?php echo $product_ally->get_name(); ?></a>
                    </h3>
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
                            <span class="old-price"><?php echo wc_price($product_ally->get_regular_price()); ?></span>
                        <?php else : ?>
                            <span class="new-price"><?php echo wc_price($product_ally->get_price()); ?></span>
                        <?php endif; ?>
                    </div><!-- End .product-price -->
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
        $product_cats = wc_get_products($args_cat_loop);
        ?>

        <div class="tab-pane p-0 fade"
             id="cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
             role="tabpanel"
             aria-labelledby="cat-<?php echo esc_attr($cat_product->slug); ?>-link">

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                 data-toggle="owl" data-owl-options='{
                "nav": false,
                "dots": true,
                "margin": 20,
                "loop": false,
                "rtl": true,
                "responsive": {
                    "0": {"items":2},
                    "480": {"items":2},
                    "768": {"items":3},
                    "992": {"items":4},
                    "1200": {"items":4,"nav": true,"dots": false}
                }
            }'>

                <?php foreach ($product_cats as $product_ally) :
                    $regular  = $product_ally->get_regular_price();
                    $sale     = $product_ally->get_sale_price();
                    $discount = Utility::tns_calculateDiscountPercentage($regular, $sale);
                    ?>

                    <div class="product product-7 text-center">
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
                                <?php $image_gallery = $product_ally->get_gallery_image_ids();
                                if (!empty($image_gallery)) :
                                    $image_gallery_url = wp_get_attachment_url($image_gallery[0]); ?>
                                    <img src="<?php echo esc_url($image_gallery_url); ?>"
                                         alt="<?php echo esc_attr($product_ally->get_name()); ?>"
                                         class="product-image-hover">
                                <?php endif; ?>
                            </a>

                            <div class="product-action">
                                <a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            </div>
                        </figure>

                        <div class="product-body">
                            <div class="product-cat text-center">
                                <?php
                                $terms = get_the_terms($product_ally->get_id(), 'product_cat');
                                if (!empty($terms) && !is_wp_error($terms)) {
                                    echo implode(', ', array_map(function ($term) {
                                        return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                    }, $terms));
                                }
                                ?>
                            </div>
                            <h3 class="product-title text-center">
                                <a href="<?php echo esc_url(get_permalink($product_ally->get_id())); ?>">
                                    <?php echo esc_html($product_ally->get_name()); ?>
                                </a>
                            </h3>
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
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div><!-- End .owl-carousel -->
        </div><!-- End .tab-pane -->
    <?php endforeach; ?>
</div><!-- End .tab-content -->
<?php else : ?>
    <div class="heading heading-center mb-3">
        <h2 class="title text-center">محصولات برتر</h2><!-- End .title -->

        <ul class="nav nav-pills justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab"
                   role="tab" aria-controls="trending-all-tab" aria-selected="true">همه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="trending-women-link" data-toggle="tab" href="#trending-women-tab"
                   role="tab" aria-controls="trending-women-tab" aria-selected="false">زنانه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="trending-men-link" data-toggle="tab" href="#trending-men-tab"
                   role="tab" aria-controls="trending-men-tab" aria-selected="false">مردانه</a>
            </li>
        </ul>
    </div><!-- End .heading -->

    <div class="tab-content tab-content-carousel">
        <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel"
             aria-labelledby="trending-all-link">
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                 data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
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
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            19,000 تومان
                        </div><!-- End .product-price -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-thumb.jpg"'?>
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-2-thumb.jpg"'?>
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-3-thumb.jpg"'?>
                                     alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-2-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-2-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            24,000 تومان
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-sale">فروش ویژه</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-3-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-3-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">7,000 تومان</span>
                            <span class="old-price">12,000</span>
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-4-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-4-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            17,000 تومان
                        </div><!-- End .product-price -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="assets/images/demos/demo-6/products/product-4-thumb.jpg"
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-4-2-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">ژاکت جین</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            19,000 تومان
                        </div><!-- End .product-price -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-2-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-3-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
        <div class="tab-pane p-0 fade" id="trending-women-tab" role="tabpanel"
             aria-labelledby="trending-women-link">
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                 data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items":0
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-sale">فروش ویژه</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-3-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-3-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">7,000 تومان</span>
                            <span class="old-price">12,000</span>
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-4-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-4-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            17,000 تومان
                        </div><!-- End .product-price -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-4-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-4-2-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            19,000 تومان
                        </div><!-- End .product-price -->

                        <div class="product-nav product-nav-thumbs">
                            <a href="#" class="active">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-2-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                            <a href="#">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-1-3-thumb.jpg'?>"
                                     alt="product desc">
                            </a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->

        <div class="tab-pane p-0 fade" id="trending-men-tab" role="tabpanel"
             aria-labelledby="trending-men-link">
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                 data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items":0
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        <span class="product-label label-sale">فروش ویژه</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-3-1.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-3-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">لباس</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">7,000 تومان</span>
                            <span class="old-price">12,000</span>
                        </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->
            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
    </div><!-- End .tab-content -->
<?php endif; ?>
