<?php
session_start();
error_reporting(0);
include '../assets/conn/cek.php';
include '../assets/conn/config.php';

$username = $_SESSION['username'];
$username_safe = mysql_real_escape_string($username);

$det = mysql_query("SELECT * FROM tbl_akun WHERE username='$username_safe'") or die(mysql_error());
$d = mysql_fetch_array($det);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM KLASIFIKASI METODE KNN</title>

    <link href="../assets/css/cosmo.min.css" rel="stylesheet">
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/modern-admin.css">

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
</head>

<body>

    <nav class="navbar modern-topbar navbar-fixed-top">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed modern-toggle" data-toggle="collapse"
                    data-target="#modernNavbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand modern-navbar-brand" href="index.php">
                    <span class="brand-icon">
                        <span class="glyphicon glyphicon-stats"></span>
                    </span>
                    <span class="brand-text">KNN Stunting</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="modernNavbar">

                <ul class="nav navbar-nav navbar-left modern-navbar-info">
                    <li>
                        <a href="javascript:void(0)">
                            <span class="glyphicon glyphicon-dashboard"></span>
                            Sistem Klasifikasi Metode KNN
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right modern-user-menu">
                    <li class="modern-welcome">
                        <a href="javascript:void(0)">
                            <span class="welcome-text">Selamat datang,</span>
                            <strong><?php echo $username; ?></strong>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle modern-profile-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="modern-avatar">
                                <?php echo strtoupper(substr($username, 0, 1)); ?>
                            </span>
                            <span class="hidden-sm hidden-xs"><?php echo $username; ?></span>
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu modern-dropdown">
                            <li class="dropdown-header">
                                <div class="dropdown-user">
                                    <div class="dropdown-avatar">
                                        <?php echo strtoupper(substr($username, 0, 1)); ?>
                                    </div>
                                    <div>
                                        <strong><?php echo $username; ?></strong>
                                        <small>Administrator</small>
                                    </div>
                                </div>
                            </li>

                            <li role="separator" class="divider"></li>

                            <li>
                                <a href="akun.php">
                                    <span class="glyphicon glyphicon-user"></span>
                                    Akun Saya
                                </a>
                            </li>

                            <li>
                                <a href="logout.php" onclick="return confirm('Apakah anda yakin ingin logout?')">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>