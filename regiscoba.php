<?php
require  'functions.php';

if(isset($_POST["register"])){
	if(registrasi($_POST) > 0){
		echo "<script>
		alert('user baru berhasil ditambahkan!');
		</script>";
	}else{
		echo mysqli_error($conn);
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="coba.css">

	<title>Halaman Registrasi</title>
	<style>
		label{
			display: block;
		}
	</style>
</head>
<body>
<center>
<h1>Halaman Registrasi</h1>

<form class="kotak_regis" action="" method="post">
	<ul>
		
		<label for="username">Username :</label>
		<input type="text" name="username" class="form_regis" id="username">
		<br><br>
		
		<label for="password">Password :</label>
		<input type="password" name="password" class="form_regis" id="password">
		<br><br>
		
		<label for="password2">Konfirmasi Password :</label>
		<input type="password" name="password2" class="form_regis" id="password2">
		<br><br>
		
		<button type="submit" class="tombol_regis" name="register">
			Register!
		</button>
		
	</ul>



</form>
<br><a href=log.php> Kembali ke Halaman Login</a></center>

    </center>
</body>
</html>