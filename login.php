 
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
          
							<section class="form login">

							<?php include 'includes/login.php'; ?>

							<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
							<?php
							if (isset($errorMsg)) {
								echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
										$errorMsg
										<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
									  </div>";
								}
							?><br>

							<div class="form-group field input">
								<label for="email">E-mail</label>
                  				<input type="email" class="form-control" name="email" placeholder="Masukan Email Anda" required>
							</div>
							<div class="form-group field input">
								<label for="password">Password</label>
                 				<input type="password" class="form-control" name="password" placeholder="Masukan Password Anda" required>
							</div>
						
								<div class="form-group my-4 field button">
									<input type="submit" name="submit" class="btn btn-primary btn-rounded px-5 auth-btn" value="Masuk">
								</div>
						
							<p>Belum Memiliki Akun? <a href="register.html" id="create_account">Daftar Sekarang</a></p>
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
