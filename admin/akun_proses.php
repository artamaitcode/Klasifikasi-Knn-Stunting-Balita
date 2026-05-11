<?php 
include '../assets/conn/config.php';
$kode_akun=$_POST['kode_akun'];
$nama_lengkap=$_POST['nama_lengkap'];
$username=$_POST['username'];
$password=$_POST['password'];

mysql_query("update tbl_akun set nama_lengkap='$nama_lengkap', username='$username', password='$password' where kode_akun='$kode_akun'");
header("location:index.php");

?>