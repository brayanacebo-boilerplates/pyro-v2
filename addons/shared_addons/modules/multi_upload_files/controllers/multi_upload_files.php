<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
*
* @author 	    Luis Fernando Salazar
* @package 	PyroCMS
* @subpackage 	multi_upload_files
* @category 	Modulos
*/

class Multi_Upload_Files extends Public_Controller {

	var $moduleName = 'multi_upload_files';

    public function __construct()
    {
        parent::__construct();
        $models = array(
            "multi_upload_file_model",
            "multi_upload_file_category_model",
            "multi_upload_file_intro_model"
            );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index($selCategory = null)
    {
        $category = null;
		$search = '';
		
		// si no hay una categoria seleccionada, seleccionamos una por defecto.
        if(empty($selCategory))
        {
        	$category = $this->multi_upload_file_category_model
        	->limit(1)
        	->get_all();
		}
		else
		{
			$category = $this->multi_upload_file_category_model->get_many_by("slug",$selCategory);
		}
		
        if (!empty($category))
        {
	        $category = $category[0]; // Categoria Seleccionada
	        
	        $selCategory = $category->slug;
	
	        // si la carpeta existe cargamos los datos
			$existeCarpeta = $this->multi_upload_file_model->dirProyect.'uploads/default/'.$this->moduleName.'/'.$category->id.'/';
			$multi_upload_files = '';
			if(file_exists($existeCarpeta))
			{
				// mandamos los adjuntos
				$archivosArray = scandir('./uploads/default/'.$this->moduleName.'/'.$category->id.'/');
				$archivosArray = $this->multi_upload_file_model->filtrarSoloArchivosCarpeta($archivosArray);
				$multi_upload_files = $archivosArray;
			}

		}

    	// Consultamos las categorias
        $categories = $this->multi_upload_file_category_model
        //->order_by('title', 'ASC')
        ->order_by('position', 'ASC')
        ->get_all();

    	// Intro
        $in = $this->multi_upload_file_intro_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

    	// Devuelve arbol en HTML, el segundo parametro es el nombre del modulo
        //$menu = treemenu($categories,'multi_upload_files');

        $this->template
        ->append_css('module::photobox.css')
        ->append_js('module::admin/photobox.min.js')
        ->set('archivosAdjuntos', $multi_upload_files)
        ->set('category', $category)
        ->set('categories', $categories)
		->set('current', ($category) ? $category->title : null)
        ->set('moduleName', $this->moduleName)
        ->set('intro', $intro)
		->set('search', $search)
		->set('selCategory', $selCategory)
        ->build('index');
    }

}