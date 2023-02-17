<?php
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();
echo $_SESSION['status'];

if($_SESSION['level'] == 'Anggota Perpustakaan') {
  echo "<script>
  alert('Anda bukan admin');
  document.location.href = '../home/index.php';
  </script>";
}

if ($_SESSION['status'] == 'Tidak Aktif') {
  echo "<script>
  alert('Akun anda tidak aktif');
  document.location.href = '../home/index.php
  </script>";
}

if(isset($_POST['action']) && $_POST['action'] == 'minus') {
    $book_id = $_POST['book_id'];
    // $stokBaru = $_POST['stokBuku'] - 1;
    $select = $db->rowCOUNT("SELECT * FROM t_detailbuku WHERE f_idbuku = $book_id");

    if ($select < 0) {
        return false;
    } else {
        // $query = "UPDATE buku SET stokBuku = $stokBaru WHERE idBuku = $book_id";
        // $result = $db->runSQl($query);
    $query = "SELECT DISTINCT t_detailbuku.f_id AS idDetailBuku, t_buku.f_id, t_buku.f_judul, t_buku.f_idkategori, t_buku.f_pengarang, t_buku.f_penerbit, t_buku.f_deskripsi FROM t_buku                   
    INNER JOIN t_kategori ON t_buku.f_idkategori=t_kategori.f_id                  
    LEFT JOIN t_detailbuku ON t_buku.f_id=detailbuku.f_idbuku WHERE f_status='Tersedia' AND t_detailbuku.f_id= $book_id ORDER BY t_detailbuku.idDetailBuku DESC LIMIT 1";
    $idDihapus  = $db->getITEM($query);
    $query = "DELETE FROM t_detailbuku WHERE f_id=" . $idDihapus['idDetailBuku'];
    $result = $db->runSQL($query);

    return $result;
    }
    if ($result > 0) {
        echo mysqli_affected_rows($db->conn);
        echo $idDihapus['idDetailBuku'];
    } else {
        echo "Update failed";
    }
}


if(isset($_POST['action']) && $_POST['action'] == 'add') {
    $book_id = $_POST['book_id'];
    $select = $db->rowCOUNT("SELECT * FROM t_detailbuku WHERE f_idbuku = $book_id");


    if ($select < 0) {
        return false;
    } else {
        // $query = "UPDATE buku SET stokBuku = $stokBaru WHERE idBuku = $book_id";
        // $result = $db->runSQl($query);
    $query = "INSERT INTO t_detailbuku VALUES ('', $book_id,'Tersedia')";
    $result = $db->runSQL($query);
    return $result;
    }
    if ($result > 0) {
        echo mysqli_affected_rows($db->conn);
    } else {
        echo "Update failed";
    }
}

// Jika session login tidak ada maka kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
}

$idBuku = $_GET['idBuku'];

$buku = $db->getALL("SELECT * FROM t_buku WHERE f_id = $idBuku")[0];

if (isset($_POST['ubah'])) {
    $_SESSION['login'] = true;
    if ($db->ubahBuku($_POST) > 0) {
        echo "<script>
        alert('data berhasil diubah');
        document.location.href = 'buku.php';
        </script>";
    } else {
        echo "<script>
        alert('data gagal diubah');
                    // document.location.href = 'buku.php';
        </script>";
        var_dump($_POST);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Ubah Buku</title>

    <!-- Link Favicon -->
    <link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

    <!-- Link Bootstrap -->
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
    <div class="container-fluid mb-5">
        <div class="col-6 offset-md-3 shadow rounded mt-5 p-3">
          <center><h1>Halaman Peminjaman Buku</h1></center>
          <hr>
          <div class="row">
            <div class="col-8 offset-md-2">

                <form class="row g-3" action="" method="post">
                    <input type="text" name="idBuku" id="idBuku" required value="<?= $buku[
                        'f_id'
                        ] ?>" hidden>
                        <div class="col-md-12">
                            <label for="idkategori" class="form-label">Kategori</label>
                            <select name="idkategori" id="idkategori" class="form-select">
                                <?php
                                $showKategori = $db->getALL("SELECT * FROM t_kategori");
                                foreach($showKategori as $dataKategori ) :
                                    ?>
                                    <!-- make dropdown select for UPDATE idKategori -->
                                    <option value="<?= $dataKategori['f_id']; ?>" <?php if($buku['f_idkategori'] == $dataKategori['f_id']){echo "SELECTED";} ?>><?= $dataKategori['f_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="judulBuku" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="judulBuku" id="judulBuku" value="<?= $buku['f_judul']; ?>" required placeholder="Masukkan Judul Buku ..">
                        </div>

                        <div class="col-md-12">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= $buku['f_pengarang']; ?>" required placeholder="Masukkan Pengarang ..">
                        </div>
                        <div class="col-md-12">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $buku['f_penerbit']; ?>" required placeholder="Masukkan Penerbit ..">
                        </div>
                        <div class="col-md-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="<?= $buku['f_deskripsi']; ?>" required placeholder="Masukkan Deskripsi ..">
                        </div>
                        <div class="col-6 offset-md-4">
                            <a href="buku.php" class="btn btn-danger">Kembali</a>
                            <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

