<div class="seller pt-5 pt-md-6 pb-1 pb-lg-3 my-2 mt-0">
    <div class="container">
        <div class="heading heading-center mb-5">
            <h2 class="title text-uppercase mb-3">پُر فروش ترین محصولات</h2>
        </div>
        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="seller-all" role="tabpanel">
                <div class="owl-carousel  carousel-equal-height owl-simple carousel-with-shadow row cols-lg-4 cols-md-3 cols-2"
                     data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items": 2
                                    },
                                    "768": {
                                        "items": 3
                                    },
                                    "992": {
                                        "items": 4,
                                        "nav": true
                                    }
                                }
                            }'>
                      <?php get_template_part('loop/home/index-25/product-loop-2', 'product-loop-2'); ?>
                </div>
            </div>
        </div>
    </div>
</div>