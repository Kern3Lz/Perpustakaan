<?php   
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

if($_SESSION['level'] == 'Anggota Perpustakaan') {
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
  if($db->tambahKategori($_POST) > 0 ){
    echo "<script>
    alert('Tambah data kategori berhasil!');
    document.location.href= 'kategori.php';
    </script>";
  } else {
    echo "<script>
    alert('Tambah data kategori Gagal!');
    document.location.href= 'kategori.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Tambah Kategori</title>

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

      .form-select {
        color:  #000 !important ;
      }
  </style>

</head>
<body data-bs-theme="dark">
  <div class="container-fluid">
    <div class="col-6 offset-md-3 shadow rounded mt-5 p-3">
      <center><h1>Halaman Tambah Kategori</h1></center>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
          <form class="row g-3" method="post" action="">
            <div class="col-md-12">
              <label for="kategori" class="form-label">Kategori</label>
              <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Masukkan nama anggota ..">
            </div>
            <div class="col-6 offset-md-4">
              <a href="kategori.php" class="btn btn-danger">Kembali</a>
              <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
            </div>
          </form>
        </div>
      </div>

    </div>
    
  </div>
</body>
</html>