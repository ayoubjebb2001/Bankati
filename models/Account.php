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
}