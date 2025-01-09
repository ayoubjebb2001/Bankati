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
    public function addMoney($money, $id)
    {
        $q = "UPDATE accounts SET balance = balance+? WHERE id= ?";
        $addMoney = $this->conn->prepare($q);
        return $addMoney->execute([$money, $id]);
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
    public function getAllRetraits($id){
        $q = "SELECT SUM(amount) AS total FROM transactions JOIN accounts JOIN users WHERE transactions.account_id = accounts.id AND accounts.user_id = users.id AND transaction_type = 'retrait' 
        AND users.id = ?";
        $getLastTR = $this->conn->prepare($q);
        $getLastTR->execute([$id]);
        $getLastTrans = $getLastTR->fetchAll(PDO::FETCH_ASSOC);
        return $getLastTrans;
    }
}
