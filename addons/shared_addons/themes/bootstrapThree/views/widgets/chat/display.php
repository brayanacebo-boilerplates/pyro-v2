<div class="chat_close chat" id="chat">

	<input type="hidden" id="base_url" value="{{url:base}}">
	<input type="hidden" id="session_id" value="{{ session_id }}">	
	<div class="content-comments">
		<div class="tittle-chat">
			<h3 class="bkg-alpha"><div  class="btn-cerrar"onclick="cerrar_chat()">x</div>Chat</h3>
			<div>Déjanos un mensaje, en breve te contestaremos.</div>
		</div>
	</div>
	<div class="inputs-chat">
		<input type="text" class="form-control" id="input-comment" placeholder="Escribir mensaje..." maxlength="490">
		<!-- <input type="button" id="btn-send" class="btn btn-alpha" value="Enviar"> -->
		<button type="button" id="btn-send" class="btn btn-primary" value="Enviar"><div><i class="fa fa-envelope-o"></i></div></button>
	</div>
</div>
<div class="btn-chat" onClick="abrir_chat()"><i class="fa fa-comments-o"></i><span>¿Tienes alguna pregunta?</span></div>