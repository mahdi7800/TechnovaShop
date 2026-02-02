<?php

$args = [
    'limit' => 3,
    'orderby' => 'rating',
    'order' => 'DESC',
];
$the_best_products = wc_get_products($args);
if ($the_best_products) : ?>
   <?php foreach ($the_best_products as $product) :
        $regular = $product->get_regular_price();
        $sale = $product->get_sale_price();
        $discount = Utility::tns_calculateDiscountPercentage($regular, $sale); ?>
       <div class="product product-sm bg-white shadow-none">
           <figure class="product-media">
               <a href="<?php echo esc_url($product->get_permalink()); ?>">
                   <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                        alt="<?php echo esc_attr($product->get_name()); ?>"
                        width="120" height="150" />
               </a>
           </figure>
           <div class="product-body pt-1">
               <h3 class="product-title font-size-normal mb-1"><?php echo $product->get_name(); ?></h3>
               <div class="ratings-container justify-content-start">
                   <?php
                   $avg = $product->get_average_rating();
                   $count = $product->get_rating_count();
                   ?>
                   <div class="ratings">
                       <div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div><!-- End .ratings-val -->
                   </div><!-- End .ratings -->
                   <span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
               </div>
               <div class="product-price font-size-normal text-dark justify-content-start">
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
               </div>
           </div>
       </div>
<?php endforeach; ?>
<?php else : ?>
    <div class="product product-sm bg-white shadow-none">
        <figure class="product-media">
            <a href="#">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-small-1.jpg'?>"
                     alt="Product image" width="120" height="150" />
            </a>
        </figure>
        <div class="product-body pt-1">
            <h3 class="product-title font-size-normal mb-1">دستبند طوسی/نقره ای</h3>
            <div class="ratings-container justify-content-start">
                <div class="ratings">
                    <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                </div><!-- End .ratings -->
                <span class="ratings-text">( 4 رأی )</span>
            </div>
            <div class="product-price font-size-normal text-dark justify-content-start">
                <span>278,000 تومان</span>
            </div>
        </div>
    </div>
    <div class="product product-sm bg-white shadow-none">
        <figure class="product-media">
            <a href="#">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-small-2.jpg'?>"
                     alt="Product image" width="120" height="150" />
            </a>
        </figure>
        <div class="product-body">
            <h3 class="product-title font-size-normal mb-1">حلقه انعطاف پذیر طلایی</h3>
            <div class="ratings-container justify-content-start">
                <div class="ratings">
                    <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                </div><!-- End .ratings -->
                <span class="ratings-text">( 4 رأی )</span>
            </div>
            <div class="product-price font-size-normal text-dark justify-content-start">
                <span>372,000 تومان</span>
            </div>
        </div>
    </div>
    <div class="product product-sm bg-white shadow-none">
        <figure class="product-media">
            <a href="#">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/product/product-small-3.jpg'?>"
                     alt="Product image" width="120" height="150" />
            </a>
        </figure>
        <div class="product-body">
            <h3 class="product-title font-size-normal mb-1">گوشواره منگوله دار مرجانی</h3>
            <div class="ratings-container justify-content-start">
                <div class="ratings">
                    <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                </div><!-- End .ratings -->
                <span class="ratings-text">( 4 رأی )</span>
            </div>
            <div class="product-price font-size-normal text-dark justify-content-start">
                <span>225,000 تومان</span>
            </div>
        </div>
    </div>
<?php endif; ?>
