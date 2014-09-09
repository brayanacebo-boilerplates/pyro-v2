<div class="container">
    <div class="row mtop70">
        <a class="btn btn-primary btn-sm back" href="javascript:history.back(1)">← Volver</a>
        <div class="col-lg-12 col-md-12 col-sm-12 alignleft">
            <h2 class="color-text-blue2"><?php echo $service->name; ?></h2>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 alignleft">
            <div class="thumbnail img-float-left">
                <div style="overflow: hidden;max-height:400px;">
                    <?php if(count($images) > 0){ ?>
                        <div id="carousel-example-generic" class="carousel slide " data-ride="carousel" style="height:400px; width: 460px">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                            <?php for($i=0;$i<count($images);$i++): ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php echo ($i < 1) ? 'class="active"' : null; ?> style="border: 1px solid #d7e0e2;"></li>
                            <?php endfor; ?>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php $firts = true;foreach ($images as $item): ?>
                                <div class="item <?php echo ($firts) ? 'active' : null; ?>" style="background-color: white !important;">
                                    <img src="<?php echo $item->path; ?>" data-src="holder.js/400x400" width="100%" alt="imagen" class="img-responsive">
                                </div>
                                <?php $firts = false;endforeach; ?>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <img src="<?php echo $service->image; ?>" data-src="holder.js/400x400" width="100%" alt="" class="img-responsive">
                    <?php } ?>
                </div>
            </div>
            <p><?php echo $service->description; ?></p>
            <small class="small-float"><?php echo $service->price; ?></small>
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm" style="float: left;margin-top: 2em;">
                        <strong>Categorias relacionadas</strong><br>
                        <?php foreach ($categories as $category): ?>
                            <a href="services/index/<?php echo $category['slug'] ?>"><?php echo $category['title'] ?></a>&nbsp;&nbsp;
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>

