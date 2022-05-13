<?php 
  require('Config.php');
  session_start();
      
      if (isset($_POST['name'])) 
      {
        $name= stripslashes($_REQUEST['name']); // removes backslashes
        $name = mysqli_real_escape_string($con, $name);
       

        $sql_bike = "SELECT * FROM `dbms`.`book_bike` WHERE `Custname`='$name';";
        $sql_car = "SELECT * FROM `dbms`.`book_car` WHERE `Custname`='$name';";
      
        $result_bike = mysqli_query($con, $sql_bike) ;
        $result_car = mysqli_query($con , $sql_car);
      
       $rows_bike = mysqli_num_rows($result_bike);
       $rows_car = mysqli_num_rows($result_car);
       if($rows_car<=0 && $rows_bike<=0)
       {
           echo "<h2 class = 'emptybook'>No Bookings done so far!...</h2>";
       }
      if($rows_bike>0)
       {
            echo "<div class = 'entrybike'>";
            while($bikecursor = mysqli_fetch_array($result_bike))
            {
                echo "<br>";
                
                echo "<br><strong>Booking ID :</strong>" . $bikecursor['BookingID']."<br><strong>Customer name :</strong>" . $bikecursor['Custname'] . "<br><strong>modelnumber :</strong>" . $bikecursor['modelnumber'] . "<br><strong>Booked on :</strong>" . $bikecursor['startdate'] . "<br><strong>Return date :</strong>" . $bikecursor['returndate']; 
                
            }echo "</div>"; 

       }

            if($rows_car>0)
           {
               echo "<div class='entrycar'>";
            while($carcursor = mysqli_fetch_array($result_car))
            {
                echo "<br>";
                echo "<br><strong>Booking ID:</strong>" . $carcursor['BookingID']."<br><strong>Customer name :</strong>" . $carcursor['Custname'] . "<br><strong>modelnumber :</strong>" . $carcursor['model'] . "<br><strong>Booked on :</strong>" . $carcursor['startdate'] . "<br><strong>Return date :</strong>" . $carcursor['returndate']; 
            }echo "</div>";
          }


    }

?>
<!DOCTYPE HTML-5>
<html>
    <head>
        <meta charset='UTF-8'>
        <title>View Bookings</title>
        <link href="ViewBooking.css" rel="stylesheet">

    </head>



    <body>
        <h1> YOUR BOOKINGS</h1>
        
        <form action="" method="post">
          <label>Enter Your Name</label>
          <input type="text" name="name" placeholder="name" autofocus="true">;
           <input type="submit" name="View" width="20px">;
        </form>
    </body>
</html>