<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget_Logo_Pagina extends Widgets
{
    // The widget title,  this is displayed in the admin interface
    public $title = array(
        'en' => 'Logo Página (Widget)',
        'es' => 'Web site Logo (Widget)'
    );
    public $description = array(
        'en' => '',
        'es' => 'Configuración del logo.'
    );
 
    // The author's name
    public $author = 'Luis Fernando Salazar Buitrago';
 
    // The authors website for the widget
    public $website = 'www.imaginamos.com';
 
    //current version of your widget
    public $version = '1.0';
	
	
    public function run($options)
    {
    	$data = $this->db->get($this->db->dbprefix.'others_conf')->row()->logo;
    	return array('data' => $data);
    }
}