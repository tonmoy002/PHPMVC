<?php 

namespace app\libraris;

/*
Core Class for application
URL FORMAT - /controller/method/params
*/

class Core {

    protected $currentController = 'Site';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this -> getUrl();
        
        if (file_exists('../app/controllers/'. ucwords($url[0]) .'.php')){
            // if exists, set as controller
            $this -> currentController = ucwords($url[0]);
            // Unset 0 index
            unset($url[0]);
        }

        require_once '../app/controllers/'. $this->currentController . '.php';
        // Instantiate controller class
        $this -> currentController = new $this->currentController;

        // Check for second part of url
        if (isset($url[1])){
            // check to see if method exists in controller
            if (method_exists($this -> currentController, $url[1])){
                // if exists, set as method
                $this->currentMethod = $url[1]; 
                // unset 1 index
                unset($url[1]);
            }
        }

        // get Params
        $this -> params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this -> currentController, $this -> currentMethod], $this -> params);

    }

    public function getUrl(){

        if (isset($_SERVER['PATH_INFO'])){
            $url = rtrim($_SERVER['PATH_INFO'],'/');
            $url = ltrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }else{
            $url[0] = $this->currentController;
            return $url;
        }

        
    }

}

?>