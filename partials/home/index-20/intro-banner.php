<div class="intro-section pt-lg-2">
    <div class="container">
        <div class="row">
            <?php
            global $wpdb;
            $table = $wpdb->prefix . 'tns_sliders';
            $sliders = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 3", ARRAY_A);
            if ($sliders) :
            foreach ( $sliders as $slider) :
                $image_sliders = explode( '++', $slider['p_image'] );
                $mobile_image  = isset( $image_sliders[0] ) ? esc_url( trim( $image_sliders[0] ) ) : '';
                $desktop_image = isset( $image_sliders[1] ) ? esc_url( trim( $image_sliders[1] ) ) : $mobile_image; ?>
                <div class="col-md-12 col-lg-6">
                    <div class="banner banner-big banner-overlay">
                        <a href="<?php echo esc_url($slider['p_thumbnail']) ?>">
                            <img src="<?php echo $desktop_image; ?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle text-white"><a href="#"><?php echo esc_html($slider['top_title']); ?></a></h4>
                            <!-- End .banner-subtitle -->
                            <h2 class="banner-title text-white"><a href="#"><?php echo esc_html($slider['main_title']); ?></a></h2>
                            <!-- End .banner-title -->
                            <a href="<?php echo esc_url($slider['p_thumbnail']) ?>" class="btn btn-outline-white-3 banner-link">مشاهده بیشتر<i
                                        class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-6 -->
            <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12 col-lg-6">
                    <div class="banner banner-big banner-overlay">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/banners/banner-1.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle text-white"><a href="#">بنر نظر خود را قرار دهید!</a></h4>
                            <!-- End .banner-subtitle -->
                            <h2 class="banner-title text-white"><a href="#">متن مورد نظر خود را قرار دهید!</a></h2>
                            <!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white-3 banner-link">مشاهده بیشتر<i
                                        class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-6 -->

                <div class="col-md-12 col-lg-6">
                    <div class="banner banner-big banner-overlay">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/banners/banner-1.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle text-white"><a href="#">بنر نظر خود را قرار دهید!</a></h4>
                            <!-- End .banner-subtitle -->
                            <h2 class="banner-title text-white"><a href="#">متن مورد نظر خود را قرار دهید!</a></h2>
                            <!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white-3 banner-link">مشاهده بیشتر<i
                                        class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-6 -->
            <?php endif; ?>
        </div><!-- End .row -->
    </div><!-- End .container -->
