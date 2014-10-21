
<div class="row row-for-menu2">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home-2" class="tab-pane active">
                        <a href="admin/users/create" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
					                    <th><?php echo lang('user:name_label');?></th>
					                    <th class="collapse"><?php echo lang('user:email_label');?></th>
					                    <th><?php echo lang('user:group_label');?></th>
					                    <th class="collapse"><?php echo lang('user:active') ?></th>
					                    <th class="collapse"><?php echo lang('user:joined_label');?></th>
					                    <th class="collapse"><?php echo lang('user:last_visit_label');?></th>
					                    <th width="200"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $link_profiles = Settings::get('enable_profiles') ?>
                					<?php foreach ($users as $member): ?>
                                    <tr class="">
                                        <td>
                        <?php if ($link_profiles) : ?>
                            <?php echo anchor('admin/users/preview/' . $member->id, $member->display_name, 'target="_blank" class="modal-large"') ?>
                        <?php else: ?>
                            <?php echo $member->display_name ?>
                        <?php endif ?>
                        </td>
                        <td class="collapse"><?php echo mailto($member->email) ?></td>
                        <td><?php echo $member->group_name ?></td>
                        <td class="collapse"><?php echo $member->active ? lang('global:yes') : lang('global:no')  ?></td>
                        <td class="collapse"><?php echo format_date($member->created_on) ?></td>
                        <td class="collapse"><?php echo ($member->last_login > 0 ? format_date($member->last_login) : lang('user:never_label')) ?></td>
                        <td class="actions">
                            <a href="<?php echo site_url('admin/users/edit/' . $member->id) ?>" title="<?php echo lang('global:edit')?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo site_url('admin/users/delete/' . $member->id) ?>" title="<?php echo lang('global:delete')?>" class="btn btn-danger btn-sm" data-toggle="modal" href="#ModalEliminar"><i class="fa fa-trash-o"></i></a>
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