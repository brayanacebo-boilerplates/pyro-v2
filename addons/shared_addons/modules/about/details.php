<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_About extends Module
{

    public $version = '2.0';

    public function info() {
        return array(
            'name' => array(
                'es' => 'Sobre Nosotros',
                'en' => 'About Us',
            ),
            'description' => array(
                'es' => 'Sobre Nosotros @Brayan Acebo',
                'en' => 'About Us @Brayan Acebo',
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
        );
    }

    public function install() {

        $this->dbforge->drop_table('about');

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'video' => array(
                'type' => 'TEXT',
                'null' => true
            ),
            'text' => array(
                'type' => 'LONGTEXT',
                'null' => true
            ),
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

        if (!$this->dbforge->create_table('about')) {
            return false;
        }

        $data = array(
            'title' => '',
            'image' => '',
            'video' => '',
            'text' => '',
        );

        $this->db->insert('about', $data);

        $dir = $this->upload_path . 'about';

        if (!is_dir($dir)) {
            @mkdir($dir, '0777');
            chmod($dir, '0777');
        }

        return true;
    }

    public function uninstall() {
        $this->dbforge->drop_table('about');
        @rmdir($this->upload_path . 'about');
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Página de contenido, (texto e imagen) con párrafo introductorio.";
    }

}
