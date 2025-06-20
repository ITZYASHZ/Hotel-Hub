<?php
include("../Conn/Customer.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: CustLogin.php");
    exit();
}echo '<p style="color: black;, paddin-top=2%;">Welcome,'.$_SESSION['username'].'! You are now on the home page.</p>';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Customer.css">
    <title>Home page</title>
</head>
<style>
    .home{
    padding: 1rem 7%;
    background: url('../Images/background.jpg');
    height: 120vh;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    }
</style>
<body>
<?php include '../HeaderAndFooter/UserHeader.php'; ?>

    <nav class="home" id="home-page" >
        <div class="main-home">
            <div class="home-inner-content">
    
            </div>
            <div class="home-inner-content">
                <div class="home-text-content">
                    <h1>Welcome to Hotel Hub</h1>
                    <p>Way to fine what is best for you!</p><br>
                    <a href="HotelList.php">Look resturants.</a>
                </div>
            </div>
        </div>
    </nav>

<?php include '../HeaderAndFooter/UserFooter.php'; ?>

</body>
</html>