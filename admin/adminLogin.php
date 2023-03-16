<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            $username = "admin";
            $password = "kodego123";
            $admin_username = $_POST['username'];
            $admin_pasword = $_POST['password'];

            if($admin_username == $username && $admin_pasword == $password){
              session_start();
              $_SESSION['fname'] = $username;
                header("Location: home.php");
                exit();
            }
            else{
                echo "Invalid username or password.";
            }
        }
    ?>

<div>
<form action="adminLogin.php" 
      method="post">
    <h4>Admin Login Here</h4>
    <div class="logo">
          <img src="logo.jpg" alt="Your Logo">
      </div>

    <!--for the alert--->
    <?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
	<?php } ?>

  <div class="mb-3">
    <label class="form-label" for="username">User Name</label>
    <input type="text" class="form-control" name="username" >
  </div>

  <div class="mb-3">
    <label class="form-label" for="password" name = "password" >Password</label>
    <input type="password" class="form-control" name="password">
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Login</button>
</form>
<a href="capstone/index.php">For Employee</a>
</div>
</body>
</html>