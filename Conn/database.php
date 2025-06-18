<?php
class Conn{
    public static function GetConnection()
    {
        try{
            $dsn="mysql:dbname=hotelhub";
            $username="root";
            $password="";
            $conn=new PDO($dsn,$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(Exception $e){
            throw $e;
        }
    }
}
?>