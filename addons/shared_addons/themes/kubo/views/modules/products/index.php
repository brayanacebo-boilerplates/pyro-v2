
<script>
/**/
$(function(){
	$("ul.level_2 li ul.level_3 li.subcategory").each(function(){
		var id_control = $(this).parent().parent().get(0).id;
		console.log(id_control);
		var control_edit = $(".level_2 li#"+id_control);
		//control_edit.css("background","#F00");
		control_edit.append('<span class="more_items" id="'+id_control+'">+</span>');
	});
	$("span.more_items").click(function(){
		var id_sub_cat = $(this).attr("id");
		//$("li#"+id_sub_cat+" ul.level_3").css("display","block");
		if(!$("li#"+id_sub_cat+" ul.sub_"+id_sub_cat).is(":visible")){
			//console.log("not Visible");
			$("li#"+id_sub_cat+" ul.sub_"+id_sub_cat).slideDown();
		}else{
			//console.log("Visible");
			$("li#"+id_sub_cat+" ul.sub_"+id_sub_cat).slideUp();
		}
	});
	$(".list-group-item").click(function(ev){
		var target = $(ev.target);
		if(target.not('.list-group-item a,span.more_items').length){
			var cat = $(this).attr("id");
			console.log(cat);
			if(cat == "todos"){
				$(".level_2").slideDown();
				$(".ico-more").html("-");
			}
			if(!$(".sub_"+cat).is(":visible")){
				$("#"+cat+" .ico-more").html("-");
				$(".sub_"+cat).slideDown();
			}else{
				$("#"+cat+" .ico-more").html("+");
				$(".sub_"+cat).slideUp();
			}
		}
	});
});
/*eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(b(){$("6.e 3 6.A 3.C").B(b(){5 8=$(k).q().q().D(0).7;n.p(8);5 r=$(".e 3#"+8);r.H(\'<c E="i" 7="\'+8+\'">+</c>\')});$("c.i").t(b(){5 2=$(k).u("7");9(!$("3#"+2+" 6.4"+2).o(":m")){$("3#"+2+" 6.4"+2).d()}l{$("3#"+2+" 6.4"+2).v()}});$(".y-w-x").t(b(s){5 j=$(s.j);9(j.F(\'.y-w-x a,c.i\').z){5 1=$(k).u("7");n.p(1);9(1=="G"){$(".e").d();$(".f-g").h("-")}9(!$(".4"+1).o(":m")){$("#"+1+" .f-g").h("-");$(".4"+1).d()}l{$("#"+1+" .f-g").h("+");$(".4"+1).v()}}})});',44,44,'|cat|id_sub_cat|li|sub_|var|ul|id|id_control|if||function|span|slideDown|level_2|ico|more|html|more_items|target|this|else|visible|console|is|log|parent|control_edit|ev|click|attr|slideUp|group|item|list|length|level_3|each|subcategory|get|class|not|todos|append'.split('|'),0,{}))*/
</script>
<?php
	function build_categories($rows,$module=null,$parent=0,$ban=true,$current=null, $slugFather='', $level = 1)
	{
		$classCategories = 'category';
		$classSubcategoriesFather = 'subcategoriFather';
		$classSubcategories = 'subcategory';
		$plusClass = 'plus';
		$classActive = 'Activo';
		
        $result = "<ul ".(!empty($slugFather) ? 'class="level_'.$level.' sub_'.$slugFather.'"' : 'class="list-group"').">";
        if($ban) $result.= "<li id='todos' class='list-group-item'><a href='{$module}'>Todos</a></li>";
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
                $result.= "<li id='".$row->slug.'_'.$row->id."' class='".($children ? $plusClass : '').' '.($row->parent == 0 ? $classCategories : ($children ? $classSubcategoriesFather : $classSubcategories)).' '.($row->title == $current ? $classActive : '').($level < 2 ? 'list-group-item' : '')." '>
				<a href='{$module}/index/".$row->slug."'>".$row->title."</a>";
             if ($children = true)
			 {
			 	$result .= "<div class='ico-more'>+</div>";
                $result.= build_categories($rows,$module,$row->id,false, $current, $row->slug.'_'.$row->id, $level + 1) . "</li>";
			 }
			}
		}
		$result .= "</ul>";
		return $result;
    }
	
	$menu = build_categories($categories,'products', 0, true, $current, '', 1);
?>

<div class="container">

<!-- No borrar estos divs  -->
<div id="baseurl" class="hide">{{ url:site }}</div>
<div id="selCategory" class="hide">{{ selCategory }}</div>
<div id="page_ajax" class="hide">0</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1>Productos {{ category }}</h1>
    	<!--  Texto de introducción -->
        <div>{{ intro.text }}</div>
    </div>
</div>
<div class="row">
   
    <!-- Listado de categorias -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 hidden-xs hidden-sm  mtop30">
        <div class="treemenu">
            <?php echo $menu; ?>
        </div>
    </div>
    <!-- Select de categorias para smartphone -->
    <div class="col-sm-4 col-xs-12 visible-xs visible-sm mtop30">
        <div class="btn-group" style="margin-bottom: 10px;">
            <button type="button" class="btn btn-primary">Todas las Categorias</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
            <ul class="dropdown-menu">
            {{ categories }}
            <li><a href="products/index/{{ slug }}">{{ title }}</a></li>
            {{ /categories }}
            </ul>
        </div>
        <div class="push"></div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        <div class="row">
            {{ if products }}
	            <div class="clearfix " id="upload_items">
		            {{ products }}
		            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mtop10">
			            <article class="article">
						  <div class="article__inner">
						    <div class="inner__inner">
						      <a href="{{ url }}">
						      <h2 class="article__meta-data">{{ price }}</h2>
						      <div class="prod_img">
			                        <img src="{{image}}" alt="{{title}}" />
			                    </div>
						      </a>
						   </div>
						  </div>
						  <div class="article__excerpt">
						  <h1 class="title">{{ name }}</h1>
						  <p>{{ introduction }}</p>
						    </div>
						</article>  
					</div>
	            <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mtop30">
	                <div class="prod_img">
                        <img src="{{image}}" alt="{{title}}">
                    </div>
                    <div class="prod_text">
                        <h4>{{ name }}</h4>
                        <b>{{ price }}</b>
                        <div>{{ introduction }}</div>
                        
                        <a href="{{ url }}" class="btn btn-primary">Ver Más</a>
               		</div>
	            </div> -->
	            {{ /products }}
            </div>
            <div class="ajax_loading" id="ajax_loading" style="display:none;"><img src="{{ url:site }}uploads/default/AjaxLoader.gif" width="28" height="28"/></div>
            {{ else }}
            <div class="col-sm-12" id="stop_scroll"><p class="results"><strong>No se encontraron resultados...</strong></p></div>
            {{ endif }}
	        
        </div>
    </div>
</div>

</div>

<!-- Necesario para los styles del Menú -->
<script>
$(".treemenu").children().attr("class","list-group");
$(".list-group").children().attr("class","list-group-item");
</script>

<style>

</style>