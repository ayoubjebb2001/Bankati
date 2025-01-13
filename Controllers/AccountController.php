<?php

class AccountController extends BaseController
{
    private $accountModel;
    private $userModel;

    public function __construct()
    {
        $this->accountModel = new Account();
        $this->userModel = new User();
    }

    public function index()
    {
        $accounts = $this->accountModel->getAll();
        $activeAccounts = $this->accountModel->getActiveAccounts();
        $activePercent = $this->accountModel->getActivePercentage();
        foreach ($accounts as &$account) {
            $last_activity = $this->accountModel->getLastActivity($account['account_id']);
            $account['last_activity'] = $last_activity;
        }

        $this->render('admin/accounts', [
            'title' => 'accounts',
            'activeAccounts' => $activeAccounts,
            'accounts' => $accounts,
            'activePercent' => $activePercent
        ]);
    }

    public function getClients()
    {
        $data = $this->userModel->getClients();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function add(){
        $data = json_decode(file_get_contents('php://input'), true);
        header('Content-Type: application/json');
        if($this->accountModel->create($data['accountType'],$data['userID'])){
            echo json_encode([
                "name" => $data['userID'],
                "account" => $data['accountType']
            ]);
        }
    }
    public function filter(){
        $data = json_decode(file_get_contents('php://input'), true);
        $accounts = $this->accountModel->getBy($data['balance'],$data['status'],$data['type'],$data['account']);
        if(!empty($accounts)){
            foreach ($accounts as &$account) {
                $last_activity = $this->accountModel->getLastActivity($account['account_id']);
                $account['last_activity'] = $last_activity;
            }
        }
        echo json_encode($accounts);
    }
}
