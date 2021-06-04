<?php
namespace Template\Guilherme\Controller\Home;

use RedBeanPHP\R;
use Template\Guilherme\Config\Render;

class Dashboard {
    public function Index() { 
        Render::view("home/dashboard", array(
            "teste" => R::findAll("user", "SELECT * FROM users ")
        ));
    }
}