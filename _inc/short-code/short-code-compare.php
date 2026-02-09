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
    $products = wc_get_products($rows);
    $counter = 1;


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
                <?php if (!empty($rows)) : ?>
                <table class="table table-wishlist table-mobile text-center">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام محصول</th>
                        <th>تصویر محصول</th>
                        <th>قیمت</th>
                        <th>وضعیت محصول</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($rows as $item) : ?>
                        <?php foreach ($products as $product) : ?>
                    <tr>
                <td class="price-col">
                    <div>
                        <h3 class="product-title ">
                            <?php echo $counter++; ?>
                        </h3><!-- End .product-title -->
                    </div><!-- End .product -->
                </td>
                <td class="price-col">
                            <div>
                                <h3 class="product-title text-center">
                                    <a href="<?php echo get_the_permalink($item->p_id); ?>"><?php echo esc_html($item->p_title); ?></a>
                                </h3><!-- End .product-title -->
                            </div><!-- End .product -->
                        </td>
                <td class="price-col">
                    <div class="product">
                        <figure class="product-media">
                            <a href="<?php echo get_the_permalink($item->p_id); ?>">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url($item->p_id)); ?>" alt="<?php echo esc_attr($item->p_id); ?>">
                            </a>
                        </figure>
                    </div><!-- End .product -->
                </td>

                <td class="price-col"><?php echo $product->get_price();  ?>  تومان </td>
                <td class="stock-col"><span class="in-stock"><?php echo  $product->is_in_stock() ? 'موجود' : 'ناموجود' ?></span></td>
                <td class="action-col">
                    <a  href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn btn-block btn-outline-primary-2"><i
                                class="icon-cart-plus"></i>افزودن به سبد خرید</a>
                </td>
                <td class="remove-col text-left bookmark-product-compare" data-pid="<?php echo $item->p_id ?>"><button class="btn-remove"><i
                                class="icon-close"></i></button></td>
            </tr>
        <?php endforeach;?>
        <?php endforeach; ?>

                    </tbody>

                </table><!-- End .table table-wishlist -->
                <?php else : ?>
                    <div class="alert alert-info text-center">محصولی برای مقایسه وجود ندارد!</div>
                <?php endif; ?>
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

                </div>
            </div>
            </div><!-- End .container -->
        </div><!-- End .page-content -->

    </main>

    <?php
    return ob_get_clean();
}
