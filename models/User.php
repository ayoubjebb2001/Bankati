
<?php


class User extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    function test(){
        return $this->conn;
    }

}
