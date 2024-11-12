<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="http://localhost/filesConverter/bootstrap-5.1.3-dist/bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/filesConverter/font-awesome-4.7.0/css/font-awesome.min.css">

  <title>SignUp</title>
</head>

<body>
  <!-- Container -->
  <div class="container-fluid">
    <div class="signup d-flex flex-column align-items-center justify-content-center vh-100">
      <form method="POST" action="phpSignup.php" autocomplete="off" class="form-control w-25">
        <h2 class="text-center fs-5 text-dark">Sign Up</h2> <br>
        <div class="div">
          <label><b>Username</b></label> <br>
          <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
        </div>

        <div class="div">
          <label><b>Email</b></label> <br>
          <input type="email" name="email" class="form-control" placeholder="Enter Email Id" required >
        </div>

        <div class="div">
          <label><b>Password</b></label> <br>
          <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
        </div>

        <div class="div">
          <label><b>Comfirm Password</b></label> <br>
          <input type="password" name="cpassword" class="form-control" placeholder="Comfirm Password" required>
        </div> <br>

        <div class="div">
          <button name='signup' class="form-control bg-success"> Signup </button>
        </div> <br>

        <p>Already have an account? <a href='login.php'>Login</a></p>

      </form>
    </div>
  </div>

</body>

</html>