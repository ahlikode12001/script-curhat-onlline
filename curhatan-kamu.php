<?php 
//Localtion Head
include_once 'layout/head.php';


//Localtion navbar
include_once 'layout/navbar.php';

?>

 
 
  <div class="container mt-5">
    <div class="row d-flex justify-content-center"> 
	
	<h1 class="mb-5 text-center mt-5">Yuk Bantu Mereka Juga</h1>
    <?php 

    
		// Cek apakah terdapat data page pada URL
		$page = (isset($_POST['page']))? $_POST['page'] : 1;
		$no = (($page - 1)) + 1; // Untuk setting awal nomor pada halaman yang aktif
		$limit = 10; // Jumlah data per halamannya

		// Untuk menentukan dari data ke berapa yang akan ditampilkan pada tabel yang ada di database
		$limit_start = ($page - 1) * $limit;

		 //Url Slug
		function UrlSlug($string){
			$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
			return $slug;
		}

		// Buat query untuk menampilkan semua data tbl_curhat UrlKat tbl_curhat
  
		$sql = mysqli_query($conn, "SELECT * FROM tbl_curhat LIMIT ".$limit_start.",".$limit."");



		// Buat query untuk menghitung semua jumlah data
		$sql2 = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM tbl_curhat");
		$get_jumlah = mysqli_fetch_array($sql2);
	 
		if(mysqli_num_rows($sql)){
		while($list_curhat = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
			?>
			 
            <div class="col-md-8 mb-5">
            <div class="card bg-light">
                <div class="card-body">
                <img src="uploads/<?= htmlspecialchars($list_curhat['gambar']);?>" class="card-img-top" alt="picture curhat">
                <div class="card-body">
                    <h1 class="card-title"><?= htmlspecialchars($list_curhat['subject']);?></h1>
                     <p class="card-text">
                          
                    <?= substr(htmlspecialchars($list_curhat['message']), 0, 300) ?>.......
                            
                    <a href="baca/<?= UrlSlug($list_curhat['urlSlug']);  ?>">Baca Selanjutnya</a>
                    </p>
                </div>
            </div>
        </div>
        </div>
		 
		<?php
		 
		} 
		}else{
			echo '<center>Data Tidak Ditemukan!</center>';
		}
		?>

 
         

    </div>
    </div>
    </div>

 

    <div class="Page navigation example mt-5 mb-5">
     <?php
    $count = mysqli_num_rows($sql);

    if($count > 0){ // Jika datanya ada, tampilkan paginationnya
    ?>
   
    <ul class="pagination pagination-md justify-content-center">

    	<!-- LINK FIRST AND PREV -->
    	<?php
    	if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
    	?>
    		<li  class="page-item disabled"><a class="page-link" href="#">First</a></li>
    		<li  class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
    	<?php
    	}else{ // Jika page bukan page ke 1
    		$link_prev = ($page > 1)? $page - 1 : 1;
    	?>
    		<li  class="page-item"><a class="page-link" href="?page=1">First</a></li>
    		<li  class="page-item"><a class="page-link" href="?page=<?php echo $link_prev; ?>">&laquo;</a></li>
    	<?php
    	}
    	?>

    	<!-- LINK NUMBER -->
    	<?php
    	$jumlah_page = ceil($get_jumlah['jumlah'] / $limit); // Hitung jumlah halamannya
    	$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
    	$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
    	$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

    	for($i = $start_number; $i <= $end_number; $i++){
    		$link_active = ($page == $i)? ' class="page-item"' : '';
    	?>
    		<li <?php echo $link_active; ?>><a class="page-link" href="?page=<?php echo $i; ?>" ><?php echo $i; ?></a></li>
    	<?php
    	} 
    	?>

    	<!-- LINK NEXT AND LAST -->
    	<?php
    	// Jika page sama dengan jumlah page, maka disable link NEXT nya
    	// Artinya page tersebut adalah page terakhir
    	if($page == $jumlah_page){ // Jika page terakhir
    	?>
    		<li  class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
    		<li  class="page-item disabled"><a class="page-link" href="#">Last</a></li>
    	<?php
    	}else{ // Jika Bukan page terakhir
    		$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
    	?>
    		<li  class="page-item"><a class="page-link" href="?page=<?php echo $link_next; ?>" >&raquo;</a></li>
    		<li  class="page-item"><a class="page-link" href="?page=<?php echo $jumlah_page; ?>">Last</a></li>
    	<?php
    	}
    	?>
    </ul>
    <?php
    }
    ?>

</div>

 


<?php
 

//Localtion javascript library
include_once 'layout/js.php';
?>
