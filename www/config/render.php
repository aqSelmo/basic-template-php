<?php
namespace Template\Guilherme\Config;

class Render {
    public static function view($fileName = "home/dashboard", $args = []) {
        foreach($args as $key => $value) {
            $$key = $value;
        }

        require_once __DIR__ . DIRECTORY_SEPARATOR . "../view/$fileName.php";
    }
}