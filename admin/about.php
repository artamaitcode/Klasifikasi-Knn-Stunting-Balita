<?php
include 'header.php';  
 
?>

<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
body {
    background-size: cover;
    background-position: ;
    background-image: url(assets/img/bg.jpg);
    background-repeat: no-repeat;
}
</style>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <p><a href="index.php"><button type="button" class="btn btn-primary btn-block">BERANDA</button></a>
            </p>
            <p><a href="training.php"><button type="button" class="btn btn-primary btn-block">DATA
                        TRAINING</button></a>
            </p>
            <p><a href="testing.php"><button type="button" class="btn btn-primary btn-block">DATA TESTING</button></a>
            </p>
            <p><a href="metode.php"><button type="button" class="btn btn-primary btn-block">METODE</button></a></p>
            <p><a href="hasil.php"><button type="button" class="btn btn-primary btn-block">HASIL ANALISA</button></a>
            <p><a href="about.php"><button type="button" class="btn btn-primary btn-block active">ABOUT</button></a>
            </p>
        </div>

        <div class="col-sm-8 text-left">
            <div class="container">
                <div class="row content">
                    <ul class="breadcrumb">
                        <h4>ABOUT</h4>
                    </ul>
                </div>

                <div clsss="panel panel-container">
                    <center>
                        <h2><b>Pembuat Aplikasi ini</b></h2>
                        <br>
                        <hr>
                        <br>
                        <h3>Nama : </h3>
                        <h3>Nim : </h3>
                        <h3>Prodi : Teknik Informatika</h3>
                    </center>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $("#myBtn").click(function() {
            $("#myModal").modal();
        });
    });
    </script>