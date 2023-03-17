<?php 
session_start();

if (isset($_SESSION['fname']) && isset($_GET['id'])) {
    $sName = "localhost";
    $uName = "root";
    $pass = "";
    $db_name = "je_db";

    $conn = new mysqli($sName, $uName, $pass, $db_name);

    $userId = $_GET['id'];
    $query = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $query->bind_param('i', $userId);
    $query->execute();

    $result = $query->get_result();
    if($data = $result->fetch_assoc()){
        $name = $data['fname'];
    }else{
        header('Location: home.php');
    }
    
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
        
        <div class="card shadow bg-light text-dark col-xxl-5 mx-auto">
            
            <h3 class="fw-bold">Employee Payroll</h3>
            <hr>
            <div class="row row-cols-2 g-2">
                <div class="col">
                    <label class="fw-bold">Name:</label>
                </div>
                <div class="col">
                    <label><?=$name?></label>
                </div>
                <div class="col">
                    <label class="fw-bold">Hours Worked:</label>
                </div>
                <div class="col">
                    <label>
                        <?php
                            $query = "SELECT * FROM attendance WHERE user_id = '$userId'";
                            $attendanceresult = $conn->query($query);
                            //initialize blank working hours
                            $hours_worked = 0;
                            while($attendanceData = $attendanceresult->fetch_assoc()){
                                
                                //calculate hours worked based on the time in time out
                                $timeIn = date_create($attendanceData['time_in']);
                                $timeOut = date_create($attendanceData['time_out']);
                                $difference = date_diff($timeIn,$timeOut);
                                $hours_worked += $difference->format('%h');
                                
                                // $gross_pay = $hourly_rate * $hours_worked;
                                // $total_deductions = $sss + $philhealth + $pagibig + $cash_advance;
                                // $net_pay = $gross_pay - $total_deductions;
                            }
                            echo $hours_worked;
                        ?>
                    </label>
                </div>
            </div>
        </div>
            
    </main> 

    <!------End Main---------->
    
        <!-----php code----->


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
	header("Location: index.php");
	exit;
} ?>

