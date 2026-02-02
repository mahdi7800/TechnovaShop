<?php
add_shortcode( 'tns-short-code-compare', 'tns_compare_func' );

function tns_compare_func() : string {

    if (!is_user_logged_in()){
        wp_redirect(home_url());
        exit;
    }

    global $wpdb;
    $table = $wpdb->prefix . 'tns_compare';
    $user_id = get_current_user_id();

    // دریافت محصولات کاربر
    $rows = $wpdb->get_results(
        $wpdb->prepare("SELECT * FROM {$table} WHERE u_id = %d", $user_id)
    );

    ob_start(); ?>

    <main class="main">

        <!-- HEADER -->
        <div class="page-header text-center"
             style="background-image: url('<?php echo TNM_URL . '/assets/images/page-header-bg.jpg'?>')">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>
        </div>

        <!-- BREADCRUMB -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <?php echo Breadcrumb::tns_get_breadcrumb(); ?>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">

                <div class="compare-table table-responsive">
                    <table class="table mb-0">

                        <?php if ($rows) : ?>
                            <tbody>

                            <!-- محصولات -->
                            <tr>
                                <td class="first-column">محصول</td>

                                <?php foreach ($rows as $item):
                                    $product = wc_get_product($item->p_id);
                                    if(!$product) continue;
                                    ?>

                                    <td class="product-image-title">

                                        <a href="<?php echo get_permalink($product->get_id()); ?>" class="image">
                                            <?php echo $product->get_image('woocommerce_thumbnail'); ?>
                                        </a>

                                        <a href="<?php echo get_permalink($product->get_id()); ?>" class="title">
                                            <?php echo $product->get_title(); ?>
                                        </a>

                                    </td>

                                <?php endforeach; ?>

                            </tr>

                            <!-- توضیحات -->
                            <tr>
                                <td class="first-column">توضیحات</td>

                                <?php foreach ($rows as $item):
                                    $product = wc_get_product($item->p_id);
                                    if(!$product) continue; ?>
                                    <td class="pro-desc">
                                        <p><?php echo wp_trim_words($product->get_short_description(), 20); ?></p>
                                    </td>
                                <?php endforeach; ?>

                            </tr>

                            <!-- قیمت -->
                            <tr>
                                <td class="first-column">قیمت</td>

                                <?php foreach ($rows as $item):
                                    $product = wc_get_product($item->p_id); ?>
                                    <td class="pro-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </td>
                                <?php endforeach; ?>

                            </tr>
                            <tr>
                                <td class="first-column">افزودن به سبد خرید</td>
                                <td class="pro-addtocart"><button src="<?php echo esc_url($item->add_to_cart_url()); ?>" class="btn btn-block btn-outline-primary-2"><i
                                                class="icon-cart-plus"></i>افزودن به سبد خرید</button></td>
                            </tr>

                            <!-- موجودی -->
                            <tr>
                                <td class="first-column">موجودی</td>

                                <?php foreach ($rows as $item):
                                    $product = wc_get_product($item->p_id); ?>
                                    <td class="pro-stock">
                                        <?php if ($product->is_in_stock()): ?>
                                            <span class="in-stock">موجود</span>
                                        <?php else: ?>
                                            <span class="out-of-stock">ناموجود</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>

                            <!-- حذف -->
                            <tr>
                                <td class="first-column">حذف</td>

                                <?php foreach ($rows as $item): ?>
                                    <td class="pro-remove">
                                        <a href="?remove_compare=<?php echo $item->id; ?>"
                                           class="btn btn-block btn-outline-danger">
                                            <i class="icon-close"></i> حذف
                                        </a>
                                    </td>
                                <?php endforeach; ?>


                            </tr>
                            <tr>
                                <td class="first-column">امتیاز</td>
                                <td class="pro-ratting">
                                    <i class="icon-star-o"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </td>
                            </tbody>

                        <?php else : ?>
                            <div class="alert alert-info text-center">
                                محصولی برای مقایسه وجود ندارد!
                            </div>
                        <?php endif; ?>

                    </table>
                </div>

                <!-- اشتراک‌گذاری کامل -->
                <div class="wishlist-share mt-4">
                    <div class="social-icons social-icons-sm">

                        <label class="social-label">اشتراک گذاری در:</label>

                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                           class="social-icon" target="_blank">
                            <i class="icon-facebook-f"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>"
                           class="social-icon" target="_blank">
                            <i class="icon-twitter"></i>
                        </a>

                        <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>"
                           class="social-icon" target="_blank">
                            <i class="icon-telegram"></i>
                        </a>

                        <a href="https://wa.me/?text=<?php echo urlencode(get_permalink()); ?>"
                           class="social-icon" target="_blank">
                            <i class="icon-whatsapp"></i>
                        </a>

                        <a href="https://www.instagram.com/"
                           class="social-icon" target="_blank">
                            <i class="icon-instagram"></i>
                        </a>

                        <a href="<?php echo get_permalink(); ?>" class="social-icon"
                           onclick="navigator.clipboard.writeText('<?php echo get_permalink(); ?>'); alert('لینک کپی شد!'); return false;">
                            <i class="icon-link"></i>
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </main>

    <?php
    return ob_get_clean();
}
