<?php 
session_start();

if (isset($_SESSION['fname'])) {
    $sName = "localhost";
    $uName = "u521072993_capstone";
    $pass = "Kodego123";
    $db_name = "u521072993_payroll_db";

    $conn = new mysqli($sName, $uName, $pass, $db_name);
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
                <a href="logout.php" class="btn btn-warning">
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
                <span class="material-icons-outlined">dashboard</span><a style="text-decoration: none; color: white" href="home.php">Dashboard</a>
            </li>
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">dashboard</span><a style="text-decoration: none; color: white" href="requests.php">Leave Requests</a>
            </li>
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">employee</span><a style="text-decoration: none; color: white" href="employee.php">Employees List</a></li>
            </li>
            <li class="sidebar-list-item">
                <span class="material-icons-outlined">request_page</span><a style="text-decoration: none; color: white" href="registration.php">Registration</a></li>
            </li>
            
        </ul>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </aside>
    <!----------ENd of sidebar--------->
	/*
    <!-- ----Main---------->
    
    <main class="main-container">
        <div class="card bg-light">
            <div class="card-body">
                <div class="main-title text-dark">
                    <h2 class="fw-bold">Dashboard</h2>

                </div>
                <hr class="bg-dark">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th name="fname">Full Name</th>
                                <th name="uname">User Name</th>
                                <th name="position">Position</th>
                                <th name="password">Password</th>
                                <th name="action">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($conn->connect_error) {
                                die("connection failed:" . $conn->connect_error);
                            }
                            $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);

                        ?>
                            <?php
                                while($row = $result->fetch_assoc()){
                            ?>
                            <tr>
                                <td name="fname"><?=$row['fname']?></td>
                                <td name="uname"><?=$row['username']?></td>
                                <td name="position"><?=$row['position']?></td>
                                <td name="password"><?=$row['password']?></td>
                                <td name="action">
                                    <a style="text-decoration:none" href="employee-payroll.php?id=<?=$row['id']?>"><button class="btn btn-dark">View Employee</button></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>

                    </table>
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

