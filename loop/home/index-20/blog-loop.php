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

            <div class="entry-body text-right" dir="rtl">
                <div class="entry-meta">
                    <a href="#"><?php echo get_the_date('j F Y'); ?></a>
                    <span class="meta-separator">|</span>
                    <?php comments_number(); ?>
                </div><!-- End .entry-meta -->

                <h3 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                </h3><!-- End .entry-title -->

                <div class="entry-content">
                    <p><?php echo  PostExcerpt::tns_post_excerpt_slider();?></p>
                    <a href="<?php the_permalink(); ?>" class="read-more">ادامه خواندن ...</a>
                </div><!-- End .entry-content -->
            </div><!-- End .entry-body -->
        </article><!-- End .entry -->
    <?php endwhile; ?>
<?php else : ?>
    <article class="entry">
        <figure class="entry-media">
            <a href="single.html">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/blog/post-1.jpg'?>" alt="توضیحات عکس">
            </a>
        </figure><!-- End .entry-media -->

        <div class="entry-body text-right" dir="rtl">
            <div class="entry-meta">
                <a href="#">22 اسفند 1401</a>, 0 دیدگاه
            </div><!-- End .entry-meta -->

            <h3 class="entry-title">
                <a href="single.html">لورم ایپسوم متن ساختگی با تولید سادگی</a>
            </h3><!-- End .entry-title -->

            <div class="entry-content">
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                    سادگی نامفهوم </p>
                <a href="single.html" class="read-more">ادامه خواندن ...</a>
            </div><!-- End .entry-content -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->
    <article class="entry">
        <figure class="entry-media">
            <a href="single.html">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/blog/post-2.jpg'?>" alt="توضیحات عکس">
            </a>
        </figure><!-- End .entry-media -->

        <div class="entry-body text-right" dir="rtl">
            <div class="entry-meta">
                <a href="#">12 اسفند 1401</a>, 0 دیدگاه
            </div><!-- End .entry-meta -->

            <h3 class="entry-title">
                <a href="single.html">لورم ایپسوم متن ساختگی با تولید سادگی</a>
            </h3><!-- End .entry-title -->

            <div class="entry-content">
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوملورم ایپسوم متن ساختگی با تولید
                    سادگی نامفهوم </p>
                <a href="single.html" class="read-more">ادامه خواندن ...</a>
            </div><!-- End .entry-content -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->
    <article class="entry">
        <figure class="entry-media">
            <a href="single.html">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/blog/post-3.jpg'?>" alt="توضیحات عکس">
            </a>
        </figure><!-- End .entry-media -->

        <div class="entry-body text-right" dir="rtl">
            <div class="entry-meta">
                <a href="#">10 اسفند 1401</a>, 2 دیدگاه
            </div><!-- End .entry-meta -->

            <h3 class="entry-title">
                <a href="single.html">لورم ایپسوم متن ساختگی با تولید سادگی</a>
            </h3><!-- End .entry-title -->

            <div class="entry-content">
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                    سادگی نامفهوم </p>
                <a href="single.html" class="read-more">ادامه خواندن ...</a>
            </div><!-- End .entry-content -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->
    <article class="entry">
        <figure class="entry-media">
            <a href="single.html">
                <img src="<?php echo TNM_URL .  '/assets/images/demos/demo-20/blog/post-4.jpg'?>" alt="توضیحات عکس">
            </a>
        </figure><!-- End .entry-media -->

        <div class="entry-body text-right" dir="rtl">
            <div class="entry-meta">
                <a href="#">10 اسفند 1401</a>, 2 دیدگاه
            </div><!-- End .entry-meta -->

            <h3 class="entry-title">
                <a href="single.html">لورم ایپسوم متن ساختگی با تولید سادگی</a>
            </h3><!-- End .entry-title -->

            <div class="entry-content">
                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                    سادگی نامفهوم </p>
                <a href="single.html" class="read-more">ادامه خواندن ...</a>
            </div><!-- End .entry-content -->
        </div><!-- End .entry-body -->
    </article><!-- End .entry -->
<?php endif;?>