<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-billing-fields">
    <h2 class="checkout-title">جزئیات صورت حساب</h2>

    <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <div class="row">
        <?php
        $billing_fields = $checkout->get_checkout_fields( 'billing' );

        foreach ( $billing_fields as $key => $field ) :
            // کنترل کلاس ستون‌ها (responsive)
            $col_class = 'col-sm-6 mb-3';
            if ( in_array( $key, ['billing_address_1', 'billing_address_2'] ) ) {
                $col_class = 'col-sm-12 mb-3';
            }
            ?>
            <div class="<?php echo esc_attr( $col_class ); ?>">
                <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
    <div class="woocommerce-account-fields">
        <?php if ( ! $checkout->is_registration_required() ) : ?>
            <div class="row">
                <div class="col-sm-6">
                    <p class="form-row form-row-wide create-account">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                                   id="createaccount"
                                   <?php checked( ( true === $checkout->get_value( 'createaccount' ) || apply_filters( 'woocommerce_create_account_default_checked', false ) ), true ); ?>
                                   type="checkbox" name="createaccount" value="1" />
                            <span><?php esc_html_e( 'ایجاد حساب کاربری؟', 'woocommerce' ); ?></span>
                        </label>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

        <?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>
            <div class="create-account">
                <?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
                    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                <?php endforeach; ?>
                <div class="clear"></div>
            </div>
        <?php endif; ?>

        <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
    </div>
<?php endif; ?>
