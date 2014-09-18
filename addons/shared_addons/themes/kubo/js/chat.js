var u_name = 'Usuario';
var ajax_interval = 1; // segundos en que va al server y busca nuevos comentarios

$(document).on('ready',function(){
	setInterval(showCommentsAdmin, ajax_interval*1000);
});


$(document).on('click','#btn-send',sendComment);
$(document).on('keyup','#input-comment',function(event){
	var key = event.keyCode;
	if(key != 13) {
		return false;
	}
	sendComment();
});





function sendComment(){
	// validar texto
	var comment = $('#input-comment').val();
	if(!comment) return false;

	var base_url = $('#base_url').val();
	var session_id = $('#session_id').val();

	var url = base_url+'chat/storeComment';
	var datos = {
		comment: comment,
		session_id: session_id
	};

	// alert(datos.session_id);

	$.ajax({
		url:url,
		type:'POST',
		dataType:'json',
		data:datos,
		success:function(response){
			//
		}
	});

	$('#input-comment').val('');
	// mostrar mensaje
	showComment(comment);

}

function showComment(comment){
	var HTML = '\
		<div class="comment comment-user"> \
			<span class="content">'+comment+'</span> \
		</div>';
	//console.log(HTML);
	$('.content-comments').append(HTML);
	$('.content-comments').animate({ scrollTop: $('.content-comments')[0].scrollHeight }, 1000);
}



function showCommentsAdmin(){

	var base_url = $('#base_url').val();
	var session_id = $('#session_id').val();

	var url = base_url+'chat/getComments';
	var datos = {
		session_id: session_id
	};

	$.ajax({
		url:url,
		type:'POST',
		dataType:'json',
		data:datos,
		success:function(response){
			$('.content-comments').append(response.HTML);
			$('.content-comments').animate({ scrollTop: $('.content-comments')[0].scrollHeight }, 1000);
		}
	});
}