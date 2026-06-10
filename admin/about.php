<?php
include 'header.php';

$total_training_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_namatraining");
$total_training = mysql_fetch_array($total_training_q);

$total_testing_q = mysql_query("SELECT COUNT(DISTINCT kode_nama) AS total FROM tbl_testing");
$total_testing = mysql_fetch_array($total_testing_q);

$total_kriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$total_kriteria = mysql_fetch_array($total_kriteria_q);

$total_hasil_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_hasil");
$total_hasil = mysql_fetch_array($total_hasil_q);
?>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-2 modern-sidebar">
            <div class="modern-brand">KNN Stunting</div>

            <p>
                <a href="index.php">
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-home"></span> BERANDA
                    </button>
                </a>
            </p>

            <p>
                <a href="training.php">
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-list-alt"></span> DATA TRAINING
                    </button>
                </a>
            </p>

            <p>
                <a href="testing.php">
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-check"></span> DATA TESTING
                    </button>
                </a>
            </p>

            <p>
                <a href="kriteria.php">
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-th-large"></span> DATA KRITERIA
                    </button>
                </a>
            </p>

            <p>
                <a href="subkriteria.php">
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-th-list"></span> DATA SUB KRITERIA
                    </button>
                </a>
            </p>

            <p>
                <a href="metode.php">
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-cog"></span> METODE
                    </button>
                </a>
            </p>

            <p>
                <a href="hasil.php">
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-stats"></span> HASIL ANALISA
                    </button>
                </a>
            </p>

            <p>
                <a href="about.php">
                    <button type="button" class="btn btn-primary btn-block active">
                        <span class="glyphicon glyphicon-info-sign"></span> ABOUT
                    </button>
                </a>
            </p>
        </div>

        <div class="col-sm-10 modern-content">

            <div class="about-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Tentang Aplikasi
                    </span>

                    <h2>About Sistem Klasifikasi KNN</h2>

                    <p>
                        Aplikasi ini dibuat untuk membantu proses klasifikasi prediksi stunting balita menggunakan
                        metode K-Nearest Neighbor berdasarkan data kesehatan dan lingkungan.
                    </p>
                </div>

                <a href="metode.php" class="btn btn-modern-primary">
                    <span class="glyphicon glyphicon-play"></span> Mulai Pengujian
                </a>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-3 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_training['total']; ?></h3>
                            <p>Data Training</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-green">
                            <span class="glyphicon glyphicon-check"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_testing['total']; ?></h3>
                            <p>Data Testing</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-purple">
                            <span class="glyphicon glyphicon-th-large"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_kriteria['total']; ?></h3>
                            <p>Kriteria</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-orange">
                            <span class="glyphicon glyphicon-stats"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_hasil['total']; ?></h3>
                            <p>Hasil Analisa</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row about-section">

                <div class="col-md-5">
                    <div class="modern-card about-profile-card">
                        <div class="about-profile-avatar">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>

                        <h3>Pembuat Aplikasi</h3>
                        <p class="about-profile-subtitle">Identitas pengembang sistem</p>

                        <div class="about-identity-list">

                            <div class="about-identity-item">
                                <span class="glyphicon glyphicon-user"></span>
                                <div>
                                    <small>Nama</small>
                                    <strong>ISI NAMA DI SINI</strong>
                                </div>
                            </div>

                            <div class="about-identity-item">
                                <span class="glyphicon glyphicon-credit-card"></span>
                                <div>
                                    <small>NIM</small>
                                    <strong>ISI NIM DI SINI</strong>
                                </div>
                            </div>

                            <div class="about-identity-item">
                                <span class="glyphicon glyphicon-education"></span>
                                <div>
                                    <small>Program Studi</small>
                                    <strong>Teknik Informatika</strong>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="modern-card about-system-card">
                        <div class="modern-title-wrap">
                            <div>
                                <h4>Informasi Sistem</h4>
                                <div class="modern-subtitle">
                                    Ringkasan fungsi utama aplikasi klasifikasi stunting.
                                </div>
                            </div>
                        </div>

                        <div class="about-info-box">
                            <span class="glyphicon glyphicon-heart"></span>
                            Sistem ini berfokus pada proses pengolahan data balita untuk membantu pengambilan keputusan
                            berbasis data.
                        </div>

                        <div class="about-feature-list">

                            <div class="about-feature-item">
                                <div class="about-feature-icon">
                                    <span class="glyphicon glyphicon-list-alt"></span>
                                </div>

                                <div>
                                    <h5>Data Training</h5>
                                    <p>Digunakan sebagai data acuan yang sudah memiliki keputusan.</p>
                                </div>
                            </div>

                            <div class="about-feature-item">
                                <div class="about-feature-icon">
                                    <span class="glyphicon glyphicon-check"></span>
                                </div>

                                <div>
                                    <h5>Data Testing</h5>
                                    <p>Digunakan sebagai data baru yang akan diuji dan diklasifikasikan.</p>
                                </div>
                            </div>

                            <div class="about-feature-item">
                                <div class="about-feature-icon">
                                    <span class="glyphicon glyphicon-cog"></span>
                                </div>

                                <div>
                                    <h5>Metode KNN</h5>
                                    <p>Menghitung jarak terdekat menggunakan Euclidean Distance.</p>
                                </div>
                            </div>

                            <div class="about-feature-item">
                                <div class="about-feature-icon">
                                    <span class="glyphicon glyphicon-stats"></span>
                                </div>

                                <div>
                                    <h5>Hasil Analisa</h5>
                                    <p>Menampilkan keputusan akhir dari proses klasifikasi yang sudah disimpan.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card about-description-card">
                <div class="modern-title-wrap">
                    <div>
                        <h4>Judul Penelitian</h4>
                        <div class="modern-subtitle">
                            Topik utama pengembangan aplikasi.
                        </div>
                    </div>
                </div>

                <div class="about-title-box">
                    <span class="glyphicon glyphicon-book"></span>

                    <h3>
                        Implementasi Metode K-Nearest Neighbor Untuk Prediksi Stunting Balita Berdasarkan Data Kesehatan
                        dan Lingkungan
                    </h3>

                    <p>
                        Studi Kasus: Puskesmas Ngimbang
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>