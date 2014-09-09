<section class="title">
    <h4>Editar Sobre Nosotros</h4>
    <br>
        <small class="text-help">Los campos señalados con <span>*</span> son obligatorios.</small>

</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-view"><span>Contenido</span></a></li>
            </ul>

            <div class="form_inputs" id="page-view">
                <?php echo form_open_multipart(site_url('admin/about_us/'), 'id="form-wysiwyg"'); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                            <li class="even">
                                <label for="name">
                                    Titulo
                                    <span>*</span>
                                    <small>Texto de Introducción</small>
                                </label>
                                <div class="input">
                                    <?php echo form_input('title', set_value('title', isset($data->title) ? $data->title : ""),'style="width:50%"'); ?>
                                </div>
                                <br class="clear">
                            </li>

                            <li>
                                <label for="name">
                                    Imagen
                                    <small>
                                        - Imagen Permitidas gif | jpg | png | jpeg<br>
                                        - Tamaño Máximo 2 MB<br>
                                        - Ancho 478px<br>
                                        - Alto 315px
                                    </small>
                                </label>
                                <div class="input">
                                   <?php if (!empty($data->image)): ?>
                                    <div>
                                        <img src="<?php echo site_url($data->image) ?>" width="298">
                                    </div>
                                <?php endif; ?>
                                <div class="btn-false">
                                    <div class="btn">Examinar</div>
                                    <?php echo form_upload('image', '', ' id="image"'); ?>
                                </div>
                            </div>
                            <br class="clear">
                        </li>

                        <li class="even">

                            <label for="name">Video
                                <span></span>
                                <small>
                                    - Insertar fragmento de código desde su sitio de videos, suele ser un iframe.<br>
                                    - Ancho 478px<br>
                                    - Alto 315px
                                </small>
                            </label>
                            <div class="input">
                                <?php if (!empty($data->video)): ?>
                                    <div>
                                        <?php echo htmlspecialchars_decode($data->video); ?>
                                    </div>
                                <?php endif; ?>
                                <?php echo form_textarea('video', set_value('video', isset($data->video) ? $data->video : ""), ' id="video" style="width: 580px;height: 100px;"'); ?>
                            </div>
                            <br class="clear">
                        </li>

                        <li>
                            <label for="name">
                                Texto
                                <span>*</span>
                                <small>Evite pegar texto directamente desde un sitio web u otro editor de texto, de ser necesario use la herramienta pegar desde.</small>
                            </label>
                            <div class="input">
                                <div class="sroll-table">
                                    <?php echo form_textarea(array('id' => 'text-wysiwyg', 'name' => 'text_wysiwyg', 'value' => $data->text, 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                                    <input type="hidden" name="text" id="text">
                                </div>
                            </div>
                            <br class="clear">
                        </li>

                        <li>
                            <div class="buttons float-right padding-top">
                                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                            </div>
                        </li>

                    </ul>
                </fieldset>
            </div>

            <?php echo form_hidden('id', $data->id); ?>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
</section>