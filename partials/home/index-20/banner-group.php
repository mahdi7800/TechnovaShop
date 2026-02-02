<div class="banner-group mb-2">
    <div class="container">
        <div class="row justify-content-center">
            <?php
            global $wpdb;
            $table = $wpdb->prefix . 'tns_banner';
            $banners = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 3", ARRAY_A);
            if (!empty($banners)) :

                foreach ($banners as $banner) : ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="banner banner-overlay">
                            <a href="<?php echo esc_url($banner['link_url']); ?>">
                                <img src="<?php echo esc_url($banner['image_url'])?>" alt="بنر">
                            </a>
                            <?php $main_title = explode('|',esc_html($banner['title'])) ;   ?>
                            <div class="banner-content text-right">
                                <h4 class="banner-subtitle text-white"><a href="#"><?php echo $main_title[0] ?></a>
                                </h4><!-- End .banner-subtitle -->
                                <h3 class="banner-title text-white"><a href="#"><?php echo $main_title[1] ?></a>
                                </h3><!-- End .banner-title -->
                                <a href="<?php echo esc_url($banner['link_url']); ?>" class="btn btn-outline-white-3 banner-link">مشاهده<i
                                            class="icon-long-arrow-left"></i></a>
                            </div><!-- End .banner-content -->
                        </div><!-- End .banner -->
                    </div><!-- End .col-lg-4 -->
                <?php  endforeach; ?>
            <?php else : ?>
                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/banners/banner-6.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle text-white"><a href="#">بنر نظر خود را قرار دهید!</a>
                            </h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#">متن مورد نظر خود را قرار دهید!</a>
                            </h3><!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white-3 banner-link">مشاهده<i
                                        class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-4 -->

                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/banners/banner-7.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle text-white"><a href="#">بنر نظر خود را قرار دهید!</a>
                            </h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#">متن مورد نظر خود را قرار دهید!</a>
                            </h3><!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white-3 banner-link">مشاهده<i
                                        class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-4 -->

                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/banners/banner-8.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content text-right">
                            <h4 class="banner-subtitle text-white"><a href="#">بنر نظر خود را قرار دهید!</a>
                            </h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#">متن مورد نظر خود را قرار دهید!</a></h3><!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white-3 banner-link">مشاهده<i
                                        class="icon-long-arrow-left"></i></a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-4 -->
            <?php endif; ?>
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .banner-group -->