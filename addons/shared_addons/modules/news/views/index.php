<div class="container">
	<div class="row mtop40">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<h2 class="color-text-blue"><strong>Noticias</strong></h2>
		</div>
	</div>
	<br>
	<div class="container-fluid">

		<?php foreach ($news as $item): ?>
			<div class="row">
				<div class="col-sm-4 col-md-4">
					<div class="thumbnail">
						<div style="overflow: hidden;max-height:250px;">
							<img src="<?php echo $item->image; ?>" data-src="holder.js/300x200" width="100%" alt="" class="img-responsive">
						</div>
					</div>
				</div>
				<div class="col-sm-8 col-md-8">
					<div class="caption">
						<h3><a href="<?php echo $item->urlDetail; ?>"><?php echo $item->title; ?></a></h3>
						<p><?php echo $item->introduction; ?></p>
						<small class="small-float"><i>Publicado: <?php echo $item->date; ?></i></small><br>
						<a class="btn btn-primary btn-sm" href="<?php echo $item->urlDetail; ?>">Ver Mas</a>
					</div>
				</div>
			</div>
			<hr>
		<?php endforeach; ?>

	<?php echo $pagination ?>
</div>
</div>
<div class="push"></div>
