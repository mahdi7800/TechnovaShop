<div class="blog-posts bg-light pt-4 pb-4">
    <div class="container">
        <h2 class="title">اخبار فروشگاه ما</h2><!-- End .title-lg text-center -->

        <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
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
                                },
                                "1200": {
                                    "items":4
                                }
                            }
                        }'>
            <?php get_template_part('loop/home/index-20/blog-loop','blog-loop'); ?>
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->
</div><!-- End .blog-posts -->