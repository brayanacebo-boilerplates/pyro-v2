<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Others_Conf extends Module
{

    public $version = '1.2';

    public function info() {
        return array(
            'name' => array(
                'es' => 'Otras configuraciones',
                'en' => 'Other configurations',
            ),
            'description' => array(
                'es' => 'Otras configuraciones como el logo. @Luis Fernando Salazar',
                'en' => 'Other configuration like logo @Luis Fernando Salazar',
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
        );
    }

    public function install()
    {
        // otras configuraciones
		$this->dbforge->drop_table('others_conf');

        $others_conf = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'logo' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
        );

        $this->dbforge->add_field($others_conf);
        $this->dbforge->add_key('id', true);

        $this->dbforge->create_table('others_conf') AND is_dir($this->upload_path . 'others_conf') OR @mkdir($this->upload_path . 'others_conf', 0777, TRUE);
		
		$data = array(
			'id' => '1',
            'logo' => '',
            'city' => ''
        );

        $this->db->insert('others_conf', $data);

        return TRUE;
    }

    public function uninstall() {
        $this->dbforge->drop_table('others_conf');
        @rmdir(site_url($this->upload_path . 'others_conf'));
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Pagina inicial del sitio desarrollada a la medida.";
    }

}
