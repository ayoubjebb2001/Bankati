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

    public function modifyProf($name, $phone, $address, $email, $id)
    {
        $q = "UPDATE users SET name = ?, phone=?,address=?, email = ? WHERE id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$name, $phone, $address, $email, intval($id)]);
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

    public function getClients()
    {
        $q = "SELECT * FROM users";
        $clients = $this->conn->prepare($q);
        $clients->execute();
        $allClients = $clients->fetchAll(PDO::FETCH_ASSOC);
        return $allClients;
    }
    public function currenAccount($id, $compteID)
    {
        $q = "SELECT * FROM accounts WHERE user_id = ? AND id =?";
        $clients = $this->conn->prepare($q);
        $clients->execute([$id, $compteID]);
        $account = $clients->fetchAll(PDO::FETCH_ASSOC);
        return $account;
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

        if($lastAccount == false){

            $lastActivity = [
                'date' => $accountCreated['created_at'],
                'type' => 'Creation de compte utilisateur'
            ];
        }
        // if the user has no transaction , return the account's creation date

        elseif($lastTransaction == false){
            $lastActivity = [
                'date' => $lastAccount['created_at'],
                'type' => 'Ouverture de compte bancaire'
            ];
        }
        // if the user has transaction and account , return the last transaction 

        else{
            $lastActivity = [
                'date' => $lastTransaction['created_at'],
                'type' => $lastTransaction['transaction_type']
            ];
        }
        return $lastActivity;
    }
    public function extractMoney($amount, $id)
    {
        $q = "UPDATE accounts SET balance = balance - ? WHERE id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$amount, intval($id)]);
        return $modify;
    }
    public function virement($sender, $reciever, $money)
    {
        $this->conn->beginTransaction();
        $first = "SELECT balance FROM accounts WHERE id=?";
        $firstMoney = $this->conn->prepare($first);
        $firstMoney->execute([$sender]);
        $r1 = $firstMoney->fetch(PDO::FETCH_ASSOC);
        if ($money <= $r1["balance"]) {
            $q = "UPDATE accounts SET balance = balance - ? WHERE id=?";
            $query = $this->conn->prepare($q);
            $query->execute([$money, $sender]);
            $q2 = "UPDATE accounts SET balance = balance + ? WHERE id=?";
            $query2 = $this->conn->prepare($q2);
            $query2->execute([$money, $reciever]);
            $this->conn->commit();
        } else {
            return "no";
            $this->conn->rollback();
        }
        // $q="UPDATE accounts SET "
    }
}
