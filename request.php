<?php
session_start();

if (isset($_SESSION['fname'])) {

?>

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
	<title>Payroll</title>  
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
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//connect to database
			$sName = "localhost";
			$uName = "u521072993_capstone";
			$pass = "Kodego123";
			$db_name = "u521072993_payroll_db";

			try {
				$conn = new PDO("mysql:host=$sName;dbname=$db_name", 
								$uName, $pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
			  echo "Connection failed : ". $e->getMessage();
			}

			//get form data
			$userId = $_SESSION['id'];
			$leave_type = $_POST['leave_type'];
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$reason = $_POST['reason'];

			//insert data into database
			$sql = "INSERT INTO leave_request(user_id, type, start_date, end_date, reason)
        VALUES ('$userId', '$leave_type', '$start_date', '$end_date', '$reason')";

			try {
    		$conn->query($sql);
    		echo "Leave request submitted successfully.";
			} catch (PDOException $e) {
    		echo "Error: " . $e->getMessage();
			}

unset($conn);
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
</body>
</html>

<?php }else {
	header("Location: login.php");
	exit;
} ?>