<?php 
session_start();
include 'assets/conn/config.php';
$username=$_POST['username'];
$password=$_POST['password'];

$query=mysql_query("select * from tbl_akun where username='$username' and password='$password'")or die(mysql_error());
if(mysql_num_rows($query) == 1){
	$_SESSION['username'] = $username;
	header("location:admin/index.php");
}else{
	header("location:index.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}
// echo $pas;
 ?>