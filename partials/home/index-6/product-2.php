<div class="container">
    <h2 class="title text-center mb-4">محصولات پرفروش</h2><!-- End .title text-center -->

    <div class="products">
        <div class="row justify-content-center">
          <?php get_template_part('loop/home/index-6/product-2-loop','product-2-loop'); ?>
        </div><!-- End .row -->
    </div><!-- End .products -->

    <div class="more-container text-center mt-2">
        <a href="<?php echo get_post_type_archive_link('product'); ?>" class="btn btn-outline-dark-2 btn-more"><span>نمایش بیشتر</span></a>
    </div><!-- End .more-container -->
</div><!-- End .container -->
