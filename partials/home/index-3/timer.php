<?php
// ----------------------------------------------------
// 1) گرفتن تمام محصولاتی که on sale هستند
// ----------------------------------------------------
$on_sale_ids = wc_get_product_ids_on_sale();

if (empty($on_sale_ids) || !is_array($on_sale_ids)) {
    return;
}

$flash_product = null;  // محصول ویژه با تایمر
$normal_products = [];  // محصولات تخفیفی معمولی

foreach ($on_sale_ids as $pid) {
    $product = wc_get_product($pid);
    if (!$product) continue;

    if (!$product->is_on_sale()) continue;

    $end = $product->get_date_on_sale_to();

    // محصول ویژه = محصولی که تاریخ پایان دارد و > الان است
    if ($end instanceof WC_DateTime && $end->getTimestamp() > time()) {

        // فقط اولین محصول فلش را بگیر
        if (!$flash_product) {
            $flash_product = $product;
            continue;
        }
    }

    // بقیه می‌افتند در محصولات معمولی
    $normal_products[] = $product;
}

// اگر محصول ویژه پیدا نشد، هیچی نمایش نده
if (!$flash_product) {
    return;
}

// محدودیت تعداد محصول‌های معمولی
$normal_products = array_slice($normal_products, 0, 4);

// زمان پایان تخفیف
$sale_end = $flash_product->get_date_on_sale_to();
$timestamp = $sale_end ? $sale_end->getTimestamp() : (time() + 7200);
?>

<div class="bg-light deal-container pt-7 pb-7 mb-5">
    <div class="container">

        <div class="heading text-center mb-4">
            <h2 class="title">تخفیف ویژه امروز</h2>
            <p class="title-desc">تنها تا پایان زمان مشخص‌شده</p>
        </div>

        <div class="row">

            <!-- ---------------------------------------------------------
                 بخش اول: محصول ویژه با تایمر
            ---------------------------------------------------------- -->
            <div class="col-lg-6 deal-col">

                <div class="deal"
                     style="background-image:url('<?php echo get_the_post_thumbnail_url($flash_product->get_id()); ?>');">

                    <div class="deal-top">
                        <h2>پیشنهاد ویژه</h2>
                        <h4 class="text-center">فروش محدود</h4>
                    </div>

                    <div class="deal-content">

                        <h3 class="product-title">
                            <a href="<?php echo get_permalink($flash_product->get_id()); ?>">
                                <?php echo esc_html($flash_product->get_name()); ?>
                            </a>
                        </h3>

                        <div class="product-price mt-3">
                            <span class="new-price d-block w-100">
                                <?php echo wc_price($flash_product->get_sale_price()); ?>
                            </span>

                            <span class="old-price d-block w-100">
                                قیمت قبلی: <?php echo wc_price($flash_product->get_regular_price()); ?>
                            </span>
                        </div>

                        <a href="<?php echo esc_url($flash_product->add_to_cart_url()); ?>" class="btn btn-link mt-3">
                            <span>افزودن به سبد خرید</span>
                            <i class="icon-long-arrow-left"></i>
                        </a>
                    </div>

                    <div class="deal-bottom">
                        <div id="deal-countdown"
                             class="deal-countdown"
                             data-endtime="<?php echo esc_attr($timestamp); ?>">
                        </div>
                    </div>

                </div>
            </div>

            <!-- ---------------------------------------------------------
                 بخش دوم: محصولات تخفیف معمولی
            ---------------------------------------------------------- -->
            <div class="col-lg-6">
                <div class="products">
                    <div class="row">

                        <?php foreach ($normal_products as $sp): ?>
                            <div class="col-6">
                                <div class="product product-2">

                                    <figure class="product-media">
                                        <a href="<?php echo get_permalink($sp->get_id()); ?>">
                                            <img src="<?php echo get_the_post_thumbnail_url($sp->get_id()); ?>"
                                                 class="product-image"
                                                 alt="<?php echo esc_attr($sp->get_name()); ?>">
                                        </a>

                                        <div class="product-action product-action-dark">
                                            <a href="<?php echo esc_url($sp->add_to_cart_url()); ?>"
                                               class="btn-product btn-cart">
                                                <span>افزودن به سبد خرید</span>
                                            </a>
                                        </div>

                                    </figure>

                                    <div class="product-body">
                                        <h3 class="product-title">
                                            <a href="<?php echo get_permalink($sp->get_id()); ?>">
                                                <?php echo esc_html($sp->get_name()); ?>
                                            </a>
                                        </h3>

                                        <div class="product-price">
                                            <span class="new-price"><?php echo wc_price($sp->get_sale_price()); ?></span>
                                            <del><span class="old-price"><?php echo wc_price($sp->get_regular_price()); ?></span></del>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        </div>

        <div class="more-container text-center mt-3">
            <a href="<?php echo site_url('/shop/?on_sale=1'); ?>" class="btn btn-outline-dark-2 btn-round btn-more">
                <span>مشاهده همه تخفیف‌ها</span>
                <i class="icon-long-arrow-left"></i>
            </a>
        </div>

    </div>
</div>

<script>
    jQuery(function($){
        var $cd = $('#deal-countdown');
        if ($cd.length && $.isFunction($.fn.countdown)) {
            var end = parseInt($cd.data('endtime')) * 1000;
            var now = Date.now();

            if (end > now) {
                $cd.countdown({
                    until: new Date(end),
                    format: "DHMS",
                    padZeroes: true
                });
            } else {
                $cd.text("پیشنهاد به پایان رسید!");
            }
        }
    });
</script>
