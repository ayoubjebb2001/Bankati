<?php

class ClientController extends BaseController
{
    private $userModel;
    public function __construct()
    {

        $this->userModel = new User();
    }

    public function showProfile()
    {
        // $this->userModel->test();
        $id= $_SESSION['user']['id'];
        $users = $this->userModel->getUser($id);
        $this->render('user/profile', ["users" => $users]);
    }
}
