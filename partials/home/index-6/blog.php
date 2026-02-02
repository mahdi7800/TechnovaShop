<div class="blog-posts mb-5">
    <div class="container">
        <h2 class="title text-center mb-4">اخبار فروشگاه ما</h2><!-- End .title text-center -->

        <div class="owl-carousel owl-simple mb-3" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "rtl": true,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
            <?php get_template_part('loop/home/index-6/blog-loop','blog-loop'); ?>
        </div><!-- End .owl-carousel -->
        <div class="more-container text-center mt-5">
            <a href="<?php echo site_url('blog'); ?>" class="btn btn-outline-lightgray btn-more btn-round"><span>مشاهده اخبار
                                بیشتر</span><i class="icon-long-arrow-left"></i></a>
        </div><!-- End .more-container -->
    </div><!-- End .container -->
</div><!-- End .blog-posts -->