<?php
include 'header.php';

if(!isset($_GET['kode_nama'])){
    header("location:training.php");
    exit;
}

if(!isset($_GET['aksi']) || $_GET['aksi'] != "ubah"){
    header("location:training.php");
    exit;
}

$kode_nama = mysql_real_escape_string($_GET['kode_nama']);

$q_training = mysql_query("SELECT * FROM tbl_namatraining WHERE kode_nama='$kode_nama'") or die(mysql_error());
$data_training = mysql_fetch_array($q_training);

if(!$data_training){
    header("location:training.php");
    exit;
}

$q_cek_nilai = mysql_query("SELECT COUNT(*) AS total FROM tbl_training WHERE kode_nama='$kode_nama'");
$d_cek_nilai = mysql_fetch_array($q_cek_nilai);

$q_kriteria_total = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$d_kriteria_total = mysql_fetch_array($q_kriteria_total);
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
                    <button type="button" class="btn btn-primary btn-block active">
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

            <div class="nilai-edit-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Ubah Nilai Training
                    </span>

                    <h2>Ubah Data Nilai</h2>

                    <p>
                        Perbarui nilai kriteria dan keputusan untuk data training bernama
                        <b><?php echo $data_training['nama']; ?></b>.
                    </p>
                </div>

                <a href="nilai.php?kode_nama=<?php echo $data_training['kode_nama']; ?>"
                    class="btn btn-modern-secondary">
                    <span class="glyphicon glyphicon-arrow-left"></span> Kembali
                </a>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $data_training['kode_nama']; ?></h3>
                            <p>Kode Training</p>
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
                        <div class="summary-icon summary-green">
                            <span class="glyphicon glyphicon-ok"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $d_cek_nilai['total']; ?></h3>
                            <p>Nilai Tersimpan</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card nilai-edit-card">

                <div class="modern-title-wrap">
                    <div>
                        <h4>Form Ubah Nilai Training</h4>
                        <div class="modern-subtitle">
                            Pilih ulang nilai sub kriteria sesuai data terbaru.
                        </div>
                    </div>
                </div>

                <div class="nilai-edit-user-card">
                    <div class="nilai-edit-avatar">
                        <?php echo strtoupper(substr($data_training['nama'], 0, 1)); ?>
                    </div>

                    <div class="nilai-edit-user-info">
                        <h4><?php echo $data_training['nama']; ?></h4>
                        <p>
                            <span class="badge-kode"><?php echo $data_training['kode_nama']; ?></span>
                            <span class="nilai-address"><?php echo $data_training['alamat']; ?></span>
                        </p>
                    </div>

                    <div class="nilai-edit-current-status">
                        <?php
                        $decision_class = "hasil-badge-default";

                        if(strtoupper($data_training['keputusan']) == "LAYAK"){
                            $decision_class = "hasil-badge-layak";
                        } elseif(strtoupper($data_training['keputusan']) == "TIDAK LAYAK"){
                            $decision_class = "hasil-badge-tidak";
                        }
                        ?>

                        <span class="<?php echo $decision_class; ?>">
                            <?php echo $data_training['keputusan']; ?>
                        </span>
                    </div>
                </div>

                <div class="nilai-edit-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Pastikan semua nilai kriteria sudah sesuai. Data ini akan dipakai sebagai acuan dalam proses
                    klasifikasi KNN.
                </div>

                <form action="nilai_proses.php?proses=prosesubah" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="kode_nama" value="<?php echo $data_training['kode_nama']; ?>">

                    <div class="nilai-edit-form-grid">

                        <?php
                        $hasil = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");

                        while ($baris = mysql_fetch_array($hasil)) {
                            $idK = $baris['kode_kriteria'];
                            $labelK = $baris['nama_kriteria'];

                            $hasil3 = mysql_query("SELECT * FROM tbl_training 
                                WHERE kode_kriteria='$idK' 
                                AND kode_nama='$kode_nama' 
                                LIMIT 1");

                            $result3 = mysql_fetch_array($hasil3);

                            $nilai_sekarang = "";
                            if($result3){
                                $nilai_sekarang = $result3['nilai_training'];
                            }
                        ?>

                        <div class="form-group nilai-edit-field">
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

                    <div class="form-group nilai-edit-decision">
                        <label>Keputusan</label>

                        <select name="keputusan" class="form-control" required>
                            <option value="LAYAK"
                                <?php if(strtoupper($data_training['keputusan']) == "LAYAK"){ echo "selected"; } ?>>
                                LAYAK
                            </option>

                            <option value="TIDAK LAYAK"
                                <?php if(strtoupper($data_training['keputusan']) == "TIDAK LAYAK"){ echo "selected"; } ?>>
                                TIDAK LAYAK
                            </option>
                        </select>
                    </div>

                    <div class="nilai-edit-footer">
                        <a href="nilai.php?kode_nama=<?php echo $data_training['kode_nama']; ?>"
                            class="btn btn-modern-secondary">
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