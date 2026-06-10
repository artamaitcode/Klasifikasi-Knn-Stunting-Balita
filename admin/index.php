<?php
include 'header.php';

$q_training = mysql_query("SELECT COUNT(*) AS total FROM tbl_namatraining");
$d_training = mysql_fetch_array($q_training);

$q_testing = mysql_query("SELECT COUNT(DISTINCT kode_nama) AS total FROM tbl_testing");
$d_testing = mysql_fetch_array($q_testing);

$q_kriteria = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$d_kriteria = mysql_fetch_array($q_kriteria);

$q_subkriteria = mysql_query("SELECT COUNT(*) AS total FROM tbl_subkriteria");
$d_subkriteria = mysql_fetch_array($q_subkriteria);

$q_hasil = mysql_query("SELECT COUNT(*) AS total FROM tbl_hasil");
$d_hasil = mysql_fetch_array($q_hasil);

$q_layak = mysql_query("SELECT COUNT(*) AS total FROM tbl_hasil WHERE UPPER(keputusan)='LAYAK'");
$d_layak = mysql_fetch_array($q_layak);

$q_tidak_layak = mysql_query("SELECT COUNT(*) AS total FROM tbl_hasil WHERE UPPER(keputusan)='TIDAK LAYAK'");
$d_tidak_layak = mysql_fetch_array($q_tidak_layak);

$total_hasil = (int)$d_hasil['total'];
$total_layak = (int)$d_layak['total'];
$total_tidak_layak = (int)$d_tidak_layak['total'];

$persen_layak = 0;
$persen_tidak_layak = 0;
$derajat_layak = 0;

if($total_hasil > 0){
    $persen_layak = round(($total_layak / $total_hasil) * 100, 1);
    $persen_tidak_layak = round(($total_tidak_layak / $total_hasil) * 100, 1);
    $derajat_layak = round(($total_layak / $total_hasil) * 360, 1);
}

$q_terbaru = mysql_query("SELECT * FROM tbl_hasil ORDER BY kode_hasil DESC LIMIT 5");
?>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-2 modern-sidebar">
            <div class="modern-brand">KNN Stunting</div>

            <p>
                <a href="index.php">
                    <button type="button" class="btn btn-primary btn-block active">
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
                    <button type="button" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-info-sign"></span> ABOUT
                    </button>
                </a>
            </p>
        </div>

        <div class="col-sm-10 modern-content">

            <div class="home-hero">
                <div class="home-hero-content">
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-stats"></span>
                        Sistem Klasifikasi Metode KNN
                    </span>

                    <h1>
                        Implementasi Metode K-Nearest Neighbor Untuk Prediksi Stunting Balita
                    </h1>

                    <p>
                        Sistem ini digunakan untuk membantu proses prediksi stunting balita berdasarkan data kesehatan
                        dan lingkungan dengan studi kasus Puskesmas Ngimbang.
                    </p>

                    <div class="home-hero-action">
                        <a href="training.php" class="btn btn-modern-primary">
                            <span class="glyphicon glyphicon-plus"></span> Kelola Data Training
                        </a>

                        <a href="hasil.php" class="btn btn-modern-secondary">
                            <span class="glyphicon glyphicon-stats"></span> Lihat Hasil Analisa
                        </a>
                    </div>
                </div>

                <div class="home-hero-visual">
                    <div class="hero-circle">
                        <span class="glyphicon glyphicon-heart"></span>
                    </div>
                    <div class="hero-small-card hero-card-one">
                        <strong>KNN</strong>
                        <small>Classification</small>
                    </div>
                    <div class="hero-small-card hero-card-two">
                        <strong>Stunting</strong>
                        <small>Prediction</small>
                    </div>
                </div>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-3 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $d_training['total']; ?></h3>
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
                            <h3><?php echo $d_testing['total']; ?></h3>
                            <p>Data Testing</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-orange">
                            <span class="glyphicon glyphicon-th-large"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $d_kriteria['total']; ?></h3>
                            <p>Data Kriteria</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-purple">
                            <span class="glyphicon glyphicon-th-list"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $d_subkriteria['total']; ?></h3>
                            <p>Sub Kriteria</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row home-classification-section">

                <div class="col-md-7">
                    <div class="modern-card home-chart-card">
                        <div class="modern-title-wrap">
                            <div>
                                <h4>Hasil Proses Klasifikasi KNN</h4>
                                <div class="modern-subtitle">
                                    Ringkasan keputusan dari data hasil analisa yang sudah disimpan.
                                </div>
                            </div>

                            <a href="hasil.php" class="btn btn-modern-secondary">
                                <span class="glyphicon glyphicon-eye-open"></span> Detail Hasil
                            </a>
                        </div>

                        <?php if($total_hasil > 0){ ?>

                        <div class="classification-dashboard">

                            <div class="pie-chart-box">
                                <div class="pie-chart"
                                    style="background: conic-gradient(#16a34a 0deg <?php echo $derajat_layak; ?>deg, #f97316 <?php echo $derajat_layak; ?>deg 360deg);">
                                    <div class="pie-center">
                                        <strong><?php echo $total_hasil; ?></strong>
                                        <span>Total Hasil</span>
                                    </div>
                                </div>
                            </div>

                            <div class="classification-stat-list">

                                <div class="classification-stat-item">
                                    <div class="stat-dot stat-dot-green"></div>
                                    <div>
                                        <h5>Layak</h5>
                                        <p><?php echo $total_layak; ?> data, <?php echo $persen_layak; ?>%</p>
                                    </div>
                                </div>

                                <div class="classification-stat-item">
                                    <div class="stat-dot stat-dot-orange"></div>
                                    <div>
                                        <h5>Tidak Layak</h5>
                                        <p><?php echo $total_tidak_layak; ?> data, <?php echo $persen_tidak_layak; ?>%
                                        </p>
                                    </div>
                                </div>

                                <div class="classification-note">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    Grafik ini membaca data dari tabel <b>tbl_hasil</b>. Jika hasil masih kosong,
                                    jalankan proses pada halaman Metode lalu simpan hasil analisa.
                                </div>

                            </div>

                        </div>

                        <?php } else { ?>

                        <div class="home-empty-chart">
                            <span class="glyphicon glyphicon-stats"></span>
                            <h4>Belum ada hasil klasifikasi</h4>
                            <p>Silakan lakukan proses pengujian pada halaman Metode, lalu simpan hasil analisa.</p>

                            <a href="metode.php" class="btn btn-modern-primary">
                                <span class="glyphicon glyphicon-play"></span> Mulai Pengujian
                            </a>
                        </div>

                        <?php } ?>

                    </div>
                </div>

                <div class="col-md-5">
                    <div class="modern-card home-result-card">
                        <div class="modern-title-wrap">
                            <div>
                                <h4>Hasil Analisa Terbaru</h4>
                                <div class="modern-subtitle">
                                    Lima data terakhir yang tersimpan di hasil analisa.
                                </div>
                            </div>
                        </div>

                        <?php if(mysql_num_rows($q_terbaru) > 0){ ?>

                        <div class="latest-result-list">

                            <?php
                            while($h = mysql_fetch_array($q_terbaru)){
                                $badge_class = "hasil-badge-default";

                                if(strtoupper($h['keputusan']) == "LAYAK"){
                                    $badge_class = "hasil-badge-layak";
                                } elseif(strtoupper($h['keputusan']) == "TIDAK LAYAK"){
                                    $badge_class = "hasil-badge-tidak";
                                }
                            ?>

                            <div class="latest-result-item">
                                <div class="latest-result-avatar">
                                    <?php echo strtoupper(substr($h['nama'], 0, 1)); ?>
                                </div>

                                <div class="latest-result-info">
                                    <strong><?php echo $h['nama']; ?></strong>
                                    <small>Kode hasil: <?php echo $h['kode_hasil']; ?></small>
                                </div>

                                <span class="<?php echo $badge_class; ?>">
                                    <?php echo $h['keputusan']; ?>
                                </span>
                            </div>

                            <?php } ?>

                        </div>

                        <?php } else { ?>

                        <div class="home-small-empty">
                            <span class="glyphicon glyphicon-folder-open"></span>
                            <p>Belum ada hasil analisa tersimpan.</p>
                        </div>

                        <?php } ?>

                    </div>
                </div>

            </div>

            <div class="row home-section">

                <div class="col-md-8">
                    <div class="modern-card">
                        <div class="modern-title-wrap">
                            <div>
                                <h4>Alur Sistem</h4>
                                <div class="modern-subtitle">
                                    Urutan kerja sistem klasifikasi stunting menggunakan metode KNN.
                                </div>
                            </div>
                        </div>

                        <div class="process-list">

                            <div class="process-item">
                                <div class="process-number">1</div>
                                <div>
                                    <h5>Input Data Training</h5>
                                    <p>Masukkan data balita yang sudah memiliki keputusan sebagai data acuan.</p>
                                </div>
                            </div>

                            <div class="process-item">
                                <div class="process-number">2</div>
                                <div>
                                    <h5>Input Data Testing</h5>
                                    <p>Masukkan data baru yang akan diprediksi status stuntingnya.</p>
                                </div>
                            </div>

                            <div class="process-item">
                                <div class="process-number">3</div>
                                <div>
                                    <h5>Proses Metode KNN</h5>
                                    <p>Sistem menghitung jarak data testing terhadap data training.</p>
                                </div>
                            </div>

                            <div class="process-item">
                                <div class="process-number">4</div>
                                <div>
                                    <h5>Hasil Analisa</h5>
                                    <p>Hasil klasifikasi ditampilkan berdasarkan ranking jarak terdekat.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="modern-card quick-card">
                        <h4>Akses Cepat</h4>
                        <p>Pilih menu utama untuk mulai mengelola sistem.</p>

                        <a href="training.php" class="quick-link">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            Data Training
                        </a>

                        <a href="testing.php" class="quick-link">
                            <span class="glyphicon glyphicon-check"></span>
                            Data Testing
                        </a>

                        <a href="kriteria.php" class="quick-link">
                            <span class="glyphicon glyphicon-th-large"></span>
                            Data Kriteria
                        </a>

                        <a href="subkriteria.php" class="quick-link">
                            <span class="glyphicon glyphicon-th-list"></span>
                            Data Sub Kriteria
                        </a>

                        <a href="hasil.php" class="quick-link">
                            <span class="glyphicon glyphicon-stats"></span>
                            Hasil Analisa
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>