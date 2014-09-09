<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_multi_upload_files extends Module {

    public $version = '1.2';
    public $mainTable = 'multi_upload_files';
    public $chilTable = 'multi_upload_file_categories';
    public $relationship = 'multi_upload_files_categories';
    public $intro = 'multi_upload_files_intro';

    public function info()
	{
        return array(
            'name' => array(
                'en' => 'Upload Files',
                'es' => 'Cargar Archivos'
            ),
            'description' => array(
                'en' => 'Upload Files © Luis Fernando Salazar 2014',
                'es' => 'Archivos © Luis Fernando Salazar 2014',
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content'
        );
    }

    public function install() {

        /* Creación del directorio para carga de imagenes */
        @mkdir($this->upload_path . $this->mainTable, 0777, TRUE);

        /* Creación de tabla para las categorias */
        $this->dbforge->drop_table($this->chilTable);

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'title' =>  array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ),
            'position' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => true
            ),
            'parent' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false
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

        if (!$this->dbforge->create_table($this->chilTable)) {
            return false;
        }

       

        // Tabla para introducción de la sección

        $this->dbforge->drop_table($this->intro);

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

        if (!$this->dbforge->create_table($this->intro)) {
            return false;
        }

        $data = array(
            'text' => ''
        );

        $this->db->insert($this->intro, $data);

        // Tabla para introducción de la sección

        $this->dbforge->drop_table($this->relationship);

        $field = array(
            'multi_upload_file_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            )
        );

        $this->dbforge->add_field($field);

        if (!$this->dbforge->create_table($this->relationship)) {
            return false;
        }

        // Final
        return true;
    }

    public function uninstall() {
        $this->dbforge->drop_table($this->chilTable);
        $this->dbforge->drop_table($this->relationship);
        $this->dbforge->drop_table($this->intro);
        @rmdir($this->upload_path.$this->mainTable);
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Modulo de Archivos con arbol de categorias <br/>
        		- Categorias en arbol con opción de sortable.
				- texto de introducción
				- Multicarga de archivos visual con barra
				- orden de los archivos responsive y adaptable
				- creación de thumbs para las imagenes (Las cuales si la imagen es larga o muy ancha se vería mal, pero esta funcionalidad corta 100 x 100 en el centro para que la imagen no pierda proporción)
				- si la imagen es muy grande, le cambia el tamaño y la pone un poco mas pequeña proporcionalmente
				- si la imagen es tomada desde un celular normalmente salen de lado, el toma la Orientation de la imagen para acomodarla y que no salga de lado.
				- opción para renombrar los archivos
				- rotación de imagenes
				- eliminar imagenes
				- vista preliminar de las imagenes, o descarga de los archivos (si son archivos, una imagen que muestra que tipo de archivo es)
				- la vista preliminar detecta si es tactil, con temporizador para pasar imagenes, y muestra las demas imagenes (herramienta: photobox.js)
				- entre otras
				
				By Luis Fernando Salazar Buitrago.";
    }

}
/* Fin del archivo details.php */