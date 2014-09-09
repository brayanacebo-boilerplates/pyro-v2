<div class="client-window">
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
	<input type="hidden" id="session_id" value="<?php echo $session_id; ?>">
	<div class="title">Chat</div>
	<div class="content-comments"></div>
	<div class="inputs-chat">
		<input type="text" id="input-comment" placeholder="Escribir mensaje..." maxlength="490">
		<input type="button" id="btn-send" value="Enviar">
	</div>
</div>