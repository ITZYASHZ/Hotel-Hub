<?php
include("../Conn/Hotel.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
</head>
<body>
<?php include '../HeaderAndFooter/AdminHeader.php'; ?>

<div class="feedback-table">
        <h1>Customer Feedbacks</h1>
        <form action="" method="post">
            <?php 
            $feedback=feedback::GetFeedbacks();
            if(sizeof($feedback)>0)
            {
                echo '<table>';
                echo '<tr>
                        <th>Hotel ID</th>
                        <th>Hotel Name</th>
                        <th>Customer name</th>
                        <th>Feedback</th>
                        <th>Rating</th>
                        </tr>';

                foreach($feedback as $f)
                {
                    echo '<tr>
                            <td>'.$f->HotelID.'</td>
                            <td>'.$f->HotelName.'</td>
                            <td>'.$f->CustomerName.'</td>
                            <td>'.$f->Feedback.'</td>
                            <td>'.$f->Rating.'</td>
                        </tr>';
                }
                echo '</table>';
            }else{
                echo "No Customer Feedbacks...!";
            }
            
            ?>
        </form>
    </div>
</body>
</html>