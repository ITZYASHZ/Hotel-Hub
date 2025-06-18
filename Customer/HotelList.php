<?php
include("../Conn/Hotel.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Customer.css">
    <title>Hotel list</title>
</head>
<style>
    .List {
        padding: 1rem 7%;
        background: url('../Images/back1.jpg');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
<body>

<?php include '../HeaderAndFooter/UserHeader.php'; ?>

<nav class="List" id="List-page">
    <div class="allList">
        <form class="search-form" method="get" action="HotelList.php"> <!-- Changed action to "HotelList.php" -->
            <input class="search-input" type="text" name="search" placeholder="Search hotels by name">
            <button class="search-button" type="submit">Search</button>
        </form>

        <?php
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $hotels = Hotel::SearchHotelsByName($search);
        } else {
            $hotels = Hotel::GetHotels();
        }

        echo '<div class="main-List">';
        foreach ($hotels as $h) {
            echo '
            <div class="List-inner-content">
                <div class="List-image">
                    <img src="' . $h->Image . '" alt="">
                </div>
                <div class="List-text-content">
                    <h1>' . $h->Name . '</h1>
                    <p>' . $h->Location . '</p><br>
                    <p>' . $h->SmallDes . '</p><br>
                    <a href="HotelDetail.php?id=' . $h->ID . '">View</a>
                </div>
            </div>';
        }

        echo '</div>';
        ?>

    </div>
</nav>

<?php include '../HeaderAndFooter/UserFooter.php'; ?>
</body>
</html>
