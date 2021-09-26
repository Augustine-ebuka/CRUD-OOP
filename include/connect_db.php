<?php
require_once('operations.php');


class connectdb
{
    public $connection;

    public function __construct()
    {
        return $this->connect();
    }
    public function connect()
    {
        $this->connection = mysqli_connect("localhost","root","","crud_oop");
        if (mysqli_connect_error())
        {
            die('connect error');
            # code...
        }
       
    }
    public function auto($a)
    {

        $return = mysqli_real_escape_string($this->connection,$a);
        return $return;

    }
}


