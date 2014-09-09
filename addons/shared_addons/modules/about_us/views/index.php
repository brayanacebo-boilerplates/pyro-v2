<div class="row">
    <!-- TITULO -->
    <div class="col-md-12"><h3><?php echo $data->title ?></h3></div>
    <br>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="thumbnail">
            <!-- IMAGEN -->
            <?php if (!empty($data->image)): ?>
                <div style="overflow: hidden;max-height:490px;">
                    <img src="<?php echo $data->image ?>" alt="imagen" data-src="holder.js/300x200" class="img-responsive" style="min-width: 100%;">
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="thumbnail">
            <!-- VIDEO -->
            <?php if (!empty($data->video)): ?>
                <div style="overflow: hidden;max-height:490px;overflow-x: auto;">
                    <?php echo $data->video; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <!-- TEXTO -->
    <div class="col-md-12"><?php echo $data->text ?></div>
</div>