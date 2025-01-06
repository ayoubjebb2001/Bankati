<?php

class AdminController extends BaseController
{
    private $userModel;
   public function __construct()
   {

      $this->userModel = new User();
   }

    public function showDashboard()
    {
        $this->render('admin/dashboard', ['title' => 'Dashboard']);
    }
}
