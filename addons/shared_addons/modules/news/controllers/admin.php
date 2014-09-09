<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author 	Luis Fernando Salazar Buitrago
 * @author 	Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	news
 * @category 	Modules
 * @license 	Apache License v2.0
 */

class Admin extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('news');
		$this->template
		->append_js('module::developer.js')
		->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
		$this->load->model(array('news_m', 'news_comments_m'));
	}

	public function index()
	{
		// news
		$pagination = create_pagination('admin/news/index', $this->news_m->count_all(), 10);

		$news = $this->news_m
		->limit($pagination['limit'], $pagination['offset'])
		->order_by('position','ASC')
		->get_all();

		$pag = $pagination['offset'];
		
		$comments = $this->db->select('cm.*, nw.title')
					->from('news_comments AS cm')
					->join('news AS nw', 'nw.id = cm.id_new', 'left')
					->order_by('cm.id', 'DESC')->get()->result();
		
		$this->template
		->append_js('module::admin/ajax.js')
		->set('news', $news)
		->set('comments', $comments)
		->set('pagination', $pagination)
		->set('pag', $pag)
		->build('admin/new_back');
	}

	public function edit_new($idItem = null)
	{
		$this->form_validation->set_rules('title', 'Título', 'required|max_length[255]|trim');
		$this->form_validation->set_rules('autor', 'Autor', 'max_length[50]|trim');
		$this->form_validation->set_rules('content', 'Contenido', 'required|trim');
		$this->form_validation->set_rules('introduction', 'Introducción', 'required|max_length[600]|trim');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				$idItem or redirect('admin/news');

				$titulo = 'Editar Noticia';
				$datosForm = $this->news_m->get($idItem);

				$positionnews = $this->news_m
				->order_by('position', 'ASC')
				->get_all();
				
				$comments = $this->news_comments_m
					->where('id_new', $datosForm->id)
			        ->order_by('id','DESC')
			        ->get_all();
				
				$this->template
				->set('datosForm', $datosForm)
				->set('positionnews', $positionnews)
				->set('comments', $comments)
				->set('titulo', $titulo)
				->set('ban', true)
				->build('admin/edit_new_back');
			}
			else
			{
				$titulo = 'Crear noticia';

				$this->template
				->set('titulo', $titulo)
				->set('ban', false)
				->build('admin/edit_new_back');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			if($idItem != null)  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{

				$post = (object) $this->input->post();
				$news = $this->news_m->get($post->position_new);

				$data = array(
					'title' => $post->title,
					'slug' => slug($post->title), // Creación de slug's para url's limpias
					'autor' => $post->autor,
					'introduction' => $post->introduction,
					'content' => html_entity_decode($post->content),
					'position' => $news->position,
					);

				$config['upload_path'] = './' . UPLOAD_PATH . '/news';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'news/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
						$obj = $this->db->where('id', $idItem)->get('news')->row();
						@unlink($obj->image);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/news/');
					}
				}

				if ($this->news_m->update($idItem, $data)) {
					// Se actualiza el Orden
					$position = array('position' => $post->position_current);
					$this->news_m->update($news->id, $position);

					$this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					redirect('admin/news/');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					redirect('admin/news/');
				}
			}
			else
			{
				$post = (object) $this->input->post();

				$this->db->select_max('position');
				$query = $this->db->get('news');
				$position = $query->row();

				$data = array(
					'title' => $post->title,
					'slug' => slug($post->title), // Creación de slug's para url's limpias
					'autor' => $post->autor,
					'introduction' => $post->introduction,
					'content' => html_entity_decode($post->content),
					'date' => date("Y-m-d H:i:s"),
					'position' => $position->position + 1
					);

				$config['upload_path'] = './' . UPLOAD_PATH . '/news';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'news/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/news/');
					}
				}

				if ($this->news_m->insert($data)) {
					$this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
				}
				redirect('admin/news');
			}
		}

	}

	public function delete_new($id = null) {

		$id or redirect('admin/news');

		$obj = $this->db->where('id', $id)->get($this->db->dbprefix.'news')->row();

		if ($this->news_m->delete($id)) {
			@unlink($obj->image);
			$this->session->set_flashdata('success', 'El registro se elimino con éxito.');
		} else {
			$this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
		}
		redirect('admin/news');
	}
	
	public function delete_comment($id = null) {

		$id or redirect('admin/news');

		if ($this->news_comments_m->delete($id)) {
			$this->session->set_flashdata('success', 'El registro se elimino con éxito.');
		} else {
			$this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
		}
		redirect('admin/news');
	}
	
	public function outstanding_news($idItem = null)
	{
		$amount = $this->news_m->where('outstanding', 1)->get_all();
		$amount = count($amount);
		$obj = $this->db->where('id', $idItem)->get('news')->row();
	    $data['outstanding'] = ($obj->outstanding == 1 ? 0 : 1);
		
		if($amount < 3 || $data['outstanding'] == 0)
		{
			
	        if ($this->news_m->update($idItem, $data))
			{
	            $statusJson = '';
				$msgJson = 'El producto ahora es destacado.';
	        }
	        else
	        {
	            $statusJson = 'error';
				$msgJson = 'Ocurrio un error al cambiar el estado a destacado';
	        }
		}
		else {
			$statusJson = 'error';
			$msgJson = 'Ya llegaste al numero limite de destacados';
		}
		echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
		
	}
	
	public function edit_comment($idItem = null)
	{
		$this->form_validation->set_rules('email', 'Correo', 'required|max_length[100]|trim');
		$this->form_validation->set_rules('name', 'Nombre', 'required|max_length[100]|trim');
		$this->form_validation->set_rules('comment', 'Comentario', 'required|trim');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				$idItem or redirect('admin/news');

				$titulo = 'Editar Comenatario';
				$datosForm = $this->news_comments_m->get($idItem);

				$this->template
				->set('datosForm', $datosForm)
				->set('titulo', $titulo)
				->build('admin/edit_comment');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			if($idItem != null)  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{

				$post = (object) $this->input->post();

				$data = array(
					'email' => $post->email,
					'name' => $post->name,
					'comment' => $post->comment,
					);


				if ($this->news_comments_m->update($idItem, $data)) {
					$this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					redirect('admin/news/');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					redirect('admin/news/');
				}
			}
		}

	}
}
