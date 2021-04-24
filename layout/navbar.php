<!-- Navbar -->
<section class="header-area header-one mb-100">
    <div class="navbar-area navbar-one navbar-light">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo-4.svg" alt="Logo"> 
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
                        <a href="beranda" class="page-scroll">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a href="curhatan-kamu" class="page-scroll">Curhatan Kamu</a>
                    </li>

                    <li class="nav-item">
                        <a href="list-user" class="page-scroll">Semua Pengguna</a>
                    </li>

                <?php }else{ ?>

                    <li class="nav-item">
                        <a href="beranda" class="page-scroll">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a href="list-user" class="page-scroll">Semua Pengguna</a>
                    </li>

                    <li class="nav-item">
                        <a href="curhat-now" class="page-scroll">Curhat Sekarang</a>
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
                    <li><a class="solid" href="my-profile">Profile</a></li>  

                <?php } ?>

                    </ul>
                </div>
                </nav> 
            </div>
        </div> 
    </div> 
</div>
<!-- End Navbar -->