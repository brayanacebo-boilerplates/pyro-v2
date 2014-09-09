<section class="title">
	<h4>albunes / <?php echo ucfirst($album->name) ?> / Imagenes</h4>
</section>
<section class="item">
	<div class="content">
		<div class="tabs">
			<ul class="tab-menu">
				<li><a href="#page-album"><span>Nueva Imagen</span></a></li>
			</ul>
			<div class="form_inputs" id="page-album">
				<?php echo form_open_multipart(site_url('admin/albums/store_image')); ?>
				<div class="inline-form">
					<fieldset>
						<ul>
							<li>
								<label for="name">Link Video</label>
								<div class="input"><?php echo form_input('video', set_value('video'), 'class="dev-input-url"'); ?></div>
							</li>
						</ul>
					</fieldset>

					<div class="buttons float-right padding-top">
						<input type="hidden" name="id" value="<?php echo $album->id ?>">
						<button type="submit" name="btnAction" value="save" class="btn blue">Guardar</button>
    				<a href="<?php echo backend_url('albums/images/'.$album->id) ?>" class="btn red cancel">Cancelar</a>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>

		</div>
	</div>
</section>