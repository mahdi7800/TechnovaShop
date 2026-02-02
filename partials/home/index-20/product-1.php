<div class="bestseller-products bg-light pt-5 pb-5 mb-5">
    <div class="block">
        <div class="block-wrapper ">
            <div class="container">
                <div class="heading heading-flex">
                    <div class="heading-left">
                        <h2 class="title">پرفروش ترین ها</h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                    <div class="heading-right">
                        <a href="<?php echo wc_get_page_permalink( 'shop' ); ?>?orderby=popularity" class="title-link">مشاهده محصولات بیشتر <i
                                class="icon-long-arrow-left"></i></a>
                    </div><!-- End .heading-right -->
                </div><!-- End .header-flex -->
                <div class="owl-carousel carousel-equal-height owl-simple" data-toggle="owl"
                     data-owl-options='{
                                    "nav": false,
                                    "dots": true,
                                    "margin": 20,
                                    "loop": false,
                                    "rtl": true,
                            "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1440": {
                                            "items":5
                                        }
                                    }
                                }'>
                <?php get_template_part('loop/home/index-20/product-loop-1','product-loop-1'); ?>
                </div><!-- End .owl-carousel -->
            </div><!-- End .container -->
        </div><!-- End .block-wrapper -->
    </div><!-- End .block -->
</div><!-- End .bg-light pt-4 pb-4 -->