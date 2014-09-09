<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Module_Work_With_Us extends Module
{
    public $version = '1.0';
    public function info()
	{
        return array(
            'name' => array(
                'es' => 'Trabaja con nosotros',
                'en' => 'Work with us'
            ),
            'description' => array(
                'es' => 'Modulo de envio de hojas de vida © Brayan Acebo, Luis Fernando Salazar',
                'en' => 'Work with us ©  Brayan Acebo, Luis fernando Salazar'
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
        );
    }
    public function install()
	{
        $this->dbforge->drop_table('work_with_us');
        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => true
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'text' => array(
                'type' => 'TEXT',
                'null' => true
            ),
            'other_info' => array(
				'type' => 'TEXT',
				'null' => true
            )
        );
        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);
		
		$this->dbforge->create_table('work_with_us') AND is_dir($this->upload_path . 'work_with_us') OR @mkdir($this->upload_path . 'work_with_us', 0777, TRUE);
		$data = array(			
			'id' => '1',        
		);        
		
		$this->db->insert('work_with_us', $data);	
		
		$this->dbforge->drop_table('work_with_us_emails');
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
			'file' => array(                
				'type' => 'VARCHAR',                
				'constraint' => '455',                
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
        if (!$this->dbforge->create_table('work_with_us_emails'))
        {
            return false;
        }
		
        return true;
    }
	
    public function uninstall() {
        $this->dbforge->drop_table('work_with_us');
		$this->dbforge->drop_table('work_with_us_emails');
        return true;
    }
    public function upgrade($old_version)
	{
        return true;
    }
    public function help()
	{
        return "Módulo destinado administrar la información de las hojas de vida que mandan los trabajadores";
    }
}
?>