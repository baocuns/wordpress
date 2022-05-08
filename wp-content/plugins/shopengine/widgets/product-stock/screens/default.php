<?php defined('ABSPATH') || exit;

$post_type = get_post_type();
$product = \ShopEngine\Widgets\Products::instance()->get_product($post_type);

$icon = '';
$stock_status = $product->get_stock_status();
$availability = $product->get_availability();

if($stock_status == 'instock') :

	$icon = isset($settings['shopengine_pstock_in_stock_icon']) ? $settings['shopengine_pstock_in_stock_icon'] : '';

elseif($stock_status == 'outofstock') :

	$icon = isset($settings['shopengine_pstock_out_of_stock_icon']) ? $settings['shopengine_pstock_out_of_stock_icon'] : '';

elseif($stock_status == 'onbackorder') :

	$icon = isset($settings['shopengine_pstock_available_on_backorder_icon']) ? $settings['shopengine_pstock_available_on_backorder_icon'] : '';

endif;
?>

<div class="shopengine-product-stock">

	<?php if($post_type == \ShopEngine\Core\Template_Cpt::TYPE) :

		$icons = [
			'in_stock_icon' => isset($settings['shopengine_pstock_in_stock_icon']) ? $this->_get_icon($settings['shopengine_pstock_in_stock_icon']) : '',
			'out_of_stock_icon' => isset($settings['shopengine_pstock_out_of_stock_icon']) ? $this->_get_icon($settings['shopengine_pstock_out_of_stock_icon']) : '',
			'available_on_backorder_icon' => isset($settings['shopengine_pstock_available_on_backorder_icon']) ? $this->_get_icon($settings['shopengine_pstock_available_on_backorder_icon']) : '',
		];

		$stock_type = $settings['shopengine_pstock_stock_type'];
		$stock_type = in_array($stock_type, array_keys($this->stock_types())) ? $stock_type : 'in_stock'; // Validate Stock Type.

		$stock_class = str_replace('_', '-', $stock_type);
		$stock_text = isset($settings[$stock_type . '_text']) ? $settings[$stock_type . '_text'] : Self::stock_types()[$stock_type];
		$stock_icon = isset($icons[$stock_type . '_icon']) ? $icons[$stock_type . '_icon'] : '';
		
		echo '<p class="' . $stock_class . '">' . $stock_icon . ' ' . $stock_text . '</p>';

	else : ?>

		<p class="<?php echo esc_attr($availability['class']); ?>">

			<?php
			if(!empty($icon)) :
				\Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
			endif;

			if ( $product->is_on_backorder() ) {
				$stock_html = $availability['availability'] ? $availability['availability'] : esc_html__('On backorder', 'shopengine');
			} elseif ( $product->is_in_stock() ) {
				$stock_html = $availability['availability'] ? $availability['availability'] : esc_html__('In Stock', 'shopengine');
			} else {
				$stock_html = $availability['availability'] ? $availability['availability'] : esc_html__('Out of stock', 'shopengine');
			}
			
			echo apply_filters( 'woocommerce_stock_html', $stock_html, wp_kses_post($availability['availability']), $product );
			?>

		</p>

	<?php endif; ?>

</div>
