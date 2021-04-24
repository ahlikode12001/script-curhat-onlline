<?php 

  session_start();
  if(isset($_SESSION["unique_id"])){  
      
      // jika tidak ada aktivitas pada browser 
      // selama 15 menit, maka
      if((time() - $_SESSION["last_login_timestamp"]) > 900){// 900 = 15 * 60

        //keluar otomatis
        header('location:logout.html');
         
      } else {
          // jika ada aktivitas update waktu
          $_SESSION["last_login_timestamp"] = time();
      }
  } else {
      header("location:login.html");
  }

  
  //functions 
  require_once 'includes/functions.php';
    
  if (isset($_POST['submit'])) {
    if (RegCurhat($_POST) > 0) {
      set_flashdata('berhasil', 'ditambahkan', 'success');
      
      header('Location: index');
      exit;
    } else {
      set_flashdata('gagal', 'ditambahkan', 'danger');
      
      header('Location: curhat-now');
      exit;
    }
  }
  
  //session data unique_id
  $unique_id = htmlentities($_SESSION['unique_id']);

  //displays all tbl_account data
  $sqlProfile = mysqli_query($conn, "SELECT * FROM tbl_account WHERE unique_id = '$unique_id'");
    if(mysqli_num_rows($sqlProfile) > 0){
      $my_profile = mysqli_fetch_assoc($sqlProfile);
  }
 
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ChatNow</title>

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Style css -->    
    <link rel="stylesheet" href="assets/css/style.css">
 
</head>
<body>
 
<!-- Navbar -->
<section class="header-area header-one mb-100">
    <div class="navbar-area navbar-one navbar-light">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <!--<img src="assets/images/logo-4.svg" alt="Logo">-->
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse sub-menu-bar" id="navbarOne">
                <ul class="navbar-nav m-auto">

                <?php if(!isset($_SESSION['unique_id'])){ ?>

                <?php }else{ ?>

                    <li class="nav-item">
                        <a href="beranda" class="page-scroll">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a href="list-user" class="page-scroll">Semua Pengguna</a>
                    </li>

                    <li class="nav-item">
                        <a href="curhat-now" class="page-scroll active">Curhat Sekarang</a>
                    </li>

                <?php } ?>
                
                </ul>
            </div>

                <div class="navbar-btn d-none d-sm-inline-block">
                    <ul>
                <?php if(!isset($_SESSION['unique_id'])){ ?>

                    <li><a class="light" href="login">Masuk</a></li>
                    <li><a class="solid" href="register">Daftar</a></li>
 
                <?php }else{ ?>
                    <li><a class="light" href="logout.html">Keluar</a></li>  
                    <li><a class="solid" href="<?= $_SESSION['unique_id'];?>">Profile</a></li>  

                <?php } ?>

                    </ul>
                </div>
                </nav> 
            </div>
        </div> 
    </div> 
</div>
<!-- End Navbar -->


 <div class="container">
    <div class="main-body   pt-50 pb-100">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="beranda">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)"><?= htmlspecialchars($my_profile['FullName']); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-1">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                      <?php 
                      if($my_profile['gender'] =='L') {
                        echo '<img src="assets/images/avatar/L.jpg"  class="rounded-circle" width="150">';
                      }else{
                        echo '<img src="assets/images/avatar/P.jpg"  class="rounded-circle" width="150">';
                      } 
                      ?>
                    <div class="mt-3">
                      <h4><?= htmlspecialchars($my_profile['FullName']);?></h4>
                      <div class="mt-4">
                      
                          <button class="btn btn-primary"></button>
                          <button class="btn btn-outline-primary">Setting</button>
                          <button class="btn btn-primary"></button>

                       </div>
                    </div>
                    
                  </div>
                </div>
              </div>
              
              
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-3">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?= htmlspecialchars($my_profile['FullName']);?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-3">Email </h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                       <?= htmlspecialchars($my_profile['email']);?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-3">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php 
                      if($my_profile['gender'] =='L') {
                        echo '<h6 class="mb-3">Laki - Laki</h6>';
                      }else{
                        echo '<h6 class="mb-3">Perempuan</h6>';
                      } 
                      ?>
                    </div>
                  </div>
 
              </div>
              </div>

             
                      


              </div>
            </div>
          </div>
        </div>
    </div>

<?php
 
//Localtion javascript library
include_once 'layout/js.php';
?>
