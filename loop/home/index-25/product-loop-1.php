
<div class="heading heading-center mb-5">
    <h2 class="title text-uppercase mb-4">محصولات جدید</h2>
    <ul class="nav nav-pills justify-content-center" role="tablist">
        <li class="nav-item">
            <a href="#arrival-all" class="nav-link font-size-normal letter-spacing-large active"
               data-toggle="tab" role="tab">همه</a>
        </li>
        <?php
        $exclude = get_option('_tnm_settings_set_general')['exclude_category_id'];
        $args_cat = [
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'exclude'    => $exclude ,
            'parent'     => 0,
            'orderby'    => 'id',
            'order'      => 'ASC'
        ];
        $cat_products = get_categories($args_cat);
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
    </ul>
</div>

<div class="tab-content tab-content-carousel">
    <div class="tab-pane p-0 fade show active" id="arrival-all" role="tabpanel">
        <div class="owl-carousel carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2"
             data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items": 2
                                    },
                                    "768": {
                                        "items": 3
                                    },
                                    "992": {
                                        "items": 4
                                    },
                                    "1500": {
                                        "items": 4,
                                        "nav": true
                                    }
                                }
                            }'>
            <?php
            $args_all = ['limit' => 5,
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
            <div class="product shadow-none">
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
                             alt="<?php echo esc_attr($product_ally->get_name()); ?>" width="277" height="377" class="product-image" />
                        <?php $image_gallery = $product_ally->get_gallery_image_ids();
                        if (is_array($image_gallery) && !empty($image_gallery)) :
                             $image_gallery_url = wp_get_attachment_url($image_gallery[0]);?>
                             <img src="<?php echo esc_url($image_gallery_url); ?>"
                             alt="<?php echo esc_attr($product_ally->get_name()); ?>" width="277" height="377"
                             class="product-image-hover" />
                        <?php endif;?>
                    </a>
                </figure>
                <div class="product-body text-center bg-light-2">
                    <h3 class="product-title font-size-normal"><a href="<?php echo get_permalink($product_ally->get_id()); ?>"><?php echo $product_ally->get_name(); ?></a></h3>
                    <div
                        class="product-price font-size-normal mb-0 text-dark justify-content-center">
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
                    <div class="product-footer justify-content-center d-block">
                        <div class="ratings-container justify-content-center">
                            <?php
                            $avg = $product_ally->get_average_rating();
                            $count = $product_ally->get_rating_count();
                            ?>
                            <div class="ratings">
                                <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
                                <!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( <?php echo esc_html($count); ?> رأی )</span>
                        </div>
                        <a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>" class="btn font-size-normal letter-spacing-large btn-dark">
                            <i class="icon-cart-plus"></i>
                            <span>افزودن به سبد خرید</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
             <div class="product shadow-none">
                                    <span class="product-label letter-spacing-large p-2 bg-dark text-white">فروش
                                        ویژه</span>
                 <figure class="product-media">
                     <a href="#">
                         <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-3.jpg'?>"
                              alt="Product image" width="277" height="377" class="product-image" />
                         <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-3-2.jpg'?>"
                              alt="Product image" width="277" height="377"
                              class="product-image-hover" />
                     </a>
                     <div class="product-action-vertical">
                         <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                     </div>
                 </figure>
                 <div class="product-body text-center bg-light-2">
                     <h3 class="product-title font-size-normal">گردنبند طرح قلب طلایی/نقره ای</h3>
                     <div
                             class="product-price font-size-normal mb-0 text-dark justify-content-center">
                         <div class="old-price mx-3">325,000 تومان</div>
                         265,000 تومان
                     </div>
                     <div class="product-footer justify-content-center d-block">
                         <div class="ratings-container justify-content-center">
                             <div class="ratings">
                                 <div class="ratings-val" style="width: 60%;"></div>
                                 <!-- End .ratings-val -->
                             </div><!-- End .ratings -->
                             <span class="ratings-text">( 4 رأی )</span>
                         </div>
                         <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                             <i class="icon-cart-plus"></i>
                             <span>افزودن به سبد خرید</span>
                         </a>
                     </div>
                 </div>
             </div>
             <div class="product shadow-none">
                 <figure class="product-media">
                     <a href="#">
                         <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-4.jpg'?>"
                              alt="Product image" width="277" height="377" class="product-image" />
                         <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-4-2.jpg'?>"
                              alt="Product image" width="277" height="377"
                              class="product-image-hover" />
                     </a>
                     <div class="product-action-vertical">
                         <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                     </div>
                 </figure>
                 <div class="product-body text-center bg-light-2">
                     <h3 class="product-title font-size-normal">گوشواره دایره ای مهره دار
                     </h3>
                     <div
                             class="product-price font-size-normal mb-0 text-dark justify-content-center">
                         <span>265,000 تومان</span>
                     </div>
                     <div class="product-footer justify-content-center d-block">
                         <div class="ratings-container justify-content-center">
                             <div class="ratings">
                                 <div class="ratings-val" style="width: 60%;"></div>
                                 <!-- End .ratings-val -->
                             </div><!-- End .ratings -->
                             <span class="ratings-text">( 4 رأی )</span>
                         </div>
                         <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                             <i class="icon-cart-plus"></i>
                             <span>افزودن به سبد خرید</span>
                         </a>
                     </div>
                 </div>
             </div>
             <div class="product shadow-none">
                 <figure class="product-media">
                     <a href="#">
                         <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-5.jpg'?>"
                              alt="Product image" width="277" height="377" class="product-image" />
                         <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-5-2.jpg'?>'"
                              alt="Product image" width="277" height="377"
                              class="product-image-hover" />
                     </a>
                     <div class="product-action-vertical">
                         <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
                     </div>
                 </figure>
                 <div class="product-body text-center bg-light-2">
                     <h3 class="product-title font-size-normal">گردنبند طلایی/نقره ای بلند</h3>
                     <div
                             class="product-price font-size-normal mb-0 text-dark justify-content-center">
                         <span>331,000 تومان</span>
                     </div>
                     <div class="product-footer justify-content-center d-block">
                         <div class="ratings-container justify-content-center">
                             <div class="ratings">
                                 <div class="ratings-val" style="width: 60%;"></div>
                                 <!-- End .ratings-val -->
                             </div><!-- End .ratings -->
                             <span class="ratings-text">( 4 رأی )</span>
                         </div>
                         <a href="#" class="btn font-size-normal letter-spacing-large btn-dark">
                             <i class="icon-cart-plus"></i>
                             <span>افزودن به سبد خرید</span>
                         </a>
                     </div>
                 </div>
             </div>
         <?php endif; ?>



        </div>
    </div>
    <?php foreach ($cat_products as $cat_product) :

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
        <div class="owl-carousel carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2"
             data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items": 2
                                    },
                                    "768": {
                                        "items": 3
                                    },
                                    "992": {
                                        "items": 4,
                                        "nav": true
                                    }
                                }
                            }'>
             <?php if (!empty($product_cats)) : ?>
               <?php foreach ($product_cats as $product_ally) :
                     $regular  = $product_ally->get_regular_price();
                     $sale     = $product_ally->get_sale_price();
                     $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
                   <div class="product shadow-none">
                      <figure class="product-media">
                          <?php if (!$product_ally->is_in_stock()) : ?>
                        <span class="product-label label-primary">ناموجود</span>
                    <?php endif; ?>

                            <?php
                             if ($discount > 0) : ?>
                                 <span class="product-label label-circle label-sale">تخفیف <?php echo esc_html($discount); ?>%</span>
                              <?php elseif ($product_ally->is_on_sale()) : ?>
                              <span class="product-label label-sale">فروش ویژه</span>
                             <?php endif; ?>
                                   <a href="<?php echo esc_url($product_ally->get_permalink()); ?>">
                                   <img src="<?php echo esc_url(get_the_post_thumbnail_url($product_ally->get_id())); ?>" alt="<?php echo esc_attr($product_ally->get_name()); ?>" width="277" height="377" class="product-image" />
                            <?php $image_gallery = $product_ally->get_gallery_image_ids();
                                 if (is_array($image_gallery) && !empty($image_gallery)) :
                                    $image_gallery_url = wp_get_attachment_url($image_gallery[0]);?>
                                    <img src="<?php echo esc_url($image_gallery_url); ?>"
                                     alt="<?php echo esc_attr($product_ally->get_name()); ?>" width="277" height="377"
                                    class="product-image-hover" />
                                 <?php endif;
                            ?>
                         </a>
                     </figure>
                <div class="product-body text-center bg-light-2">
                    <h3 class="product-title font-size-normal"><a href="<?php echo get_permalink($product_ally->get_id()); ?>"><?php echo $product_ally->get_name(); ?></a></h3>
                    <div
                        class="product-price font-size-normal mb-0 text-dark justify-content-center">
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
                    <div class="product-footer justify-content-center d-block">
                        <div class="ratings-container justify-content-center">
                            <div class="ratings">
                                <?php
                                $avg = $product_ally->get_average_rating();
                                $count = $product_ally->get_rating_count();
                                ?>
                                <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
                                <!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <span class="ratings-text">( <?php echo esc_html($count); ?> رأی )</span>
                        </div>
                        <a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>" class="btn font-size-normal letter-spacing-large btn-dark">
                            <i class="icon-cart-plus"></i>
                            <span>افزودن به سبد خرید</span>
                        </a>
                    </div>
                 </div>
              <?php endforeach; ?>

                       <?php else : ?>
                       <div class="alert alert-info">پستی وجود ندارد!</div>
                       <?php endif; ?>
              </div>

         </div>
    <?php endforeach; ?>
    </div>

</div>
