<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author  Luis Fernando Salazar
 */
class multi_upload_file_Category_Model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->_table = $this->db->dbprefix . 'multi_upload_file_categories';
    }

}