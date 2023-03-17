<?php
session_start();

if (isset($_SESSION['fname'])) {
//connect to database
$sName = "localhost";
$uName = "u521072993_capstone";
$pass = "Kodego123";
$db_name = "u521072993_payroll_db";

$conn = new mysqli($sName,$uName,$pass,$db_name);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!------Monserrat------->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">

    <!------Icons------->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-----CSS--------->
	<link href="dashboard.css" rel="stylesheet">
	<title>Employee Leave Request</title>  
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
    <main class="main-container text-center">


	<h1>Leave Request Form</h1>
	<button data-bs-toggle="modal" data-bs-target="#request-modal" id="view-requests" class="btn btn-primary">View My Requests</button>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			

			//get form data
			$userId = $_SESSION['id'];
			$leave_type = $_POST['leave_type'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$reason = $_POST['reason'];

			//insert data into database
			$approval = 'Pending';
			$sql = "INSERT INTO leave_request(user_id, type, start_date, end_date, reason, approval)VALUES ('$userId', '$leave_type', '$start_date', '$end_date', '$reason','$approval')";
			$conn->query($query);
		}
	?>
	<form method="post" id="request" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="leave_type">Request Type:</label>
		<select id="leave_type" name="leave_type">
			<option value="absent">Select your request</option>
			<option value="offset">Offset</option>
			<option value="sick_leave">Sick Leave</option>
			<option value="vacation_leave">Vacation Leave</option>
			<option value="undertime">Undertime</option>
			<option value="overtime">Overtime</option>
		</select><br><br>
		
		<label for="start_date">Start Date:</label>
		<input type="date" id="start_date" name="start_date"><br><br>
		
		<label for="end_date">End Date:</label>
		<input type="date" id="end_date" name="end_date"><br><br>
		
		<label for="reason">Reason:</label><br>
		<textarea id="reason" name="reason" rows="4" cols="50"></textarea><br><br>
		
		<input type="submit" value="Submit">
	</form>
    </main>
    <!------End Main---------->
    </div>

	<div id="request-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title">
						<h3 class="fw-bold">My Leave Requests</h3>
					</div>
					<button class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<th scope="col">Type</th>
								<th scope="col">Reason</th>
								<th scope="col">Approval</th>
							</thead>
							<tbody>
								<?php
									$query = "SELECT * FROM leave_request WHERE user_id = '$userId'";
									$requestResult = $conn->query($query);
									while($requestRow = $requestResult->fetch_assoc()){
								?>
									<tr>
										<td><?=$requestRow['type']?></td>
										<td><?=$requestRow['reason']?></td>
										<td><?=$requestRow['approval']?></td>
									</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>