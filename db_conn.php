<?php 

$sName = "localhost";
    $uName = "u521072993_capstone";
    $pass = "Kodego123";
    $db_name = "u521072993_payroll_db";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}

//data object type
?>