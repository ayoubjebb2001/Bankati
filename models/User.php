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

    public function getClients(){
        $q = "SELECT * FROM users";
        $clients = $this->conn->prepare($q);
        $clients->execute();
        $allClients = $clients->fetchAll(PDO::FETCH_ASSOC);
        return $allClients;
    }

    public function getAccounts($id){
        $q = "SELECT * FROM accounts WHERE user_id = ?";
        $accounts = $this->conn->prepare($q);
        $accounts->execute([$id]);
        $allAccounts = $accounts->fetchAll(PDO::FETCH_ASSOC);
        return $allAccounts;
    }

    public function getLastActivity($id){
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
        if(!$lastAccount){
            $lastActivity = [
                'date' => $accountCreated['created_at'],
                'type' => 'Creation de compte utilisateur'
            ];
        }
        // if the user has no transaction , return the account's creation date
        if(!$lastTransaction){
            $lastActivity = [
                'date' => $lastAccount['created_at'],
                'type' => 'Ouverture de compte bancaire'
            ];
        }
        // if the user has transaction and account , return the last transaction 
        if($lastTransaction && $lastAccount){
            $lastActivity = [
                'date' => $lastTransaction['created_at'],
                'type' => $lastTransaction['transaction_type']
            ];
        }
        return $lastActivity;
    }
}
