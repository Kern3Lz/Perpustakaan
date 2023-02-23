<?php   
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

if(isset($_POST['registrasi'])) {
  if($db->registrasiAdmin($_POST)){
    setcookie('username', $_POST['username'], time() + 60, '/');
    setcookie('password', $_POST['password'], time() + 60, '/');
    echo "<script>
    alert('Registasi Berhasil, Silahkan Login');
    document.location.href = 'login.php';
    </script>";
  } else {
    echo "<script>
    alert('Registrasi Gagal');
    </script>";
    var_dump($_POST);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Registrasi Admin</title>

  <!-- Icon -->
  <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">

  <style> 
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
<body data-bs-theme="dark" class="pb-5">  
  <div class="container-fluid">
    <div class="col-6 offset-md-3 rounded mt-5 p-3  abu-login">
      <center><h1>Halaman Registrasi Admin</h1></center>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
          <form class="row g-3" method="post" action="">
            <div class="col-md-12 mb-3 mt-4">
              <label for="namaAdmin" class="form-label">Nama Admin</label>
              <input type="text" name="namaAdmin" class="form-control" id="namaAdmin" placeholder="Masukkan nama ..">
            </div>
            <div class="col-md-12 mb-3 mt-2">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username ..">
            </div>
            <div class="col-md-12 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password ..">
            </div>
            <div class="col-md-12 mb-3 mt-2">
              <label for="level" class="form-label">Level</label>
              <select class="form-select" aria-label="Default select example" name="level" id="level">
                <option selected>Level</option>
                <option value="Admin">Admin</option>
              </select>
            </div>
            <div class="col-md-12 mb-3 mt-2">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" aria-label="Default select example" name="status" id="status">
                <option selected>Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
            <div class="col-12 text-center ">
              <button type="submit" name="registrasi" class="btn btn-primary">Sign Up</button>
            </div>

            <div class="col-12 text-center">
              <p>Sudah punya akun? <a href="login.php">Login</a> </p>
            </div>
          </form>
        </div>
      </div>

    </div>
    
  </div>
</body>
</html>