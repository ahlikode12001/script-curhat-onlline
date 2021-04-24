<?php

session_start();
require_once 'includes/functions.php';


if (isset($_POST['submit'])) {
  if (Reqister($_POST) > 0) {
    set_flashdata('berhasil', 'ditambahkan', 'success');
    
    header('Location: login');
    exit;
  } else {
    set_flashdata('gagal', 'ditambahkan', 'danger');
    
    header('Location: register');
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

    <title>CurhatNow</title>

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap-5.0.0-beta2.min.css">
    <!-- Style css -->    
    <link rel="stylesheet" href="assets/css/style.css">
 
</head>
<body>
  
<!-- Start Form -->
<div class="container">
		<div class="row vh-100 d-flex justify-content-center align-items-center auth">
			<div class="col-md-9 col-lg-5">
				<a href="index"><- Kembali</a>
				<div class="card">
					<div class="card-body">
						<h3 class="mb-5 text-center">SIGN IN</h3>
          
							<section class="form register">

							<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            
                            <div class="error-container">
                                <?= userdata(); ?>
                            </div><br>

							<div class="form-group field input mb-3">
								<label for="FullName">Nama Lengkap</label>
								<input type="hidden"  name="unique_id" id="unique_id" value="<?php echo rand() ?>">
                  				<input type="FullName" class="form-control" name="FullName" placeholder="Masukan FullName Anda" required>
							</div>

							<div class="form-group field input mb-3">
								<label for="gender">Jenis Kelamin</label>
                                <br>
                                <input type="checkbox"  name="gender" id="gender" value="L"> Laki - Laki
                                <br>
                 				<input type="checkbox" name="gender" id="gender" value="P"> Perempuan
							</div>

							<div class="form-group field input mb-3">
								<label for="email">E-mail</label>
                 				<input type="email" class="form-control" name="email" placeholder="Masukan email Anda" required>
							</div>

							<div class="form-group field input mb-3">
								<label for="password">Password</label>
                 				<input type="password" class="form-control" name="password" placeholder="Masukan Password Anda" required>
							</div>
						
								<div class="form-group my-4 field button">
									<input type="submit" name="submit" class="btn btn-primary btn-rounded px-5 auth-btn" value="Daftar Sekarang">
								</div>
						
							<p>Sudah Memiliki Akun? <a href="login.html" id="create_account">login Sekarang</a></p>
						</form>
						
            			</section>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- Javascript -->
<script src="assets/js/bootstrap-5.0.0-beta2.min.js"></script>

</body>
</html>
