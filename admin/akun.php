<?php 
include 'header.php';

$username = mysql_real_escape_string($_SESSION['username']);

$det = mysql_query("SELECT * FROM tbl_akun WHERE username='$username'") or die(mysql_error());
$d = mysql_fetch_array($det);

if(!$d){
    header("location:index.php");
    exit;
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

            <div class="akun-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-user"></span>
                        Akun Saya
                    </span>

                    <h2>Informasi Akun</h2>

                    <p>
                        Kelola informasi akun administrator yang digunakan untuk masuk ke sistem klasifikasi KNN.
                    </p>
                </div>

                <a href="index.php" class="btn btn-modern-secondary">
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
                            <h3><?php echo $d['kode_akun']; ?></h3>
                            <p>Kode Akun</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-green">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>

                        <div class="summary-info">
                            <h3>Aktif</h3>
                            <p>Status Akun</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-purple">
                            <span class="glyphicon glyphicon-cog"></span>
                        </div>

                        <div class="summary-info">
                            <h3>Admin</h3>
                            <p>Hak Akses</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row akun-section">

                <div class="col-md-4">
                    <div class="modern-card akun-profile-card">

                        <div class="akun-avatar">
                            <?php echo strtoupper(substr($d['username'], 0, 1)); ?>
                        </div>

                        <h3><?php echo $d['nama_lengkap']; ?></h3>
                        <p class="akun-profile-subtitle">@<?php echo $d['username']; ?></p>

                        <div class="akun-profile-info">

                            <div class="akun-profile-item">
                                <span class="glyphicon glyphicon-credit-card"></span>
                                <div>
                                    <small>Kode Akun</small>
                                    <strong><?php echo $d['kode_akun']; ?></strong>
                                </div>
                            </div>

                            <div class="akun-profile-item">
                                <span class="glyphicon glyphicon-user"></span>
                                <div>
                                    <small>Username</small>
                                    <strong><?php echo $d['username']; ?></strong>
                                </div>
                            </div>

                            <div class="akun-profile-item">
                                <span class="glyphicon glyphicon-ok-circle"></span>
                                <div>
                                    <small>Status</small>
                                    <strong>Akun Aktif</strong>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-8">
                    <div class="modern-card akun-form-card">

                        <div class="modern-title-wrap">
                            <div>
                                <h4>Ubah Data Akun</h4>
                                <div class="modern-subtitle">
                                    Perbarui nama lengkap, username, dan password akun.
                                </div>
                            </div>
                        </div>

                        <div class="akun-info-box">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            Setelah username atau password diubah, gunakan data terbaru saat login berikutnya.
                        </div>

                        <form action="akun_proses.php" method="post" enctype="multipart/form-data">

                            <input type="hidden" class="form-control" name="kode_akun"
                                value="<?php echo $d['kode_akun']; ?>">

                            <div class="akun-form-grid">

                                <div class="form-group akun-form-field">
                                    <label>Nama Lengkap</label>
                                    <div class="akun-input-icon">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <input type="text" class="form-control" name="nama_lengkap"
                                            value="<?php echo $d['nama_lengkap']; ?>" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group akun-form-field">
                                    <label>Username</label>
                                    <div class="akun-input-icon">
                                        <span class="glyphicon glyphicon-tag"></span>
                                        <input type="text" class="form-control" name="username"
                                            value="<?php echo $d['username']; ?>" autocomplete="off" required>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group akun-form-field akun-password-field">
                                <label>Password</label>

                                <div class="akun-input-icon akun-password-wrap">
                                    <span class="glyphicon glyphicon-lock"></span>

                                    <input type="password" class="form-control" name="password" id="passwordAkun"
                                        value="<?php echo $d['password']; ?>" autocomplete="off" required>

                                    <button type="button" class="akun-password-toggle" onclick="togglePasswordAkun()">
                                        <span class="glyphicon glyphicon-eye-open" id="passwordAkunIcon"></span>
                                    </button>
                                </div>
                            </div>

                            <div class="akun-warning-box">
                                <span class="glyphicon glyphicon-warning-sign"></span>
                                Simpan perubahan hanya jika data sudah benar.
                            </div>

                            <div class="akun-form-footer">
                                <a href="index.php" type="button" class="btn btn-modern-secondary">
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

    </div>
</div>

<script>
function togglePasswordAkun() {
    var password = document.getElementById("passwordAkun");
    var icon = document.getElementById("passwordAkunIcon");

    if (password.type === "password") {
        password.type = "text";
        icon.className = "glyphicon glyphicon-eye-close";
    } else {
        password.type = "password";
        icon.className = "glyphicon glyphicon-eye-open";
    }
}
</script>

<?php include 'footer2.php'; ?>