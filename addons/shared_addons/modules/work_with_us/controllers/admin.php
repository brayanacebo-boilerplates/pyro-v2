<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author Christian España
 */
class Admin extends Admin_Controller {
    public function __construct() {
        parent::__construct();
        $this->lang->load('language');
        $this->load->library('form_validation');
        $this->template
             ->append_js('module::developer.js')
             ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $this->load->model(array('work_with_us_m', 'work_with_us_emails_m'));
    }
    /**
     * List all domains
     */
    public function index() {
        $result = $this->work_with_us_m->get_all();
		
        $funcion = 'create';
        $post = array();
        if (count($result) > 0) {
            $funcion = 'edit';
            $post = $result[0];
        }
		
		$pagination = create_pagination('admin/work_with_us/index/', $this->work_with_us_emails_m->count_all(), 10);
		$work_with_us_emails = $this->work_with_us_emails_m->limit($pagination['limit'], $pagination['offset'])->get_all();
		
        $this->template->set('funcion', $funcion)
                ->set('data', $post)
				->set('data2', $work_with_us_emails)
				->set('pagination', $pagination)
                ->build('admin/work_with_us_back');
    }
    public function edit()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'text' => html_entity_decode($this->input->post('text')),
			'email' => $this->input->post('email'),
            'other_info' =>  html_entity_decode($this->input->post('map')),
        );				
		$config['upload_path'] = './' . UPLOAD_PATH . '/work_with_us';		
		$config['allowed_types'] = 'gif|jpg|png|jpeg';		
		$config['max_size'] = 2050;		$config['encrypt_name'] = true;		
		$this->load->library('upload', $config);		
			
		$img = $_FILES['image']['name'];		
		if (!empty($img)) 
		{			
			if ($this->upload->do_upload('image'))
			{				
				$datos = array('upload_data' => $this->upload->data());				
				$path = UPLOAD_PATH . 'work_with_us/' . $datos['upload_data']['file_name'];				
				$img = array('image' => $path);				
				$data = array_merge($data, $img);				
				$obj = $this->db->where('id', '1')->get('work_with_us')->row();				
				@unlink($obj->image);			
			} 
			else 
			{				
				$this->session->set_flashdata('error', $this->upload->display_errors());				
				redirect('admin/work_with_us/');			
			}		
		}		
		
        if ($this->work_with_us_m->update_all($data)) {
            // insert ok, so
            $this->session->set_flashdata('success', lang('work_with_us:success_message'));
            redirect('admin/work_with_us/');
        } else {
            $this->session->set_flashdata('error', lang('work_with_us:error_message'));
            redirect('admin/work_with_us/');
        }
        $this->template->set('funcion', 'edit')
                ->build('admin/work_with_us_back');
    }
}