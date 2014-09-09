<div class="container-chat">
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
	<h2>Chat</h2>
	<div class="chat-layout">
		<div class="chat-list-content">
			<div class="title-left"><strong>Conversaciones activas</strong></div>
			<?php foreach($chats as $chat): ?>
			<div class="client" id="<?php echo $chat->chat_id; ?>" data-sessionid="<?php echo $chat->session_id; ?>"><?php echo substr($chat->session_id,0,20); ?></div>
			<?php endforeach; ?>
		</div>
		<div class="chat-messages-content">
			<?php echo $windows; ?>
		</div>
	</div>
</div>