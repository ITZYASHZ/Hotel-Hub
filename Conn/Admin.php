<?php
include("database.php");

class Admin{

    public $NIC;
    public $Name;
    public $Email;
    public $Mobile;
    public $Password;
    public $username;


    public function AddAdmin(){
        try{
            $query="INSERT INTO `admin`(`NIC`, `Name`, `Email`, `Mobile`, `Password`)
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

    public function GetAdminLogin($username) {
        try {
            $query = "SELECT `NIC`, `Name`, `Email`, `Mobile`, `Password` 
                    FROM `admin` 
                    WHERE `Email` = :email LIMIT 1";
    
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
            } else {
                $this->NIC = "";
                $this->Name = "";
                $this->Email = "";
                $this->Mobile = "";
                $this->Password = "";
            }
        } catch (Exception $th) {
            throw $th;
        }
    }

    public static function GetAdmins()
    {
        try{
            $query="SELECT `NIC`, `Name`, `Email`, `Mobile`, `Password` 
                    FROM `admin`  ";

            $conn=Conn::GetConnection();
            $admins=array();
            $result=$conn->query($query);

            foreach($result as $r){
            $admin=new admin;
            $admin->NIC=$r[0];
            $admin->Name=$r[1];
            $admin->Email=$r[2];
            $admin->Mobile=$r[3];
            $admin->Password=$r[4];

            array_push($admins,$admin);
        }

        return $admins;
        }catch(Exception $th){
            throw $th;
        }
    }

}

?>