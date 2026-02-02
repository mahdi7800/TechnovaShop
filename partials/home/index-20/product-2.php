<div class="container">
    <div class="heading heading-flex">
        <div class="heading-left">
            <h2 class="title">تازه منتشر شده</h2><!-- End .title -->
        </div><!-- End .heading-left -->

        <div class="heading-right">
            <a href="<?php echo wc_get_page_permalink('shop'); ?>?orderby=date" class="title-link">مشاهده محصولات بیشتر <i
                    class="icon-long-arrow-left"></i></a>
        </div><!-- End .heading-right -->
    </div><!-- End .header-flex -->

    <div class="row">
        <div class="col-xl-4">
            <div class="owl-carousel carousel-equal-height owl-simple" data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "rtl": true,
                                "dots": true,
                                "margin": 10
                            }'>
                <?php get_template_part('loop/home/index-20/product-loop-2-I','product-loop-2-I'); ?>
            </div><!-- End .owl-carousel -->
        </div><!-- End .col-lg-4 -->
        <div class="col-xl-8">
            <div class="block-wrapper ">
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
                                        "1200": {
                                            "items":3
                                        },
                                        "1440": {
                                            "items":4
                                        }
                                    }
                                }'>
                            <?php get_template_part('loop/home/index-20/product-loop-2-II','product-loop-2-II'); ?>
                </div><!-- End .owl-carousel -->
            </div><!-- End .block-wrapper -->
        </div><!-- End .col-lg-8 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-5"></div><!-- End .mb-3 -->