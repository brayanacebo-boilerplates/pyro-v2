<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @subpackage 	Sobre Nosotros Module
 * @category 	Modulos
 * @license 	Apache License v2.2
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('about');
        $models = array(
            'about_model'
            );
        $this->load->model($models);
    }

    // ------------------------------------------------------------------------------------------

    public function index()
    {
		$this->form_validation->set_rules('title', 'Título', 'required|max_length[455]|trim');
        $this->form_validation->set_rules('video', 'Video', 'trim');
        $this->form_validation->set_rules('text', 'Texto', 'required|trim');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}

			$data = $this->about_model->limit(1)->get_all();

        	$this->template->set('data', $data[0])
                	->build('admin/index');
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			$post = (object) $this->input->post();

            $data = array(
                'title' => $post->title,
                'video' => $post->video,
                'text' => html_entity_decode($post->text)
            );

           	$config['upload_path'] = './' . UPLOAD_PATH . '/about';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['max_width'] = 1000;
            $config['max_height'] = 700;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'about/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->where('id', $post->id)->get('about')->row();
                    @unlink($obj->image);
                }
                else
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/about');
                }
            }

            if ($this->about_model->update_all($data))
            {
                // insert ok, so
                $this->session->set_flashdata('success', lang('about:success_message'));
                redirect('admin/about');
            } else {
                $this->session->set_flashdata('error', lang('about:error_message'));
                redirect('admin/about');
            }
		}
    }

}
