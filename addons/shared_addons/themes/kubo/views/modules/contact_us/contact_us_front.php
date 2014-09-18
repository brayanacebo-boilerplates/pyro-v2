<div id="baseurl" style="display:none">{{ url:site }}</div>
<div class="container">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h1 class="t-todos title_seccion">Cont&aacute;ctanos</h1>

        </div>

    </div>

    <div class="row mtop10">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">

            <?php echo form_open(site_url('contact_us/send'), 'class="crud form_contac_ajax"'); ?>        

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
			
			<div id="loading_contacts"></div>
			
            <div class="form-group">

                <!--<label class="control-label">Nombre y apellido *</label>-->

                <input type="text" class="form-control" name="name" placeholder="Nombre y apellido *" value="<?php echo set_value('nombre') ?>">

            </div>

            <div class="form-group">

                <!--<label class="control-label">Correo Electrónico *</label>-->

                <input type="text" class="form-control" name="email" placeholder="Correo Electrónico *" value="<?php echo set_value('correo') ?>">

            </div>

            <div class="form-group">

                <!--<label class="control-label">Teléfono</label>-->

                <input type="text" class="form-control" name="phone" placeholder="Teléfono" value="<?php echo set_value('telefono') ?>">

            </div>

           <div class="form-group">

                <!--<label class="control-label">Celular</label>-->

                <input type="text" class="form-control" name="cell" placeholder="Celular" value="<?php echo set_value('cell') ?>">

            </div>

            <div class="form-group">

                <!--<label class="control-label">Empresa/Organización</label>-->

                <input type="text" class="form-control" name="company" placeholder="Empresa/Organización" value="<?php echo set_value('empresa') ?>">

            </div>

            <!-- <div class="form-group">

                <label class="control-label">Municipio/Departamento</label>

                <input type="text" class="form-control" name="city" value="<?php echo set_value('municipio') ?>">

            </div> -->

            <div class="form-group">

                <!--<label class="control-label">Mensaje *</label>-->

                <textarea class="form-control" rows="5" name="message" placeholder="Mensaje *"><?php echo set_value('mensaje') ?></textarea>

            </div>

            <div align="right" class="form-group">

                <input type="submit" class="btn btn-primary" name="btnAction">

            </div>

            <?php echo form_close(); ?>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php if(isset($contact_us->map) && !empty($contact_us->map)): ?>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php     
                       $map = str_replace("#", "%23", $contact_us->map);
                       echo $map;
                  ?>
               </div>

            </div>

            <?php endif; ?>


                <div>

                    <h3>Datos de Contacto</h3>

                    <ul>
                    
                    <div class="row">
                    	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <li>Dirección: <?php echo (isset($contact_us->adress) ? $contact_us->adress: ''); ?></li>
                        </div>
                    	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <li>Teléfono: <?php echo (isset($contact_us->phone) ? $contact_us->phone: ''); ?></li>
                        </div>
                    	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <li>E-mail: <?php echo (isset($contact_us->email) ? $contact_us->email: ''); ?></li>
                        </div>
                    </div>

                    </ul>

                </div>


            <?php /*?><div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">

                <div class="cont_datos_contacto">

                    <h3 class="titulo-cor">Horarios de atenci&oacute;n</h3>

                    <hr class="hr_title_seccion2">

                    <ul class="contacto">
                        <li><?php echo (isset($contact_us->schedule) ? $contact_us->schedule: ''); ?></li>
                    </ul>

                </div>

            </div><?php */?>

        </div>

    </div>

</div>