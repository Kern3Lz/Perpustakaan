<?php 	
ob_start();
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

if(isset($_GET['id'])) {
	$idBukuURL = $_GET['id'];
}

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

$buku = $db->getALL("SELECT t_buku.f_id as idbuku, t_buku.f_deskripsi, t_buku.f_judul, t_kategori.f_kategori FROM t_buku, t_kategori WHERE t_buku.f_idkategori = t_kategori.f_id AND t_buku.f_id = $idBukuURL ORDER BY t_buku.f_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Detail Buku</title>

	<!-- Icon -->
	<link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">

	<!-- Link CSS -->
	<link rel="stylesheet" href="../../style.css">

	<style>
		body {
			font-size: 14px;
		}

		.card-image-top {
			width: 100px;
		}

		.card-title {
			overflow-y: scroll;
			height: 2rem;
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
	<div class="container"
		<header class="d-flex justify-content-center py-3">
			<ul class="nav nav-pills">
				<li class="nav-item"><a href="../../index.php" class="nav-link active" aria-current="page">Home</a></li>
				<li class="nav-item"><a href="../../php/admin/login.php" class="nav-link">Admin</a></li>
				<li class="nav-item"><a href="../../php/pustakawan/login.php" class="nav-link">Pustakawan</a></li>
				<li class="nav-item"><a href="../../php/anggota/login.php" class="nav-link">Anggota</a></li>
			</ul>
		</header>
	</div>

	<div class="list-buku">
		<div class="container-fluid">
			<div class="row">
				<?php 
				foreach($buku as $data) : 
					?>
					<div class="card mb-6 offset-md-3 mt-md-5" style="max-width: 720px;">
						<div class="row g-0">
							<div class="col-md-4">
								<div class="card-header"><img src="../../assets/img/default-book.png" class="card-img-top rounded" alt="..."></div>
							</div>
							<div class="col-md-8">
								<div class="card-body">
									<h6 class="card-title mb-3 fs-5"><?= $data['f_judul']; ?></h6>
									<p class="mb-3">Kategori: <?= $data['f_kategori']; ?></p>
									<p class="card-text mb-1"><?= $data['f_deskripsi']; ?></p>
									<p>Jumlah Buku :  <?php $stokBuku = $db->rowCOUNT("SELECT * FROM t_detailbuku WHERE f_status='tersedia' AND f_idbuku = " . $data['idbuku'] . ""); echo $stokBuku; ?></p>
									<p>Status :  <?php $stokBuku = $db->rowCOUNT("SELECT * FROM t_detailbuku WHERE f_status='tersedia' AND f_idbuku = " . $data['idbuku'] . ""); if($stokBuku < 1 ) {echo '<span class="badge rounded-pill text-bg-danger">Dipinjam</span>';} else {echo '<span class="badge rounded-pill text-bg-success">Ada</span>';} ?></p>
								</div>
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