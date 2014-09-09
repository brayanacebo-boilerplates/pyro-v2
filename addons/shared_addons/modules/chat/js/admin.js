var ajax_interval = 10; // segundos en que va al server y busca nuevos comentarios

$(document).on('ready',function(){
	// buscar comentarios nuevos
	setInterval(showCommentsUsers, ajax_interval*1000);
	// buscar chats nuevos
	setInterval(showChatsUsers, ajax_interval*1000);
});

function showChatsUsers(){

	var base_url = $('#base_url').val();

	var url = base_url+'admin/chat/getNewWindows';
	
	var mischats = [];
	$(".chat-list-content .client").each(function() { mischats.push($(this).data('sessionid')) });
	var datos = {chats:mischats};

	$.ajax({
		url:url,
		type:'POST',
		dataType:'json',
		data: datos,
		success:function(response){
			console.log(response);
			if(response.BOOL){
				$('.chat-list-content').append(response.CHATS);
				$('.chat-messages-content').append(response.WINDOWS);
				$('.content-comments').animate({ scrollTop: $('.content-comments')[0].scrollHeight }, 1000);
			}
		}
	});
}

function showCommentsUsers(){

	var base_url = $('#base_url').val();

	var url = base_url+'admin/chat/getUserComments';
	
	var mischats = [];
	$(".chat-list-content .client").each(function() { mischats.push($(this).data('sessionid')) });
	var datos = {chats:mischats};

	$.ajax({
		url:url,
		type:'POST',
		dataType:'json',
		data: datos,
		success:function(response){
			for(i=0; i<mischats.length;i++){
				if(eval('response.HTML.'+mischats[i]) != ''){
					$('.'+mischats[i]+' .content-comments').append(eval('response.HTML.'+mischats[i]));
					$('.'+mischats[i]+' .content-comments').animate({ scrollTop: $('.'+mischats[i]+' .content-comments')[0].scrollHeight }, 1000);
				}
			}
		}
	});
}





// seleccionar una ventana
$(document).on('click','.client',function(){
	var session_id = $(this).data('sessionid');
	$('.admin-window').css('display','none');
	$('.'+session_id).css('display','block');
	$('.client').removeClass('item-active');
	$(this).addClass('item-active');
});





$(document).on('click','.btn-send',function(){
	sendComment($(this));
});
$(document).on('keyup','.input-comment',function(event){
	var key = event.keyCode;
	if(key != 13) {
		return false;
	}
	//alert($(this).val());
	sendComment($(this));
});





function sendComment(obj){

	// validar texto
	var comment = obj.parents('.admin-window').find('.input-comment').val();
	if(!comment) return false;

	var base_url = $('#base_url').val();
	var session_id = obj.parents('.admin-window').find('.session_id').val();

	// alert(session_id);
	// alert(comment);
	// return;

	var url = base_url+'admin/chat/storeComment';
	var datos = {
		comment: comment,
		session_id: session_id
	};

	$.ajax({
		url:url,
		type:'POST',
		dataType:'json',
		data:datos,
		success:function(response){
			//
		}
	});

	obj.parents('.admin-window').find('.input-comment').val('');
	// mostrar mensaje
	showComment(obj, comment);

}

function showComment(obj, comment){
	var HTML = '\
		<div class="comment comment-1"> \
			<span class="content">'+comment+'</span> \
		</div>';
	//console.log(HTML);
	obj.parents('.admin-window').find('.content-comments').append(HTML);
	obj.parents('.admin-window').find('.content-comments').animate({ scrollTop: obj.parents('.admin-window').find('.content-comments')[0].scrollHeight }, 1000);
}
