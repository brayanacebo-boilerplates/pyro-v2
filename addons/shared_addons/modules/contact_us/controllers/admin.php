<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Luis Fernando Salazar
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('language');
        $this->load->library('form_validation');
        $this->template
             ->append_js('module::developer.js')
             ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $this->load->model(array('contact_us_m', 'contact_us_emails_m'));
    }

    /**
     * List all domains
     */

    public function index()
    {
    	$this->form_validation->set_rules('facebook', 'facebook', 'max_length[455]|valid_url');
		$this->form_validation->set_rules('twitter', 'twitter', 'max_length[455]|valid_url');
		$this->form_validation->set_rules('linkedin', 'linkedin', 'max_length[455]|valid_url');
    	$this->form_validation->set_rules('adress', 'Dirección', 'max_length[200]|trim');
    	$this->form_validation->set_rules('phone', 'Telefono', 'max_length[100]|trim');
    	$this->form_validation->set_rules('email', 'Correo', 'max_length[100]|trim');
		$this->form_validation->set_rules('text', 'Horario', 'trim');
		$this->form_validation->set_rules('map', 'Mapa de google', 'trim');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			$contact_us = $this->contact_us_m->get_all();
			$contact_us = $contact_us[0];
			
			$pagination = create_pagination('admin/contact_us/index/', $this->contact_us_emails_m->count_all(), 10);
			$contact_us_emails = $this->contact_us_emails_m->limit($pagination['limit'], $pagination['offset'])->get_all();
			
	        $this->template
	                ->set('data', $contact_us)
					->set('data2', $contact_us_emails)
					->set('pagination', $pagination)
	                ->build('admin/contact_us_back');
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			// quitamos los campos del text_wysiwyg
			if(isset($_POST['text_wysiwyg']))
			{
				unset($_POST['text_wysiwyg']);
			}
			if(isset($_POST['text_wysiwyg_map']))
			{
				unset($_POST['text_wysiwyg_map']);
			}
			// quitamos el valor del boton
			unset($_POST['btnAction']);
			// organizamos los campos que sean necesarios
			if(isset($_POST['text']))
			{
				$_POST['schedule'] = html_entity_decode($_POST['text']);
				unset($_POST['text']);
			}
			if(isset($_POST['map']))
			{
				$_POST['map'] = html_entity_decode($_POST['map']);
			}
			$data = $_POST;
			
	        if ($this->contact_us_m->update_all($data)) {
	
	            // insert ok, so
	            $this->session->set_flashdata('success', lang('contact_us:success_message'));
	            redirect('admin/contact_us/#page-view');
	        } else {
	            $this->session->set_flashdata('error', lang('contact_us:error_message'));
	            redirect('admin/contact_us/#page-details');
	        }
	
	        $this->template->set('funcion', 'edit')
	                ->build('admin/contact_us_back');
		}
    }

}