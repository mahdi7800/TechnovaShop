<footer class="footer footer-dark">
    <?php $active_newsletter =  get_option('_tnm_settings_set_general');
    if($active_newsletter['newsletter_enable'] === 'yes') : ?>
        <div class="cta bg-image bg-dark pt-4 pb-5 mb-0"
             style="background-image: url(<?php echo  TNM_URL .'/assets/images/demos/demo-10/bg-2.jpg'?>);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <div class="cta-heading text-center">
                            <h3 class="cta-title text-white">عضویت در خبرنامه ما</h3>
                            <!-- End .cta-title -->
                            <p class="cta-desc text-white text-center">و دریافت <span
                                    class="font-weight-normal">تخفیف 20 هزار
                                        تومانی</span> برای اولین خرید</p><!-- End .cta-desc -->
                        </div><!-- End .text-center -->

                        <form class="tns_newsletter_form" action="#">
                            <div class="input-group input-group-round">
                                <input type="text" class="form-control form-control-white tns_newsletter_form_input_email"
                                       placeholder="آدرس ایمیل خود را وارد کنید" aria-label="Email Adress" >
                                <div class="input-group-append">
                                    <button class="btn btn-white" type="submit"><span>عضویت</span><i
                                            class="icon-long-arrow-left"></i></button>
                                </div><!-- .End .input-group-append -->
                            </div><!-- .End .input-group -->
                        </form>
                    </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cta -->
    <?php endif; ?>
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <?php if(! empty( get_site_icon_url() )) : ?>
                            <a href="<?php echo home_url(); ?>" class="logo">
                                <img src="<?php echo get_site_icon_url();  ?>" class="footer-logo"
                                     alt="Footer Logo" width="105" height="25">
                            </a>
                        <?php else : ?>
                            <a href="<?php echo home_url(); ?>" class="logo">
                                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-10/logo-footer.png'?>" class="footer-logo"
                                     alt="Footer Logo" width="105" height="25">
                            </a>
                        <?php endif; ?>
                        <?php if (!empty(get_bloginfo('description'))): ?>
                            <p><?php echo get_bloginfo('description'); ?></p>
                        <?php else : ?>
                            <div class="alert alert-info">لطفا توضیحات کوتاه وب سایت را کامل کنید!!!</div>
                        <?php endif; ?>
                        <div class="social-icons">
                            <?php
                            $setting_website_general = get_option('_tnm_settings_set_general', []);

                            if ( ! empty( $setting_website_general['link_enamad']) || !empty($setting_website_general['link_zarinpal'])) :


                            if ( ! empty( $setting_website_general['link_enamad'] ) ) :
                                $enamad = esc_url( $setting_website_general['link_enamad'] );
                                ?>
                                <a href="<?php echo $enamad; ?>" target="_blank" rel="noopener" class="brand">
                                    <img src="<?php echo esc_url( TNM_URL . '/assets/images/enamad-full-star.png' ); ?>"
                                         alt="نماد اعتماد الکترونیکی"
                                         style="height:100px;margin-left:30px;">
                                </a>
                            <?php endif; ?>

                            <?php

                            if ( ! empty( $setting_website_general['link_zarinpal'] ) ) :
                            $zarinpal = esc_url( $setting_website_general['link_zarinpal'] );
                            ?>
                                <script src="<?php echo $zarinpal; ?>" type="text/javascript"></script>
                            <?php endif; ?>

                            <?php else : ?>
                                <!-- آیکون‌های پیش‌فرض شبکه‌های اجتماعی -->
                                <?php
                                $whatsapp =   get_option('_tnm_social_media_website')['whatsapp'] ?? '' ;
                                $instagram =  get_option('_tnm_social_media_website')['instagram']?? '';
                                $telegram =   get_option('_tnm_social_media_website')['telegram']?? '';
                                ?>
                                <a href="<?php echo esc_url($telegram); ?>>" class="social-icon" title="تلگرام" target="_blank"><i class="icon-telegram"></i></a>
                                <a href="<?php echo esc_url($whatsapp) ?>>" class="social-icon" title="واتساپ" target="_blank"><i class="icon-whatsapp"></i></a>
                                <a href="<?php echo esc_url($instagram) ?>" class="social-icon" title="اینستاگرام" target="_blank"><i class="icon-instagram"></i></a>

                            <?php endif; ?>
                        </div><!-- End .social-icons -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">لینک های مفید</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <?php
                            $args = [
                                'theme_location' => 'footer-menu-useful-link',
                                'container'      => false,
                                'fallback_cb'    => function () {
                                    echo '<li><a href="#">Menu not set</a></li>';
                                },
                                'items_wrap'     => '<li><a href="#">%3$s</a></li>',
                                'depth'          => 1,
                                'walker'         => new bootstrap_5_wp_nav_menu_walker()
                            ];
                            wp_nav_menu($args);
                            ?>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">خرید از ما</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <?php
                            $args = [
                                'theme_location' => 'footer-menu-category',
                                'container'      => false,
                                'fallback_cb'    => function () {
                                    echo '<li><a href="#">Menu not set</a></li>';
                                },
                                'items_wrap'     => '<li><a href="#">%3$s</a></li>',
                                'depth'          => 1,
                                'walker'         => new bootstrap_5_wp_nav_menu_walker()
                            ];

                            wp_nav_menu($args);
                            ?>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">

                        <h4 class="widget-title">خدمات مشتریان</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <?php
                            $args = [
                                'theme_location' => 'footer-menu-customer-service',
                                'container'      => false,
                                'fallback_cb'    => function () {
                                    echo '<li><a href="#">Menu not set</a></li>';
                                },
                                'items_wrap'     => '<li><a href="#">%3$s</a></li>',
                                'depth'          => 1,
                                'walker'         => new bootstrap_5_wp_nav_menu_walker()
                            ];

                            wp_nav_menu($args);
                            ?>
                        </ul>
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">  کپی رایت © 2025 تمامی حقوق مطلق به وب سایت   <?php  bloginfo('name'); ?> محفوظ است.  </p>
            <div class="social-icons social-icons-color">
                <p class="footer-copyright"><a href="https://mahdidavoodi.ir">طراح وب سایت گروه مهندسی شانول</a></p>
            </div><!-- End .soial-icons -->
            <!-- End .footer-copyright -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->