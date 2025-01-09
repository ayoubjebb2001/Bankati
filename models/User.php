<?php

class User extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($name, $email, $phone, $address, $password)
    {
        $q = "INSERT INTO users (name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)";
        $create = $this->conn->prepare($q);
        $create->execute([$name, $email, $phone, $address, $password]);
        return $this->conn->lastInsertId();
    }

    public function update($name, $phone, $address, $email, $id)
    {
        $q = "UPDATE users SET name = ?, phone=?,address=?, email = ? WHERE id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$name, $phone, $address, $email, intval($id)]);
        return $modify;
    }

    public function lock($user_id){
        $q = "UPDATE users SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($q);
        return $stmt->execute(["bloqué",$user_id]);
    }

    public function activate($user_id){
        $q = "UPDATE users SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($q);
        return $stmt->execute(["actif",$user_id]);
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
    public function getClients()
    {
        $q = "SELECT * FROM users";
        $clients = $this->conn->prepare($q);
        $clients->execute();
        $allClients = $clients->fetchAll(PDO::FETCH_ASSOC);
        return $allClients;
    }

    public function getLastActivity($id)
    {
        $q = "SELECT * FROM transactions JOIN accounts WHERE transactions.account_id = accounts.id AND user_id = ? ORDER BY transactions.created_at DESC LIMIT 1";
        $transaction = $this->conn->prepare($q);
        $transaction->execute([$id]);
        $lastTransaction = $transaction->fetch(PDO::FETCH_ASSOC);

        $q = "SELECT created_at FROM users WHERE id = ?";
        $client = $this->conn->prepare($q);
        $client->execute([$id]);
        $accountCreated = $client->fetch(PDO::FETCH_ASSOC);

        $q = "SELECT created_at FROM accounts WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
        $account = $this->conn->prepare($q);
        $account->execute([$id]);
        $lastAccount = $account->fetch(PDO::FETCH_ASSOC);

        // if the user has no account , return the user's registration date

        if ($lastAccount == false) {

            $lastActivity = [
                'date' => $accountCreated['created_at'],
                'type' => 'Creation de compte utilisateur'
            ];
        }
        // if the user has no transaction , return the account's creation date

        elseif ($lastTransaction == false) {
            $lastActivity = [
                'date' => $lastAccount['created_at'],
                'type' => 'Ouverture de compte bancaire'
            ];
        }
        // if the user has transaction and account , return the last transaction 

        else {
            $lastActivity = [
                'date' => $lastTransaction['created_at'],
                'type' => $lastTransaction['transaction_type']
            ];
        }
        return $lastActivity;
    }
    
}
