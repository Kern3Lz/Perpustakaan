<?php   
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

if(isset($_POST['login'])) {
  if($db->cek_login_anggota($_POST)){
    echo "<script>
    alert('Login Berhasil');
    </script>";
  } else {
    echo "<script>
    alert('Login Gagal');
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login Anggota</title>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">

  <!-- Link Font Awesome -->
  <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../../assets/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="../../assets/fontawesome/css/solid.min.css">

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
  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="../../index.php" class="nav-link" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="../../php/admin/login.php" class="nav-link">Admin</a></li>
        <li class="nav-item"><a href="../../php/pustakawan/login.php" class="nav-link">Pustakawan</a></li>
        <li class="nav-item"><a href="../../php/anggota/login.php" class="nav-link  active">Anggota</a></li>
      </ul>
    </header>
  </div>

  <div class="container-fluid">
    <div class="col-6 offset-md-3 rounded mt-5 p-3  abu-login">
      <div class="d-flex justify-content-between align-items-center"><a href="../pustakawan/login.php" style="color: white;"><i class="fa-sharp fa-solid fa-caret-left"></i></a><h1>Halaman Login Anggota</h1><a></a></div>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
          <form class="row g-3" method="post" action="">
            <?php if (isset($_GET['login'])) {
              echo "<div class='alert-danger alert text-center '>
              Username atau Password Salah!
              </div>";  
            } ?>
            <div class="col-md-12 mb-3 mt-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username ..">
            </div>
            <div class="col-md-12 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password ..">
            </div>
            <div class="col-12 text-center ">
              <button type="submit" name="login" class="btn btn-primary">Sign in</button>
            </div>
          </form>
        </div>
      </div>

    </div>
    
  </div>
</body>
</html>