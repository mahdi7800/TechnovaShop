<?php
$args = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'order' => 'ASC'
];
$the_query = new WP_Query($args);
if ($the_query->have_posts()) :
    while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <article class="entry">
            <figure class="entry-media">
                <a href="<?php the_permalink(); ?>">
                  <?php echo tns_post_thumbnail(); ?>
                </a>
            </figure><!-- End .entry-media -->

            <div class="entry-body text-center">
                <div class="entry-meta">
                    <a href="#"><?php echo get_the_date('j F Y'); ?></a>
                    <span class="meta-separator">|</span>
                    <?php comments_number(); ?>
                </div><!-- End .entry-meta -->

                <h3 class="entry-title text-center">
                    <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                </h3><!-- End .entry-title -->

                <div class="entry-content">
                    <a href="<?php the_permalink(); ?>" class="read-more">خواندن بیشتر</a>
                </div><!-- End .entry-content -->
            </div><!-- End .entry-body -->
        </article><!-- End .entry -->
    <?php endwhile; ?>
<?php else : ?>
    <article class="entry">
        <figure class="entry-media">
            <a href="single.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/blog/post-1.jpg' ?>"
                     alt="توضیحات عکس">
            </a>
        </figure><!-- End .entry-media -->

        <div class="entry-body text-center">
            <div class="entry-meta">
                <a href="#">14 اسفند 1404</a>, 1 دیدگاه
            </div><!-- End .entry-meta -->

            <h3 class="entry-title text-center">
                <a href="single.html">اولین اخبر از فروشگاه تان را قرار دهید</a>
            </h3><!-- End .entry-title -->

            <div class="entry-content">
                <a href="single.html" class="read-more">خواندن بیشتر</a>
            </div><!-- End .entry-content -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->

    <article class="entry">
        <figure class="entry-media">
            <a href="single.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/blog/post-2.jpg' ?>"
                     alt="توضیحات عکس">
            </a>
        </figure><!-- End .entry-media -->

        <div class="entry-body text-center">
            <div class="entry-meta">
                <a href="#">14 اسفند 1404</a>, 0 دیدگاه
            </div><!-- End .entry-meta -->

            <h3 class="entry-title text-center">
                <a href="single.html">اولین اخبر از فروشگاه تان را قرار دهید</a>
            </h3><!-- End .entry-title -->

            <div class="entry-content">
                <a href="single.html" class="read-more">خواندن بیشتر</a>
            </div><!-- End .entry-content -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->

    <article class="entry">
        <figure class="entry-media">
            <a href="single.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-6/blog/post-3.jpg' ?>"
                     alt="توضیحات عکس">
            </a>
        </figure><!-- End .entry-media -->

        <div class="entry-body text-center">
            <div class="entry-meta">
                <a href="#">14 اسفند 1404</a>, 2 دیدگاه
            </div><!-- End .entry-meta -->

            <h3 class="entry-title text-center">
                <a href="single.html">اولین اخبر از فروشگاه تان را قرار دهید</a>
            </h3><!-- End .entry-title -->

            <div class="entry-content">
                <a href="single.html" class="read-more">خواندن بیشتر</a>
            </div><!-- End .entry-content -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->
<?php endif; ?>