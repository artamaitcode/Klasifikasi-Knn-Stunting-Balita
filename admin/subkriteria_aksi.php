<?php 
include "header.php";

if(!isset($_GET['kode_subkriteria'])){
    header("location:subkriteria.php");
    exit;
}

$kode_subkriteria = mysql_real_escape_string($_GET['kode_subkriteria']);

$query = mysql_query("SELECT tbl_subkriteria.*, tbl_kriteria.nama_kriteria 
    FROM tbl_subkriteria 
    LEFT JOIN tbl_kriteria ON tbl_subkriteria.kode_kriteria = tbl_kriteria.kode_kriteria
    WHERE tbl_subkriteria.kode_subkriteria='$kode_subkriteria'") or die(mysql_error());

$data = mysql_fetch_array($query);

if(!$data){
    header("location:subkriteria.php");
    exit;
}

$q_total_kriteria = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$d_total_kriteria = mysql_fetch_array($q_total_kriteria);

$q_total_subkriteria = mysql_query("SELECT COUNT(*) AS total FROM tbl_subkriteria");
$d_total_subkriteria = mysql_fetch_array($q_total_subkriteria);

$q_sub_terkait = mysql_query("SELECT COUNT(*) AS total FROM tbl_subkriteria WHERE kode_kriteria='".$data['kode_kriteria']."'");
$d_sub_terkait = mysql_fetch_array($q_sub_terkait);
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
                    <button type="button" class="btn btn-primary btn-block active">
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

            <div class="subkriteria-edit-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-pencil"></span>
                        Ubah Data Sub Kriteria
                    </span>

                    <h2>Ubah Data Sub Kriteria</h2>

                    <p>
                        Perbarui nama, kriteria induk, dan nilai untuk sub kriteria
                        <b><?php echo $data['nama_subkriteria']; ?></b>.
                    </p>
                </div>

                <a href="subkriteria.php" class="btn btn-modern-secondary">
                    <span class="glyphicon glyphicon-arrow-left"></span> Kembali
                </a>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-purple">
                            <span class="glyphicon glyphicon-th-list"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $data['kode_subkriteria']; ?></h3>
                            <p>Kode Sub Kriteria</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-th-large"></span>
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
                            <span class="glyphicon glyphicon-signal"></span>
                        </div>

                        <div class="summary-info">
                            <h3><?php echo $data['nilai_subkriteria']; ?></h3>
                            <p>Nilai Saat Ini</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card subkriteria-edit-card">

                <div class="modern-title-wrap">
                    <div>
                        <h4>Form Ubah Sub Kriteria</h4>
                        <div class="modern-subtitle">
                            Update data sub kriteria yang digunakan sebagai pilihan nilai pada data training dan
                            testing.
                        </div>
                    </div>
                </div>

                <div class="subkriteria-edit-user-card">
                    <div class="subkriteria-edit-avatar">
                        <span class="glyphicon glyphicon-th-list"></span>
                    </div>

                    <div class="subkriteria-edit-user-info">
                        <h4><?php echo $data['nama_subkriteria']; ?></h4>
                        <p>
                            <span class="badge-kode"><?php echo $data['kode_subkriteria']; ?></span>
                            <span class="subkriteria-edit-status">
                                <?php echo $data['kode_kriteria']; ?> - <?php echo $data['nama_kriteria']; ?>
                            </span>
                        </p>
                    </div>

                    <div class="subkriteria-edit-value">
                        <span class="badge-nilai"><?php echo $data['nilai_subkriteria']; ?></span>
                    </div>
                </div>

                <div class="subkriteria-edit-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Perubahan nilai sub kriteria dapat mempengaruhi input data training, data testing, dan hasil
                    klasifikasi KNN.
                </div>

                <form action="subkriteria_proses.php?proses=prosesubah" method="post">

                    <div class="subkriteria-edit-form-grid">

                        <div class="form-group subkriteria-edit-field">
                            <label>Kode Sub Kriteria</label>
                            <input name="kode_subkriteria" type="text" class="form-control"
                                value="<?php echo $data['kode_subkriteria']; ?>" readonly>
                        </div>

                        <div class="form-group subkriteria-edit-field">
                            <label>Nama Sub Kriteria</label>
                            <input name="nama_subkriteria" type="text" class="form-control"
                                value="<?php echo $data['nama_subkriteria']; ?>" autocomplete="off" required>
                        </div>

                    </div>

                    <div class="subkriteria-edit-form-grid second">

                        <div class="form-group subkriteria-edit-field">
                            <label>Kriteria</label>

                            <select name="kode_kriteria" class="form-control" required>
                                <option value="">Pilih Kriteria</option>

                                <?php 
                                $kriteria = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");

                                while($k = mysql_fetch_array($kriteria)){
                                    $selected = "";

                                    if($data['kode_kriteria'] == $k['kode_kriteria']){
                                        $selected = "selected";
                                    }
                                ?>

                                <option value="<?php echo $k['kode_kriteria']; ?>" <?php echo $selected; ?>>
                                    <?php echo $k['kode_kriteria']; ?> - <?php echo $k['nama_kriteria']; ?>
                                </option>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group subkriteria-edit-field">
                            <label>Nilai Sub Kriteria</label>
                            <input name="nilai_subkriteria" type="number" class="form-control"
                                value="<?php echo $data['nilai_subkriteria']; ?>" autocomplete="off" required>
                        </div>

                    </div>

                    <div class="subkriteria-related-box">
                        <span class="glyphicon glyphicon-link"></span>
                        Kriteria <b><?php echo $data['nama_kriteria']; ?></b> saat ini memiliki
                        <b><?php echo $d_sub_terkait['total']; ?></b> sub kriteria.
                    </div>

                    <div class="subkriteria-edit-footer">
                        <a href="subkriteria.php" class="btn btn-modern-secondary">
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