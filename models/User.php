<?php


class User extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    function test()
    {
        return $this->conn;
    }
    function getUsers()
    {
        $q = "SELECT * FROM users";
        $users = $this->conn->prepare($q);
        $users->execute();
        $allUsers = $users->fetchAll(PDO::FETCH_ASSOC);
        return $allUsers;
    }
    public function getUserbyEmail($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

