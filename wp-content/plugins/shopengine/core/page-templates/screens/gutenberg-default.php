<?php
get_header();
?>

<div class="gutenova-template-default">
    <?php do_action('shopengine/builder/gutenberg/before-content'); ?>

    <?php do_action('shopengine/builder/gutenberg/simple'); ?>

    <?php do_action('shopengine/builder/gutenberg/after-content'); ?>
</div>

<?php 
get_footer();
