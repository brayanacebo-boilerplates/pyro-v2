
<div class="container">
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h1>{{ product.name }}</h1>
          <a class="btn btn-primary btn-absolute" href="javascript:history.back(1)"><i class="fa fa-arrow-left"></i> Volver</a> 
      </div>
      <div class="products">

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <?php if(count($images) > 0){ ?>

          <div class="flexslider detail">
            <ul class="slides">
              {{ images }}
              <li>
                <img src="{{ path }}" />
              </li>
              {{ /images }}
              
            </ul>
          </div>
          <?php }else{ ?>
          <img src="{{ product.image }}" class="img_detail_prod shadow" />
          <?php } ?>
            
        </div>
        <div class="text_products"> 
         <span class="small-float price">{{ product.price }}</span>
         <div>{{ product.description }}</div>

        </div>   
      </div>
  </div>
</div>
<!-- <div class="row">
    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-12">
        <div class="well well-sm cat_rel">
            <h3>Categorias relacionadas</h3>
            {{ categories }}
            <a href="products/index/{{ slug }}">{{ title }}</a>&nbsp;&nbsp;
            {{ /categories }}
        </div>
    </div>
</div> -->