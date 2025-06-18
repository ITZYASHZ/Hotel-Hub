<?php
include("../Conn/Admin.php");
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: Admin_Login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/AdminCSS.css">
    <title>Admin Dashboard</title>
</head>
<body>
<?php include '../HeaderAndFooter/AdminHeader.php'; ?>

    <main>
        <form method="post" enctype="multipart/form-data">
        <?php 
        $admins = Admin::GetAdmins();
        if(sizeof($admins) > 0)
        {
            echo'<table>';
            echo'<thead>
                <tr>
                    <th>Name </th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
                </thead>';
            foreach($admins as $a)
            {
                echo'<tbody>
                    <tr>
                        <td>'.$a->Name.'</td>
                        <td>'.$a->Email.'</td>
                        <td>Active</td>
                    </tr>
                    </tbody>';
            }
            echo'</table>';
        }else{
            echo "No Movie info";
        }
        ?>
        </form>
    </main>

</body>
</html>