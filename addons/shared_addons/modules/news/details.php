<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_news extends Module {

    public $version = '1.2';

    public function info() {
        return array(
            'name' => array(
                'en' => 'News with comments',
                'es' => 'Noticias con comentarios',
            ),
            'description' => array(
                'en' => 'This is a module of news © Brayan Acebo, Luis Salazar',
                'es' => 'Modulo de Noticias © Brayan Acebo, Luis Salazar',
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content',
        );
    }

    public function install() {
		
		/* Creación de tabla para los comentarios */
        $this->dbforge->drop_table('news_comments');

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'id_new' =>  array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => true
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'comment' => array(
                'type' => 'TEXT',
                'constraint' => '',
                'null' => true
            ),
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

        if (!$this->dbforge->create_table('news_comments')) {
            return false;
        }
		
        $this->dbforge->drop_table('news');

        $news = array(
            'id' => array('type' => 'INT', 'constraint' => '11', 'auto_increment' => TRUE),
            'title' => array('type' => 'TEXT', 'constraint' => '', 'null' => true),
            'slug' => array('type' => 'VARCHAR', 'constraint' => '455', 'null' => true),
			'autor' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => true),
            'image' => array('type' => 'TEXT', 'constraint' => '0', 'null' => true),
            'content' => array('type' => 'TEXT', 'constraint' => '', 'null' => true),
            'introduction' => array('type' => 'TEXT', 'constraint' => '', 'null' => true),
            'date' => array('type' => 'DATETIME', 'constraint' => '', 'null' => true),
            'position' => array('type' => 'INT', 'constraint' => '11', 'null' => true),
			'outstanding' => array('type' => 'INT', 'constraint' => '1', 'null' => true)
        );

        $this->dbforge->add_field($news);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('news') AND
                is_dir($this->upload_path . 'news') OR @mkdir($this->upload_path . 'news', 0777, TRUE)) {
            return TRUE;
        }
    }

    public function uninstall() {
        //Codigo para la desinstalacion del modulo
        $this->dbforge->drop_table('news');
		@rmdir($this->upload_path.'news');
        return TRUE;
    }

    public function upgrade($old_version) {
        // Su lógica de actualización
        return TRUE;
    }

    public function help() {
        // Retorna un string con información de ayuda
        return "
           <div style='height: 416px;background-image:url(https://lh4.googleusercontent.com/qon9bxaIQSgXlsnRADpd2HGi4CR7CBwc7MqC1d4TCg=w332-h207-p-no);background-size: 100%;'>
                  <div style='margin-left: 464px;font-size: 23px;color: #14D1F5;'>Modulo Sample</div>
                  <div style='width: 310px;font-size: 16px;margin-left: 392px;margin-top: 30px;'>Si tiene alguna sugerencia o inconveniente comuníquese con nuestros asesores</div>
           </div>
        ";
    }

}

/* Fin del archivo details.php */