<?php

include("../Conn/Customer.php");

if(isset($_POST["btnEdit"])){
    $alluser=Customer::GetCustomer($_POST["btnEdit"]);
}

if(isset($_POST["btnDel"])){
    $alluser=Customer::GetCustomer($_POST["btnDel"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/LoginReg.css">
    <link rel="stylesheet" href="../CSS/AdminCSS.css">
    <title>Customer List</title>
</head>
<body>
<?php include '../HeaderAndFooter/AdminHeader.php'; ?>
    <div class="user-box">
        <form action="" method="post">
            <label>Name: </label>
            <input type="text" name="txtName" placeholder="Name" required
            value="<?php if(isset($alluser))
            echo $alluser->Name;
            ?>"><br><br>

            <label>NIC: </label>
            <input type="text" name="txtNIC" placeholder="NIC" required
            value="<?php if(isset($alluser))
            echo $alluser->NIC;
            ?>"><br><br>

            <label>Email: </label>
            <input type="text" name="txtEmail" placeholder="Email" required
            value="<?php if(isset($alluser))
            echo $alluser->Email;
            ?>"><br><br>

            <label>Mobile: </label>
            <input type="text" name="txtMobile" placeholder="Mobile" required
            value="<?php if(isset($alluser))
            echo $alluser->Mobile;
            ?>"><br><br>

            <label>Password: </label>
            <input type="text" name="txtPassword" placeholder="Password" required
            value="<?php if(isset($alluser))
            echo $alluser->Password;
            ?>"><br><br>

            <input type="submit" value="Update" name="btnUpdate">
            <input type="submit" value="Delete" name="btnDelete">
        </form>
        <?php
        if(isset($_POST["btnUpdate"]))
        {
            $cust=new customer;

            $cust->Name = $_POST["txtName"];
            $cust->NIC = $_POST["txtNIC"];
            $cust->Email = $_POST["txtEmail"];
            $cust->Mobile = $_POST["txtMobile"];
            $cust->Password = $_POST["txtPassword"];

            try{
                $cust->UpdateCustomer();
                
                echo "Staff Details Upadted Successfully.";
                
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        else if(isset($_POST["btnDelete"]))
        {
            $cust=new customer;

            $cust->Name = $_POST["txtName"];
            $cust->NIC = $_POST["txtNIC"];
            $cust->Email = $_POST["txtEmail"];
            $cust->Mobile = $_POST["txtMobile"];
            $cust->Password = $_POST["txtPassword"];

            try {
                $cust->DeleteCustomer();
                echo "Staff details Deleted Successfully.";
                
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit;
            } catch(Exception $e) {
                echo $e->getMessage();
            }
        }
        ?>
    </div>

    <div class="Cust-table">
        <form method="post" enctype="multipart/form-data">
        <?php 
        $customers = Customer::GetCusts();
        if(sizeof($customers) > 0)
        {
            echo'<table>';
            echo'<thead>
                <tr>
                    <th>NIC</th>
                    <th>Staff Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Password</th>
                    <th>Delete</th>
                </tr>
                </thead>';
            foreach($customers as $c)
            {
                echo'<tbody>
                    <tr>
                        <td>'.$c->NIC.'</td>
                        <td>'.$c->Name.'</td>
                        <td>'.$c->Email.'</td>
                        <td>'.$c->Mobile.'</td>
                        <td>'.$c->Password.'</td>
                        <td>
                            <button class="two" type="submit" name="btnDel" 
                            value="'.$c->NIC .'" >
                            Delete 
                            </button>
                        </td>
                    </tr>
                    </tbody>';
            }
            echo'</table>';
        }else{
            echo "No Customer info";
        }
        ?>
        </form>
    </div>
</body>
</html>