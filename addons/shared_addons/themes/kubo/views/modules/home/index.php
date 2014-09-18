
<!-- carousel -->
<div class="pos-banner">

	<div class="flexslider">
	<div class="trans-banner"></div>
	  <ul class="slides">

	  	{{ banner }}
	    <li>
	      <a href="{{link}}" target="_blank"><img src="{{image}}" alt="{{title}}"></a>
			<div class="flex-caption">
				<h3>{{title}}</h3>
				<p>{{text}}</p>
			</div>
	    </li>
	    {{ /banner }}
	  </ul>
	</div>
</div>

<!-- Info text -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>{{ text_info:title }}</h2>
			<div>{{ text_info:text }}</div>
			<p>{{ text_info:date }}</p>
		</div>
	</div>
</div>

<!-- news -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center mtop40">
			<h3 class="tittle-home">NOTICIAS <b>Destacadas</b></h3>
		</div>
	</div>
</div>
<div class="grid">
{{outstanding_news}}
<figure class="effect-romeo">
	<img src="{{image}}" alt="{{title}}"/>
	<figcaption>
		<h2>{{title}}</h2>
		<p>{{text}}</p>
		<a href="{{link}}">Ver Más</a>
	</figcaption>			
</figure>
{{/outstanding_news}}

</div>

<!-- Services  -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center mtop40">
			<h3 class="tittle-home"><b>Servicios</b> DESTACADAS</h3>
		</div>
	</div>
</div>
<div class="grid">
{{outstanding_services}}
<figure class="effect-layla">
	<img src="{{image}}" alt="{{title}}"/>
	<figcaption>
		<h2>{{title}}</h2>
		<p>{{text}}</p>
		<a href="{{link}}">Ver Más</a>
	</figcaption>			
</figure>
{{/outstanding_services}}
</div>


<!-- Products  -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center mtop40">
			<h3 class="tittle-home">PRODUCTOS <b>Destacados</b></h3>
		</div>
	</div>
</div>
<div class="grid">
{{products}}

<figure class="effect-oscar">
	<img src="{{image}}"/>
	<figcaption>
		<h2>{{name}}</h2>
		<p>{{introduction}}</p>
		<a href="{{link}}">Ver Más</a>
	</figcaption>			
</figure>

{{/products}}
</div>

<!-- News type 2  -->

<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center mtop40">
			<h3 class="tittle-home"><b>Noticias</b> DESTACADAS</h3>
		</div>
	</div>
</div>
<div class="grid">
{{news}}

<figure class="effect-sarah">
	<img src="{{image}}"/>
	<figcaption>
		<h2>{{title}}</h2>
		<div>{{ date }}</div>
		<p>{{introduction}}</p>
		<a href="{{link}}">Ver Más</a>
	</figcaption>			
</figure>

{{/news}}
</div>

<!-- Our clients  -->
<!-- <div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2>Nuestros Clientes</h2>
		</div>
		<br />
		{{ if customers }}
			<div class="slider1">
				{{ customers }}
			  		<div class="slide"><img src="{{image}}" alt="{{name}}" onclick="window.open('{{link}}','_blank');"></div>
			  	{{ /customers }}
			</div>
		{{ endif }}
	</div>
</div> -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center mtop40">
			<h3 class="tittle-home">NUESTROS <b>Aliados</b></h3>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center mtop40">

			{{ if customers }}
				
			<div id="wrapper">
				<div id="carousel">
					{{ customers }}

					<img src="{{image}}" alt="{{name}}" width="250" height="150" />
					{{ /customers }}

				
				</div>
			</div>
			<a id="prev" href="#"></a>
			<a id="next" href="#"></a>
			{{ endif }}
		</div>
	</div>
</div>