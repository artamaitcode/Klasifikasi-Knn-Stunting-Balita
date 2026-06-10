<?php
include '../assets/conn/config.php';

if (isset($_GET['proses'])) {

    if ($_GET['proses'] == "prosestambah") {

        $kode_kriteria = mysql_real_escape_string($_POST['kode_kriteria']);
        $nama_kriteria = mysql_real_escape_string($_POST['nama_kriteria']);
        $keterangan    = mysql_real_escape_string($_POST['keterangan']);

        mysql_query("INSERT INTO tbl_kriteria(kode_kriteria, nama_kriteria, keterangan) 
            VALUES('$kode_kriteria', '$nama_kriteria', '$keterangan')") or die(mysql_error());

        header("location:kriteria.php");
        exit;

    } elseif ($_GET['proses'] == "prosesubah") {

        $kode_kriteria = mysql_real_escape_string($_POST['kode_kriteria']);
        $nama_kriteria = mysql_real_escape_string($_POST['nama_kriteria']);
        $keterangan    = mysql_real_escape_string($_POST['keterangan']);

        mysql_query("UPDATE tbl_kriteria SET 
            nama_kriteria='$nama_kriteria',
            keterangan='$keterangan'
            WHERE kode_kriteria='$kode_kriteria'") or die(mysql_error());

        header("location:kriteria.php");
        exit;

    } elseif ($_GET['proses'] == "proseshapus") {

        $kode_kriteria = mysql_real_escape_string($_GET['kode_kriteria']);

        mysql_query("DELETE FROM tbl_subkriteria WHERE kode_kriteria='$kode_kriteria'") or die(mysql_error());
        mysql_query("DELETE FROM tbl_kriteria WHERE kode_kriteria='$kode_kriteria'") or die(mysql_error());

        header("location:kriteria.php");
        exit;

    } elseif ($_GET['proses'] == "prosescari") {

        $cari = $_POST['cari'];
        header("location:kriteria.php?cari=" . urlencode($cari));
        exit;
    }
}
?>