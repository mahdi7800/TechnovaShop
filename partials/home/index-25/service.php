<div class="container pt-3 pt-md-7 small-group">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-9 col-12 popular mb-3 mb-lg-0">
            <div class="heading heading-center">
                <h2 class="title text-uppercase mb-3">محصولات محبوب</h2>
                <span class="cross-txt position-relative py-2 pb-0">
                                <i class="la la-diamond h5 mb-0"></i>
                            </span>
            </div>
            <div>
             <?php get_template_part('loop/home/index-25/product-rating-loop','product-rating-loop'); ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-10 col-12 lookbook order-lg-0 order-md-last mb-3 mb-lg-0">
            <div class="heading heading-center">
                <h2 class="title text-uppercase mb-3">لوک بوک</h2>
                <span class="cross-txt position-relative py-2 pb-0">
                                <i class="la la-diamond h5 mb-0"></i>
                            </span>
            </div>
            <div class="owl-carousel owl-simple owl-nav-inside row cols-1 cols-sm-2 cols-lg-1"
                 data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "rtl": true,
                            "responsive": {
                                "0": {
                                    "items": 1
                                },
                                "576": {
                                    "items": 2,
                                    "margin": 20
                                },
                                "992": {
                                    "items": 1
                                }
                            }
                        }'>
                <div class="banner banner-overlay bg-image"
                     style="background-image: url(<?php echo TNM_URL . '/assets/images/demos/demo-25/banners/banner-6.jpg' ?>);">
                    <div class="banner-content text-center banner-content-center pb-0 pb-lg-1">
                        <div class="my-3">
                            <span class="banner-dot position-relative d-inline-block"></span>
                            <span class="banner-dot position-relative d-inline-block"></span>
                            <span class="banner-dot position-relative d-inline-block"></span>
                        </div>
                        <h4
                                class="banner-subtitle font-size-normal letter-spacing-large text-white text-uppercase">
                            ازدواج و مُد<br>زیورآلات</h4>
                    </div>
                </div>
                <div class="banner banner-overlay bg-image"
                     style="background-image: url(<?php echo TNM_URL . '/assets/images/demos/demo-25/banners/banner-7.jpg'?>);">
                    <div class="banner-content text-center banner-content-center pb-0 pb-lg-1">
                        <div class="my-3">
                            <span class="banner-dot position-relative d-inline-block"></span>
                            <span class="banner-dot position-relative d-inline-block"></span>
                            <span class="banner-dot position-relative d-inline-block"></span>
                        </div>
                        <h4
                                class="banner-subtitle font-size-normal letter-spacing-large text-white text-uppercase">
                            طراحی های ما<br>سفارشی</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-9 col-12 service mb-3 mb-lg-0">
            <div class="heading heading-center">
                <h2 class="title text-uppercase mb-3">خدمات ما</h2>
                <span class="cross-txt position-relative py-2 pb-0">
                                <i class="la la-diamond h5 mb-0"></i>
                            </span>
            </div>
            <div class="owl-carousel owl-simple owl-nav-inside row cols-1" data-toggle="owl"
                 data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "loop": false,
                            "items": 1
                        }'>
                <div class="icon-boxes text-center">
                    <div class="icon-box justify-content-center d-flex flex-column mb-0 pt-4">
                        <span class="icon-box-icon mb-1 text-dark"><i class="icon-truck"></i></span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title font-size-normal letter-spacing-large text-uppercase">
                                ارسال و پرداخت</h3>
                            <p class="font-weight-normal font-size-normal">ارسال رایگان برای سفارشات بالای
                                50 هزار تومان
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-simple owl-nav-inside row cols-1" data-toggle="owl"
                 data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "loop": false,
                            "items": 1
                        }'>
                <div class="icon-boxes text-center">
                    <div class="icon-box justify-content-center d-flex flex-column mb-0 pt-4">
                        <span class="icon-box-icon mb-1 text-dark"><i class="icon-rotate-left"></i></span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title font-size-normal letter-spacing-large text-uppercase">
                                بازگشت و مرجوعی</h3>
                            <p class="font-weight-normal font-size-normal">ضمانت 100% بازگشت وجه
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel owl-simple owl-nav-inside row cols-1" data-toggle="owl"
                 data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "loop": false,
                            "items": 1
                        }'>
                <div class="icon-boxes text-center">
                    <div class="icon-box justify-content-center d-flex flex-column mb-0 pt-4">
                        <span class="icon-box-icon mb-1 text-dark"><i class="la la-unlock"></i></span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title font-size-normal letter-spacing-large text-uppercase">
                                پرداخت ایمن</h3>
                            <p class="font-weight-normal font-size-normal">100% پرداخت امن</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>