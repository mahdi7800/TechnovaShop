<?php
$args = [
    'limit' => 12,
    'status' => 'publish',
    'meta_key' => '_tns_check_popular',
    'meta_value' => 1,
    'orderby' => 'date',
    'order' => 'DESC'
];
$products_query = wc_get_products($args);
if (!empty($products_query)) : ?>
    <?php foreach ($products_query as $item) : ?>
<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
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
                <img src="<?php echo esc_url(get_the_post_thumbnail_url($item->get_id())); ?>"
                     alt="<?php echo esc_attr($item->get_name()); ?>"
                     class="product-image">
                <?php $image_gallery = $item->get_gallery_image_ids();
                if (is_array($image_gallery) && !empty($image_gallery)) :
                    $image_gallery_url = wp_get_attachment_url($image_gallery[0]);?>
                <img src="<?php echo esc_url($image_gallery_url); ?>"
                     alt="<?php echo esc_attr($item->get_name()); ?>"
                     class="product-image-hover">
                <?php else : ?>
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/logo.png'?>"
                         alt="<?php echo esc_attr($item->get_name()); ?>"
                         class="product-image-hover">
                <?php endif; ?>
            </a>

            <div class="product-action">
                <a href="<?php echo esc_url($item->add_to_cart_url()); ?>" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

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
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="<?php echo get_permalink($item->get_id()); ?>"><?php echo $item->get_name(); ?></a>
            </h3>
            <!-- End .product-title -->
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
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
<?php endforeach; ?>
<?php else : ?>
<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <span class="product-label label-sale">فروش ویژه</span>
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-5-1.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-5-2.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">لباس</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html"> محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a>
            </h3>
            <!-- End .product-title -->
            <div class="product-price">
                <span class="new-price">3,000 تومان</span>
                <span class="old-price">6,000</span>
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-6-1.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-6-2.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">کفش</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                12,000 تومان
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-7-1.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-7-2.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">کیف</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a>
            </h3>
            <!-- End .product-title -->
            <div class="product-price">
                14,000 تومان
            </div><!-- End .product-price -->

            <div class="product-nav product-nav-thumbs">
                <a href="#" class="active">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-7-thumb.jpg' ?>"
                         alt="product desc">
                </a>
                <a href="#">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-7-2-thumb.jpg' ?>"
                         alt="product desc">
                </a>
            </div><!-- End .product-nav -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-8-1.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-8-2.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">لباس</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                34,000 تومان
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-9-1.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-9-2.jpg' ?>"
                     alt="تصویر محصول"
                     class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">لباس</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a>
            </h3>
            <!-- End .product-title -->
            <div class="product-price">
                17,000 تومان
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-10-1.jpg' ?>"
                     alt="تصویر محصول" class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-10-2.jpg' ?>"
                     alt="تصویر محصول" class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">لباس</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a>
            </h3>
            <!-- End .product-title -->
            <div class="product-price">
                34,000 تومان
            </div><!-- End .product-price -->

            <div class="product-nav product-nav-thumbs">
                <a href="#" class="active">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-10-thumb.jpg' ?>"
                         alt="product desc">
                </a>
                <a href="#">
                    <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-10-2-thumb.jpg' ?>"
                         alt="product desc">
                </a>
            </div><!-- End .product-nav -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-11-1.jpg' ?>"
                     alt="تصویر محصول" class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-11-2.jpg' ?>"
                     alt="تصویر محصول" class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">کفش</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                90,000 تومان
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

<div class="col-6 col-md-4 col-lg-3">
    <div class="product product-7 text-center">
        <figure class="product-media">
            <span class="product-label label-sale">فروش ویژه</span>
            <a href="product.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-12-1.jpg' ?>"
                     alt="تصویر محصول" class="product-image">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/products/product-12-2.jpg' ?>"
                     alt="تصویر محصول" class="product-image-hover">
            </a>

            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                                لیست علاقه مندی</span></a>
            </div><!-- End .product-action-vertical -->

            <div class="product-action">
                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
            </div><!-- End .product-action -->
        </figure><!-- End .product-media -->

        <div class="product-body">
            <div class="product-cat text-center">
                <a href="#">لباس</a>
            </div><!-- End .product-cat -->
            <h3 class="product-title text-center"><a href="product.html">محصولات پر فروش از طریق متا باکس مشخص شده انتخاب کنید!</a></h3>
            <!-- End .product-title -->
            <div class="product-price">
                <span class="new-price">12,000 تومان</span>
                <span class="old-price">17,000</span>
            </div><!-- End .product-price -->
        </div><!-- End .product-body -->
    </div><!-- End .product -->
</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
<?php endif; ?>