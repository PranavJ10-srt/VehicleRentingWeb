<?php
      
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'dbms');
      // $server = "localhost";
      // $username = "root";
      // $password = "";
      // $dbname = "dbms";
      $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
      if($con==false)
      {
        echo "not connected";
      }

      ?>