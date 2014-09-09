<?php



defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * @author Luis Fernando Salazar

 */

class Contact_Us extends Public_Controller {



    public function __construct()
    {
        parent::__construct();
         $models = array('contact_us_m', 'contact_us_emails_m');

        $this->load->model($models);
		
		$this->template
			->append_js('module::jquery_validate.js')
			->append_js('module::formvalidate.js');
    }
	
    // -----------------------------------------------------------------



    public function index()
    {
        // Datos de Contacto
        $_contact_us = $this->contact_us_m->get_all();
        $contact_us = array();
        if (count($_contact_us) > 0) {
            $contact_us = $_contact_us[0];
        }

        $this->template
                ->set('contact_us', $contact_us)
                ->build('contact_us_front');
    }


    /*
     *Enviar correo
     */

    function send()
    {
        $this->form_validation->set_rules('name', 'Nombre y Apellido', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'Correo', 'required|trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim|max_length[30]');
        $this->form_validation->set_rules('cell', 'Celular', 'trim|max_length[30]');
        $this->form_validation->set_rules('company', 'Empresa/Organización', 'trim|max_length[100]');
        $this->form_validation->set_rules('message', 'Mensaje', 'required|trim|max_length[455]');
		
		$statusJson = 'error';
		$msgJson = 'Por favor intenta de mas tarde';
		
        if ($this->form_validation->run() === TRUE)
        {
			$_contact_us = $this->contact_us_m->get_all();

	        $contact_us = array();
	
	        if (count($_contact_us) > 0) {
	
	            $contact_us = $_contact_us[0];
	
	        }
	       	$post = (object) $this->input->post(null);

            $data['post'] = array(
                'name' => $post->name,
                'email' => $post->email,
                'phone' => $post->phone,
                'cell' => $post->cell,
                'company' => $post->company,
                'message' => $post->message,
            );

            //Validate sendmail
            if( $this->contact_us_emails_m->insert($data['post']))
            {
				$this->send_email_to_user($data['post'], $contact_us->email);
                //$this->session->set_flashdata('success', 'Su mensaje a sido enviado');
                //redirect(base_url().'/contact_us');
				$statusJson = '';
				$msgJson = 'Su mensaje ha sido enviado';
            }
            else
            {
                //$this->session->set_flashdata('error', 'Error Mailing, Contact the Webmaster');
                //redirect(base_url().'/contact_us');
                $statusJson = 'error';
				$msgJson = 'Error Mailing, Contact the Webmaster';
            }
        } else {

            //$this->session->set_flashdata('error', validation_errors());
            //redirect(base_url().'/contact_us');
			$statusJson = 'error';
			$msgJson = validation_errors();
        }
		echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
    }


	/**
	 * Send an email
	 *
	 * @param array $comment The comment data.
	 * @param array $entry The entry data.
	 * @return boolean 
	 */
	private function send_email_to_user($data, $admin_email)
	{
		$this->load->library('email');		
		$this->load->library('user_agent');
		
		Events::trigger('email', array(
			'name' => $data['name'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'company' => $data['company'],
			'message' => $data['message'],
			'slug' => 'contact',
			/*'email' => Settings::get('contact_email'), // se manda el correo a al de la configuración del pyro*/
			'to' => $admin_email,
		), 'array');
	}
}