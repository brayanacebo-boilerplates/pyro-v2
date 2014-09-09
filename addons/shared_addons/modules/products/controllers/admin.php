<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Brayan Acebo
 */

// Ajustamos Zona Horaria
date_default_timezone_set("America/Bogota");

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('products');
        $this->template
        ->append_js('module::developer.js')
        ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        /*$models = array(
            "product_model",
            );
        $this->load->model($models);*/
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación de Productos
        $pagination = create_pagination('admin/products/index', $this->db->count_all('products'), 10);

        // Se consultan los productos
        $products = $this->db
        ->order_by('id', 'DESC')
        ->limit($pagination['limit'], $pagination['offset'])
        ->get('products')
		->result();

        // Intro
        $intro = $this->db->get('products_intro')->result();
        $intro = $intro[0];
		
		// categorias con sortable (se consultan con un orden)
		$structure_categories = $this->db
        ->order_by('position', 'ASC')
        ->get('product_categories')->result();
		
		// se contruye el html de las categorias
		$structure_categories = $this->build_categories($structure_categories,'products', 0, true, null);
		
        $this->template
        ->append_js('module::admin/ajax.js')
        ->set('pagination', $pagination)
        ->set('products', $products)
        ->set('intro', $intro)
		->set('structure_categories', $structure_categories)
        ->build('admin/index');
    }
	
	// destacados de los productos para el home
	public function outstanding_product($idItem = null)
	{
		$amount = $this->db->where('outstanding', 1)->get('products')->result();
		$amount = count($amount);
		$obj = $this->db->where('id', $idItem)->get('products')->row();
	    $data['outstanding'] = ($obj->outstanding == 1 ? 0 : 1);
		
		if($amount < 3 || $data['outstanding'] == 0)
		{
			if ($this->db->where('id', $idItem)->update('products', $data))
			{
	            $statusJson = '';
				$msgJson = 'El producto ahora es destacado.';
	        }
	        else
	        {
	            $statusJson = 'error';
				$msgJson = 'Ocurrio un error al cambiar el estado a destacado';
	        }
		}
		else {
			$statusJson = 'error';
			$msgJson = 'Ya llegaste al numero limite de destacados';
		}
		echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
		
	}
	
	public function orden_categories()
	{
		$statusJson = '';
		$msgJson = '';
		$datosArray = $_POST['subCatArray'];  // tomamos los datos del post y se los damos al data
		
		$datosArray = array_unique($datosArray);  // quitamos los repetidos
		$datosArray = array_values($datosArray);  // ordenamos el array de 0 a n
		
		// ponemos el orden de las categorias
		$i = 1;
		foreach($datosArray as $fila => $idRegistro)
		{
			$data = array(
	            'position' => $i,
	        );
			if ($this->db->where('id', $idRegistro)->update('product_categories', $data))
            {
            	if($statusJson != "error")
				{
					$statusJson = "";
	        		$msgJson = "El campo se ha cambiado con éxito.";
				}
            } else {
                $statusJson = "error";
	        	$msgJson = "Ocurrió un error. Actualizando las posiciones";
            }
	        $i++;
		}
		
		echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
	}
	
	public function build_categories($rows,$module=null,$parent=0,$ban=true,$current=null)
	{
		$classCategories = 'cat_1';
		$classSubcategoriesFather = 'sortable ui-sortable';
		$classSubcategories = 'subcategori';
		$classActive = 'Activo';
		
        $result = "<ul class='sortable ui-sortable'>";
        //if($ban) $result.= "<li id='todos'><a href='{$module}'>Todos</a></li>";
        foreach ($rows as $row)
		{
            if ($row->parent == $parent)
			{
				foreach ($rows as $subrow)
				{
                    if ($subrow->parent == $row->id)
                     $children = true;
                 else $children = false;
				}
                $result.= "<li id='".$row->id."' class='".($row->parent == 0 ? $classCategories : ($children ? $classSubcategoriesFather : $classSubcategories)).' '.($row->title == $current ? $classActive : '')."'><a href='admin/{$module}/edit_category/". $row->id."' class='edit_categories_ajax'>".$row->title."</a>";
             if ($children = true)
                $result.= $this->build_categories($rows,$module,$row->id,false, $current) . "</li>";
			}
		}
		$result .= "</ul>";
		return $result;
    }

    /*
     * Categorias
     */

    public function create_category() 
    {
        $categories = $this->db->order_by('id', 'ASC')->get('product_categories')->result();
        $this->template
	        ->set('categories', $categories)
	        ->build('admin/create_category');
    }

    // -----------------------------------------------------------------

    public function store_category() {

        $this->form_validation->set_rules('title', 'Titulo', 'required|trim');
        $this->form_validation->set_rules('parent', 'Padre', '');

        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            $data = array(
                'title' => $post->title,
                'slug' => slug($post->title),
                'parent' => $post->parent,
                'created_at' => date('Y-m-d H:i:s')
            );
				
			if ($this->db->insert('product_categories', $data)) 
			{
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/products/#page-structure-categories');
            } 
            else
            {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/products/create_category');
            }
        }
        else 
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/products/create_category');
        }
    }

    // -----------------------------------------------------------------

    public function destroy_category($id = null) {
        $id or redirect('admin/products#page-categories');
		
		// varificamos que la categoria no tenga subcategorias
		$items = $this->db->where('parent', $id)->get('product_categories')->result();
		if(count($items) > 0)
		{
			$this->session->set_flashdata('error', 'La categoria no puede ser eliminada por que tiene subcategorias');
			redirect('admin/products/#page-structure-categories');
		}
		// verificamos que la categoria no tenga productos
		
		$itemsProd = $this->db
					->select('COUNT(*) AS numreg')
					->from('products_categories')
					->where('category_id', $id)
					->get()->result();
		if($itemsProd[0]->numreg > 0)
		{
			$this->session->set_flashdata('error', 'La categoria no puede ser eliminada por que tiene productos asignados');
			redirect('admin/products/#page-structure-categories');
		}
		if ($this->db->where('id', $id)->delete('product_categories'))
		{
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        }
        else
        {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/products/#page-structure-categories');
    }

    // --------------------------------------------------------------------------------------

    public function edit_category($id = null) 
    {
		$category = $this->db->where('id', $id)->get('product_categories')->row();
        $categories = $this->db->order_by('id', 'ASC')->get('product_categories')->result();
		
        $this->template
        ->set('categories', $categories)
        ->set('category', $category)
        ->build('admin/edit_category');
    }

    // -----------------------------------------------------------------

    public function update_category() {

        $this->form_validation->set_rules('title', 'Titulo', 'required|trim');
        $this->form_validation->set_rules('parent', 'Padre', '');

        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            $data = array(
                'title' => $post->title,
                'slug' => slug($post->title),
                'parent' => $post->parent
                );
			
			if ($this->db->where('id', $post->id)->update('product_categories', $data))
			{
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/products/#page-structure-categories');
            } 
            else 
            {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/products/create_category');
            }
        } 
        else 
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/products/create_category');
        }
    }

    /*
     * Productos
     */

    public function create() 
    {
		$categories = $this->db->order_by('id', 'ASC')->get('product_categories')->result();
        $this->template
        ->set('categories', $categories)
        ->build('admin/create');
    }

    // -----------------------------------------------------------------

    public function store() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias', 'required');
        $this->form_validation->set_rules('content', 'Descripción', 'required|trim');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');
        $this->form_validation->set_rules('price', 'Precio', 'integer');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'description' => html_entity_decode($post->content),
                'introduction' => $post->introduction,
                'price' => ($post->price) ? $post->price : null,
                'created_at' => date('Y-m-d H:i:s')
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/products';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'products/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/products/');
                }
            }

            // Se inserta en la base de datos
            if ($this->db->insert('products', $data)) 
            {
                $productId = $this->db->insert_id();
                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'product_id' => $productId,
                        'category_id' => $categories[$i]
                    );
                    $this->db->insert($this->db->dbprefix.'products_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/products');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/products/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/products/create');
        }
    }

    // -----------------------------------------------------------------

    public function destroy($id = null) {
        $id or redirect('admin/products');
        $obj = $this->db->where('id', $id)->get($this->db->dbprefix.'products')->row();
		if ($this->db->where('id', $id)->delete('products'))
		{
            @unlink($obj->image); // Eliminamos archivo existente
            $this->db->delete($this->db->dbprefix.'products_categories', array('product_id' => $id)); // Eliminaos relación pro cat
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/products');
    }

    // --------------------------------------------------------------------------------------

    public function edit($id = null) {
        $id or redirect('admin/products');
		$product = $this->db->where('id', $id)->get('products')->row();
        $categories = $this->db->order_by('id', 'ASC')->get('product_categories')->result();

        $return = $this->db->where('product_id',$id)->get('products_categories')->result();
        $selected_category = array();

        foreach ($return as $item) {
            $selected_category[] = $item->category_id;
        }

        $this->template
        ->set('categories', $categories)
        ->set('selected_category', $selected_category)
        ->set('product', $product)
        ->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function update() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias', 'required');
        $this->form_validation->set_rules('content', 'Descripción', 'required|trim');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');
        $this->form_validation->set_rules('price', 'Precio', 'integer');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'description' => html_entity_decode($post->content),
                'introduction' => $post->introduction,
                'price' => ($post->price) ? $post->price : null
            );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/products';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'products/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->where('id', $post->id)->get('products')->row();
                    @unlink($obj->image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/products/');
                }
            }

            // Se inserta en la base de datos
            if ($this->db->where('id', $post->id)->update('products', $data))
            {

                $this->db->delete($this->db->dbprefix.'products_categories', array('product_id' => $post->id)); // Eliminaos relación pro cat

                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'product_id' => $post->id,
                        'category_id' => $categories[$i]
                        );
                    $this->db->insert($this->db->dbprefix.'products_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/products');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/products/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/products/create');
        }
    }


    /*
     * Actualizar Intro
     */

    public function update_intro() {
        $this->form_validation->set_rules('content', 'Texto', 'trim');
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();
            $data = array(
                'text' => html_entity_decode($post->content)
                );
			if ($this->db->where('id', $post->id)->update('products_intro', $data))
            {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/products#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/products#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/products#page-intro');
        }
    }

    /*
     * Administración de imagenes
     */

    public function images($id = null) {
        $id or redirect('admin/products');
        // Se consultan las imagenes del product
		$images = $this->db->where('product_id', $id)->get('product_images')->result();
		$product = $this->db->where('id', $id)->get('products')->row();

        $this->template
        ->set('product', $product)
        ->set('images', $images)
        ->build('admin/images');
    }

    // ----------------------------------------------------------------------------------

    public function create_image($id = null) {
        $id or redirect('admin/products');
		$product = $this->db->where('id', $id)->get('products')->row();
		
        $this->template
        ->set('product', $product)
        ->build('admin/create_image');
    }

    // -----------------------------------------------------------------

    public function store_image()
    {
    	// Se carga la imagen
        $config['upload_path'] = './' . UPLOAD_PATH . '/products';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2050;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

            // imagen uno
        $img = $_FILES['image']['name'];
        $image = array();
        $id = $this->input->post('id');

        if (!empty($img)) {
            if ($this->upload->do_upload('image')) {
                $datos = array('upload_data' => $this->upload->data());
                $path = UPLOAD_PATH . 'products/' . $datos['upload_data']['file_name'];
                $image = array(
                    'product_id' => $id,
                    'path' => $path
                    );
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/products/images/'.$id);
            }
        }

            // Se inserta en la base de datos
        if ($this->db->insert('product_images', $image)) {
            $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
            redirect('admin/products/images/'.$id);
        } else {
            $this->session->set_flashdata('error', lang('galeria:error_message'));
            redirect('admin/products/create_image/'.$id);
        }
    }

    // -----------------------------------------------------------------

    public function destroy_image($id = null,$product_id = null) {
        $id or redirect('admin/products');
        $product_id or redirect('admin/products');
		$obj = $this->db->where('id', $id)->get('product_images')->row();
		if ($this->db->where('id', $id)->delete('product_images'))
        {
            @unlink($obj->path); // Eliminamos archivo existente
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/products/images/'.$product_id);
    }

}