<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 *
 * /woocommerce/templates/checkout/form-coupon.php
 */

defined('ABSPATH') || exit;

if (!wc_coupons_enabled()) {
	// @codingStandardsIgnoreLine.
	return;
}

?>

<div class="shopengine-checkout-coupon-form">

    <div class="woocommerce-form-coupon-toggle">
        <div class="woocommerce-info-toggle">
			<?php echo esc_html(apply_filters('woocommerce_checkout_coupon_message', esc_html__('Have a coupon?', 'shopengine'))); ?>
            <a href="#" class="showcoupon"><?php echo esc_html__('Click here to enter your code', 'shopengine') ?></a>
        </div>
    </div>

    <div class="shopengine-checkout-coupon" style="display:none">

        <p><?php esc_html_e('If you have a coupon code, please apply it below.', 'shopengine');?></p>

        <p class="form-row form-row-first">
            <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Coupon code', 'shopengine');?>" id="coupon_code" value="" />
        </p>

        <p class="form-row form-row-last">
            <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'shopengine');?>"><?php esc_html_e('Apply coupon', 'shopengine');?></button>
        </p>

        <div class="clear"></div>
    </div>

</div>
