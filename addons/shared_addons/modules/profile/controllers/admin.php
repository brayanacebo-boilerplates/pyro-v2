<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @subpackage 	profile
 * @category 	Modulos
 */
class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        // $this->template
        //         ->append_js('module::developer.js')
        //         ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        // $models = array('about_us_model');
        // $this->load->model($models);
    }

    // ------------------------------------------------------------------------------------------

    public function index()
    {
        $this->template
            // ->append_js('module::admin/ajax.js')
            // ->set('data', 'cualquier cosa')
            ->build('admin/index');
    }

    // ------------------------------------------------------------------------------------------

    public function advanced_form()
    {
        $this->template
             ->build('admin/advancedForm');
    }

    // ------------------------------------------------------------------------------------------

    public function products_list()
    {
        $this->template
             ->build('admin/productsList');
    }

}
