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
        if(isset($_SESSION['admin'])){
            header('Location: /admin');
        }
        if(isset($_SESSION['user'])){
            header('Location: /user/profile');
        }
        $this->render('login', ['title' => 'Login']);
    }

    public function Signin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email == 'admin@admin.ma' && $password == 'admin') {
            $_SESSION['admin'] = true;
            header('Location: /admin');
        }

        $user = $this->userModel->getUserbyEmail($email);

        if (!$user) {
            $this->render('login', [
                'title' => 'Login',
                'error' => [
                    'email' => 'Email not found'
                ]
            ]);
        } else {
            if ($password == $user['password']) {
                $_SESSION['user'] = $user;
                header('Location: /user/profile');
            } else {
                $this->render('login', [
                    'title' => 'Login',
                    'input' => [
                        'email' => $email
                    ],
                    'error' => [
                        'password' => 'Password incorrect'
                    ]
                ]);
            }
        }
    }
}
