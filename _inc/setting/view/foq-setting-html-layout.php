<?php $message = " "; ?>

<div class="uk-container">
    <?php echo $message; ?>
    <div class="uk-flex-inline uk-flex-stretch uk-margin-top">
        <h4 class="uk-margin-left uk-text-right">
            <span class="uk-text-primary"><?php echo esc_html( get_admin_page_title() ); ?></span>
        </h4>
    </div>
<div class="uk-alert-primary" uk-alert>
    <a href class="uk-alert-close" uk-close></a>
    <p>شما میتوانید از این بخش سوالات متداول که در مورد وب سایت میشود را ایجاد کنید!</p>
</div>




    <div class="uk-width-1-1">
        <?php submit_button('ذخیره تنظیمات', 'primary'); ?>
        <?php wp_nonce_field('_nonce_tns_setting_general', '_nonce_tns_setting_general'); ?>
    </div>
</div>


