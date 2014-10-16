
<div class="row row-for-menu2">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <?php if ($this->controller == 'admin_categories' && $this->method === 'edit'): ?>
                <?php echo sprintf(lang('cat:edit_title'), $category->title);?>
            <?php else: ?>
            <?php echo lang('cat:create_title');?>
        <?php endif ?>
    </header>
    <div class="panel-body">
        <?php echo form_open_multipart('', ' class="form-horizontal crud'.((isset($mode)) ? ' '.$mode : '').'" id="categories"') ?>
        
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
                    <label class="control-label col-md-2 req">Titulo</label>
                    <div class="col-md-4 col-xs-11">
                        <?php echo  form_input('title', $category->title, 'class="form-control"') ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-6">
                        <?php echo  form_hidden('id', $category->id) ?>
                        <button type="submit" name="btnAction" value="save" class="btn btn-primary"><span>Guardar</span></button>
                        <a href="<?php echo base_url('admin/blog/categories'); ?>" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
                
            </div>
        </div>
        <?php echo form_close() ?>
    </div>        
</section>
</div>
</div>