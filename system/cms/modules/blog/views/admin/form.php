
<div class="row row-for-menu2">
    <div class="col-sm-12">
        <section class="panel">
            <?php echo form_open_multipart('', ' class="form-horizontal"') ?>
            <header class="panel-heading tab-bg-dark-navy-blue">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#create">Crear artículo</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#intro">Campos personalizados</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#options">Opciones</a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
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
                            <?php echo form_input('title', htmlspecialchars_decode($post->title), 'maxlength="100" id="title" class="form-control"') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Estado</label>
                        <div class="col-md-4 col-xs-11">
                            <?php echo form_dropdown('status', array('draft' => lang('blog:draft_label'), 'live' => lang('blog:live_label')), $post->status, 'class="form-control"') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 req">Contenido</label>
                        <div class="col-sm-9">
                            <?php echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' => $post->body, 'rows' => 30, 'class' => 'form-control ckeditor')) ?>
                            <span class="help-block">Evite pegar texto directamente desde un sitio web u otro editor de texto, de ser necesario use la herramienta pegar desde.</span>
                        </div>
                        <?php echo form_hidden('preview_hash', $post->preview_hash)?>
                    </div>



                </div>

                <?php if ($stream_fields): ?>
                <!-- Campos personalizados -->
                <div id="intro" class="tab-pane">
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
                        <label class="control-label col-md-2 req">Introducción</label>
                        <div class="col-sm-9">
                            <?php echo form_textarea(array('id' => 'intro', 'name' => 'intro', 'rows' => 10, 'cols' => 40, 'class' => 'form-control ckeditor', 'value' => $stream_fields[0]['value'])) ?>
                            <span class="help-block">Evite pegar texto directamente desde un sitio web u otro editor de texto, de ser necesario use la herramienta pegar desde.</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Opciones -->
                <div id="options" class="tab-pane ">
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
                        <label class="control-label col-md-2">Categoría</label>
                        <div class="col-sm-6">
                            <?php echo form_dropdown('category_id', array(lang('blog:no_category_select_label')) + $categories, @$post->category_id, 'class="form-control"') ?>
                        </div>
                        <div class="col-sm-3">
                        [ <?php echo anchor('admin/blog/categories/create', lang('blog:new_category_label'), 'target="_blank"') ?> ]
                        </div>
                    </div>

                    <?php if ( ! module_enabled('keywords')): ?>
                        <?php echo form_hidden('keywords'); ?>
                    <?php else: ?>
                        <div class="form-group">
                            <label class="control-label col-md-2">Palabras claves</label>
                            <div class="col-sm-9">
                                <?php echo form_input('keywords', $post->keywords, 'id="keywords" class="form-control" placeholder="separadas por comas"') ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="control-label col-md-2">Fecha</label>
                        <div class="col-md-3 col-xs-11 datetime_input">
                            <?php echo form_input('created_on', date('Y-m-d', $post->created_on), 'size="16" class="form-control form-control-inline input-medium default-date-picker"') ?> &nbsp;
                        </div>
                        <div class="col-md-3 col-xs-11 datetime_input">
                            <?php echo form_dropdown('created_on_hour', $hours, date('H', $post->created_on), 'class="form-control" title="Hora"') ?>
                        </div>
                        <div class="col-md-3 col-xs-11 datetime_input">
                           <?php echo form_dropdown('created_on_minute', $minutes, date('i', ltrim($post->created_on, '0')), 'class="form-control" title="Minuto"') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Comentarios Habilitados</label>
                        <div class="col-md-4 col-xs-11">
                            <?php echo form_dropdown('comments_enabled', array(
                            'no' => lang('global:no'),
                            '1 day' => lang('global:duration:1-day'),
                            '1 week' => lang('global:duration:1-week'),
                            '2 weeks' => lang('global:duration:2-weeks'),
                            '1 month' => lang('global:duration:1-month'),
                            '3 months' => lang('global:duration:3-months'),
                            'always' => lang('global:duration:always'),
                            ), $post->comments_enabled ? $post->comments_enabled : '3 months', 'class="form-control"') ?>
                        </div>
                    </div>

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
                <a href="<?php echo base_url('admin/blog') ?>" class="btn btn-danger">Cancelar</a>         
            </div>
        </div>

        <?php echo form_close() ?>
    </section>
</div>
</div>