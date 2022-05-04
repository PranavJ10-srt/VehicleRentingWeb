
<?php
require('Config.php');
      session_start();
      
      if (isset($_POST['email'])) {
        $email= stripslashes($_REQUEST['email']); // removes backslashes
        $email = mysqli_real_escape_string($con, $email);
        $pass = stripslashes($_REQUEST['password']);
        $pass = mysqli_real_escape_string($con, $pass);
      
       
      $sql = "SELECT * FROM `dbms`.`users` WHERE `email`='$email' AND `password`='$pass';";
      // if($sql!=NULL)
      // {
      $result = mysqli_query($con, $sql) ;
      
      $rows = mysqli_num_rows($result);
      if($rows>=1)
      {
       $_SESSION['name'] = $name;
       header("Location: mainpage.php");
       echo "registered";

       }
        else{
         echo "<h1><strong>INVALID CREDENTIALS!!!!!</strong></h1>";
       }
       }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://us.123rf.com/450wm/pandavector/pandavector1601/pandavector160100926/51198559-car-black-simple-icon-on-white-background-for-web-design.jpg?ver=6" />
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
    
</head>
<body>
<div class="container">
    <p align="center">
      LOGIN
    </p>
    <form action="" method="post" >
      <table cellspacing="20px">

        <tr>


          <td><label>Enter email:</label></td>
          
          <td><input type="text" name="email" placeholder="email" autofocus="true" value=""></td>
        </tr>

        <tr>


          <td><label>Enter password:</label></td>
          <td><input type="password" name="password" placeholder="password"/></td>
        </tr>
      </table>
      <input  class="sub" type="submit" name="Login" value="LOGIN" width="20px">
      <!-- <input class="signup" type="submit" name="Signup" value="NewUser?" width="20px" /> -->
    </form>
    <form action="Register.php">
      <input class="signup" type="submit" name="Signup" value="NewUser?" width="20px" />
    </form>
  </div>

  <p class="welcome">
    WELCOME TO E-VEHICLE RENTING SYSTEM!!!
  </p>
  <h2 class="reg">Regards : Anvay , Sejal , Suyash & Pranav</h2>
</body>
</html>