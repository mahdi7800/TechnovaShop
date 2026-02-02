<?php
global $wpdb;
$table = $wpdb->prefix . 'tns_banner';
$banners = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC LIMIT 2", ARRAY_A);
if (!empty($banners)) :?>
<div class="pt-2 pb-3">
    <div class="container">
        <div class="row">
            <?php foreach ($banners as $banner) :?>
            <div class="col-sm-6">
                <div class="banner banner-overlay">
                    <a href="<?php echo esc_url($banner['link_url']); ?>">
                        <img src="<?php echo esc_url($banner['image_url'])?>" alt="بنر">
                    </a>
                    <?php $main_title = explode('|',esc_html($banner['title'])) ;   ?>
                    <div class="banner-content banner-content-center">

                        <h4 class="banner-subtitle text-white"><a href="#"><?php echo $main_title[0] ?></a></h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title text-white"><a href="#"><strong><?php echo $main_title[1] ?></strong></h3>
                        <!-- End .banner-title -->
                        <a href="<?php echo esc_url($banner['link_url']); ?>" class="btn btn-outline-white banner-link underline">خرید</a>
                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-sm-6 -->
            <?php endforeach;?>
        </div><!-- End .row -->
        <hr class="mt-0 mb-0">
    </div><!-- End .container -->
</div><!-- End .bg-gray -->
<?php else: ?>
    <div class="pt-2 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/banners/banner-1.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h4 class="banner-subtitle text-white"><a href="#">بنر های مورد نظر خودد را قرار دهید!!</a></h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#"><strong>زنانه</strong></h3>
                            <!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white banner-link underline">خرید</a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 -->

                <div class="col-sm-6">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/banners/banner-2.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h4 class="banner-subtitle text-white"><a href="#">بنر های مورد نظر خودد را قرار دهید!!</a></h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white"><a href="#"><strong>مردانه</strong></a></h3>
                            <!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white banner-link underline">خرید</a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-sm-6 -->
            </div><!-- End .row -->
            <hr class="mt-0 mb-0">
        </div><!-- End .container -->
    </div><!-- End .bg-gray -->
<?php endif; ?>