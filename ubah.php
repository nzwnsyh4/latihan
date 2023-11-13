<?php 
require 'functions.php';
//langkah 11 ubah bagian input gambar

//koneksi ke DBMS

//ambil data di URL
$id = $_GET["id"];

//query data dataku berdasarkan id
$datanazwa = query("SELECT * FROM datanazwa WHERE id = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if ( isset($_POST["submit"])) {
	
	//cek apakah data berhasil ditambahkan atau tidak
	if(ubah($_POST) > 0 ){
		echo "
		<script>
		alert('Data Berhasil Diubah!');
		document.location.href = 'index.php';
		</script>
		";
	}else {
		echo "
		<script>
		alert('Data Gagal Diubah!');
		document.location.href = 'index.php';
		</script>
		";
	}
}
?>


<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color:#E3afbc;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color:	#9a1750;
}

<style type="text/css">
.form-style-3{
	max-width: 450px;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-3 label{
	display:block;
	margin-bottom: 10px;
}
.form-style-3 label > span{
	float: left;
	width: 100px;
	color: #F072A9;
	font-weight: bold;
	font-size: 13px;
	text-shadow: 1px 1px 1px #fff;
}
.form-style-3 fieldset{
	border-radius: 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	margin: 0px 0px 10px 0px;
	border: 1px solid #FFD2D2;
	padding: 20px;
	background: #FFF4F4;
	box-shadow: inset 0px 0px 15px #FFE5E5;
	-moz-box-shadow: inset 0px 0px 15px #FFE5E5;
	-webkit-box-shadow: inset 0px 0px 15px #FFE5E5;
}
.form-style-3 fieldset legend{
	color: #FFA0C9;
	border-top: 1px solid #FFD2D2;
	border-left: 1px solid #FFD2D2;
	border-right: 1px solid #FFD2D2;
	border-radius: 5px 5px 0px 0px;
	-webkit-border-radius: 5px 5px 0px 0px;
	-moz-border-radius: 5px 5px 0px 0px;
	background: #FFF4F4;
	padding: 0px 8px 3px 8px;
	box-shadow: -0px -1px 2px #F1F1F1;
	-moz-box-shadow:-0px -1px 2px #F1F1F1;
	-webkit-box-shadow:-0px -1px 2px #F1F1F1;
	font-weight: normal;
	font-size: 12px;
}
.form-style-3 textarea{
	width:250px;
	height:100px;
}
.form-style-3 input[type=text],
.form-style-3 input[type=date],
.form-style-3 input[type=datetime],
.form-style-3 input[type=number],
.form-style-3 input[type=search],
.form-style-3 input[type=time],
.form-style-3 input[type=url],
.form-style-3 input[type=email],
.form-style-3 select, 
.form-style-3 textarea{
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border: 1px solid #FFC2DC;
	outline: none;
	color: #F072A9;
	padding: 5px 8px 5px 8px;
	box-shadow: inset 1px 1px 4px #FFD5E7;
	-moz-box-shadow: inset 1px 1px 4px #FFD5E7;
	-webkit-box-shadow: inset 1px 1px 4px #FFD5E7;
	background: #FFEFF6;
	width:50%;
}
.form-style-3  input[type=submit],
.form-style-3  input[type=button]{
	background: #EB3B88;
	border: 1px solid #C94A81;
	padding: 5px 15px 5px 15px;
	color: #FFCBE2;
	box-shadow: inset -1px -1px 3px #FF62A7;
	-moz-box-shadow: inset -1px -1px 3px #FF62A7;
	-webkit-box-shadow: inset -1px -1px 3px #FF62A7;
	border-radius: 3px;
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;	
	font-weight: bold;
}
.required{
	color:red;
	font-weight:normal;
}

</style>
</head>

<body >
<ul>
    <li><a href="#">UBAH DATA</a></li>
    <li><a href="index.php">Home</a></li>
  </ul>

<br>
<div class="form-style-3">
<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $datanazwa["id"]; ?>">
	<input type="hidden" name="gambarLama" value="<?= $sis["gambar"]; ?>">
<fieldset><legend>Data</legend>
<label for="no_absen"><span>No Absen <span class="required">*</span></span><input type="text" class="input-field" id="no_absen" name="no_absen" value="<?= $datanazwa["no_absen"]; ?>" /></label><br>
<label for="nama"><span>Nama <span class="required">*</span></span><input type="text" class="input-field" id="nama" name="nama" value="<?= $datanazwa["nama"]; ?>" /></label><br>
<label for="kelas"><span>Kelas <span class="required">*</span></span><input type="text" class="input-field" id="kelas" name="kelas" value="<?= $datanazwa["kelas"]; ?>" /></label><br>
<label for="alamat"><span>Alamat <span class="required">*</span></span><input type="text" class="input-field" id="alamat" name="alamat" value="<?= $datanazwa["alamat"]; ?>" /></label><br>
<label for="hobi"><span>Hobi <span class="required">*</span></span><input type="text" class="input-field"  id="hobi" name="hobi" value="<?= $datanazwa["hobi"]; ?>" /></label><br>
<label for="gambar"><span>Gambar <span class="required">*</span></span>    <img src="gambar/<?= $datanazwa['gambar']; ?>" width="40"> 
<input type="file" class="input-field"  id="gambar" name="gambar" value="" /></label>
<label><span> </span><input type="submit" name="submit"/></label>
</fieldset>

</body>
</html>