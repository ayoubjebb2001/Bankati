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
            $phone = $_POST["phone"];
            $address = $_POST["address"];
            $this->userModel->modifyProf($name, $phone, $address, $email, $id);
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
    public function showGetMoney()
    {
        $id = $_SESSION['user']['id'];
        $compteID = $_GET["id"];
        $account = $this->userModel->currenAccount($id, $compteID);
        $users = $this->userModel->getUser($id);
        $this->render('user/retrait', ["users" => $users, "compteID" => $compteID, "account" => $account]);
    }
    public function getMoney()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["getMoney"])) {
            $amount = $_POST["amount"];
            $myMoney = $_POST["myMoney"];
            $id = $_POST["compteID"];
            if ($myMoney - $amount >= 0) {
                $this->userModel->extractMoney($amount, $id);
                header("Location: /user/myAccounts");
            } else {
                header("Location: /user/myAccounts");
            }
        }
    }
    public function showVirement()
    {
        $id = $_SESSION['user']['id'];
        $accounts = $this->userModel->getAccounts($id);
        $users = $this->userModel->getUser($id);
        $this->render('user/virement', ["id" => $id, "users" => $users, "accounts" => $accounts]);
    }
}
