<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Brayan Acebo
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('gallery');
        $this->template
        ->append_js('module::developer.js')
        ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $this->load->model(array('gallery_model', 'gallery_intro_model'));
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación
        $pagination = create_pagination('admin/gallery/index', $this->gallery_model->count_all(), 10);

        $gallery = $this->gallery_model
        ->order_by('id', 'DESC')
        ->limit($pagination['limit'], $pagination['offset'])
        ->get_all();

        // Intro
        $in = $this->gallery_intro_model->get_all();
        $intro = array();

        if (count($in) > 0) {
            $intro = $in[0];
        }

        $this->template
        ->set('pagination', $pagination)
        ->set('gallery', $gallery)
        ->set('intro', $intro)
        ->build('admin/index');
    }

    // -----------------------------------------------------------------

    public function new_gallery() {
        $this->template->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function create_gallery() {

        $this->form_validation->set_rules('type', 'Tipo', 'required');

        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();


            $data = array(
                'type' => $post->type
                );

            if ($post->type == 1) {
                $config['upload_path'] = './' . UPLOAD_PATH . '/gallery';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 2050;
                $config['max_width'] = 1000;
                $config['max_height'] = 700;
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                // imagen
                $img = $_FILES['content']['name'];

                if (!empty($img)) {
                    if ($this->upload->do_upload('content')) {
                        $datos = array('upload_data' => $this->upload->data());
                        $path = UPLOAD_PATH . 'gallery/' . $datos['upload_data']['file_name'];
                        $img = array(
                            'title' => $post->title,
                            'content' => $path
                            );
                        $data = array_merge($data, $img);
                    } else {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('admin/gallery/new_gallery');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No ha seleccionado un archivo');
                    redirect('admin/gallery/new_gallery');
                }
            } else {

                // video
                $video = $post->video;

                if (!empty($video)) {
                    $_video = array('content' => $video);
                    $data = array_merge($data, $_video);
                } else {
                    $this->session->set_flashdata('error', 'Debe pegar el html del reproductor del video');
                    redirect('admin/gallery/new_gallery');
                }
            }

            if ($this->gallery_model->insert($data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/gallery');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/gallery/new_gallery');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/gallery/new_gallery');
        }
    }

    // -----------------------------------------------------------------

    public function delete_gallery($id = null) {

        $id or redirect('admin/gallery/');

        $obj = $this->db->where('id', $id)->get('gallery')->row();

        if ($this->gallery_model->delete($id)) {
            @unlink($obj->content);
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/gallery/');
    }

    /*
     * Actualizar Intro
     */

    public function update_intro() {
        $this->form_validation->set_rules('content', 'Texto', 'required');
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();
            $data = array(
                'text' => html_entity_decode($post->content)
                );
            if ($this->gallery_intro_model->update($post->id, $data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/gallery#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/gallery#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/gallery#page-intro');
        }
    }

}