<?php $active_newsletter =  get_option('_tnm_settings_set_general');
if($active_newsletter['newsletter_enable'] === 'yes') :?>
<div class="container">
    <div class="cta cta-separator cta-border-image cta-half mb-0"
         style="background-image: url(<?php echo TNM_URL .  '/assets/images/demos/demo-3/bg-2.jpg'?>);">
        <div class="cta-border-wrapper bg-white">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cta-wrapper cta-text text-center">
                        <h3 class="cta-title">ما را در شبکه‌های اجتماعی دنبال کنید</h3>
                        <p class="cta-desc text-center">
                            جدیدترین تخفیف‌ها، محصولات و اخبار فروشگاه را در صفحات ما ببینید 🌟
                        </p>

                        <div class="social-icons social-icons-colored justify-content-center">
                            <?php
                            $whatsapp =   get_option('_tnm_social_media_website')['whatsapp'] ?? '' ;
                            $instagram =  get_option('_tnm_social_media_website')['instagram']?? '';
                            $telegram =   get_option('_tnm_social_media_website')['telegram']?? '';
                            ?>
                            <a href="<?php echo esc_url($telegram); ?>>" class="social-icon social-telegram" title="تلگرام"
                               target="_blank"><i class="icon-telegram"></i></a>
                            <a href="<?php echo esc_url($whatsapp); ?>" class="social-icon social-whatsapp" title="واتساپ" target="_blank"><i
                                    class="icon-whatsapp"></i></a>
                            <a href="<?php echo esc_url($instagram); ?>" class="social-icon social-instagram" title="اینستاگرام"
                               target="_blank"><i class="icon-instagram"></i></a>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .cta-wrapper -->
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6">
                    <div class="cta-wrapper text-center">
                        <h3 class="cta-title">با ما همراه باشید</h3>
                        <p class="cta-desc text-center">
                            از جدیدترین <span class="text-primary">تخفیف‌ها</span> مطلع شوید و<br>
                            برای اولین خرید خود <span class="text-primary">۲۰٪ تخفیف</span> دریافت کنید
                        </p>

                        <form action="#" class="tns_newsletter_form">
                            <div class="input-group">
                                <input type="text" class="form-control tns_newsletter_form_input_email"
                                       placeholder="ایمیل خود را وارد کنید" aria-label="Email Adress" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-rounded" type="submit"><i
                                            class="icon-long-arrow-left"></i></button>
                                </div><!-- .End .input-group-append -->
                            </div><!-- .End .input-group -->
                        </form>
                    </div><!-- End .cta-wrapper -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .bg-white -->
    </div><!-- End .cta -->
</div><!-- End .container -->
<?php endif; ?>