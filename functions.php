<?php

$conn = mysqli_connect("localhost","root","","latihannazwa");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;

    }
    return $rows;
}

function tambah($datanazwa){
	//ambil data dari tiap elemen dalam form
	global $conn;
	
	$no_absen = htmlspecialchars($datanazwa["no_absen"]);
	$nama = htmlspecialchars($datanazwa["nama"]);
	$kelas = htmlspecialchars($datanazwa["kelas"]);
    $alamat = htmlspecialchars($datanazwa["alamat"]);
    $hobi = htmlspecialchars($datanazwa["hobi"]);
	$gambar = htmlspecialchars($datanazwa["gambar"]);

	$gambar = upload();
	if(!$gambar){
		return false;
	}

	//query insert data
	$query = "INSERT INTO datanazwa
		VALUES
        ('', '$no_absen', '$nama', '$kelas', '$alamat', '$hobi','$gambar')
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
	function hapus($id){
		global $conn;
		mysqli_query($conn, "DELETE FROM datanazwa WHERE id = $id");
		return mysqli_affected_rows($conn);
	}
	function ubah($datanazwa){
		global $conn;
		$id=$datanazwa["id"];
		$no_absen = htmlspecialchars($datanazwa["no_absen"]);
		$nama = htmlspecialchars($datanazwa["nama"]);
		$kelas = htmlspecialchars($datanazwa["kelas"]);
		$alamat = htmlspecialchars($datanazwa["alamat"]);
		$hobi = htmlspecialchars($datanazwa["hobi"]);
		//langkah 11 adalah ubah code ini
	//$gambar = htmlspecialchars($data["gambar"]);
	$gambarLama = htmlspecialchars($datanazwa["gambarLama"]);

	//langkah 12 cek apakah user pilih gambarbaru/tidak
	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	}else{
		$gambar = upload();
	}
	
		//query insert data
		$query = "UPDATE datanazwa SET
			no_absen = '$no_absen',
			nama = '$nama',
			kelas = '$kelas',
			alamat = '$alamat',
			hobi = '$hobi',
			gambar = '$gambar'
			WHERE id = $id
		";
		mysqli_query($conn, $query);
	
		return mysqli_affected_rows($conn);
	}
	function cari($keyword){
		$query = "SELECT * FROM datanazwa
		WHERE
		no_absen LIKE '%$keyword%' OR 
		nama LIKE '%$keyword%' OR
		alamat LIKE '%$keyword%' OR
		kelas LIKE '%$keyword%' OR
		hobi LIKE '%$keyword%' 
		"; 
		return query($query);
	}

	function registrasi($datanazwa){
		global $conn;
	
		$username =  strtolower(stripcslashes($datanazwa["username"]));
		$password = mysqli_real_escape_string($conn, $datanazwa["password"]);
		$password2 = mysqli_real_escape_string($conn, $datanazwa["password2"]);
	
	//LANGKAH KE 2 setelah bisa tambah ke database. cek username sudah ada atau belum
		$result = mysqli_query($conn,"SELECT username FROM usernazwa WHERE username = '$username'");
		if(mysqli_fetch_assoc($result)) {
			echo "<script>
			alert('username sudah terdaftar!')
			</script>";
			return false;
		}
	
	
		//cek konfirmasi password
		if($password !== $password2){
			echo "<script>
			alert  ('konfirmasi password tidak sesuai!');
			</script>";
			return false;
		}
		//enkripsi dulu passwordnya pakai hash
		$password = password_hash($password, PASSWORD_DEFAULT);
	
		//tambahkan user baru kedatabase
		mysqli_query($conn, "INSERT INTO usernazwa VALUES('', '$username', '$password')");
		return mysqli_affected_rows($conn);
	
	}

	function upload(){

		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];
	
		//langkah ke 5 cek apakah tdk ada gambar yang di upload dan kasih pesan kesalahan
		if($error === 4){
			echo "<script>
			alert('Silahkan pilih gambar dulu!');
			</script>";
			return false;
		}
	
		//langkah 6 cek yangdiupload pasti adalah gambar
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.',$namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo "<script>
			alert('Yang Anda upload bukan gambar!');
			</script>";
			return false;
		}
	
		//langkah 7 cek jika ukuran gambar terlalu besar
		if($ukuranFile > 1000000){
			echo "<script>
			alert('Ukuran file yang Anda upload terlalu besar!');
			</script>";
			return false;
		}
		//langkah 9 generate nama file baru agar tidak merubah file orang lain yang sudah ada dalam data/folder
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiGambar;
	
		//langkah 8 jika lolos 3 pengecekan di atas, tinggal pindahkan data tsb
		//langkah 10 ubah code ini menjadi move_uploaded_file($tmpName, 'gambar/' . $namaFile);
		move_uploaded_file($tmpName, 'gambar/' . $namaFileBaru);
		return $namaFileBaru;
	
	
	}
	
?>