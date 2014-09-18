<div class="row">
	<div class="col-sx-12 col-sm-6 col-md-6 col-lg-6">
		<div class="social">
			<h3>Síguenos</h3>
			{{ if data:facebook }}
			<div><a target="_blank" href="{{data:facebook}}"><i class="fa fa-facebook-square"></i> Facebook</a></div>
			{{ endif }}
			{{ if data:twitter }}
			<div><a target="_blank" href="{{data:twitter}}"><i class="fa fa-twitter-square"></i> Twitter</a></div>
			{{ endif }}
			{{ if data:linkedin }}
			<div><a target="_blank" href="{{data:linkedin}}"><i class="fa fa-linkedin-square"></i> Linkedin</a></div>
			{{ endif }}
		</div>
	</div>
	<div class="col-sx-12 col-sm-6 col-md-6 col-lg-6 info-cont">
		
		<h3><b>Info</b> de Contacto</h3>

		{{ if data:adress }}<div><i class="fa fa-map-marker"></i>{{data:adress}}</div>{{ endif }}
		{{ if data:email }}<div><i class="fa fa-paper-plane-o"></i><a href="mailto:{{ data:email }}" style="color:#FFF; text-decoration:underline;">{{ data:email }}</a></div>{{ endif }}
		{{ if data:phone }}<div><i class="fa fa-mobile"></i>{{ data:phone }}</div>{{ endif }}
	</div>
</div>