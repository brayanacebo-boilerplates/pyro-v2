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
            "album_image_model"
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


        $this->template
        ->append_js('module::admin/ajax.js')
        ->set('pagination', $pagination)
        ->set('albums', $albums)
        ->build('admin/index');
    }

    /*
     * Albumes
     */

    public function create() {
        $this->template->build('admin/create');
    }

    // -----------------------------------------------------------------

    public function store() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'created_at' => date('Y-m-d H:i:s')
                );

            // Se inserta en la base de datos
            if ($this->album_model->insert($data)) {
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
        if ($this->album_model->delete($id)) {
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
        
        $this->template
        ->set('album', $album)
        ->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function update() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name)
                );

            // Se inserta en la base de datos
            if ($this->album_model->update($post->id,$data)) {
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

    // -----------------------------------------------------------------

    public function store_image() {

            // Se carga la imagen
        $config['upload_path'] = './' . UPLOAD_PATH . '/albums';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2050;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $id = $this->input->post('id');

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

public function destroy_image($id = null, $album_id = null) {
    $id or redirect('admin/albums');
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