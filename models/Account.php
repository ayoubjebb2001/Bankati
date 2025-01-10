<?php
class Account extends Db
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create($accountType, $user_id)
    {
        $q = "INSERT INTO accounts (account_type, user_id) VALUES (?, ?)";
        $create = $this->conn->prepare($q);
        $create->execute([$accountType, $user_id]);
        return $create;
    }

    public function makeWithdrawal($accountId, $amount)
    {
        try {
            // Start transaction
            $this->conn->beginTransaction();

            // Get current balance
            $stmt = $this->conn->prepare("SELECT balance FROM accounts WHERE id = ? FOR UPDATE");
            $stmt->execute([$accountId]);
            $currentBalance = $stmt->fetchColumn();

            // Check if sufficient balance
            if ($currentBalance < $amount) {
                throw new Exception("Solde insuffisant pour ce retrait.");
            }

            // Update account balance
            $stmt = $this->conn->prepare(
                "UPDATE accounts 
                SET balance = balance - :amount, 
                    updated_at = NOW() 
                WHERE id = :accountId"
            );

            $stmt->execute([
                ':amount' => $amount,
                ':accountId' => $accountId
            ]);

            // Record transaction
            $stmt = $this->conn->prepare(
                "INSERT INTO transactions 
                (account_id, transaction_type, amount, created_at) 
                VALUES (:accountId, 'retrait', :amount, NOW())"
            );

            $stmt->execute([
                ':accountId' => $accountId,
                ':amount' => $amount
            ]);

            // Commit transaction
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Rollback on error
            $this->conn->rollBack();
            throw $e;
        }
    }
    public function getAccounts($id)
    {
        $q = "SELECT * FROM accounts WHERE user_id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$id]);
        $accounts = $modify->fetchAll(PDO::FETCH_ASSOC);
        return $accounts;
    }
    public function currenAccount($id, $compteID)
    {
        $q = "SELECT * FROM accounts WHERE user_id = ? AND id =?";
        $clients = $this->conn->prepare($q);
        $clients->execute([$id, $compteID]);
        $account = $clients->fetchAll(PDO::FETCH_ASSOC);
        return $account;
    }
    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function getAll()
    {
        $q = "SELECT accounts.id as account_id,profile_pic,email,name,account_type,balance,account_status FROM accounts JOIN users WHERE accounts.user_id = users.id";
        $result = $this->conn->query($q, PDO::FETCH_ASSOC);
        $accounts = $result->fetchAll();
        return $accounts;
    }

    public function getActiveAccounts()
    {
        $q = "SELECT COUNT(*) as count FROM accounts WHERE account_status = 'actif'";
        $result = $this->conn->query($q);
        $accounts = $result->fetchColumn(0);
        return $accounts;
    }

    public function getActivePercentage()
    {
        $q = "SELECT COUNT(*) FROM accounts WHERE account_status = 'actif' AND 
        ( MONTH(created_at) < MONTH(CURDATE())  AND YEAR(created_at) <= YEAR(CURDATE()) ) OR ( MONTH(created_at) >= MONTH(CURDATE())  AND YEAR(created_at) < YEAR(CURDATE()) )";
        $result = $this->conn->query($q);
        $activeAccounts = $result->fetchColumn(0);

        $q = "SELECT COUNT(*) FROM accounts WHERE account_status = 'actif' ";
        $result = $this->conn->query($q);
        $accounts = $result->fetchColumn(0);

        return round(($accounts-$activeAccounts)*100/$accounts,2);
    }

    public function getLastActivity($accountId){
        $q = "SELECT t.created_at,t.transaction_type as activity FROM transactions t JOIN accounts a WHERE t.account_id = a.id AND a.id = ? ORDER BY t.created_at DESC LIMIT 1";
        $stmt = $this->conn->prepare($q);
        $result = $stmt->execute([$accountId]);
        $last_activity = $stmt->fetch(PDO::FETCH_NAMED);

        var_dump($last_activity);

        $q = "SELECT t.created_at,t.transaction_type as activity FROM transactions t JOIN accounts a WHERE t.beneficiary_account_id = a.id AND a.id = ? ORDER BY t.created_at DESC LIMIT 1";
        $stmt = $this->conn->prepare($q);
        $result = $stmt->execute([$accountId]);
        $last_activity_passive = $stmt->fetch(PDO::FETCH_NAMED);

        $q = "SELECT created_at, ";
        return  (strtotime($last_activity['created_at'])  > strtotime($last_activity_passive['created_at']))? $last_activity:$last_activity_passive;
    }
}
