<?php
session_start();

if (isset($_SESSION['fname'])) {

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Payroll</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="home.css" rel="stylesheet">
</head>
<body>
<div class="header">
    <div class="text-center mt-3 float-end" id="btn-logout">
        <a href="logout.php" class="btn btn-warning">
            Logout
        </a>  
    </div>
    <h3 class="display-4">Welcome, <?=$_SESSION['fname']."!"?></h3>  
    </div>

	<div class="sidebar">
		<ul>
			<li><a href="home.php">Dashboard</a></li>
			<li><a href="#">Profile</a></li>
			<li><a href="request.php">Request</a></li>
			<li><a href="payroll.php">Payroll</a></li>
		</ul>
	</div>

	<h1>Employee Payroll</h1>

    <form method="post" action="">
  <label for="name">Name:</label>
  <input type="text" name="name" required><br>

  <label for="hourly_rate">Hourly Rate:</label>
  <input type="number" step="0.01" name="hourly_rate" required><br>

  <label for="hours_worked[]">Hours Worked:</label>
  <input type="number" step="0.01" name="hours_worked[]" required><br>

  <label for="hours_absent[]">Hours Absent:</label>
  <input type="number" step="0.01" name="hours_absent[]" required><br>

  <label for="sss">SSS:</label>
  <input type="number" step="0.01" name="sss" required><br>

  <label for="philhealth">PhilHealth:</label>
  <input type="number" step="0.01" name="philhealth" required><br>

  <label for="pagibig">Pag-IBIG:</label>
  <input type="number" step="0.01" name="pagibig" required><br>

  <label for="cash_advance">Cash Advance:</label>
  <input type="number" step="0.01" name="cash_advance" required><br>

  <input type="submit" value="Calculate Payroll">
  <a href="payslip.pdf" download="my_payslip.pdf">Download Payslip</a>

    <div id="payroll-result">
        
    </div>

    
</form>
<button style="position: absolute; left: 400px; top: 500px;" class="btn btn-primary" id="print" onclick="print()">Print</button>

<!-- Print Area -->



<script>

	function print(){
		let printArea = document.getElementById('payroll-result').innerHTML;
		let newWindow = window.open();

		newWindow.document.write('<html><head><title>Print</title>');
		newWindow.document.write('</head><body>');
        newWindow.document.write(`
        
        <style>
            @media print{
                .title{
                    font-weight: bold;
                }
                p{
                    font-size: 50px;
                }
            }
        </style>
        `)
		newWindow.document.write('<p>' + printArea + '</p>');
		newWindow.print();
	}
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $hourly_rate = $_POST['hourly_rate'];
  $hours_worked = array_sum($_POST['hours_worked']);
  $hours_absent = array_sum($_POST['hours_absent']);
  $sss = $_POST['sss'];
  $philhealth = $_POST['philhealth'];
  $pagibig = $_POST['pagibig'];
  $cash_advance = $_POST['cash_advance'];

  $gross_pay = $hourly_rate * $hours_worked;
  $total_deductions = $sss + $philhealth + $pagibig + $cash_advance;
  $net_pay = $gross_pay - $total_deductions;

  $result = "<span class=title>Employee</span>: $name<br>";
  $result .= "<span class=title>Gross Pay</span>: $gross_pay<br>";
  $result .= "<span class=title>Total Deductions</span>: $total_deductions<br>";
  $result .= "<span class=title>Net Pay</span>: $net_pay";

  echo '<script>document.getElementById("payroll-result").innerHTML = "'. $result .'";</script>';
}
?>

    <div class="footer">
		<p>&copy; 2023 Streamlining Payroll Processing and Management</p>
	</div>

</body>
</html>

<?php
} else {
    header("Location: login.php");
    exit;
}
?>
