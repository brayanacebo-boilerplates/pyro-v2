<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget_Shearch_Product extends Widgets
{
    // The widget title,  this is displayed in the admin interface
    public $title = array(
        'en' => 'Buscador de Productos (Widget)',
        'es' => 'Shearch Products (Widget)'
    );
    public $description = array(
        'en' => 'Shearch Products',
        'es' => 'Buscador de productos.'
    );
 
    // The author's name
    public $author = 'Luis Fernando Salazar Buitrago';
 
    // The authors website for the widget
    public $website = 'www.brayanacebo.com';
 
    //current version of your widget
    public $version = '1.0';
	
	
    public function run($options)
    {
    	$data = array();
    	return array('data' => $data);
    }
}