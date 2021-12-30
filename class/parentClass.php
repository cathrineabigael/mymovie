<?php 
// class/parent.php
// include("../db.php");


//class kalau di php boleh pake huruf kecil
class ParentClass{
    //visibility protected itu yg bisa diwariskan ke anak2 nya (masa sih pak?)
    protected $mysqli;

    public function __construct($server, $database, $userid, $password)
    {
        $this->mysqli= new mysqli($server, $userid, $password, $database);
    }

    function __destruct(){
        $this->mysqli->close();
    }
}

?>