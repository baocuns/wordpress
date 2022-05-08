<?php if (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview()):
	$page_type = \ShopEngine\Widgets\Products::instance()->get_template_type_by_id(get_the_ID());
    if (!empty($page_type) && $page_type === 'single'): ?>
			<div class="woocommerce-message" role="alert">
				<a href="#" tabindex="1" class="button wc-forward"><?php esc_html_e('View cart', 'shopengine')?></a><?php esc_html_e('“Beanie” has been added to your cart.', 'shopengine')?>
			</div>
		<?php else: ?>
			<div class="shopengine-checkout-notice">
				<ul class="woocommerce-error" role="alert">
					<li data-id="billing_first_name">
						<strong><?php esc_html_e('Billing First name', 'shopengine')?></strong> <?php esc_html_e('is a required field.', 'shopengine')?>
					</li>
					<li data-id="billing_email">
						<strong><?php esc_html_e('Billing Email address', 'shopengine')?></strong> <?php esc_html_e('is a required field.', 'shopengine')?>
					</li>
				</ul>
			</div>
	<?php endif;?>
<?php else: ?>
	<div class="shopengine-checkout-notice">
		<?php is_single() ? wc_print_notices() : ''?>
	</div>
<?php endif;?>