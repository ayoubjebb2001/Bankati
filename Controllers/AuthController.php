<?php

class AuthController extends BaseController
{

    public function showLogin()
    {
        $this->render('login', ['title' => 'Login']);
    }
}
