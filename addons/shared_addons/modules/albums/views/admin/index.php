
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home-2" class="tab-pane active">
                        <a href="admin/albums/create" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th width="180"><?php echo lang('global:actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($albums as $album) : ?>
                                    <tr class="">
                                        <td><?php echo $album->name ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/albums/images/' . $album->id) ?>" title="Imagenes" class="btn btn-success btn-sm"><i class="fa fa-picture-o"></i></a>
                                            <a href="<?php echo site_url('admin/albums/edit/' . $album->id) ?>" title="Editar" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo site_url('admin/albums/destroy/' . $album->id) ?>" title="Eliminar" class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
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