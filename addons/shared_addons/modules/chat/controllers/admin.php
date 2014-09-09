<?php
class Admin extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$models = array('chat_m','chat_comment_m');
		$this->load->model($models);
		$this->template
			->append_css('module::admin.css')
			->append_js('module::admin.js');
	}

	public function index() {

		// busca chats con mensajes sin ver por el admin
		$chats = $this->chat_m->listChatsActives(2);

		// crear ventanas de chat para cada conversacion
		$windows = '';
		foreach ($chats as $chat) {
			$windows .= $this->chatWindows($chat->session_id);
		}


		$this->template
			// ->set('session_id',$this->session->userdata('session_id'))
			->set('chats',$chats)
			->set('windows',$windows)
			->build('admin/index');
	}



	private function chatWindows($session_id){
		$comments = $this->chatComments($session_id);
		$HTML = '
			<div class="admin-window '.$session_id.'">
				<input type="hidden" class="session_id" value="'.$session_id.'">
				<div class="title">Chat.:::.'.$session_id.'</div>
				<div class="content-comments">
					'.$comments.'
				</div>
				<div class="inputs-chat">
					<input type="text" class="input-comment" placeholder="Escribir mensaje..." maxlength="490">
					<input type="button" class="btn-send" value="Enviar">
				</div>
			</div>
		';
		return $HTML;
	}

	private function chatComments($session_id){
		$comments = $this->chat_m->listCommentsInit($session_id);
		if(!$comments) return '';

		$HTML = '';
		foreach($comments as $comment):
			if($comment->type == 1):
				$HTML .= '
						<div class="comment comment-1">
							<span class="content">'.$comment->comment.'</span>
						</div>
					';
			elseif($comment->type == 2):
				$HTML .= '
					<div class="comment comment-2">
						<span class="content">'.$comment->comment.'</span>
					</div>
				';
			endif;
		endforeach;
		
		return $HTML;
	}



	public function storeComment(){
		// obtener datos post
		$post = (object) $this->input->post();
		$session_id = $post->session_id;
		$comment = $post->comment;

		// crear o consultar chat
		$chat = $this->chat_m->getChat($session_id);
		// crear comentario
		$newComment = $this->chat_comment_m->newComment($chat->id, 1, $comment);
		// devolver una respuesta
		echo json_encode(array('chat'=>$chat));
	}


	public function getNewWindows() {

		$post = (object) $this->input->post();
		$current = null;
		if(isset($post->chats)){
			$current = $post->chats;
		}
		// print_r($post->chats);

		// busca chats con mensajes sin ver por el admin
		$chats = $this->chat_m->listNewChats(2,$current);
		if(!$chats){
			echo json_encode(array('BOOL'=>false));
			exit;
		}

		$html_chats = '';
		foreach($chats as $chat):
			$html_chats .= '
				<div class="client" id="'.$chat->chat_id.'" data-sessionid="'.$chat->session_id.'">'.substr($chat->session_id,0,20).'</div>
			';
		endforeach;
		

		// crear ventanas de chat para cada conversacion
		$windows = '';
		foreach ($chats as $chat) {
			$windows .= $this->chatWindows($chat->session_id);
		}

		$response = array(
			'BOOL' => true,
			'CHATS' => $html_chats,
			'WINDOWS' => $windows,
		);
		echo json_encode($response);
		exit;

	}


	public function getUserComments(){

		$post = (object) $this->input->post();

		if(!isset($post->chats)){
			echo json_encode(array('HTML'=>''));
			exit;
		}

		$chats = $post->chats;

		// se consultan los comentarios de cada chat
		$list_comments = array();
		foreach($chats as $session){
			$list_comments[] = $this->chat_m->listComments($session,2);
		}

		// se inicia un array donde se devolvera la respuesta
		$response = array();
		foreach($chats as $session){
			$response[$session] = '';
		}

		// se arma el html de respuesta
		if(count($list_comments))
			foreach($list_comments as $lvl1){
				if(is_array($lvl1))
					foreach ($lvl1 as $data) {
						$response[$data->session_id] .= '
							<div class="comment comment-2">
								<span class="content">'.$data->comment.'</span>
							</div>
						';
					}
			}
		echo json_encode(array('HTML'=>$response));

	}


}