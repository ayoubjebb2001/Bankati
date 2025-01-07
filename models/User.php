<?php


class User extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    function getUser($id)
    {
        $q = "SELECT * FROM users WHERE id=? ";
        $users = $this->conn->prepare($q);
        $users->execute([$id]);
        $allUsers = $users->fetchAll(PDO::FETCH_ASSOC);
        return $allUsers;
    }
    public function getUserbyEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function modifyProf($name, $email, $id)
    {
        $q = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$name, $email, intval($id)]);
        return $modify;
    }
    public function checkPassword($currentPass, $id)
    {
        $q = "SELECT * FROM users WHERE id = ? AND password = ?";
        $check = $this->conn->prepare($q);
        $check->execute([$id, $currentPass]);
        $user = $check->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function changePass($newPass, $id)
    {
        $q = "UPDATE users SET password = ? WHERE id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$newPass, intval($id)]);
        return $modify;
    }
    public function getAccounts($id)
    {
        $q = "SELECT * FROM accounts WHERE user_id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$id]);
        $accounts = $modify->fetchAll(PDO::FETCH_ASSOC);
        return $accounts;
    }
    public function addMoney($money, $id)
    {
        $q = "UPDATE accounts SET balance = balance+? WHERE id= ?";
        $addMoney = $this->conn->prepare($q);
        return $addMoney->execute([$money, $id]);
    }
}
