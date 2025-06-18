<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/AdminCSS.css">
    <title>Admin Register</title>
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

            <p>Already have an Account ? <a href="Admin_Login.php">Login..!</a></p>
        </form>

        <?php
        if(isset($_POST["Register"]))
        {

            include("../Conn/Admin.php");

            $admin = new Admin;

            $admin->Name = $_POST["txtName"];
            $admin->NIC = $_POST["txtNIC"];
            $admin->Email = $_POST["txtEmail"];
            $admin->Mobile = $_POST["txtMobile"];
            $admin->Password = $_POST["txtPassword"];

            try{
                $admin->AddAdmin();
                echo "Registered Successfully";
                header("Location:Admin_Login.php");
            }catch(Exception $e){
                throw $e;
            }
        }
        ?>
    </div>
</body>
</html>