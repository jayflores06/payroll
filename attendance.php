<?php
session_start();

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "je_db";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {
    // Handle clock in and clock out
    if (isset($_POST['clock_in']) && isset($_POST['attendance_id'])) {
        $id = $_SESSION['id'];
        $attendanceId = $_POST['attendance_id'];
        $fname = $_SESSION['fname'];
        $date = date("Y-m-d");
        $time_in = date("Y-m-d H:i:s");
        $stmt = $conn->prepare("UPDATE attendance SET time_in = ? WHERE user_id = ? AND id = ?");
        $stmt->execute([$time_in, $id, $attendanceId]);
        echo "Clock in successful!";
    } elseif (isset($_POST['clock_out']) && isset($_POST['attendance_id'])) {
        $id = $_SESSION['id'];
        $attendanceId = $_POST['attendance_id'];
        $date = date("Y-m-d");
        $time_out = date("Y-m-d H:i:s");
        $stmt = $conn->prepare("UPDATE attendance SET time_out = ? WHERE user_id = ? AND id = ?");
        $stmt->execute([$time_out, $id, $attendanceId]);
        $stmt = $conn->prepare("INSERT INTO attendance (user_id,time_in,time_out) VALUES (?,?,?)");
        $stmt->execute([$id, '0000-00-00', '0000-00-00']);
        echo "Clock out successful!";
    }
?>

<!-- HTML code for the attendance page -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!------Monserrat------->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">

    <!------Icons------->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-----CSS--------->
	<link href="dashboard.css" rel="stylesheet">
	<title>Attendance</title>  
</head>
<body>
    <div class="grid-container">

    <!------Header---------->
    <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div>

        <div class="header-right">
            <h3 class="display-4 ">Welcome, <?=$_SESSION['fname']."!"?></h3>
        </div>
    </header>
    <!------End Header---------->

    <!------Side Bar---------->
    <aside id="sidebar">
        <div class="sidebar-title">
            <div class="sidebar-brand">
            <span class="material-icons-outlined">account_balance</span>Kodego Payroll
            </div>
            <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">dashboard</span><a href="home.php">Dashboard</a>
            </li>
            <li class="sidebar-list-item">
            <span class="material-icons-outlined">schedule</span><a href="attendance.php">Attendance</a>
            </li>
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">request_page</span><a href="request.php">Request</a></li>
            </li>
        </ul>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </aside>
    <!------End Side Bar---------->

    <!------Main---------->
    <main class="main-container">
        <div class="content text-center">
            <h2 class="text-center">Attendance</h2>
            <p class="text-center">Here you can clock in and out:</p>
            <div><i class="bi bi-clock"></i></div>
            <p>Current Philippine Date and Time: <?php echo date("Y-m-d H:i:s") ?></p>
            <form method="post">
            <?php
    // Check if the user has already clocked in today
    $id = $_SESSION['id'];
    $date = date("Y-m-d");
    $stmt = $conn->prepare("SELECT * FROM attendance WHERE user_id = ? ORDER BY id DESC");
    $stmt->execute([$id]);


    if($attendance = $stmt->fetch()){
        // If the user hasn't clocked in yet, display the clock-in button
        if ($attendance['time_in'] == '0000-00-00 00:00:00' && $attendance['time_out'] == '0000-00-00 00:00:00') {
            echo '<button type="submit" name="clock_in" class="btn btn-primary">Clock In</button><input type="hidden" value="' . $attendance['id'] . '" name="attendance_id">';
        }
        // If the user has clocked in but not yet clocked out, display the clock-out button
        else if ($attendance['time_in'] != '0000-00-00 00:00:00' && $attendance['time_out'] == '0000-00-00 00:00:00') {
            echo '<button type="submit" name="clock_out" class="btn btn-primary">Clock Out</button><input type="hidden" value="' . $attendance['id'] . '" name="attendance_id">';
        }
    }else{
        $stmt = $conn->prepare("INSERT INTO attendance (user_id,time_in,time_out) VALUES (?,?,?)");
        $stmt->execute([$id, '0000-00-00', '0000-00-00']);
    }
    
?>


</form>
</div>
</main>
<!------End Main---------->

</body>
</html>
<?php 
} else {
	header("Location: login.php");
	exit;
} 
?>
