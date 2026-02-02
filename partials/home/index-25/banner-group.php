<div class="container">
    <div class="banner-group my-md-n5 mt-1">
        <div class="row no-gutters">
            <?php
            global $wpdb;
            $table = $wpdb->prefix . 'tns_banner';
            $banners = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 3", ARRAY_A);
            if (!empty($banners)) :

            foreach ($banners as $banner) : ?>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="banner mb-0">
                        <a href="<?php echo esc_url($banner['link_url']); ?>">
                            <img src="<?php echo esc_url($banner['image_url'])?>" alt="Banner" width="390"
                                 height="500" />
                        </a>
                        <div class="banner-content text-center banner-content-center mb-0 my-md-4">
                            <?php $main_title = explode('|',esc_html($banner['title'])) ;   ?>
                            <h4
                                    class="banner-subtitle font-size-normal letter-spacing-large text-white text-uppercase font-weight-normal">
                                <?php echo $main_title[0] ?>
                            </h4>
                            <h3 class="banner-title text-white font-weight-normal text-uppercase my-4 mb-0">
                                <?php echo $main_title[1] ?>
                            </h3>
                            <h3 class="banner-price text-white text-uppercase my-4 mt-0">30% تخفیف</h3>
                            <a href="<?php echo esc_url($banner['link_url']); ?>"
                               class="btn font-size-normal letter-spacing-large btn-dark text-uppercase mt-0 mt-md-3 font-weight-normal text-uppercase">شروع
                                خرید</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php else : ?>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="banner mb-0">
                    <a href="#">
                        <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/banners/banner-1.jpg'?>" alt="Banner" width="390"
                             height="500" />
                    </a>
                    <div class="banner-content text-center banner-content-center mb-0 my-md-4">
                        <h4
                            class="banner-subtitle font-size-normal letter-spacing-large text-white text-uppercase font-weight-normal">
                            بنر نظر خود را قرار دهید!</h4>
                        <h3 class="banner-title text-white font-weight-normal text-uppercase my-4 mb-0">
                            متن مورد نظر خود را قرار دهید!</h3>
                        <h3 class="banner-price text-white text-uppercase my-4 mt-0">متن مورد نظر خود را قرار دهید!</h3>
                        <a href="#"
                           class="btn font-size-normal letter-spacing-large btn-dark text-uppercase mt-0 mt-md-3 font-weight-normal text-uppercase">شروع
                            خرید</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="banner banner-overlay mb-0 banner-middle bg-image"
                     style="background-image: url(<?php echo TNM_URL . '/assets/images/demos/demo-25/banners/banner-2.jpg'?>)">
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="banner mb-0" style="background-color: #f9f9f9;">
                    <a href="#">
                        <img src="<?php echo TNM_URL . '/assets/images/demos/demo-25/banners/banner-3.jpg'?>" alt="Banner" width="390"
                             height="500" />
                    </a>
                    <div class="banner-content text-center banner-content-center mt-2 mt-md-5">
                        <h4
                                class="banner-subtitle font-size-normal letter-spacing-large text-dark text-uppercase font-weight-normal">
                            بنر نظر خود را قرار دهید!</h4>
                        <h3 class="banner-title font-weight-normal text-dark mt-1 my-1">
                            متن مورد نظر خود را قرار دهید!</h3>
                        <a href="#"
                           class="btn font-size-normal letter-spacing-large btn-dark text-uppercase mt-4 font-weight-normal text-uppercase">شروع
                            خرید</a>
                    </div>
                </div>
            </div>
           <?php endif; ?>
        </div>
    </div>
</div>