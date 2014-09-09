<section class="title">
    <h4>Galeria</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-gallery"><span>Nueva Galeria</span></a></li>
            </ul>

            <div class="form_inputs" id="page-gallery">
                <?php echo form_open_multipart(site_url('admin/gallery/create_gallery/'), 'class="crud"'); ?>
                <div class="inline-form">
                <fieldset>
                    <ul>
                        <li>
                            <label for="name">Tipo <span>*</span></label>
                            <div class="input">
                                <select name="type" id="type">
                                    <option value="">Seleccione una opción</option>
                                    <option value="1" <?php echo (set_value('type') == 1) ? 'selected' : null ?>>Imagen</option>
                                    <option value="2" <?php echo (set_value('type') == 2) ? 'selected' : null ?>>Video</option>
                                </select>
                            </div>
                        </li>
                        <li id="title" style="border-bottom: none;"></li>
                        <li id="content-gallery" style="border-bottom: none;"></li>
                    </ul>
                </fieldset>

                <div class="buttons float-right padding-top">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                </div>
</div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</section>
<script>
    $(document).ready(function(){

        $("#type").change(function () {
            $tipo = $(this).val()
            if($tipo == 1){
                $("#title").html("<label for='name'>Titulo </label><div class='input'><input type='text' name='title' value=''></div>");
                $("#content-gallery").html("<label for='name'>Imagen<small>- Imagen Permitidas gif | jpg | png | jpeg<br>- Tamaño Máximo 2 MB<br>- Ancho Máximo 762px<br>- Alto Máximo 702px</small></label><div class='input'><div class='btn-false'><div class='btn'>Examinar</div><input type='file' name='content' value=''></div></div><br class='clear'>");
            }if($tipo == 2){
                $("#title").html("");
                $("#content-gallery").html("<label for='name'>Video <span>*</span><small>- Ancho Máximo 262px <br>- Alto Máximo 202px</small></label><div class='input'><textarea name='video' rows='10' class='dev-input-textarea'></textarea></div>");
            }if($tipo == 0){
                $("#title").html("");
                $("#content-gallery").html("Seleccione un tipo");
            }
        });
    });
</script>