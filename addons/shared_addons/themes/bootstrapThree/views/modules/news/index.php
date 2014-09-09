<div class="container">
<div class="row">
	<!-- TITULO -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1>Noticias</h1>
	</div>
</div>

	{{ news }}
	<div class="row news">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<a href="{{ urlDetail }}">
				<div class="news_img">
					<img src="{{ image }}" alt="">
				</div>
			</a>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>{{ title }}</h3>
			<b>{{ date }}</b>
			<div>{{ introduction }}</div>
			<a class="btn btn-primary" href="{{ urlDetail }}">Ver Más</a>
		</div>
	</div>
	<hr/>
	{{ /news }}
	{{ pagination }}
</div>

