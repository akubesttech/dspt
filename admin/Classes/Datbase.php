<?php

/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 11/28/2019
 * Time: 10:22 AM
 */
class Datbase
{
    public $con;
    public function __construct()
    {
        $this->con = new mysqli('localhost','root','','dscht_db');
    }
    public function getCon(){
        return $this->con;
    }
    public function getData($query){
        if($resp = $this->con->query($query)){
            return $resp->fetch_all(MYSQLI_ASSOC);
        }else{
            return $this->con->error;
        }
    }
    public function getSingleData($query){
        if($resp = $this->con->query($query)){
            return $resp->fetch_array(MYSQLI_ASSOC);
        }else{
            return $this->con->error;
        }
    }
    public function getDataAsNumArray($query){
        if($resp = $this->con->query($query)){
            return $resp->fetch_all(MYSQLI_NUM);
        }else{
            return $this->con->error;
        }
    }
}

