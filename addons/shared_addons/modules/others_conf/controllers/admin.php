<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	Luis Fernando Salazar
 * @package 	PyroCMS
 * @subpackage 	others_conf Module
 * @category 	Modulos
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        //$this->lang->load('others_conf');
        $this->template->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $this->load->model(array('others_conf_m'));
    }

    // -----------------------------------------------------------------

    public function index()
    {		
		// otras configuraciones
		$config_pag = $this->others_conf_m->get_all();
		
        $this->template
				->set('config_pag', $config_pag[0])
                ->build('admin/index');
    }
	
	public function edit()
	{
		$this->form_validation->set_rules('city', 'ciudad', 'trim');
		
		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			redirect('admin/others_conf/');
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			unset($_POST['btnAction']);
            $data = $_POST;

            $config['upload_path'] = './' . UPLOAD_PATH . '/others_conf';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['logo']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('logo')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'others_conf/' . $datos['upload_data']['file_name'];
                    $img = array('logo' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->get('others_conf')->row();
                    @unlink($obj->logo);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/others_conf/');
                }
            }

            if ($this->others_conf_m->update_all($data))
            {
                $this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
                redirect('admin/others_conf/');
            }
            else
            {
                $this->session->set_flashdata('success', lang('others_conf:error_message'));
                redirect('admin/others_conf/');
            }
		}
	}
}
