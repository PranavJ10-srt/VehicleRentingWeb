<?php
require('Config.php');
      session_start();
      
      if (isset($_POST['bookid'])) {
        $bid= stripslashes($_REQUEST['bookid']); // removes backslashes
        $bid = mysqli_real_escape_string($con, $bid);
        $model = stripslashes($_REQUEST['model']);
        $model = mysqli_real_escape_string($con, $model);
        $mode = stripslashes($_REQUEST['mode']);
        $mode = mysqli_real_escape_string($con, $mode);
       
      $sql_amt = "SELECT `TOTALCOST_CAR`('$bid' , '$model' , '$mode');";
      $sql_row = "SELECT * FROM `payment_car` WHERE `BookingID`='$bid';";
      // if($sql!=NULL)
      // {
        $result_amt = mysqli_query($con , $sql_amt);
        $result_row = mysqli_query($con, $sql_row) ;
      
      $rows_amt = mysqli_num_rows($result_amt);
      $rows = mysqli_num_rows($result_row);

      if($rows>1)
      {
        echo "<h2><strong>Payment Done Already</strong></h2>";
      }

      else if($rows>=1)
      {
      //  $_SESSION['name'] = $name;
      //  header("Location: mainpage.php");
      //  echo "registered";

            echo "<div class = 'payentry'>";
            while($carcursor = mysqli_fetch_array($result_row))
            {
                echo "<br>";
                
                echo "<br><strong>PaymentID : </strong>" . $carcursor['PaymentID']."<br><strong>BookingID :</strong>" . $carcursor['BookingID'] . "<br><strong>modelnumber :</strong>" . $carcursor['modelnumber'] ."<br><strong>Number OF Days: </strong> ".$carcursor['Days_booked']. "<br><strong>Amount : RS </strong>" . $carcursor['Amount'] . "<br><strong>Mode of Payment :</strong>" . $carcursor['Payment_type']; 
                
            }echo "</div>";

            } 
        else{
         echo "<h1><strong>INVALID BOOKING ID</strong></h1>";
       }
       }
?>


<!DOCTYPE html-5>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PaymentGateway</title>
    <link rel= "stylesheet" href="Payment.css">
</head>
<body>
    <h1><strong>FIND YOUR PAYMENT DETAILS HERE</strong><h1>
    <div class = "paymentdetails">
    <form action="" method="post" >
      <table cellspacing="20px">

        <tr>
          <td><label>Enter Booking ID:</label></td>
          <td><input type="text" name="bookid" placeholder="ID" autofocus="true" value=""></td>
        </tr>
         <tr>
          <td><label>Enter Modelnumber:</label></td>
          <td><input type="text" name="model" placeholder="modelnumber"/></td>
        </tr>
        <tr>
          <td><label>Mode of Payment:</label></td>
          <td><input type="text" name="mode" placeholder="Card/Cash"/></td>
        </tr>
      </table>
      <input  class="sub" type="submit" name="Submit" value="Submit" width="20px">
      <!-- <input class="signup" type="submit" name="Signup" value="NewUser?" width="20px" /> -->
    </form>
    </div>
    
</body>
</html>