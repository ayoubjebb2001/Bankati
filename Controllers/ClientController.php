<?php

class ClientController extends BaseController
{
    private $userModel;
    private $accountModel;
    private $transactionModel;
    public function __construct()
    {

        $this->userModel = new User();
        $this->accountModel = new Account();
        $this->transactionModel = new Transaction();
    }

    public function index()
    {

        $clients = $this->userModel->getClients();
        foreach ($clients as &$client) {
            $accounts = $this->accountModel->getAccounts($client['id']);

            if (!isset($_SESSION['admin'])) {
                header('Location: /');
                exit();
            }
            $clients = $this->userModel->getClients();
            foreach ($clients as &$client) {
                $accounts = $this->accountModel->getAccounts($client['id']);

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

    public function add()
    {

        if (!isset($_SESSION['admin'])) {
            header('Location: /');
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["firstname"] . " " . $_POST["lastname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $accountType = $_POST["account_type"];
            $password = "123456";


            $user_id = $this->userModel->create($name, $email, $phone, $address, $password);
            if ($accountType == "both") {
                $this->accountModel->create("epargne", $user_id);
                $this->accountModel->create("courant", $user_id);
            } else {
                $this->accountModel->create($accountType, $user_id);
            }
            header("Location: /clients");
        }
    }

    public function edit()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST["firstname"] . " " . $_POST["lastname"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];

            $this->userModel->update($name, $phone, $address, $email, $id);
            header("Location: /clients");
        }
    }

    public function lock(){
        header("Content-Type: application/json; charset=UTF-8");
        $client = json_decode(file_get_contents("php://input"));
        $id = $client->id;

        if($this->userModel->lock($id)){
            $this->index();
        };
    }

    public function activate(){
        header("Content-Type: application/json; charset=UTF-8");
        $client = json_decode(file_get_contents("php://input"));
        $id = $client->id;

        if($this->userModel->activate($id)){
            $this->index();
        };
    }
    public function showProfile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        // $this->userModel->test();
        $id = $_SESSION['user']['id'];
        $users = $this->userModel->getUser($id);
        $this->render('user/profile', ["users" => $users]);
    }
    public function showAccounts()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        $id = $_SESSION['user']['id'];
        $users = $this->userModel->getUser($id);
        $accounts = $this->accountModel->getAccounts($id);
        $this->render('user/Accounts', ["users" => $users, "accounts" => $accounts]);
    }
    function modifyProfile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["info"])) {
            $id = $_SESSION['user']['id'];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $this->userModel->update($name, $phone, $address, $email, $id);
            header("location: /user/profile");
        }
    }
    function changePassword()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
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
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        $id = $_SESSION['user']['id'];
        $compteID = $_GET["id"];
        $users = $this->userModel->getUser($id);

        $this->render('user/depot', ["users" => $users, "compteID" => $compteID]);
    }
    public function stockMoney()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["depot"])) {
            $id = $_POST["id"];
            $money = $_POST["money"];
            if ($money >= 0.01) {
                $this->transactionModel->addMoney($money, $id);
                $this->transactionModel->MoneyTransaction($id, $money);
                header("Location: /user/myAccounts");
            }
        }
    }
    public function showGetMoney()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        $id = $_SESSION['user']['id'];
        $compteID = $_GET["id"];
        $account = $this->accountModel->currenAccount($id, $compteID);
        $users = $this->userModel->getUser($id);
        $this->render('user/retrait', ["users" => $users, "compteID" => $compteID, "account" => $account]);
    }
    public function getMoney()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["getMoney"])) {
            $amount = $_POST["amount"];
            $myMoney = $_POST["myMoney"];
            $id = $_POST["compteID"];
            if ($myMoney - $amount >= 0) {
                $this->accountModel->makeWithdrawal($id, $amount);
                header("Location: /user/myAccounts");
            } else {
                header("Location: /user/myAccounts");
            }
        }
    }
    public function showVirement()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /');
            exit();
        }
        $id = $_SESSION['user']['id'];
        $accounts = $this->accountModel->getAccounts($id);
        $users = $this->userModel->getUser($id);
        $transfers = $this->transactionModel->getLastVirements($id);
        $this->render('user/virement', ["id" => $id, "users" => $users, "accounts" => $accounts, "transfers" => $transfers]);
    }
    public function virement()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["vers"])) {
            $sender = $_POST["first"];
            $id = $_SESSION['user']['id'];
            $reciever = $_POST["second"];
            $money = $_POST["montant"];
            if ($sender == "al" || $sender == "all2" || $reciever == "al" || $reciever == "all2") {
                header("Location: /user/virements");
            } else {
                $this->transactionModel->virement($sender, $reciever, $money);
                // $this->transactionModel->MoneyTransactionExtract($id, $money);
                $this->transactionModel->virementTransaction($sender, $reciever, $money);
                header("Location: /user/virements?message=the money has converted successfuly");
            }
        }
    }
    public function showHistoriques()
    {
        $id = $_SESSION['user']['id'];
        $accounts = $this->accountModel->getAccounts($id);
        $users = $this->userModel->getUser($id);
        $transfers = $this->transactionModel->getLastVirements($id);
        $allDepots = $this->transactionModel->getAllDepots($id);
        $allRetraits = $this->transactionModel->getAllRetraits($id);
        $difference = $allDepots[0]["total"] - $allRetraits[0]["total"];
        $allTrans = $this->transactionModel->getAllTransactions($id);
        $this->render('user/historique', ["id" => $id, "difference" => $difference, "transactions" => $allTrans, "users" => $users, "accounts" => $accounts, "transfers" => $transfers, "totalDepot" => $allDepots, "totalRetraits" => $allRetraits]);
    }
    public function dashboard()
    {
        $id = $_SESSION['user']['id'];
        $users = $this->userModel->getUser($id);
        $accounts = $this->accountModel->getAccounts($id);
        $this->render('user/dashboard', ["users" => $users, "accounts" => $accounts]);
    }
}
