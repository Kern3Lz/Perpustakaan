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

if(isset($_POST['action']) && $_POST['action'] == 'Kembalikan') {
    $idPengembalian = $_POST['idPengembalian'];
    $idDetailBuku = $_POST['idDetailBuku'];

    $query = "UPDATE t_detailbuku SET f_status='tersedia' WHERE f_id=$idDetailBuku";
    $hasil = $db->runSQL($query);

    $tanggal = date('Y-m-d');

    $query = "UPDATE t_detailpeminjaman SET f_tanggalkembali='$tanggal' WHERE f_id=$idPengembalian";
    $hasil = $db->runSQL($query);

    echo mysqli_affected_rows($db->conn);
}


if(isset($_POST['action']) && $_POST['action'] == 'Sudah Kembali') {
    $idPengembalian = $_POST['idPengembalian'];
    $idDetailBuku = $_POST['idDetailBuku'];

    $query = "UPDATE t_detailbuku SET f_status='tidak' WHERE f_id=$idDetailBuku";
    $hasil = $db->runSQL($query);

    $tanggal = date('0000-00-00');

    $query = "UPDATE t_detailpeminjaman SET f_tanggalkembali='$tanggal' WHERE f_id=$idPengembalian";
    $hasil = $db->runSQL($query);

    echo mysqli_affected_rows($db->conn);
}
?>