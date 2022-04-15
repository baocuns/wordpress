<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<!--container-->
<div id="container">
<header id="header">
<?php mytheme_logo(); ?>
<?php mytheme_menu('primary-menu' ); ?>
<?php echo "Hello WordPress"; ?>
</header>
<!-- hhhh -->