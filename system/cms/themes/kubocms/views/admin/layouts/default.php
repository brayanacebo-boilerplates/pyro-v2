<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="@javarsa1 ft @BrayanAcebo">
<link rel="shortcut icon" href="img/favicon.png">
<title><?php echo $template['title'].' - '.lang('cp:admin_title') ?></title>
<base href="<?php echo base_url(); ?>" />

<?php file_partial('styles'); ?>
<!-- metadata needs to load before some stuff -->
<?php file_partial('metadata'); ?>
</head>

<body>
<section id="container">
	<?php file_partial('header'); ?>
	<section id="main-content">
		<section class="wrapper">
			<?php file_partial('scripts'); ?>
			<!-- Notificaciones y alertas -->
			<?php file_partial('notices'); ?>
			<?php echo $template['body']; ?>
		</section>
	</section>
	<?php file_partial('right_sidebar'); ?>
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
</body>
</html>