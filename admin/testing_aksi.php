<?php
include 'header.php';

if(!isset($_GET['kode_nama'])){
    header("location:testing.php");
    exit;
}

if(!isset($_GET['aksi']) || $_GET['aksi'] != "ubah"){
    header("location:testing.php");
    exit;
}

$kode_nama = mysql_real_escape_string($_GET['kode_nama']);

$q_testing = mysql_query("SELECT * FROM tbl_testing WHERE kode_nama='$kode_nama' LIMIT 1") or die(mysql_error());
$data_testing = mysql_fetch_array($q_testing);

if(!$data_testing){
    header("location:testing.php");
    exit;
}

$q_kriteria_total = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$d_kriteria_total = mysql_fetch_array($q_kriteria_total);

$q_nilai_total = mysql_query("SELECT COUNT(*) AS total FROM tbl_testing WHERE kode_nama='$kode_nama'");
$d_nilai_total = mysql_fetch_array($q_nilai_total);
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
                    <button type="button" class="btn btn-primary btn-block active">
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

            <div class="testing-edit-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Ubah Data Testing
                    </span>

                    <h2>Ubah Data Testing</h2>

                    <p>
                        Perbarui nama dan nilai kriteria untuk data testing bernama
                        <b><?php echo $data_testing['nama']; ?></b>.
                    </p>
                </div>

                <a href="testing.php" class="btn btn-modern-secondary">
                    <span class="glyphicon glyphicon-arrow-left"></span> Kembali
                </a>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-green">
                            <span class="glyphicon glyphicon-check"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $data_testing['kode_nama']; ?></h3>
                            <p>Kode Testing</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-purple">
                            <span class="glyphicon glyphicon-th-large"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $d_kriteria_total['total']; ?></h3>
                            <p>Total Kriteria</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-ok"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $d_nilai_total['total']; ?></h3>
                            <p>Nilai Tersimpan</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card testing-edit-card">

                <div class="modern-title-wrap">
                    <div>
                        <h4>Form Ubah Data Testing</h4>
                        <div class="modern-subtitle">
                            Pilih ulang nilai sub kriteria sesuai data testing terbaru.
                        </div>
                    </div>
                </div>

                <div class="testing-edit-user-card">
                    <div class="testing-edit-avatar">
                        <?php echo strtoupper(substr($data_testing['nama'], 0, 1)); ?>
                    </div>

                    <div class="testing-edit-user-info">
                        <h4><?php echo $data_testing['nama']; ?></h4>
                        <p>
                            <span class="badge-kode"><?php echo $data_testing['kode_nama']; ?></span>
                            <span class="testing-edit-status">Data testing untuk proses klasifikasi</span>
                        </p>
                    </div>
                </div>

                <div class="testing-edit-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Data testing digunakan sebagai data baru yang akan dibandingkan dengan seluruh data training pada
                    proses KNN.
                </div>

                <form action="testing_proses.php?proses=prosesubah" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="kode_nama" value="<?php echo $data_testing['kode_nama']; ?>">

                    <div class="form-group testing-edit-name-field">
                        <label>Nama Testing</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $data_testing['nama']; ?>"
                            autocomplete="off" required>
                    </div>

                    <div class="testing-edit-form-grid">

                        <?php
                        $hasil = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");

                        while ($baris = mysql_fetch_array($hasil)) {
                            $idK = $baris['kode_kriteria'];
                            $labelK = $baris['nama_kriteria'];

                            $hasil3 = mysql_query("SELECT * FROM tbl_testing 
                                WHERE kode_kriteria='$idK' 
                                AND kode_nama='$kode_nama' 
                                LIMIT 1");

                            $result3 = mysql_fetch_array($hasil3);

                            $nilai_sekarang = "";
                            if($result3){
                                $nilai_sekarang = $result3['nilai_testing'];
                            }
                        ?>

                        <div class="form-group testing-edit-field">
                            <label><?php echo $labelK; ?></label>

                            <select name="<?php echo $idK; ?>" class="form-control" required>
                                <option value="">Pilih <?php echo $labelK; ?></option>

                                <?php
                                $hasil2 = mysql_query("SELECT * FROM tbl_subkriteria 
                                    WHERE kode_kriteria='$idK' 
                                    ORDER BY nilai_subkriteria DESC");

                                while ($baris2 = mysql_fetch_array($hasil2)) {
                                    $selected = "";

                                    if($nilai_sekarang == $baris2['nilai_subkriteria']){
                                        $selected = "selected";
                                    }
                                ?>

                                <option value="<?php echo $baris2['nilai_subkriteria']; ?>" <?php echo $selected; ?>>
                                    <?php echo $baris2['nama_subkriteria']; ?> -
                                    (<?php echo $baris2['nilai_subkriteria']; ?>)
                                </option>

                                <?php } ?>
                            </select>
                        </div>

                        <?php } ?>

                    </div>

                    <div class="testing-edit-footer">
                        <a href="testing.php" class="btn btn-modern-secondary">
                            <span class="glyphicon glyphicon-remove"></span> Batal
                        </a>

                        <button type="submit" class="btn btn-modern-primary">
                            <span class="glyphicon glyphicon-floppy-disk"></span> Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>