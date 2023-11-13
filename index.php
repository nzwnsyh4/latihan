<?php
require 'functions.php';
$datanazwa = query("SELECT * FROM datanazwa");
if (isset($_POST["cari"])) {
	$datanazwa = cari($_POST["keyword"]);
}

?>

<html>
<head>
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

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #E3afbc;
  color: white;
}

.button {
  background-color: #9a1750; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 2px solid #04AA6D;
}

.button1:hover {
  background-color: #04AA6D;
  color: white;
}

.button-3 {
  margin-top: 5px;
  appearance: none;
  background-color: #E3afbc;
  border: 1px solid rgba(27, 31, 35, .15);
  border-radius: 6px;
  box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
  padding: 6px 16px;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  white-space: nowrap;
}

.button-3:focus:not(:focus-visible):not(.focus-visible) {
  box-shadow: none;
  outline: none;
}

.button-3:hover {
  background-color: #9a1750;
}

.button-3:focus {
  box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
  outline: none;
}

.button-3:disabled {
  background-color: #9a1750;
  border-color: rgba(27, 31, 35, .1);
  color: rgba(255, 255, 255, .8);
  cursor: default;
}

.button-3:active {
  background-color: #9a1750;
  box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
}

	</style>
</head>

<body >
<ul>
    <li><a href="#">DATA DIRI</a></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="tambah.php">Add Data</a></li>
    <li><a href="log.php">Logout</a></li>
  </ul><br>

  <center><form action=""  method="post" >
	<input type="text" name="keyword" size="40" autofocus placeholder="Masukkan keyword pencarian..." autocomplete="off">
	<button type="submit" name="cari">Cari</button>
</form></center>

<center><div class="container">
<table id="data">
  <tr>
  <th>No.</th>
<th>Aksi</th>
<th>Gambar</th>
<th>No Absen</th>
<th>Nama</th>
<th>Kelas</th>
<th>Alamat</th>
<th>Hobi</th>
  </tr>


<?php $i =1; ?>
<?php foreach ($datanazwa as $row) : ?>
<tr>
    <td><?= $i; ?></td>

    <td>
	<button class="button-3" type="submit" ><a style="text-decoration:none" href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a></button><br>
	<button class="button-3"><a style="text-decoration:none" href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('YAKIN?');">Hapus</a></button>
</td>

<center><td><img src="gambar/<?= $row["gambar"]; ?>" width="100"></td>
<td><?= $row["no_absen"]; ?></td>
<td><?= $row["nama"]; ?></td>
<td><?= $row["kelas"]; ?></td>
<td><?= $row["alamat"]; ?></td>
<td><?= $row["hobi"]; ?></td><br>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table></center>
<br>
</body>
</html>

