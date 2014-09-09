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
        $this->lang->load('albums');
        $this->template
        ->append_js('module::developer.js')
        ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $models = array(
            "album_model",
            "album_category_model",
            "album_image_model",
            "album_intro_model"
            );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación de albunes
        $pagination = create_pagination('admin/albums/index', $this->album_model->count_all(), 10);

        // Se consultan los albunes
        $albums = $this->album_model
        ->order_by('id', 'DESC')
        ->limit($pagination['limit'], $pagination['offset'])
        ->get_all();

        // Consultamos las categorias
        $categories = $this->album_category_model
        ->order_by('id', 'DESC')
        ->get_all();
		
        foreach ($categories as $key => $value) {
            $parent = $value->parent;
            if($parent != 0){
                $parent_name = $this->album_category_model->get($parent)->title;
                if($parent_name != "") {
                    $categories[$key]->parent_name = $parent_name;
                }
            } else {
                $categories[$key]->parent_name = "";
            }
        }

        // Intro
        $in = $this->album_intro_model->get_all();
        $intro = array();

        if (count($in) > 0) {
            $intro = $in[0];
        }
		
		// categorias con sortable (se consultan con un orden)
		$structure_categories = $this->album_category_model
        ->order_by('position', 'ASC')
        ->get_all();
		
		$structure_categories = $this->build_categories($structure_categories,'albums', 0, true, null);
		
        $this->template
        ->append_js('module::admin/ajax.js')
        ->set('pagination', $pagination)
        ->set('albums', $albums)
        ->set('categories', $categories)
        ->set('intro', $intro)
		->set('structure_categories', $structure_categories)
        ->build('admin/index');
    }
	
	// destacados de los albunes para el home
	public function outstanding_album($idItem = null)
	{
		$amount = $this->album_model->where('outstanding', 1)->get_all();
		$amount = count($amount);
		$obj = $this->db->where('id', $idItem)->get('albums')->row();
	    $data['outstanding'] = ($obj->outstanding == 1 ? 0 : 1);
		
		if($amount < 3 || $data['outstanding'] == 0)
		{
			
	        if ($this->album_model->update($idItem, $data))
			{
	            $statusJson = '';
				$msgJson = 'El albumo ahora es destacado.';
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

            if ($this->album_category_model->update($idRegistro, $data))
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

    public function create_category() {
        $categories = $this->album_category_model->order_by('id', 'ASC')->get_all();
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

            if ($this->album_category_model->insert($data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/albums/#page-structure-categories');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/albums/create_category');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/albums/create_category');
        }
    }

    // -----------------------------------------------------------------

    public function destroy_category($id = null) {
        $id or redirect('admin/albums#page-categories');
		
		// varificamos que la categoria no tenga subcategorias
		$items = $this->album_category_model->where('parent', $id)->get_all();
		if(count($items) > 0)
		{
			$this->session->set_flashdata('error', 'La categoria no puede ser eliminada por que tiene subcategorias');
			redirect('admin/albums/#page-structure-categories');
		}
		// verificamos que la categoria no tenga albunes
		
		$itemsProd = $this->db
					->select('COUNT(*) AS numreg')
					->from('albums_categories')
					->where('category_id', $id)
					->get()->result();
		if($itemsProd[0]->numreg > 0)
		{
			$this->session->set_flashdata('error', 'La categoria no puede ser eliminada por que tiene albunes asignados');
			redirect('admin/albums/#page-structure-categories');
		}
		
        if ($this->album_category_model->delete($id)) {
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/albums/#page-structure-categories');
    }

    // --------------------------------------------------------------------------------------

    public function edit_category($id = null) {
        $category = $this->album_category_model->get($id);
        $categories = $this->album_category_model->order_by('id', 'ASC')->get_all();
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

            if ($this->album_category_model->update($post->id,$data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/albums/#page-structure-categories');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/albums/create_category');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/albums/create_category');
        }
    }

    /*
     * albunes
     */

    public function create() {
        $categories = $this->album_category_model->order_by('id', 'ASC')->get_all();
        $this->template
        ->set('categories', $categories)
        ->build('admin/create');
    }

    // -----------------------------------------------------------------

    public function store() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias', 'required');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'introduction' => $post->introduction,
                'created_at' => date('Y-m-d H:i:s')
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/albums';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'albums/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/albums/');
                }
            }

            // Se inserta en la base de datos
            if ($this->album_model->insert($data)) {

                $albumId = $this->db->insert_id();
                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'album_id' => $albumId,
                        'category_id' => $categories[$i]
                        );
                    $this->db->insert($this->db->dbprefix.'albums_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/albums');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/albums/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/albums/create');
        }
    }

    // -----------------------------------------------------------------

    public function destroy($id = null) {
        $id or redirect('admin/albums');
        $obj = $this->db->where('id', $id)->get($this->db->dbprefix.'albums')->row();
        if ($this->album_model->delete($id)) {
            @unlink($obj->image); // Eliminamos archivo existente
            $this->db->delete($this->db->dbprefix.'albums_categories', array('album_id' => $id)); // Eliminaos relación pro cat
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/albums');
    }

    // --------------------------------------------------------------------------------------

    public function edit($id = null) {
        $id or redirect('admin/albums');
        $album = $this->album_model->get($id);
        $categories = $this->album_category_model->order_by('id', 'ASC')->get_all();

        $return = $this->db->where('album_id',$id)->get('albums_categories')->result();
        $selected_category = array();

        foreach ($return as $item) {
            $selected_category[] = $item->category_id;
        }

        $this->template
        ->set('categories', $categories)
        ->set('selected_category', $selected_category)
        ->set('album', $album)
        ->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function update() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias', 'required');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'introduction' => $post->introduction,
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/albums';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'albums/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->where('id', $post->id)->get('albums')->row();
                    @unlink($obj->image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/albums/');
                }
            }

            // Se inserta en la base de datos
            if ($this->album_model->update($post->id,$data)) {

                $this->db->delete($this->db->dbprefix.'albums_categories', array('album_id' => $post->id)); // Eliminaos relación pro cat

                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'album_id' => $post->id,
                        'category_id' => $categories[$i]
                        );
                    $this->db->insert($this->db->dbprefix.'albums_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/albums');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/albums/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/albums/create');
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
            if ($this->album_intro_model->update($post->id, $data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/albums#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/albums#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/albums#page-intro');
        }
    }

    /*
     * Administración de imagenes
     */

    public function images($id = null) {
        $id or redirect('admin/albums');
        // Se consultan las imagenes del album
        $images = $this->album_image_model->get_many_by("album_id",$id);
        $album = $this->album_model->get_many_by("id",$id);
        $album = $album[0];

        $this->template
        ->set('album', $album)
        ->set('images', $images)
        ->build('admin/images');
    }

    // ----------------------------------------------------------------------------------

    public function create_image($id = null) {
        $id or redirect('admin/albums');
        $album = $this->album_model->get_many_by("id",$id);
        $album= $album[0];
        $this->template
        ->set('album', $album)
        ->build('admin/create_image');
    }
	
	public function create_video($id = null) {
        $id or redirect('admin/albums');
        $album = $this->album_model->get_many_by("id",$id);
        $album = $album[0];
        $this->template
        ->set('album', $album)
        ->build('admin/create_video');
    }

    // -----------------------------------------------------------------

    public function store_image() {

            // Se carga la imagen
        $config['upload_path'] = './' . UPLOAD_PATH . '/albums';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2050;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
		
		$id = $this->input->post('id');
		
		if(isset($_POST['video']))
		{
			$post = (object) $this->input->post();
			$image = array(
                'video' => $post->video,
                'album_id' => $id,
                );
		}
		else
		{
			    // imagen uno
	        $img = $_FILES['image']['name'];
	        $image = array();
	        
	
	        if (!empty($img)) {
	            if ($this->upload->do_upload('image')) {
	                $datos = array('upload_data' => $this->upload->data());
	                $path = UPLOAD_PATH . 'albums/' . $datos['upload_data']['file_name'];
	                $image = array(
	                    'album_id' => $id,
	                    'path' => $path
	                    );
	            } else {
	                $this->session->set_flashdata('error', $this->upload->display_errors());
	                redirect('admin/albums/images/'.$id);
	            }
	        }
		}
        

            // Se inserta en la base de datos
        if ($this->album_image_model->insert($image)) {
            $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
            redirect('admin/albums/images/'.$id);
        } else {
            $this->session->set_flashdata('error', lang('galeria:error_message'));
            redirect('admin/albums/create_image/'.$id);
        }
    }

    // -----------------------------------------------------------------

    public function destroy_image($id = null,$album_id = null) {
        $id or redirect('admin/albums');
        $album_id or redirect('admin/albums');
        $obj = $this->album_image_model->get_many_by('id',$id);
        $obj = $obj[0];
        if ($this->album_image_model->delete($id)) {
            @unlink($obj->path); // Eliminamos archivo existente
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/albums/images/'.$album_id);
    }

}