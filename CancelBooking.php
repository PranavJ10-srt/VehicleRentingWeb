<?php 
    require('Config.php');
    session_start();
    if (isset($_POST['bid'])) {
        $billID= stripslashes($_REQUEST['bid']); // removes backslashes
        $billID = mysqli_real_escape_string($con, $billID);
        $name = stripslashes($_REQUEST['name']);
        $name = mysqli_real_escape_string($con, $name);
        $model = stripslashes($_REQUEST['model']);
        $model = mysqli_real_escape_string($con,$model);

        $sql = "INSERT INTO `dbms`.`canceltable` (`BillingID`,`Name`,`modelnumber`)
                VALUES('$billID','$name','$model');";
        
        $result = mysqli_query($con, $sql) ;
        if($result==true)
        {
            echo "<h1 class='check'> CANCELLED SUCCESSFULLY</h1>";
        }

    }


?>

<!DOCTYPE HTML-5>
<html>
    <head>
        <meta charset='UTF-8'>
        <title>Cancel Booking</title>
        <link href="CancelBooking.css" rel="stylesheet">

    </head>

    <body>
        <h1>CANCEL YOUR BOOKINGS HERE.</h1>
        <div class="cancelfield">
            <h2>Fill the cancellation form here</h2>
            
            <form action="" method="post">
            <table cellspacing="20px">
                <tr>
                <td><label class="lb">Enter Billing ID:</label></td>
                <td><input type="text" name="bid" autofocus="true"></td>
                </tr>
                <tr><td><label class="lb">Enter Billing name:</label></td>
                <td><input type="text" name="name"></td>
                 </tr>
                 <tr>
                <td><label class="lb">Enter Model Number:</label></td>
                <td><input type="text" name="model"><br></td>
                </tr>
                </table>
                <input class="buttn" type="submit" name="CONFIRM" value="CONFIRM">              
            
            </form>
            
        </div>
    </body>
</html>