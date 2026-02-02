<div class="container">
    <div  class="row align-items-center bg-light rounded overflow-hidden mb-4 flex-column flex-lg-row div-me-banner">


        <div class="col-lg-6 text-center p-4" >
            <div class="d-flex justify-content-center gap-3 flex-wrap" >
                <?php $social_media = get_option('_tnm_social_media_website'); ?>
                <a href="<?php echo esc_url($social_media['instagram']); ?>">
                <img src="<?php echo TNM_URL . '/assets/images/social-media.png'?>"
                     alt="instagram" class="img-fluid img-me-banner">
                </a>
                <a href="<?php echo esc_url($social_media['telegram']); ?>">
                <img src="<?php echo TNM_URL . '/assets/images/social-media-2.png' ?>"
                     alt="telegram" class="img-fluid img-me-banner">
                </a>
                <a href="<?php echo esc_url($social_media['discord']); ?>">
                <img src="<?php echo TNM_URL . '/assets/images/social-media-3.png' ?>"
                     alt="whatsApp" class="img-fluid img-me-banner">
                </a>
            </div>
        </div>

        <!-- ستون محتوا -->
        <div class="col-lg-6 text-start p-4">
            <h3 class="cta-title text-primary mb-2">همین حالا به ما در شبکه‌های اجتماعی بپیوندید</h3>
            <p class="cta-desc mb-3">
                <em class="font-weight-medium">اخبار، محصولات جدید و پاسخ سریع | </em> فقط یک کلیک با ما فاصله دارید.
            </p>
        </div>
    </div>
</div>
