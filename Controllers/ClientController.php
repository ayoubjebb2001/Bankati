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
        $this->userModel->test();
        $this->render('user/profile');
    }
}
