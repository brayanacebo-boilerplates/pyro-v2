<!-- content general -->
<div class="container">

    <div class="row  featurette mtop30">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <blockquote>
                <p>Contacto</p>
            </blockquote>
            <p></p>
        </div>
    </div>

    <div class="row mtop10 mbottom20">
        <?php if ($this->session->userdata('error')): ?>
            <div style="color: red">
                <?php echo $this->session->userdata('error');$this->session->unset_userdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->userdata('success')): ?>
            <div style="color: green">
                <?php echo $this->session->userdata('success');$this->session->unset_userdata('success') ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo base_url() ?>contact_us/send" name="form_contact" id="form_contact">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="control-label">Nombre y apellidos</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <div class="form-group">
                <label class="control-label">E-mail</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label class="control-label">Mensaje</label>
                <textarea class="form-control" name="mensaje" id="menasaje" rows="7"></textarea>
            </div>
            <div class="form-group">
                <!--<a href="#" type="button" class="btn btn-primary enviarcontacto pull-right">ENVIAR</a>-->
                <input type="submit" class="btn btn-primary enviarcontacto pull-right" value="ENVIAR">
            </div>
        </div>
        </form>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 map" style="margin-top: 22px;">
            <?php echo $contact_us->schedule ?>
            <div class="row mtop20">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php     



                       $map = str_replace("#", "%23", $contact_us->map);



                       echo $map;



                  ?>
                </div>
            </div>
        </div>
    </div>

</div>