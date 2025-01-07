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
            header('Location: /admin/home');
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
                $_SESSION['user'] = $user;
                header('Location: /user/profile');
            }else{
                $this->render('login', [
                    'title' => 'Login',
                    'input' => [
                        'email' => $email
                    ],
                    'error' => [
                        'password' => 'Password incorrect'
                    ]]);
            }
        }

    }
}
