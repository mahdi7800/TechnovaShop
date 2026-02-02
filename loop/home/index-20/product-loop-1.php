<?php
$args = [
    'limit' => 6,
    'status' => 'publish',
    'meta_key' => '_tns_check_popular',
    'meta_value' => 1,
    'orderby' => 'date',
    'order' => 'DESC'
];
$the_queryes = wc_get_products($args);
if (!empty($the_queryes)) : ?>

    <?php foreach ($the_queryes as $product) :
        $regular = $product->get_regular_price();
        $sale = $product->get_sale_price();
        $discount = Utility::tns_calculateDiscountPercentage($regular, $sale);
        ?>
        <div class="product">
            <?php if (!$product->is_in_stock()) : ?>
                <span class="product-label label-primary">ناموجود</span>
            <?php endif; ?>

            <?php if ($discount > 0) : ?>
                <span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
            <?php elseif ($product->is_on_sale()) : ?>
                <span class="product-label label-sale">فروش ویژه</span>
            <?php endif; ?>
            <figure class="product-media">
                <a href="<?php echo get_permalink($product->get_id()); ?>">
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                         alt="<?php echo esc_attr($product->get_name()); ?>" class="product-image">
                </a>
            </figure><!-- End .product-media -->

            <div class="product-body">
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
                <h3 class="product-title"><a href="<?php echo get_permalink($product->get_id()) ?>"><?php echo $product->get_name(); ?></a></h3>
                <!-- End .product-title -->
                <div class="product-price">
                    <?php if ( $product->is_type('variable')) :
                        $prices =  $product->get_variation_prices(true);
                        $min_price = current($prices['price']);
                        $max_price = end($prices['price']);
                        ?>
                        <span class="new-price"><?php echo wc_price($min_price); ?></span>
                        <?php if ($min_price !== $max_price) : ?>
                        <span class="new-price"><?php echo wc_price($max_price); ?></span>
                    <?php endif; ?>
                    <?php elseif ( $product->is_on_sale()) : ?>
                        <span class="new-price"><?php echo wc_price($sale); ?></span>
                        <span class="old-price"><?php echo wc_price($regular); ?></span>
                    <?php else : ?>
                        <span class="new-price"><?php echo wc_price( $product->get_price()); ?></span>
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
    <?php endforeach ?>
    <?php else: ?>
    <div class="product">
        <span class="product-label label-sale">فروش ویژه</span>
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-1.jpg'?>"
                     alt="تصویر محصول" class="product-image">
            </a>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat" dir="rtl">
                نویسنده : <a href="#">مایکل گری</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="product.html">آزاد شدن</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                <span class="new-price">19,000 تومان</span>
                <span class="old-price">32,000</span>
            </div><!-- End .product-price -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 80%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 10 دیدگاه )</span>
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
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-2.jpg'?>"
                     alt="تصویر محصول" class="product-image">
            </a>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat" dir="rtl">
                نویسنده : <a href="#">جوردن پترسون</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="product.html">وکیل دادگستری مخفی : داستان های
                    <br>قانون و چگونگی آن ...</a></h3><!-- End .product-title -->
            <div class="product-price">
                17,000 تومان
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
                    <a href="#" class="btn-product btn-cart"><span>افزودن به سبد
                                                        خرید</span></a>
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
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-3.jpg'?>"
                     alt="تصویر محصول" class="product-image">
            </a>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat" dir="rtl">
                نویسنده : <a href="#">راشل ریپینکات</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="product.html">فاصله 5 فوت</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                <span class="new-price">14,000 تومان</span>
                <span class="old-price">18,000</span>
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
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-4.jpg'?>"
                     alt="تصویر محصول" class="product-image">
            </a>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat" dir="rtl">
                نویسنده : <a href="#">کارن مک مانوس </a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="product.html">یک از ما دروغ می گوید</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                17,000 تومان
            </div><!-- End .product-price -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 100%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 10 دیدگاه )</span>
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
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-5.jpg'?>"
                     alt="تصویر محصول" class="product-image">
            </a>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat" dir="rtl">
                نویسنده : <a href="#">مت هایگ</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="product.html">چگونه زمان را متوقف کنیم</a>
            </h3>
            <!-- End .product-title -->
            <div class="product-price">
                11,000 تومان
            </div><!-- End .product-price -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 100%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 10 دیدگاه )</span>
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
                        <div class="ratings-val" style="width: 100%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 10 دیدگاه )</span>
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
<?php endif ?>




