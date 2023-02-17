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

// Jika session login tidak ada maka kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
}

$idBuku = $_GET['idBuku'];

$data = $db->getALL("SELECT * FROM t_buku WHERE f_id = $idBuku")[0];

if ($db->hapusBuku($idBuku) > 0) {
    echo "<script>
                alert('data berhasil dihapus!');
                document.location.href = 'buku.php';
            </script>";
} else {
    echo "<script>
                alert('data gagal dihapus!');
                // document.location.href = 'buku.php';
            </script>";
}

return mysqli_affected_rows($db->conn);
?>
