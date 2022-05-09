<?php
require('Config.php');
      session_start();
      // When form submitted, check and create user session.
      if (isset($_POST['email'])) {
        $email= stripslashes($_REQUEST['email']); // removes backslashes
        $email = mysqli_real_escape_string($con, $email);
        $pass = stripslashes($_REQUEST['password']);
        $pass = mysqli_real_escape_string($con, $pass);
      
      // $email="";
      // $pass="";
      // Check user is exist in the database
      //$fullname="hi";
      // $sql = "SELECT * FROM `users` WHERE Fullname='$name' AND password=' " . md5($pass) . "'";     

      $sql = "INSERT INTO `dbms`.`users` ( `email` , `password`) VALUES ('$email' ,'$pass' );";
      
      $result = mysqli_query($con, $sql) ;
      
      // // $rows = mysqli_num_rows($result);
      // if($result)
      //  {
      //   //  $_SESSION['name'] = $name;
      //   //  header("Location: mainpage.php");
      //   echo "registered";

      //  }
      //  else{
      //    echo "not connected";
        }
  ?>





<!DOCTYPE html-5>
<html>

<head>
  <meta charset utf-8 />
  <title>Register</title>
  <link rel="icon" href="https://us.123rf.com/450wm/pandavector/pandavector1601/pandavector160100926/51198559-car-black-simple-icon-on-white-background-for-web-design.jpg?ver=6" />
  <link rel="stylesheet" href="Register.css" />
</head>

<body>
  
  <div class="container">
    <p align="center">
      REGISTER
    </p>
    <form action="" method="post"  name="Register">
      <table cellspacing="20px">

        <tr>


          <td><label>Enter email:</label></td>
          
          <td><input type="text" name="email" placeholder="email" autofocus="true" value=""></td>
        </tr>

        <tr>


          <td><label>Enter password:</label></td>
          <td><input type="password" name="password" placeholder="password"/></td>
        </tr>

        <tr>


          <!-- <td><label>Enter name:</label></td>
          <td><input type="text" name="name" placeholder="name"/></td>
        </tr>

        <tr>


          <td><label>Enter phone</label></td>
          <td><input type="text" name="phone" placeholder="phone number"/></td>
        </tr>

        <tr>


          <td><label>Enter address:</label></td>
          <td><input type="text" name="address" placeholder="address"/></td>
        </tr> -->
      </table>
      <input class="sub" type="submit" name="Register" value="Register" width="20px">
      
    </form>
  </div>

  <p class="welcome">
    WELCOME TO E-VEHICLE RENTING SYSTEM!!!
  </p>
  <h2 class="reg">Regards : Anvay , Sejal , Suyash & Pranav</h2>
</body>

</html>
