<div class="shopengine-filter-orderby">
    <form action="#" method="get"
          class="shopengine-filter shopengine-filter-orderby-<?php echo esc_html__($settings['shopengine_orderby_type'], 'shopengine') ?>">
		<?php if('dropdown' === $settings['shopengine_orderby_type']) : ?>
            <!-- DROPDOWN STYLE -->
            <i class="shopengine-filter-orderby-icon eicon-angle-right"></i>
            <select name="orderby" class="orderby" aria-label="<?php echo esc_attr__('Shop order', 'shopengine'); ?>">
				<?php foreach($catalog_orderby_options as $id => $name) : ?>
                    <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
				<?php endforeach; ?>
            </select>
		<?php else : ?>
            <!-- LIST SELECT STYLE -->
			<?php foreach($catalog_orderby_options as $id => $name) : ?>
                <div class="orderby-input-group">
                    <input name="orderby" class="orderby" type="radio"
                           id="orderby-<?php echo esc_attr($id); ?>"
                           aria-label="<?php echo esc_attr__('Shop order', 'shopengine'); ?>"
						<?php checked($orderby, $id); ?>
                           value="<?php echo esc_attr($id); ?>"/>
                    <label for="orderby-<?php echo esc_attr($id); ?>"><?php echo esc_html($name); ?></label>
                </div>
			<?php endforeach; ?>
		<?php endif; ?>
    </form>
</div>
