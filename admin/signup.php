<?php
    $sName = "localhost";
    $uName = "root";
    $pass = "";
    $db_name = "je_db";

    $conn = mysqli_connect($sName, $uName, $pass, $db_name);
        
    function generatePassword($length = 12) {
        $possibleChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $password .= $possibleChars[mt_rand(0, strlen($possibleChars)-1)];
        }
        return $password;

    $password = generatePassword();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = mysqli_real_escape_string($conn, $_POST["Fname"]);
        $username = mysqli_real_escape_string($conn, $_POST["uname"]);
        $position = mysqli_real_escape_string($conn, $_POST["position"]);

        $password = generatePassword();

        $sql = "INSERT INTO users (fname, username, position, password) VALUES ('$fname', '$username', '$position', '$password')";

        if(mysqli_query($conn, $sql)) {
            header("Location: registration.php?success=Your account has been created successfully");
        }  else {
            header("Location: registration.php?failed=Your account ha not been successfully created");
        }
    }
    mysqli_close($conn);

         
    
?>