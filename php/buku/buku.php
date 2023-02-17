<?php 
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

$jumlahdataperhalaman = 10;
$totaldata = $db->rowCOUNT('SELECT f_id FROM t_buku');
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

$buku = $db->getALL("SELECT t_buku.*, t_buku.f_id AS idbuku, t_kategori.f_kategori FROM t_buku, t_kategori WHERE t_buku.f_idkategori = t_kategori.f_id ORDER BY idbuku ASC LIMIT " . $awaldata . "," . $jumlahdataperhalaman);

	// tombol cari ditekan
if(isset($_POST["cari"])) {
	$buku = $db->cariBuku($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Data Buku</title>

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
			margin-bottom: 1rem;
		}

		table tr td {
			padding: 1rem;
		}

		table thead tr th {
			background-color: #000;
			color: #fff;
			padding: .5rem 1rem;
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

		td.deskripsi {
			width: 30%;
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
					<a href="../buku/buku.php" class="nav-link active">
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
				<?php if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] =='Pustakawan') {
					echo '
					<li>
					<a href="../kategori/kategori.php" class="nav-link text-white">
					Kategori
					</a>
					</li>

					<li>
					<a href="../peminjaman/peminjaman.php" class="nav-link text-white">
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
				<?php if ($_SESSION['level'] == 'Admin' || $_SESSION['level'] =='Pustakawan') { 
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
			<center><h1>Daftar Buku Perpustakaan</h1></center>

			<form action="" method="post">

				<?php if($_SESSION['level'] == 'Admin') { ?>
					<a href="tambahBuku.php" class="tbl-cari">Tambah Buku</a>

				<?php } ?>
				<input type="text" name="keyword" id="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off">
				<button type="submit" name="cari" class="tbl-cari">Cari!</button>

				<?php if (isset($_SESSION['username'])) { ?>
					<div class="username kiri-form">
						<?= $_SESSION['level']; ?>
						<?= $_SESSION['username'] ?>
					</div>
				<?php } ?>
			</form>	
			<br>

			<table border="0" cellpadding="10" cellspacing="0" class="mb-3">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Judul Buku</th>
						<th scope="col">Kategori Buku</th>
						<th scope="col">Pengarang</th>
						<th scope="col">Penerbit</th>
						<th scope="col">Deskripsi</th>
						<?php if($_SESSION['level'] == 'Admin') { ?>
							<th scope="col">Stok Buku</th>
							<th scope="col">Aksi</th>
						<?php } ?>
					</tr>
				</thead>
				<?php $i = $halamanawal + 1;
				?>
				<?php if(!empty($buku)) { 
				 foreach($buku as $data) : ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $data['f_judul']; ?></td>
						<td><?= $data['f_kategori']; ?></td>
						<td><?= $data['f_pengarang']; ?></td>
						<td><?= $data['f_penerbit']; ?></td>
						<td class="deskripsi"><?= $data['f_deskripsi']; ?></td>
						<?php if($_SESSION['level'] == 'Admin') { ?>
							<td>
								<ul class="pagination pagination-sm">
									<li class="page-item"><a class="page-link btn-minus-stock book_id" data-idbuku="<?= $data['idbuku']; ?>" style="cursor: pointer;">-</a></li>
									<li class="page-item"><a class="page-link book-stock"><?php $stokBuku = $db->rowCOUNT("SELECT * FROM t_detailbuku WHERE f_status='tersedia' AND f_idbuku = " . $data['idbuku'] . ""); echo $stokBuku; ?></a></li>
									<li class="page-item"><a class="page-link btn-add-stock book_id" data-idbuku="<?= $data['idbuku']; ?>" style="cursor: pointer;">+</a></li>
								</ul>
							</td>


							<td>
								<center>
									<a href="ubahBuku.php?idBuku=<?= $data["idbuku"]; ?>"><i class="fa-sharp fa-solid fa-edit tbl-edit"></i></a>
									<a href="hapusBuku.php?idBuku=<?= $data["idbuku"]; ?>" onclick="return confirm('yakin?');"><i class="fa-sharp fa-solid fa-trash tbl-hapus"></i></a>
								</center>
							</td>
						<?php } ?>
						
					</tr>
					<?php $i++; ?>
				<?php endforeach; } ?>

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
	<!--? jQuery CDN -->
	<script src="../../assets/js/jquery-3.6.1.min.js"></script>

	<script>
		$(document).on("click", ".book_id", function(){
			var idBuku = $(this).data("idbuku");
   			//use idBuku in your ajax function
		});

		$(document).ready(function() {
			$('.btn-add-stock').click(function() {

    			// get the current stock value
				var stock = $(this).closest('tr').find('.book-stock').text();
				if (stock < 0) {
					stock = 0;
				}				
				// get idbuku
				var idBuku = $(this).data("idbuku");
    			// update the stock value
				$(this).closest('tr').find('.book-stock').text(parseInt(stock) + 1);
    			// send an AJAX request to update the stock in the database
				$.ajax({
					url: 'ubahBuku.php',
					type: 'post',
					data: { action: 'add', book_id: idBuku, stokBuku:stock },
					success: function(response) {
						console.log(response);
					}
				});
			});

			$('.btn-minus-stock').click(function() {
    			// get the current stock value
				var stock = $(this).closest('tr').find('.book-stock').text();
				if (stock < 0) {
					stock = 0;
				}	
				// get idbuku
				var idBuku = $(this).data("idbuku");
    			// update the stock value
				$(this).closest('tr').find('.book-stock').text(parseInt(stock) - 1);
    			// send an AJAX request to update the stock in the database
				$.ajax({
					url: 'ubahBuku.php',
					type: 'post',
					data: { action: 'minus', book_id: idBuku, stokBuku:stock },
					success: function(response) {
						console.log(response);
					}
				});
			});
		});
	</script>
</body>
</html>