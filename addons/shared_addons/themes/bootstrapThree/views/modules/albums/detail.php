<div class="container_body">
<div class="row">
    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-12">
        <h1>{{ album.name }}</h1>
    </div>
    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-12 tx-al-ri">
        <a class="btn btn-primary btn-sm back" href="javascript:history.back(1)"><span class="glyphicon glyphicon-arrow-left"></span> Volver</a>
    </div>
    <div class="alignleft">
        <div class="thumbnail img-float-left col-sx-12 col-sm-4 col-md-4 col-lg-4">
            <div class="pro_det">
                <?php if(count($images) > 0){ ?>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-width:460px;">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        {{ images }}
                        <div class="item {{ if { helper:count identifier='c2' } == 1 }}active{{ endif }}" style="background-color: white !important;">
                           <img src="{{ path }}" data-src="holder.js/400x400" width="100%" alt="imagen" class="img-responsive">
                       </div>
                       {{ /images }}
                   </div>
                <!-- controls -->
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
               </div>
				<!-- Indicators -->
				<!--<ol class="carousel-indicators">
					{{ images }}
					<li data-target="#carousel-example-generic" data-slide-to="{{helper:count}}" {{ if { helper:count identifier='c' } == 1 }}class="active"{{ endif }} style="border: 1px solid #d7e0e2;"></li>
					{{ /images }}
					<br />
				</ol>-->
               <?php }else{ ?>
               <img src="{{ album.image }}" data-src="holder.js/400x400" width="100%" alt="" class="img-responsive">
               <?php } ?>
               
           </div>
       </div>
       
       
       {{ if videos }}
       		<h4>Videos</h4>
           {{ videos }}
           		{{ video }}<br/>
           {{ /videos }}
       {{ endif }}
       
       <div class="col-sx-12 col-sm-8 col-md-8 col-lg-8">
       <p>{{ album.introduction }}</p>
       </div>
       <div class="row">
        <div class="col-sx-12 col-sm-12 col-md-12 col-lg-12">
            <div class="well well-sm cat_rel">
                <h3>Categorias relacionadas</h3>
                {{ categories }}
                <a href="albums/index/{{ slug }}">{{ title }}</a>&nbsp;&nbsp;
                {{ /categories }}
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

