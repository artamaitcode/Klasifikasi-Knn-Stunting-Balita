<?php 
include '../assets/conn/config.php';
$kode_hasil=$_GET['kode_hasil'];
mysql_query("delete from tbl_hasil where kode_hasil='$kode_hasil'");
header("location:hasil.php");

?>