<div class="heading heading-center mb-3">
	<h2 class="title-lg">محصولات ما</h2>
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
    $cat_products = get_categories($args_cat); ?>
	<ul class="nav nav-pills justify-content-center" role="tablist">
	 <?php  if (!empty($cat_products)) : ?>
		<li class="nav-item">
			<a class="nav-link active" id="new-all-link" data-toggle="tab" href="#new-all-tab"
			   role="tab" aria-controls="new-all-tab" aria-selected="true">همه</a>
		</li>
		<?php

		foreach ($cat_products as $cat_product) : ?>
			<li class="nav-item">
				<a class="nav-link" id="cat-<?php echo esc_attr($cat_product->slug); ?>-link"
				   data-toggle="tab"
				   href="#cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
				   role="tab"
				   aria-controls="cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
				   aria-selected="false">
					<?php echo esc_html($cat_product->name); ?>
				</a>
			</li>
		<?php endforeach; ?>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link active" id="new-all-link" data-toggle="tab" href="#new-all-tab"
                   role="tab" aria-controls="new-all-tab" aria-selected="true">همه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="new-women-link" data-toggle="tab" href="#new-women-tab"
                   role="tab" aria-controls="new-women-tab" aria-selected="false">زنانه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="new-men-link" data-toggle="tab" href="#new-men-tab" role="tab"
                   aria-controls="new-men-tab" aria-selected="false">مردانه</a>
            </li>
        <?php endif; ?>
	</ul>
</div>

<div class="tab-content tab-content-carousel">
	<div class="tab-pane tab-pane-shadow p-0 fade show active" id="new-all-tab" role="tabpanel" aria-labelledby="new-all-link">
		<div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
		     data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 0,
                        "loop": false,
                        "rtl": true,
                        "responsive": {
                            "0": {"items":2},
                            "480": {"items":2},
                            "768": {"items":3},
                            "992": {"items":4},
                            "1200": {"items":4,"nav":true}
                        }
                     }'>
			<?php
			$args_all = ['limit' => 4,
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
            if (!empty($product_allies)) :
			foreach ($product_allies as $product_ally) :
				$regular = $product_ally->get_regular_price();
				$sale = $product_ally->get_sale_price();
				$discount = Utility::tns_calculateDiscountPercentage($regular, $sale);
				?>
				<div class="product product-3 text-center">
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
						</a>
					</figure>

					<div class="product-body">
						<div class="product-cat text-center">
							<?php
							$terms = get_the_terms($product_ally->get_id(), 'product_cat');
							if (!is_wp_error($terms) && !empty($terms)) :
								echo implode(', ', array_map(function($term) {
									return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
								}, $terms));
							endif;
							?>
						</div>

						<h3 class="product-title text-center">
							<a href="<?php echo esc_url($product_ally->get_permalink()); ?>">
								<?php echo esc_html($product_ally->get_name()); ?>
							</a>
						</h3>

						<div class="product-price">
							<?php if ($product_ally->is_type('variable')) :
								$prices = $product_ally->get_variation_prices(true);
								$min_price = current($prices['price']);
								$max_price = end($prices['price']);
								?>
								<span class="new-price"><?php echo wc_price($min_price); ?></span>
								<?php if ($min_price !== $max_price) : ?>
								<span class="new-price"><?php echo wc_price($max_price); ?></span>
							<?php endif; ?>
							<?php elseif ($product_ally->is_on_sale()) : ?>
								<span class="new-price"><?php echo wc_price($sale); ?></span>
								<span class="old-price"><?php echo wc_price($regular); ?></span>
							<?php else : ?>
								<span class="new-price"><?php echo wc_price($product_ally->get_price()); ?></span>
							<?php endif; ?>
						</div>
					</div>

					<div class="product-footer">
						<div class="ratings-container">
							<?php
							$avg = $product_ally->get_average_rating();
							$count = $product_ally->get_rating_count();
							?>
							<div class="ratings">
								<div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
							</div>
							<span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
						</div>

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
							</div>
						<?php endif; ?>

						<div class="product-action">
							<a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>"
							   class="btn-product btn-cart">
								<span>افزودن به سبد خرید</span>
							</a>
							<a href="<?php echo esc_url($product_ally->get_permalink()); ?>"
							   class="btn-product btn-view-product" title="مشاهده محصول">
								<i class="icon-eye"></i>
								<span>مشاهده محصول</span>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
            <?php else : ?>
                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">فروش ویژه</span>
                        <span class="product-label label-sale">30% تخفیف</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-1.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">پوتین</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">پوتین قهوه ای
                                جدید</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">50,000 تومان</span>
                            <span class="old-price">84,000</span>
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
                            <a href="#" class="active" style="background: #5f554b;"><span
                                        class="sr-only">نام رنگ</span></a>
                            <a href="#" style="background: #806f55;"><span class="sr-only">نام
                                                    رنگ</span></a>
                        </div><!-- End .product-nav -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-2.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">کتونی ایر زوم
                                نایک</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            77,000 تومان
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
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">جدید</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-3.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                            <img src="assets/images/demos/demo-10/products/product-3-2.jpg"
                                 alt="تصویر محصول" class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">صندل</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">صندل جدید زنانه</a>
                        </h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            35,000 تومان
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
                            <a href="#" class="active" style="background: #666666;"><span
                                        class="sr-only">نام رنگ</span></a>
                            <a href="#" style="background: #b58853;"><span class="sr-only">نام
                                                    رنگ</span></a>
                        </div><!-- End .product-nav -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">ناموجود</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-4.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">کتونی مخصوص دویدن
                                ایر مکس</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            <span class="out-price">54,000 تومان</span>
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

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">فروش ویژه</span>
                        <span class="product-label label-sale">40% تخفیف</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-5.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">کتونی ورزشی
                                تایگر</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">77,000 تومان</span>
                            <span class="old-price">130,000 تومان</span>
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
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->
            <?php endif; ?>
		</div>
	</div>
    <?php
    foreach ($cat_products as $cat_product) :
    $args_cat_loop = [
        'limit' => 4,
        'status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'stock_status' => 'instock',
        'category' => [$cat_product->slug],
    ];
    $product_cats = wc_get_products($args_cat_loop);
    if (!empty($product_cats)) : ?>
		<div class="tab-pane tab-pane-shadow p-0 fade"
		     id="cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
		     role="tabpanel"
		     aria-labelledby="cat-<?php echo esc_attr($cat_product->slug); ?>-link">
			<div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
			     data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 0,
                            "loop": false,
                            "rtl": true,
                            "responsive": {
                                "0": {"items":2},
                                "480": {"items":2},
                                "768": {"items":3},
                                "992": {"items":4},
                                "1200": {"items":4,"nav":true}
                            }
                         }'>
				<?php foreach ($product_cats as $product_cat) :
					$regular = $product_cat->get_regular_price();
					$sale = $product_cat->get_sale_price();
					$discount = $regular && $sale ? round((($regular - $sale) / $regular) * 100) : 0;
					?>
					<div class="product product-3 text-center">
						<figure class="product-media">
							<?php if (!$product_cat->is_in_stock()) : ?>
								<span class="product-label label-primary">ناموجود</span>
							<?php endif; ?>

							<?php if ($discount > 0) : ?>
								<span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
							<?php elseif ($product_cat->is_on_sale()) : ?>
								<span class="product-label label-sale">فروش ویژه</span>
							<?php endif; ?>

							<a href="<?php echo esc_url($product_cat->get_permalink()); ?>">
								<img src="<?php echo esc_url(get_the_post_thumbnail_url($product_cat->get_id())); ?>"
								     alt="<?php echo esc_attr($product_cat->get_name()); ?>"
								     class="product-image">
							</a>
						</figure>

						<div class="product-body">
							<div class="product-cat text-center">
								<?php
								$terms = get_the_terms($product_cat->get_id(), 'product_cat');
								if (!is_wp_error($terms) && !empty($terms)) :
									echo implode(', ', array_map(function($term) {
										return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
									}, $terms));
								endif;
								?>
							</div>

							<h3 class="product-title text-center">
								<a href="<?php echo esc_url($product_cat->get_permalink()); ?>">
									<?php echo esc_html($product_cat->get_name()); ?>
								</a>
							</h3>

							<div class="product-price">
								<?php if ($product_cat->is_type('variable')) :
									$prices = $product_cat->get_variation_prices(true);
									$min_price = current($prices['price']);
									$max_price = end($prices['price']);
									?>
									<span class="new-price"><?php echo wc_price($min_price); ?></span>
									<?php if ($min_price !== $max_price) : ?>
									<span class="new-price"><?php echo wc_price($max_price); ?></span>
								<?php endif; ?>
								<?php elseif ($product_cat->is_on_sale()) : ?>
									<span class="new-price"><?php echo wc_price($sale); ?></span>
									<span class="old-price"><?php echo wc_price($regular); ?></span>
								<?php else : ?>
									<span class="new-price"><?php echo wc_price($product_cat->get_price()); ?></span>
								<?php endif; ?>
							</div>
						</div>

						<div class="product-footer">
							<div class="ratings-container">
								<?php
								$avg = $product_cat->get_average_rating();
								$count = $product_cat->get_rating_count();
								?>
								<div class="ratings">
									<div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
								</div>
								<span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
							</div>

							<?php if ($product_cat->is_type('variable')) :
								$variations = $product_cat->get_available_variations(); ?>
								<div class="product-nav product-nav-dots">
									<?php foreach ($variations as $i => $var) :
										if (!empty($var['attributes']['attribute_pa_color'])) : ?>
											<a href="#" class="<?php echo $i === 0 ? 'active' : ''; ?>"
											   style="background: <?php echo esc_attr($var['attributes']['attribute_pa_color']); ?>">
												<span class="sr-only">نام رنگ</span>
											</a>
										<?php endif;
									endforeach; ?>
								</div>
							<?php endif; ?>

							<div class="product-action">
								<a href="<?php echo esc_url($product_cat->add_to_cart_url()); ?>"
								   class="btn-product btn-cart">
									<span>افزودن به سبد خرید</span>
								</a>
								<a href="<?php echo esc_url($product_cat->get_permalink()); ?>"
								   class="btn-product btn-view-product" title="مشاهده محصول">
									<i class="icon-eye"></i>
									<span>مشاهده محصول</span>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
    <?php else : ?>
        <div class="tab-pane tab-pane-shadow p-0 fade" id="new-women-tab" role="tabpanel"
             aria-labelledby="new-women-link">
            <div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
                 data-owl-options='{
                                    "nav": false,
                                    "dots": true,
                                    "margin": 0,
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
                                            "nav": true
                                        }
                                    }
                                }'>
                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">ناموجود</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/ assets/images/demos/demo-10/products/product-4.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">کتونی مخصوص دویدن
                                ایر مکس</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            <span class="out-price">54,000 تومان</span>
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

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">جدید</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-3.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-3-2.jpg'?>"
                                 alt="تصویر محصول" class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">صندل</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">صندل جدید زنانه</a>
                        </h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            35,000 تومان
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
                            <a href="#" class="active" style="background: #666666;"><span
                                        class="sr-only">نام رنگ</span></a>
                            <a href="#" style="background: #b58853;"><span class="sr-only">نام
                                                    رنگ</span></a>
                        </div><!-- End .product-nav -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">فروش ویژه</span>
                        <span class="product-label label-sale">40% تخفیف</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-5.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
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
                                <div class="ratings-val" style="width: 0%;"></div>
                                <!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 0 دیدگاه )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">فروش ویژه</span>
                        <span class="product-label label-sale">30% تخفیف</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-1.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">پوتین</a>,
                            <a href="#">مردانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">پوتین قهوه ای
                                جدید</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            <span class="new-price">50,000 تومان</span>
                            <span class="old-price">84,000</span>
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
                            <a href="#" class="active" style="background: #5f554b;"><span
                                        class="sr-only">نام رنگ</span></a>
                            <a href="#" style="background: #806f55;"><span class="sr-only">نام
                                                    رنگ</span></a>
                        </div><!-- End .product-nav -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-2.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>,
                            <a href="#">مردانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">کتونی ایر زوم
                                نایک</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            77,000 تومان
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
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->
            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
        <div class="tab-pane tab-pane-shadow p-0 fade" id="new-men-tab" role="tabpanel"
             aria-labelledby="new-men-link">
            <div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
                 data-owl-options='{
                                    "nav": false,
                                    "dots": true,
                                    "margin": 0,
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
                                            "nav": true
                                        }
                                    }
                                }'>
                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">فروش ویژه</span>
                        <span class="product-label label-sale">40% off</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-5.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
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
                                <div class="ratings-val" style="width: 0%;"></div>
                                <!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( 0 دیدگاه )</span>
                        </div><!-- End .rating-container -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">جدید</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-3.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-3-2.jpg'?>"
                                 alt="تصویر محصول" class="product-image-hover">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">صندل</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">صندل جدید زنانه</a>
                        </h3>
                        <!-- End .product-title -->
                        <div class="product-price">
                            35,000 تومان
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
                            <a href="#" class="active" style="background: #666666;"><span
                                        class="sr-only">نام رنگ</span></a>
                            <a href="#" style="background: #b58853;"><span class="sr-only">نام
                                                    رنگ</span></a>
                        </div><!-- End .product-nav -->

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-2.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>,
                            <a href="#">مردانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">کتونی ایر زوم
                                نایک</a>
                        </h3><!-- End .product-title -->
                        <div class="product-price">
                            77,000 تومان
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
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->

                <div class="product product-3 text-center">
                    <figure class="product-media">
                        <span class="product-label label-primary">ناموجود</span>
                        <a href="product.html">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/products/product-4.jpg'?>"
                                 alt="تصویر محصول" class="product-image">
                        </a>

                        <div class="product-action-vertical">
                            <a href="#"
                               class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن
                                                    به لیست علاقه مندی</span></a>
                        </div><!-- End .product-action-vertical -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        <div class="product-cat text-center">
                            <a href="#">کفش</a>,
                            <a href="#">زنانه</a>
                        </div><!-- End .product-cat -->
                        <h3 class="product-title text-center"><a href="product.html">کتونی مخصوص دویدن
                                ایر مکس</a></h3><!-- End .product-title -->
                        <div class="product-price">
                            <span class="out-price">54,000 تومان</span>
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

                        <div class="product-action">
                            <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                            <a href="popup/quickView.html"
                               class="btn-product btn-quickview"><span>مشاهده
                                                    سریع</span></a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-footer -->
                </div><!-- End .product -->
            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
    <?php endif; ?>
    <?php endforeach; ?>
</div>
