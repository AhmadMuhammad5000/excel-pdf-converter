<?php 
      session_start();
      require_once 'database/db.php';

// Sanitizing and validating inputs
function validate($input) {
    $input = htmlspecialchars($input);
    $input = filter_var($input, FILTER_SANITIZE_STRING);

    return $input;
}

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
       if(isset($_POST['username']) && isset($_POST['password'])){
           $username = filter_var($_POST['username'] , FILTER_SANITIZE_EMAIL);
           $password = validate(trim($_POST['password']));

           //    UNHASHING PASSWORD
           $sql = $conn->prepare("SELECT * FROM users WHERE username = ?");
           $sql->bind_param('s',$username);
           $sql->execute();
           $rs = $sql->get_result();

           if($rs->num_rows > 0) {
               $fetch = $rs->fetch_assoc();
               $hashedpassword = $fetch['password'];

               $unhashedPass = password_verify($password, $hashedpassword);

               if($unhashedPass) {
                //    STORING USER IN SESSION
                     $_SESSION['userid'] = $fetch['id'];
                     $_SESSION['username'] = $fetch['username'];

                   header("Location: dashboard.php");
               } else {
                   echo '<script> alert("Wrong Password!"); </script>';
                   echo '<script> window.location.href = "login.php"; </script>';
               }

           } else {
              echo '<script> alert("Invalid User!"); </script>';
              echo '<script> window.location.href = "login.php"; </script>';
           }

           } else{
             echo '<script> alert("all fields are requred !"); </script>';
             echo '<script> window.location.href = "login.php"; </script>';
          }

        } else {
            echo '<script> alert("Internal Server Error !"); </script>';
            echo '<script> window.location.href = "login.php"; </script>';
        }
