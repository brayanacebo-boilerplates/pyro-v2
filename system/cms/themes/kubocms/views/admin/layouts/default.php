<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="javier varón saavedra ft @BrayanAcebo">
	<link rel="shortcut icon" href="img/favicon.png">
	<title><?php echo $template['title'].' - '.lang('cp:admin_title') ?></title>
	<base href="<?php echo base_url(); ?>" />

	<!--Core CSS -->
	<?php Asset::css('bs3/css/bootstrap.min.css'); ?>
	<?php Asset::css('assets/jquery-ui/jquery-ui-1.10.1.custom.min.css'); ?>
	<?php Asset::css('bootstrap-reset.css'); ?>
	<?php Asset::css('assets/font-awesome/css/font-awesome.css'); ?>
	<?php Asset::css('assets/jvector-map/jquery-jvectormap-1.2.2.css'); ?>
	<?php Asset::css('clndr.css'); ?>
	<!--clock css-->
	<?php Asset::css('assets/css3clock/css/style.css'); ?>

	<!--Morris Chart CSS -->
	<?php Asset::css('assets/morris-chart/morris.css'); ?>
	<!-- Custom styles for this template -->
	<?php Asset::css('style.css'); ?>
	<?php Asset::css('style-responsive.css'); ?>
		<?php
	    $vars = $this->load->_ci_cached_vars;
	    if ($vars['lang']['direction']=='rtl'){
	        Asset::css('workless/rtl/rtl.css');
	    }
	    ?>
	<!-- metadata needs to load before some stuff -->


	<!-- ADDONS -->
	<?php Asset::css('assets/bootstrap-fileupload/bootstrap-fileupload.css'); ?>
	<?php Asset::css('assets/gritter/css/jquery.gritter.css'); ?>

	<?php echo Asset::render() ?>
	<?php file_partial('metadata'); ?>
</head>

<body>
<section id="container">
	<?php file_partial('header'); ?>
</section>

<section id="main-content">
	<section class="wrapper">
		<?php echo $template['body']; ?>
	</section>
</section>

<!-- PLUGINS -->
<?= kubo_js('lib/jquery-1.8.3.min.js') ?>
<?= kubo_js('assets/gritter/jquery.gritter.js') ?>
<!-- ALERTAR Y NOTIFICACIONES -->
<?php file_partial('notices'); ?>
<?= kubo_js('assets/ckeditor/ckeditor.js') ?>
<?= kubo_js('bs3/js/bootstrap.min.js') ?>
<?= kubo_js('accordion-menu/jquery.dcjqaccordion.2.7.js') ?>
<?= kubo_js('scrollTo/jquery.scrollTo.min.js') ?>
<?= kubo_js('assets/jQuery-slimScroll-1.3.0/jquery.slimscroll.js') ?>
<?= kubo_js('nicescroll/jquery.nicescroll.js') ?>
<?= kubo_js('custom-select/jquery.customSelect.min.js') ?>
<?= kubo_js('assets/easypiechart/jquery.easypiechart.js') ?>
<?= kubo_js('assets/sparkline/jquery.sparkline.js') ?>
<?= kubo_js('assets/flot-chart/jquery.flot.js') ?>
<?= kubo_js('assets/flot-chart/jquery.flot.tooltip.min.js') ?>
<?= kubo_js('assets/flot-chart/jquery.flot.resize.js') ?>
<?= kubo_js('assets/flot-chart/jquery.flot.pie.resize.js') ?>
<?= kubo_js('scripts.kubocms.js') ?>
<?= kubo_js('assets/bootstrap-fileupload/bootstrap-fileupload.js') ?>
<?= kubo_js('gritter/gritter.js') ?>


</body>
</html>