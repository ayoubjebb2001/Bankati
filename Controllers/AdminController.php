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
        $this->render('admin/dashboard', [
            'title' => 'Dashboard'
    ]);
    }

    public function showClients(){
        $clients = $this->userModel->getClients();
        $this->render('admin/clients', [
            'title' => 'Clients',
            'clients' => $clients
        ]);
    }
}
