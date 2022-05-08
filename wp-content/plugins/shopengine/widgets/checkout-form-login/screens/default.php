<?php

defined('ABSPATH') || exit;

if($post_type == \ShopEngine\Core\Template_Cpt::TYPE && (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview())) {

	if('no' === get_option('woocommerce_enable_checkout_login_reminder')): ?>
        <div class="shopengine shopengine-editor-alert shopengine-editor-alert-warning">
			<?php echo esc_html__('This option is turned off from settings', 'shopengine'); ?>
        </div>
		<?php

		return;

	endif;

	if(!function_exists('wc_print_notice')) {
		require_once WC_ABSPATH . 'includes/wc-notice-functions.php';
	}

	?>
    <div class="shopengine-checkout-form-login">
        <div class="woocommerce-form-login-toggle">
			<?php wc_print_notice(
			        apply_filters(
			                'woocommerce_checkout_login_message',
                            esc_html__('Returning customer?', 'shopengine')
                    ) . ' <a href="#" class="showlogin">' . esc_html__('Click here to login', 'shopengine') . '</a>', 'notice'
            );  ?>
        </div>
		<?php
		$hidden = false;
		$redirect = wc_get_checkout_url();
		$message = esc_html__('If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'shopengine');
		?>
        <form class="woocommerce-form woocommerce-form-login login"
              method="post" <?php echo ($hidden) ? 'style="display:none;"' : ''; ?>>

			<?php do_action('woocommerce_login_form_start'); ?>

			<?php echo ($message) ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine ?>

            <p class="form-row form-row-first">
                <label for="username"><?php esc_html_e('Username or email', 'shopengine'); ?>&nbsp;<span
                            class="required">*</span></label>
                <input type="text" class="input-text" name="username" id="username" autocomplete="username" required/>
            </p>
            <p class="form-row form-row-last">
                <label for="password"><?php esc_html_e('Password', 'shopengine'); ?>&nbsp;<span
                            class="required">*</span></label>
                <input class="input-text" type="password" name="password" id="password"
                       autocomplete="current-password" required/>
            </p>
            <div class="clear"></div>

			<?php do_action('woocommerce_login_form'); ?>

            <p class="form-row">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                           type="checkbox" id="rememberme" value="forever"/>
                    <span><?php esc_html_e('Remember me', 'shopengine'); ?></span>
                </label>
				<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>"/>
                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login"
                        value="<?php esc_attr_e('Login', 'shopengine'); ?>"><?php esc_html_e('Login', 'shopengine'); ?></button>
            </p>
            <p class="lost_password">
                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'shopengine'); ?></a>
            </p>

            <div class="clear"></div>

			<?php do_action('woocommerce_login_form_end'); ?>

        </form>

    </div>
	<?php
} else {
	?>
    <div class="shopengine-checkout-form-login">
		<?php woocommerce_checkout_login_form(); ?>
    </div>
	<?php
}
