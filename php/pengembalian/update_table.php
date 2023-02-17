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

$jumlahdataperhalaman = 10;
$totaldata = $db->rowCOUNT("SELECT f_id FROM t_detailpeminjaman");
$jumlahhalaman = ceil($totaldata / $jumlahdataperhalaman);
if (isset($_GET['halaman'])) {
    $halamanberapa = $_GET['halaman'];
} else {
    $halamanberapa = 1;
}

$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;

// deskripsikan bisa pakai keduanya. (halaman dan tidak ada)
$awaldata = $jumlahdataperhalaman * $halamanberapa - $jumlahdataperhalaman;

$Previous = $halaman - 1;
$Next = $halaman + 1;

$halamanawal =
$halaman > 1 ? $halaman * $jumlahdataperhalaman - $jumlahdataperhalaman : 0;

$query = "SELECT t_anggota.f_nama AS namaanggota, t_peminjaman.f_id, t_detailpeminjaman.f_tanggalkembali, t_buku.f_judul, t_admin.f_nama AS namaadmin,t_detailpeminjaman.f_id as idpengembalian, t_detailbuku.f_id as iddetailbuku
FROM t_peminjaman
INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id ORDER BY t_peminjaman.f_tanggalpeminjaman DESC LIMIT $awaldata, $jumlahdataperhalaman";

$pengembalian = $db->getALL($query);
    // tombol cari ditekan
if(isset($_POST["cari"])) {
    $pengembalian = $db->cariPengembalian($_POST["keyword"]);
}

?>
<table border="0" cellpadding="10" cellspacing="0" id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Judul Buku</th>
            <th>Tanggal Kembali</th>
            <th>Nama Admin</th>
            <th>Kembalikan</th>
            <th><center>Aksi</center></th>
        </tr>
    </thead>
    <?php $i = $halamanawal + 1;
    ?>
    <?php foreach( $pengembalian as $data ) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?php if($data['namaanggota'] == '') {echo 'Anggota tidak terdaftar';} else {echo $data['namaanggota'];} ?></td>
            <td><?= $data["f_judul"]; ?></td>
            <td id="tgl" data-tanggal="<?= $data['f_tanggalkembali']; ?>"> <?php
            if ($data['f_tanggalkembali'] == '0000-00-00') {
                echo "Belum Kembali";
            } else {
                echo $data['f_tanggalkembali'];
            } ?> </td>
            <td><?= $data['namaadmin']; ?></td>
            <td id="buttonKembali"><?php if ($data['f_tanggalkembali'] == '0000-00-00') { ?>
                <button type='button' class='btn btn-outline-danger id-detail kembalikan' data-iddetailbuku="<?= $data['iddetailbuku']; ?>" data-idpengembalian="<?= $data['idpengembalian']; ?>">Kembalikan</button>
            <?php } else { ?>
                <button type='button' class='btn btn-outline-success id-detail sudah-kembali' data-iddetailbuku="<?= $data['iddetailbuku']; ?>" data-idpengembalian="<?= $data['idpengembalian']; ?>">Sudah Kembali</button>
                <?php } ?> </td>
                <td>
                    <center>
                        <a href="hapusPengembalian.php?id=<?= $data["idpengembalian"]; ?>" onclick="return confirm('yakin?');"><i class="fa-sharp fa-solid fa-trash tbl-hapus"></i></a>
                    </center>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>
    
    <div class="pagination-flex">
        <div class="pagination">
            <ul class="page-list">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                        echo "href='?halaman=$Previous'";
                    } ?>>Previous</a>
                </li>
                <?php for ($i = 1; $i <= $jumlahhalaman; $i++): ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a  class="page-link" <?php if (
                        $halaman < $jumlahhalaman
                    ) {
                        echo "href='?halaman=$Next'";
                    } ?>>Next</a>
                </li>
            </ul>
        </div>
    </div>