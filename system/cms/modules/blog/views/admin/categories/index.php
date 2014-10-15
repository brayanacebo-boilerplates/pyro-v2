
<div class="row row-for-menu2">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home-2" class="tab-pane active">
                        <a href="admin/blog/categories/create" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                       <th><?php echo lang('cat:category_label') ?></th>
                                       <th><?php echo lang('global:slug') ?></th>
                                       <th width="120">Acciones</th>
                                   </tr>
                               </thead>
                               <tbody>
                                <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?php echo $category->title ?></td>
                                    <td><?php echo $category->slug ?></td>
                                    <td class="align-center buttons buttons-small">
                                        <a href="<?php echo site_url('admin/blog/categories/edit/'.$category->id) ?>" title="<?php echo lang('global:edit')?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo site_url('admin/blog/categories/delete/'.$category->id) ?>" title="<?php echo lang('global:delete')?>" class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
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