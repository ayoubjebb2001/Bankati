<?php
class Transaction extends Db
{

    public function __construct()
    {
        parent::__construct();
    }
    public function extractMoney($amount, $id)
    {
        $q = "UPDATE accounts SET balance = balance - ? WHERE id = ?";
        $modify = $this->conn->prepare($q);
        $modify->execute([$amount, intval($id)]);
        return $modify;
    }
    public function MoneyTransactionExtract($id, $money)
    {
        $q = "INSERT INTO transactions(account_id,transaction_type,amount) VALUES(?,'retrait',?)";
        $moneyy = $this->conn->prepare($q);
        return $moneyy->execute([$id, $money]);
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
    public function virementTransaction($sender, $reciever, $money)
    {
        $q = "INSERT INTO transactions(account_id,transaction_type,amount,beneficiary_account_id) VALUES(?,'transfert',?,?)";
        $moneyy = $this->conn->prepare($q);
        return $moneyy->execute([$sender, $money, $reciever]);
    }
    public function addMoney($money, $id)
    {
        $q = "UPDATE accounts SET balance = balance+? WHERE id= ?";
        $addMoney = $this->conn->prepare($q);
        return $addMoney->execute([$money, $id]);
    }
    public function MoneyTransaction($id, $money)
    {
        $q = "INSERT INTO transactions(account_id,transaction_type,amount) VALUES(?,'depot',?)";
        $moneyy = $this->conn->prepare($q);
        return $moneyy->execute([$id, $money]);
    }
    public function getLastVirements($id)
    {
        $q = "SELECT * FROM transactions JOIN accounts JOIN users WHERE transactions.account_id = accounts.id AND accounts.user_id = users.id AND transaction_type = 'transfert' 
        AND users.id = ? ORDER BY transactions.created_at DESC limit 3";
        $getLastTR = $this->conn->prepare($q);
        $getLastTR->execute([$id]);
        $getLastTrans = $getLastTR->fetchAll(PDO::FETCH_ASSOC);
        return $getLastTrans;
    }
    public function getAllDepots($id)
    {
        $q = "SELECT SUM(amount) AS total FROM transactions JOIN accounts JOIN users WHERE transactions.account_id = accounts.id AND accounts.user_id = users.id AND transaction_type = 'depot' 
        AND users.id = ?";
        $getLastTR = $this->conn->prepare($q);
        $getLastTR->execute([$id]);
        $getLastTrans = $getLastTR->fetchAll(PDO::FETCH_ASSOC);
        return $getLastTrans;
    }
    public function getAllRetraits($id)
    {
        $q = "SELECT SUM(amount) AS total FROM transactions JOIN accounts JOIN users WHERE transactions.account_id = accounts.id AND accounts.user_id = users.id AND transaction_type = 'retrait' 
        AND users.id = ?";
        $getLastTR = $this->conn->prepare($q);
        $getLastTR->execute([$id]);
        $getLastTrans = $getLastTR->fetchAll(PDO::FETCH_ASSOC);
        return $getLastTrans;
    }
    public function getAllTransactions($id)
    {
        $q = "SELECT account_id,transactions.created_at,amount,transaction_type,beneficiary_account_id FROM transactions JOIN accounts JOIN users WHERE transactions.account_id = accounts.id AND accounts.user_id = users.id 
        AND users.id = ? ";
        $getLastTR = $this->conn->prepare($q);
        $getLastTR->execute([$id]);
        $getLastTrans = $getLastTR->fetchAll(PDO::FETCH_ASSOC);
        return $getLastTrans;
    }
}
