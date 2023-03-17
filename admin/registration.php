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

    <!---Sign-up form--->
<form id="registration" action="signup.php" 
      method="post">
    <h4>Registration Here</h4>
    <div class="logo">
          <img src="logo.jpg" alt="Your Logo">
      </div>

    <!--for the alert--->
    <?php if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
    <?php } ?>

    <?php if(isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
    <?php } ?>


  <div class="mb-3">
    <label class="form-label">Full Name</label>
    <input type="text" class="form-control" name="Fname" value="<?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">User Name</label>
    <input type="text" class="form-control" name="uname" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
  </div>

  <div class="mb-3">
    <label class="form-label" for="position">Position:</label>
    <select id="position" name="position">
      <option value=""></option>
      <option value="programmer">Programmer</option>
      <option value="hr staff">H.R.</option>
      <option value="office clerk">Office Clerk</option>
      <?php echo (isset($_GET['position']))?$_GET['position']:"" ?>">
    </select>
  </div>

  

  <div class="button-link-container">
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </div>
</form>

<!-----end of sign-in form--->

      
</div>
    
</body>
</html>

<?php }else {
	header("Location: home.php");
	exit;
} ?>