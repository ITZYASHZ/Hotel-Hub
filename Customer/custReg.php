<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/LoginReg.css">
    <title>Document</title>
</head>
<body>
    <div class="register-box">
        <form action="" method="post">
            <label>Name: </label>
            <input type="text" name="txtName" placeholder="Name" required><br><br>

            <label>NIC: </label>
            <input type="text" name="txtNIC" placeholder="NIC" required><br><br>

            <label>Email: </label>
            <input type="text" name="txtEmail" placeholder="Email" required><br><br>

            <label>Mobile: </label>
            <input type="text" name="txtMobile" placeholder="Mobile" required><br><br>

            <label>Password: </label>
            <input type="text" name="txtPassword" placeholder="Password" required><br><br>

            <input type="submit" value="Register" id="btn" name="Register">

            <p>Already have an Account ? <a href="CustLogin.php">Login..!</a></p>
        </form>

        <?php
        if(isset($_POST["Register"]))
        {

            include("../Conn/Customer.php");

            $cust = new Customer;

            $cust->Name = $_POST["txtName"];
            $cust->NIC = $_POST["txtNIC"];
            $cust->Email = $_POST["txtEmail"];
            $cust->Mobile = $_POST["txtMobile"];
            $cust->Password = $_POST["txtPassword"];

            try{
                $cust->AddCust();
                echo "Registered Successfully";
                header("Location:CustLogin.php");
            }catch(Exception $e){
                throw $e;
            }
        }
        ?>
    </div>
</body>
</html>