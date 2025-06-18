<?php
include("../Conn/Hotel.php");

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: Admin_Login.php");
    exit();
}

echo '<p style="color: black;, paddin-top=2%;">Welcome,'.$_SESSION['username'].'! You are now on the Manage hotel page.</p>';

if(isset($_POST["btnEdit"])){
    $myHotel=Hotel::GetHotel($_POST["btnEdit"]);
}

if(isset($_POST["btnDel"])){
    $myHotel=Hotel::GetHotel($_POST["btnDel"]);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Manage.css">
    <title>Manage Hotel details</title>
</head>
<body>
<?php include '../HeaderAndFooter/AdminHeader.php'; ?>

    <aside>
    <form method="post" enctype="multipart/form-data">
            <h2 style="text-decoration: underline;">Manage Hotel Details</h2><br>
            <ul>
                <li><input type="text" name="txtHID" placeholder="Hotel ID" required 
                value="<?php if(isset($myHotel))
                echo $myHotel->ID;
                ?>"></li><br>

                <li><input type="text" name="txtHName" placeholder="Hotel Name" required 
                value="<?php if(isset($myHotel))
                echo $myHotel->Name;
                ?>"></li><br>

                <li><input type="text" name="txtLocation" placeholder="Location" required 
                value="<?php if(isset($myHotel))
                echo $myHotel->Location;
                ?>"></li><br>

                <li>Small Description</li><br>
                <li><textarea name="txtSmallDes" id="" cols="30" rows="10"><?php if(isset($myHotel)) echo $myHotel->SmallDes;
                ?></textarea></li><br>

                <li>Description</li><br>
                <li><textarea name="txtDes" id="" cols="30" rows="10"><?php if(isset($myHotel)) echo $myHotel->Description;
                ?></textarea></li><br>

                <li>Image <input type="file" name="image">
                <?php
                if(isset($myHotel))
                    echo '<img src="'.$myHotel->Image .
                '" width="100px" height="100px">'
                ?>
                </li><br>

                <input type="hidden" name="editHotelID" value="<?php if(isset($myHotel)) echo $myHotel->ID; ?>">

                <li>
                <input type="submit" value="Add" name="btnAdd">
                <input type="submit" value="Update" name="btnUpdate">
                <input type="submit" value="Delete" name="btnDelete">
                </li>
            </ul>
        </form>
        
        <?php
        
        if(isset($_POST["btnAdd"]))
        {
            
            $hotel =new Hotel;

            $hotel->ID = $_POST["txtHID"];
            $hotel->Name = $_POST["txtHName"];
            $hotel->Location = $_POST["txtLocation"];
            $hotel->SmallDes = $_POST["txtSmallDes"];
            $hotel->Description = $_POST["txtDes"];

            try{
                $hotel->Add();

                $image=$_FILES["image"]["name"];
                $info=new SplFileInfo($image);
                $newName="../Hotel_img/".$hotel->ID.'.'.$info->getExtension();

                move_uploaded_file($_FILES["image"]["tmp_name"],$newName);

                $hotel->Image=$newName;
                $hotel->UpdateImage();
                
                echo "Hotel Details Added Successfully.";
                
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        else if(isset($_POST["btnUpdate"]))
        {
            $hotel =new Hotel;

            $hotel->ID = $_POST["txtHID"];
            $hotel->Name = $_POST["txtHName"];
            $hotel->Location = $_POST["txtLocation"];
            $hotel->SmallDes = $_POST["txtSmallDes"];
            $hotel->Description = $_POST["txtDes"];

            try{
                $hotel->UpdateHotel();

                if(isset($_FILES["image"]) && $_FILES["image"]["name"] != '')
                {
                    $image=$_FILES["image"]["name"];
                    $info=new SplFileInfo($image);
                    $newName="../Hotel_img/".$hotel->ID.'.'.$info->getExtension();
                    move_uploaded_file($_FILES["image"]["tmp_name"],$newName);
            
                    $image->Image=$newName;
                    $hotel->UpdateImage();
                }
                echo "Hotel details Upadted Successfully.";
                
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        else if(isset($_POST["btnDelete"]))
        {
            $hotel =new Hotel;

            $hotel->ID = $_POST["txtHID"];
            $hotel->Name = $_POST["txtHName"];
            $hotel->Location = $_POST["txtLocation"];
            $hotel->SmallDes = $_POST["txtSmallDes"];
            $hotel->Description = $_POST["txtDes"];

            try {
                $hotel->DeleteMovie();
                echo "Movie Deleted Successfully.";
                
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        ?>
    </aside>


    <div class="Hotel-table">
        <form method="post" enctype="multipart/form-data">
        <?php 
        
        $hotels = Hotel::GetHotels();
        if(sizeof($hotels) > 0)
        {
            echo'<table>';
            echo'<thead>
                <tr>
                    <th>Hotel ID</th>
                    <th>Hotel Name</th>
                    <th>Location</th>
                    <th>Small Description</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Update|Delete</th>
                </tr>
                </thead>';
            foreach($hotels as $h)
            {
                echo'<tbody>
                    <tr>
                        <td>'.$h->ID.'</td>
                        <td>'.$h->Name.'</td>
                        <td>'.$h->Location.'</td>
                        <td>'.$h->SmallDes.'</td>
                        <td>'.$h->Description.'</td>
                        <td> <img class="table-img" src="'.$h->Image .'" ></td>
                        <td>
                            <button class="one" type="submit" name="btnEdit" 
                            value="'.$h->ID .'" >
                            To Update
                            </button><br><br>
                            <button class="two" type="submit" name="btnDel" 
                            value="'.$h->ID .'" >
                            Delete 
                            </button>
                        </td>
                    </tr>
                    </tbody>';
            }
            echo'</table>';
        }else{
            echo "No Hotel info";
        }
        ?>
        </form>
    </div>

   
</body>
</html>