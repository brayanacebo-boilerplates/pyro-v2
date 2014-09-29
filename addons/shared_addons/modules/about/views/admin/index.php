
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

<script type="text/javascript">

$('#add-without-image').click(function(){
    $.gritter.add({
        title: 'This is a notice without an image!',
        text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" style="color:#ccc">magnis dis parturient</a> montes, nascetur ridiculus mus.'
    });
    return false;
});
</script>

