<?php
session_start();
error_reporting(0);
include '../assets/conn/cek.php';
include '../assets/conn/config.php';
?>

<head>
    <title>SISTEM KLASIFIKASI METODE KNN</title>
    <link href="../assets/css/cosmo.min.css" rel="stylesheet">
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-left">
                <li><a class="nav navbar-end">Selamat datang <?php echo $_SESSION['username'];?></a>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
					$username=$_SESSION['username'];
					$det=mysql_query("select * from tbl_akun where username='$username'")or die(mysql_error());
					$d=mysql_fetch_array($det);
					?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <font color="black"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span>
                        </font>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="akun.php">Akun</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
    </nav