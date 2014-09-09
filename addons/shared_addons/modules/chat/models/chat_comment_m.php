<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author  Brayan Acebo
 */
class Chat_Comment_m extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = $this->db->dbprefix . 'chat_comments';
    }




    // crea un comentario
    // $type: 1=admin; 2=user
	public function newComment($chat_id, $type, $comment){
		
		// crea el chat
		$insert = array(
			'chat_id' => $chat_id,
			'type' => $type,
			'comment' => $comment,
			'created_at' => date('Y-m-d H:i:s')
		);
		// crea el comentario de un chat
		if($this->insert($insert)){
			return true;
		}else{
			return false;
		}
	}


}