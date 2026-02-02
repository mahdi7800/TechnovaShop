
<?php $active_newsletter =  get_option('_tnm_settings_set_general');
if($active_newsletter['newsletter_enable'] === 'yes') :?>

<div class="pb-3">
        <div class="container newsletter">
            <div class="row">
                <div class="col-lg-6 banner-overlay-div">
                    <div class="banner banner-overlay">
                        <a href="<?php echo get_post_type_archive_link('product'); ?>">
                            <img src="<?php echo TNM_URL. '/assets/images/03.jpg'?>" alt="بنر">
                        </a>

                        <div class="banner-content banner-content-center">
                            <h4 class="banner-subtitle text-white"><a href="<?php echo get_post_type_archive_link('product'); ?>">محصولات تازه و جذاب</a></h4>
                            <h3 class="banner-title text-white"><a href="<?php echo get_post_type_archive_link('product'); ?>">همه محصولات ما را ببینید و بهترین‌ها را انتخاب کنید</a></h3>
                            <a href="<?php echo get_post_type_archive_link('product'); ?>" class="btn btn-outline-white banner-link underline">مشاهده محصولات</a>
                        </div><!-- End .banner-content -->
                    </div><!-- End .banner -->
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6 d-flex align-items-stretch subscribe-div">
                    <div class="cta cta-box">
                        <div class="cta-content">
                            <h3 class="cta-title">عضویت در خبرنامه ما</h3><!-- End .cta-title -->
                            <p class="text-center">همین حالا ثبت نام کنیدو <span class="primary-color">10%
                                            تخفیف</span> برای اولین
                                سفارش خود دریافت کنید
                            </p>

                            <form action="#" class="tns_newsletter_form">
                                <input type="email" class="form-control tns_newsletter_form_input_email"
                                       placeholder="آدرس ایمیل خود را وارد کنید" aria-label="Email Adress"
                                       >
                                <div class="text-center">
                                    <button class="btn btn-outline-dark-2"
                                            type="submit"><span>عضویت</span></i></button>
                                </div><!-- End .text-center -->
                            </form>
                        </div><!-- End .cta-content -->
                    </div><!-- End .cta -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-gray -->

    <div class="mb-2"></div><!-- End .mb-5 -->

    <div class="container">
    </div><!-- End .container -->
<?php endif ?>