<?php
include "header.php";

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == "simpanhasil") {
        $kode_hasil = mysql_real_escape_string($_POST['kode_hasil']);
        $nama = mysql_real_escape_string($_POST['nama']);
        $keputusan = mysql_real_escape_string($_POST['keputusan']);

        mysql_query("INSERT INTO tbl_hasil(kode_hasil,nama,keputusan) 
            VALUES('$kode_hasil','$nama','$keputusan')") or die(mysql_error());

        header("location:hasil.php");
        exit;
    }
}

$kode_nama_get = "";
if(isset($_GET['kode_nama'])){
    $kode_nama_get = mysql_real_escape_string($_GET['kode_nama']);
}

$nilai_k = 3;
if(isset($_GET['nilai_k'])){
    $nilai_k = (int)$_GET['nilai_k'];
    if($nilai_k < 1){
        $nilai_k = 3;
    }
}

$is_proses = false;
if(isset($_GET['proses']) && $kode_nama_get != ""){
    $is_proses = true;
}

$kriteria_list = array();
$q_kriteria = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");
while($k = mysql_fetch_array($q_kriteria)){
    $kriteria_list[] = $k;
}

$total_training_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_namatraining");
$total_training = mysql_fetch_array($total_training_q);

$total_testing_q = mysql_query("SELECT COUNT(DISTINCT kode_nama) AS total FROM tbl_testing");
$total_testing = mysql_fetch_array($total_testing_q);

$total_kriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$total_kriteria = mysql_fetch_array($total_kriteria_q);

$selected_testing = false;
if($kode_nama_get != ""){
    $q_selected = mysql_query("SELECT * FROM tbl_testing WHERE kode_nama='$kode_nama_get' LIMIT 1");
    $selected_testing = mysql_fetch_array($q_selected);
}
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
                    <button type="button" class="btn btn-primary btn-block active">
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

            <div class="metode-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-cog"></span>
                        Proses Klasifikasi
                    </span>

                    <h2>Metode K-Nearest Neighbor</h2>

                    <p>
                        Jalankan proses klasifikasi data testing berdasarkan kedekatan nilai terhadap data training
                        menggunakan perhitungan Euclidean Distance.
                    </p>
                </div>

                <a href="hasil.php" class="btn btn-modern-primary">
                    <span class="glyphicon glyphicon-stats"></span> Lihat Hasil
                </a>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
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

                <div class="col-md-4 col-sm-6">
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

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-orange">
                            <span class="glyphicon glyphicon-th-large"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_kriteria['total']; ?></h3>
                            <p>Total Kriteria</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card metode-form-card">
                <div class="modern-title-wrap">
                    <div>
                        <h4>Pengujian Data Testing</h4>
                        <div class="modern-subtitle">
                            Pilih data testing dan tentukan nilai K untuk memulai proses klasifikasi.
                        </div>
                    </div>
                </div>

                <div class="metode-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Nilai K menentukan jumlah tetangga terdekat yang digunakan untuk mengambil keputusan akhir.
                </div>

                <form action="" method="get" enctype="multipart/form-data">
                    <div class="metode-form-grid">

                        <div class="form-group">
                            <label>Pilih Nama Testing</label>
                            <select class="form-control" name="kode_nama" autocomplete="off" required>
                                <option value="">Pilih Data Testing</option>

                                <?php
                                $b1 = mysql_query("SELECT * FROM tbl_testing GROUP BY kode_nama ORDER BY kode_nama ASC");
                                while ($b = mysql_fetch_array($b1)) {
                                    $selected = "";
                                    if($kode_nama_get == $b['kode_nama']){
                                        $selected = "selected";
                                    }
                                ?>

                                <option value="<?php echo $b['kode_nama']; ?>" <?php echo $selected; ?>>
                                    <?php echo $b['kode_nama']; ?> - <?php echo $b['nama']; ?>
                                </option>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nilai K</label>
                            <input name="nilai_k" type="number" class="form-control" value="<?php echo $nilai_k; ?>"
                                min="1" required>
                        </div>

                    </div>

                    <div class="metode-form-action">
                        <button type="submit" class="btn btn-modern-primary" name="proses" value="PENGUJIAN">
                            <span class="glyphicon glyphicon-play"></span> Proses Pengujian
                        </button>

                        <?php if($is_proses){ ?>
                        <a href="metode.php" class="btn btn-modern-secondary">
                            <span class="glyphicon glyphicon-refresh"></span> Reset
                        </a>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <div class="modern-card">
                <div class="metode-section-title">
                    <div>
                        <h4>Data Training</h4>
                        <p>Dataset acuan yang digunakan untuk menghitung jarak terhadap data testing.</p>
                    </div>
                </div>

                <div class="table-responsive modern-table metode-table-wrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    echo "<th class='text-center'>".$kriteria['nama_kriteria']."</th>";
                                }
                                ?>

                                <th class="text-center">Keputusan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $data_training = mysql_query("SELECT * FROM tbl_namatraining ORDER BY kode_nama ASC");
                            $no = 1;

                            if(mysql_num_rows($data_training) > 0){
                                while ($a = mysql_fetch_array($data_training)) {
                                    $kode = $a['kode_nama'];
                            ?>

                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>

                                <td>
                                    <div class="training-user">
                                        <div class="training-avatar">
                                            <?php echo strtoupper(substr($a['nama'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <strong><?php echo $a['nama']; ?></strong>
                                            <small>Kode: <?php echo $a['kode_nama']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    $kode_kriteria = $kriteria['kode_kriteria'];

                                    $q_nilai = mysql_query("SELECT nilai_training AS nilai 
                                        FROM tbl_training 
                                        WHERE kode_nama='$kode' 
                                        AND kode_kriteria='$kode_kriteria' 
                                        LIMIT 1");

                                    $d_nilai = mysql_fetch_array($q_nilai);

                                    if($d_nilai){
                                        echo "<td class='text-center'><span class='badge-nilai'>".$d_nilai['nilai']."</span></td>";
                                    } else {
                                        echo "<td class='text-center'><span class='badge-empty'>-</span></td>";
                                    }
                                }
                                ?>

                                <td class="text-center">
                                    <span class="badge-decision"><?php echo $a['keputusan']; ?></span>
                                </td>
                            </tr>

                            <?php 
                                }
                            } else {
                            ?>

                            <tr>
                                <td colspan="<?php echo count($kriteria_list) + 3; ?>" class="text-center empty-state">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <h4>Data training masih kosong</h4>
                                    <p>Silakan isi data training terlebih dahulu.</p>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modern-card">
                <div class="metode-section-title">
                    <div>
                        <h4>Data Testing Yang Dipilih</h4>
                        <p>Data ini akan dibandingkan dengan seluruh data training.</p>
                    </div>
                </div>

                <div class="table-responsive modern-table metode-table-wrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    echo "<th class='text-center'>".$kriteria['nama_kriteria']."</th>";
                                }
                                ?>

                                <th class="text-center">Keputusan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if($is_proses && $selected_testing){ ?>

                            <tr>
                                <td class="text-center">1</td>

                                <td>
                                    <div class="training-user">
                                        <div class="training-avatar">
                                            <?php echo strtoupper(substr($selected_testing['nama'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <strong><?php echo $selected_testing['nama']; ?></strong>
                                            <small>Kode: <?php echo $selected_testing['kode_nama']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    $kode_kriteria = $kriteria['kode_kriteria'];

                                    $q_nilai = mysql_query("SELECT nilai_testing AS nilai 
                                        FROM tbl_testing 
                                        WHERE kode_nama='$kode_nama_get' 
                                        AND kode_kriteria='$kode_kriteria' 
                                        LIMIT 1");

                                    $d_nilai = mysql_fetch_array($q_nilai);

                                    if($d_nilai){
                                        echo "<td class='text-center'><span class='badge-nilai'>".$d_nilai['nilai']."</span></td>";
                                    } else {
                                        echo "<td class='text-center'><span class='badge-empty'>-</span></td>";
                                    }
                                }
                                ?>

                                <td class="text-center">
                                    <span class="badge-keputusan">?</span>
                                </td>
                            </tr>

                            <?php } else { ?>

                            <tr>
                                <td colspan="<?php echo count($kriteria_list) + 3; ?>" class="text-center empty-state">
                                    <span class="glyphicon glyphicon-search"></span>
                                    <h4>Belum ada data testing dipilih</h4>
                                    <p>Pilih data testing dan klik Proses Pengujian untuk menampilkan data.</p>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if($is_proses && $selected_testing){ ?>

            <div class="modern-card">
                <div class="metode-section-title">
                    <div>
                        <h4>Euclidean Distance</h4>
                        <p>Perhitungan jarak antara data testing dengan masing-masing data training.</p>
                    </div>
                </div>

                <div class="table-responsive modern-table metode-table-wrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    echo "<th class='text-center'>".$kriteria['nama_kriteria']."</th>";
                                }
                                ?>

                                <th class="text-center">Distance</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $data = mysql_query("SELECT * FROM tbl_namatraining ORDER BY kode_nama ASC");
                            $no = 1;

                            while ($a = mysql_fetch_array($data)) {
                                $sum = 0.0;
                                $kode = $a['kode_nama'];
                            ?>

                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>

                                <td>
                                    <div class="training-user">
                                        <div class="training-avatar">
                                            <?php echo strtoupper(substr($a['nama'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <strong><?php echo $a['nama']; ?></strong>
                                            <small>Kode: <?php echo $a['kode_nama']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    $kode_kriteria = $kriteria['kode_kriteria'];

                                    $q_training = mysql_query("SELECT nilai_training AS nilai 
                                        FROM tbl_training 
                                        WHERE kode_nama='$kode' 
                                        AND kode_kriteria='$kode_kriteria' 
                                        LIMIT 1");

                                    $d_training = mysql_fetch_array($q_training);

                                    $q_testing = mysql_query("SELECT nilai_testing AS nilai 
                                        FROM tbl_testing 
                                        WHERE kode_nama='$kode_nama_get' 
                                        AND kode_kriteria='$kode_kriteria' 
                                        LIMIT 1");

                                    $d_testing = mysql_fetch_array($q_testing);

                                    $val1 = 0;
                                    $val2 = 0;

                                    if($d_training){
                                        $val1 = $d_training['nilai'];
                                    }

                                    if($d_testing){
                                        $val2 = $d_testing['nilai'];
                                    }

                                    $val = pow(($val2 - $val1), 2);
                                    $sum += $val;

                                    echo "<td class='text-center'><span class='badge-distance-detail'>".$val."</span></td>";
                                }

                                $akr = sqrt($sum);
                                mysql_query("UPDATE tbl_namatraining SET distance='$akr' WHERE kode_nama='".$a['kode_nama']."'");
                                ?>

                                <td class="text-center">
                                    <span class="badge-distance"><?php echo number_format($akr, 3); ?></span>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
            $brg = mysql_query("SELECT * FROM tbl_namatraining ORDER BY distance ASC");
            $rank = 1;

            while ($b = mysql_fetch_array($brg)) {
                mysql_query("UPDATE tbl_namatraining SET ranking='$rank' WHERE kode_nama='".$b['kode_nama']."'");
                $rank++;
            }

            $bg = mysql_query("SELECT * FROM tbl_namatraining ORDER BY distance ASC");

            while ($bt = mysql_fetch_array($bg)) {
                if ($bt['ranking'] <= $nilai_k) {
                    mysql_query("UPDATE tbl_namatraining SET pilihan='Ya' WHERE kode_nama='".$bt['kode_nama']."'");
                } else {
                    mysql_query("UPDATE tbl_namatraining SET pilihan='Tidak' WHERE kode_nama='".$bt['kode_nama']."'");
                }
            }
            ?>

            <div class="modern-card">
                <div class="metode-section-title">
                    <div>
                        <h4>Klasifikasi Nearest Neighbor</h4>
                        <p>Data dengan ranking teratas akan dipakai sebagai dasar pengambilan keputusan.</p>
                    </div>
                </div>

                <div class="table-responsive modern-table metode-table-wrap">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Kode</th>
                                <th>Nama</th>
                                <th class="text-center">Distance</th>
                                <th class="text-center">Ranking</th>
                                <th class="text-center">Pilih</th>
                                <th class="text-center">Keputusan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $brg = mysql_query("SELECT * FROM tbl_namatraining ORDER BY distance ASC");

                            while ($b = mysql_fetch_array($brg)) {
                                $row_class = "";
                                if($b['pilihan'] == "Ya"){
                                    $row_class = "nearest-selected";
                                }
                            ?>

                            <tr class="<?php echo $row_class; ?>">
                                <td class="text-center">
                                    <span class="badge-kode"><?php echo $b['kode_nama']; ?></span>
                                </td>

                                <td>
                                    <strong><?php echo $b['nama']; ?></strong>
                                </td>

                                <td class="text-center">
                                    <span class="badge-distance"><?php echo number_format($b['distance'], 3); ?></span>
                                </td>

                                <td class="text-center">
                                    <span class="badge-rank">#<?php echo $b['ranking']; ?></span>
                                </td>

                                <td class="text-center">
                                    <?php if($b['pilihan'] == "Ya"){ ?>
                                    <span class="badge-pilih-yes">Ya</span>
                                    <?php } else { ?>
                                    <span class="badge-pilih-no">Tidak</span>
                                    <?php } ?>
                                </td>

                                <td class="text-center">
                                    <span class="badge-decision"><?php echo $b['keputusan']; ?></span>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
            $q_hasil = mysql_query("SELECT keputusan, COUNT(*) AS total 
                FROM tbl_namatraining 
                WHERE pilihan='Ya' 
                GROUP BY keputusan 
                ORDER BY total DESC 
                LIMIT 1");

            $d_hasil = mysql_fetch_array($q_hasil);

            $hasil = "-";
            $jumlah_hasil = 0;

            if($d_hasil){
                $hasil = $d_hasil['keputusan'];
                $jumlah_hasil = $d_hasil['total'];
            }

            $total_dipilih_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_namatraining WHERE pilihan='Ya'");
            $total_dipilih = mysql_fetch_array($total_dipilih_q);

            $nama_testing = $selected_testing['nama'];

            $carikode = mysql_query("SELECT MAX(CAST(SUBSTRING(kode_hasil, 2) AS UNSIGNED)) AS max_kode FROM tbl_hasil") or die(mysql_error());
            $datakode = mysql_fetch_assoc($carikode);

            if ($datakode && $datakode['max_kode'] !== null) {
                $nilaikode = (int)$datakode['max_kode'];
                $nilaikode++;
                $kode_otomatis = "H" . str_pad($nilaikode, 2, "0", STR_PAD_LEFT);
            } else {
                $kode_otomatis = "H01";
            }
            ?>

            <div class="result-modern-card">
                <div class="result-icon">
                    <span class="glyphicon glyphicon-ok"></span>
                </div>

                <div class="result-content">
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-flag"></span>
                        Kesimpulan
                    </span>

                    <h3>Hasil Klasifikasi: <?php echo $hasil; ?></h3>

                    <p>
                        Hasil perhitungan menggunakan <b>K=<?php echo $nilai_k; ?></b> data terdekat menunjukkan bahwa
                        kategori terbanyak adalah
                        <b><?php echo $hasil; ?></b> sebanyak <b><?php echo $jumlah_hasil; ?></b> dari
                        <b><?php echo $total_dipilih['total']; ?></b> data yang dipilih.
                    </p>

                    <p>
                        Berdasarkan proses K-Nearest Neighbor, data testing bernama
                        <b><?php echo $nama_testing; ?></b> mendapatkan keputusan akhir:
                        <b><?php echo $hasil; ?></b>.
                    </p>

                    <form action="metode.php?aksi=simpanhasil" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="kode_hasil"
                            value="<?php echo $kode_otomatis; ?>">
                        <input name="nama" type="hidden" class="form-control" value="<?php echo $nama_testing; ?>">
                        <input type="hidden" class="form-control" name="keputusan" value="<?php echo $hasil; ?>">

                        <button type="submit" class="btn btn-modern-primary" name="proses" value="SIMPAN HASIL ANALISA">
                            <span class="glyphicon glyphicon-floppy-disk"></span> Simpan Hasil Analisa
                        </button>
                    </form>
                </div>
            </div>

            <?php } ?>

        </div>
    </div>
</div>