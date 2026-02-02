<?php $index = get_option('_tnm_set_index_website'); ?>
<?php if ($index) {
    switch ($index) {
        case 'in10': ?>
            <?php get_template_part('partials/nav/menu/menu-index-10/menu-index-10', 'menu-index-10'); ?>
            <?php break; ?>
        <?php case 'in6': ?>
        <?php get_template_part('partials/nav/menu/menu-index-6/menu-index-6', 'menu-index-6'); ?>
        <?php break ; ?>
    <?php  case 'in3':
        get_template_part('partials/nav/menu/menu-index-3/menu-index-3', 'menu-index-3');
        break;
        case 'in20':
            get_template_part('partials/nav/menu/menu-index-20/menu-index-20', 'menu-index-20');
            break;
        case 'in25':
            get_template_part('partials/nav/menu/menu-index-25/menu-index-25', 'menu-index-25');
            break;
    }
}?>