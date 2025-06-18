<?php
include("../Conn/Hotel.php");

if(isset($_GET['id']) && !empty($_GET['id'])){
    $hotelId = $_GET['id'];
    $hotel = Hotel::GetHotel($hotelId);

    if($hotel){
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../CSS/Customer.css">
<title>Hotel Details</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
<?php include '../HeaderAndFooter/UserHeader.php'; ?>

<div class="blank">
</div>

<div class="container">
    <img src="<?php echo $hotel->Image; ?>" alt="Hotel Image" class="hotel-image">
    <div class="hotel-name"><?php echo $hotel->Name; ?></div>
    <div class="hotel-location">Location: <?php echo $hotel->Location; ?></div>
    <div class="hotel-description">
        <p><?php echo $hotel->Description; ?></p>
    </div>

    <div class="comment-box">
    <form method="POST">
        <input type="hidden" name="hotel_id" value="<?php echo $hotelId; ?>">
        <input type="hidden" name="hotel_name" value="<?php echo $hotel->Name; ?>">
        <input type="text" name="customer_name" placeholder="Your Name">
        <textarea name="feedback_text" placeholder="Your Feedback" class="comment-input"></textarea>
        <input type="number" name="rating" placeholder="Rating (1-5)">
        <button type="submit" name="comment-submit">Submit Feedback</button>
    </form>

    <?php
        if(isset($_POST['comment-submit'])) {

            

            $hotelID = $_POST['hotel_id'];
            $hotelName = $_POST['hotel_name'];
            $customerName = $_POST['customer_name'];
            $feedbackText = $_POST['feedback_text'];
            $rating = $_POST['rating'];

            $feedback = new feedback();

            $feedback->HotelID = $hotelID;
            $feedback->HotelName = $hotelName;
            $feedback->CustomerName = $customerName;
            $feedback->Feedback = $feedbackText;
            $feedback->Rating = $rating;

            try {
                $feedback->AddFeedback();
                echo "Feedback added successfully!";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    ?>

    </div>

</div>

<?php include '../HeaderAndFooter/UserFooter.php'; ?>
</body>
</html>
<?php
    } else {
        echo "Hotel not found.";
    }
} else {
    echo "Invalid request.";
}
?>
