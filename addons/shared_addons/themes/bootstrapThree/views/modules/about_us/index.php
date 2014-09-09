<div class="container">
	<div class="row">
		<!-- TITULO -->
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1>{{ data:title }}</h1>
		</div>
	</div>

	<div class="row">
		<div class="about_us">
			<!-- IMAGE  -->
			{{ if data:image }}
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<img src="{{ data:image }}" alt="{{title}}">
			</div>
			{{ endif }}
			<!-- VIDEO -->
			{{ if data:video }}
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				{{ data:video }}
			</div>
			{{ endif }}
			<!-- TEXTO -->
			<div class="text_about">{{ data:text }}</div>
		</div>
	</div>
</div>