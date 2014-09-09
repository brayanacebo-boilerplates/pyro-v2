<div class="container">
    <div class="row mtop40">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="color-text-blue"><strong>Galeria</strong></h2>
            <p><?php echo $intro->text; ?></p>
        </div>
    </div>
    <br>

    <div class="row">
        <?php foreach ($gallery as $item): ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <?php if ($item->type == 1) { ?>
                    <?php if (!empty($item->content)): ?>
                        <a href="<?php echo $item->content ?>" target="_blanck">
                            <div style="overflow: hidden;max-height:202px;">
                                <small class="title-gallery"><?php echo $item->title ?></small>
                                <img src="<?php echo $item->content; ?>" alt="<?php echo $item->content ?>" data-src="holder.js/300x200" class="img-responsive" style="min-width: 100%;">
                            </div>
                        </a>
                    <?php endif; ?>
                    <?php }else { ?>
                    <div style="overflow: auto;max-height:202px;">
                        <?php echo $item->content ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <?php echo $pagination ?>
</div>
<div class="push"></div>


