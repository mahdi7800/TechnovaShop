<?php
$args = [
    'limit'   => 5,
    'status'  => 'publish',
    'meta_key'=>'_tns_check_popular',
    'meta_value'=> 1 ,
    'orderby' => 'date',
    'order'   => 'DESC'
];
$products_query = wc_get_products($args);

if (!empty($products_query)) :
foreach ($products_query as $item) : ?>
<div class="product bg-white shadow-none">
    <?php if (!$item->is_in_stock()) : ?>
        <span class="product-label label-primary">ناموجود</span>
    <?php endif; ?>
    <?php if ( Utility::tns_calculateDiscountPercentage($item->get_regular_price(),$item->get_sale_price()) > 0 ) : ?>
        <span class="product-label label-circle label-sale"> تخفیف :  <?php echo Utility::tns_calculateDiscountPercentage($item->get_regular_price(),$item->get_sale_price()); ?> % </span>
    <?php elseif ( $item->is_on_sale()): ?>
        <span class="product-label label-sale">فروش ویژه</span>
    <?php endif; ?>
    <figure class="product-media">
        <a href="<?php echo get_permalink($item->get_id()); ?>">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url($item->get_id())); ?>"
                 alt="<?php echo esc_attr($item->get_name()); ?>"
                 width="277" height="377"
                 class="product-image" />
          <?php $image_gallery = $item->get_gallery_image_ids();
           if (is_array($image_gallery) && !empty($image_gallery)) :
                  $image_gallery_url = wp_get_attachment_url($image_gallery[0]);?>
               <img src="<?php echo esc_url($image_gallery_url); ?>"
                 alt="<?php echo esc_attr($item->get_name()); ?>"
                 width="277" height="377"
                 class="product-image-hover" />
            <?php endif; ?>
        </a>

    </figure>
    <div class="product-body text-center">
        <h3 class="product-title font-size-normal"><?php echo $item->get_name(); ?></h3>
        <div
        <?php if ($item->is_type('variable')) :
            $min_price = $item->get_variation_price('min');
            $max_price = $item->get_variation_price('max'); ?>
            <span class="new-price"><?php echo wc_price($min_price); ?></span>
            <?php if ($min_price != $max_price) : ?>
            <span class="new-price"><?php echo wc_price($max_price); ?></span>
        <?php endif; ?>
        <?php elseif ($item->is_on_sale()) : ?>
            <span class="new-price"><?php echo wc_price($item->get_sale_price()); ?></span>
            <span class="old-price mt-3"><?php echo wc_price($item->get_regular_price()); ?></span>
        <?php else : ?>
            <span class="new-price"><?php echo wc_price($item->get_price()); ?></span>
        <?php endif; ?>
        </div>
        <div class="product-footer justify-content-center d-block">
            <div class="ratings-container justify-content-center">
                <?php
                $average = $item->get_average_rating();
                $rating_count = $item->get_rating_count();
                ?>
                <div class="ratings">
                    <div class="ratings-val" style="width: <?php echo ($average / 5) * 100; ?>%;"></div>
                    <!-- End .ratings-val -->
                </div><!-- End .ratings -->
                <span class="ratings-text">( <?php echo $rating_count; ?> دیدگاه )</span>
            </div>
            <a href="<?php echo esc_url($item->add_to_cart_url()); ?>" class="btn font-size-normal letter-spacing-large btn-dark">
                <i class="icon-cart-plus"></i>
                <span>افزودن به سبد خرید</span>
            </a>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php else : ?>
<div class="product bg-white shadow-none">
                                    <span class="product-label letter-spacing-large p-2 bg-dark text-white">فروش
                                        ویژه</span>
    <figure class="product-media">
        <a href="#">
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-6.jpg'?>"
                 alt="Product image" width="277" height="377" class="product-image" />
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-6-2.jpg'?>"
                 alt="Product image" width="277" height="377"
                 class="product-image-hover" />
        </a>
        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
        </div>
    </figure>
    <div class="product-body text-center">
        <h3 class="product-title font-size-normal">گوشواره بلند نقره ای استریلینگ
        </h3>
        <div
                class="product-price font-size-normal mb-0 text-dark justify-content-center">
            <div class="old-price mx-3">424,000 تومان</div>
            <span>355,000 تومان</span>
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
<div class="product bg-white shadow-none">
    <figure class="product-media">
        <a href="#">
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-7.jpg'?>"
                 alt="Product image" width="277" height="377" class="product-image" />
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-7-2.jpg'?>"
                 alt="Product image" width="277" height="377"
                 class="product-image-hover" />
        </a>
        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
        </div>
    </figure>
    <div class="product-body text-center">
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
<div class="product bg-white shadow-none">
    <figure class="product-media">
        <a href="#">
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-8.jpg'?>"
                 alt="Product image" width="277" height="377" class="product-image" />
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-8-2.jpg'?>"
                 alt="Product image" width="277" height="377"
                 class="product-image-hover" />
        </a>
        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
        </div>
    </figure>
    <div class="product-body text-center">
        <h3 class="product-title font-size-normal">گوشواره منگوله ای جدید
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
<div class="product bg-white shadow-none">
    <figure class="product-media">
        <a href="#">
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-9.jpg'?>"
                 alt="Product image" width="277" height="377" class="product-image" />
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-9-2.jpg'?>"
                 alt="Product image" width="277" height="377"
                 class="product-image-hover" />
        </a>
        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
        </div>
    </figure>
    <div class="product-body text-center">
        <h3 class="product-title font-size-normal">حلقه طرح ستاره ای نقره</h3>
        <div
            class="product-price font-size-normal mb-0 text-dark justify-content-center">
            <span>370,000 تومان</span>
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
<div class="product bg-white shadow-none">
    <figure class="product-media">
        <a href="#">
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-9.jpg'?>"
                 alt="Product image" width="277" height="377" class="product-image" />
            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-9-2.jpg'?>"
                 alt="Product image" width="277" height="377"
                 class="product-image-hover" />
        </a>
        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-wishlist"><span>افزودن به لیست علاقه
                                                    مندی</span></a>
        </div>
    </figure>
    <div class="product-body text-center">
        <h3 class="product-title font-size-normal">حلقه طرح ستاره ای نقره</h3>
        <div
            class="product-price font-size-normal mb-0 text-dark justify-content-center">
            <span>370,000 تومان</span>
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