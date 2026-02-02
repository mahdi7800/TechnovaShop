<?php
$args = [
    'limit' => 2,
    'orderby' => 'date',
    'order' => 'DESC'
];
$the_query_best_products = wc_get_products($args);
if ($the_query_best_products) : ?>
    <?php foreach ($the_query_best_products as $product) :
        $regular = $product->get_regular_price();
        $sale = $product->get_sale_price();
        $discount = Utility::tns_calculateDiscountPercentage($regular, $sale);?>
        <div class="product-big">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                 alt="<?php echo esc_attr($product->get_name()); ?>">

            <div class="product-wrap">
                <figure class="product-media">
                    <a href="product.html">
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
                    <h3 class="product-title"><a href="<?php echo get_permalink($product->get_id()); ?>"><?php echo $product->get_name(); ?></a></h3>
                    <!-- End .product-title -->
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

                    <div class="product-action">
                        <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn-product btn-cart"><span>افزودن به سبد</span></a>
                    </div><!-- End .product-action -->
                </div><!-- End .product-body -->
            </div><!-- End .product-wrap -->
        </div><!-- End .product-big -->
<?php endforeach; ?>
<?php else: ?>
<div class="product-big">
    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-big-1-bg.jpg'?>"
         alt="product bg img">

    <div class="product-wrap">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-big-1.jpg'?>"
                     alt="تصویر محصول" class="product-image">
            </a>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat" dir="rtl">
                نویسندگان : <a href="#">بکی آلبرتالی</a> و <a href="#">آدام سیلورا</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="product.html">اگر ما باشیم <br>چه می
                    کنیم.</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                18,000 تومان
            </div><!-- End .product-price -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد</span></a>
            </div><!-- End .product-action -->
        </div><!-- End .product-body -->
    </div><!-- End .product-wrap -->
</div><!-- End .product-big -->

<div class="product-big">
    <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-big-2-bg.jpg'?>"
         alt="product bg img">

    <div class="product-wrap">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/products/product-12.jpg'?>"
                     alt="تصویر محصول" class="product-image">
            </a>
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat" dir="rtl">
                نویسنده : <a href="#">نیکولا یون </a>
            </div><!-- End .product-cat -->
            <h3 class="product-title"><a href="product.html">خورشید نیز یک ستاره است</a>
            </h3><!-- End .product-title -->
            <div class="product-price">
                10,000 تومان
            </div><!-- End .product-price -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </div><!-- End .product-body -->
    </div><!-- End .product-wrap -->
</div><!-- End .product-big --->
<?php endif; ?>
