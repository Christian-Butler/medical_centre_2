<?php
$servername = "localhost";
$username = "root";
$password = "root";  //this is password for MAMP, Xampp is blank (change this)
$dbname = "movie_production";
  
try{
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
     // echo "Connected to database successfully";  
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
        
?>