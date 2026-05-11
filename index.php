<head>
    <link href="assets/img/bg.jpg" rel="icon">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

</head>
<style type="text/css">
body {
    background-size: cover;
    background-position: ;
    background-image: url(assets/img/bg.jpg);
    background-repeat: no-repeat;

}

#login .container #login-row #login-column #login-box {
    margin-top: 120px;
    max-width: 600px;
    border: 1px solid white;
    background-color: white;
    border-radius: 25px;
}

#login .container #login-row #login-column #login-box #login-form {
    padding: 20px;
}

#login .container #login-row #login-column #login-box #login-form #register-link {
    margin-top: -85px;
}
</style>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<title>KLASIFIKASI KNN</title>

<body>
    <br>
    <div id="login">
        <section id="" class="d-flex flex-column justify-content-center">
            <h1 class=" text-center text-primary"> Implementasi Metode K-Nearest Neighbor <br>Untuk Prediksi Stunting
                Balita <br>Berdasarkan Data Kesehatan dan Lingkungan
            </h1>
            <h4 class="text-center text-success ">
                (Studi Kasus: Puskesmas Ngimbang) </h4>
            <div class="container">

                <?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "gagal"){
				echo "<div style='margin-bottom:-90px' class='alert alert-danger text-center' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>&emsp;  Login Gagal !! Username dan Password Salah !!</div>";
			}
		}
		?>
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="login_proses.php" method="post">
                                <h3 class="text-center text-black">Login</h3>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-primary btn-md" value="Login">
                                </div>
                            </form>
        </section>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>