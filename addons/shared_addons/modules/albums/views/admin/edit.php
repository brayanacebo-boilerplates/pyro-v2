<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">Editar Album</header>
            <div class="panel-body">
                <?php echo form_open_multipart(site_url('admin/albums/update'), ' class="form-horizontal"') ?>

                <div class="tab-content">
                    <div id="create" class="tab-pane active">
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
                            <label class="control-label col-md-2 req">Nombre</label>
                            <div class="col-md-4 col-xs-11">
                                <?php echo  form_input('name', $album->name, 'class="form-control"') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-6">
                                <?php echo  form_hidden('id', $album->id) ?>
                                <button type="submit" name="btnAction" value="save" class="btn btn-primary"><span>Guardar</span></button>
                                <a href="<?php echo base_url('admin/albums'); ?>" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>

                    </div>
                </div>
                <?php echo form_close() ?>
            </div>        
        </section>
    </div>
</div>