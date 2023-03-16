<?php
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "je_db";

$conn = new mysqli_connect($sName, $uName, $pass, $db_name);

if($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    echo "<table><tr><th>id</th><th>fname</th><th>uname</th><th>position</th><th>password</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["uname"] . "</td><td>" . $row["position"] . "</td><td>" . $row["password"] . "</td></tr>";
}
echo "</table>";
}else {
    echo "0 results";
}

$conn->close();

?>