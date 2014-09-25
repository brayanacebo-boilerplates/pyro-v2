<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Profile extends Module
{

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'es' => 'Perfil del administrador',
                'en' => 'Administrator Profile',
            ),
            'description' => array(
                'es' => '@BrayanAcebo: Modulo basico para la configuración del perfil por parte del admin',
                'en' => '@BrayanAcebo: Basic module for configuring the profile of admin',
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
        );
    }

    public function install() {
        $dir = $this->upload_path . 'profile';
        if (!is_dir($dir)) {
            @mkdir($dir, '0777');
            chmod($dir, '0777');
        }
        return true;
    }

    public function uninstall() {
        @rmdir($this->upload_path . 'profile');
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Página de contenido, (texto e imagen) con párrafo introductorio y zona inferior delimitada para 3 campos de destacados administrables.";
    }

}
