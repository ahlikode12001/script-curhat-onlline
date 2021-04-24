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
// navbar
include 'layout/navbar.php';
?>

 
<section class="contact-area pt-50 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8">
                    <div class="section-title mt-45">
                        <h3 class="title">Tempat Curhat, Gratis.</h3>
                    </div>
                    <div class="contact-form form-style-four mt-15">

                    <div class="error-container">
                        <?= userdata(); ?>
                    </div>

                    <form action=""  method="post" enctype="multipart/form-data">
                     
                            <div class="row">
                             
                            <div class="col-md-12">
                                    <div class="form-input mt-15">
                                        <label>Thumbnail Curhat</label>
                                        <div class="input-items default">
                                            <input type="file" class="form-control" 
                                            name="gambar" id="gambar" required>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-12">
                                    <div class="form-input mt-15">
                                        <label>Kategori</label>
                                        <select class="form-select" name="kate" id="kate" 
                                        aria-label="Default select example" required>
                                        <?php 
                                        //displays all tbl_curhat data
                                        $sqlKat = mysqli_query($conn, "SELECT * FROM tbl_kategori");
                                        if(mysqli_num_rows($sqlKat) > 0){
                                        while ($Kategori_list = mysqli_fetch_assoc($sqlKat)) {
                                        ?>
                                        <option value="<?= $Kategori_list['nama_kategori'];?>"><?= $Kategori_list['nama_kategori'];?></option>
                                        <?php } } ?>
                                        </select>
                                    </div> 
                                </div>

                                <div class="col-md-12">
                                    <div class="form-input mt-15">
                                        <label>Subject</label>
                                        <div class="input-items default">
                                            <input type="text" class="form-control" 
                                            name="subject" id="subject" placeholder="Masukan Curhatan Singkat, misalnya : kenapa dia sudah berubah!" required>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-md-12">
                                    <div class="form-input mt-15">
                                        <label>Your Message</label><br>
                                        <span id="hitung" class="text-danger">10.000  Karakter Tersisa.</span> 
                                        <div class="input-items default">
                                            <textarea class="form-control" name="message" id="message" 
                                             cols="30" rows="10" maxlength="10000" placeholder="Masukan pesan curhatan anda" required></textarea>
                                        </div>
                                    </div> 
                                </div>
                                

                                <div class="col-md-12 mt-5">
                                    <div class="single-form pt-25">
                                        <div class="input-form rounded-buttons">
                                            <button class="main-btn rounded-three" 
                                            type="submit" name="submit">Curhat Sekarang</button>
                                        </div>
                                    </div>  
                                </div>
                            </div>  
                        </form>
                    </div>  
                </div>

                <!-- Help -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 offset-xl-1">
                    <div class="section-title mt-45 pb-20">
                        <h3 class="title">Bantuan</h3>
                    </div>
                    <div class="contact-info">
                        <ul class="info">
                            <li>
                                <div class="single-info">
                                    <div class="info-icon">
                                        <i class="lni lni-map-marker"></i>
                                    </div>
                                    <div class="info-content">
                                        <p class="text">Jika Anda Mengalami Masalah, Hubungi Kontak dibawah ini.</p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                            <li>
                                <div class="single-info">
                                    <div class="info-icon">
                                        <i class="lni lni-phone"></i> 
                                    </div>
                                    <div class="info-content">
                                        <p class="text">+62 </p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                            <li>
                                <div class="single-info">
                                    <div class="info-icon">
                                        <i class="lni lni-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <p class="text">admin@w.com</p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                        </ul>
                        <ul class="social mt-30">
                            <li><a href="#"><i class="lni lni-facebook-filled"></i></a></li>
                            <li><a href="#"><i class="lni lni-twitter-original"></i></a></li>
                            <li><a href="#"><i class="lni lni-instagram-original"></i></a></li>
                            <li><a href="#"><i class="lni lni-linkedin-original"></i></a></li>
                        </ul>
                    </div> <!-- contact-info -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

     

<!-- Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
 

</body>
</html>
