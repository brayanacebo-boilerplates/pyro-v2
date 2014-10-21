<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_albums extends Module {

    public $version = '1.2';
    public $mainTable = 'albums';
    public $imageTable = 'album_images';

    public function info() {
        return array(
            'name' => array(
                'en' => 'albums',
                'es' => 'albumes'
            ),
            'description' => array(
                'en' => 'Albumes @Brayan Acebo 2014',
                'es' => 'Albumes @Brayan Acebo 2014',
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content'
        );
    }

    public function install() {

        /* Creación del directorio para carga de imagenes */
        @mkdir($this->upload_path . $this->mainTable, 0777, TRUE);

        // Creando tabla de albunes
        $this->dbforge->drop_table($this->mainTable);

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'constraint' => '',
                'null' => false
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'constraint' => '',
                'null' => false
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

        if (!$this->dbforge->create_table($this->mainTable)) {
            return false;
        }

        // Creando tabla para multiples imagenes
        $this->dbforge->drop_table($this->imageTable);

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'album_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            ),
            'path' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'constraint' => '',
                'null' => false
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

        if (!$this->dbforge->create_table($this->imageTable)) {
            return false;
        }

        // Final
        return true;
    }

    public function uninstall() {
        $this->dbforge->drop_table($this->mainTable);
        $this->dbforge->drop_table($this->imageTable);
        @rmdir($this->upload_path.$this->mainTable);
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Modulo de albumes con multiples imagenes";
    }

}
/* Fin del archivo details.php */