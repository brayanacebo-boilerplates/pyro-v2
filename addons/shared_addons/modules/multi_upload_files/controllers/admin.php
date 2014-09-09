<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Luis Fernando Salazar
 * 
 * Note: tiene que estar activo en el php.ini para leer esta funcion de php exif_read_data
 * 	1   extension=php_mbstring.dll
	2   extension=php_exif.dll
 */

// Ajustamos Zona Horaria
date_default_timezone_set("America/Bogota");

class Admin extends Admin_Controller {

	var $moduleName = 'multi_upload_files';
	var $anchoMax = 1920;
	var $altoMax = 1080;
	var $tiposArchivos = 'gif|jpg|jpeg|png|doc|docx|txt|pdf|xls|xlsx';
	
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('multi_upload_files');
        $this->template
        ->append_js('module::admin/developer.js')
        ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $models = array(
            "multi_upload_file_model",
            "multi_upload_file_category_model",
            "multi_upload_file_intro_model"
            );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index()
    {

        // Consultamos las categorias
        $categories = $this->multi_upload_file_category_model
        ->order_by('id', 'DESC')
        ->get_all();
		
        foreach ($categories as $key => $value) {
            $parent = $value->parent;
            if($parent != 0){
                $parent_name = $this->multi_upload_file_category_model->get($parent)->title;
                if($parent_name != "") {
                    $categories[$key]->parent_name = $parent_name;
                }
            } else {
                $categories[$key]->parent_name = "";
            }
        }

        // Intro
        $in = $this->multi_upload_file_intro_model->get_all();
        $intro = array();

        if (count($in) > 0) {
            $intro = $in[0];
        }
		
		// categorias con sortable (se consultan con un orden)
		$structure_categories = $this->multi_upload_file_category_model
        ->order_by('position', 'ASC')
        ->get_all();
		//var_dump($structure_categories);
		$structure_categories = $this->build_categories($structure_categories,'multi_upload_files', 0, true, null);
		
        $this->template
        ->append_js('module::admin/ajax.js')
        ->set('categories', $categories)
        ->set('intro', $intro)
		->set('structure_categories', $structure_categories)
        ->build('admin/index');
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

            if ($this->multi_upload_file_category_model->update($idRegistro, $data))
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
        $categories = $this->multi_upload_file_category_model->order_by('id', 'ASC')->get_all();
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

            if ($this->multi_upload_file_category_model->insert($data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/multi_upload_files/#page-structure-categories');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/multi_upload_files/create_category');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/multi_upload_files/create_category');
        }
    }

    // -----------------------------------------------------------------

    public function destroy_category($id = null)
	{
        $id or redirect('admin/multi_upload_files#page-categories');
        if ($this->multi_upload_file_category_model->delete($id)) {
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
			
			// borramos la carpeta de anexos del proceso
			$carpetaABorrar = $this->multi_upload_file_model->dirProyect.'uploads/default/'.$this->moduleName.'/'.$id.'/';
			$this->multi_upload_file_model->borrarCarpeta($carpetaABorrar);
        }
		else
		{
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/multi_upload_files/#page-structure-categories');
		
    }

    // --------------------------------------------------------------------------------------

    public function edit_category($id = null) {
        $category = $this->multi_upload_file_category_model->get($id);
        $categories = $this->multi_upload_file_category_model->order_by('id', 'ASC')->get_all();
		
		// si la carpeta existe cargamos los datos
		$existeCarpeta = $this->multi_upload_file_model->dirProyect.'uploads/default/'.$this->moduleName.'/'.$id.'/';
		$archivosAdjuntos = '';
		if(file_exists($existeCarpeta))
		{
			// mandamos los adjuntos
			$archivosArray = scandir('./uploads/default/'.$this->moduleName.'/'.$id.'/');
			$archivosArray = $this->multi_upload_file_model->filtrarSoloArchivosCarpeta($archivosArray);
			$archivosAdjuntos = $archivosArray;
		}
		
        $this->template
        ->append_css('module::dropzone.css')
		->append_css('module::photobox.css')
		->append_css('module::module_css.css')
        ->append_js('module::admin/dropzone.min.js')
		->append_js('module::admin/photobox.min.js')
		->append_js('module::admin/files.js')
		->set('archivosAdjuntos', $archivosAdjuntos)
        ->set('categories', $categories)
        ->set('category', $category)
		->set('moduleName', $this->moduleName)
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

            if ($this->multi_upload_file_category_model->update($post->id,$data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/multi_upload_files/#page-structure-categories');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/multi_upload_files/create_category');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/multi_upload_files/create_category');
        }
    }

	public function upload_file($idCategory)
	{
		$statusJson = "";
		$msgJson = "";
		$file_element_name = 'file';
		$this->multi_upload_file_model->crearCarpeta($this->moduleName, $idCategory, true);
	   	if ($statusJson != "error")
	   	{
	      	//$configArchivo['upload_path'] = './anexos/procesos/'.$idCategory.'/';
	      	$configArchivo['upload_path'] = './' . UPLOAD_PATH . '/multi_upload_files/'.$idCategory.'/';
	      	$configArchivo['allowed_types'] = $this->tiposArchivos;
	      	$configArchivo['max_size']  = 5120;
	     	$configArchivo['encrypt_name'] = FALSE;

	      	$this->load->library('upload', $configArchivo);
            $archivosAdjuntos = $_FILES;
            $cpt = count($_FILES[$file_element_name]['name']);
            for($i=0; $i<$cpt; $i++)
            {
        		// cambiamos la extensión del archivo por minúsculas
        		$nombreArchivo = $archivosAdjuntos[$file_element_name]['name'][$i];
				$trozos = explode(".", $nombreArchivo); 
				$extension = end($trozos);
				$extension = strtolower($extension);
				$nombreArchivo = substr($nombreArchivo, 0, strlen($nombreArchivo) - strlen($extension)).$extension;
        		
                $_FILES[$file_element_name]['name']= $nombreArchivo;
                $_FILES[$file_element_name]['type']= $archivosAdjuntos[$file_element_name]['type'][$i];
                $_FILES[$file_element_name]['tmp_name']= $archivosAdjuntos[$file_element_name]['tmp_name'][$i];
                $_FILES[$file_element_name]['error']= $archivosAdjuntos[$file_element_name]['error'][$i];
                $_FILES[$file_element_name]['size']= $archivosAdjuntos[$file_element_name]['size'][$i];
                
                if (!$this->upload->do_upload($file_element_name))
                {
                   	//$msg = $this->upload->display_errors('', '');
				   	if($statusJson != 'error')
					{
	                    $statusJson = "error";
	                    $msgJson = "error al subir los siguientes archivos por favor intentalo de nuevo: ";
					}
				   $msgJson .= ' ('.$_FILES[$file_element_name]['name'].'),';
                }
                else
                {
                    $datosArchivo = $this->upload->data();
                    if($datosArchivo['is_image'])
                    {
                    	if($datosArchivo['image_type'] == 'jpeg')
						{
							$datosImagen = exif_read_data($datosArchivo['full_path']);
						}
                        if($datosArchivo['image_width'] > $this->anchoMax || $datosArchivo['image_height'] > $this->altoMax)
                        {
                            $this->multi_upload_file_model->img_resize($datosArchivo, $this->anchoMax, $this->altoMax, 'procesos', $idCategory);
                            unlink($data['full_path']);
							$archivosAdjunto = $this->multi_upload_file_model->dirProyect.'uploads/default/'.$this->moduleName.'/'.$id.'/'.$datosArchivo['raw_name'].'_resize'.$datosArchivo['file_ext'];
                            if(file_exists($archivosAdjunto))
                            {
                                $nuevo_nombre = $this->multi_upload_file_model->renombrarArchivo($this->moduleName, $idCategory, $datosArchivo['raw_name'].'_resize'.$datosArchivo['file_ext'], $datosArchivo['raw_name']);
                            }
						}
						$this->multi_upload_file_model->crear_miniatura($datosArchivo);
						// si la imagen fue tomada con un celular, tablet o cámara digital, usamos la información EXIF para rotarla, pues dicha información se pierde
						// cuando rotamos o dimensionamos las imagenes usando las funciones nativas de codeignitter.
						// Nota: la información EXIF es usada por los celulares, tables, cámaras, windows y macOS para mostrar al derecho las imagenes que fueron tomadas
						// rotando la cámara.
						if($datosArchivo['image_type'] == 'jpeg')
						{
							if(isset($datosImagen['Orientation']))
							{
								$orientacionImagen = 0;
								switch ($datosImagen['Orientation'])
								{
									case 3:
										$orientacionImagen = 180;
										break;
									case 6:
										$orientacionImagen = 270;
										break;
									case 8:
										$orientacionImagen = 90;
										break;
								}
								if($orientacionImagen > 0)
								{
									$this->multi_upload_file_model->rotar_imagen($this->moduleName, $idCategory, $datosArchivo['file_name'], $orientacionImagen);
								}
							}
						}
                    }
                    if($statusJson != 'error')
					{
                        $statusJson = "success";
                        $msgJson = "Archivo cargado con éxito.";
					}
                }
            }
            @unlink($_FILES[$file_element_name]);
		}
	   	//echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
	}
	
	public function files($idRegistro)
	{
	   	//$files = $this->multi_upload_file_model->get_files();
	   	$archivoAdjunto = scandir('./uploads/default/'.$this->moduleName.'/'.$idRegistro.'/');
		$archivoAdjunto = $this->multi_upload_file_model->filtrarSoloArchivosCarpeta($archivoAdjunto);
		$category['id'] = $idRegistro;
		$this->template->set_layout(FALSE)
				->set('archivosAdjuntos', $archivoAdjunto)
				->set('category', (object)$category)
				->set('moduleName', $this->moduleName)
				->build('admin/files_ajax');
	}
	
	public function renombrarArchivo($id)
	{
		$nombreOrig = $_POST['nomfile'];
		$nuevoNombre = $_POST['newname'];
		$nuevoNombre = trim($nuevoNombre);
		$nuevoNombre = str_replace('%20', '', $nuevoNombre);  // los espacios cuando llegan llegan con %20 entonces se los quitamos asi
		$extensionArchivo = $this->multi_upload_file_model->extensionArchivo($nombreOrig);
		$statusJson = "";
		$msgJson = "";
		$nuevo_nombre = "";
		$archivoAdjunto = $this->multi_upload_file_model->dirProyect.'uploads/default/'.$this->moduleName.'/'.$id.'/'.$nuevoNombre.'.'.$extensionArchivo;
		if(!file_exists($archivoAdjunto))
		{
			if(!empty($nuevoNombre))
			{
				$nuevo_nombre = $this->multi_upload_file_model->renombrarArchivo($this->moduleName, $id, $nombreOrig, $nuevoNombre, true);
				$statusJson = "success";
            	$msgJson = "El archivo fue renombrado correctamente.";
			}
			else
	        {
	            $statusJson = "error";
	            $msgJson = "Por favor digite un nombre.";
	        }
		}
        else
        {
            $statusJson = "error";
            $msgJson = "El nombre digitado ya existe.";
        }
		if($nuevo_nombre != "")
		{
			echo json_encode(array('status' => $statusJson, 'msg' => $msgJson, 'nombre' => $nuevo_nombre));
		}
		else {
			echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
		}
	}
	
	public function rotate_file($nomfile, $idcarpeta)
	{
		$rotate = $this->multi_upload_file_model->rotar_imagen($this->moduleName, $idcarpeta, $nomfile, '270');
		$statusJson = 'success';
		$msgJson = 'Archivo rotado con éxito.';
	   	echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
	}
	
	public function delete_file($idcarpeta)
	{
		$nomfile = $_POST['nomfile'];
	   	if ($this->multi_upload_file_model->delete_file($this->moduleName, $idcarpeta, $nomfile))
	   	{
	      	$statusJson = 'success';
	      	$msgJson = 'Archivo borrado con éxito.';
	   	}
	   	else
	   	{
	      	$statusJson = 'error';
	      	$msgJson = 'Ocurrio un error por favor inténtelo de nuevo';
	   	}
	   	echo json_encode(array('status' => $statusJson, 'msg' => $msgJson));
	}
	
    /*
     * Archivos
     */

    public function create() {
        $categories = $this->multi_upload_file_category_model->order_by('id', 'ASC')->get_all();
        $this->template
        ->set('categories', $categories)
        ->build('admin/create');
    }

    // -----------------------------------------------------------------

    public function store() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias');
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
            $config['upload_path'] = './' . UPLOAD_PATH . '/multi_upload_files';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'multi_upload_files/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/multi_upload_files/');
                }
            }

            // Se inserta en la base de datos
            if ($this->multi_upload_file_model->insert($data)) {

                $multi_upload_fileId = $this->db->insert_id();
                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'multi_upload_file_id' => $multi_upload_fileId,
                        'category_id' => $categories[$i]
                        );
                    $this->db->insert($this->db->dbprefix.'multi_upload_files_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/multi_upload_files');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/multi_upload_files/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/multi_upload_files/create');
        }
    }

    // -----------------------------------------------------------------

    public function destroy($id = null) {
        $id or redirect('admin/multi_upload_files');
        $obj = $this->db->where('id', $id)->get($this->db->dbprefix.'multi_upload_files')->row();
        if ($this->multi_upload_file_model->delete($id)) {
            @unlink($obj->image); // Eliminamos archivo existente
            $this->db->delete($this->db->dbprefix.'multi_upload_files_categories', array('multi_upload_file_id' => $id)); // Eliminaos relación pro cat
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/multi_upload_files');
    }

    // --------------------------------------------------------------------------------------

    public function edit($id = null) {
        $id or redirect('admin/multi_upload_files');
        $multi_upload_file = $this->multi_upload_file_model->get($id);
        $categories = $this->multi_upload_file_category_model->order_by('id', 'ASC')->get_all();

        $return = $this->db->where('multi_upload_file_id',$id)->get('multi_upload_files_categories')->result();
        $selected_category = array();

        foreach ($return as $item) {
            $selected_category[] = $item->category_id;
        }

        $this->template
        ->set('categories', $categories)
        ->set('selected_category', $selected_category)
        ->set('multi_upload_file', $multi_upload_file)
        ->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function update() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias');
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
            $config['upload_path'] = './' . UPLOAD_PATH . '/multi_upload_files';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'multi_upload_files/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->where('id', $post->id)->get('multi_upload_files')->row();
                    @unlink($obj->image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/multi_upload_files/');
                }
            }

            // Se inserta en la base de datos
            if ($this->multi_upload_file_model->update($post->id,$data)) {

                $this->db->delete($this->db->dbprefix.'multi_upload_files_categories', array('multi_upload_file_id' => $post->id)); // Eliminaos relación pro cat

                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'multi_upload_file_id' => $post->id,
                        'category_id' => $categories[$i]
                        );
                    $this->db->insert($this->db->dbprefix.'multi_upload_files_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/multi_upload_files');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/multi_upload_files/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/multi_upload_files/create');
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
            if ($this->multi_upload_file_intro_model->update($post->id, $data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/multi_upload_files#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/multi_upload_files#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/multi_upload_files#page-intro');
        }
    }
}