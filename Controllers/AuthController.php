<?php

class AuthController extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function showLogin()
    {
        $this->render('login', ['title' => 'Login']);
    }

    public function Signin() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($email == 'admin@admin.ma' && $password == 'admin') {
            $this->render('admin/dashboard', ['title' => 'Dashboard']);
        }

        $user = $this->userModel->getUserbyEmail($email);

        if(!$user){
            $this->render('login', [
                'title' => 'Login',
                'error' => [
                    'email' => 'Email not found'
                ]]);
        }else{
            if(password_verify($password, $user['password'] )){
                $this->render('admin/dashboard', ['title' => 'Dashboard']);
            }else{
                $this->render('login', [
                    'title' => 'Login',
                    'error' => [
                        'password' => 'Password incorrect'
                    ]]);
            }
        }

    }
}
