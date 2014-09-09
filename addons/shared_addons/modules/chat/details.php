<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Chat extends Module {

    public $version = '1.0';
    public $tb1 = "chat";
    public $tb2 = "chat_comments";

    public function info()
    {
        return array(
            'name' => array(
                'en' => 'Chat',
                'es' => 'Chat',
            ),
            'description' => array(
                'en' => 'This is a PyroCMS module Chat.',
                'es' => 'Este es un módulo de Chat en PyroCMS.',
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content', // You can also place modules in their top level menu. For example try: 'menu' => 'Sample',
            /*'sections' => array(
                'items' => array( //"items" will be the same in the Admin controller as protected $section filed
                    'name'  => 'sample:items', // These are translated from your language file
                    'uri'   => 'admin/sample',
                        'shortcuts' => array(
                            'create' => array(
                                'name'  => 'sample:create',
                                'uri'   => 'admin/sample/create',
                                'class' => 'add'
                                )
                            )
                        )
                )*/
        );
    }

    public function install()
    {
        $this->dbforge->drop_table($this->tb1);

        $columns_tb1 = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'session_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'created_at' => array(
                'type' => 'DATETIME', 
                'null' => true
            ),
        );

        $this->dbforge->add_field($columns_tb1);
        $this->dbforge->add_key('id', true);
        if ( ! $this->dbforge->create_table($this->tb1)){
            $this->uninstall();
            return false;
        }


        $this->dbforge->drop_table($this->tb2);

        $columns_tb2 = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'chat_id' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'show' => array(
                'type' => 'INT',
                'constraint' => '11',
                'default' => 0
            ),
            'comment' => array(
                'type' => 'VARCHAR',
                'constraint' => '500'
            ),
            'created_at' => array(
                'type' => 'DATETIME', 
                'null' => true
            ),
        );

        $this->dbforge->add_field($columns_tb2);
        $this->dbforge->add_key('id', true);
        if ( ! $this->dbforge->create_table($this->tb2)){
            $this->uninstall();
            return false;
        }

        // We made it!
        return true;
    }

    public function uninstall()
    {
        $this->dbforge->drop_table($this->tb1);
        $this->dbforge->drop_table($this->tb2);

        //$this->db->delete('settings', array('module' => 'sample'));

        // Put a check in to see if something failed, otherwise it worked
        return true;
    }


    public function upgrade($old_version)
    {
        // Your Upgrade Logic
        return true;
    }

    public function help()
    {
        // Return a string containing help info
        return "Here you can enter HTML with paragrpah tags or whatever you like";

        // or

        // You could include a file and return it here.
        return $this->load->view('help', null, true); // loads modules/sample/views/help.php
    }
}