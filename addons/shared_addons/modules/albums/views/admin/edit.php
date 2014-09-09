<section class="title">
    <h4>albunes</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-album"><span>Editar albumo</span></a></li>
            </ul>
            <div class="form_inputs" id="page-album">
                <?php echo form_open_multipart(site_url('admin/albums/update'), 'id="form-wysiwyg"'); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                           <li>
                            <label for="name">Imagen
                                <small>
                                    - Imagen Permitidas gif | jpg | png | jpeg<br>
                                    - Tamaño Máximo 2 MB<br>
                                    - Ancho Máximo 252px<br>
                                    - Alto Máximo 170px
                                </small>
                            </label>
                            <div class="input">
                                <?php if (!empty($album->image)): ?>
                                    <div>
                                        <img src="<?php echo val_image($album->image) ?>" width="298">
                                    </div>
                                <?php endif; ?>
                                <div class="btn-false">
                                    <div class="btn">Examinar</div>
                                    <?php echo form_upload('image', '', ' id="image"'); ?>
                                </div>
                            </div>
                            <br class="clear">
                        </li>
                        <li>
                            <label for="title">Nombre <span>*</span></label>
                            <div class="input"><?php echo form_input('name', $album->name, 'class="dev-input-title"'); ?></div>
                        </li>
                        <li>
                            <label for="path">Categorias</label>
                            <select name="categories[]" multiple>
                                <option value="0">Seleccione una Opción</option>
                                <?php foreach ($categories as $item): ?>
                                    <option value="<?php echo $item->id; ?>" <?php echo (in_array($item->id, $selected_category)) ? 'selected' : null ?>>
                                        <?php echo $item->title; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </li>
                        <li>
                            <label for="introduction">Descripción
                                <span>*</span>
                                <small class="counter-text"></small>
                            </label>
                            <div class="input"><?php echo form_textarea('introduction', $album->introduction,'class="dev-input-textarea limit-text" length="100"'); ?></div>
                        </li>
                    </ul>
                </fieldset>

                <div class="buttons float-right padding-top">
                    <?php echo form_hidden('id',$album->id); ?>
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
</section>