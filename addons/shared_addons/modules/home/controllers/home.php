<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	Luis Fernando Salazar Buitrago
 * @author  Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	Home Module
 * @category 	Modulos
 * @license 	Apache License v2.0
 */

class Home extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    // -----------------------------------------------------------------

    public function index()
    {
    	// consultamos los datos del Banner
        $banner = $this->db->get('home_banner')->result();

        // consultamos los datos de Noticias Destacadas
        $outstanding_news = $this->db->where('type', '1')->get('home_outstanding')->result();

		// consultamos los datos de Servicios Destacadas
        $outstanding_services = $this->db->where('type', '2')->get('home_outstanding')->result();
		
		// Consultamos los datos de productos destacados del modulo de productos
		$products = $this->db
			->where('outstanding', '1')
			->get('products')
			->result();
		
		// recorremos los datos para cambiar algunas de sus caracteristicas
        foreach($products AS $item)
		{
			// el de las imagenes solo es si se necesita cargar las imagenes internas para un slider
			/*$item->images = $this->product_image_model->get_many_by('product_id',$item->id);*/
			$item->link = site_url('products/detail/'.$item->slug);
		}
		
		// Consultamos los datos de noticias destacados del modulo de noticias
		$news = $this->db
			->where('outstanding', '1')
			->get('news')
			->result();
		
		// recorremos los datos para cambiar algunas de sus caracteristicas
		foreach($news AS $item)
		{
			// el de las imagenes solo es si se necesita cargar las imagenes internas para un slider
			/*$item->images = $this->product_image_model->get_many_by('product_id',$item->id);*/ 
			$item->link = site_url('news/detail/'.$item->slug);
		}
		
		// Consultamos los datos del slider de Clientes
        $customers = $this->db->get('home_customers')->result();
		
		//Consultamos los datos del texto informativo
		$text_info = $this->db->limit(1)->get('home_text_info')->result();
		
		// agregamos los atributos al template
        $this->template
                ->set('banner', $banner)
                ->set('outstanding_news', $outstanding_news)
                ->set('outstanding_services', $outstanding_services)
				->set('products', $products)
				->set('news', $news)
				->set('customers', $customers)
        		->set('text_info', $text_info[0])
                ->build('index');
    }

}
