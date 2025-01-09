<?php

class AccountController extends BaseController
{
    private $accountModel;

    public function __construct()
    {
        $this->accountModel = new Account();
    }

    public function index(){
        $this->render('admin/accounts',[]);
    }
}