<section class="item">
    <div class="content">
    	<h2>Home/Slider Clientes</h2>
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-principal"><span><?php echo $titulo; ?></span></a></li>
            </ul>

            <div class="inline-form" id="page-principal">
                <?php echo form_open_multipart(site_url('admin/home/edit_customers/'.(isset($dataForm) ? $dataForm->id : '')), 'class="crud"'); ?>
                <fieldset>
                    <ul>
                        <li>
                            <label for="name">Imagen
                                <small>
                                    - Imagen Permitidas gif | jpg | png | jpeg<br>
                                    - Tamaño Máximo 2 MB<br>
                                    - Ancho Máximo 300px<br>
                                    - Alto Máximo 300px
                                    - Todas las imagenes deben ser del mismo tamaño
                                </small>
                            </label>
                            <?php if (!empty($dataForm->image)): ?>
                                <div>
                                    <img src="<?php echo site_url($dataForm->image) ?>" width="298">
                                </div>
                            <?php endif; ?>
                            <div class="btn-false">
                                <div class="btn">Examinar</div>
                                <?php echo form_upload('image', set_value('image'), ' id="image"'); ?>
                            </div>
                            <?php if (!isset($dataForm)): ?>
	                            <br/>
	                            <br/>
	                            <br/>
	                            <br/>
                            <?php endif; ?>
                        </li>
                        <li>
                            <label for="name">Nombre <span>*</span></label>
                            <div class="input"><?php echo form_input('name', (isset($dataForm->name)) ? $dataForm->name : set_value('name'), 'class="dev-input-title" style="width:100%"'); ?></div>
                        </li>
						<li>
                            <label for="link">Link <span>*</span></label>
                            <div class="input"><?php echo form_input('link', (isset($dataForm->link)) ? $dataForm->link : set_value('link'), 'class="dev-input-title" style="width:100%"'); ?></div>
                        </li>
                    </ul>
                    <?php 
                    	$this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel')));
                    ?>
                </fieldset>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</section>