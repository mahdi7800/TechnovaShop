<?php $index = get_option('_tnm_set_index_website'); ?>
<?php if ($index) :
    switch ($index) {
        case 'in10': ?>
            <?php get_template_part('partials/nav/menu/menu-index-10/menu-index-10', 'menu-index-10'); ?>
            <?php get_template_part('partials/layout/start-layout', 'start-layout') ?>
            <?php get_template_part('partials/home/index-10/intro-banner', 'intro-banner'); ?>
            <?php get_template_part('partials/home/index-10/banner-group', 'banner-group'); ?>
            <?php get_template_part('partials/home/index-10/service', 'service'); ?>
            <?php get_template_part('partials/home/index-10/product-1', 'product-1'); ?>
            <?php get_template_part('partials/home/index-10/cap-2', 'cap-2'); ?>
            <?php get_template_part('partials/home/index-10/product-2', 'product-2'); ?>
            <?php get_template_part('partials/home/index-10/cap', 'cap'); ?>
            <?php get_template_part('partials/home/index-10/blog', 'blog'); ?>
            <?php get_template_part('partials/layout/end-layout', 'end-layout'); ?>
            <?php break; ?>
        <?php case 'in6': ?>
        <?php get_template_part('partials/nav/menu/menu-index-6/menu-index-6', 'menu-index-6'); ?>
        <?php get_template_part('partials/layout/start-layout', 'start-layout'); ?>
        <?php get_template_part('partials/home/index-6/intro-banner', 'intro-banner'); ?>
        <?php get_template_part('partials/home/index-6/banner-group', 'banner-group'); ?>
        <?php get_template_part('partials/home/index-6/product-1', 'product-1'); ?>
        <?php get_template_part('partials/home/index-6/timer', 'timer'); ?>
        <?php get_template_part('partials/home/index-6/service', 'service'); ?>
        <?php get_template_part('partials/home/index-6/team', 'team'); ?>
        <?php get_template_part('partials/home/index-6/product-2', 'product-2'); ?>
        <?php get_template_part('partials/home/index-6/product-3', 'product-3'); ?>
        <?php get_template_part('partials/home/index-6/newsletter', 'newsletter'); ?>
        <?php get_template_part('partials/home/index-6/blog', 'blog'); ?>
        <?php get_template_part('partials/layout/end-layout', 'end-layout'); ?>
        <?php break ; ?>
    <?php  case 'in3':
        get_template_part('partials/nav/menu/menu-index-3/menu-index-3', 'menu-index-3');
        get_template_part('partials/layout/start-layout', 'start-layout');
        get_template_part('partials/home/index-3/intro-banner', 'start-layout');
        get_template_part('partials/home/index-3/product-1', 'product-1');
        get_template_part('partials/home/index-3/cap-1', 'cap-1');
        get_template_part('partials/home/index-3/timer', 'timer');
        get_template_part('partials/home/index-3/product-2', 'product-2');
        get_template_part('partials/home/index-3/product-3', 'product-3');
        get_template_part('partials/home/index-3/service', 'service');
        get_template_part('partials/home/index-3/newsletter', 'newsletter');
        get_template_part('partials/layout/end-layout', 'end-layout');
        break;
        case 'in20':
            get_template_part('partials/nav/menu/menu-index-20/menu-index-20', 'menu-index-20');
            get_template_part('partials/layout/start-layout', 'start-layout');
            get_template_part('partials/home/index-20/intro-banner', 'intro-banner');
            get_template_part('partials/home/index-20/service', 'service');
            get_template_part('partials/home/index-20/product-1', 'product-1');
            get_template_part('partials/home/index-20/product-2', 'product-2');
            get_template_part('partials/home/index-20/banner-group', 'banner-group');
            get_template_part('partials/home/index-20/product-3', 'product-3');
            get_template_part('partials/home/index-20/blog', 'blog');
            get_template_part('partials/home/index-20/newsletter', 'newsletter');
            get_template_part('partials/layout/end-layout', 'end-layout');
            break;
        case 'in25':
            get_template_part('partials/nav/menu/menu-index-25/menu-index-25', 'menu-index-25');
            get_template_part('partials/layout/start-layout', 'start-layout');
            get_template_part('partials/home/index-25/intro-slider', 'intro-slider');
            get_template_part('partials/home/index-25/banner-group', 'banner-group');
            get_template_part('partials/home/index-25/product-1', 'product-1');
            get_template_part('partials/home/index-25/product-2', 'product-2');
            get_template_part('partials/home/index-25/cap-1', 'cap-1');
            get_template_part('partials/home/index-25/service', 'service');
            get_template_part('partials/home/index-25/blog', 'blog');
            get_template_part('partials/layout/end-layout', 'end-layout');
            break;
          }
 endif;