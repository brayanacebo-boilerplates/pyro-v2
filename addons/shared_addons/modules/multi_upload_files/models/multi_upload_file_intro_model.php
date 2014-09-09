<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author  Luis Fernando Salazar
 */
class multi_upload_file_Intro_Model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->_table = $this->db->dbprefix . 'multi_upload_files_intro';
    }

}