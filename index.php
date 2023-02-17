<?php 	
ob_start();
session_start();
require_once 'php/dbcontroller.php';
$db = new DBConnection();

$jumlahdataperhalaman = 10;
$totaldata = $db->rowCOUNT('SELECT * FROM t_buku');
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

$buku = $db->getALL("SELECT t_buku.*, t_buku.f_id AS idBuku, t_kategori.f_kategori FROM t_buku, t_kategori WHERE t_buku.f_idkategori = t_kategori.f_id ORDER BY t_buku.f_id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Perpustakaan - PWEB</title>

	<!-- Icon -->
	<link rel="shortcut icon" href="assets/icon/favicon.png" type="image/x-icon">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap-5.3.0/css/bootstrap.min.css">

	<!-- Link CSS -->
	<link rel="stylesheet" href="style.css">

	<style>
		body {
			font-size: 14px;
		}

		.card-image-top {
			width: 100px;
		}

		.card-title {
			overflow-y: scroll;
			height: 19px;
		}

		.card-title::-webkit-scrollbar {
			width: 4px;
			background-color: #212529;
			display: none;
		}
		.card-title::-webkit-scrollbar-track {
			border-radius: 10px;
		}

		.card-title::-webkit-scrollbar-thumb {
			background: rgb(79, 79, 79);
			border-radius: 10px;
		}

		.card-title:hover::-webkit-scrollbar {
			display: block;
		}

		.card-text {
			overflow-y: scroll;
			height: 80px;
		}

		.card-text::-webkit-scrollbar {
			width: 4px;
			background-color: #212529;
			display: none;
		}
		.card-text::-webkit-scrollbar-track {
			border-radius: 10px;
		}

		.card-text::-webkit-scrollbar-thumb {
			background: rgb(79, 79, 79);
			border-radius: 10px;
		}

		.card-text:hover::-webkit-scrollbar {
			display: block;
		}
	</style>
</head>
<body data-bs-theme="dark">
	<div class="container">
		<header class="d-flex justify-content-center py-3">
			<ul class="nav nav-pills">
				<li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
				<li class="nav-item"><a href="php/admin/login.php" class="nav-link">Admin</a></li>
				<li class="nav-item"><a href="php/pustakawan/login.php" class="nav-link">Pustakawan</a></li>
				<li class="nav-item"><a href="php/anggota/login.php" class="nav-link">Anggota</a></li>
			</ul>
		</header>
	</div>

	<h3 class="text-center mt-4">Selamat Datang di Perpustakaan Online!</h3>
	<hr class="mt-3 mb-4">
	<h4 class="text-center">List Buku</h4>

	<div class="list-buku mt-3">
		<div class="container-fluid">
			<div class="row">
				<?php 
				foreach ($buku as $data) : 
					?>
					<div class="col-md-2">
						<div class="card text-bg-dark mb-3 ms-3" style="max-width: 18rem;">
							<a href="php/buku/detailbuku.php?id=<?= $data['idBuku']; ?>"><div class="card-header"><img src="assets/img/default-book.png" width="75" class="card-img-top" alt="..."></div></a>
							<div class="card-body">
								<h6 class="card-title"><?= $data['f_judul']; ?></h6>
								<p style="margin-bottom: .3rem; font-size: .8rem;">Kategori: <?= $data['f_kategori']; ?></p>
								<p class="card-text"><?= $data['f_deskripsi']; ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		
	</div>

	<script>
	</script>
</body>
</html>