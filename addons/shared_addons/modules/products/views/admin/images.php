<section class="title">
    <h4>Productos / <?php echo ucfirst($product->name) ?> / Imagenes</h4>
    <a href="<?php echo backend_url('products') ?>" class="btn small">Volver a los Productos</a>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-products"><span>Imagenes</span></a></li>
            </ul>

            <!-- IMAGENES -->
            <div class="form_inputs" id="page-products">
                <fieldset>

                    <?php echo anchor('admin/products/create_image/'.$product->id, '<span>+ Nueva Imagen</span>', 'class="btn blue"'); ?>
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
                                        <td><img src="<?php echo val_image($image->path) ?>" alt="imagen" height="100"></td>
                                        <td>
                                            <?php echo anchor('admin/products/destroy_image/' . $image->id.'/'.$product->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
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