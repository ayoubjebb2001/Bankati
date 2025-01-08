<?php
class Account extends Db {

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

    public function makeWithdrawal($accountId, $amount) {
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
}