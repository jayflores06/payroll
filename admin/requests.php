<?php 
session_start();

if (isset($_SESSION['fname'])) {
    $sName = "localhost";
    $uName = "u521072993_capstone";
    $pass = "Kodego123";
    $db_name = "u521072993_payroll_db";

    $conn = new mysqli($sName, $uName, $pass, $db_name);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $approval = $_POST['approval'];
        $requestId = $_POST['id'];

        $query = $conn->prepare('UPDATE leave_request SET approval = ? WHERE id = ?');
        $query->bind_param('si', $approval, $requestId);
        $query->execute();
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
    <!-- ----Main---------->
    
    <main class="main-container">
        <div class="card bg-light shadow">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Leave Type</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Approval</th>
                        <th scope="col">Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM leave_request";
                            $result = $conn->query($query);
                            while($data = $result->fetch_assoc()){
                                $userId = $data['user_id'];
                                $query = "SELECT fname FROM users WHERE id = '$userId'";
                                $userResult = $conn->query($query);
                                if($userData = $userResult->fetch_assoc()){
                                    $name = $userData['fname'];
                                }else{
                                    $name = 'Uknown Employee';
                                }
                        ?>
                            <tr>
                                <td><?=$name?></td>
                                <td><?=$data['type']?></td>
                                <td><?=$data['start_date']?></td>
                                <td><?=$data['end_date']?></td>
                                <td><?=$data['reason']?></td>
                                <td><?=$data['approval']?></td>
                                <td class="d-flex">
                                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                        <input type="hidden" name="approval" value="Approved">
                                        <button name="id" value="<?=$data['id']?>" class="btn btn-dark">Approve</button>
                                    </form>
                                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                        <input type="hidden" name="approval" value="Declined">
                                        <button name="id" value="<?=$data['id']?>" class="btn btn-outline-dark">Decline</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
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

