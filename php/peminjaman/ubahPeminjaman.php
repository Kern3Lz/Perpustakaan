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

$idPeminjaman = $_GET['id'];
$idBuku = $_GET['idb'];


$peminjaman = $db->getITEM("SELECT f_iddetailbuku,  f_idanggota, f_idadmin, f_tanggalpeminjaman, t_peminjaman.f_id 
    FROM t_peminjaman
    INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id = t_detailpeminjaman.f_idpeminjaman
    WHERE t_peminjaman.f_id = $idPeminjaman");

$admin = $db->getALL("SELECT * FROM t_admin ORDER BY f_nama ASC");
$anggota = $db->getALL("SELECT * FROM t_anggota ORDER BY f_nama ASC");
$buku = $db->getALL("SELECT DISTINCT t_buku.f_id, t_buku.f_judul, t_buku.f_deskripsi, t_detailbuku.f_id AS iddetailbuku
    FROM t_detailbuku
    INNER JOIN t_buku ON t_detailbuku.f_idbuku = t_buku.f_id
    WHERE t_detailbuku.f_status = 'tersedia' OR t_detailbuku.f_id = $idBuku
    GROUP BY t_buku.f_judul ASC");

if(isset($_POST['ubah'])) {
  if($db->ubahPeminjaman($_POST) > 0 ){
    echo "<script>
    alert('Ubah data peminjaman berhasil!');
    document.location.href= 'peminjaman.php';
    </script>";
} else {
    echo "<script>
    alert('Ubah data peminjaman Gagal!');
    // document.location.href= 'peminjaman.php';
    </script>";
    var_dump($_POST);
    var_dump($db->tambahPeminjaman($_POST));
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Peminjaman Buku</title>

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
      <center><h1>Halaman Peminjaman Buku</h1></center>
      <hr>
      <div class="row">
        <div class="col-8 offset-md-2">
            <form class="row g-3" method="post" action="">
                <input type="hidden" name="idPeminjaman" value="<?= $idPeminjaman; ?>">
                <input type="hidden" name="idDetailBuku" value="<?= $idBuku; ?>">
                <div class="col-md-12">
                  <label for="idAdmin" class="form-label">Nama Admin</label>
                  <select name="idAdmin" id="idAdmin" class="form-select">
                    <option disabled selected>Pilih Admin</option>
                    <?php foreach ($admin as $data) : ?>
                     <option value="<?= $data['f_id']; ?>" <?php if ($peminjaman['f_idadmin'] == $data['f_id']) {echo "SELECTED";} ?>><?= $data['f_nama']; ?></option>
                 <?php endforeach ?>
             </select>
         </div>

         <div class="col-md-12">
           <label for="idAnggota">Anggota</label><br>
           <select name="idAnggota" id="idAnggota" class="form-select">
            <option disabled selected>Pilih Anggota</option>
            <?php foreach ($anggota as $data) : ?>
                <option value="<?= $data['f_id']; ?>" <?php if ($peminjaman['f_idanggota'] == $data['f_id']) {echo "selected";} ?>><?= $data['f_nama']; ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="col-md-12">
        <label for="judulBuku">Judul Buku</label><br>
        <select name="judulBuku" id="judulBuku" class="form-select">
            <option disabled selected>Pilih Buku</option>
            <?php foreach ($buku as $data) : ?>
                <option value="<?= $data['iddetailbuku']; ?>" <?php if($idBuku == $data['iddetailbuku']) { echo 'selected';} ?>>
                    <?= $data['f_judul'] ?>
                </option>
            <?php endforeach ?>
        </select>       
    </div>

    <div class="col-md-12">
        <label for="tanggalPinjam">Tanggal Peminjam</label>
        <input class="form-control mb-3" type="date" name="tanggalPinjam" placeholder="Masukkan Tanggal" value="<?= $peminjaman['f_tanggalpeminjaman']; ?>"/>
    </div>

    <div class="col-6 offset-md-4">
        <a href="peminjaman.php" class="btn btn-danger">Kembali</a>
        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
    </div>
</form>
</div>
</div>

</div>

</div>

<script src="../../assets/js/jquery-3.6.1.min.js"></script>
</script>
</body>
</html>