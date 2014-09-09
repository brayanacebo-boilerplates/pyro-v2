<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
*
* @author 	    Brayan Acebo
* @package 	PyroCMS
* @subpackage 	albums
* @category 	Modulos
*/

class albums extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "album_model",
            "album_category_model",
            "album_image_model",
            "album_intro_model"
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
		
		// consulta de los albunes a sus respectivas tablas
		$this->db->select('pr.*')
					->from('albums AS pr')
					->join('albums_categories AS pm', 'pm.album_id = pr.id', 'left')
					->join('album_categories AS pc', 'pc.id = pm.category_id', 'left')
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
			// Se consultan los albunes
            $this->db->like('name', $_POST['shearch']);
			$search = $_POST['shearch'];
		}
		
		// traemos los datos
		$albums = $this->db->get()->result();
		
		if(!empty($albums))
		{
	        foreach($albums AS $item)
	        {
	            $item->name = substr($item->name, 0, 20);
	            $item->image = val_image($item->image);
	            $item->introduction = substr($item->introduction, 0, 100);
	            $item->url = site_url('albums/detail/'.$item->slug);
	        }
		}

    	// Consultamos las categorias
        $categories = $this->album_category_model
        //->order_by('title', 'ASC')
        ->order_by('position', 'ASC')
        ->get_all();

    	// Intro
        $in = $this->album_intro_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

    	// Devuelve arbol en HTML, el segundo parametro es el nombre del modulo
        $menu = treemenu($categories,'albums');

        $this->template
        ->set('albums', $albums)
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

        $return = $this->album_model->get_many_by('slug', $slug);
        $return = $return[0];

        if(!$return)
            redirect('albums');

        // Se convierten algunas variables necesarias para usar como slugs
        $setter = array(
            'image' => val_image($return->image),
            );

        $album = array_merge((array)$return,$setter);

        $relation = $this->db->where('album_id',$album['id'])->get('albums_categories')->result();
        $categories = array();
        foreach ($relation as $item) {
            $category = $this->album_category_model->get_many_by('id', $item->category_id);
            $category = $category[0];
            $categories[] = array(
                    "title" => $category->title,
                    "slug" => $category->slug
                );
        }

        // imagenes para slider
        $images = $this->album_image_model->where('path IS NOT NULL', null, false)->get_many_by('album_id',$album['id']);
		$videos = $this->album_image_model->where('video IS NOT NULL', null, false)->get_many_by('album_id',$album['id']);
		
		if(!empty($videos))
		{
			foreach($videos AS $item)
			{
				$img_video = explode("v=",$item->video);
				if(isset($img_video[1]))
				{
					$item->img_video = $img_video[1];
				}
			}
		}
		
        $this->template
                ->set('album', (object) $album)
                ->set('categories', $categories)
                ->set('images', $images)
				->set('videos', $videos)
                ->build('detail');

    }

	public function ajax_items($selCategory = null)
    {
    	$page = (isset($_POST['page_ajax']) ? $_POST['page_ajax'] : 1);
      	
		// consulta de los albunes a sus respectivas tablas
		$this->db->select('pr.*')
					->from('albums AS pr')
					->join('albums_categories AS pm', 'pm.album_id = pr.id', 'left')
					->join('album_categories AS pc', 'pc.id = pm.category_id', 'left')
					->limit($this->numer_per_pages, ($page*$this->numer_per_pages) + $this->inicial_num_pages)
					->order_by('pr.id', 'DESC');
        
		// si se selecciona una categoria
		if($selCategory)
		{
			$this->db->where('pc.slug',$selCategory);
		}
		
		// traemos los datos
		$albums = $this->db->get()->result();
		
        if(!empty($albums))
		{
	        foreach($albums AS $item)
	        {
	            $item->name = substr($item->name, 0, 20);
	            $item->image = val_image($item->image);
	            $item->introduction = substr($item->introduction, 0, 100);
	            $item->url = site_url('albums/detail/'.$item->slug);
	        }
		}
		
		$dataView['albums'] = $albums;
		$this->template->set_layout(FALSE);
		$this->template->build('items_ajax', $dataView);
		//$this->load->view('items_ajax', $dataView);
    }
}