
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">Nueva Imagen para "<?php echo $album->name ?>"</header>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home-2" class="tab-pane active">
                        <a href="admin/albums/create_image/<?php echo $album->id ?>" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva imagen</a>
                        <a href="admin/albums" type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver a albumes</a>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th width="180"><?php echo lang('global:actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($images as $image) : ?>
                                    <tr class="">
                                        <td align="center">
                                            <img src="<?php echo val_image($image->path) ?>" alt="imagen" height="100">
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('admin/albums/destroy_image/' . $image->id.'/'.$album->id) ?>" title="Eliminar" class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>