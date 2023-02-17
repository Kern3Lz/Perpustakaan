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
$totaldata = $db->rowCOUNT("SELECT t_anggota.f_nama AS f_namaanggota, t_kategori.f_kategori,t_peminjaman.f_id, t_peminjaman.f_tanggalpeminjaman, t_buku.f_judul, t_admin.f_nama AS f_namaadmin, t_detailbuku.f_id as f_iddetb
	FROM t_peminjaman
	INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
	INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
	INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
	INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
	INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id
	INNER JOIN t_kategori ON t_buku.f_idkategori = t_kategori.f_id
	ORDER BY t_peminjaman.f_id DESC");

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

$query = "SELECT t_anggota.f_nama AS f_namaanggota, t_kategori.f_kategori,t_peminjaman.f_id, t_peminjaman.f_tanggalpeminjaman, t_buku.f_judul, t_admin.f_nama AS f_namaadmin, t_detailbuku.f_id as f_iddetb
FROM t_peminjaman
INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id
INNER JOIN t_kategori ON t_buku.f_idkategori = t_kategori.f_id
ORDER BY f_tanggalpeminjaman DESC LIMIT $awaldata, $jumlahdataperhalaman";

$peminjaman = $db->getALL($query);

	// tombol cari ditekan
if(isset($_POST["cari"])) {
	$peminjaman = $db->cariPeminjaman($_POST["keyword"]);
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

	<!-- Link CSS -->
	<link rel="stylesheet" href="../../assets/style/style.css">

	<!-- Link Bootstrap -->
	<link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">


	<!-- Link Font Awesome -->
	<link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../../assets/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="../../assets/fontawesome/css/solid.min.css">

	<!-- Sweetalert -->
	<link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">

	<style>
		.username {
			border: none;
			color: rgb(255, 255, 255);
			padding: 8px 12px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			margin: 8px 2px;
			border-radius: 0.375rem;
		}

		.header-m {
			margin-bottom: 5px;
		}

		.kiri-form {
			float: right;
		}

		table {
			border: none;
		}

		table tr td {
			padding: .5rem;
		}

		table thead tr th {
			background-color: #000;
			color: #fff;
		}

		table tr:nth-child(even) {
			background-color: #212529;
		}

		table tr:nth-child(odd) {
			background-color: #2c3034;
		}

		h1 {
			font-size: 2.25rem;
			margin: .5rem 0 2rem 0;
		}
	</style>
</head>
<body data-bs-theme="dark">
	<div class="container-fluid">
		<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-around py-3 px-5">
			<a href="../home/index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
				<span class="fs-4">Perpustakaan</span>
			</a>

			<ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
				<li class="nav-item">
					<a href="../home/index.php" class="nav-link text-white" aria-current="page">
						Home
					</a>
				</li>
				<li>
					<a href="../buku/buku.php" class="nav-link text-white">
						Buku
					</a>
				</li>
				<?php if($_SESSION['level'] == 'Anggota Perpustakaan') {
					echo '
					<li>
					<a href="../peminjaman/riwayatPeminjaman.php" class="nav-link text-white">
					Riwayat Peminjaman
					</a>
					</li>
					<li>';
				} ?>
				<?php if ($_SESSION['level'] == 'Admin' || 'Pustakawan') { 
					echo '

					<li>
					<a href="../kategori/kategori.php" class="nav-link text-white">
					Kategori
					</a>
					</li>

					<li>
					<a href="../peminjaman/peminjaman.php" class="nav-link active">
					Peminjaman
					</a> 
					</li> 

					<li>
					<a href="../pengembalian/pengembalian.php" class="nav-link text-white">
					Pengembalian
					</a>
					</li>';
				}?>
				<?php if ($_SESSION['level'] == 'Admin') { 
					echo '<li>
					<a href="../anggota/anggota.php" class="nav-link text-white">
					Anggota
					</a>
					</li>';
				}?>
				<?php if ($_SESSION['level'] == 'Admin' || 'Pustakawan') { 
					echo '<li>
					<a href="../laporan/laporan.php" class="nav-link text-white">
					Laporan
					</a>
					</li>';
				}?>
			</ul>

			<div class="d-flex col-md-3 text-end align-items-center justify-content-center">
				<!-- <button type="button" class="btn btn-outline-primary me-2">Login</button>
					<button type="button" class="btn btn-primary">Sign-up</button> -->
					<div class="dropdown text-end">
						<a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="../../assets/profil/default-profil.png" alt="" width="32" height="32" class="rounded-circle me-2">
							<strong><?= $_SESSION['username']; ?></strong>
						</a>
						<ul class="dropdown-menu dropdown-menu-dark text-small shadow">
							<li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
						</ul>
					</div>
				</div>

			</header>
		</div>

		<!-- Content -->
		<div class="content">


			<center><h1>Daftar Peminjaman Buku Perpustakaan</h1></center>

			<form action="" method="post">

				<a href="tambahPeminjaman.php" class="tbl-cari">Tambah</a>

				<input type="text" name="keyword" id="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
				<button type="submit" name="cari" class="tbl-cari">Cari!</button>

				<?php if (isset($_SESSION['username'])) { ?>
					<a href="../logout.php" class="tbl-hapus kiri-form" role="button" onclick="return confirm('Yakin?');" title="Logout"><i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>
					<div class="username kiri-form">
						<?= $_SESSION['username'] ?>
					</div>
				<?php } ?>
			</form>	
			<br>

			<table border="0" cellpadding="10" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama</th>
						<th>Kategori</th>
						<th>Judul Buku</th>
						<th>Tanggal Pinjam</th>
						<th>Nama Admin</th>
						<th><center>Aksi</center></th>
					</tr>
				</thead>
				<?php $i = $halamanawal + 1;
				?>
				<?php foreach($peminjaman as $data) : ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?php if($data['f_namaanggota'] == '') {echo 'Anggota tidak terdaftar';} else {echo $data['f_namaanggota'];} ?></td>
						<td><?= $data['f_kategori'] ?></td>
						<td><?= $data["f_judul"]; ?></td>
						<td><?= $data["f_tanggalpeminjaman"]; ?></td>
						<td><?= $data["f_namaadmin"]; ?></td>
						<td>
							<center>
								<a href="ubahPeminjaman.php?id=<?= $data["f_id"] ?>&idb=<?= $data['f_iddetb']; ?>"><i class="fa-sharp fa-solid fa-edit tbl-edit"></i></a>
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
		</div>
	</main>

	
	<script src="../../assets/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>