<?php echo form_open_multipart(site_url('/products/'), 'class="crud"'); ?>

	<label for="title">Buscar producto</label>

	<div class="input"><?php echo form_input('shearch', set_value('shearch'), 'class="dev-input-text" maxlength="100"'); ?></div>

    <input type="submit" class="btn btn-orange" value="Buscar" />

<?php echo form_close(); ?>