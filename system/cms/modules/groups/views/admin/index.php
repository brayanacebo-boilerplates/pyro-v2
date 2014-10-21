<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading"><?php echo $module_details['name'] ?></header>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home-2" class="tab-pane active">
                        <a href="admin/groups/add" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('groups:name');?></th>
                                        <th><?php echo lang('groups:short_name');?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php foreach ($groups as $group):?>
                                        <tr>
                                            <td><?php echo $group->description ?></td>
                                            <td><?php echo $group->name ?></td>
                                            <td class="actions">
                                                <a href="<?php echo site_url('admin/groups/edit/' . $group->id) ?>" title="Editar" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
                                                    <a href="<?php echo site_url('admin/groups/delete/' . $group->id) ?>" title="Eliminar" class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
                                                <?php endif ?>
                                                <a href="<?php echo site_url('admin/permissions/group/' . $group->id) ?>" title="Editar permisos" class="btn btn-success btn-sm"><i class="fa fa-gears"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>