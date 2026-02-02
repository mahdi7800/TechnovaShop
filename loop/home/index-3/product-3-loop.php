<?php
$args = [
    'limit' => 8,
    'status' => 'publish',
    'meta_key' => '_tns_check_popular',
    'meta_value' => 1,
    'orderby' => 'date',
    'order' => 'DESC'
];
$the_queryes = wc_get_products($args);
if ($the_queryes) : ?>
<div class="tab-content tab-content-carousel just-action-icons-sm">
    <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel"
         aria-labelledby="top-all-link">
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
             data-owl-options='{
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
                                    },
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>
            <?php foreach ($the_queryes as $the_query) :
                $regular = $the_query->get_regular_price();
                $sale = $the_query->get_sale_price();
                $discount = Utility::tns_calculateDiscountPercentage($regular, $sale);
                ?>
            <div class="product product-2">
                <figure class="product-media">
                    <?php if (!$the_query->is_in_stock()) : ?>
                        <span class="product-label label-primary">ناموجود</span>
                    <?php endif; ?>

                    <?php if ($discount > 0) : ?>
                        <span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
                    <?php elseif ($the_query->is_on_sale()) : ?>
                        <span class="product-label label-sale">فروش ویژه</span>
                    <?php endif; ?>
                    <a href="<?php echo get_permalink($the_query->get_id()); ?>">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($the_query->get_id())); ?>"
                             alt="<?php echo esc_attr($the_query->get_name()); ?>"
                             class="product-image">
                    </a>


                    <div class="product-action product-action-dark">
                        <a href="<?php echo esc_url($the_query->add_to_cart_url()); ?>" class="btn-product btn-cart" title="افزودن به سبد خرید"><span>افزودن
                                                به
                                                سبد خرید</span></a>
                        <a href="<?php echo esc_url($the_query->get_permalink()); ?>" class="btn-product icon-eye"
                           title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <?php
                        $terms = get_the_terms($the_query->get_id(), 'product_cat');
                        if (!is_wp_error($terms) && !empty($terms)) :
                            echo implode(', ', array_map(function($term) {
                                return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                            }, $terms));
                        endif;
                        ?>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="<?php echo esc_url($the_query->get_permalink()); ?>"><?php echo esc_html($the_query->get_name()); ?></a>
                    </h3><!-- End .product-title -->
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
                    <div class="ratings-container">
                        <?php
                        $avg = $the_query->get_average_rating();
                        $count = $the_query->get_rating_count();
                        ?>
                        <div class="ratings">
                            <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
                            <!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->
            <?php endforeach; ?>
        </div><!-- End .owl-carousel -->
    </div><!-- .End .tab-pane -->
</div>
<?php else : ?>
<div class="tab-content tab-content-carousel just-action-icons-sm">
    <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel"
         aria-labelledby="top-all-link">
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
             data-owl-options='{
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
                                    },
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>
            <div class="product product-2">
                <figure class="product-media">
                    <span class="product-label label-circle label-top">برتر</span>
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-11.jpg'?>" alt="تصویر محصول"
                             class="product-image">
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
                    </div><!-- End .product-action -->

                    <div class="product-action product-action-dark">
                        <a href="#" class="btn-product btn-cart" title="افزودن به سبد خرید"><span>افزودن
                                                به
                                                سبد خرید</span></a>
                        <a href="popup/quickView.html" class="btn-product btn-quickview"
                           title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="#">لپ تاپ</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a>
                    </h3><!-- End .product-title -->
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
        </div><!-- End .owl-carousel -->
    </div><!-- .End .tab-pane -->
</div><!-- End .tab-content -->
<?php endif; ?>