<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Christian España
 */
class work_with_us extends Public_Controller {

    public function __construct() {
        parent::__construct();
         $models = array('work_with_us_m', 'work_with_us_emails_m');
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index()
    {
        // Datos de Contacto
        $_work_with_us = $this->work_with_us_m->get_all();
        $work_with_us = array();
        if (count($_work_with_us) > 0)
		{
            $work_with_us = $_work_with_us[0];
        }

        $this->template
                ->set('work_with_us', $work_with_us)
                ->build('work_with_us_front');
    }

    /*
     *Enviar correo
     */
    function send()
    {
        $_work_with_us = $this->work_with_us_m->get_all();
        $work_with_us = array();
        if (count($_work_with_us) > 0)
		{
            $work_with_us = $_work_with_us[0];
        }
       $post = (object) $this->input->post(null);

        $this->form_validation->set_rules('name', 'Nombre y Apellido', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'Correo', 'required|trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim|max_length[30]');
        
        $this->form_validation->set_rules('cell', 'Celular', 'trim|max_length[30]');
        $this->form_validation->set_rules('company', 'Empresa/Organización', 'trim|max_length[100]');
        $this->form_validation->set_rules('message', 'Mensaje', 'required|trim|max_length[455]');

        if ($this->form_validation->run() === TRUE) {

            $config = array(
                'mailtype' => 'html',
                'wordwrap' => TRUE,
                'protocol' => 'sendmail',
                'charset' => 'utf-8',
                'crlf' => '\r\n',
                'newline' => '\r\n'
            );

            $data = array(
                'name' => $post->name,
                'email' => $post->email,
                'phone' => $post->phone,
                'cell' => $post->cell,
                'company' => $post->company,
                'message' => $post->message,
            );
			
			// Se carga la imagen
	        $config['upload_path'] = './' . UPLOAD_PATH . '/work_with_us';
	        $config['allowed_types'] = 'doc|docx|txt|pdf|xls|xlsx';
	        $config['max_size'] = 2050;
	        $config['encrypt_name'] = true;
	
	        $this->load->library('upload', $config);
			
	        // imagen uno
	        $img = $_FILES['file']['name'];
	        $file = array();
	
	        if (!empty($img)) {
	            if ($this->upload->do_upload('file'))
	            {
	                $datos = array('upload_data' => $this->upload->data());
	                $path = UPLOAD_PATH . 'work_with_us/' . $datos['upload_data']['file_name'];
					$file = array('file' => $path);
                    $data = array_merge($data, $file);
	            } else {
	                $this->session->set_flashdata('error', $this->upload->display_errors());
	                redirect(base_url().'work_with_us');
	            }
	        }
			
			// mandamos los datos a la Base de Datos
			$this->work_with_us_emails_m->insert($data);
			
			$data2['post'] = $data;
			
			// mandamos los datos al correo
            $this->email->initialize($config);
            $this->email->from($post->email, 'Formulario de Contacto '.base_url());
            $this->email->to($work_with_us->email);
            $this->email->subject('Contacto');
            $msg = $this->load->view('email_work_with_us', $data2, true);
            $this->email->message($msg);
            //Validate sendmail
            if( $this->email->send()){
                 $this->session->set_flashdata('success', 'Su mensaje a sido enviado');
                 redirect(base_url().'work_with_us');
            }else{
                $this->session->set_flashdata('error', 'Error Mailing, Contact the Webmaster');
                redirect(base_url().'work_with_us');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url().'work_with_us');
        }
    }

}