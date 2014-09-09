<section class="title">
    <h4>albunes / <?php echo ucfirst($album->name) ?> / Imagenes</h4>
    <a href="<?php echo backend_url('albums') ?>" class="btn small">Volver a los albunes</a>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-albums"><span>Imagenes</span></a></li>
            </ul>

            <!-- IMAGENES -->
            <div class="form_inputs" id="page-albums">
                <fieldset>

                    <?php echo anchor('admin/albums/create_image/'.$album->id, '<span>+ Nueva Imagen</span>', 'class="btn blue"'); ?>
                    <?php echo anchor('admin/albums/create_video/'.$album->id, '<span>+ Nuevo Video</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>

                    <?php if (!empty($images)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 70%">Imagen</th>
                                    <th style="width: 30%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($images as $image): ?>
                                    <tr>
                                        <td>
                                        	<?php if(!empty($image->path)): ?>
                                        		<img src="<?php echo val_image($image->path) ?>" alt="imagen" height="100">
                                        	<?php else: ?>
                                        		<?php echo $image->video; ?>
                                        	<?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo anchor('admin/albums/destroy_image/' . $image->id.'/'.$album->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
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

    </div>
</div>
</section>