<?php


class User extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    function test(){
        return $this->conn;
    }
    public function getUserbyEmail($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch('PDO::FETCH_ASSOC');
    }

}

