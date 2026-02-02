<div class="bg-lighter blog-section pt-6 pb-5">
    <div class="container">
        <div class="heading heading-center">
            <h1 class="title text-uppercase mb-3"> بلاگ </h1>
        </div>
        <div class="owl-carousel owl-simple shadow-carousel rows cols-1 cols-sm-2 cols-lg-3 cols-xl-4"
             data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "items": 4,
                            "margin": 20,
                            "loop": false,
                            "rtl": true, 
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "576": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                },
                                "1200": {
                                    "items":4
                                }
                            }
                        }'>
           <?php get_template_part('loop/home/index-25/blog-loop','blog-loop'); ?>
        </div>
        <div class="more-container text-center mt-5">
            <a href="<?php echo site_url('blog'); ?>" class="btn btn-outline-lightgray btn-more btn-round"><span>مشاهده اخبار
                                بیشتر</span><i class="icon-long-arrow-left"></i></a>
        </div><!-- End .more-container -->
    </div>
</div>
