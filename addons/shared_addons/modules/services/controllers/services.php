<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
*
* @author 	    Brayan Acebo
* @package 	PyroCMS
* @subpackage 	services
* @category 	Modulos
*/

class services extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "service_model",
            "service_category_model",
            "service_image_model",
            "service_intro_model"
            );
        $this->load->model($models);
		$this->template
                ->append_js('module::scrollpagination.js')
				->append_js('module::js_scroll.js');
		
		$this->inicial_num_pages = 9;
		$this->numer_per_pages = 3;
    }

// -----------------------------------------------------------------

    public function index($selCategory = null)
    {
        $category = null;
		$search = '';
		
		// consulta de los servicios a sus respectivas tablas
		$this->db->select('pr.*')
					->from('services AS pr')
					->join('services_categories AS pm', 'pm.service_id = pr.id', 'left')
					->join('service_categories AS pc', 'pc.id = pm.category_id', 'left')
					->limit($this->inicial_num_pages, 0)
					->order_by('pr.id', 'DESC');
        
		// si se selecciona una categoria
		if($selCategory)
		{
			$this->db->where('pc.slug',$selCategory);
		}
		
		// si se esta buscando
		if(isset($_POST['shearch']))
		{
			// Se consultan los servicios
            $this->db->like('name', $_POST['shearch']);
			$search = $_POST['shearch'];
		}
		
		// traemos los datos
		$services = $this->db->get()->result();
		
		if(!empty($services))
		{
	        foreach($services AS $item)
	        {
	            $item->name = substr($item->name, 0, 20);
	            $item->image = val_image($item->image);
	            $item->introduction = substr($item->introduction, 0, 100);
	            $item->price = ($item->price) ? "Precio: $".number_format($item->price) : null;
	            $item->url = site_url('services/detail/'.$item->slug);
	        }
		}

    	// Consultamos las categorias
        $categories = $this->service_category_model
        //->order_by('title', 'ASC')
        ->order_by('position', 'ASC')
        ->get_all();

    	// Intro
        $in = $this->service_intro_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

    	// Devuelve arbol en HTML, el segundo parametro es el nombre del modulo
        $menu = treemenu($categories,'services');

        $this->template
        ->set('services', $services)
        ->set('category', ($category) ? "/ ".$category->title : null)
        ->set('categories', $categories)
		->set('current', ($category) ? $category->title : null)
        //->set('menu', $menu)
        ->set('intro', $intro)
		->set('search', $search)
		->set('selCategory', $selCategory)
        ->build('index');
    }


// ----------------------------------------------------------------------

    public function detail($slug)
    {

        $return = $this->service_model->get_many_by('slug', $slug);
        $return = $return[0];

        if(!$return)
            redirect('services');

        // Se convierten algunas variables necesarias para usar como slugs
        $setter = array(
            'image' => val_image($return->image),
            'price' => ($return->price) ? "Precio: $".number_format($return->price) : null
            );

        $service = array_merge((array)$return,$setter);

        $relation = $this->db->where('service_id',$service['id'])->get('services_categories')->result();
        $categories = array();
        foreach ($relation as $item) {
            $category = $this->service_category_model->get_many_by('id', $item->category_id);
            $category = $category[0];
            $categories[] = array(
                    "title" => $category->title,
                    "slug" => $category->slug
                );
        }

        // imagenes para slider
        $images = $this->service_image_model->get_many_by('service_id',$service['id']);

        $this->template
                ->set('service', (object) $service)
                ->set('categories', $categories)
                ->set('images', $images)
                ->build('detail');

    }

	public function ajax_items($selCategory = null)
    {
    	$page = (isset($_POST['page_ajax']) ? $_POST['page_ajax'] : 1);
      	
		// consulta de los servicios a sus respectivas tablas
		$this->db->select('pr.*')
					->from('services AS pr')
					->join('services_categories AS pm', 'pm.service_id = pr.id', 'left')
					->join('service_categories AS pc', 'pc.id = pm.category_id', 'left')
					->limit($this->numer_per_pages, ($page*$this->numer_per_pages) + $this->inicial_num_pages)
					->order_by('pr.id', 'DESC');
        
		// si se selecciona una categoria
		if($selCategory)
		{
			$this->db->where('pc.slug',$selCategory);
		}
		
		// traemos los datos
		$services = $this->db->get()->result();
		
        if(!empty($services))
		{
	        foreach($services AS $item)
	        {
	            $item->name = substr($item->name, 0, 20);
	            $item->image = val_image($item->image);
	            $item->introduction = substr($item->introduction, 0, 100);
	            $item->price = ($item->price) ? "Precio: $".number_format($item->price) : null;
	            $item->url = site_url('services/detail/'.$item->slug);
	        }
		}
		
		$dataView['services'] = $services;
		$this->template->set_layout(FALSE);
		$this->template->build('items_ajax', $dataView);
		//$this->load->view('items_ajax', $dataView);
    }
}