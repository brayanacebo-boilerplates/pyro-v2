
<div class="row row-for-menu2">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home-2" class="tab-pane active">
                        <a href="admin/blog/create" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('blog:post_label') ?></th>
                                        <th><?php echo lang('blog:category_label') ?></th>
                                        <th><?php echo lang('blog:date_label') ?></th>
                                        <th><?php echo lang('blog:written_by_label') ?></th>
                                        <th><?php echo lang('blog:status_label') ?></th>
                                        <th width="180"><?php echo lang('global:actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($blog as $post) : ?>
                                    <tr class="">
                                        <td><?php echo $post->title ?></td>
                                        <td><?php echo $post->category_title ?></td>
                                        <td><?php echo format_date($post->created_on) ?></td>
                                        <td>
                                            <?php if (isset($post->display_name)): ?>
                                            <?php echo anchor('user/'.$post->username, $post->display_name, 'target="_blank"') ?>
                                        <?php else: ?>
                                        <?php echo lang('blog:author_unknown') ?>
                                    <?php endif ?>
                                </td>
                                <td><?php echo lang('blog:'.$post->status.'_label') ?></td>
                                <td style="padding-top:10px;">
                                    <?php if($post->status=='live') : ?>
                                    <a href="<?php echo site_url('blog/'.date('Y/m', $post->created_on).'/'.$post->slug) ?>" target="_blank" title="<?php echo lang('global:view')?>" class="btn btn-success btn-sm"><i class="fa fa-picture-o"></i></a>
                                <?php else: ?>
                                <a href="<?php echo site_url('blog/preview/' . $post->preview_hash) ?>" target="_blank" title="<?php echo lang('global:view')?>" class="btn btn-success btn-sm"><i class="fa fa-picture-o"></i></a>
                            <?php endif ?>

                            <a href="<?php echo site_url('admin/blog/edit/' . $post->id) ?>" title="<?php echo lang('global:edit')?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo site_url('admin/blog/delete/' . $post->id) ?>" title="<?php echo lang('global:delete')?>" class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
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