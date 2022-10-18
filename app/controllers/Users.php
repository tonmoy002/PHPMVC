<?php

use app\libraris\Controller;

class Users extends Controller {

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->login($email, $password);
            if($user != false) {
                $this->startSession($user);
            }else {
                echo "now pass";
            }
            exit;
        }

        $this->view("pages/login");
    }

    public function register() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $data = [
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "password" => $_POST['password'],
            ];

            $this->userModel->register($data);
        }

        $this->view("pages/register");
    }

    private function startSession($user) {
        $_SESSION['user_id'] = $user -> id;
        $_SESSION['user_email'] = $user -> email;
        $_SESSION['user_name'] = $user -> name;
        redirect('posts');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
}
?>