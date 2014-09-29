
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                Sobre nosotros
            </header>
            <div class="panel-body">
                <?php echo form_open_multipart(site_url('admin/about/'), ' class="form-horizontal"'); ?>

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
                        <?php echo form_input('title', set_value('title', isset($data->title) ? $data->title : ""), 'class="form-control" '); ?>
                        <span class="help-block">Texto de Introducción</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Imagen</label>

                    <?php if (!empty($data->image)): ?>
                                 <div>
                                    <img src="<?php echo site_url($data->image) ?>" width="298">
                                </div>
                            <?php endif; ?>

                    
                    <div class="controls col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-white btn-file">
                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Seleccionar imagen</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Cambiar</span>
                                <input type="file" class="default" name="image"/>
                            </span>
                            <span class="fileupload-preview" style="margin-left:5px;"></span>
                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                            <span class="help-block">
                                - Imagen Permitidas gif | jpg | png | jpeg<br>
                                - Tamaño Máximo 2 MB<br>
                                - Ancho 478px<br>
                                - Alto 315px
                            </span>
                        </div>

                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                             <span class="btn btn-white btn-file">
                                 <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                 <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                 <input type="file" class="default" />
                             </span>
                             <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="form-group">
                <label class="control-label col-md-2">Video</label>
                <div class="col-md-8 col-xs-11">
                    <textarea class="form-control" rows="4" name="video"></textarea>
                    <span class="help-block">
                        - Insertar fragmento de código desde su sitio de videos, suele ser un iframe.<br>
                        - Ancho 478px<br>
                        - Alto 315px
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2 req">Texto</label>
                <div class="col-sm-9">
                    <textarea class="form-control ckeditor" name="text" rows="6"><?php echo $data->text; ?></textarea>
                    <span class="help-block">Evite pegar texto directamente desde un sitio web u otro editor de texto, de ser necesario use la herramienta pegar desde.</span>
                </div>
            </div>


           <div class="form-group">
            <div class="col-lg-offset-2 col-lg-6">
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </div>

        <?php echo form_hidden('id', $data->id); ?>
        <?php echo form_close(); ?>
    </div>
</section>
</div>
</div>



<hr>





<section class="title">
    <h4>Editar Sobre Nosotros</h4>
    <br>
    <small class="text-help">Los campos señalados con <span>*</span> son obligatorios.</small>

</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-view"><span>Contenido</span></a></li>
            </ul>

            <div class="form_inputs" id="page-view">
                <?php echo form_open_multipart(site_url('admin/about/'), 'id="form-wysiwyg"'); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                            <li class="even">
                                <label for="name">
                                    Titulo
                                    <span>*</span>
                                    <small>Texto de Introducción</small>
                                </label>
                                <div class="input">
                                    <?php echo form_input('title', set_value('title', isset($data->title) ? $data->title : ""),'style="width:50%"'); ?>
                                </div>
                                <br class="clear">
                            </li>

                            <li>
                                <label for="name">
                                    Imagen
                                    <small>
                                        - Imagen Permitidas gif | jpg | png | jpeg<br>
                                        - Tamaño Máximo 2 MB<br>
                                        - Ancho 478px<br>
                                        - Alto 315px
                                    </small>
                                </label>
                                <div class="input">
                                 <?php if (!empty($data->image)): ?>
                                 <div>
                                    <img src="<?php echo site_url($data->image) ?>" width="298">
                                </div>
                            <?php endif; ?>
                            <div class="btn-false">
                                <div class="btn">Examinar</div>
                                <?php echo form_upload('image', '', ' id="image"'); ?>
                            </div>
                        </div>
                        <br class="clear">
                    </li>

                    <li class="even">

                        <label for="name">Video
                            <span></span>
                            <small>
                                - Insertar fragmento de código desde su sitio de videos, suele ser un iframe.<br>
                                - Ancho 478px<br>
                                - Alto 315px
                            </small>
                        </label>
                        <div class="input">
                            <?php if (!empty($data->video)): ?>
                            <div>
                                <?php echo htmlspecialchars_decode($data->video); ?>
                            </div>
                        <?php endif; ?>
                        <?php echo form_textarea('video', set_value('video', isset($data->video) ? $data->video : ""), ' id="video" style="width: 580px;height: 100px;"'); ?>
                    </div>
                    <br class="clear">
                </li>

                <li>
                    <label for="name">
                        Texto
                        <span>*</span>
                        <small>Evite pegar texto directamente desde un sitio web u otro editor de texto, de ser necesario use la herramienta pegar desde.</small>
                    </label>
                    <div class="input">
                        <div class="sroll-table">
                            <?php echo form_textarea(array('id' => 'text-wysiwyg', 'name' => 'text_wysiwyg', 'value' => $data->text, 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                            <input type="hidden" name="text" id="text">
                        </div>
                    </div>
                    <br class="clear">
                </li>

                <li>
                    <div class="buttons float-right padding-top">
                        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                    </div>
                </li>

            </ul>
        </fieldset>
    </div>

    <?php echo form_hidden('id', $data->id); ?>
    <?php echo form_close(); ?>
</div>

</div>
</div>
</section>



