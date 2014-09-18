<div class="container">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h1>{{work_with_us:title}}</h1>

        </div>

    </div>

    <div class="row mtop10">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php echo form_open_multipart(site_url('work_with_us/send'), 'class="crud"'); ?>        

            <!--<?php if ($this->session->flashdata('error')): ?>

                <div style="color: red">

                    <?php echo $this->session->flashdata('error') ?>

                </div>

            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>

                <div style="color: green">

                    <?php echo $this->session->flashdata('success') ?>

                </div>

            <?php endif; ?>-->

            <div class="form-group">

                <!-- <label class="control-label">Nombre y apellido *</label> -->

                <input type="text" class="form-control" name="name" value="<?php echo set_value('nombre') ?>" placeholder="Nombre y Apellido*">

            </div>

            <div class="form-group">

                <!-- <label class="control-label">Correo Electrónico *</label> -->

                <input type="text" class="form-control" name="email" value="<?php echo set_value('correo') ?>" placeholder="Correo Electrónico*">

            </div>

            <div class="form-group">

                <!-- <label class="control-label">Teléfono</label> -->

                <input type="text" class="form-control" name="phone" value="<?php echo set_value('telefono') ?>" placeholder="Teléfono">

            </div>

           <div class="form-group">

                <!-- <label class="control-label">Celular</label> -->

                <input type="text" class="form-control" name="cell" value="<?php echo set_value('cell') ?>" placeholder="Celular">

            </div>

            <div class="form-group">

                <!-- <label class="control-label">Empresa/Organización</label> -->

                <input type="text" class="form-control" name="company" value="<?php echo set_value('empresa') ?>" placeholder="Empresa/Organización">

            </div>

            <!-- <div class="form-group">

                <label class="control-label">Municipio/Departamento</label>

                <input type="text" class="form-control" name="city" value="<?php echo set_value('municipio') ?>">

            </div> -->
			
			<div class="form-group">

                <label class="control-label">Hoja de vida:</label>

                <?php echo form_upload('file', '', ' id="file" class="form-control" style="padding: 5px;"'); ?>

            </div>
			
            <div class="form-group">

                <!-- <label class="control-label">Mensaje *</label> -->

                <textarea class="form-control" rows="5" name="message" placeholder="Mensaje*"><?php echo set_value('mensaje') ?></textarea>

            </div>

            <div align="right" class="form-group">

                <!-- <input type="submit" class="btn btn-primary enviarcontacto" name="btnAction"> -->
                <button type="submit" name="btnAction" class="btn btn-primary">Enviar</button>
    
            </div>

            <?php echo form_close(); ?>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mtop15 work">
			<img src="{{work_with_us:image}}" alt="" class="img-responsive shadow">
            <div>{{work_with_us:text}}</div>
        </div>

    </div>

</div>