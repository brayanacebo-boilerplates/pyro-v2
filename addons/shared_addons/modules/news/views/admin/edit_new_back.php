<section class="title">
    <h4>Noticias</h4>
    <br>
    <small class="text-help">Los campos señalados con <span>*</span> son obligatorios.</small>
</section>

<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-news"><span><?php echo $titulo; ?></span></a></li>
                <?php if(isset($datosForm)): ?><li><a href="#page-comments"><span>Comentarios</span></a></li><?php endif; ?>
            </ul>

            <div class="form_inputs" id="page-news">
                <?php echo form_open_multipart(site_url('admin/news/edit_new/'.(isset($datosForm) ? $datosForm->id : '')), 'id="form-wysiwyg"'); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                            <li>
                                <label for="name">Imagen
                                    <small>
                                        - Imagen Permitidas gif | jpg | png | jpeg<br>
                                        - Tamaño Máximo 2 MB<br>
                                        - Ancho Máximo 540px<br>
                                        - Alto Máximo 315px
                                    </small>
                                </label>
                                <div class="input">
                                 <?php if (!empty($datosForm->image)): ?>
                                    <div>
                                        <img src="<?php echo site_url($datosForm->image) ?>" width="298">
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
                            <label for="title">Titulo <span>*</span></label>
                            <div class="input"><?php echo form_input('title', (isset($datosForm->title)) ? $datosForm->title : set_value('title'), 'class="dev-input-title"'); ?></div>
                        </li>
						<li>
                            <label for="title">Autor </label>
                            <div class="input"><?php echo form_input('autor', (isset($datosForm->autor)) ? $datosForm->autor : set_value('autor'), 'class="dev-input-title"'); ?></div>
                        </li>

                        <li class="even">
                            <label for="name">
                                Contenido
                                <span>*</span>
                                <small>Evite pegar texto directamente desde un sitio web u otro editor de texto, de ser necesario use la herramienta pegar desde.</small>
                            </label>
                            <div class="input">
                                <div class="sroll-table">
                                    <?php echo form_textarea(array('id' => 'text-wysiwyg', 'name' => 'text_wysiwyg', 'value' => (isset($datosForm->content)) ? $datosForm->content : set_value('content'), 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                                    <input type="hidden" name="content" id="text">
                                </div>
                            </div>
                            <br class="clear">
                        </li>

                        <li>
                            <label for="introduction">Introducción
                                <span>*</span>
                                <small class="counter-text"></small>
                            </label>
                            <div class="input"><?php echo form_textarea('introduction', (isset($datosForm->introduction)) ? $datosForm->introduction : set_value('introduction'),'class="dev-input-textarea limit-text" length="600" maxlength="600"'); ?></div>
                        </li>

                        <?php if($ban): ?>
                            <li>
                                <label for="name">Orden / Posición</label>
                                <div class="input">
                                    <select name="position_new">
                                        <?php $i = 1; ?>
                                        <?php foreach ($positionnews as $position): ?>
                                            <option value="<?php echo $position->id ?>" <?php echo ($datosForm->position == $position->position) ? 'selected="selected"' : null ?>><?php echo $i; ?></option>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </li>

                            <li>
                                <label for="name">Fecha de Publicación</label>
                                <div class="input">
                                    <p><?php echo fecha_spanish_full($datosForm->date) ?></p>
                                </div>
                            </li>
                            <?php
                            echo form_hidden('position_current', $datosForm->position);
                            endif;
                            ?>

                        </ul>
                        <?php
                        $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel')));
                        ?>
                    </fieldset>
                </div>
                <?php echo form_close(); ?>
            </div>
            
            <?php if(isset($datosForm)): ?>
	            <!-- comentarios -->
				<div class="form_inputs" id="page-comments">
	                <fieldset>
	                    <br>
	                    <br>
	                    <?php if (!empty($comments)): ?>
	
	                        <table border="0" class="table-list" cellspacing="0">
	                            <thead>
	                                <tr>
	                                    <th style="width: 20%">Correo</th>
	                                    <th style="width: 20%">Nombre</th>
	                                    <th style="width: 40%">Comentario</th>
	                                    <th class="width: 20%">Acciones</th>
	                                </tr>
	                            </thead>
	                            <tfoot>
	                                <tr>
	                                    <td colspan="6">
	                                        <div class="inner filtered"><?php $this->load->view('admin/partials/pagination') ?></div>
	                                    </td>
	                                </tr>
	                            </tfoot>
	                            <tbody>
	                                <?php foreach ($comments as $item): ?>
	                                    <tr>
	                                        <td><?php echo $item->email ?></td>
	                                        <td><?php echo $item->name ?></td>
	                                        <td><?php echo substr($item->comment, 0,150) ?></td>
	                                        <td>
												<?php echo anchor('admin/news/edit_comment/' . $item->id, lang('global:edit'), 'class="btn green small"'); ?>
	                                            <?php echo anchor('admin/news/delete_comment/' . $item->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
	                                        </td>
	                                    </tr>
	                                <?php endforeach ?>
	                            </tbody>
	                        </table>
	
	                    <?php else: ?>
	                        <p style="text-align: center">No hay un comentario actualmente</p>
	                    <?php endif ?>
	                </fieldset>
	            </div>
			<?php endif; ?>
        </div>
    </div>
</section>

