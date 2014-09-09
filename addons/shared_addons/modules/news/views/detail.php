<div class="container">
    <div class="row mtop70">
        <a class="btn btn-primary btn-sm back" href="javascript:history.back(1)">← Volver</a>
        <div class="col-lg-12 col-md-12 col-sm-12 alignleft">
            <h2 class="color-text-blue2"><?php echo $data->title; ?></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 alignleft">
            <div class="thumbnail img-float-left">
                <div style="overflow: hidden;max-height:400px;">
                    <img src="<?php echo $data->image; ?>" data-src="holder.js/400x400" width="100%" alt="" class="img-responsive">
                </div>
            </div>
            <p><?php echo $data->content; ?></p>
            <small class="small-float">Publicado: <?php echo $data->date; ?></small>
        </div>
        <br>
    </div>
</div>