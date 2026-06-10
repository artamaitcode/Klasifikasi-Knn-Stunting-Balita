<?php
include "fix_mysql.inc.php";
$host = getenv('DB_HOST') ?: "localhost";
$user = getenv('DB_USER') ?: "root";
$pass = getenv('DB_PASSWORD') ?: "";
$db = getenv('DB_NAME') ?: "knnklasifikasi_stunting";

$conn = mysql_connect($host, $user, $pass) or die("Tidak terkoneksi ke server!");
if ($conn) {
	$dbselect = mysql_select_db($db, $conn) or die("Tidak terhubung ke Database.");
}

include "fungsi_flash.php";