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

$idkategori = $_GET['id'];

$data = $db->getALL("SELECT * FROM t_kategori WHERE f_id = '$idkategori'")[0];

if(isset($_POST['ubah'])) {
  if($db->ubahkategori($_POST) > 0 ){
    echo "<script>
    alert('Ubah data kategori berhasil!');
    document.location.href= 'kategori.php';
    </script>";
  } else {
    echo "<script>
    alert('Ubah data kategori gagal!');
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
  <title>Halaman Ubah Kategori</title>

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
      <center><h1>Halaman Ubah Kategori</h1></center>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
          <form class="row g-3" method="post" action="">
            <input type="hidden" name="idkategori" value="<?= $data['f_id']; ?>">
            <div class="col-md-12">
              <label for="kategori" class="form-label">Kategori</label>
              <input type="text" name="kategori" class="form-control" id="kategori" placeholder="Masukkan kategori baru .." value="<?= $data['f_kategori']; ?>">
            </div>
            <div class="col-6 offset-md-4">
              <a href="kategori.php" class="btn btn-danger">Kembali</a>
              <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
            </div>
          </form>
        </div>
      </div>

    </div>
    
  </div>
</body>
</html>