<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/LoginReg.css">
    <title>Document</title>
</head>
<body>
<div id="form" class="Login-box">
        <h1>Login</h1>
        <form method="post" name="form">
            <label>Email: </label>
            <input type="text" id="user" name="user"><br><br>

            <label>Password: </label>
            <input type="password" id="pass" name="pass"><br><br>
            
            <input type="submit" id="btn" value="Login" name="submit">

            <p>Do not have an Account.. <a href="custReg.php">Register..!</a> </p>
        </form>

        <?php
        include("../Conn/Customer.php");

        if(isset($_POST['submit'])) {
            $username = $_POST['user'];
            $password = $_POST['pass'];

            $hashedPassword = $password;

            $cust =new Customer;
            $cust->GetCustLogin($username);
            $cust->username=$username;
            

            if ($cust->Email) {
                if ($hashedPassword === $cust->Password) {
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: home.php");
                    exit();
                } else {
                    echo "Incorrect password";
                }
            } else {
                echo "User not found";
            }
            
        }
        ?>       
    </div>
</body>
</html>