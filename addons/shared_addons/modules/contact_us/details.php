<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Module_Contact_Us extends Module {



    public $version = '1.0';



    public function info() {

        return array(

            'name' => array(

                'es' => 'Datos de Contacto',

                'en' => 'Contacts Data'

            ),

            'description' => array(

                'es' => 'Modulo información de contacto © Brayan Acebo, Luis Fernando Salazar, Christian España',

                'en' => 'Manage Info Data © Christian España , Brayan Acebo, Luis fernando Salazar'

            ),

            'frontend' => true,

            'backend' => true,

            'menu' => 'content',

        );

    }



    public function install() 
   {
        $this->dbforge->drop_table('contact_us');

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'facebook' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'twitter' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'linkedin' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'adress' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => true
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'map' => array(
                'type' => 'TEXT',
                'null' => true
            ),
             'schedule' => array(
                'type' => 'TEXT',
                'null' => true
            )
        );
		
		
		
        $this->dbforge->add_field($field);

        $this->dbforge->add_key('id', true);



        if (!$this->dbforge->create_table('contact_us')) {
            return false;
        }
		
		// creamos el primer registro
		$data = array(
            'id' => '',
        );

        $this->db->insert('contact_us', $data);
		
		$this->dbforge->drop_table('contact_us_emails');

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',

                'null' => true

            ),

            'email' => array(

                'type' => 'VARCHAR',

                'constraint' => '100',

                'null' => true

            ),

            'phone' => array(

                'type' => 'VARCHAR',

                'constraint' => '30',

                'null' => true

            ),

           'cell' => array(

                'type' => 'VARCHAR',

                'constraint' => '30',

                'null' => true

            ),

            'company' => array(

                'type' => 'VARCHAR',

                'constraint' => '100',

                'null' => true

            ),

            'city' => array(

                'type' => 'VARCHAR',

                'constraint' => '100',

                'null' => true

            ),

            'message' => array(

                'type' => 'VARCHAR',

                'constraint' => '455',

                'null' => true

            ),

        );



        $this->dbforge->add_field($field);

        $this->dbforge->add_key('id', true);



        if (!$this->dbforge->create_table('contact_us_emails'))

        {

            return false;

        }

		

        return true;

    }



    public function uninstall() {

        $this->dbforge->drop_table('contact_us');

		$this->dbforge->drop_table('contact_us_emails');

        return true;

    }



    public function upgrade($old_version) {

        return true;

    }



    public function help() {

        return "Módulo destinado administrar la información de contacto";

    }



}