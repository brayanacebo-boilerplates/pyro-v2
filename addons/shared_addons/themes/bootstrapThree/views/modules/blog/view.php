<div class="container">

	<!-- Post heading -->	

{{ post }}
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h1>{{ title }}</h1>
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
		<div class="blog_body mtop10">
			{{ body }}
		</div>
		<div class="clear"></div>
	</div>
</div>

{{ /post }}

<?php if (Settings::get('enable_comments')): ?>

<div id="comments" class="panel panel-info mtop20">
	<div class="panel-heading">
		<h4><?php echo lang('comments:title') ?></h4>
	</div>
	<div id="existing-comments" class="panel-body">
		<?php echo $this->comments->display() ?>
	</div>

	<?php if ($form_display): ?>
		<?php echo $this->comments->form() ?>
	<?php else: ?>
	<?php echo sprintf(lang('blog:disabled_after'), strtolower(lang('global:duration:'.str_replace(' ', '-', $post[0]['comments_enabled'])))) ?>
	<?php endif ?>
</div>

<?php endif ?>

</div>
