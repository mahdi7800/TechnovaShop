<?php
$args = [
	'limit'   => 10,
	'status'  => 'publish',
	'meta_key'=>'_tns_check_popular',
	'meta_value'=> 1 ,
	'orderby' => 'date',
	'order'   => 'DESC'
];
$products_query = wc_get_products($args);

if (!empty($products_query)) :
	foreach ($products_query as $item) : ?>
        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
            <div class="product product-3 text-center">
                <figure class="product-media">
	                <?php if (!$item->is_in_stock()) : ?>
                        <span class="product-label label-primary">ناموجود</span>
	                <?php endif; ?>
	                <?php if ( Utility::tns_calculateDiscountPercentage($item->get_regular_price(),$item->get_sale_price()) > 0 ) : ?>
                        <span class="product-label label-circle label-sale"> تخفیف :  <?php echo Utility::tns_calculateDiscountPercentage($item->get_regular_price(),$item->get_sale_price()); ?> % </span>
	                <?php elseif ( $item->is_on_sale()): ?>
                        <span class="product-label label-sale">فروش ویژه</span>
	                <?php endif; ?>
                    <a href="<?php echo get_permalink($item->get_id()); ?>">
                        <img src="<?php echo get_the_post_thumbnail_url($item->get_id()); ?>"
                             alt="<?php echo esc_attr($item->get_name()); ?>" class="product-image">
                    </a>
                    <div class="product-action-vertical"></div>
                </figure>

                <div class="product-body">
                    <div class="product-cat text-center">
						<?php
						$terms = get_the_terms($item->get_id(), 'product_cat');
						if (!empty($terms) && !is_wp_error($terms)) {
							$term_links = array_map(function ($term) {
								return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
							}, $terms);
							echo implode(', ', $term_links);
						}
						?>
                    </div>
                    <h3 class="product-title text-center">
                        <a href="<?php echo get_permalink($item->get_id()); ?>"><?php echo $item->get_name(); ?></a>
                    </h3>

                    <div class="product-price">
						<?php if ($item->is_type('variable')) :
							$min_price = $item->get_variation_price('min');
							$max_price = $item->get_variation_price('max'); ?>
                            <span class="new-price"><?php echo wc_price($min_price); ?></span>
							<?php if ($min_price != $max_price) : ?>
                            <span class="new-price"><?php echo wc_price($max_price); ?></span>
						<?php endif; ?>
						<?php elseif ($item->is_on_sale()) : ?>
                            <span class="new-price"><?php echo wc_price($item->get_sale_price()); ?></span>
                            <span class="old-price"><?php echo wc_price($item->get_regular_price()); ?></span>
						<?php else : ?>
                            <span class="new-price"><?php echo wc_price($item->get_price()); ?></span>
						<?php endif; ?>
                    </div>
                </div>

                <div class="product-footer">
                    <div class="ratings-container">
						<?php
						$average = $item->get_average_rating();
						$rating_count = $item->get_rating_count();
						?>
                        <div class="ratings">
                            <div class="ratings-val" style="width: <?php echo ($average / 5) * 100; ?>%;"></div>
                        </div>
                        <span class="ratings-text">( <?php echo $rating_count; ?> دیدگاه )</span>
                    </div>

					<?php if ($item->is_type('variable')) :
						$available_variations = $item->get_available_variations(); ?>
                        <div class="product-nav product-nav-dots">
							<?php foreach ($available_variations as $i => $available_variation): ?>
                            <?php if (!empty($available_variation['attributes']['attribute_pa_color'])): ?>
                                <a href="#" class="<?php echo $i === 0 ? 'active' : ''; ?>"
                                   style="background: <?php echo esc_attr($available_variation['attributes']['attribute_pa_color']); ?>">
                                    <span class="sr-only">نام رنگ</span>
                                </a>
                            <?php endif; ?>
							<?php endforeach; ?>
                        </div>
					<?php endif; ?>

                    <div class="product-action">
                        <a href="<?php echo esc_url($item->add_to_cart_url()); ?>" class="btn-product btn-cart" title="افزودن به سبد خرید">
                            <span>افزودن به سبد خرید</span>
                        </a>
                        <a href="<?php echo get_permalink($item->get_id()); ?>" class="btn-product btn-view-product" title="مشاهده سریع">
                            <span>مشاهده محصول</span>
                            <i class="icon-eye"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
	<?php endforeach; ?>
    <?php else : ?>
    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <span class="product-label label-primary">فروش ویژه</span>
                <span class="product-label label-sale">30% تخفیف</span>
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-5.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-countdown-container">
                    <span class="product-contdown-title">پایان تخفیف در:</span>
                    <div class="product-countdown countdown-compact"
                         data-until="2023, 11, 3" data-compact="true"></div>
                    <!-- End .product-countdown -->
                </div><!-- End .product-countdown-container -->

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">کفش</a>,
                    <a href="#">مردانه</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">کتونی ورزشی
                        تایگر</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    <span class="new-price">77,000 تومان</span>
                    <span class="old-price">130,000</span>
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 60%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 4 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-nav product-nav-dots">
                    <a href="#" class="active" style="background: #af5f23;"><span
                                class="sr-only">نام رنگ</span></a>
                    <a href="#" style="background: #806f55;"><span class="sr-only">نام
                                                        رنگ</span></a>
                    <a href="#" style="background: #333333;"><span class="sr-only">نام
                                                        رنگ</span></a>
                </div><!-- End .product-nav -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <span class="product-label label-primary">جدید</span>
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-6.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">صندل</a>,
                    <a href="#">زنانه</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">صندلی زنانه
                        ساندرا</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    42,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 60%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 2 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-7.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">زنانه</a>،
                    <a href="#">کفش پاشنه بلند</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">کفش پاشنه بلند
                        مجلسی</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    20,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 40%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 2 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-nav product-nav-dots">
                    <a href="#" class="active" style="background: #cc6666;"><span
                                class="sr-only">نام رنگ</span></a>
                    <a href="#" style="background: #ccccff;"><span class="sr-only">نام
                                                        رنگ</span></a>
                </div><!-- End .product-nav -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-8.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">مردانه</a>،
                    <a href="#">کفش</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">کفش مخصوص پیاده
                        روی زنانه</a></h3><!-- End .product-title -->
                <div class="product-price">
                    20,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 0%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 0 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-nav product-nav-dots">
                    <a href="#" class="active" style="background: #ffca51;"><span
                                class="sr-only">نام رنگ</span></a>
                    <a href="#" style="background: #bb8379;"><span class="sr-only">نام
                                                        رنگ</span></a>
                    <a href="#" style="background: #666666;"><span class="sr-only">نام
                                                        رنگ</span></a>
                </div><!-- End .product-nav -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-9.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">زنانه</a>،
                    <a href="#">پوتین</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">کفش مخصوص پیاده
                        روی زنانه</a></h3><!-- End .product-title -->
                <div class="product-price">
                    97,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 100%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 4 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-10.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">زنانه</a>،
                    <a href="#">کفش</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">کفش مخصوص پیاده
                        روی زنانه</a></h3><!-- End .product-title -->
                <div class="product-price">
                    57,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 100%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 4 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-11.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">زنانه</a>،
                    <a href="#">پوتین</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">نیم بوت پاشنه
                        دار</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    97,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 80%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 3 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-nav product-nav-dots">
                    <a href="#" class="active" style="background: #78645f;"><span
                                class="sr-only">نام رنگ</span></a>
                    <a href="#" style="background: #b89474;"><span class="sr-only">نام
                                                        رنگ</span></a>
                    <a href="#" style="background: #666666;"><span class="sr-only">نام
                                                        رنگ</span></a>
                </div><!-- End .product-nav -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <span class="product-label label-primary">فروش ویژه</span>
                <span class="product-label label-sale">55% تخفیف</span>
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-12.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">زنانه</a>،
                    <a href="#">کفش پاشنه بلند</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">صندل ورزشی
                        دخترانه</a></h3><!-- End .product-title -->
                <div class="product-price">
                    <span class="new-price">125,000 تومان</span>
                    <span class="old-price">275,000</span>
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 0%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 0 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <span class="product-label label-primary">جدید</span>
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-13.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">زنانه</a>،
                    <a href="#">دمپایی</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">دمپایی
                        پلاستیکی</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    25,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 40%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 7 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->

    <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
        <div class="product product-3 text-center">
            <figure class="product-media">
                <a href="product.html">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-14.jpg'?>"
                         alt="تصویر محصول" class="product-image">
                </a>

                <div class="product-action-vertical">
                    <a href="#"
                       class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                        لیست علاقه مندی</span></a>
                </div><!-- End .product-action-vertical -->
            </figure><!-- End .product-media -->

            <div class="product-body">
                <div class="product-cat text-center">
                    <a href="#">مردانه</a>،
                    <a href="#">پوتین</a>
                </div><!-- End .product-cat -->
                <h3 class="product-title text-center"><a href="product.html">پوتین کوه نوردی
                        مردانه</a>
                </h3><!-- End .product-title -->
                <div class="product-price">
                    109,000 تومان
                </div><!-- End .product-price -->
            </div><!-- End .product-body -->

            <div class="product-footer">
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 0%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                    <span class="ratings-text">( 0 دیدگاه )</span>
                </div><!-- End .rating-container -->

                <div class="product-action">
                    <a href="#" class="btn-product btn-cart"
                       title="افزودن به سبد خرید"><span>افزودن
                                                        to سبد خرید</span></a>
                    <a href="popup/quickView.html" class="btn-product btn-quickview"
                       title="مشاهده سریع"><span>مشاهده سریع</span></a>
                </div><!-- End .product-action -->
            </div><!-- End .product-footer -->
        </div><!-- End .product -->
    </div><!-- End .col-6 col-md-4 col-lg-3 -->
<?php endif; ?>
