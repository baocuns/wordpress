<?php $data_attr = apply_filters('shopengine/add_to_cart_widget/optional_tooltip_data_attr', ''); ?>

<div class='shopengine-swatches' <?php echo esc_attr($data_attr)?>>

	<?php

	$editor_mode = (\Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview());

	if(get_post_type() == \ShopEngine\Core\Template_Cpt::TYPE) {

		if($product->get_stock_status() != 'instock') {

			echo esc_html__('To see the add to cart button , please set stock status as instock for - .', 'shopengine') . '"' . $product->get_name() . '"';
		}
	}

	/*
		---------------------------------------------
		Add action for woocommerce quantity button
		--------------------------------------------
	*/

	if(!$product->is_sold_individually()) {

		// plus minus button
		$btn_arg = [
			'plus_icon'  => $shopengine_quantity_plus_icon,
			'minus_icon' => $shopengine_quantity_minus_icon,
			'position'   => $shopengine_quantity_btn_position,
		];

		add_action('woocommerce_before_add_to_cart_quantity', function () use ($btn_arg) {

			echo sprintf('<div class="quantity-wrap %1$s">', $btn_arg['position']);

			if($btn_arg['position'] === 'before') { ?>
				<div class="shopengine-qty-btn">
					<button type="button"
							class="plus"> <?php \Elementor\Icons_Manager::render_icon($btn_arg['plus_icon'], ['aria-hidden' => 'true']); ?> </button>
					<button type="button"
							class="minus"> <?php \Elementor\Icons_Manager::render_icon($btn_arg['minus_icon'], ['aria-hidden' => 'true']); ?> </button>
				</div>
				<?php
			}

			if($btn_arg['position'] === 'both') { ?>
				<button type="button"
						class="minus"> <?php \Elementor\Icons_Manager::render_icon($btn_arg['minus_icon'], ['aria-hidden' => 'true']); ?> </button>
				<?php
			}

		});

		add_action('woocommerce_after_add_to_cart_quantity', function () use ($btn_arg) {

			if($btn_arg['position'] === 'after') { ?>
				<div class="shopengine-qty-btn">
					<button type="button"
							class="plus"> <?php \Elementor\Icons_Manager::render_icon($btn_arg['plus_icon'], ['aria-hidden' => 'true']); ?> </button>
					<button type="button"
							class="minus"> <?php \Elementor\Icons_Manager::render_icon($btn_arg['minus_icon'], ['aria-hidden' => 'true']); ?> </button>
				</div>
				<?php
			}

			if($btn_arg['position'] === 'both') { ?>
				<button type="button"
						class="plus"> <?php \Elementor\Icons_Manager::render_icon($btn_arg['plus_icon'], ['aria-hidden' => 'true']); ?> </button>
				<?php
			}

			echo '</div>';
		});
	}

	if($editor_mode) {

		global $wp_query, $post;;
		$main_query = clone $wp_query;
		$main_post = clone $post;

		$wp_query = new \WP_Query([]);
	}


	do_action('woocommerce_' . $product->get_type() . '_add_to_cart');

	if($editor_mode) {
		$wp_query = $main_query;
		$post = $main_post;
		wp_reset_query();
		wp_reset_postdata();
	}

	?>

</div>
