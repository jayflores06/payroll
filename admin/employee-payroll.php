<?php 
session_start();

if (isset($_SESSION['fname']) && isset($_GET['id'])) {
    // $sName = "localhost";
    // $uName = "root";
    // $pass = "";
    // $db_name = "je_db";
    
    $sName = "localhost";
    $uName = "u521072993_capstone";
    $pass = "Kodego123";
    $db_name = "u521072993_payroll_db";
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
                                
                                
                            }
                            echo $hours_worked;
                        ?>
                    </label>
                </div>
            </div>

            <hr>
            <form class="row row-cols-2 g-2" action="<?=$_SERVER['PHP_SELF'].'?id='.$userId?>" method="POST">
                <div class="col">
                    <label class="fw-bold">Hourly Rate:</label>
                </div>
                <div class="col">
                    <input required name="hourly_rate" type="number" placeholder="Hourly Rate" class="form-control">
                </div>
                <div class="col">
                    <label class="fw-bold">SSS:</label>
                </div>
                
                <div class="col">
                    <input name="sss" required type="number" placeholder="SSS" class="form-control">
                </div>
                

                <div class="col">
                    <label class="fw-bold">PhilHealth:</label>
                </div>
                

                <div class="col">
                    <input name="philhealth" required type="number" placeholder="PhilHealth" class="form-control">
                </div>
                
            
                <div class="col">
                    <label class="fw-bold">PAGIBIG:</label>
                </div>
                
                <div class="col">
                    <input name="pagibig" required type="number" placeholder="PAGIBIG" class="form-control">
                </div>
            
                
            
                <div class="col">
                    <label class="fw-bold">Cash Advance:</label>
                </div>
                
            
                <div class="col">
                    <input name="cashadvance" type="number" placeholder="Cash Advance" class="form-control">
                </div>
                

                <button class="btn btn-primary mt-3 w-100">Calculate Pay</button>
            </form>
        </div>


        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $hourly_rate = $_POST['hourly_rate'];
                $sss = $_POST['sss'];
                $philhealth = $_POST['philhealth'];
                $pagibig = $_POST['pagibig'];
                $cash_advance = $_POST['cashadvance'];
                $gross_pay = $hourly_rate * $hours_worked;
                $total_deductions = $sss + $philhealth + $pagibig + $cash_advance;
                $net_pay = $gross_pay - $total_deductions;
                
                $date = date('Y-m-d H:i:s');
                $query = $conn->prepare('INSERT INTO payroll_details(user_id,hourly_rate,sss,philhealth,pag_ibig,cash_advance,date)VALUES(?,?,?,?,?,?,?)');
                $query->bind_param('iddddds', $userId, $hourly_rate, $sss, $philhealth, $pagibig, $cash_advance, $date);
                $query->execute();

         ?>
            <div class="card bg-light shadow col-xxl-5 mx-auto mt-4 text-dark">
                <div class="row row-cols-2 g-2">
                    <div class="col">
                        <label class="fw-bold">Name: </label>
                    </div>
                    <div class="col">
                        <label><?=$name?></label>
                    </div>
                    <div class="col">
                        <label class="fw-bold">Hours Worked: </label>
                    </div>
                    <div class="col">
                        <label><?=$hours_worked?></label>
                    </div>
                    <div class="col">
                        <label class="fw-bold">Gross Pay: </label>
                    </div>
                    <div class="col">
                        <label>&#8369; <?=$gross_pay?></label>
                    </div>
                    <div class="col">
                        <label class="fw-bold">SSS: </label>
                    </div>
                    <div class="col">
                        <label>- &#8369; <?=$sss?></label>
                    </div>
                    <div class="col">
                        <label class="fw-bold">SSS: </label>
                    </div>
                    <div class="col">
                        <label>- &#8369; <?=$sss?></label>
                    </div>
                    <div class="col">
                        <label class="fw-bold">PhilHealth: </label>
                    </div>
                    <div class="col">
                        <label>- &#8369; <?=$philhealth?></label>
                    </div>
                    <div class="col">
                        <label class="fw-bold">PAGIBIG: </label>
                    </div>
                    <div class="col">
                        <label>- &#8369; <?=$pagibig?></label>
                    </div>
                    <div class="col">
                        <label class="fw-bold">Cash Advance: </label>
                    </div>
                    <div class="col">
                        <label>- &#8369; <?=$cash_advance?></label>
                    </div>
                </div>
                <hr>
                <div class="row row-cols-2 g-2">
                    <div class="col">
                        <label class="fw-bold">Net Pay: </label>
                    </div>
                    <div class="col">
                        <label class="<?php if($net_pay < 0){ echo 'text-danger'; } ?>">&#8369; <?=$net_pay?></label>
                    </div>
                </div>

                <button onclick="print()" class="btn btn-primary w-100 mt-3">Print</button>
            </div>

            
            
            <div id="print-area" class="text-black">
                <style>
                    @media print{
                        .flex{
                            display: flex;
                            justify-content: space-between;
                        }
                        .bold{
                            font-weight: bold;
                        }
                        .text-black{
                            color: black;
                        }
                        *{
                            font-family: sans-serif;
                            font-size: 25px;
                        }
                        h1{
                            letter-spacing: 4px;
                            font-weight: bold;
                            font-size: 40px;
                            text-align: center
                        }
                    }
                    
                
                </style>

                <h1>PAYSLIP</h1>
                <hr>
                <div class="flex">
                    <p class="bold">Name:</p><p><?=$name?></p>
                </div>

                <div class="flex">
                    <p class="bold">Hours Worked:</p><p><?=$hours_worked?></p>
                </div>
                <div class="flex">
                    <p class="bold">Hourly Rate:</p><p>&#8369; <?=$hourly_rate?></p>
                </div>
                <div class="flex">
                    <p class="bold">SSS:</p><p>&#8369; <?=$sss?></p>
                </div>
                <div class="flex">
                    <p class="bold">PhilHealth</p><p>&#8369; <?=$philhealth?></p>
                </div>
                <div class="flex">
                    <p class="bold">PAGIBIG</p><p>&#8369; <?=$pagibig?></p>
                </div>
                <div class="flex">
                    <p class="bold">Cash Advance:</p><p>&#8369; <?=$cash_advance?></p>
                </div>
                <div class="flex">
                    <p class="bold">Net Pay:</p><p>&#8369; <?=$net_pay?></p>
                </div>
                
            </div>

            <script>
                document.getElementById('print-area').style.display = 'none';
                function print(){
                    let printarea = document.getElementById('print-area').innerHTML; 
                    
                    let newWindow = window.open();

                    newWindow.document.write('<html><head><title></title><body>');
                    newWindow.document.write(printarea);
                    newWindow.document.write('</body</html');
                    newWindow.print();
                    newWindow.close();
                }
            </script>
        <?php
            }
        ?>
            
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

