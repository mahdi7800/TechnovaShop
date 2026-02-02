<?php
$args = [
    'limit' => 7,
    'status' => 'publish',
    'meta_key' => '_tns_show_product_expert',
    'meta_value' => 1,
    'orderby' => 'date',
    'order' => 'DESC'
];
$the_queryes = wc_get_products($args);
if ($the_queryes) : ?>
    <div class="owl-carousel carousel-equal-height owl-simple" data-toggle="owl" data-owl-options='{
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
                                        "items":5
                                    },
                                    "1440": {
                                        "items":6
                                    }
                                }
                            }'>
    <?php foreach ($the_queryes as $the_query) :
        $regular = $the_query->get_regular_price();
        $sale = $the_query->get_sale_price();
        $discount = Utility::tns_calculateDiscountPercentage($regular, $sale);
        ?>
        <div class="product">
            <?php if (!$the_query->is_in_stock()) : ?>
                <span class="product-label label-primary">ناموجود</span>
            <?php endif; ?>

            <?php if ($discount > 0) : ?>
                <span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
            <?php elseif ($the_query->is_on_sale()) : ?>
                <span class="product-label label-sale">فروش ویژه</span>
            <?php endif; ?>
            <figure class="product-media">
                <a href="<?php echo get_permalink($the_query->get_id()); ?>">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($the_query->get_id())); ?>"
                         alt="<?php echo esc_attr($the_query->get_name()); ?>"
                         class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <?php $author = get_post_meta($the_query->get_id(), '_tns_book_authors', true);
                if ( !empty($author) ) : ?>
                    <div class="product-cat" dir="rtl">
                        نویسنده : <a href="#"><?php echo esc_html($author); ?></a>
                    </div><!-- End .product-cat -->
                <?php else : ?>
                    <div class="product-cat" dir="rtl">
                        <?php
                        $terms = get_the_terms($the_query->get_id(), 'product_cat');
                        if (!empty($terms) && !is_wp_error($terms)) {
                            $term_links = array_map(function ($term) {
                                return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                            }, $terms);
                            echo implode(', ', $term_links);
                        }
                        ?>

                    </div><!-- End .product-cat -->
                <?php endif; ?>
                <h3 class="product-title"><a
                            href="<?php echo esc_url($the_query->get_permalink()); ?>"><?php echo esc_html($the_query->get_name()); ?></a>
                </h3>
                <!-- End .product-title -->
                <div class="product-price">
                    <?php if ($the_query->is_type('variable')) :
                        $prices = $the_query->get_variation_prices(true);
                        $min_price = current($prices['price']);
                        $max_price = end($prices['price']);
                        ?>
                        <span class="new-price"><?php echo wc_price($min_price); ?></span>
                        <?php if ($min_price !== $max_price) : ?>
                        <span class="new-price"><?php echo wc_price($max_price); ?></span>
                    <?php endif; ?>
                    <?php elseif ($the_query->is_on_sale()) : ?>
                        <span class="new-price"><?php echo wc_price($sale); ?></span>
                        <span class="old-price"><?php echo wc_price($regular); ?></span>
                    <?php else : ?>
                        <span class="new-price"><?php echo wc_price($the_query->get_price()); ?></span>
                    <?php endif; ?>
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <?php
                    $avg = $the_query->get_average_rating();
                    $count = $the_query->get_rating_count();
                    ?>
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( <?php echo esc_html($count); ?> دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="<?php echo esc_url($the_query->add_to_cart_url()); ?>"
                           class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

    <?php endforeach; ?>
    </div><!-- End .owl-carousel -->
<?php else : ?>
    <div class="owl-carousel carousel-equal-height owl-simple" data-toggle="owl" data-owl-options='{
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
                                        "items":5
                                    },
                                    "1440": {
                                        "items":6
                                    }
                                }
                            }'>
        <div class="product">
            <span class="product-label label-sale">فروش ویژه</span>
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-20/products/product-11.jpg' ?>"
                         alt="تصویر محصول"
                         class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">سکوت دختران</a></h3>
                <!-- End .product-title -->
                <div class="product-price">
                    <span class="new-price">6,000 تومان</span>
                    <span class="old-price">90,000</span>
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 100%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 7 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-20/products/product-12.jpg' ?>"
                         alt="تصویر محصول"
                         class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">تو متوجهش شدی</a></h3>
                <!-- End .product-title -->
                <div class="product-price">
                    7,000 تومان
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 6 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-20/products/product-1.jpg' ?>"
                         alt="تصویر محصول"
                         class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">کتابدار <br>آشویتس</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    10,000 تومان
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 0%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 0 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <span class="product-label label-sale">فروش ویژه</span>
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-20/products/product-14.jpg' ?>"
                         alt="تصویر محصول"
                         class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">سرزمین پول: چرا اکنون دزدان و
                        کلاهبرداران جکومت می کنند ...</a></h3><!-- End .product-title -->
                <div class="product-price">
                    <span class="new-price">7,000 تومان</span>
                    <span class="old-price">12,000</span>
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 100%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 13 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-20/products/product-2.jpg' ?>"
                         alt="تصویر محصول"
                         class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">این دردناک است: خاطرات مخفی یک
                        انسان</a></h3><!-- End .product-title -->
                <div class="product-price">
                    12,000 تومان
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 4 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <span class="product-label label-sale">فروش ویژه</span>
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-20/products/product-11.jpg' ?>"
                         alt="تصویر محصول"
                         class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">سکوت دختران</a></h3>
                <!-- End .product-title -->
                <div class="product-price">
                    <span class="new-price">6,000 تومان</span>
                    <span class="old-price">90,000</span>
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 100%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 7 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->
    </div>
<?php endif; ?>