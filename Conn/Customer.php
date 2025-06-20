<?php
include("../Conn/database.php");

class Customer{

    public $NIC;
    public $Name;
    public $Email;
    public $Mobile;
    public $Password;
    public $username;


    public function AddCust(){
        try{
            $query="INSERT INTO `customer`(`NIC`, `Name`, `Email`, `Mobile`, `Password`)
            VALUES (:nic,:aname,:email,:mobile,:apassword)";
            $conn=Conn::GetConnection();
            $st=$conn->prepare($query);
            
            $st->bindValue(":nic",$this->NIC,PDO::PARAM_STR);
            $st->bindValue(":aname",$this->Name,PDO::PARAM_STR);
            $st->bindValue(":email",$this->Email,PDO::PARAM_STR);
            $st->bindValue(":mobile",$this->Mobile,PDO::PARAM_STR);
            $st->bindValue(":apassword",$this->Password,PDO::PARAM_STR);
            
            $st->execute();
        }catch (Exception $e){
            throw $e;
        }
    }

public function GetCustLogin($username) {
    try {
        $query = "SELECT `NIC`, `Name`, `Email`, `Mobile`, `Password` 
                  FROM `customer` 
                  WHERE Email = :email LIMIT 1";

        $conn = Conn::GetConnection();
        $st = $conn->prepare($query);
        $st->bindValue(":email", $username, PDO::PARAM_STR);
        $st->execute();

        $result = $st->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $this->NIC = $result['NIC'];
            $this->Name = $result['Name'];
            $this->Email = $result['Email'];
            $this->Mobile = $result['Mobile'];
            $this->Password = $result['Password'];
            return true;
        } else {
            return false;
        }
    } catch (Exception $th) {
        throw $th;
    }
}
    
    
    public static function GetCusts()
    {
        try{
            $query="SELECT `NIC`, `Name`, `Email`, `Mobile`, `Password` 
            FROM `customer`";

            $conn=Conn::GetConnection();
            $custs=array();
            $result=$conn->query($query);

            foreach($result as $r){
            $cust=new Customer;
            $cust->NIC=$r[0];
            $cust->Name=$r[1];
            $cust->Email=$r[2];
            $cust->Mobile=$r[3];
            $cust->Password=$r[4];

            array_push($custs,$cust);
        }

        return $custs;
        }catch(Exception $th){
            throw $th;
        }
    }

    public static function GetCustomer($NIC)
    {
        try{
            $query="SELECT `NIC`, `Name`, `Email`, `Mobile`, `Password` FROM `customer`
            WHERE NIC=:nic";

            $conn=Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":nic", $NIC, PDO::PARAM_STR);
            $st->execute();

            $result = $st->fetch(PDO::FETCH_ASSOC);
            
            $cust = new customer;
            $cust->NIC = $result['NIC'];
            $cust->Name = $result['Name'];
            $cust->Email = $result['Email'];
            $cust->Mobile = $result['Mobile'];
            $cust->Password = $result['Password'];

            return $cust;
        }catch(Exception $th){
            throw $th;
        }
    }

    public function DeleteCustomer(){
        try{
            $query="DELETE FROM `customer` WHERE NIC=:nic";
            $conn=Conn::GetConnection();
            $st=$conn->prepare($query);
            $st->bindValue(":nic",$this->NIC,PDO::PARAM_STR);
            $st->execute();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function UpdateCustomer()
    {
        try{
            $query=" UPDATE `customer` SET `NIC`=:nic,`Name`=:stname,`Email`=:email,`Mobile`=:stmobile,`Password`=:stpassword
            WHERE NIC=:nic";
            $conn=Conn::GetConnection();
            $st=$conn->prepare($query);

            $st->bindValue(":nic",$this->NIC,PDO::PARAM_STR);
            $st->bindValue(":stname",$this->Name,PDO::PARAM_STR);
            $st->bindValue(":email",$this->Email,PDO::PARAM_STR);
            $st->bindValue(":stmobile",$this->Mobile,PDO::PARAM_STR);
            $st->bindValue(":stpassword",$this->Password,PDO::PARAM_STR);
            $st->execute();
        }catch(Exception $e){
            throw $e;
        }
    }
}
?>