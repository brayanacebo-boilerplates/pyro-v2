<div id="baseurl" class="hide"><?php echo site_url(); ?></div>
<section class="title">
    <h4>servicios</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-services"><span>Listado de servicios</span></a></li>
                <li class="hide"><a href="#page-categories"><span>Categorias</span></a></li>
                <li><a href="#page-structure-categories"><span>Estructura Categorias</span></a></li>
                <li><a href="#page-intro"><span>Introducción</span></a></li>
            </ul>

            <!-- servicios -->
            <div class="form_inputs" id="page-services">
                <fieldset>

                    <?php echo anchor('admin/services/create', '<span>+ Nuevo Servicio</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>

                    <?php if (!empty($services)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Nombre</th>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 25%">Descripción</th>
                                    <th style="width: 10%">Destacado</th>
                                    <th style="width: 30%">Acciones</th>
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
                                <?php foreach ($services as $service): ?>
                                    <tr>
                                        <td><?php echo $service->name ?></td>
                                        <td>
                                            <?php if (!empty($service->image)): ?>
                                                <img src="<?php echo site_url($service->image); ?>" style="height: 130px;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo substr(strip_tags($service->description), 0,100) ?></td>
                                        <td><a class="outstanding_service" href="admin/services/outstanding_service/<?php echo $service->id; ?>"><img src="<?php echo site_url().'uploads/default/'.($service->outstanding == 1 ? 'estrella' : 'estrella_gris').'.png'; ?>" border="0"></a> </td>
                                        <td>
                                            <?php echo anchor('admin/services/edit/' . $service->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/services/images/' . $service->id, "Imagenes", 'class="btn orange small"'); ?>
                                            <?php echo anchor('admin/services/destroy/' . $service->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay Registros actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

            <!-- CATEGORIAS -->
            <div class="form_inputs" id="page-categories">
                <fieldset>

                    <?php echo anchor('admin/services/create_category', '<span>+ Nueva Categoria</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>

                    <?php if (!empty($categories)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Titulo</th>
                                    <th style="width: 15%">Slug</th>
                                    <th style="width: 15%">Padre</th>
                                    <th style="width: 30%">Creacion</th>
                                    <th style="width: 20%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach ($categories as $key => $post): ?>
                                <tr>
                                    <td><?php echo $post->title; ?></td>
                                    <td><?php echo $post->slug; ?></td>
                                    <td><?php echo $categories[$key]->parent_name; ?></td>
                                    <td><?php echo fecha_spanish_full($post->created_at); ?></td>
                                    <td>
                                        <?php echo anchor('admin/services/edit_category/' . $post->id, lang('global:edit'), array('class' => 'btn green small')); ?>
                                        <?php echo anchor('admin/services/destroy_category/' . $post->id, lang('global:delete'), array('class' => 'confirm btn red small')); ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <p style="text-align: center">No hay Registros actualmente</p>
                <?php endif ?>
            </fieldset>
        </div>
        
        <!-- ESTRUCTURA CATEGORIAS -->
        <div class="form_inputs" id="page-structure-categories">
            <fieldset>
            	<?php echo anchor('admin/services/create_category', '<span>+ Nueva Categoria</span>', 'class="btn blue"'); ?>
                <br>
                <br>
                <div id="ajax_message"></div>
            	<section class="item">
            		<div class="content">
                        <div id="category-sort">
                        	<?php echo $structure_categories; ?>
                		</div>
                    </div>
        		</section>
        		
            </fieldset>
        </div>

        <!-- INTRO -->
        <div class="form_inputs" id="page-intro">
            <?php echo form_open_multipart(site_url('admin/services/update_intro'), 'id="form-wysiwyg"'); ?>
            <fieldset>
                <ul>
                    <li>
                        <label for="name">Introducción <span>*</span><small>Evite pegar texto directamente desde un sitio web u otro editor de texto.</small></label>
                        <div class="input">
                            <div class="sroll-table">
                                <?php echo form_textarea(array('id' => 'text-wysiwyg', 'name' => 'text_wysiwyg', 'value' => $intro->text, 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                                <input type="hidden" name="content" id="text">
                            </div>
                        </div>
                        <br class="clear">
                    </li>
                </ul>
            </fieldset>

            <div class="buttons float-right padding-top">
                <?php echo form_hidden('id',$intro->id); ?>
                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
            </div>

            <?php echo form_close(); ?>
        </div>

    </div>
</div>
</section>