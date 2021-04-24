<?php 
include 'config.php';
 
  session_start();

  if (isset($_SESSION['unique_id'])) {
     header("Location:index");
  }
   
  if (isset($_POST['submit'])) {

      $errorMsg = "";

      $email    = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']); 
      
  if (!empty($email) || !empty($password)) {
        $query  = "SELECT * FROM tbl_account WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 1){
          while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {

                session_start();

                $_SESSION['unique_id'] = $row['unique_id'];
                $_SESSION['FullName'] = $row['FullName'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['status_akun'] = $row['status_akun'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION["last_login_timestamp"] = time(); // waktu model UNIX
                $_SESSION['time'] = time();
                header("Location:index");
            }else{
                $errorMsg = "Email Dan Password salah!";
            }    
          }
        }else{
          $errorMsg = "Data Email ".$email." Tidak ada!";
        } 
    }else{
      $errorMsg = "Masukan Email Dan Password!";
    }
  }

 
?>  