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
}
