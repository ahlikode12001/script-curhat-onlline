<?php 
  //session start
  session_start();
 
  
  //functions 
  require_once 'includes/functions.php';
 

  //session data urlSlug
  $urlSlug = htmlentities($_GET['urlSlug']);

  //displays all tbl_curhat data
  $sqlB = mysqli_query($conn, "SELECT * FROM tbl_curhat WHERE urlSlug = '$urlSlug'");
    if(mysqli_num_rows($sqlB) > 0){
      $Details_Curhat = mysqli_fetch_assoc($sqlB);
  }else{
      header('location:../list-user');
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
    <link rel="stylesheet" href="../assets/css/style.css">
 
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

                    <li class="nav-item">
                        <a href="../beranda" class="page-scroll">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a href="../curhatan-kamu" class="page-scroll">Curhatan Kamu</a>
                    </li>

                    <li class="nav-item">
                        <a href="../list-user" class="page-scroll">Semua Pengguna</a>
                    </li>
                  

                <?php }else{ ?>

                    <li class="nav-item">
                        <a href="../beranda" class="page-scroll">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a href="../list-user" class="page-scroll active">Semua Pengguna</a>
                    </li>

                    <li class="nav-item">
                        <a href="../curhat-now" class="page-scroll">Curhat Sekarang</a>
                    </li>

                <?php } ?>
                
                </ul>
            </div>

                <div class="navbar-btn d-none d-sm-inline-block">
                    <ul>
                <?php if(!isset($_SESSION['unique_id'])){ ?>

                    <li><a class="light" href="../login">Masuk</a></li>
                    <li><a class="solid" href="../register">Daftar</a></li>
 
                <?php }else{ ?>
                    <li><a class="light" href="../logout.html">Keluar</a></li>  
                    <li><a class="solid" href="../my-profile">Profile</a></li>  

                <?php } ?>

                    </ul>
                </div>
                </nav> 
            </div>
        </div> 
    </div> 
</div>
<!-- End Navbar -->

 
    
          
        <!-- Page Content -->
  <div class="container mt-5">

<div class="row">
<div class="col-lg-8">

   <div class="card">
   <div class="card-body">

   <!-- Post Content Column -->
                    
    <!-- Preview Image -->
    <img class="img-fluid rounded" src="../uploads/<?= htmlspecialchars($Details_Curhat['gambar']);?>" alt="">
               
    <!-- Title -->
    <h2 class="mt-5 subject-title"><?= $Details_Curhat['subject'];?></h2>

    <!-- Author -->
    <p style="font-size:14px" class="mt-1 mb-5">
    <a href="">Leave a Comment  </a> /
    <a href="#">Cinta</a>  /
    <a href="#">by Andre</a>
    </p>

     <p>
        <?= $Details_Curhat['message'];?>
     </p>
            
</div>
</div>
                    

</div>
<!-- /.row -->

</div>
<!-- /.container -->

 
<?php
 
//Localtion javascript library
include_once 'layout/js.php';
?>
