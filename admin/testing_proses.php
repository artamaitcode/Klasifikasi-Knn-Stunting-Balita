<?php
include '../assets/conn/config.php';
if (isset($_GET['proses'])) {
	if ($_GET['proses']=="prosestambah") {
		$kode_nama=$_POST['kode_nama'];
		$nama=$_POST['nama'];

		$hasil = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
		while ($baris = mysql_fetch_array($hasil)) {
			$idK = $baris['kode_kriteria'];
			$idS = $_POST[$idK];

			$query1 = "INSERT INTO tbl_testing(kode_nama,nama, kode_kriteria, nilai_testing) 
			VALUES ('".$kode_nama."','".$nama."','".$idK."','".$idS."')";
			$result1 = mysql_query($query1);
		}
		header("location:testing.php");

	}elseif ($_GET['proses']=="prosesubah") {
		$kode_nama=$_POST['kode_nama'];
		$nama=$_POST['nama'];

		$query2 = "DELETE FROM tbl_testing WHERE kode_nama='".$_POST['kode_nama']."'";
		$result2 = mysql_query($query2);

		$hasil = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
		while ($baris = mysql_fetch_array($hasil)) {
			$idK = $baris['kode_kriteria'];
			$idS = $_POST[$idK];

			$query1 = "INSERT INTO tbl_testing(kode_nama,nama, kode_kriteria, nilai_testing) 
			VALUES ('".$kode_nama."','".$nama."','".$idK."','".$idS."')";
			$result1 = mysql_query($query1);
		}
		header("location:testing.php");

	}elseif ($_GET['proses']=="proseshapus") {
		$kode_nama=$_GET['kode_nama'];
		mysql_query("delete from tbl_testing where kode_nama='$kode_nama'");
		header("location:testing.php");

	}elseif ($_GET['proses']=="prosescari") {
		$cari=$_POST['cari'];
		header("location:testing.php?cari=$cari");
	}
}

?>