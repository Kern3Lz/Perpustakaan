<?php 
session_start();
require_once '../dbcontroller.php';
$db = new DBConnection();

require_once __DIR__ . '../../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

if($_GET['cetak'] == 'xls') {
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Riwayat Peminjaman.xls");

	$query = "SELECT t_peminjaman.f_id AS idpeminjaman, t_peminjaman.f_tanggalpeminjaman, t_detailpeminjaman.f_tanggalkembali, t_anggota.f_nama AS namaanggota, t_anggota.f_kelas, t_anggota.f_jurusan, t_admin.f_nama AS namaadmin, t_detailbuku.f_id AS iddetailbuku, t_buku.f_judul, t_kategori.f_kategori
	FROM t_peminjaman
	LEFT JOIN t_anggota ON t_peminjaman.f_idanggota = t_anggota.f_id
	LEFT JOIN t_admin ON t_peminjaman.f_idadmin = t_admin.f_id
	LEFT JOIN t_detailpeminjaman ON t_peminjaman.f_id = t_detailpeminjaman.f_idpeminjaman
	LEFT JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku = t_detailbuku.f_id
	LEFT JOIN t_buku ON t_detailbuku.f_idbuku = t_buku.f_id
	LEFT JOIN t_kategori ON t_buku.f_idkategori = t_kategori.f_id
	WHERE t_peminjaman.f_id IS NOT NULL AND t_buku.f_judul IS NOT NULL AND t_anggota.f_nama = '$_SESSION[namaAnggota]'
	ORDER BY t_peminjaman.f_tanggalpeminjaman DESC";
	$row = $db->getALL($query);

	$no = 1;
	?>

	<style>
		.w {
			border: solid black;
			padding: 1px;
		}
	</style>

	<table class="w table w-100">
		<thead class="w table-primary">
			<tr>
				<th class="w">No</th>
				<th class="w">Nama</th>
				<th class="w">Nama Admin</th>
				<th class="w">Judul Buku</th>
				<th class="w">Kategori</th>
				<th class="w">Kelas</th>
				<th class="w">Jurusan</th>
				<th class="w">Tanggal Pinjam</th>
				<th class="w">Tanggal Kembali</th>
				<th class="w">Status</th>
			</tr>
		</thead>
		<tbody>
			<table class="w">
				<?php foreach($row as $data) : ?>
					<tr>
						<td class="w"><?= $no++; ?></td>
						<td><?php if($data['namaanggota'] == '') {echo 'Anggota tidak terdaftar';} else {echo $data['namaanggota'];} ?></td>
						<td><?= $data["namaadmin"]; ?></td>
						<td><?= $data["f_judul"]; ?></td>
						<td><?= $data["f_kategori"]; ?></td>
						<td class="text-center"><?= $data['f_kelas']; ?></td>
						<td class="text-center"><?= $data['f_jurusan']; ?></td>
						<td class="text-center"><?= $data["f_tanggalpeminjaman"]; ?></td>
						<td class="text-center"><?= $data["f_tanggalkembali"]; ?></td>
						<td class="text-center"><?php if($data['f_tanggalkembali'] == '0000-00-00'){ echo '<div class="ms-2 btn btn-danger">Belum Kembali<div>';} else {echo '<div class="btn btn-success">Sudah Kembali<div>';}?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</main>
	<?php } else if ($_GET['cetak'] == 'pdf'){ 

		$query = "SELECT t_peminjaman.f_id AS idpeminjaman, t_peminjaman.f_tanggalpeminjaman, t_detailpeminjaman.f_tanggalkembali, t_anggota.f_nama AS namaanggota, t_anggota.f_kelas, t_anggota.f_jurusan, t_admin.f_nama AS namaadmin, t_detailbuku.f_id AS iddetailbuku, t_buku.f_judul, t_kategori.f_kategori
		FROM t_peminjaman
		LEFT JOIN t_anggota ON t_peminjaman.f_idanggota = t_anggota.f_id
		LEFT JOIN t_admin ON t_peminjaman.f_idadmin = t_admin.f_id
		LEFT JOIN t_detailpeminjaman ON t_peminjaman.f_id = t_detailpeminjaman.f_idpeminjaman
		LEFT JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku = t_detailbuku.f_id
		LEFT JOIN t_buku ON t_detailbuku.f_idbuku = t_buku.f_id
		LEFT JOIN t_kategori ON t_buku.f_idkategori = t_kategori.f_id
		WHERE t_peminjaman.f_id IS NOT NULL AND t_buku.f_judul IS NOT NULL AND t_anggota.f_nama = '$_SESSION[namaAnggota]'
		ORDER BY t_peminjaman.f_tanggalpeminjaman DESC";
		$row = $db->getALL($query);

		$no = 1;

		$mpdf->debug = true;
		$html = '<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Halaman Riwayat Peminjaman Buku</title>

		<!-- Icon -->
		<link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

		<!-- Icon -->
		<link rel="shortcut icon" href="../../assets/icon/favicon.png" type="image/x-icon">

		<!-- Link CSS -->
		<link rel="stylesheet" href="../../assets/style/style.css">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="../../assets/bootstrap-5.3.0/css/bootstrap.min.css">
		<head>
		<style>
		.warna {
			background-color: #f8d9fc;
		}

		.warna1 {
			background-color: #fbf0fc;
		}

		body {
			background-color: #fff;
			color: #000;
		}

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

		form {
			background-color: #FFFFFF;
		}

		table {
			border: none;
		}

		table tr td {
			padding: .5rem;
			color: #000;
			font-size: .8rem;

		}

		table thead tr th {
			background-color: #C5C5C5;
			color: #000;
			font-size: .8rem;
		}

		table tr:nth-child(even) {
			background-color: #F2F2F2;

		}

		table tr:nth-child(odd) {
			background-color: #E4E4E4;
		}

		h1 {
			font-size: 2.25rem;
			margin: .5rem 0 2rem 0;
			text-align:center;
			color: #000;
			font-weight: bold;
		}

		.btn {
			padding: .35rem .375rem;
			font-size: .8rem;
		}
		</style>
		</head>
		<body>
		<h1 class="text-center">Riwayat Peminjaman Buku</h1>
		<table border="0" cellpadding="10" cellspacing="0" class="mt-3">
		<thead class="w table-primary">
		<tr>
		<th class="w">No</th>
		<th class="w">Nama</th>
		<th class="w">Nama Admin</th>
		<th class="w">Judul Buku</th>
		<th class="w">Kategori</th>
		<th class="w">Kelas</th>
		<th class="w">Jurusan</th>
		<th class="w">Tanggal Pinjam</th>
		<th class="w">Tanggal Kembali</th>
		<th class="w">Status</th>
		</tr>
		</thead>
		<tbody>
		'; 
		foreach ($row as $data) :
		if($data['f_tanggalkembali'] == '0000-00-00') {
			$status = 'Belum Kembali';
		} else {
			$status = 'Sudah Kembali';
		} 
		$html .= '<tr>
		<td> '. $no++ .' </td>
		<td> ' . $data['namaanggota'] .' </td>
		<td> ' . $data['namaadmin'] .' </td>
		<td> ' . $data['f_judul'] .' </td>
		<td> ' . $data['f_kategori'] .' </td>
		<td> ' . $data['f_kelas'] .' </td>
		<td> ' . $data['f_jurusan'] .' </td>
		<td> ' . $data['f_tanggalpeminjaman']  .'</td>
		<td> ' . $data['f_tanggalkembali']  .'</td>
		<td> ' . $status .'</td>
		</tr>';

	endforeach; 

	$html .= '
	</tbody>
	</table>    
	</body>
	</html>';

	$footer = 'Riwayat Pinjam Buku | {PAGENO} | {DATE j-m-Y}';

	$mpdf->SetFooter($footer);
	$mpdf->WriteHTML($html);
	$mpdf->Output('Riwayat Pinjam Buku.pdf', 'I');
}
