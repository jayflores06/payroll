<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="dashboard.css" rel="stylesheet">
</head>
<body>
<div>
<form action="login1.php" 
      method="post">
    <h4>Login Here</h4>
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
    <label class="form-label">User Name</label>
    <input type="text" class="form-control" name="uname" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" name="pass">
  </div>

  <button type="submit" class="btn btn-primary">Login</button>
</form>
<a href="signup.php">Register Here</a>
</div>
    
</body>
</html>