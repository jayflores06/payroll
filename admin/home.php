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
	<link href="dashboard.css" rel="stylesheet">
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
	
    <!------Main---------->
    <main class="main-container">
        <div class="main-title">
            <h2>Dashboard</h2>
        </div>

        <div class="main-cards">
            <div class="card">
                <div class="card-inner">
                <h3>Present</h3>
                    <span class="material-icons-outlined">people_alt</span>
                    <h1>9</h1>
                </div>
            </div>

            <div class="card">
                <div class="card-inner">
                <h3> Absent</h3>
                <span class="material-icons-outlined">calendar_month</span>
                    <h1>1</h1>
                </div>
            </div>

            <div class="card">
                <div class="card-inner">
                <h3>On Time</h3>
                <span class="material-icons-outlined">history</span>
                    <h1>8</h1>
                </div>
            </div>

            <div class="card">
                <div class="card-inner">
                <h3>Late</h3>
                <span class="material-icons-outlined">warning</span>
                    <h1>1</h1>
                </div>
            </div>
        </div>

        <div class="charts">
            <div class="charts-card">
                <h2 class="chart-title">Attendance</h2>
                <div id="bar-chart"></div>
            </div>
        </div>
    </main>
    <!------End Main---------->
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

