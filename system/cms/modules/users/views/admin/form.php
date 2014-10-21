<script>
$(function() {
  $('#first_name').addClass("form-control");
  $('#last_name').addClass("form-control");
  $('#company').addClass("form-control");
  $('#bio').addClass("form-control");
  $('#gender').addClass("form-control");
  $('#phone').addClass("form-control");
  $('#mobile').addClass("form-control");
  $('#address_line1').addClass("form-control");
  $('#address_line2').addClass("form-control");
  $('#address_line3').addClass("form-control");
  $('#postcode').addClass("form-control");
  $('#website').addClass("form-control");
  $("select[name='lang']").addClass("form-control");
});
</script>

<div class="row row-for-menu2">
    <div class="col-sm-12">
        <section class="panel">
            <?php if ($this->method === 'create'): ?>
            <?php echo form_open_multipart(uri_string(), 'class="form-horizontal" autocomplete="off"') ?>
        <?php else: ?>
        <?php echo form_open_multipart(uri_string(), 'class="form-horizontal"') ?>
        <?php echo form_hidden('row_edit_id', isset($member->row_edit_id) ? $member->row_edit_id : $member->profile_id); ?>
    <?php endif ?>
    <header class="panel-heading tab-bg-dark-navy-blue">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#user-basic-data-tab"><span>Datos Basicos</span></a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#user-profile-fields-tab"><span>Campos personalizados</span></a></li>
            </li>
        </ul>
    </header>
    <div class="panel-body">
        <div class="tab-content">
            <div id="user-basic-data-tab" class="tab-pane active">

                <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-6 col-xs-11">
                        <span class="label label-danger">NOTA!</span>
                        <span>
                            Los campos señalados con <span style="color: red">*</span> son obligatorios.
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 req"><?php echo lang('global:email') ?></label>
                    <div class="col-md-4 col-xs-11">
                        <?php echo form_input('email', $member->email, 'id="email" class="form-control"') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 req">Usuario</label>
                    <div class="col-md-4 col-xs-11">
                        <?php echo form_input('username', $member->username, 'id="username" class="form-control"') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Grupo</label>
                    <div class="col-md-4 col-xs-11">
                        <?php echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, $member->group_id, 'id="group_id" class="form-control"') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Activar</label>
                    <div class="col-md-4 col-xs-11">
                        <?php $options = array(0 => lang('user:do_not_activate'), 1 => lang('user:active'), 2 => lang('user:send_activation_email')) ?>
                        <?php echo form_dropdown('active', $options, $member->active, 'id="active" class="form-control"') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 req"><?php echo lang('global:password') ?></label>
                    <div class="col-md-4 col-xs-11">
                        <?php echo form_password('password', '', 'id="password" autocomplete="off" class="form-control"') ?>
                    </div>
                </div>

            </div>

            <!-- Campos personalizados -->
            <div id="user-profile-fields-tab" class="tab-pane">
                <div class="form-group">
                    <label class="control-label col-md-2"></label>
                    <div class="col-md-6 col-xs-11">
                        <span class="label label-danger">NOTA!</span>
                        <span>
                            Los campos señalados con <span style="color: red">*</span> son obligatorios.
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 req">Nombre a mostrar</label>
                    <div class="col-md-4 col-xs-11">
                        <?php echo form_input('display_name', $member->display_name, 'id="display_name" class="form-control"') ?>
                    </div>
                </div>

                <?php foreach($profile_fields as $field): ?>
                <div class="form-group">
                    <label class="control-label col-md-2 <?php if ($field['required']){ ?> req<?php } ?>"><?php echo (lang($field['field_name'])) ? lang($field['field_name']) : $field['field_name'];  ?></label>
                    <div class="col-md-4 col-xs-11">
                        <?php echo $field['input'] ?>
                    </div>
                </div>
            <?php endforeach ?>

        </div>

    </div>
</div>

<div class="form-group bottom-10">
    <div class="col-lg-offset-2 col-lg-6">
        <?php echo form_hidden('type', 'html')?>   
        <?php echo form_hidden('slug', 'null')?>                        
        <button type="submit" name="btnAction" value="save" class="btn btn-primary">
            <span>Guardar</span>
        </button>
        <button type="submit" name="btnAction" value="save_exit" class="btn btn-info">
            <span>Guardar y Salir</span>
        </button>
        <a href="<?php echo base_url('admin/users') ?>" class="btn btn-danger">Cancelar</a>         
    </div>
</div>
</div>
<?php echo form_close() ?>
</section>
</div>
</div>



