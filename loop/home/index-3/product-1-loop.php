
<ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="products-featured-link" data-toggle="tab"
           href="#products-featured-tab" role="tab" aria-controls="products-featured-tab"
           aria-selected="true">برترین محصولات</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="products-sale-link" data-toggle="tab" href="#products-sale-tab"
           role="tab" aria-controls="products-sale-tab" aria-selected="false">بیشترین فروش</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="products-top-link" data-toggle="tab" href="#products-top-tab" role="tab"
           aria-controls="products-top-tab" aria-selected="false">بالاترین امتیاز</a>
    </li>
</ul>

<div class="tab-content tab-content-carousel">
    <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel"
         aria-labelledby="products-featured-link">
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
             data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true, 
                            "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>
            <?php
            $args = [
                'limit' => 8,
                'orderby' => 'date',
                'order' => 'DESC'
            ];
            $the_query_best_products = wc_get_products($args);
            if ($the_query_best_products) :
            foreach ($the_query_best_products as $product) :
                $regular = $product->get_regular_price();
                $sale = $product->get_sale_price();
                $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
            <div class="product product-2">

                <figure class="product-media">
                    <?php if (!$product->is_in_stock()) : ?>
                        <span class="product-label label-primary">ناموجود</span>
                    <?php endif; ?>
                    <?php if ($discount > 0) : ?>
                        <span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
                    <?php elseif ($product->is_on_sale()) : ?>
                        <span class="product-label label-sale">فروش ویژه</span>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($product->get_permalink()); ?>">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                             alt="<?php echo esc_attr($product->get_name()); ?>"
                             class="product-image">
                    </a>

                    <div class="product-action product-action-dark">
                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn-product btn-cart" title="افزودن به سبد خرید"><span>افزودن
                                                به
                                                سبد خرید</span></a>
                        <a href="<?php echo esc_url($product->get_permalink()); ?>" class="btn-product icon-eye"
                           title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
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
                    <h3 class="product-title"><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3><!-- End .product-title -->
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
                    <div class="ratings-container">
                        <?php
                        $avg = $product->get_average_rating();
                        $count = $product->get_rating_count();
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
            <?php else : ?>
            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-1.jpg'?>" alt="تصویر محصول"
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
                        <a href="#">دوربین فیلمبرداری</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        349,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <span class="product-label label-circle label-new">جدید</span>
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-2.jpg'?>" alt="تصویر محصول"
                             class="product-image">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-2-2.jpg'?>" alt="تصویر محصول"
                             class="product-image-hover">
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
                        <a href="#">ساعت هوشمند</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        214,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 0 بازدید )</span>
                    </div><!-- End .rating-container -->

                    <div class="product-nav product-nav-dots">
                        <a href="#" class="active" style="background: #e2e2e2;"><span
                                    class="sr-only">نام رنگ</span></a>
                        <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                رنگ</span></a>
                        <a href="#" style="background: #f2bc9e;"><span class="sr-only">نام
                                                رنگ</span></a>
                    </div><!-- End .product-nav -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-3.jpg'?>" alt="تصویر محصول"
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
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        <span class="out-price">339,000 تومان</span>
                        <span class="out-text">ناموجود</span>
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 3 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-4.jpg'?>" alt="تصویر محصول"
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
                        <a href="#">دوربین دیجیتال</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        499,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 11 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-1.jpg'?>" alt="تصویر محصول"
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
                        <a href="#">دوربین فیلمبرداری</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        349,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->
            <?php endif; ?>
        </div><!-- End .owl-carousel -->
    </div><!-- .End .tab-pane -->
    <div class="tab-pane p-0 fade" id="products-sale-tab" role="tabpanel"
         aria-labelledby="products-sale-link">
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
             data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true, 
                            "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>
            <?php
            $args = [
                'limit' => 8,
                'status' => 'publish',
                'orderby' => 'total_sales',
                'order' => 'DESC',
            ];
            $the_query_products = wc_get_products($args);
            if ($the_query_products) :
            foreach ($the_query_products as $product) :
                $regular = $product->get_regular_price();
                $sale = $product->get_sale_price();
                $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
            <div class="product product-2">

                <figure class="product-media">
                    <?php if (!$product->is_in_stock()) : ?>
                        <span class="product-label label-primary">ناموجود</span>
                    <?php endif; ?>
                    <?php if ($discount > 0) : ?>
                        <span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
                    <?php elseif ($product->is_on_sale()) : ?>
                        <span class="product-label label-sale">فروش ویژه</span>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($product->get_permalink()); ?>">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                             alt="<?php echo esc_attr($product->get_name()); ?>"
                             class="product-image">
                    </a>

                    <div class="product-action product-action-dark">
                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn-product btn-cart" title="افزودن به سبد خرید"><span>افزودن
                                                به
                                                سبد خرید</span></a>
                        <a href="<?php echo esc_url($product->get_permalink()); ?>" class="btn-product icon-eye"
                           title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
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
                    <h3 class="product-title"><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3><!-- End .product-title -->
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
                    <div class="ratings-container">
                        <?php
                        $avg = $product->get_average_rating();
                        $count = $product->get_rating_count();
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
            <?php else : ?>
            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-1.jpg'?>" alt="تصویر محصول"
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
                        <a href="#">دوربین فیلمبرداری</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        349,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <span class="product-label label-circle label-new">جدید</span>
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-2.jpg'?>" alt="تصویر محصول"
                             class="product-image">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-2-2.jpg'?>" alt="تصویر محصول"
                             class="product-image-hover">
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
                        <a href="#">ساعت هوشمند</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        214,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 0 بازدید )</span>
                    </div><!-- End .rating-container -->

                    <div class="product-nav product-nav-dots">
                        <a href="#" class="active" style="background: #e2e2e2;"><span
                                    class="sr-only">نام رنگ</span></a>
                        <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                رنگ</span></a>
                        <a href="#" style="background: #f2bc9e;"><span class="sr-only">نام
                                                رنگ</span></a>
                    </div><!-- End .product-nav -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-3.jpg'?>" alt="تصویر محصول"
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
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        <span class="out-price">339,000 تومان</span>
                        <span class="out-text">ناموجود</span>
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 3 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-4.jpg'?>" alt="تصویر محصول"
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
                        <a href="#">دوربین دیجیتال</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                    <!-- End .product-title -->
                    <div class="product-price">
                        499,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 11 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->

            <div class="product product-2">
                <figure class="product-media">
                    <a href="product.html">
                        <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-1.jpg'?>" alt="تصویر محصول"
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
                        <a href="#">دوربین فیلمبرداری</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="product.html">دوربین عکاسی 360 درجه ضد آب</a>
                    </h3><!-- End .product-title -->
                    <div class="product-price">
                        349,000 تومان
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 بازدید )</span>
                    </div><!-- End .rating-container -->
                </div><!-- End .product-body -->
            </div><!-- End .product -->
            <?php endif; ?>
        </div><!-- End .owl-carousel-->
    </div><!-- .End .tab-pane -->
    <div class="tab-pane p-0 fade" id="products-top-tab" role="tabpanel"
         aria-labelledby="products-top-link">
        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
             data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true, 
                            "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>
            <?php

            $args = [
                'limit' => 8,
                'orderby' => 'rating',
                'order' => 'DESC',
            ];
            $the_best_products = wc_get_products($args);
            if ($the_best_products) :
            foreach ($the_best_products as $product) :
            $regular = $product->get_regular_price();
            $sale = $product->get_sale_price();
            $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
            <div class="product product-2">

                <figure class="product-media">
                    <?php if (!$product->is_in_stock()) : ?>
                        <span class="product-label label-primary">ناموجود</span>
                    <?php endif; ?>
                    <?php if ($discount > 0) : ?>
                        <span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
                    <?php elseif ($product->is_on_sale()) : ?>
                        <span class="product-label label-sale">فروش ویژه</span>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($product->get_permalink()); ?>">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                             alt="<?php echo esc_attr($product->get_name()); ?>"
                             class="product-image">
                    </a>

                    <div class="product-action product-action-dark">
                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn-product btn-cart" title="افزودن به سبد خرید"><span>افزودن
                                                به
                                                سبد خرید</span></a>
                        <a href="<?php echo esc_url($product->get_permalink()); ?>" class="btn-product icon-eye"
                           title="مشاهده سریع محصولات"><span>مشاهده سریع</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
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
                    <h3 class="product-title"><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3><!-- End .product-title -->
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
                    <div class="ratings-container">
                        <?php
                        $avg = $product->get_average_rating();
                        $count = $product->get_rating_count();
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

            <?php else : ?>
                <div class="product product-2">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-1.jpg'?>" alt="تصویر محصول"
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
                            <a href="#">دوربین فیلمبرداری</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            349,000 تومان
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 بازدید )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-2">
                    <figure class="product-media">
                        <span class="product-label label-circle label-new">جدید</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-2-2.jpg'?>" alt="تصویر محصول"
                                 class="product-image-hover">
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
                            <a href="#">ساعت هوشمند</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            214,000 تومان
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 0 بازدید )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-nav product-nav-dots">
                            <a href="#" class="active" style="background: #e2e2e2;"><span
                                        class="sr-only">نام رنگ</span></a>
                            <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                رنگ</span></a>
                            <a href="#" style="background: #f2bc9e;"><span class="sr-only">نام
                                                رنگ</span></a>
                        </div><!-- End .product-nav -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-2">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-3.jpg'?>" alt="تصویر محصول"
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
                        <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            <span class="out-price">339,000 تومان</span>
                            <span class="out-text">ناموجود</span>
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 3 بازدید )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-2">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-4.jpg'?>" alt="تصویر محصول"
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
                            <a href="#">دوربین دیجیتال</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a></h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            499,000 تومان
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 11 بازدید )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

                <div class="product product-2">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/products/product-1.jpg'?>" alt="تصویر محصول"
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
                            <a href="#">دوربین فیلمبرداری</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title"><a href="product.html">محصولات خود را قرار دهید!!</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            349,000 تومان
                        </div><!-- End .product-price -->
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 2 بازدید )</span>
                        </div><!-- End .rating-container -->
                    </div><!-- End .product-body -->
                </div><!-- End .product -->

            <?php endif; ?>

        </div><!-- End .owl-carousel -->
    </div><!-- .End .tab-pane -->
</div><!-- End .tab-content -->