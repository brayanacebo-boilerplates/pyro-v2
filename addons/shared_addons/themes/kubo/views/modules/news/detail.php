<div class="container">
	<div class="row">
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mtop10">
	        <h1>{{ data.title }}</h1>
	        <a class="btn btn-primary btn-absolute" href="javascript:history.back(1)"><i class="fa fa-arrow-left"></i> Volver</a>
	    </div>

	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 news_detail mtop30">
		    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="news-posts">
					<h4>Últimas Noticias</h4>
					<ul>
						{{last_news}}
							<li>{{title}}...</li>
							<hr>
						{{/last_news}}
					</ul>
				</div>
				<div class="news-comments">
					<h4>Últimos Comentarios</h4>
					<ul>
						{{last_comments}}
							<li>{{comment}}...</li>
							<hr>
						{{/last_comments}}
					</ul>
				</div>
			</div>
	    
	        <img src="{{ data.image }}" alt="{{tittle}}" class="shadow">
			{{if data.autor}}<h5><b>Autor:</b> <i>{{data.autor}}</i></h5>{{endif}}
			<span>{{ data.date }}</span>
	        <div>{{ data.content }}</div>
	    </div>
	    <div class="clear"></div>
		
		<div class="col-lg-12">
			<div id="comments"  class="panel panel-info mtop20">
				<div class="panel-heading">
					<h4>Comentarios</h4>
				</div>
				<div style="margin-bottom: 20px;" class="res_form">
					<div class="row">
						
						<div class="col-md-10 col-md-offset-1 mtop10">
							{{ news_comments }}
							<div class="comment">
								<h4><span>{{email}}</span> - <span>{{name}}</span></h4>
								<div class="news_comment">
									{{ comment }}
								</div>
								<div class="clear"></div>
								<hr>
							</div>
							{{ /news_comments }}
						</div>
						<div class="col-md-10 col-md-offset-1 ">
							<h4 class="t_comment">Escribir un comentario</h4>
						</div>

						<div id="commentPost" class=" col-md-10 col-md-offset-1">
							<?php echo form_open(site_url('news/insert_comment/'.$data->id.'/'.$data->slug), 'class="crud form_reservations"'); ?>
								<?php if ( ! is_logged_in()): ?>
								
								<div class="row">
									<div class="form-group col-md-6">
										<!-- <label for="name">Nombre<span class="required">*</span>:</label> -->
										<?php echo form_input('name', set_value('name'), 'class="form-control " placeholder="Nombre *" maxlength="100"'); ?>
										<!--<input type="text" name="name" id="name"  placeholder="Nombre *" value="">-->
									</div>
									<div class="form-group col-md-6">
										<!-- <label for="email">E-mail<span class="required">*</span>:</label> -->
										<?php echo form_input('email', set_value('email'), 'class="form-control " placeholder="Correo Electrónico *" maxlength="100"'); ?>
										<!--<input type="text" name="email" maxlength="40" placeholder="E-mail *" value="">-->
									</div>
								</div>
								<?php endif ?>
								
								
								<div class="form-group">
									<!-- <label for="comment">Mensaje<span class="required">*</span>: </label><br> -->
									<?php echo form_textarea('comment', set_value('comment'),'class="form-control" rows="5" cols="30" placeholder="Mensaje *"'); ?>
									<!--<textarea name="comment" id="comment" rows="5" placeholder="Mensaje *" cols="30" class="width-full"></textarea>-->
								</div>

								<div class="form_submit">
									<input type="submit" name="btnAction" value="Comentar" class="btn btn-primary">
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>