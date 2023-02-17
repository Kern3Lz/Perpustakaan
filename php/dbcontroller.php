<?php 
class DBConnection {
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'prausk_sukenmfauzan';

	public $conn;

	public function __construct() {
		$this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
	}

	public function query($sql) {
		$result = mysqli_query($this->conn, $sql);

		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}

		return $rows;
	}

	public function getALL($sql)
	{
		$result = mysqli_query($this->conn, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}

		if (!empty($data)) {
			return $data;
		}
	}

	public function getITEM($sql)
	{
		$result = mysqli_query($this->conn, $sql);
		$row = mysqli_fetch_assoc($result);
		return ($row);
	}

	public function rowCOUNT($sql)
	{
		$result = mysqli_query($this->conn, $sql);
		$count = mysqli_num_rows($result);
		return $count;
	}

	public function runSQL($sql)
	{
		$result = mysqli_query($this->conn, $sql);
	}

	public function pesan($text = "")
	{
		echo $text;
	}

	public function tambahBuku($data) {
		$idkategori = htmlspecialchars($data['idkategori']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$pengarang = htmlspecialchars($data['pengarang']);
		$penerbit = htmlspecialchars($data['penerbit']);
		$deskripsi = htmlspecialchars($data['deskripsi']);

		$sql = "INSERT INTO t_buku VALUES ('', '$idkategori', '$judulBuku', '$pengarang', '$penerbit', '$deskripsi')";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function ubahBuku($data) {
		$idBuku = $data['idBuku'];
		$idkategori = htmlspecialchars($data['idkategori']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$pengarang = htmlspecialchars($data['pengarang']);
		$penerbit = htmlspecialchars($data['penerbit']);
		$deskripsi = htmlspecialchars($data['deskripsi']);
		
		$sql = "UPDATE t_buku SET 
		f_idkategori = '$idkategori',
		f_judul = '$judulBuku',
		f_pengarang = '$pengarang',
		f_penerbit = '$penerbit',
		f_deskripsi = '$deskripsi'
		WHERE f_id = $idBuku";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function hapusBuku($idBuku) {
		mysqli_query($this->conn, "DELETE FROM t_detailbuku WHERE f_id = '$idBuku'");
		mysqli_query($this->conn, "DELETE FROM t_buku WHERE f_id = '$idBuku'");

		return mysqli_affected_rows($this->conn);
	}

	public function tambahAnggota($data) {
		$namaAnggota = htmlspecialchars($data['namaAnggota']);
		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);
		$tempatLahir = htmlspecialchars($data['tempatLahir']);
		$tanggalLahir = htmlspecialchars($data['tanggalLahir']);

		$passwordhash = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO t_anggota VALUES ('', '$namaAnggota', '$username', '$passwordhash', '$tempatLahir', '$tanggalLahir')";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function ubahAnggota($data) {
		$idAnggota = $data['idAnggota'];
		$namaAnggota = htmlspecialchars($data['namaAnggota']);
		$username = htmlspecialchars($data['username']);
		$tempatLahir = htmlspecialchars($data['tempatLahir']);
		$tanggalLahir = htmlspecialchars($data['tanggalLahir']);

		$password = htmlspecialchars($data['password']);
		if ($password == $data['passwordLama']) {
			$passwordhash = $data['passwordLama'];
		} else {
			$passwordhash = password_hash($password, PASSWORD_DEFAULT);
		}

		$sql = "UPDATE t_anggota SET 
		f_nama = '$namaAnggota',
		f_username = '$username',
		f_password = '$passwordhash',
		f_tempatlahir = '$tempatLahir',
		f_tanggallahir = '$tanggalLahir'
		WHERE f_id = '$idAnggota'";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function hapusAnggota($idAnggota) {
		mysqli_query($this->conn, "DELETE FROM t_anggota WHERE f_id = '$idAnggota'");

		return mysqli_affected_rows($this->conn);
	}

	public function tambahKategori($data) {
		$kategori = htmlspecialchars($data['kategori']);

		$sql = "INSERT INTO t_kategori VALUES ('', '$kategori')";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function ubahKategori($data) {
		$idkategori = $data['idkategori'];
		$kategori = htmlspecialchars($data['kategori']);

		$sql = "UPDATE t_kategori SET 
		f_kategori = '$kategori'
		WHERE f_id = '$idkategori'";

		mysqli_query($this->conn, $sql);

		return mysqli_affected_rows($this->conn);
	}

	public function hapusKategori($idKategori) {
		mysqli_query($this->conn, "DELETE FROM t_kategori WHERE f_id = '$idKategori'");

		return mysqli_affected_rows($this->conn);
	}

	public function tambahPeminjaman($data) {
		$idAdmin = htmlspecialchars($data['idAdmin']);
		$idAnggota = htmlspecialchars($data['idAnggota']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$tanggalPinjam = htmlspecialchars($data['tanggalPinjam']);

		$sql = "INSERT INTO t_peminjaman VALUES ('', '$idAdmin', '$idAnggota', '$tanggalPinjam')";
		mysqli_query($this->conn, $sql);
		
		$idpeminjamanterakhir = $this->getITEM("SELECT f_id FROM t_peminjaman ORDER BY f_id DESC LIMIT 1");
		$idterakhir = $idpeminjamanterakhir['f_id'];
		$sql = "INSERT INTO t_detailpeminjaman VALUES('', '$idterakhir', '$judulBuku', '')";
		mysqli_query($this->conn, $sql);

		$sql = "UPDATE t_detailbuku SET f_status='tidak' WHERE f_id=$judulBuku AND f_status='tersedia'";
		$this->runSQL($sql);

		return mysqli_affected_rows($this->conn);
	}	

	public function ubahPeminjaman($data) {
		$idPeminjaman = $data['idPeminjaman'];
		$idDetailBuku = $data['idDetailBuku'];
		$idAdmin = htmlspecialchars($data['idAdmin']);
		$idAnggota = htmlspecialchars($data['idAnggota']);
		$judulBuku = htmlspecialchars($data['judulBuku']);
		$tanggalPinjam = htmlspecialchars($data['tanggalPinjam']);

		if ($idDetailBuku != $judulBuku) {
			$this->runSQL("UPDATE t_detailbuku SET f_status='tersedia' WHERE f_id=$idDetailBuku AND f_status='tidak'");
		}

		$this->runSQL("UPDATE t_peminjaman
			SET f_idadmin = '$idAdmin', f_idanggota = '$idAnggota', f_tanggalpeminjaman= '$tanggalPinjam'
			WHERE f_id = $idPeminjaman");

		$this->runSQL("UPDATE t_detailpeminjaman 
			SET f_iddetailbuku = $judulBuku
			WHERE f_idpeminjaman = $idPeminjaman");

		$peminjamanBaru = $this->getItem("SELECT f_iddetailbuku, f_idanggota, f_idadmin, f_tanggalpeminjaman, t_peminjaman.f_id
			FROM t_peminjaman
			INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id = t_detailpeminjaman.f_idpeminjaman
			WHERE t_peminjaman.f_id = $idPeminjaman");

		$statusBuku = $this->getITEM("SELECT f_status FROM t_detailbuku WHERE f_id = $judulBuku");

		if($statusBuku['f_status'] == 'tersedia') {
			$idDetailBukuBaru = $peminjamanBaru['f_iddetailbuku'];
			$this->runSQL("UPDATE t_detailbuku 
				SET f_status='tidak' 
				WHERE f_id = $idDetailBukuBaru");
		}

		return mysqli_affected_rows($this->conn);
	}

	public function hapusPengembalian($idPengembalian) {
		mysqli_query($this->conn, "DELETE FROM t_detailpeminjaman WHERE f_id = '$idPengembalian'");

		return mysqli_affected_rows($this->conn);
	}	
//==================== AKHIR CRUD ======================//

	public function cariAnggota($keyword) {
		$query = "SELECT * FROM t_anggota
		WHERE
		f_nama LIKE '%$keyword%' OR
		f_username LIKE '%$keyword%' OR
		f_password LIKE '%$keyword' OR
		f_tempatlahir LIKE '%$keyword%' OR
		f_tanggallahir LIKE '%$keyword%'
		";
		return $this->query($query);
	}

	public function cariBuku($keyword) {
		$query = "SELECT t_buku.*, t_buku.f_id as idbuku, t_kategori.* FROM t_buku, t_kategori
		WHERE t_buku.f_idkategori = t_kategori.f_id AND
		(
			f_kategori LIKE '%$keyword%' OR
			f_judul LIKE '%$keyword%' OR
			f_pengarang LIKE '%$keyword%' OR
			f_penerbit LIKE '%$keyword%' OR
			f_deskripsi LIKE '%$keyword%'
			)
		";
		return $this->conn->query($query);
	}

	public function cariKategori($keyword) {

		$query = "SELECT * FROM t_kategori WHERE
		f_kategori LIKE '%$keyword%'
		";
		return $this->query($query);
	}

	public function cariPeminjaman($keyword) {

		$query = "SELECT t_anggota.f_nama AS f_namaanggota, t_kategori.f_kategori,t_peminjaman.f_id, t_peminjaman.f_tanggalpeminjaman, t_buku.f_judul, t_admin.f_nama AS f_namaadmin, t_detailbuku.f_id as f_iddetb
		FROM t_peminjaman
		INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
		INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
		INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
		INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
		INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id
		INNER JOIN t_kategori ON t_buku.f_idkategori = t_kategori.f_id
		WHERE t_anggota.f_nama LIKE '%$keyword%' OR t_kategori.f_kategori LIKE '%$keyword%' OR t_peminjaman.f_id LIKE '%$keyword%' OR t_peminjaman.f_tanggalpeminjaman LIKE '%$keyword%' OR t_buku.f_judul LIKE '%$keyword%' OR t_admin.f_nama LIKE '%$keyword%' OR t_detailbuku.f_id LIKE '%$keyword%'
		ORDER BY t_peminjaman.f_id DESC
		";
		return $this->query($query);
	}

	public function cariPengembalian($keyword) {
		if ($keyword == str_contains($keyword, 'Belum Kembali')) {
			$keyword = '0000-00-00';
			$query = "SELECT t_anggota.f_nama AS namaanggota, t_peminjaman.f_id, t_detailpeminjaman.f_tanggalkembali, t_buku.f_judul, t_admin.f_nama AS namaadmin,t_detailpeminjaman.f_id as idpengembalian, t_detailbuku.f_id as iddetailbuku
			FROM t_peminjaman
			INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
			INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
			INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
			INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
			INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id 
			WHERE t_detailpeminjaman.f_tanggalkembali IS NOT NULL AND (t_anggota.f_nama LIKE '%$keyword%' OR t_peminjaman.f_id LIKE '%$keyword%' OR t_detailpeminjaman.f_tanggalkembali LIKE '%$keyword%' OR t_buku.f_judul LIKE '%$keyword%' OR t_admin.f_nama LIKE '%$keyword%' OR t_detailpeminjaman.f_id LIKE '%$keyword%' OR t_detailbuku.f_id LIKE '%$keyword%')
			ORDER BY t_peminjaman.f_tanggalpeminjaman DESC";
			return $this->getALL($query);
		}	else {	
			$query = "SELECT t_anggota.f_nama AS namaanggota, t_peminjaman.f_id, t_detailpeminjaman.f_tanggalkembali, t_buku.f_judul, t_admin.f_nama AS namaadmin,t_detailpeminjaman.f_id as idpengembalian, t_detailbuku.f_id as iddetailbuku
			FROM t_peminjaman
			INNER JOIN t_admin ON t_peminjaman.f_idadmin=t_admin.f_id
			INNER JOIN t_anggota ON t_peminjaman.f_idanggota=t_anggota.f_id
			INNER JOIN t_detailpeminjaman ON t_peminjaman.f_id=t_detailpeminjaman.f_idpeminjaman
			INNER JOIN t_detailbuku ON t_detailpeminjaman.f_iddetailbuku=t_detailbuku.f_id
			INNER JOIN t_buku ON t_detailbuku.f_idbuku=t_buku.f_id 
			WHERE t_detailpeminjaman.f_tanggalkembali IS NOT NULL AND (t_anggota.f_nama LIKE '%$keyword%' OR t_peminjaman.f_id  LIKE '%$keyword%' OR t_detailpeminjaman.f_tanggalkembali LIKE '%$keyword%' OR t_buku.f_judul  LIKE '%$keyword%' OR t_admin.f_nama LIKE '%$keyword%' OR t_detailpeminjaman.f_id  LIKE '%$keyword%' OR t_detailbuku.f_id  LIKE '%$keyword%')
			ORDER BY t_peminjaman.f_tanggalpeminjaman DESC";
			return $this->getALL($query);
		}
	}


	public function cek_login() {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$result = mysqli_query($this->conn, "SELECT * FROM t_admin WHERE f_username = '$username'");

		$cek = mysqli_num_rows($result);
		
		$data = mysqli_fetch_assoc($result);
		if($data['f_status'] == 'Aktif') {
			if($cek == 1) {
				$_SESSION['login'] = true;
				$_SESSION['username'] = $data['f_username'];
				$_SESSION['status'] = $data['f_status'];
				if ($data['f_level'] == 'Admin') {
					$_SESSION['level'] = 'Admin';
				} elseif ($data['f_level'] == 'Pustakawan') {
					$_SESSION['level'] = 'Pustakawan';
				}
				header("Location: ../home/index.php");
			} else {
				header("Location: login.php?login=gagal");
			}
		} elseif ($data['f_status'] == 'Tidak Aktif') {
			$_SESSION['status'] = 'Tidak Aktif';
			header("Location: login.php?status=tidak_aktif");
		}
	}

	public function cek_login_anggota() {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$result = mysqli_query($this->conn, "SELECT * FROM t_anggota WHERE f_username = '$username'");

		$cek = mysqli_num_rows($result);

		if($cek === 1) {
			$data = mysqli_fetch_assoc($result);

			$_SESSION['login'] = true;
			$_SESSION['username'] = $data['f_username'];
			$_SESSION['namaAnggota'] = $data['f_nama'];
			$_SESSION['level'] = 'Anggota Perpustakaan';
			$_SESSION['status'] = 'Aktif';
			header("Location: ../home/index.php");
		} else {
			header("Location: login.php?login=gagal");
		}
	}

	public function registrasiAdmin($data)
	{
		$namaAdmin = htmlspecialchars($data['namaAdmin']);
		$username = htmlspecialchars($data['username']);
		$password = htmlspecialchars($data['password']);
		$level = htmlspecialchars($data['level']);
		$status = htmlspecialchars($data['status']);

    // Check if username already exists
		$result = mysqli_query(
			$this->conn,
			"SELECT f_username FROM t_admin WHERE f_username = '$username'"
		);

		if (mysqli_fetch_assoc($result)) {
			echo "<script>
			alert('Username sudah terdaftar!');
			</script>";
			return false;
		}

    // Encrypt password
		$passwordhash = password_hash($password, PASSWORD_DEFAULT);

    // Add new user to the database
		$query = "INSERT INTO t_admin (f_nama, f_username, f_password, f_level, f_status)
		VALUES ('$namaAdmin', '$username', '$passwordhash', '$level', '$status')";
		mysqli_query($this->conn, $query);


		return mysqli_affected_rows($this->conn);
	}
}
?>