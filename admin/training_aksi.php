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

$det = mysql_query("SELECT * FROM tbl_namatraining WHERE kode_nama='$kode_nama'") or die(mysql_error());
$d = mysql_fetch_array($det);

if(!$d){
    header("location:training.php");
    exit;
}

$q_nilai = mysql_query("SELECT COUNT(*) AS total FROM tbl_training WHERE kode_nama='$kode_nama'");
$d_nilai = mysql_fetch_array($q_nilai);

$q_kriteria = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$d_kriteria = mysql_fetch_array($q_kriteria);
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

            <div class="training-edit-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Ubah Data Training
                    </span>

                    <h2>Ubah Data Training</h2>

                    <p>
                        Perbarui nama dan alamat data training bernama
                        <b><?php echo $d['nama']; ?></b>.
                    </p>
                </div>

                <a href="training.php" class="btn btn-modern-secondary">
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
                            <h3><?php echo $d['kode_nama']; ?></h3>
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
                            <h3><?php echo $d_kriteria['total']; ?></h3>
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
                            <h3><?php echo $d_nilai['total']; ?></h3>
                            <p>Nilai Training</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card training-edit-card">

                <div class="modern-title-wrap">
                    <div>
                        <h4>Form Ubah Data Training</h4>
                        <div class="modern-subtitle">
                            Update identitas data training tanpa mengubah nilai kriteria.
                        </div>
                    </div>
                </div>

                <div class="training-edit-user-card">
                    <div class="training-edit-avatar">
                        <?php echo strtoupper(substr($d['nama'], 0, 1)); ?>
                    </div>

                    <div class="training-edit-user-info">
                        <h4><?php echo $d['nama']; ?></h4>
                        <p>
                            <span class="badge-kode"><?php echo $d['kode_nama']; ?></span>
                            <span class="training-edit-status"><?php echo $d['alamat']; ?></span>
                        </p>
                    </div>

                    <div class="training-edit-current-status">
                        <?php
                        $decision_class = "hasil-badge-default";

                        if(strtoupper($d['keputusan']) == "Stunting"){
                            $decision_class = "hasil-badge-layak";
                        } elseif(strtoupper($d['keputusan']) == "Tidak Stunting"){
                            $decision_class = "hasil-badge-tidak";
                        }
                        ?>

                        <span class="<?php echo $decision_class; ?>">
                            <?php echo $d['keputusan']; ?>
                        </span>
                    </div>
                </div>

                <div class="training-edit-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Form ini hanya mengubah data utama training. Untuk mengubah nilai kriteria, buka tombol Nilai pada
                    halaman Data Training.
                </div>

                <form action="training_proses.php?proses=prosesubah" method="post" enctype="multipart/form-data">

                    <div class="training-edit-form-grid">

                        <div class="form-group training-edit-field">
                            <label>Kode Training</label>
                            <input type="text" readonly class="form-control" name="kode_nama"
                                value="<?php echo $d['kode_nama']; ?>">
                        </div>

                        <div class="form-group training-edit-field">
                            <label>Nama Training</label>
                            <input name="nama" type="text" value="<?php echo $d['nama']; ?>" class="form-control"
                                autocomplete="off" required>
                        </div>

                    </div>

                    <div class="form-group training-edit-address-field">
                        <label>Alamat</label>
                        <input name="alamat" type="text" class="form-control" placeholder="Masukkan alamat"
                            autocomplete="off" required value="<?php echo $d['alamat']; ?>">
                    </div>

                    <div class="training-edit-footer">
                        <a href="training.php" class="btn btn-modern-secondary">
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