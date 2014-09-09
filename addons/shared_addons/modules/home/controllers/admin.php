<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	Luis Fernando Salazar
 * @author 	Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	Home Module
 * @category 	Modulos
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		// cargamos el lenguaje
		$this->lang->load('home');
		// añadimos atributos al template
		$this->template->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
	}

	public function index() 
	{
        // consultamos los datos del Banner
        $banner = $this->db->get('home_banner')->result();

        // consultamos los datos de Noticias Destacadas
        $outstanding_news = $this->db->where('type', '1')->get('home_outstanding')->result();

		// consultamos los datos de Servicios Destacadas
        $outstanding_services = $this->db->where('type', '2')->get('home_outstanding')->result();
		
		// Consultamos los datos del slider de Clientes
        $customers = $this->db->get('home_customers')->result();
		
		//Consultamos los datos del texto informativo
		$text_info = $this->db->limit(1)->get('home_text_info')->result();
		
		// agregamos los atributos al template
		$this->template
			->set('banner', $banner)
			->set('outstanding_news', $outstanding_news)
			->set('outstanding_services', $outstanding_services)
			->set('customers', $customers)
			->set('text_info', $text_info[0])
			->build('admin/home_back');
	}

    /*
     * Destacados
     */

	// editamos o creamos una noticia o servicio destacada
    public function edit_outstanding($typeItem = null, $idItem = null)
    {
    	// determinamos cual es el tag
    	$endurl = ($typeItem == 1) ? "#page-outstanding" : "#page-services";
		// Reglas de validación
    	$this->form_validation->set_rules('title', 'Título', 'required|max_length[180]|trim');
    	$this->form_validation->set_rules('text', 'Texto', 'required|max_length[300]|trim');
    	$this->form_validation->set_rules('link', 'Link', 'max_length[420]|valid_url');
		
		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				// colocamos el titulo dependiendo del tipo
				$titulo = ($typeItem == '1' ? 'Editar Noticia' : 'Editar Servicio');
				// cargamos los datos
				$outstanding = $this->db->where('id', $idItem)->get('home_outstanding')->row();
				
				// mandamos los datos al template
				$this->template
				->set('outstanding', $outstanding)
				->set('typeItem', $typeItem)
				->set('titulo', $titulo)
				->build('admin/edit_outstanding_back');
			}
			else
			{
				// colocamos el titulo dependiendo del tipo
				$titulo = ($typeItem == '1' ? 'Crear Noticia' : 'Crear Servicio');
				
				// mandamos los datos al template
				$this->template
				->set('typeItem', $typeItem)
				->set('titulo', $titulo)
				->build('admin/edit_outstanding_back');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			$_POST['type'] = $typeItem; // guardamos el tipo de destacado
			unset($_POST['btnAction']); // sacamos del array el valor del submit
			// cargamos los datos del formulario en una variable
			$data = $_POST;
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				// configuración para subir archivos
				$config['upload_path'] = './' . UPLOAD_PATH . '/home_outstanding';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image'))
					{
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_outstanding/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
						$obj = $this->db->where('id', $idItem)->get('home_outstanding')->row();
						@unlink($obj->image);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						return $this->index();
					}
				}
				
				// actualizamos los datos
				if ($this->db->where('id', $idItem)->update('home_outstanding', $data))
				{
					$this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					redirect('admin/home'.$endurl);
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					return $this->editar_destacado();
				}
			}
			else
			{
				// configuración para subir archivos
				$config['upload_path'] = './' . UPLOAD_PATH . '/home_outstanding';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image'))
					{
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_outstanding/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
					}
					else
					{
						$this->session->set_flashdata('error', $this->upload->display_errors());
						return $this->index();
					}
				}
				
				// insertamos los datos
				if ($this->db->insert('home_outstanding', $data)) {
					$this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
					redirect('admin/home'.$endurl);
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					return $this->nuevo_destacado();
				}
			}
		}
	}

    // -----------------------------------------------------------------

	public function delete_outstanding($idItem = null)
	{
		// si el id no es mandado lo redireccionamos
		$idItem or redirect('admin/home#page-outstanding');
		
		// cargamos los datos para borrar la imagen
		$obj = $this->db->where('id', $idItem)->get($this->db->dbprefix.'home_outstanding')->row();
		
		// borramos el registro
		if ($this->db->where('id', $idItem)->delete('home_outstanding'))
		{
			// borramos la imagen
			@unlink($obj->image);
			$this->session->set_flashdata('success', 'El registro se elimino con éxito.');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
		}
		redirect('admin/home#page-outstanding');
	}

    /*
     * Banner
     */

    public function edit_banner($idItem = null)
    {
    	// Reglas de validación
    	$this->form_validation->set_rules('title', 'Título', 'required|max_length[180]|trim');
    	$this->form_validation->set_rules('text', 'Texto', 'required|max_length[300]|trim');
    	$this->form_validation->set_rules('link', 'Link', 'max_length[420]|valid_url');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				// colocamos el titulo
				$titulo = 'Editar Slider';
				// cargamos los datos
				$banner = $this->db->where('id', $idItem)->get('home_banner')->row();
				
				// mandamos los datos al template
				$this->template
				->set('banner', $banner)
				->set('titulo', $titulo)
				->build('admin/edit_banner_back');
			}
			else
			{
				// colocamos el titulo
				$titulo = 'Crear Slider';
				// mandamos los datos al template
				$this->template
				->set('titulo', $titulo)
				->build('admin/edit_banner_back');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			unset($_POST['btnAction']);
			$data = $_POST;
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				$config['upload_path'] = './' . UPLOAD_PATH . '/home_banner';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_banner/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
						$obj = $this->db->where('id', $idItem)->get('home_banner')->row();
						@unlink($obj->image);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/home/');
					}
				}
				if ($this->db->where('id', $idItem)->update('home_banner', $data)) {
					$this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					redirect('admin/home/');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					redirect('admin/home/');
				}
			}
			else
			{
				$config['upload_path'] = './' . UPLOAD_PATH . '/home_banner';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_banner/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/home/');
					}
				}
				if ($this->db->insert('home_banner', $data)) {
					$this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
					redirect('admin/home/');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					return $this->nuevo_destacado();
				}
			}
		}
	}

	public function delete_banner($id = null)
	{
		$id or redirect('admin/home/');

		$obj = $this->db->where('id', $id)->get($this->db->dbprefix.'home_banner')->row();
		if ($this->db->where('id', $id)->delete('home_banner')) {
				@unlink($obj->image);
				$this->session->set_flashdata('success', 'El registro se elimino con éxito.');
			} else {
				$this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
			}

		redirect('admin/home/');

	}
	
	public function edit_text_info()
	{
		$this->form_validation->set_rules('title', 'Titulo', 'required|max_length[50]|trim');
		$this->form_validation->set_rules('text', 'Text', 'required|max_length[400]|trim');
		
		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			redirect('admin/home/#page-text-info');
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			unset($_POST['btnAction']);
            $data = $_POST;
			if ($this->db->update('home_text_info', $data))
            {
                $this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
                redirect('admin/home/#page-text-info');
            }
            else
            {
                $this->session->set_flashdata('success', lang('home:error_message'));
                redirect('admin/home/#page-text-info');
            }
		}
	}
	
	// slider clientes
	public function edit_customers($idItem = null)
    {
        $this->form_validation->set_rules('name', 'Nombre', 'required|max_length[100]|trim');
		$this->form_validation->set_rules('link', 'Link', 'required|valid_url');
		
		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				// colocamos el titulo
				$titulo = 'Editar Slider Cliente';
				// cargamos los datos
				$dataForm = $this->db->where('id', $idItem)->get('home_customers')->row();
				// mandamos los datos al template
		        $this->template
		                ->set('dataForm', $dataForm)
						->set('titulo', $titulo)
		                ->build('admin/edit_customers_back');
			}
			else 
			{
				// colocamos el titulo
				$titulo = 'Crear Slider Cliente';
				// mandamos los datos al template
			 	$this->template
					 	->set('titulo', $titulo)
					 	->build('admin/edit_customers_back');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			$action = $_POST['btnAction'];
			unset($_POST['btnAction']);
			$data = $_POST;
			if($idItem != null)  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
	            $config['upload_path'] = './' . UPLOAD_PATH . '/home_customers';
	            $config['allowed_types'] = 'gif|jpg|png|jpeg';
	            $config['max_size'] = 2050;
	            $config['encrypt_name'] = true;
	
	            $this->load->library('upload', $config);
	
	            // imagen uno
	            $img = $_FILES['image']['name'];
	
	            if (!empty($img)) {
	                if ($this->upload->do_upload('image')) {
	                    $datos = array('upload_data' => $this->upload->data());
	                    $path = UPLOAD_PATH . 'home_customers/' . $datos['upload_data']['file_name'];
	                    $img = array('image' => $path);
	                    $data = array_merge($data, $img);
	                    $obj = $this->db->where('id', $idItem)->get('home_customers')->row();
	                    @unlink($obj->imagen);
	                } else {
	                    $this->session->set_flashdata('error', $this->upload->display_errors());
	                    header('Location: '.$_SERVER['REQUEST_URI']);
	                }
	            }
	
	            if ($this->db->where('id', $idItem)->update('home_customers', $data)) {
	                $this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					if($action == 'save')
					{
						header('Location: '.$_SERVER['REQUEST_URI']);
					}
					else
					{
						redirect('admin/home/#page-banner-customers');
					}
	            } else {
	                $this->session->set_flashdata('success', lang('home:error_message'));
	                header('Location: '.$_SERVER['REQUEST_URI']);
	            }
			}
			else
			{
	            $config['upload_path'] = './' . UPLOAD_PATH . '/home_customers';
	            $config['allowed_types'] = 'gif|jpg|png|jpeg';
	            $config['max_size'] = 2050;
	            $config['encrypt_name'] = true;
	
	            $this->load->library('upload', $config);
	
	            // imagen uno
	            $img = $_FILES['image']['name'];
	
	            if (!empty($img)) {
	                if ($this->upload->do_upload('image')) {
	                    $datos = array('upload_data' => $this->upload->data());
	                    $path = UPLOAD_PATH . 'home_customers/' . $datos['upload_data']['file_name'];
	                    $img = array('image' => $path);
	                    $data = array_merge($data, $img);
	                } else {
	                    $this->session->set_flashdata('error', $this->upload->display_errors());
	                    header('Location: '.$_SERVER['REQUEST_URI']);
	                }
	            }
				
				if ($this->db->insert('home_customers', $data)) {
	                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
					redirect('admin/home/#page-banner-customers');
	            }
	            else
	            {
	                $this->session->set_flashdata('error', lang('home:error_message'));
	                header('Location: '.$_SERVER['REQUEST_URI']);
	            }
			}
		}
    }

    public function delete_customers($id = null) {

        $id or redirect('admin/home/#page-banner-customers');

        $obj = $this->db->where('id', $id)->get($this->db->dbprefix.'home_customers')->row();
		if ($this->db->where('id', $id)->delete('home_customers')) {
            @unlink($obj->image);
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/home/#page-banner-customers');
    }
}
