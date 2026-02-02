<?php if (is_home() && is_front_page()) : ?>
    <?php
     $index = get_option('_tnm_set_index_website');
     if ($index) {
             switch ($index) {
                 case 'in10':
                     get_template_part('partials/nav/footer/footer-index-10/footer-index-10', 'footer-index-10');
                     break;
                 case 'in6':
                     get_template_part('partials/nav/footer/footer-index-6/footer-index-6', 'footer-index-6');
                 break;
                 case 'in3':
                     get_template_part('partials/nav/footer/footer-index-3/footer-index-3', 'footer-index-3');
                 break;
                 case 'in20':
                     get_template_part('partials/nav/footer/footer-index-20/footer-index-20', 'footer-index-20');
                 break;
                 case 'in25':
                     get_template_part('partials/nav/footer/footer-index-25/footer-index-25', 'footer-index-25');
                 break;
             }
     } ?>

<?php else : ?>
    <footer class="footer">
        <div class="footer-middle border-0">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget widget-about">
                            <a href="<?php echo home_url(); ?>" class="logo">
	                        <?php if(! empty( get_site_icon_url() )) : ?>
                            <img src="<?php echo  get_site_icon_url(); ?>" class="footer-logo" alt="Footer Logo" width="105"
                                 height="25">
                                <?php else: ?>
                                <img src="<?php echo TNM_URL . '/assets/images/logo.png'?>" class="footer-logo" alt="Footer Logo" width="105"
                                     height="25">
                                <?php endif; ?>
                            </a>
	                        <?php if (!empty(get_bloginfo('description'))): ?>
                                <p><?php echo get_bloginfo('description'); ?></p>
	                        <?php else : ?>
                                <div class="alert alert-info">لطفا توضیحات کوتاه وب سایت را کامل کنید!!!</div>
	                        <?php endif; ?>

                            <div class="social-icons">
                                <?php
                                $setting_website_general = get_option('_tnm_settings_set_general', []);

                                if ( ! empty( $setting_website_general['link_enamad']) || !empty($setting_website_general['link_zarinpal'])) :


                                if ( ! empty( $setting_website_general['link_enamad'] ) ) :
                                    $enamad = esc_url( $setting_website_general['link_enamad'] );
                                    ?>
                                    <a href="<?php echo $enamad; ?>" target="_blank" rel="noopener" class="brand">
                                        <img src="<?php echo esc_url( TNM_URL . '/assets/images/enamad-full-star.png' ); ?>"
                                             alt="نماد اعتماد الکترونیکی"
                                             style="height:100px;margin-left:30px;">
                                    </a>
                                <?php endif; ?>

                                <?php

                                if ( ! empty( $setting_website_general['link_zarinpal'] ) ) :
                                $zarinpal = esc_url( $setting_website_general['link_zarinpal'] );
                                ?>
                                    <script src="<?php echo $zarinpal; ?>" type="text/javascript"></script>
                                <?php endif; ?>

                                <?php else : ?>
                                    <!-- آیکون‌های پیش‌فرض شبکه‌های اجتماعی -->
                                    <?php
                                    $whatsapp =   get_option('_tnm_social_media_website')['whatsapp'] ?? '' ;
                                    $instagram =  get_option('_tnm_social_media_website')['instagram']?? '';
                                    $telegram =   get_option('_tnm_social_media_website')['telegram']?? '';
                                    ?>
                                    <a href="<?php echo esc_url($telegram); ?>>" class="social-icon" title="تلگرام" target="_blank"><i class="icon-telegram"></i></a>
                                    <a href="<?php echo esc_url($whatsapp) ?>>" class="social-icon" title="واتساپ" target="_blank"><i class="icon-whatsapp"></i></a>
                                    <a href="<?php echo esc_url($instagram) ?>" class="social-icon" title="اینستاگرام" target="_blank"><i class="icon-instagram"></i></a>

                                <?php endif; ?>
                            </div><!-- End .social-icons -->
                        </div><!-- End .widget about-widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">لینک های مفید</h4><!-- End .widget-title -->

                            <ul class="widget-list">
		                        <?php
		                        $args = [
			                        'theme_location' => 'footer-menu-useful-link',
			                        'container'      => false,
			                        'fallback_cb'    => function () {
				                        echo '<li><a href="#">Menu not set</a></li>';
			                        },
			                        'items_wrap'     => '<li><a href="#">%3$s</a></li>',
			                        'depth'          => 1,
			                        'walker'         => new bootstrap_5_wp_nav_menu_walker()
		                        ];
		                        wp_nav_menu($args);
		                        ?>
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">خدمات مشتریان</h4><!-- End .widget-title -->

                            <ul class="widget-list">
		                        <?php
		                        $args = [
			                        'theme_location' => 'footer-menu-customer-service',
			                        'container'      => false,
			                        'fallback_cb'    => function () {
				                        echo '<li><a href="#">Menu not set</a></li>';
			                        },
			                        'items_wrap'     => '<li><a href="#">%3$s</a></li>',
			                        'depth'          => 1,
			                        'walker'         => new bootstrap_5_wp_nav_menu_walker()
		                        ];

		                        wp_nav_menu($args);
		                        ?>
                            </ul>
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">خرید از ما</h4><!-- End .widget-title -->

                            <ul class="widget-list">
		                        <?php
		                        $args = [
			                        'theme_location' => 'footer-menu-category',
			                        'container'      => false,
			                        'fallback_cb'    => function () {
				                        echo '<li><a href="#">Menu not set</a></li>';
			                        },
			                        'items_wrap'     => '<li><a href="#">%3$s</a></li>',
			                        'depth'          => 1,
			                        'walker'         => new bootstrap_5_wp_nav_menu_walker()
		                        ];

		                        wp_nav_menu($args);
		                        ?>
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .footer-middle -->

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">  کپی رایت © 2025 تمامی حقوق مطلق به وب سایت   <?php  bloginfo('name'); ?> محفوظ است.  </p>
                <div class="social-icons social-icons-color">
                    <p class="footer-copyright"><a href="https://mahdidavoodi.ir">طراح وب سایت گروه مهندسی شانول</a></p>
                </div><!-- End .soial-icons -->
                <!-- End .footer-copyright -->
            </div><!-- End .container -->
        </div><!-- End .footer-bottom -->
    </footer><!-- End .footer -->
<?php endif; ?>

</div><!-- End .page-wrapper -->
<button id="scroll-top" title="بازگشت به بالا"><i class="icon-arrow-up"></i></button>
<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="mobile-search">
            <label for="s-mobile" class="sr-only">جستجو</label>
            <input type="search"
                   class="form-control"
                   name="s"
                   id="s-mobile"
                   placeholder="جستجو در ..."
                   value="<?php echo esc_attr(get_search_query()); ?>"
                   required
            >
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            <input type="hidden" name="post_type" value="product" />
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                   role="tab" aria-controls="mobile-menu-tab" aria-selected="true">منو</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                 aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
		            <?php
		            $args = [
			            'taxonomy'   => 'product_cat',
			            'hide_empty' => false,
			            'exclude'    => [15],
			            'parent'     => 0,
			            'orderby'    => 'id',
			            'order'      => 'ASC'
		            ];
		            $product_main_cats = get_categories($args);

		            if ($product_main_cats): ?>
                        <ul class="mobile-menu">
				            <?php foreach ($product_main_cats as $product_main_cat):
					            $main_category_link = get_term_link($product_main_cat); ?>
                                <li>
                                    <a href="<?php echo esc_url($main_category_link); ?>" class="sf-with-ul">
							            <?php echo esc_html($product_main_cat->name); ?>
                                    </a>

						            <?php
						            $child_args = [
							            'taxonomy'   => 'product_cat',
							            'hide_empty' => false,
							            'parent'     => $product_main_cat->term_id,
							            'orderby'    => 'id',
							            'order'      => 'ASC'
						            ];
						            $product_child_cats = get_categories($child_args);
						            if ($product_child_cats): ?>
                                        <ul>
								            <?php foreach ($product_child_cats as $product_child_cat):
									            $child_category_link = get_term_link($product_child_cat); ?>
                                                <li>
                                                    <a href="<?php echo esc_url($child_category_link); ?>">
											            <?php echo esc_html($product_child_cat->name); ?>
                                                    </a>
                                                </li>
								            <?php endforeach; ?>
                                        </ul>
						            <?php endif; ?>
                                </li>
				            <?php endforeach; ?>
                        </ul>
		            <?php endif; ?>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                       role="tab" aria-controls="signin" aria-selected="true"><?php esc_html_e('Login', 'woocommerce'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                       aria-controls="register" aria-selected="false"><?php esc_html_e('Register', 'woocommerce'); ?></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <!-- تب ورود -->
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                     aria-labelledby="signin-tab">
                                    <form class="woocommerce-form woocommerce-form-login login" method="post">
									    <?php do_action('woocommerce_login_form_start'); ?>

                                        <div class="form-group">
                                            <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?> *</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                   value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"
                                                   autocomplete="username" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?> *</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                   autocomplete="current-password" required />
                                        </div>

									    <?php do_action('woocommerce_login_form'); ?>
									    <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                                        <input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>" />

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2 woocommerce-button woocommerce-form-login__submit"
                                                    name="login" value="<?php esc_attr_e('Login', 'woocommerce'); ?>">
                                                <span><?php esc_html_e('Login', 'woocommerce'); ?></span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="rememberme" id="rememberme" value="forever" />
                                                <label class="custom-control-label" for="rememberme">
												    <?php esc_html_e('Remember me', 'woocommerce'); ?>
                                                </label>
                                            </div>

                                            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="forgot-link">
											    <?php esc_html_e('Lost your password?', 'woocommerce'); ?>
                                            </a>
                                        </div>

									    <?php do_action('woocommerce_login_form_end'); ?>
                                    </form>

								    <?php if (has_action('woocommerce_login_form_social')) : ?>
                                        <div class="form-choice">
                                            <p class="text-center"><?php esc_html_e('Or login with', 'woocommerce'); ?></p>
                                            <div class="row">
											    <?php do_action('woocommerce_login_form_social'); ?>
                                            </div>
                                        </div>
								    <?php endif; ?>
                                </div><!-- .End .tab-pane -->

                                <!-- تب ثبت‌نام -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>
									    <?php do_action('woocommerce_register_form_start'); ?>

									    <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                                            <div class="form-group">
                                                <label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?> *</label>
                                                <input type="text" class="form-control" name="username" id="reg_username"
                                                       value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"
                                                       autocomplete="username" required />
                                            </div>
									    <?php endif; ?>

                                        <div class="form-group">
                                            <label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?> *</label>
                                            <input type="email" class="form-control" name="email" id="reg_email"
                                                   value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"
                                                   autocomplete="email" required />
                                        </div>

									    <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                                            <div class="form-group">
                                                <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?> *</label>
                                                <input type="password" class="form-control" name="password" id="reg_password"
                                                       autocomplete="new-password" required />
                                            </div>
									    <?php endif; ?>

									    <?php do_action('woocommerce_register_form'); ?>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2 woocommerce-button button"
                                                    name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
                                                <span><?php esc_html_e('Register', 'woocommerce'); ?></span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

										    <?php if (wc_terms_and_conditions_checkbox_enabled()) : ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="register-policy" name="terms" required />
                                                    <label class="custom-control-label" for="register-policy">
													    <?php printf(__('I agree to the <a href="%s" target="_blank">terms and conditions</a>', 'woocommerce'), esc_url(wc_get_page_permalink('terms'))); ?> *
                                                    </label>
                                                </div>
										    <?php endif; ?>
                                        </div>

									    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
									    <?php do_action('woocommerce_register_form_end'); ?>
                                    </form>

								    <?php if (has_action('woocommerce_register_form_social')) : ?>
                                        <div class="form-choice">
                                            <p class="text-center"><?php esc_html_e('Or register with', 'woocommerce'); ?></p>
                                            <div class="row">
											    <?php do_action('woocommerce_register_form_social'); ?>
                                            </div>
                                        </div>
								    <?php endif; ?>
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

<?php wp_footer(); ?>

</body>
</html>

<!-- Theme Developed By Mahdi Davoodi | https://mahdidavoodi.ir | date : 12/13/2025  -->