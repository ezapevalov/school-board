<?php

class App {
    public static $_classInstance;
    public $config;
    public $url;
    public $controller;
    public $action;
    public $id;

    private function __construct() {
        $this->config = parse_ini_file(__DIR__.'/config.ini', true);

        $this->url = parse_url($_SERVER['REQUEST_URI']);
        $this->set_default_route();
        $path = explode('/', $this->url['path']);
        $this->routes($path);
        $this->set_autoload();
    }

    public function set_autoload() {
        spl_autoload_register(function ($class) {
            $path_parsed_from_name = __DIR__ . '/' . str_replace('_', '/', $class) . '.php';

            if ( file_exists($path_parsed_from_name) ) {
                require_once $path_parsed_from_name;
            }
        });
    }

    private function routes($path) {
        if ( isset($path[1]) && !empty($path[1]) ) {
            $this->controller = ucfirst($path[1]);

            if ( isset($path[2]) && !empty($path[2]) ) {
                $this->action = $path[2];

                if ( isset($path[3]) && !empty($path[3]) ) {
                    $this->id = $path[3];
                }
            }
        }
    }

    private function set_default_route() {
        $this->controller = 'Index';
        $this->action = 'index';
        $this->id = null;
    }

    public static function factory() {
        if ( self::$_classInstance === null ) {
            self::$_classInstance = new self();
        }

        return self::$_classInstance;
    }

    public function run() {
        $controller_name = 'Controller_'.$this->controller;
        $controller_class = new $controller_name();

        if ( !$controller_class ) {
            throw new Exception("[$this->controller] Controller initialization error");
        }

        $action_name = 'action_' . $this->action;

        if ( !method_exists($controller_class, $action_name) ) {
            throw new Exception("[$this->controller] Controller has no such action: [$this->action]");
        }

        ob_start();
        $controller_class->$action_name();
        $response = ob_get_contents();
        ob_end_clean();

        header('Content-Type: text/html; charset=utf-8');
        echo $response; exit;
    }
}

