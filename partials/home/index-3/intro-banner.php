<div class="intro-section pt-3 pb-3 mb-2">
    <div class="container">
        <div class="row">
            <?php
            global $wpdb;
            $table   = $wpdb->prefix . 'tns_sliders';
            $sliders = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 3", ARRAY_A);
            ?>

            <div class="col-lg-8">
                <div class="intro-slider-container slider-container-ratio mb-2 mb-lg-0">

                    <div class="intro-slider owl-carousel owl-simple owl-dark owl-nav-inside"
                         data-toggle="owl"
                         data-owl-options='{
                "nav": false,
                "dots": true,
                "rtl": true,
                "responsive": {
                    "768": { "nav": true, "dots": false }
                }
             }'>

                        <?php if ($sliders) : ?>

                            <?php foreach ($sliders as $slider) : ?>
                                <?php
                                $image_sliders = explode('++', $slider['p_image']);
                                $mobile_image  = isset($image_sliders[0]) ? esc_url(trim($image_sliders[0])) : '';
                                $desktop_image = isset($image_sliders[1]) ? esc_url(trim($image_sliders[1])) : $mobile_image;
                                ?>
                                <div class="intro-slide">

                                    <figure class="slide-image">
                                        <picture>
                                            <source media="(max-width: 480px)" srcset="<?php echo $mobile_image; ?>">
                                            <img src="<?php echo $desktop_image; ?>" alt="<?php echo esc_attr($slider['main_title']); ?>">
                                        </picture>
                                    </figure>

                                    <div class="intro-content">
                                        <h3 class="intro-subtitle text-primary">
                                            <?php echo esc_html($slider['top_title']); ?>
                                        </h3>

                                        <h1 class="intro-title">
                                            <?php echo esc_html($slider['main_title']); ?>
                                        </h1>

                                        <div class="intro-price">
                                <span class="text-primary">
                                    <?php echo esc_html($slider['sub_title']); ?>
                                </span>
                                        </div>

                                        <a href="<?php echo esc_url($slider['p_thumbnail']); ?>" class="btn btn-primary btn-round">
                                            <i class="icon-long-arrow-left"></i>
                                            <span>اینجا کلیک کنید</span>
                                        </a>
                                    </div>

                                </div>
                            <?php endforeach; ?>

                        <?php else : ?>

                            <!-- ================================
                                 اسلایدر پیش‌فرض (فقط وقتی دیتابیس خالیه)
                            ================================== -->

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)"
                                                srcset="<?php echo TNM_URL . '/assets/images/demos/demo-3/slider/slide-1-480w.jpg'; ?>">
                                        <img src="<?php echo TNM_URL . '/assets/images/demos/demo-3/slider/slide-1.jpg'; ?>"
                                             alt="اسلایدر پیش‌فرض">
                                    </picture>
                                </figure>

                                <div class="intro-content">
                                    <h3 class="intro-subtitle text-primary">بنر نظر خود را قرار دهید!</h3>
                                    <h1 class="intro-title">متن مورد نظر خود را قرار دهید!</h1>

                                    <div class="intro-price">
                                        <span class="text-primary">247,000 تومان</span>
                                    </div>

                                    <a href="#" class="btn btn-primary btn-round">
                                        <i class="icon-long-arrow-left"></i>
                                        <span>اینجا کلیک کنید</span>
                                    </a>
                                </div>
                            </div>

                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)"
                                                srcset="<?php echo TNM_URL . '/assets/images/demos/demo-3/slider/slide-2-480w.jpg'; ?>">
                                        <img src="<?php echo TNM_URL . '/assets/images/demos/demo-3/slider/slide-2.jpg'; ?>"
                                             alt="اسلایدر پیش‌فرض 2">
                                    </picture>
                                </figure>

                                <div class="intro-content">
                                    <h3 class="intro-subtitle text-primary">بنر نظر خود را قرار دهید!</h3>
                                    <h1 class="intro-title">متن مورد نظر خود را قرار دهید!</h1>

                                    <div class="intro-price" dir="rtl">
                                        <span class="text-primary">29,999 تومان</span>
                                    </div>

                                    <a href="#" class="btn btn-primary btn-round">
                                        <i class="icon-long-arrow-left"></i>
                                        <span>اینجا کلیک کنید</span>
                                    </a>
                                </div>
                            </div>

                        <?php endif; ?>

                    </div><!-- intro-slider -->

                    <span class="slider-loader"></span>
                </div><!-- intro-slider-container -->
            </div><!-- col-lg-8 -->

            <div class="col-lg-4">
                <div class="intro-banners">
                    <?php
                    global $wpdb;
                    $table = $wpdb->prefix . 'tns_banner';
                    $banners = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 3", ARRAY_A);

                    if (!empty($banners)) :
                        foreach ($banners as $banner) :
                            // مقادیر امن‌سازی شده
                            $image_url = !empty($banner['image_url']) ? esc_url($banner['image_url']) : '';
                            $url       = !empty($banner['url']) ? esc_url($banner['url']) : '#';
                            $link_url  = !empty($banner['link_url']) ? esc_url($banner['link_url']) : '#';
                            $titles    = !empty($banner['title']) ? explode('|', esc_html($banner['title'])) : ['', ''];
                            $subtitle  = $titles[0] ?? '';
                            $title     = $titles[1] ?? '';
                            ?>
                            <div class="banner mb-lg-1 mb-xl-2">
                                <?php if ($image_url) : ?>
                                    <a href="<?php echo $url; ?>">
                                        <img src="<?php echo $image_url; ?>" alt="<?php echo $title ?: 'بنر'; ?>">
                                    </a>
                                <?php endif; ?>
                                <div class="banner-content text-right">
                                    <?php if ($subtitle) : ?>
                                        <h4 class="banner-subtitle d-lg-none d-xl-block">
                                            <a href="#"><?php echo $subtitle; ?></a>
                                        </h4>
                                    <?php endif; ?>

                                    <?php if ($title) : ?>
                                        <h3 class="banner-title text-dark">
                                            <a href="<?php echo $link_url; ?>"><?php echo $title; ?></a>
                                        </h3>
                                    <?php endif; ?>

                                    <a href="<?php echo $link_url; ?>" class="banner-link">
                                        خرید <i class="icon-long-arrow-left"></i>
                                    </a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        <?php
                        endforeach; ?>
                <?php else: ?>
                    <div class="banner mb-lg-1 mb-xl-2">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/banners/banner-1.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">بنر نظر خود را قرار دهید!</a>
                            </h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-dark"><a href="#">متن مورد نظر خود را قرار دهید!</a></h3>
                            <!-- End .banner-title -->
                            <a href="#" class="banner-link">خرید<i class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->

                    <div class="banner mb-lg-1 mb-xl-2">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/banners/banner-2.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">بنر نظر خود را قرار دهید!</a>
                            </h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-dark"><a href="#">متن مورد نظر خود را قرار دهید!</span></a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">خرید<i class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->

                    <div class="banner mb-0">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-3/banners/banner-3.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="#">بنر نظر خود را قرار دهید!</a>
                            </h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-dark"><a href="#">متن مورد نظر خود را قرار دهید!</a></h3>
                            <!-- End .banner-title -->
                            <a href="#" class="banner-link">خرید<i class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                <?php endif; ?>
                </div><!-- End .intro-banners -->
            </div><!-- End .col-lg-4 -->

        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .intro-section -->