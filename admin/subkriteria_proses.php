<?php
include '../assets/conn/config.php';

if (isset($_GET['proses'])) {

    if ($_GET['proses'] == "prosestambah") {

        $kode_subkriteria  = mysql_real_escape_string($_POST['kode_subkriteria']);
        $nama_subkriteria  = mysql_real_escape_string($_POST['nama_subkriteria']);
        $kode_kriteria     = mysql_real_escape_string($_POST['kode_kriteria']);
        $nilai_subkriteria = mysql_real_escape_string($_POST['nilai_subkriteria']);

        mysql_query("INSERT INTO tbl_subkriteria(kode_subkriteria, nama_subkriteria, kode_kriteria, nilai_subkriteria) 
            VALUES('$kode_subkriteria', '$nama_subkriteria', '$kode_kriteria', '$nilai_subkriteria')") or die(mysql_error());

        header("location:subkriteria.php");
        exit;

    } elseif ($_GET['proses'] == "prosesubah") {

        $kode_subkriteria  = mysql_real_escape_string($_POST['kode_subkriteria']);
        $nama_subkriteria  = mysql_real_escape_string($_POST['nama_subkriteria']);
        $kode_kriteria     = mysql_real_escape_string($_POST['kode_kriteria']);
        $nilai_subkriteria = mysql_real_escape_string($_POST['nilai_subkriteria']);

        mysql_query("UPDATE tbl_subkriteria SET 
            nama_subkriteria='$nama_subkriteria',
            kode_kriteria='$kode_kriteria',
            nilai_subkriteria='$nilai_subkriteria'
            WHERE kode_subkriteria='$kode_subkriteria'") or die(mysql_error());

        header("location:subkriteria.php");
        exit;

    } elseif ($_GET['proses'] == "proseshapus") {

        $kode_subkriteria = mysql_real_escape_string($_GET['kode_subkriteria']);

        mysql_query("DELETE FROM tbl_subkriteria WHERE kode_subkriteria='$kode_subkriteria'") or die(mysql_error());

        header("location:subkriteria.php");
        exit;

    } elseif ($_GET['proses'] == "prosescari") {

        $cari = $_POST['cari'];
        header("location:subkriteria.php?cari=" . urlencode($cari));
        exit;
    }
}
?>