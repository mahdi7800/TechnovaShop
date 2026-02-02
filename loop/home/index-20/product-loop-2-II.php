<?php
$args = [
    'limit' => 5,
    'orderby' => 'rating',
    'order' => 'DESC',
];
$the_best_products = wc_get_products($args);
if ($the_best_products) : ?>

        <?php foreach ($the_best_products as $product) :
            $regular = $product->get_regular_price();
            $sale = $product->get_sale_price();
            $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
        <div class="product">
            <figure class="product-media">
                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                         alt="<?php echo esc_attr($product->get_name()); ?>" class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    <?php $author = get_post_meta($product->get_id(), '_tns_book_authors', true);
                    if ( !empty($author) ) : ?>
                        <div class="product-cat" dir="rtl">
                            نویسنده : <a href="#"><?php echo esc_html($author); ?></a>
                        </div><!-- End .product-cat -->
                    <?php else : ?>
                        <div class="product-cat" dir="rtl">
                            <?php
                            $terms = get_the_terms($product->get_id(), 'product_cat');
                            if (!empty($terms) && !is_wp_error($terms)) {
                                $term_links = array_map(function ($term) {
                                    return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                                }, $terms);
                                echo implode(', ', $term_links);
                            }
                            ?>

                        </div><!-- End .product-cat -->
                    <?php endif; ?>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    <?php if ($product->is_type('variable')) :
                        $min_price = $product->get_variation_price('min');
                        $max_price = $product->get_variation_price('max'); ?>
                        <span class="new-price"><?php echo wc_price($min_price); ?></span>
                        <?php if ($min_price != $max_price) : ?>
                        <span class="new-price"><?php echo wc_price($max_price); ?></span>
                    <?php endif; ?>
                    <?php elseif ($product->is_on_sale()) : ?>
                        <span class="new-price"><?php echo wc_price($product->get_sale_price()); ?></span>
                        <del><span class="old-price"><?php echo wc_price($product->get_regular_price()); ?></span></del>
                    <?php else : ?>
                        <span class="new-price"><?php echo wc_price($product->get_price()); ?></span>
                    <?php endif; ?>
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <?php
                        $avg = $product->get_average_rating();
                        $count = $product->get_rating_count();
                        ?>
                        <div class="ratings">
                            <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( <?php echo esc_html($count); ?> دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn-product btn-cart"><span>افزودن به سبد
                                                        خرید</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->
        <?php endforeach; ?>
        <?php else : ?>
        <div class="product">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-6.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">شاهدین جنایت: نسخه اختصاصی</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    24,000 تومان
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 5 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد
                                                        خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                        مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-7.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">ماه : تاریخچه ای برای آینده
                    </a></h3><!-- End .product-title -->
                <div class="product-price">
                    16,000 تومان
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 80%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 5 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد
                                                        خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                        مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-8.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">سخت هل داده شده: داستانی
                        تخیلی</a></h3><!-- End .product-title -->
                <div class="product-price">
                    12,000 تومان
                </div><!-- End .product-price -->

                <div class="product-footer">
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 100%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 4 دیدگاه )</span>
                    </div><!-- End .rating-container -->
                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد
                                                        خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                        مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->

        <div class="product">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-9.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat" dir="rtl">
                    نویسنده : <a href="#">جان گری</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title"><a href="product.html">این دروغ شما را خواهد کشت</a>
                </h3>
                <!-- End .product-title -->
                <div class="product-price">
                    7,000 تومان
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
                        <a href="#" class="btn-product btn-cart"><span>افزودن به سبد
                                                        خرید</span></a>
                        <a href="#" class="btn-product btn-wishlist"><span>افزودن به لیست علاقه
                                                        مندی</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-footer -->
            </div><!-- End .product-body -->
        </div><!-- End .product -->
        <?php endif; ?>
