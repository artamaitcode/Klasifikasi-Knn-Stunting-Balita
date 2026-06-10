<?php 
include "header.php";

if(!isset($_GET['kode_kriteria'])){
    header("location:kriteria.php");
    exit;
}

$kode_kriteria = mysql_real_escape_string($_GET['kode_kriteria']);

$query = mysql_query("SELECT * FROM tbl_kriteria WHERE kode_kriteria='$kode_kriteria'") or die(mysql_error());
$data = mysql_fetch_array($query);

if(!$data){
    header("location:kriteria.php");
    exit;
}

$q_subkriteria = mysql_query("SELECT COUNT(*) AS total FROM tbl_subkriteria WHERE kode_kriteria='$kode_kriteria'");
$d_subkriteria = mysql_fetch_array($q_subkriteria);

$q_total_kriteria = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$d_total_kriteria = mysql_fetch_array($q_total_kriteria);
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
                    <button type="button" class="btn btn-primary btn-block active">
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

            <div class="kriteria-edit-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Ubah Data Kriteria
                    </span>

                    <h2>Ubah Data Kriteria</h2>

                    <p>
                        Perbarui nama dan keterangan untuk kriteria
                        <b><?php echo $data['nama_kriteria']; ?></b>.
                    </p>
                </div>

                <a href="kriteria.php" class="btn btn-modern-secondary">
                    <span class="glyphicon glyphicon-arrow-left"></span> Kembali
                </a>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-purple">
                            <span class="glyphicon glyphicon-th-large"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $data['kode_kriteria']; ?></h3>
                            <p>Kode Kriteria</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-folder-open"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $d_total_kriteria['total']; ?></h3>
                            <p>Total Kriteria</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-green">
                            <span class="glyphicon glyphicon-th-list"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $d_subkriteria['total']; ?></h3>
                            <p>Sub Kriteria Terkait</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card kriteria-edit-card">

                <div class="modern-title-wrap">
                    <div>
                        <h4>Form Ubah Kriteria</h4>
                        <div class="modern-subtitle">
                            Update data kriteria utama yang dipakai dalam proses klasifikasi.
                        </div>
                    </div>
                </div>

                <div class="kriteria-edit-user-card">
                    <div class="kriteria-edit-avatar">
                        <span class="glyphicon glyphicon-th-large"></span>
                    </div>

                    <div class="kriteria-edit-user-info">
                        <h4><?php echo $data['nama_kriteria']; ?></h4>
                        <p>
                            <span class="badge-kode"><?php echo $data['kode_kriteria']; ?></span>
                            <span class="kriteria-edit-status">
                                <?php echo $d_subkriteria['total']; ?> sub kriteria terkait
                            </span>
                        </p>
                    </div>
                </div>

                <div class="kriteria-edit-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Perubahan nama kriteria akan berpengaruh pada tampilan kolom di data training, testing, dan proses
                    metode.
                </div>

                <form action="kriteria_proses.php?proses=prosesubah" method="post">

                    <div class="kriteria-edit-form-grid">

                        <div class="form-group kriteria-edit-field">
                            <label>Kode Kriteria</label>
                            <input name="kode_kriteria" type="text" class="form-control"
                                value="<?php echo $data['kode_kriteria']; ?>" readonly>
                        </div>

                        <div class="form-group kriteria-edit-field">
                            <label>Nama Kriteria</label>
                            <input name="nama_kriteria" type="text" class="form-control"
                                value="<?php echo $data['nama_kriteria']; ?>" autocomplete="off" required>
                        </div>

                    </div>

                    <div class="form-group kriteria-edit-description-field">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="5"
                            placeholder="Masukkan keterangan kriteria"
                            required><?php echo $data['keterangan']; ?></textarea>
                    </div>

                    <div class="kriteria-edit-footer">
                        <a href="kriteria.php" class="btn btn-modern-secondary">
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