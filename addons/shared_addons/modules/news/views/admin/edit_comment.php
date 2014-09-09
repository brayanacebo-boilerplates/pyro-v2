<section class="title">
    <h4>Noticias Comentario</h4>
    <br>
    <small class="text-help">Los campos señalados con <span>*</span> son obligatorios.</small>
</section>

<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-news"><span><?php echo $titulo; ?></span></a></li>
            </ul>

            <div class="form_inputs" id="page-news">
                <?php echo form_open_multipart(site_url('admin/news/edit_comment/'.$datosForm->id ), 'id="form-wysiwyg"'); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
						<li>
                            <label for="title">Correo <span>*</span></label>
                            <div class="input"><?php echo form_input('email', (isset($datosForm->email)) ? $datosForm->email : set_value('email'), 'class="dev-input-title"'); ?></div>
                        </li>
                        <li>
                            <label for="title">name <span>*</span></label>
                            <div class="input"><?php echo form_input('name', (isset($datosForm->name)) ? $datosForm->name : set_value('name'), 'class="dev-input-title"'); ?></div>
                        </li>
						

                        <li>
                            <label for="introduction">Comentario
                                <span>*</span>
                                <small class="counter-text"></small>
                            </label>
                            <div class="input"><?php echo form_textarea('comment', (isset($datosForm->comment)) ? $datosForm->comment : set_value('comment'),'class="dev-input-textarea limit-text" length="600"'); ?></div>
                        </li>

                        </ul>
                        <?php
							$this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel')));
                        ?>
                    </fieldset>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</section>

