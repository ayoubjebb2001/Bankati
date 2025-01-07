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
}
