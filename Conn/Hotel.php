<?php
include("database.php");

class Hotel{

    public $ID;
    public $Name;
    public $Location;
    public $SmallDes;
    public $Description;
    public $Image;

    public function Add(){
        try{
           $query="INSERT INTO `hotel`(`HID`, `HotelName`, `HotelLocation`, `HotelSmallDes`, `HotelDes`) 
           VALUES (:id,:hname,:hlocation,:hsmalldes,:hdes)";
           $conn=Conn::GetConnection();
           $st=$conn->prepare($query);
           
           $st->bindValue(":id",$this->ID,PDO::PARAM_STR);
           $st->bindValue(":hname",$this->Name,PDO::PARAM_STR);
           $st->bindValue(":hlocation",$this->Location,PDO::PARAM_STR);
           $st->bindValue(":hsmalldes",$this->SmallDes,PDO::PARAM_STR);
           $st->bindValue(":hdes",$this->Description,PDO::PARAM_STR);
           
           $st->execute();
        }catch(Exception $e){
           throw $e;
        }
   }

   public function UpdateHotel()
    {
        try{
            $query=" UPDATE `hotel` SET `HID`=:id,`HotelName`=hname,`HotelLocation`=:hlocation,`HotelSmallDes`=:hsmalldes,`HotelDes`=:hdes
            WHERE HID=:id";
            $conn=Conn::GetConnection();
            $st=$conn->prepare($query);

            $st->bindValue(":id",$this->ID,PDO::PARAM_STR);
            $st->bindValue(":hname",$this->Name,PDO::PARAM_STR);
            $st->bindValue(":hlocation",$this->Location,PDO::PARAM_STR);
            $st->bindValue(":hsmalldes",$this->SmallDes,PDO::PARAM_STR);
            $st->bindValue(":hdes",$this->Description,PDO::PARAM_STR);

            $st->execute();
        }catch(Exception $e){
            throw $e;
        }
    }

    public function DeleteMovie(){
        try{
            $query="DELETE FROM `hotel` WHERE HID=:id";
            $conn=Conn::GetConnection();
            $st=$conn->prepare($query);
            $st->bindValue(":id",$this->ID,PDO::PARAM_STR);
            $st->execute();
        }catch(Exception $e){
            throw $e;
        }
    }
    

   public function UpdateImage()
    {
        try{
            $query="UPDATE `hotel` SET `Image`=:himage
            WHERE Hid=:id";

            $conn=Conn::GetConnection();
            $st=$conn->prepare($query);
            $st->bindValue(":himage",$this->Image,PDO::PARAM_STR);
            $st->bindValue(":id",$this->ID,PDO::PARAM_STR);
            $st->execute();
        }catch(Exception $e){
            throw $e;
        }
    }


    public static function GetHotels()
    {
        try{
            $query="SELECT `HID`, `HotelName`, `HotelLocation`, `HotelSmallDes`, `HotelDes`, `Image` 
                    FROM `hotel`";

            $conn=Conn::GetConnection();
            $hotels=array();
            $result=$conn->query($query);

            foreach($result as $r){

            $hotel=new Hotel;
            
            $hotel->ID=$r[0];
            $hotel->Name=$r[1];
            $hotel->Location=$r[2];
            $hotel->SmallDes=$r[3];
            $hotel->Description=$r[4];
            $hotel->Image=$r[5];

            array_push($hotels,$hotel);
        }

        return $hotels;
        }catch(Exception $th){
            throw $th;
        }
    }

    public static function GetHotel($ID)
    {
        try{
            $query="SELECT `HID`, `HotelName`, `HotelLocation`, `HotelSmallDes`, `HotelDes`, `Image` 
                    FROM `hotel`
                    WHERE HID=:id";

            $conn=Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":id", $ID, PDO::PARAM_STR);
            $st->execute();

            $result = $st->fetch(PDO::FETCH_ASSOC);
            
            $hotel = new Hotel;
            $hotel->ID = $result['HID'];
            $hotel->Name = $result['HotelName'];
            $hotel->Location = $result['HotelLocation'];
            $hotel->SmallDes = $result['HotelSmallDes'];
            $hotel->Description = $result['HotelDes'];
            $hotel->Image = $result['Image'];

            return $hotel;
        }catch(Exception $th){
            throw $th;
        }
    }

    public static function SearchHotelsByName($search) {
        try {
            $query = "SELECT `HID`, `HotelName`, `HotelLocation`, `HotelSmallDes`, `HotelDes`, `Image` 
                    FROM `hotel`
                    WHERE `HotelName` LIKE :search";

            $conn = Conn::GetConnection();
            $st = $conn->prepare($query);
            $st->bindValue(":search", "%$search%", PDO::PARAM_STR);
            $st->execute();

            $hotels = array();
            foreach ($st as $r) {
                $hotel = new Hotel;
                $hotel->ID = $r['HID'];
                $hotel->Name = $r['HotelName'];
                $hotel->Location = $r['HotelLocation'];
                $hotel->SmallDes = $r['HotelSmallDes'];
                $hotel->Description = $r['HotelDes'];
                $hotel->Image = $r['Image'];

                array_push($hotels, $hotel);
            }

            return $hotels;
        } catch (Exception $th) {
            throw $th;
        }
    }



}

class feedback{
    public $HotelID;
    public $HotelName;
    public $CustomerName;
    public $Feedback;
    public $Rating;

    public function AddFeedback()
    {
        try{
            $query="INSERT INTO `feedback`(`HID`, `HName`, `CName`, `Feedback`, `Rating`) 
                    VALUES (:hid,:hname,:cname,:feedback,:rate)";
            $conn=Conn::GetConnection();
            $st=$conn->prepare($query);

            $st->bindValue(":hid",$this->HotelID,PDO::PARAM_STR);
            $st->bindValue(":hname",$this->HotelName,PDO::PARAM_STR);
            $st->bindValue(":cname",$this->CustomerName,PDO::PARAM_STR);
            $st->bindValue(":feedback",$this->Feedback,PDO::PARAM_STR);
            $st->bindValue(":rate",$this->Rating,PDO::PARAM_STR);
            $st->execute();
        }catch(Exception $e){
            throw $e;
        }
    }

    public static function GetFeedbacks()
    {
        try{
            $query="SELECT `HID`, `HName`, `CName`, `Feedback`, `Rating` 
                    FROM `feedback`";
            
            $conn=Conn::GetConnection();
            $feedbacks=array();
            $feedback=$conn->query($query);

            foreach($feedback as $r){

            $feedback=new feedback;
            $feedback->HotelID=$r[0];
            $feedback->HotelName=$r[1];
            $feedback->CustomerName=$r[2];
            $feedback->Feedback=$r[3];
            $feedback->Rating=$r[4];
            
            
            array_push($feedbacks,$feedback);
        }
        return $feedbacks;
        }catch(Exception $th){
            throw $th;
        }
    }

}


?>