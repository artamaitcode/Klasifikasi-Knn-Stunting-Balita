<?php
include '../assets/conn/config.php';
if (isset($_GET['proses'])) {
	if ($_GET['proses']=="prosestambah") {
		$kode_nama=$_POST['kode_nama'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];
		
		mysql_query("insert into tbl_namatraining(kode_nama,nama,alamat,keputusan,distance,ranking,pilihan) values('$kode_nama','$nama','$alamat','?','0','0','?')");
		header("location:training.php");

	}elseif ($_GET['proses']=="prosesubah") {
		$kode_nama=$_POST['kode_nama'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];

		mysql_query("update tbl_namatraining set nama='$nama', alamat='$alamat' where kode_nama='$kode_nama'");
		header("location:training.php");

	}elseif ($_GET['proses']=="proseshapus") {
		$kode_nama=$_GET['kode_nama'];
		mysql_query("delete from tbl_namatraining where kode_nama='$kode_nama'");
		mysql_query("delete from tbl_training where kode_mekanik='$kode_training'");
		header("location:training.php");

	}elseif ($_GET['proses']=="prosescari") {
		$cari=$_POST['cari'];
		header("location:training.php?cari=$cari");
	}
}

?>