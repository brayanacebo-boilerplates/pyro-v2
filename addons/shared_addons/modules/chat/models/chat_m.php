<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author  Brayan Acebo
 */
class Chat_m extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = $this->db->dbprefix . 'chat';
    }


    // crea y consulta la informacion de un chat
	public function getChat($session_id){
		
		// consulta el chat por session_id
		$chat = $this->get_by('session_id',$session_id);

		// valida que exista el chat, sino, lo crea
		if(!$chat){
			// crea el chat
			$insert = array(
				'session_id' => $session_id,
				'created_at' => date('Y-m-d H:i:s')
				);
			// si crea el chat, lo consulta y devuelve su informacion
			if($this->insert($insert)){
				$chat = $this->get_by('session_id',$session_id);
			}else{
				$chat = false;
			}
		}
		return $chat;
	}


	public function listComments($session_id, $type){
		$sql = '
			SELECT
				DCH.id chat_id,
				DCH.session_id,
				DCC.id comment_id,
				DCC.comment,
				DCC.created_at
			FROM
				default_chat DCH
				INNER JOIN default_chat_comments DCC
					ON (DCH.id = DCC.chat_id)
			WHERE
				DCC.type = '.$type.'
				AND DCC.show = 0
				AND DCH.session_id = "'.$session_id.'"
			ORDER BY DCC.created_at ASC
		';
		$comments = $this->query($sql)->result();

		if(count($comments)){
			$listId = array();
			foreach($comments as $row):
				$listId[] = $row->comment_id;
			endforeach;

			// se colocan los comentarios como vistos para no volver a tenerlos en cuenta
			$sql2 = '
				UPDATE
					default_chat_comments DCC
				SET
					DCC.show = 1
				WHERE
					DCC.id IN ('.implode(',',$listId).')
			';
			$this->query($sql2);

			return $comments;
		}else{
			return false;
		}

	}


	public function listCommentsInit($session_id){
		$sql = '
			SELECT
				DCH.id chat_id,
				DCH.session_id,
				DCC.id comment_id,
				DCC.comment,
				DCC.type,
				DCC.created_at
			FROM
				default_chat DCH
				INNER JOIN default_chat_comments DCC
					ON (DCH.id = DCC.chat_id)
			WHERE
				DCH.session_id = "'.$session_id.'"
			ORDER BY DCC.created_at ASC
		';
		$comments = $this->query($sql)->result();

		if(count($comments)){
			$listId = array();
			foreach($comments as $row):
				if($row->type == 2) // solo si es del cliente
					$listId[] = $row->comment_id;
			endforeach;

			// se colocan los comentarios como vistos para no volver a tenerlos en cuenta
			$sql2 = '
				UPDATE
					default_chat_comments DCC
				SET
					DCC.show = 1
				WHERE
					DCC.id IN ('.implode(',',$listId).')
			';
			$this->query($sql2);

			return $comments;
		}else{
			return false;
		}

	}



	public function listChatsActives($type=2){
		$sql = '
			SELECT
				distinct(DCH.id) chat_id,
				DCH.session_id
			FROM
				default_chat DCH
				INNER JOIN default_chat_comments DCC
					ON (DCH.id = DCC.chat_id)
			WHERE
				DCC.type = '.$type.'
				AND DCC.show = 0
			ORDER BY DCC.created_at ASC
		';
		$comments = $this->query($sql)->result();
		return $comments;

	}



	public function listNewChats($type=2, $current=null){

		$condition = '';
		if(!$current) $condition = '';
		else{
			$condition = '
				AND DCH.session_id NOT IN ("'.implode('","', $current ).'")
			';
		}

		$sql = '
			SELECT
				distinct(DCH.id) chat_id,
				DCH.session_id
			FROM
				default_chat DCH
				INNER JOIN default_chat_comments DCC
					ON (DCH.id = DCC.chat_id)
			WHERE
				DCC.type = '.$type.'
				AND DCC.show = 0
				'.$condition.'
			ORDER BY DCC.created_at ASC
		';
		$comments = $this->query($sql)->result();
		return $comments;

	}



}

