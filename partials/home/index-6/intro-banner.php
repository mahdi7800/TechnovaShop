<div class="intro-slider-container">
    <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
         data-owl-options='{
                        "dots": false,
                        "nav": false,
                        "rtl": true,
                            "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>

    <?php
        global $wpdb;
        $table = $wpdb->prefix . 'tns_sliders';
        $sliders = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 3", ARRAY_A);
        if ($sliders) :
        foreach ( $sliders as $slider) : ?>

            <?php
            $image_sliders = explode( '++', $slider['p_image'] );
            $mobile_image  = isset( $image_sliders[0] ) ? esc_url( trim( $image_sliders[0] ) ) : '';
            $desktop_image = isset( $image_sliders[1] ) ? esc_url( trim( $image_sliders[1] ) ) : $mobile_image;
            ?>
            <div class="intro-slide"
                 style="background-image: url(<?php echo $slider['p_image'] ?>);">
                <div class="container intro-content text-center">
                    <h3 class="intro-subtitle text-white"><?php echo esc_html($slider['top_title']); ?></h3>
                    <!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title text-white"><?php echo esc_html($slider['main_title']); ?></h1><!-- End .intro-title -->

                    <a href="<?php echo esc_url($slider['p_thumbnail']) ?>" class="btn btn-outline-white-4">
                        <span>مشاهده</span>
                    </a>
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->
            <?php endforeach; ?>
        <?php else : ?>
            <div class="intro-slide"
                 style="background-image: url(<?php echo  TNM_URL. '/assets/images/demos/demo-6/slider/slide-1.jpg'?>);">
                <div class="container intro-content text-center">
                    <h3 class="intro-subtitle text-white">عالی به نظر برسید</h3>
                    <!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title text-white">بنر و متن مورد نظر خود را قرار دهید!</h1><!-- End .intro-title -->

                    <a href="category.html" class="btn btn-outline-white-4">
                        <span>مشاهده</span>
                    </a>
                </div><!-- End .intro-content -->
            </div><!-- End .intro-slide -->
            <?php endif; ?>
    </div><!-- End .intro-slider owl-carousel owl-theme -->

    <span class="slider-loader"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->
<div class="mb-5"></div><!-- End .mb-5 -->
