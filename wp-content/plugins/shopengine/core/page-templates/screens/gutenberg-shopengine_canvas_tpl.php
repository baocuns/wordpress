<?php 
    wp_head();
?>
<div class="gutenova-template-canvas">
	<?php do_action('shopengine/builder/gutenberg/before-content'); ?>

	<?php do_action('shopengine/builder/gutenberg/simple'); ?>

    <?php do_action('shopengine/builder/gutenberg/after-content'); ?>
</div>

<?php 
    wp_footer();
?>


