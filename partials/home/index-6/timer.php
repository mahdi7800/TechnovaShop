<?php
// تعداد محصولاتی که می‌خوای نمایش بدی
$limit = 2;

// 1) همه ID های محصولاتی که ووکامرس آنها را "on sale" ثبت کرده بگیر
$on_sale_ids = wc_get_product_ids_on_sale();

if (empty($on_sale_ids) || !is_array($on_sale_ids)) {
    return; // هیچ محصولی در فروش ویژه نیست -> چیزی نمایش نده
}

// 2) از بین این IDها، فقط آن‌هایی که تاریخ پایان تخفیف دارند و بزرگ‌تر از الآن هستند را نگه دار
$valid_products = [];

foreach ($on_sale_ids as $pid) {
    $product = wc_get_product($pid);
    if (! $product) {
        continue;
    }

    // اطمینان از اینکه واقعاً محصول روی سله (فقط احتیاط)
    if (! $product->is_on_sale()) {
        continue;
    }

    // گرفتن تاریخ پایان تخفیف به صورت شیء WC_DateTime یا null
    $date_obj = $product->get_date_on_sale_to();

    if ($date_obj instanceof WC_DateTime) {
        $ts = $date_obj->getTimestamp();
        if ($ts > time()) {
            $valid_products[] = $product;
        }
    }
    // اگر می‌خواهی محصول‌هایی که sale دارند ولی تاریخ پایان ندارند را نگیریم،
    // پس شرط بالا کافیست (یعنی فقط محصولاتی که تاریخ دارند پذیرفته می‌شوند).
}

// اگر هیچ محصول معتبری نبود، نمایش نده
if (empty($valid_products)) {
    return;
}

// محدود کردن به تعداد دلخواه
$valid_products = array_slice($valid_products, 0, $limit);

// گرفتن زمان پایان اولین محصول (برای تایمر)
$first_product = $valid_products[0];
$sale_end = $first_product->get_date_on_sale_to();
$timestamp = $sale_end ? $sale_end->getTimestamp() : (time() + 36000); // پیش‌فرض 10 ساعت آینده

// ---------- HTML خروجی ----------
?>
<div class="deal bg-image pt-8 pb-8"
     style="background-image: url(<?php echo TNM_URL . '/assets/images/demos/demo-6/deal/bg-1.jpg'; ?>);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <div class="deal-content text-center">
                    <h4>تعداد محدود.</h4>
                    <h2>پیشنهاد روزانه</h2>
                    <div id="deal-countdown" data-endtime="<?php echo esc_attr($timestamp); ?>"></div>
                </div>

                <div class="row deal-products mt-4">
                    <?php foreach ($valid_products as $product) : ?>
                        <div class="col-6 deal-product text-center mb-4">
                            <figure class="product-media">
                                <a href="<?php echo get_permalink($product->get_id()); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url($product->get_id())); ?>"
                                         alt="<?php echo esc_attr($product->get_name()); ?>" class="product-image">
                                </a>
                            </figure>

                            <div class="product-body">
                                <h3 class="product-title text-center">
                                    <a href="<?php echo get_permalink($product->get_id()); ?>">
                                        <?php echo esc_html($product->get_name()); ?>
                                    </a>
                                </h3>

                                <div class="product-price">
                                    <?php if ($product->is_on_sale()) : ?>
                                        <span class="new-price"><?php echo wc_price($product->get_sale_price()); ?></span>
                                        <del><span class="old-price"><?php echo wc_price($product->get_regular_price()); ?></span></del>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="action">خرید</a>
                        </div>
                    <?php endforeach; ?>
                </div><!-- End .deal-products -->
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(function($){
        var $countdown = $('#deal-countdown');
        if ($countdown.length && $.isFunction($.fn.countdown)) {
            var endTime = parseInt($countdown.data('endtime')) * 1000;
            var now = Date.now();
            if (endTime > now) {
                $countdown.countdown({
                    until: new Date(endTime),
                    format: 'DHMS',
                    padZeroes: true
                });
            } else {
                $countdown.text('پیشنهاد به پایان رسید!');
            }
        }
    });
</script>