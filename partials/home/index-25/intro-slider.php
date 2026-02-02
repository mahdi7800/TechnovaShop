<div class="intro-slider-container">
    <div class="intro-slider owl-carousel owl-theme owl-nav-inside  row cols-1" data-toggle="owl"
         data-owl-options='{
                        "dots": true,
                        "nav": false,
                        "rtl": true,
                        "autoplay": true,
                        "autoplayTimeout": 10000,
                        "animateOut": "fadeOut"
                    }'>
        <?php
        global $wpdb;
        $table = $wpdb->prefix . 'tns_sliders';
        $sliders = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 2", ARRAY_A);
        if ($sliders) :
        foreach ( $sliders as $slider) :
        $image_sliders = explode( '++', $slider['p_image'] );
        $mobile_image  = isset( $image_sliders[0] ) ? esc_url( trim( $image_sliders[0] ) ) : '';
        $desktop_image = isset( $image_sliders[1] ) ? esc_url( trim( $image_sliders[1] ) ) : $mobile_image; ?>
            <div class="intro-slide bg-image intro-1 d-flex align-items-center"
                 style="background-image: url(<?php echo esc_url($slider['p_image']) ?>); background-color: #222;">
                <div class="container">
                    <div class="intro-content position-static p-3 p-lg-0">
                        <h4
                                class="intro-subtitle font-size-normal letter-spacing-large text-primary text-uppercase font-weight-normal mb-1">
                            <span><?php echo esc_html($slider['top_title']); ?></span></h4>
                        <h2 class="intro-title my-2 font-weight-normal text-uppercase"><?php echo esc_html($slider['main_title']); ?></h2>
                        <h2 class="intro-price text-white mb-2"><?php echo esc_html($slider['sub_title']); ?></h2>
                        <a href="<?php echo esc_url($slider['p_thumbnail']) ?>"
                           class="btn font-size-normal letter-spacing-large btn-white text-uppercase mb-2 mt-2">شروع
                            خرید</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="intro-slide bg-image intro-1 d-flex align-items-center"
                 style="background-image: url(<?php echo TNM_URL . '/assets/images/demos/demo-25/slider/slider-1.jpg'?>); background-color: #222;">
                <div class="container">
                    <div class="intro-content position-static p-3 p-lg-0">
                        <h4
                                class="intro-subtitle font-size-normal letter-spacing-large text-primary text-uppercase font-weight-normal mb-1">
                            <span>بنر نظر خود را قرار دهید!</span></h4>
                        <h2 class="intro-title my-2 font-weight-normal text-uppercase"></h2>
                        <h2 class="intro-price text-white mb-2"><span class="text-primary">متن مورد نظر خود را قرار دهید!</span></i></h2>
                        <a href="#"
                           class="btn font-size-normal letter-spacing-large btn-white text-uppercase mb-2 mt-2">شروع
                            خرید</a>
                    </div>
                </div>
            </div>
            <div class="intro-slide bg-image intro-2 d-flex align-items-center"
                 style="background-image: url(<?php echo TNM_URL . '/assets/images/demos/demo-25/slider/slider-2.jpg'?>); background-color: #222;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <div class="intro-content position-static p-3 p-lg-0">
                                <h4
                                        class="intro-subtitle font-size-normal letter-spacing-large text-primary text-uppercase font-weight-normal mb-1">
                                    <span>بنر نظر خود را قرار دهید!</span></h4>
                                <h2 class="intro-title my-2 mt-0 font-weight-normal text-uppercase mb-0">متن مورد نظر خود را قرار دهید!</h2>
                                <a href="#"
                                   class="btn font-size-normal letter-spacing-large btn-white font-weight-normal text-uppercase mb-2 mt-2">شروع
                                    خرید</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>