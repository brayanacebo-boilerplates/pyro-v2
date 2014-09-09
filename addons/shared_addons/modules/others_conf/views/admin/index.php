<section class="item">
    <div class="content">
    	<h2>Otras Configuraciones</h2>
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-config-page"><span>Otras Configuraciones</span></a></li>
            </ul>
            
			<!-- Otras Configuraciones -->            
            <div class="inline-form" id="page-config-page">
                <fieldset>
                    <?php if (isset($config_pag)): ?>
                    	<?php echo form_open_multipart(site_url('admin/others_conf/edit/'), 'class="crud"'); ?>
                        <fieldset>
		                    <ul>
		                        <li>
		                            <label for="name">Logo
		                                <small>
		                                    - Imagen Permitidas gif | jpg | png | jpeg<br>
		                                    - Tamaño Máximo 2 MB<br>
		                                    - Ancho Máximo 200px<br>
		                                    - Alto Máximo 300px
		                                </small>
		                            </label>
		                            <?php if (isset($config_pag->logo) && !empty($config_pag->logo)): ?>
		                                <div>
		                                    <img src="<?php echo site_url($config_pag->logo) ?>" width="298">
		                                </div>
		                            <?php endif; ?>
		                            <div class="btn-false">
		                                <div class="btn">Examinar</div>
		                                <?php echo form_upload('logo', set_value('logo'), ' id="image"'); ?>
		                                <?php echo form_hidden('city', '') ?>
		                            </div>
		                        </li>
		                    </ul>
		                    <?php
		                    	$this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel')));
		                    ?>
		                </fieldset>
		                <?php echo form_close(); ?>
                    <?php else: ?>
                        <p style="text-align: center">No hay datos actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>
        </div>
    </div>
</section>