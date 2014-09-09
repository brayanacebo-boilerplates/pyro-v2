<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Gallery extends Module {

    public $version = '1.1';

    public function info() {
        return array(
            'name' => array(
                'es' => 'Galeria',
                'en' => 'Gallery'
            ),
            'description' => array(
                'es' => 'Modulo Galeria Simple © Brayan Acebo',
                'en' => 'Module Simple Gallery © Brayan Acebo'
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
        );
    }

    public function install() {

        /* Creación de tabla para las galeria */

        $this->dbforge->drop_table('gallery');

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => true
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

         if ($this->dbforge->create_table('gallery') AND
                is_dir($this->upload_path . 'gallery') OR @mkdir($this->upload_path . 'gallery', 0777, TRUE))

        // Tabla para introducción de la sección

        $this->dbforge->drop_table('gallery_intro');

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'text' => array(
                'type' => 'TEXT',
                'null' => true
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

        if (!$this->dbforge->create_table('gallery_intro')) {
            return false;
        }

        $data = array(
            'text' => ''
        );

        $this->db->insert('gallery_intro', $data);

        return true;
    }

    public function uninstall() {
        $this->dbforge->drop_table('gallery');
        @rmdir(UPLOADSFOLDER . 'gallery');
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Este modulo permite la publicación de una galería simple compuesta por imágenes y videos.";
    }

}