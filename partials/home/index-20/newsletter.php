<?php $active_newsletter =  get_option('_tnm_settings_set_general');
if($active_newsletter['newsletter_enable'] === 'yes') :?>
<div class="cta-newsletter text-center pt-6 pb-7">
    <div class="container">
        <span class="cta-icon"><i class="icon-envelope"></i></span>
        <h3 class="title text-center">عضویت در خبرنامه ما</h3><!-- End .title -->
        <p class="title-desc text-center">با عضویت در خبرنامه از جدیدترین محصولات و تخفیف ها باخبر شوید</p>
        <!-- End .title-desc -->

        <form action="#" class="tns_newsletter_form">
            <div class="input-group">
                <input type="email" class="form-control tns_newsletter_form_input_email" placeholder="آدرس ایمیل خود را وارد کنید"
                       aria-label="Email Adress" aria-describedby="newsletter-btn" >
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="newsletter-btn"><span>عضویت</span><i
                            class="icon-long-arrow-left"></i></button>
                </div><!-- .End .input-group-append -->
            </div><!-- .End .input-group -->
        </form>
    </div><!-- End .container -->
</div><!-- End .cta-newsletter -->
<?php endif; ?>