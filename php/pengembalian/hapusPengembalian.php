<?php
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

if($_SESSION['level'] != 'Admin') {
    echo "<script>
    alert('Anda bukan admin!');
    document.location.href = '../home/index.php';
    </script>";
    exit;
}

// Jika session login tidak ada maka kembali ke halaman login
if (!isset($_SESSION['login'])) {
    header('location: login.php');
    exit();
}

$iddetailPeminjaman = $_GET['id'];

if ($db->hapusPengembalian($iddetailPeminjaman) > 0) {
    echo "<script>
                alert('data berhasil dihapus!');
                document.location.href = 'pengembalian.php';
            </script>";
} else {
    echo "<script>
                alert('data gagal dihapus!');
                // document.location.href = 'pengembalian.php';
            </script>";
}

return mysqli_affected_rows($db->conn);
?>
