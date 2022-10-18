<?php 

namespace app\libraris;

/*
Base Controller
Responsible for loading views and models
*/

class Controller {

    // Load Model
    public function model($model){
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate the model
        return new $model();
    }
    
    // Load View
    public function view($view, $data = []){
        // chcek for the view file

        foreach($data as $key => $value) {
            $$key = $value;
        }

        if (file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exists
            die ('View does not exists');
        }
    }
}

?>