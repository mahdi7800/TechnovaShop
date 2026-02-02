<?php

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'order'          => 'ASC'
];
$the_query = new WP_Query($args);
if ($the_query->have_posts()) :
    while ($the_query->have_posts()) : $the_query->the_post();  ?>
<article class="entry">
    <figure class="entry-media mb-0">
        <a href="<?php echo get_the_permalink(); ?>">
            <?php echo tns_post_thumbnail(); ?>
        </a>
    </figure>

    <div class="entry-body text-right">
        <div class="entry-meta">
            <a href="#"><?php echo get_the_date('j F Y'); ?></a>&nbsp;/&nbsp;<?php comments_number(); ?>
        </div>

        <h3 class="entry-title text-dark">
            <a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="entry-content">
            <p class="font-weight-light text-light"><?php echo  PostExcerpt::tns_post_excerpt(); ?></p>
            <a href="<?php echo get_the_permalink(); ?>" class="read-more m-0 p-0">مطالعه بیشتر</a>
        </div>
    </div>
</article>
<?php endwhile; ?>
<?php else : ?>
    <article class="entry">
        <figure class="entry-media mb-0">
            <a href="single.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-28/blog/1.jpg'?>" alt="image desc" width="334"
                     height="200">
            </a>
        </figure>

        <div class="entry-body text-right">
            <div class="entry-meta">
                <a href="#">12 آذر 1401</a>&nbsp;/&nbsp;<a href="#">0 دیدگاه</a>
            </div>

            <h3 class="entry-title text-dark">
                <a href="single.html">لورم ایپسوم متن ساختگی</a>
            </h3>

            <div class="entry-content">
                <p class="font-weight-light text-light">لورم ایپسوم متن ساختگی با تولید سادگی
                    نامفهوم، لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن
                    ساختگی </p>
                <a href="single.html" class="read-more m-0 p-0">مطالعه بیشتر</a>
            </div>
        </div>
    </article>

    <article class="entry">
        <figure class="entry-media mb-0">
            <a href="single.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-28/blog/2.jpg'?>" alt="image desc" width="334"
                     height="200">
            </a>
        </figure>

        <div class="entry-body text-right">
            <div class="entry-meta">
                <a href="#">12 آذر 1401</a>&nbsp;/&nbsp;<a href="#">2 دیدگاه</a>
            </div>

            <h3 class="entry-title text-dark">
                <a href="single.html">تولید سادگی نافهوم</a>
            </h3>

            <div class="entry-content">
                <p class="font-weight-light text-light">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم،لورم ایپسوم متن ساختگی با
                    تولید سادگی، لورم ایپسوم متن ساختگی با
                    تولید سادگی نامفهوم
                </p>
                <a href="single.html" class="read-more m-0 p-0">مطالعه بیشتر</a>
            </div>
        </div>
    </article>

    <article class="entry">
        <figure class="entry-media mb-0">
            <a href="single.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-28/blog/3.jpg'?>" alt="image desc" width="334"
                     height="200">
            </a>
        </figure>

        <div class="entry-body text-right">
            <div class="entry-meta">
                <a href="#">12 آذر 1401</a>&nbsp;/&nbsp;<a href="#">4 دیدگاه</a>
            </div>

            <h3 class="entry-title text-dark">
                <a href="single.html">متن ساختگی پیش فرض</a>
            </h3>

            <div class="entry-content">
                <p class="font-weight-light text-light">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن ساختگی با
                    تولید سادگی نامفهوم، لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                </p>
                <a href="single.html" class="read-more m-0 p-0">مطالعه بیشتر</a>
            </div>
        </div>
    </article>

    <article class="entry">
        <figure class="entry-media mb-0">
            <a href="single.html">
                <img src="<?php echo TNM_URL . '/assets/images/demos/demo-28/blog/4.jpg'?>" alt="image desc" width="334"
                     height="200">
            </a>
        </figure>

        <div class="entry-body text-right">
            <div class="entry-meta">
                <a href="#">12 آذر 1401</a>&nbsp;/&nbsp;<a href="#">0 دیدگاه</a>
            </div>

            <h3 class="entry-title text-dark">
                <a href="single.html">تولید سادگی در صنعت چاپ</a>
            </h3>

            <div class="entry-content">
                <p class="font-weight-light text-light">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن ساختگی با
                    تولید سادگی نامفهوم، لورم ایپسوم
                </p>
                <a href="single.html" class="read-more m-0 p-0">مطالعه بیشتر</a>
            </div>
        </div>
    </article>
<?php endif; ?>