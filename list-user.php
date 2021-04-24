<?php 
  session_start();
   
  //functions 
  require_once 'includes/functions.php';
    
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
 
<?php
//Localtion navbar
include_once 'layout/navbar.php';

?>


<div class="container">
<div class="main-body   pt-50 pb-100">

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="beranda.html">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Grid</li>
        </ol>
      </nav>
      <!-- /Breadcrumb -->

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">

      <?php 
        //displays all tbl_account data
        $sqlUser = mysqli_query($conn, "SELECT * FROM tbl_account ORDER BY id_account DESC");
        if(mysqli_num_rows($sqlUser) > 0){
          while ($list_user = mysqli_fetch_assoc($sqlUser)) {
      
      ?>

        <div class="col mb-3 mt-5">
          <div class="card">
            <div class="card-body text-center">
            <?php 
            if($list_user['gender'] =='L') {
              echo '<img src="assets/images/avatar/L.jpg"  style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3"';
            }else{
              echo '<img src="assets/images/avatar/P.jpg"  style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3"';
            } 
            ?>  
              <br>
              <h5 class="card-title"><?= $list_user['FullName'];?></h5>
            </div>
            <div class="card-footer">
               <a href="user/<?= $list_user['unique_id'];?>" class="btn btn-primary d-flex justify-content-center">Lihat User</a>
            </div>
          </div>
        </div>
      <?php 
      }  
    
      }else{
        echo '<p class="mt-5">Data Tidak Ditemukan!</p>';
      } ?>
     

<?php
 
//Localtion javascript library
include_once 'layout/js.php';
?>
