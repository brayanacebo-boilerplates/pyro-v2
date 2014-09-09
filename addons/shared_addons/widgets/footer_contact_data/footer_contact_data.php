<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget_Footer_Contact_Data extends Widgets
{
    // The widget title,  this is displayed in the admin interface
    public $title = array(
        'en' => 'footer_contact_data',
        'es' => 'Datos de contacto en el footer (Widget)'
    );
    public $description = array(
        'en' => '',
        'es' => 'Configuración de footer datos con el modulo de contactenos.'
    );
 
    // The author's name
    public $author = 'Luis Fernando Salazar Buitrago';
 
    // The authors website for the widget
    public $website = 'www.imaginamos.com';
 
    //current version of your widget
    public $version = '1.0';
	
    public function run()
    {
    	/*$data = $this->db->get($this->db->dbprefix.'contact_us')->result_array();*/
		$data = $this->db->select('facebook, twitter, linkedin, adress, phone, email')
					->from('contact_us AS cu')->get()->result_array();
		
    	return array('data' => $data[0]);
    }
}