<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget_Chat extends Widgets
{
    // The widget title,  this is displayed in the admin interface
    public $title = array(
        'en' => 'Chat (Widget)',
        'es' => 'Chat (Widget)'
    );
    public $description = array(
        'en' => 'Support Chat',
        'es' => 'Chat de soporte'
    );
 
    // The author's name
    public $author = 'Luis Fernando Salazar Buitrago';
 
    // The authors website for the widget
    public $website = 'www.brayanacebo.com';
 
    //current version of your widget
    public $version = '1.0';
	
    public function run()
    {		
    	return array('session_id' => 'chat'.$this->session->userdata('session_id'));
    }
}