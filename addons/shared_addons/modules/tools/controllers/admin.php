<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @subpackage 	Tools Module
 * @category 	Modules
 * @license 	Apache License v2.2
 */
class Admin extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        // Si es necesario agregar mas JavaScript, lo puede meter en la carpeta js que se encuentra en este
        // modulo y agregarlo aqui para que lo incluya en la vista
        $this->template
        ->append_js('module::developer.js')
        ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
    }

    // ------------------------------------------------------------------------------------------

    public function index()
    {
        $this->template->build('admin/tools_back');
    }

}
