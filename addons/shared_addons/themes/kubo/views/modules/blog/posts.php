<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h1>Blog <b>{{ category }}</b></h1>
	    </div>
	</div>
	
{{ if posts }}
	{{ posts }}
	<div class="row">

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<h3 class="tittle_blog">{{ title }}</h3>
            <div class="author">
                <div>{{ helper:lang line="blog:written_by_label" }}
                <a href="{{ url:site }}user/{{ created_by:user_id }}">{{ created_by:display_name }}</a></div>
                <span class="date">{{ helper:lang line="blog:posted_label" }} {{ helper:date timestamp=created_on }}</span>
                {{ if category }}
				<div class="category">
					{{ helper:lang line="blog:category_label" }}
					<span><a href="{{ url:site }}blog/category/{{ category:slug }}">{{ category:title }}</a></span>
				</div>
				{{ endif }}

				{{ if keywords }}
				<div class="keywords">
					<div class="tittle_tag">Palabras clave:</div>
					<div class="cont_tag">
						{{ keywords }}
							<span class="tag"><a href="{{ url:site }}blog/tagged/{{ keyword }}">{{ keyword }}</a></span>
						{{ /keywords }}
					</div>
				</div>
				{{ endif }}
            </div>
        </div>


			
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
         
			<div class="preview mtop10">
				{{ preview }}
			</div>
			<div class="clear"></div>
			<div align="right"><a href="{{ url }}" class="btn btn-primary mtop10">Ver Más</a></div>
		<hr />
		</div>
	</div>
	
	{{ /posts }}
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
		{{ pagination }}
		</div>
	</div>
{{ else }}
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			{{ helper:lang line="blog:currently_no_posts" }}
		</div>
	</div>
{{ endif }}

</div>
