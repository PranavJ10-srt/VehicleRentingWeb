<?php 
   
   require('Config.php');
   session_start();
   if(isset($_POST['name']))
   {
    $name= stripslashes($_REQUEST['name']); // removes backslashes
    $name = mysqli_real_escape_string($con, $name);
    $model = stripslashes($_REQUEST['modelnum']);
    $model = mysqli_real_escape_string($con, $model);
    $address= stripslashes($_REQUEST['addr']); // removes backslashes
    $address = mysqli_real_escape_string($con, $address);
    $id = stripslashes($_REQUEST['ID']);
    $id = mysqli_real_escape_string($con, $id);
    $startdate = stripslashes($_REQUEST['startdate']);
    $startdate = mysqli_real_escape_string($con, $startdate);
    $retdate = stripslashes($_REQUEST['retdate']);
    $retdate = mysqli_real_escape_string($con, $retdate);
    
    $sql = "INSERT INTO `dbms`.`book_bike`  (`Custname` , `modelnumber` , `address` , `License` ,`startdate`, `returndate`)
             VALUES ('$name' , '$model' , '$address' , '$id' , '$startdate','$retdate');";
    
    $statusform;
    $result = mysqli_query($con, $sql) ;
    if($result==true)
    {
        $statusform = 1;
        echo "<h1>Successful</h1>";
    }
    else{
        $statusform=0;
        echo "<h1>unsuccessful</h1>";
    }

   }



?>
<!DOCTYPE html-5>
<html>
    <head>
        <meta charset="UTF-8">
        <title>2WheelerBooking</title>
        <link href="TwoWheelBook.css" rel="stylesheet">
    </head>
    <body>
    <div class="navbartype">
        <div class="leftmost">
            <strong>Vehicle<br>
            Renting</strong>
        </div>
        <div class="rightmost">
            <a class="abtus" href="aboutus.html">ABOUT US</a> 

        </div>
        <div class="logout">
            <a href="Login.php">Signout</a>
        </div>
    </div>

    <a href="Payment_bike.php">
    <div class="pay">
         <strong> Make<br>
            Payment</strong>
      </div></a>

         <h1 class="heading" >TWO WHEELERS SECTION</h1>
        <div class="bookingdetails">
        <form method="post" >
          <table cellspacing=20px>
           <tr> 
               <td> <label>Enter Your name</label></td>
                <td>    <input type="text" name="name" size="70"></td>
            </tr>
            <tr> 
            <td><label>Enter model number</label></td>
            <td><input type="text" name = "modelnum" size="70"></td>
            </tr>
            <tr> 
            <td><label>Enter address</label></td>
            <td><input type="text" name="addr" size="70"></td>
            </tr>
            <tr>
            <td><label>Enter DriverLicense ID</label></td>
            <td><input type="text" name="ID" size="70"></td>
            </tr>
            <tr>   
            <td><label>Enter Start date</label></td>
            <td><input type="text" name="startdate" size="70" placeholder="YYYY-MM-DD"></td>
            </tr>

             <tr>   
            <td><label>Enter Return Date</label></td>
            <td><input type="text" name="retdate" size="70" placeholder="YYYY-MM-DD"></td>
            </tr>
          </table>
          <input  class="sub" type="submit" name="ConfirmBooking" value="ConfirmBooking" width="20px">
        </form>
      </div>

    

    </body>
</html>