<?php 
  //session start
  session_start();
 
  
  //functions 
  require_once 'includes/functions.php';
 

  //session data unique_id
  $unique_id = htmlentities($_GET['unique_id']);

  //displays all tbl_account data
  $sql = mysqli_query($conn, "SELECT * FROM tbl_account WHERE unique_id = '$unique_id'");
    if(mysqli_num_rows($sql) > 0){
      $user_details = mysqli_fetch_assoc($sql);
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


 <div class="container">
    <div class="main-body   pt-50 pb-100">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../beranda">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)"><?= htmlspecialchars($user_details['unique_id']); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page">Details User</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-1">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                      <?php 
                      if($user_details['gender'] =='L') {
                        echo '<img src="../assets/images/avatar/L.jpg"  class="rounded-circle" width="150">';
                      }else{
                        echo '<img src="../assets/images/avatar/P.jpg"  class="rounded-circle" width="150">';
                      } 
                      ?>
                    <div class="mt-3">
                      <h4><?= htmlspecialchars($user_details['FullName']);?></h4>
                       
                    </div>
                    
                  </div>
                </div>
              </div>
              
              
            </div>

 
            <div class="col-md-8">
              <div class="row">
                
              <?php 
                //session data unique_id
                $unique_id = htmlentities($_GET['unique_id']);

                //Url Slug
                function create_url_slug($string){
                  $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
                  return $slug;
                }
                
                //displays all tbl_curhat data
                $sqlC = mysqli_query($conn, "SELECT * FROM tbl_curhat WHERE unique_id = '$unique_id'");
                if(mysqli_num_rows($sqlC) > 0){
                    while ($Curhatan_List = mysqli_fetch_assoc($sqlC)) {
                        
           
                 
                ?>
                <div class="col-sm-12 mb-3">
                  <div class="card">

                     
                         <div class="card-body">
                          <h5 class="card-title"><?= $Curhatan_List['subject']; ?></h5>
                          <p class="card-text">

                            <?= substr($Curhatan_List['message'], 0, 200) ?>.......
                            
                            <a href="../baca/<?= create_url_slug($Curhatan_List['urlSlug']);  ?>">Baca Selanjutnya</a>
                          </p>
                    
                    
                    </div>
                    </div>
                  </div>
   
                <?php 
                }  
                } else{
                  echo '<span>Data Curhatan  <p class="text-danger">'.$user_details['FullName'].'</p> Tidak Ditemukan!</span>';
                }
              ?>


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
