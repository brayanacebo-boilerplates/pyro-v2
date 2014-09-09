<section class="title">
    <h4>Galeria</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-gallery"><span>Todos los Registros</span></a></li>
                <li><a href="#page-intro"><span>Introducción</span></a></li>
            </ul>

            <!-- PRENSA -->

            <div class="form_inputs" id="page-gallery">
                <fieldset>

                    <?php echo anchor('admin/gallery/new_gallery', '<span>+ Crear Galeria</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>

                    <?php if (!empty($gallery)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 30%">Titulo</th>
                                    <th style="width: 50%">Contenido</th>
                                    <th style="width: 20%">Acciones</th>
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
                                <?php foreach ($gallery as $post): ?>
                                    <tr>
                                        <td><?php echo (!empty($post->title)) ? $post->title : 'No Aplica' ?></td>
                                        <td>
                                            <?php if ($post->type == 1) { ?>
                                                <?php if (!empty($post->content)): ?>
                                                     <img src="<?php echo site_url($post->content); ?>" style="height: 130px;">
                                                <?php endif; ?>
                                            <?php }else { ?>
                                                <div style="overflow: auto;max-height:202px;max-width:262px;text-align: center">
                                                    <?php echo html_entity_decode($post->content) ?>
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo anchor('admin/gallery/delete_gallery/' . $post->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
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

            <!-- INTRO -->

            <div class="form_inputs" id="page-intro">
                <?php echo form_open_multipart(site_url('admin/gallery/update_intro'), 'id="form-wysiwyg"'); ?>
                <fieldset>
                    <ul>
                        <li>
                            <label for="name">Introducción <span>*</span><small>Evite pegar texto directamente desde un sitio web u otro editor de texto.</small></label>
                            <div class="edit-content">
                                <div class="sroll-table">
                                    <?php echo form_textarea(array('id' => 'text-wysiwyg', 'name' => 'text_wysiwyg', 'value' => (isset($intro->text)) ? $intro->text : set_value('text'), 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                                    <input type="hidden" name="content" id="text">
                                </div>
                            </div>
                        </li>
                    </ul>
                </fieldset>
                <?php echo form_hidden('id', $intro->id); ?>

                <div class="buttons float-right padding-top">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                </div>

                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</section>