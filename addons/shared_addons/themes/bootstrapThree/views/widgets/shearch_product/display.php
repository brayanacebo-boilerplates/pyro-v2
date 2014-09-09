<?php echo form_open_multipart(site_url('/products/'), 'class="navbar-form navbar-left" role="form"'); ?>

	<div class="form-group">
	    <label class="sr-only hide" for="exampleInputEmail2">Buscar producto</label>
		<?php echo form_input('shearch', set_value('shearch'), 'class="form-control search" maxlength="100" placeholder="Buscar Producto"'); ?>
	</div>

	<button type="submit" class="btn btn-default hide" value="Buscar">Buscar</button>

<?php echo form_close(); ?>

