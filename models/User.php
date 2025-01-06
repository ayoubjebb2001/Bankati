<?php

class User {

    public function getUserbyEmail($email){
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch('PDO::FETCH_ASSOC');
    }
}