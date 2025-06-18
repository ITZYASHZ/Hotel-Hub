<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/AdminCSS.css">
    <title>Admin Login</title>
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

            <p>Do not have an Account.. <a href="Admin_Reg.php">Register..!</a> </p>
        </form>

        <?php
        include("../Conn/Admin.php");

        if(isset($_POST['submit'])) {
            $username = $_POST['user'];
            $password = $_POST['pass'];

            $hashedPassword = $password;

            $admin =new Admin;
            $admin->GetAdminLogin($username);
            $admin->username=$username;
            

            if ($admin->Email) {
                if ($hashedPassword === $admin->Password) {
                    session_start();
                    $_SESSION['username'] = $username;
                    header("Location: AdminDashboard.php");
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