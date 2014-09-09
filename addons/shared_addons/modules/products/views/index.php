<?php
	function build_categories($rows,$module=null,$parent=0,$ban=true,$current=null)
	{
		$classCategories = 'category';
		$classSubcategoriesFather = 'subcategoriFather';
		$classSubcategories = 'subcategori';
		$classActive = 'Activo';
		
        $result = "<ul>";
        if($ban) $result.= "<li id='todos'><a href='{$module}'>Todos</a></li>";
        foreach ($rows as $row)
		{
            if ($row->parent == $parent)
			{
				foreach ($rows as $subrow)
				{
                    if ($subrow->parent == $row->id)
                     $children = true;
                 else $children = false;
				}
                $result.= "<li id='".$row->slug."' class='".($row->parent == 0 ? $classCategories : ($children ? $classSubcategoriesFather : $classSubcategories)).' '.($row->title == $current ? $classActive : '')."'><a href='{$module}/index/".$row->slug."'>".$row->title."</a>";
             if ($children = true)
                $result.= build_categories($rows,$module,$row->id,false, $current) . "</li>";
			}
		}
		$result .= "</ul>";
		return $result;
    }
	
	$menu = build_categories($categories,'products', 0, true, $current);
?>
<div class="container">
    <div class="row mtop40">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="color-text-blue"><strong>Productos <?php echo $category; ?></strong></h2>
        </div>
    </div>
    <br>
    <div class="row">
        <!--  Texto de introducción administrable -->
        <div class="col-sm-12 col-md12"><p><?php echo $intro->text ?></p></div>
        <!-- Listado normal de categorias -->
        <div class="col-sm-6 col-md-3 visible-md visible-lg">
            <div class="treemenu">
                <?php echo $menu; ?>
            </div>
        </div>
        <!-- Select de categorias -->
        <div class="col-sm-6 col-md-3 visible-sm visible-xs">
            <div class="btn-group" style="margin-bottom: 10px;">
              <button type="button" class="btn btn-primary">Primary</button>
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
              <ul class="dropdown-menu">
                <?php foreach ($categories as $item): ?>
                    <li><a href="products/index/<?php echo $item->slug ?>"><?php echo $item->title ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="push"></div>
    </div>
    <div class="col-sm-6 col-md-9">
        <div class="row">
        <?php if($products): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div style="overflow: hidden;max-height:170px;">
                            <img src="<?php echo $product->image; ?>" data-src="holder.js/300x200" width="100%" alt="" class="img-responsive">
                        </div>
                        <div class="caption">
                            <h4><?php echo $product->name ?></h4>
                            <p><?php echo $product->introduction ?></p>
                            <small class="small-float"><i><?php echo $product->price; ?></i></small><br>
                            <p><a class="btn btn-primary btn-sm" href="<?php echo $product->url ?>" >Ver Mas</a></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-sm-12 col-md12"><p style="text-align:center;margin-top:80px"><strong>No se encontraron resultados...</strong></p></div>
        <?php endif; ?>
        </div>
    </div>
</div>
</div>
<div class="push"></div>

<!-- Necesario para los styles del Menú -->
<script>
    $(".treemenu").children().attr("class","list-group");
    $(".list-group").children().attr("class","list-group-item");
</script>
