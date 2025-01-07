<?php

class ClientController extends BaseController
{
    private $userModel;
    private $accountModel;
    public function __construct()
    {

        $this->userModel = new User();
        $this->accountModel = new Account();
    }

    public function index(){
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

    public function add(){
        if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
            $name = $_POST["firstname"]. " " . $_POST["lastname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $accountType = $_POST["account_type"];
            $password = "123456";


            $user_id = $this->userModel->create($name, $email, $phone, $address, $password);
            if($accountType== "both"){
                $this->accountModel->create("epargne",$user_id);
                $this->accountModel->create("courant",$user_id);
            }
            else{
                $this->accountModel->create($accountType,$user_id);
            }
            header("Location: /clients");
        }
    }

    public function showProfile()
    {
        // $this->userModel->test();
        $id = $_SESSION['user']['id'];
        $users = $this->userModel->getUser($id);
        $this->render('user/profile', ["users" => $users]);
    }
    public function showAccounts()
    {
        $id = $_SESSION['user']['id'];
        $users = $this->userModel->getUser($id);
        $accounts = $this->userModel->getAccounts($id);
        $this->render('user/Accounts', ["users" => $users, "accounts" => $accounts]);
    }
    function modifyProfile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["info"])) {
            $id = $_SESSION['user']['id'];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $this->userModel->modifyProf($name, $email, $id);
            header("location: /user/profile");
        }
    }
    function changePassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["psw"])) {
            $id = $_SESSION['user']['id'];
            $currentPass = $_POST["psw1"];
            $newPass = $_POST["psw2"];
            $newPassCheck = $_POST["psw3"];
            if (!empty($currentPass) && !empty($newPass) && !empty($newPassCheck)) {
                $pass = $this->userModel->checkPassword($currentPass, $id);
                if (!empty($pass)  && $newPass == $newPassCheck) {
                    $this->userModel->changePass($newPass, $id);
                    header("location: /user/profile");
                    exit;
                } else {
                    $message = "wrong password";
                    header("Location: /user/profile" . "?" . $message);
                }
            }
        }
        // echo $currentPass . $newPass . $newPassCheck;
    }
    public function depot()
    {
        $id = $_SESSION['user']['id'];
        $compteID = $_GET["id"];
        $users = $this->userModel->getUser($id);
        $this->render('user/depot', ["users" => $users, "compteID" => $compteID]);
    }
    public function stockMoney()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["depot"])) {
            $id = $_POST["id"];
            $money = $_POST["money"];
            if ($money >= 0.01) {
                $this->userModel->addMoney($money, $id);
                header("Location: /user/myAccounts");
            }
        }
    }
}
