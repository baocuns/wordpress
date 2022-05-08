<script>
var shopengine_has_product_status = <?php echo json_encode([
    'has_product' => \ShopEngine\Core\Builders\Templates::has_simple_product(),
    'message' => \ShopEngine\Widgets\Products::instance()->no_product_to_preview()
]);?>
</script>
<?php 
    $dashboard_class = 'shopengine-admin-dashboard';
    if( is_rtl() ) {
        $dashboard_class .= ' rtl-enabled';
    } else {
        $dashboard_class .= ' rtl-disabled';
    }
?>

<div class="<?php echo esc_attr( $dashboard_class ) ?>">
    <div class="shopengine-admin-dashboard-wrapper" >
        <!-- Content Goes Here -->
    </div>
</div>
