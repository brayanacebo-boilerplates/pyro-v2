<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Tools extends Module
{

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'es' => 'Herramientas de Maquetación',
                'en' => 'Tools',
            ),
            'description' => array(
                'es' => 'Herramientas de Maquetación © Adrian Rodriguez',
                'en' => 'Layout Tools © Adrian Rodriguez',
            ),
            'frontend' => false,
            'backend' => true,
            'menu' => 'content',
        );
    }

    public function install() {

        $dir = $this->upload_path . 'tools';

        if (!is_dir($dir)) {
            @mkdir($dir, '0777');
            chmod($dir, '0777');
        }

        return true;
    }

    public function uninstall() {
        @rmdir($this->upload_path . 'tools');
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Este modulo fue creado como repositorio de herramientas que serian útiles al momento de desarrollar.";
    }

}
