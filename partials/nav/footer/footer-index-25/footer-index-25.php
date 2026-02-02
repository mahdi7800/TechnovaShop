<footer class="footer my-2 mb-0" style="background-color: #222;">
    <?php
    $active_newsletter =  get_option('_tnm_settings_set_general');
    if($active_newsletter['newsletter_enable'] === 'yes') :?>
    <div class="footer-newsletter pt-4">
        <div class="container">
            <div class="heading heading-center">
                <h2 class="title my-2 mt-0">عضویت در خبرنامه ما</h2>
                <p class="text-secondary">با عضویت در خبرنامه از جدیدترین محصولات و تخفیف ها باخبر شوید</p>
            </div>
            <div class="row">
                <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                    <form action="#" class="tns_newsletter_form">
                        <div class="input-group d-sm-flex d-block">
                            <input type="email" class="form-control font-size-normal text-truncate tns_newsletter_form_input_email"
                                   placeholder="ایمیل خود را را وارد کنید" aria-label="Email Adress"
                                   aria-describedby="newsletter-btn" required="">
                            <div class="input-group-append mt-sm-0">
                                <button class="btn font-size-normal letter-spacing-large btn-white"
                                        type="submit" id="newsletter-btn"><span>عضویت</span></button>
                            </div><!-- .End .input-group-append -->
                        </div><!-- .End .input-group -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <hr class="mt-0 mb-0" style="border-top-color: #444">
    </div>
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <h4 class="widget-title text-white">درباره ما</h4><!-- End .widget-title -->
                        <?php if (!empty(get_bloginfo('description'))): ?>
                            <p class="text-secondary font-weight-normal font-size-normal"><?php echo get_bloginfo('description'); ?></p>
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
                        <h4 class="widget-title text-white">لینک های مفید</h4><!-- End .widget-title -->

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
                        <h4 class="widget-title text-white">خدمات مشتری</h4><!-- End .widget-title -->

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
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title text-white">حساب کاربری</h4><!-- End .widget-title -->

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
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div>
    <div class="footer-bottom">
        <div class="container flex-column align-items-center pt-5">

            <?php if(!empty(get_site_icon_url())) : ?>
                <a href="<?php echo home_url(); ?>"><img src="<?php site_icon_url(); ?>" alt="<?php bloginfo('name'); ?>" width="82" height="25"></a>
            <?php else : ?>
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/logo-footer.png'?>" class="mb-2" alt="<?php bloginfo('name'); ?>" width="82"
                     height="25">
            <?php endif; ?>

            <p class="footer-copyright">  کپی رایت © 2025 تمامی حقوق مطلق به وب سایت   <?php  bloginfo('name'); ?> محفوظ است.  </p>
            <p class="footer-copyright"><a href="https://mahdidavoodi.ir">طراح وب سایت گروه مهندسی شانول</a></p>

        </div><!-- End .container -->
    </div>
</footer>
</div>
<button id="scroll-top" title="بازگشت به بالا"><i class="icon-arrow-up"></i></button>

