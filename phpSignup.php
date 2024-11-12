<?php require_once 'database/db.php';

// Sanitizing and validating inputs
function validate($input) {
    $input = htmlspecialchars($input);
    $input = filter_var($input, FILTER_SANITIZE_STRING);

    return $input;
}

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
       if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){        
           $username = validate(trim($_POST['username']));
           $email = trim($_POST['email']);
           $emailValid = filter_var($email, FILTER_SANITIZE_EMAIL);
           $password = validate(trim($_POST['password']));
           $cpassword = validate(trim($_POST['cpassword']));
           $hashedPass = password_hash($cpassword, PASSWORD_DEFAULT);

        //  COMFIRMING PASSWORD
        if($password == $cpassword) {
            // CHECK FOR AN EXISTING USER WITH SAME USERNAME
            $sql = $conn->prepare("SELECT username FROM users WHERE username = ?");
            $sql->bind_param('s',$username);
            $sql->execute();
            $rs = $sql->get_result();

            if($rs->num_rows > 0) {
                echo '<script> alert("Username has been taking!"); </script>';
                echo '<script> window.location.href = "index.php"; </script>';
            } else{
                $sql = $conn->prepare("INSERT INTO users(username,email,password) VALUES (?,?,?)");
                $sql->bind_param('sss',$username,$emailValid,$hashedPass);
                if($sql->execute()){
                    header("location: dashboard.php");
                } else{
                 echo '<script> alert("Something went wrong!"); </script>';
                 echo '<script> window.location.href = "index.php"; </script>';
                }
            }
            
        } else{
            echo '<script> alert("Password Mismatch!"); </script>';
            echo '<script> window.location.href = "index.php"; </script>';
        }
           } else{
            echo '<script> alert("one or more fields are empty!"); </script>';
            echo '<script> window.location.href = "index.php"; </script>';
          }

        } else {
            echo '<script> alert("Internal server error!"); </script>';
            echo '<script> window.location.href = "index.php"; </script>';
        }
