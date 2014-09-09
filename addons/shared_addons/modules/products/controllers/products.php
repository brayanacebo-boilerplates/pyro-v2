<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
*
* @author 	    Brayan Acebo
* @package 	PyroCMS
* @subpackage 	Products
* @category 	Modulos
*/

class Products extends Public_Controller {

    public function __construct() {
        parent::__construct();
        /*$models = array(
            "product_model",
        );
        $this->load->model($models);*/
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
		
		// consulta de los productos a sus respectivas tablas
		$this->db->select('pr.*')
					->from('products AS pr')
					->join('products_categories AS pm', 'pm.product_id = pr.id', 'left')
					->join('product_categories AS pc', 'pc.id = pm.category_id', 'left')
					->limit($this->inicial_num_pages, 0)
					->order_by('pr.id', 'DESC')
					->group_by('pr.id');
        
		// si se selecciona una categoria
		if($selCategory)
		{
			$this->db->where('pc.slug',$selCategory);
		}
		
		// si se esta buscando
		if(isset($_POST['shearch']))
		{
			// Se consultan los productos
            $this->db->like('name', $_POST['shearch']);
			$search = $_POST['shearch'];
		}
		
		// traemos los datos
		$products = $this->db->get()->result();
		
		if(!empty($products))
		{
	        foreach($products AS $item)
	        {
	            $item->name = substr($item->name, 0, 20);
	            $item->image = val_image($item->image);
	            $item->introduction = substr($item->introduction, 0, 100);
	            $item->price = ($item->price) ? "Precio: $".number_format($item->price) : null;
	            $item->url = site_url('products/detail/'.$item->slug);
	        }
		}

    	// Consultamos las categorias
        $categories = $this->db
        ->order_by('position', 'ASC')
        ->get('product_categories')
        ->result();

    	// Intro
        $intro = $this->db->get('products_intro')->result();
        $intro = $intro[0];

    	// Devuelve arbol en HTML, el segundo parametro es el nombre del modulo
        //$menu = treemenu($categories,'products');

        $this->template
        ->set('products', $products)
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
		$return = $this->db->where('slug', $slug)->get('products')->row();
        //$return = $return[0];

        if(!$return)
            redirect('products');

        // Se convierten algunas variables necesarias para usar como slugs
        $setter = array(
            'image' => val_image($return->image),
            'price' => ($return->price) ? "Precio: $".number_format($return->price) : null
            );

        $product = array_merge((array)$return,$setter);

        $relation = $this->db->where('product_id',$product['id'])->get('products_categories')->result();
        $categories = array();
        foreach ($relation as $item) {
			$category = $this->db->where('id', $item->category_id)->get('product_categories')->row();
			if(!empty($category))
			{
	            //$category = $category[0];
	            $categories[] = array(
	                    "title" => $category->title,
	                    "slug" => $category->slug
	                );
			}
        }

        // imagenes para slider
        $images = $this->db->where('product_id', $product['id'])->get('product_images')->result();

        $this->template
                ->set('product', (object) $product)
                ->set('categories', $categories)
                ->set('images', $images)
                ->build('detail');

    }

	public function ajax_items($selCategory = null)
    {
    	$page = (isset($_POST['page_ajax']) ? $_POST['page_ajax'] : 1);
      	
		// consulta de los productos a sus respectivas tablas
		$this->db->select('pr.*')
					->from('products AS pr')
					->join('products_categories AS pm', 'pm.product_id = pr.id', 'left')
					->join('product_categories AS pc', 'pc.id = pm.category_id', 'left')
					->limit($this->numer_per_pages, ($page*$this->numer_per_pages) + $this->inicial_num_pages)
					->order_by('pr.id', 'DESC');
        
		// si se selecciona una categoria
		if($selCategory)
		{
			$this->db->where('pc.slug',$selCategory);
		}
		
		// traemos los datos
		$products = $this->db->get()->result();
		
        if(!empty($products))
		{
	        foreach($products AS $item)
	        {
	            $item->name = substr($item->name, 0, 20);
	            $item->image = val_image($item->image);
	            $item->introduction = substr($item->introduction, 0, 100);
	            $item->price = ($item->price) ? "Precio: $".number_format($item->price) : null;
	            $item->url = site_url('products/detail/'.$item->slug);
	        }
		}
		
		$dataView['products'] = $products;
		$this->template->set_layout(FALSE);
		$this->template->build('items_ajax', $dataView);
		//$this->load->view('items_ajax', $dataView);
    }
}