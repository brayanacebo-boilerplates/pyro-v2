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
	<?php echo Asset::render() ?>
	<!-- metadata needs to load before some stuff -->
	<?php file_partial('metadata'); ?>
</head>

<body>
<section id="container">
	<?php file_partial('header'); ?>
</section>
<section id="main-content">
	<section class="wrapper">
		<?php file_partial('notices'); ?>
		<?php echo $template['body']; ?>
	</section>
</section>
	<!-- <div id="container">

		<section id="content">
			
			<header class="hide-on-ckeditor-maximize">
			<?php //file_partial('header'); ?>
			</header>

			<div id="content-body">
				<?php //file_partial('notices'); ?>
				<?php //echo $template['body']; ?>
			</div>

		</section>

	</div> -->
<!--Core js-->
<?php Asset::js('lib/jquery-1.8.3.min.js'); ?>
<?php Asset::js('bs3/js/bootstrap.min.js'); ?>
<?php Asset::js('accordion-menu/jquery.dcjqaccordion.2.7.js'); ?>
<?php Asset::js('scrollTo/jquery.scrollTo.min.js'); ?>
<?php Asset::js('assets/jQuery-slimScroll-1.3.0/jquery.slimscroll.js'); ?>
<?php Asset::js('nicescroll/jquery.nicescroll.js'); ?>
<?php Asset::js('custom-select/jquery.customSelect.min.js'); ?>
<!--Easy Pie Chart-->
<?php Asset::js('assets/easypiechart/jquery.easypiechart.js'); ?>
<!--Sparkline Chart-->
<?php Asset::js('assets/sparkline/jquery.sparkline.js'); ?>
<!--jQuery Flot Chart-->
<?php Asset::js('assets/flot-chart/jquery.flot.js'); ?>
<?php Asset::js('assets/flot-chart/jquery.flot.tooltip.min.js'); ?>
<?php Asset::js('assets/flot-chart/jquery.flot.resize.js'); ?>
<?php Asset::js('assets/flot-chart/jquery.flot.pie.resize.js'); ?>
<!--common script init for all pages-->
<?php Asset::js('scripts.kubocms.js'); ?>
<?php echo Asset::render() ?>
</body>
</html>