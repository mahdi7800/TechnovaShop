<?php
global $wpdb;
$table = $wpdb->prefix . 'tns_sliders';
$sliders = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 3", ARRAY_A);
?>

<div class="container">
    <div class="intro-slider-container slider-container-ratio mb-2">
        <div class="intro-slider owl-carousel owl-simple owl-light owl-nav-inside"
             data-toggle="owl"
             data-owl-options='{
                 "nav": false,
                 "rtl": true,
                 "items": 1,
                 "loop": false
             }'>

            <?php if ($sliders) : ?>
                <?php foreach ($sliders as $slider) :

                    // ایمن‌سازی تصاویر
                    $images = explode('++', $slider['p_image']);
                    $mobile  = !empty($images[0]) ? esc_url(trim($images[0])) : TNM_URL . '/assets/images/default-mobile.jpg';
                    $desktop = !empty($images[1]) ? esc_url(trim($images[1])) : $mobile;
                    ?>

                    <div class="intro-slide">

                        <figure class="slide-image">
                            <picture>
                                <source media="(max-width: 480px)" srcset="<?php echo $mobile; ?>">
                                <img src="<?php echo $desktop; ?>" alt="Slider Image">
                            </picture>
                        </figure>

                        <div class="intro-content">
                            <h3 class="intro-subtitle"><?php echo esc_html($slider['top_title']); ?></h3>
                            <h1 class="intro-title text-white"><?php echo esc_html($slider['main_title']); ?></h1>
                            <div class="intro-price text-white"><?php echo esc_html($slider['sub_title']); ?></div>

                            <a href="<?php echo esc_url($slider['p_thumbnail']); ?>" class="btn btn-white-primary btn-round">
                                <span>خرید</span>
                                <i class="icon-long-arrow-left"></i>
                            </a>
                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>
                <div class="intro-slide">
                    <figure class="slide-image">
                        <picture>
                            <source media="(max-width: 480px)"
                                    srcset="<?php echo TNM_URL . '/assets/images/demos/demo-10/slider/slide-1-480w.jpg'?>">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/slider/slide-1.jpg'?>" alt="Image Desc">
                        </picture>
                    </figure><!-- End .slide-image -->

                    <div class="intro-content">
                        <h3 class="intro-subtitle">بنر مورد نظر خود را قرار دهید!</h3><!-- End .h3 intro-subtitle -->
                        <h1 class="intro-title text-white"> متن مورد نظر خود را قرار دهید!</h1>
                        <!-- End .intro-title -->

                        <div class="intro-price text-white"> متن مورد نظر خود را قرار دهید!</div><!-- End .intro-price -->

                        <a href="category.html" class="btn btn-white-primary btn-round">
                            <span>خرید</span>
                            <i class="icon-long-arrow-left"></i>
                        </a>
                    </div><!-- End .intro-content -->
                </div><!-- End .intro-slide -->

                <div class="intro-slide">
                    <figure class="slide-image">
                        <picture>
                            <source media="(max-width: 480px)"
                                    srcset="<?php echo TNM_URL . '/assets/images/demos/demo-10/slider/slide-2-480w.jpg'?>">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/slider/slide-2.jpg'?>" alt="Image Desc">
                        </picture>
                    </figure><!-- End .slide-image -->

                    <div class="intro-content">
                        <h3 class="intro-subtitle">بنر مورد نظر خود را قرار دهید! </h3><!-- End .h3 intro-subtitle -->
                        <h1 class="intro-title text-white"> متن مورد نظر خود را قرار دهید!</h1>
                        <!-- End .intro-title -->

                        <div class="intro-price text-white"> متن مورد نظر خود را قرار دهید</div><!-- End .intro-price -->

                        <a href="category.html" class="btn btn-white-primary btn-round">
                            <span>خرید</span>
                            <i class="icon-long-arrow-left"></i>
                        </a>
                    </div><!-- End .intro-content -->
                </div><!-- End .intro-slide -->

                <div class="intro-slide">
                    <figure class="slide-image">
                        <picture>
                            <source media="(max-width: 480px)"
                                    srcset="<?php echo TNM_URL . '/assets/images/demos/demo-10/slider/slide-3-480w.jpg'?>">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/slider/slide-3.jpg'?>" alt="Image Desc">
                        </picture>
                    </figure><!-- End .slide-image -->

                    <div class="intro-content">
                        <h3 class="intro-subtitle text-white">بنر مورد نظر خود را قرار دهید!</h3>
                        <!-- End .h3 intro-subtitle -->
                        <h1 class="intro-title text-white"> متن مورد نظر خود را قرار دهید!</h1><!-- End .intro-title -->

                        <div class="intro-price text-white"> متن مورد نظر خود را قرار دهید!</div><!-- End .intro-price -->

                        <a href="category.html" class="btn btn-white-primary btn-round">
                            <span>خرید</span>
                            <i class="icon-long-arrow-left"></i>
                        </a>
                    </div><!-- End .intro-content -->
                </div><!-- End .intro-slide -->
            <?php endif; ?>

        </div>

        <span class="slider-loader"></span>
    </div>
</div>



