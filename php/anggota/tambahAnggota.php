<?php   
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

if($_SESSION['level'] == 'Anggota Perpustakaan' || $_SESSION['level'] == 'Pustakawan') {
  echo "<script>
  alert('Anda bukan admin');
  document.location.href = '../home/index.php';
  </script>";
} else if ($_SESSION['status'] == 'Tidak Aktif') {
  echo "<script>
  alert('Akun anda tidak aktif');
  document.location.href = '../home/index.php
  </script>";
}

if(isset($_POST['tambah'])) {
  if($db->tambahAnggota($_POST) > 0 ){
    echo "<script>
    alert('Tambah data anggota berhasil!');
    document.location.href= 'anggota.php';
    </script>";
  } else {
    echo "<script>
    alert('Tambah data anggota Gagal!');
    document.location.href= 'anggota.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Tambah Anggota</title>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">

  <style> 
      body {
        overflow-x: hidden;
      }

      input {
        color:  #000;
      }

      .abu-login {
        background-color: #202020;
      }

      .form-control {
        color:  #000 !important ;
      }
  </style>

</head>
<body data-bs-theme="dark">
  <div class="container-fluid">
    <div class="col-6 offset-md-3 shadow rounded mt-5 p-3">
      <center><h1>Halaman Tambah Anggota</h1></center>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
          <form class="row g-3" method="post" action="">
            <div class="col-md-12">
              <label for="namaAnggota" class="form-label">Nama Anggota</label>
              <input type="text" name="namaAnggota" class="form-control" id="namaAnggota" placeholder="Masukkan nama anggota ..">
            </div>
            <div class="col-md-12">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username ..">
            </div>
            <div class="col-md-12">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password ..">
            </div>
            <div class="col-md-12">
              <label for="tempatLahir" class="form-label">Tempat Lahir</label>
              <input type="text" name="tempatLahir" class="form-control" id="tempatLahir" placeholder="Masukkan tempat lahir ..">
            </div>
            <div class="col-md-12">
              <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" placeholder="Masukkan tanggal lahir ..">
            </div>
            <div class="col-6 offset-md-4">
              <a href="anggota.php" class="btn btn-danger">Kembali</a>
              <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
            </div>
          </form>
        </div>
      </div>

    </div>
    
  </div>
</body>
</html>