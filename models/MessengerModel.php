<?php

include_once "./config/Db.php";
class MessengerModel extends Db
{
    public function __construct()
    {
        parent::__construct();
    }
    

    public function getMessengerModel()
    {

        return $_SESSION;
    }
}
