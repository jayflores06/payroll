<?php 
session_start();

if (isset($_SESSION['fname'])) {
 ?>
 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!------Monserrat------->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">

    <!------Material Icons------->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">

    <!-----CSS--------->
	<link href="employee.css" rel="stylesheet">
	<title>Admin Dashboard</title>
</head>
<body>
    <div class="grid-container">
    
    <!-------Header------>
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="heaer-right">
                <h3 class="display-4">Welcome, Admin</h3>
            </div>

            <div class="text-center mt-3 float-end" id="btn-logout">
                <a href="adminLogin.php" class="btn btn-warning">
                    Logout
                </a>
            </div>    
        </header>          
    <!-------- ENd of Header------>

    <!-----Side Bar-------->
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
            <span class="material-icons-outlined">attendance</span><a href="attendance.php">Attendance</a>
            </li>
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">employee</span><a href="employee.php">Employees List</a></li>
            </li>
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">request_page</span><a href="registration.php">Registration</a></li>
            </li>
            
        </ul>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </aside>
    <!----------ENd of sidebar--------->
	/*
    <!-- ----Main---------->
    
    <main class="main-container">
        <div class="main-title">
            <h2>Dashboard</h2>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th name="id">ID</th>
                        <th name="fname">FULLNAME</th>
                        <th name="uname">USERNAME</th>
                        <th name="position">POSITION</th>
                        <th name="password">PASSWORD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td name="id"><?php echo (isset($_GET['id']))?$_GET['id']:"" ?></td>
                        <td name="fname"><?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?></td>
                        <td name="uname"><?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?></td>
                        <td name="position"><?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?></td>
                        <td name="password"><?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
            
    </main> 

    <!------End Main---------->
    
        <!-----php code----->
        <?php
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "je_db";

$conn = mysqli_connect($sName, $uName, $pass, $db_name);

if($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    echo "<table><tr><th>id</th><th>fname</th><th>username</th><th>position</th><th>password</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["fname"] . "</td><td>" . $row["username"] . "</td><td>" . $row["position"] . "</td><td>" . $row["password"] . "</td></tr>";
    }
    echo "</table>";
}else {
    echo "0 results";
}

$conn->close();

?>

    <!------end---->

    </div>

    <!--------Scripts------------------->
    <!--------Apex Charts------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.1/apexcharts.min.js"></script>
    <!-----------js--------->
    <script src="script.js"></script>

	

</body>
</html>

<?php }else {
	header("Location: home.php");
	exit;
} ?>

