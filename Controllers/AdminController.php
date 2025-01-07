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
        foreach($clients as &$client){
            $accounts = $this->userModel->getAccounts($client['id']);
            $client['accounts'] = $accounts;
            $lastActivity = $this->userModel->getLastActivity($client['id']);
            $client['last_activity'] = $lastActivity;
        }
        $this->render('admin/clients', [
            'title' => 'Clients',
            'clients' => $clients
        ]);
    }
}
