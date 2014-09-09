<?php
class Chat extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$models = array('chat_m','chat_comment_m');
		$this->load->model($models);
		/*$this->template
			->append_css('module::client.css')
            ->append_js('module::client.js');*/
	}

	public function index() {
		$this->template
			->set('session_id','chat'.$this->session->userdata('session_id'))
			->build('index');
	}


	public function storeComment(){
		// obtener datos post
		$post = (object) $this->input->post();
		$session_id = $post->session_id;
		$comment = $post->comment;

		// crear o consultar chat
		$chat = $this->chat_m->getChat($session_id);
		// crear comentario
		$newComment = $this->chat_comment_m->newComment($chat->id, 2, $comment);
		// devolver una respuesta
		echo json_encode(array('chat'=>$chat));
	}


	public function getComments(){

		$post = (object) $this->input->post();
		$session_id = $post->session_id;

		$comments = $this->chat_m->listComments($session_id,1);

		$html = '';
		if($comments !== false){
			foreach($comments as $row){
				$html .= '
					<div class="comment comment-admin">
						<span class="content">'.$row->comment.'</span>
					</div>
				';
			}
		}

		echo json_encode(array('HTML'=>$html));

	}



}