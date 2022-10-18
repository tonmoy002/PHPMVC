<?php

use app\libraris\Controller;

class Site extends Controller{

    public function __construct(){
            
    }

    public function index() {
        $data = [
            'title' => SITENAME,
            'description' =>  'Simple social network built on the TraversyMVC PHP Framework.'
        ];

        
        $this -> view ('pages/index',$data);
    }
}

?>