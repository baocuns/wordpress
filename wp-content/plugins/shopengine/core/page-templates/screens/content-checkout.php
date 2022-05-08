<?php

use ShopEngine\Core\Register\Module_List;

defined('ABSPATH') || exit; ?>

<div class="shopengine-quick-checkout-content-warper">
    <div class="woocommerce shopengine-woocommerce-checkout">

		<?php if($this->get_page_type_option_slug() == 'quick_checkout'): ?>
            <style>
                #wpadminbar {
                    display: none!important;
                }
                html{
                    margin: 0!important;
                }
            </style>
		<?php endif; ?>

		<?php

			$checkout = WC()->checkout();

			global $wp;

			while(have_posts()) : the_post();

				do_action('woocommerce_before_checkout_form', $checkout);

				$skip_content = false;

                /**
                 * check multistep module active or not
                 * if active then check multistep checkout enabled or not in section
                 */
                $is_multistep_checkout_active = Module_List::instance()->is_widget_active('multistep-checkout');

                $multistep_status = false;
                if($is_multistep_checkout_active){
                    $checkout_sections =  json_decode(get_post_meta($this->prod_tpl_id,'_elementor_data', true), true);
					if(is_array($checkout_sections)) {
						foreach ($checkout_sections as $key => $checkout_section){
							$multistep = $checkout_section['settings']['shopengine_multistep_checkout_enable'] ?? '';
							if($multistep == 'enabled'){
								$multistep_status = true;
							}
						}
					}
				}

				$login_reminder =   get_option( 'woocommerce_enable_checkout_login_reminder' );

				if(( !is_user_logged_in() &&  !$multistep_status && $login_reminder === 'yes' )) {

					?>

                    <style>
                        .shopengine-checkout-warning{
                            margin: 0 auto;
                            max-width: 1140px;
                            padding: 20px 0;
                        }

                        .shopengine-checkout-warning .woocommerce-info {
                            margin-bottom: 15px;
                        }
                    </style>
                    <div class="shopengine-checkout-warning">
                    <div class="woocommerce-form-login-toggle">
						<?php wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'shopengine' ) ) . ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'shopengine' ) . '</a>', 'notice' ); ?>
                    </div>
					<?php

					woocommerce_login_form(
						array(
							'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'shopengine' ),
							'redirect' => wc_get_checkout_url(),
							'hidden'   => true,
						)
					);

                    echo '</div>' ;

				}


					if ( isset( $wp->query_vars['order-pay'] ) ) : ?>
                        <div class="shopengine-order-pay-container">
							<?php

							if(\ShopEngine\Core\Builders\Action::is_edit_with_gutenberg($this->prod_tpl_id)) {
								echo do_blocks(get_the_content(null, false, $this->prod_tpl_id));
							} else {
								\ShopEngine\Core\Page_Templates\Hooks\Base_Content::instance()->load_content_designed_from_builder();
							}

                            ?>
                        </div>
					<?php else: ?>
                        <form name="checkout"
                              method="post"
                              class="checkout woocommerce-checkout shopengine-woocommerce-checkout-form"
                              action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                              enctype="multipart/form-data">

							<?php

							if(\ShopEngine\Core\Builders\Action::is_edit_with_gutenberg($this->prod_tpl_id)) {
								echo do_blocks(get_the_content(null, false, $this->prod_tpl_id));
							} else {
								\ShopEngine\Core\Page_Templates\Hooks\Base_Content::instance()->load_content_designed_from_builder();
							}
                            ?>

                        </form>
					<?php
				endif;
			endwhile;
        ?>
    </div>
</div>
