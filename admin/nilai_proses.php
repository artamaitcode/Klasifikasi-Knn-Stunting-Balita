<?php
include '../assets/conn/config.php';
if (isset($_GET['proses'])) {
	if ($_GET['proses']=="prosestambah") {
		$kode_nama=$_POST['kode_nama'];
		$keputusan=$_POST['keputusan'];

		$hasil = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
		while ($baris = mysql_fetch_array($hasil)) {
			$idK = $baris['kode_kriteria'];
			$idS = $_POST[$idK];

			$query1 = "INSERT INTO tbl_training(kode_nama, kode_kriteria, nilai_training) 
			VALUES ('".$kode_nama."','".$idK."','".$idS."')";
			$result1 = mysql_query($query1);
		}

		mysql_query("UPDATE tbl_namatraining set keputusan='".$keputusan."' WHERE kode_nama='".$kode_nama."'");
		header("location:nilai.php?kode_nama=$_POST[kode_nama]");

	}elseif ($_GET['proses']=="prosesubah") {
		$kode_nama=$_POST['kode_nama'];
		$keputusan=$_POST['keputusan'];
		$query2 = "DELETE FROM tbl_training WHERE kode_nama='".$_POST['kode_nama']."'";
		$result2 = mysql_query($query2);

		$hasil = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
		while ($baris = mysql_fetch_array($hasil)) {
			$idK = $baris['kode_kriteria'];
			$idS = $_POST[$idK];

			$query1 = "INSERT INTO tbl_training(kode_nama, kode_kriteria, nilai_training) 
			VALUES ('".$kode_nama."','".$idK."','".$idS."')";
			$result1 = mysql_query($query1);
		}

		mysql_query("UPDATE tbl_namatraining set keputusan='".$keputusan."' WHERE kode_nama='".$kode_nama."'");
		header("location:nilai.php?kode_nama=$_POST[kode_nama]");

	}elseif ($_GET['proses']=="proseshapus") {
		$kode_nama=$_GET['kode_nama'];
		mysql_query("delete from tbl_training where kode_nama='$kode_nama'");
		header("location:nilai.php?kode_nama=$_GET[kode_nama]");

	}elseif ($_GET['proses']=="prosescari") {
		$cari=$_POST['cari'];
		header("location:nilai.php?cari=$cari");
	}
}

?>