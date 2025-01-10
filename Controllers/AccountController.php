<?php

class AccountController extends BaseController
{
    private $accountModel;

    public function __construct()
    {
        $this->accountModel = new Account();
    }

    public function index(){
        $accounts = $this->accountModel->getAll();
        $activeAccounts = $this->accountModel->getActiveAccounts();
        $activePercent = $this->accountModel->getActivePercentage();
        
        $this->accountModel->getLastActivity($accounts[0]['account_id']);
        // foreach ($accounts as &$account) {
        //     $last_activity = $this->accountModel->getLastActivity($account['account_id']);
        //     $account['last_activity'] = $last_activity;
        // }

        $this->render('admin/accounts',[
            'activeAccounts' => $activeAccounts,
            'accounts' => $accounts,
            'activePercent' => $activePercent
        ]);
    }
}