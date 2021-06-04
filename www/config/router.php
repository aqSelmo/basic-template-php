<?php

namespace Template\Guilherme\Config;

use PDOException;
use RedBeanPHP\R;

class Router {
    private $url;
    private $path;
    private $controller;
    private $action;
    private $args;

    public function __construct(){
        $this->url = explode("/", $_SERVER['REQUEST_URI']);
        $this->path = ($this->url[1] ? filter_var($this->url[1], FILTER_SANITIZE_STRING) : "home");
        $this->controller = ($this->url[2] ? filter_var($this->url[2], FILTER_SANITIZE_STRING) : "dashboard");
        $this->action = ($this->url[3] ? filter_var($this->url[3], FILTER_SANITIZE_STRING) : "index");
        $this->args = ($this->url[4] ? filter_var($this->url[4], FILTER_SANITIZE_NUMBER_INT) : null);
    }

    public function init($prefix = "") {
        $controller = "Template\\Guilherme\\Controller\\" . ucfirst($this->path) . "\\" . ucfirst($this->controller);
        $action = ucfirst($this->action);

        if(class_exists($controller)) {
            if(method_exists($controller, $action)) {
                $route = new $controller();
                $route->$action($this->args);
            } else {
                die("MÉTODO INEXISTENTE");
            }
        } else {
#           die("CLASSE INEXISTENTE");
            header("Location: /home");
        }

        try {
            R::setup('mysql:host=database:3306;dbname=billshare_dev_db', 'mysql', '102030');
        } catch(PDOException $e){
            echo $e->getmessage();
        }
    }
}