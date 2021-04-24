<?php

//localtion on config to databases
include 'config.php';
 

function set_flashdata($param1, $param2, $param3) {
  $pesan = trim(htmlspecialchars($param1));
  $aksi = trim(htmlspecialchars($param2));
  $tipe = trim(rtrim(htmlspecialchars($param3)));

  $_SESSION['flash'] = [
    'pesan' => $pesan,
    'aksi' => $aksi,
    'tipe' => $tipe
  ];
}

function flashdata() {
  if (isset($_SESSION['flash'])) {
    echo '<div class="alert alert-'. $_SESSION['flash']['tipe'] .' alert-dismissible fade show" role="alert">
            data <strong>'. $_SESSION['flash']['pesan'] .'</strong> '. $_SESSION['flash']['aksi'] .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';

    unset($_SESSION['flash']);
  }
}

function set_userdata($param1, $param2) {
  $pesan = trim(htmlspecialchars($param1));
  $tipe = trim(rtrim(htmlspecialchars($param2)));

  $_SESSION['error'] = [
    'pesan' => $pesan,
    'tipe' => $tipe
  ];
}

function userdata() {
  if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-". $_SESSION['error']['tipe']  ." alert-dismissible fade show' role='alert'>
            ". $_SESSION['error']['pesan']  ."
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['error']);
  }
}

//// Create Prosessing Reqister /// 
function Reqister($data) {
  global $conn;

  //Variable 
  $unique_id = trim(htmlspecialchars($data['unique_id'])); 
  $FullName = trim(htmlspecialchars($data['FullName']));
  $gender = trim(htmlspecialchars($data['gender']));
  $email = trim(rtrim(htmlspecialchars(mysqli_real_escape_string($conn, $data['email']))));
  $password = trim(htmlspecialchars($data['password']));
  $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);

 
  

  if (!Reqistervalidation($FullName, $email, $encrypt_pass, $gender)) {
    header('Location: register.html');
    exit();
  } else {
    $cek_email = mysqli_query($conn, "SELECT email FROM tbl_account WHERE email = '$email'");

    //cek apakah email sudah pernah dipakai sebelumnya
    if (mysqli_num_rows($cek_email) > 0) {
      set_userdata('email sudah pernah dipakai sebelumnya', 'danger');

      header('Location: register.html');
      exit();
    } else {
      //tambahkan data ke database
      mysqli_query($conn, "INSERT INTO tbl_account 
      VALUES(NULL, '$unique_id', '$FullName', '$email', '$encrypt_pass', 'active', '$gender')");
      return mysqli_affected_rows($conn);
    }
  }
}

// Start returns With Validasi Variable
function Reqistervalidation($FullName, $email, $encrypt_pass, $gender) {
  if (empty($FullName) || empty($email) || empty($encrypt_pass) || empty($gender)) {
    set_userdata('isi input yang masih kosong terlebih dahulu', 'danger');
    return false;
  } else if (strlen($FullName) <= 3) {
    set_userdata('FullName terlalu pendek', 'danger');
    return false;
  } else if (strlen($encrypt_pass) <= 5) {
    set_userdata('password terlalu pendek', 'danger');
    return false;
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    set_userdata('bukan berupa email yang valid', 'danger');
    return false;
  }else {
    //kembalikan nilai true jika lolos dari uji validasi

    return true;
  }
}


//// Create Prosessing Curhat /// 
function RegCurhat($data) {
  global $conn;

  //Variable 
  $unique_id = trim(htmlspecialchars($_SESSION['unique_id']));
  $kate = trim(htmlspecialchars($data['kate']));
  $subject = trim(htmlspecialchars($data['subject']));
  $message = trim(rtrim(htmlspecialchars($data['message'])));
  $gambar = UploadThumbnail();

  //Url Slug
  setlocale(LC_ALL, 'en_US.UTF8');
  function slug($str, $replace=array(), $delimiter='-') {
      if ( !empty($replace) ) {
          $str = str_replace((array)$replace, ' ', $str);
    }
    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
    return $clean;
  }

  //Url Slug with subject
  $urlSlug = trim(htmlspecialchars(slug($data['subject'])));

  if (!validation($subject, $message, $kate) || !$gambar) {
    header('Location: curhat-now');
    exit();
  } else {

    //Checking Dublikat Subject With Validasi
    $cek_subject = mysqli_query($conn, "SELECT subject FROM tbl_curhat WHERE subject = '$subject'");

    //Checking Message Error Dublikat Subject
    if (mysqli_num_rows($cek_subject) > 0) {
      set_userdata('subject sudah pernah dipakai sebelumnya', 'danger');

      header('Location: curhat-now');
      exit();
    } else {
    
    //Successful With Insert to databases
      mysqli_query($conn, "INSERT INTO tbl_curhat 
      VALUES(NULL, '$unique_id', '$urlSlug', '$subject', '$message', '$gambar', '$kate')");
      return mysqli_affected_rows($conn);
    }
  }
}

// Start returns With Validasi Variable
function validation($subject, $message, $kate) {
  if (empty($subject) || empty($message)) {
    set_userdata('isi input yang masih kosong terlebih dahulu', 'danger');
    return false;
  } else if (strlen($subject) <= 3) {
    set_userdata('subject terlalu pendek', 'danger');
    return false;
  } else if (strlen($message) <= 5) {
    set_userdata('message terlalu pendek', 'danger');
    return false;
 
  } else {
    //returns true if it passes the validation test
    return true;
  }
}

//// Variable Upload Thumbnail ////
function UploadThumbnail() {
  $nama_file = $_FILES['gambar']['name'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_name = $_FILES['gambar']['tmp_name'];

  //Start Validasi if not enter
  if ($error === 4) {
    set_userdata('upload file gambar terlebih dahulu', 'danger');
    return false;
  }

  //Type
  $kumpulan_ekstensi = ['jpg','jpeg','png'];
  $ekstensi_gambar = explode('.', $nama_file);
  $ekstensi_gambar = strtolower(end($ekstensi_gambar));

  //jika yang diupload bukan berupa file gambar
  if (!in_array($ekstensi_gambar, $kumpulan_ekstensi)) {
    set_userdata('yang anda upload bukan berupa file gambar', 'danger');
    return false;
  }

  //If what is uploaded is not an image
  if ($ukuran_file > 2000000) {
    set_userdata('ukuran file yang anda upload terlalu besar', 'danger');
    return false;
  }

  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_gambar;

  //Localtion folders 'uploads', saveing images
  move_uploaded_file($tmp_name, 'uploads/' . $nama_file_baru);
  return $nama_file_baru;
}


 