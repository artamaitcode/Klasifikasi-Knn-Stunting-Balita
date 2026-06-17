<?php
include "header.php";

$per_hal = 20;

if(isset($_GET['cari'])){
    $cari = mysql_real_escape_string($_GET['cari']);
    $jumlah_record = mysql_query("SELECT COUNT(*) FROM tbl_namatraining 
        WHERE nama LIKE '%$cari%' 
        OR alamat LIKE '%$cari%' 
        OR kode_nama LIKE '%$cari%'");
} else {
    $jumlah_record = mysql_query("SELECT COUNT(*) FROM tbl_namatraining");
}

$jum = mysql_result($jumlah_record, 0);
$halaman = ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
if($page < 1){
    $page = 1;
}
$start = ($page - 1) * $per_hal;

$total_training_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_namatraining");
$total_training = mysql_fetch_array($total_training_q);

$sudah_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_namatraining WHERE keputusan!='?' AND keputusan!=''");
$sudah = mysql_fetch_array($sudah_q);

$belum_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_namatraining WHERE keputusan='?' OR keputusan=''");
$belum = mysql_fetch_array($belum_q);

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

            <div class="training-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        Master Data
                    </span>
                    <h2>Data Training</h2>
                    <p>Kelola data training sebagai data acuan dalam proses klasifikasi metode K-Nearest Neighbor.</p>
                </div>

                <div>
                    <button data-toggle="modal" data-target="#modalImportCSV" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-upload"></span> Import CSV
                    </button>
                    <button data-toggle="modal" data-target="#modalHapusSemua" class="btn btn-modern-danger">
                        <span class="glyphicon glyphicon-trash"></span> Hapus Semua
                    </button>

                    <button data-toggle="modal" data-target="#myModal" class="btn btn-modern-primary">
                        <span class="glyphicon glyphicon-plus"></span> Tambah Data
                    </button>
                </div>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_training['total']; ?></h3>
                            <p>Total Data Training</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-green">
                            <span class="glyphicon glyphicon-ok"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $sudah['total']; ?></h3>
                            <p>Sudah Ada Keputusan</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-orange">
                            <span class="glyphicon glyphicon-time"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $belum['total']; ?></h3>
                            <p>Belum Ada Keputusan</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card">
                <div class="modern-title-wrap">
                    <div>
                        <h4>Daftar Data Training</h4>
                        <div class="modern-subtitle">
                            Data yang digunakan sebagai pembanding untuk proses klasifikasi.
                        </div>
                    </div>
                </div>

                <div class="training-toolbar">
                    <form action="training_proses.php?proses=prosescari" method="post" class="modern-search">
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control"
                                placeholder="Cari kode, nama, atau alamat..."
                                value="<?php if(isset($_GET['cari'])){ echo $_GET['cari']; } ?>" autocomplete="off">

                            <span class="input-group-btn">
                                <button class="btn btn-modern-primary" type="submit">
                                    <span class="glyphicon glyphicon-search"></span> Cari
                                </button>
                            </span>
                        </div>
                    </form>

                    <?php if(isset($_GET['cari'])){ ?>
                    <a href="training.php" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                    </a>
                    <?php if(isset($_GET['hapussemua']) && $_GET['hapussemua']=="berhasil"){ ?>
                    <div class="alert alert-danger" style="margin-top:15px;">
                        Semua data training berhasil dihapus.
                    </div>
                    <?php } ?>
                    <?php if(isset($_GET['import'])){ ?>
                    <div class="alert alert-info" style="margin-top:15px;">
                        Import CSV selesai. Berhasil: <?php echo (int)$_GET['sukses']; ?> data,
                        Gagal: <?php echo (int)$_GET['gagal']; ?> data.
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>

                <div class="table-responsive modern-table">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th class="text-center">Training</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if(isset($_GET['cari'])){
                                $cari = mysql_real_escape_string($_GET['cari']);
                                $brg = mysql_query("SELECT * FROM tbl_namatraining 
                                    WHERE nama LIKE '%$cari%' 
                                    OR alamat LIKE '%$cari%' 
                                    OR kode_nama LIKE '%$cari%'
                                    ORDER BY kode_nama ASC 
                                    LIMIT $start, $per_hal");
                            } else {
                                $brg = mysql_query("SELECT * FROM tbl_namatraining 
                                    ORDER BY kode_nama ASC 
                                    LIMIT $start, $per_hal");
                            }

                            $no = $start + 1;

                            if(mysql_num_rows($brg) > 0){
                                while($b = mysql_fetch_array($brg)){
                            ?>

                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>

                                <td class="text-center">
                                    <span class="badge-kode"><?php echo $b['kode_nama']; ?></span>
                                </td>

                                <td>
                                    <div class="training-user">
                                        <div class="training-avatar">
                                            <?php echo strtoupper(substr($b['nama'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <strong><?php echo $b['nama']; ?></strong>
                                            <small>Kode: <?php echo $b['kode_nama']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td><?php echo $b['alamat']; ?></td>

                                <td class="text-center">
                                    <a href="nilai.php?kode_nama=<?php echo $b['kode_nama']; ?>"
                                        class="btn btn-modern-success">
                                        <span class="glyphicon glyphicon-eye-open"></span> Nilai
                                    </a>
                                </td>

                                <td class="text-center modern-action">
                                    <a href="training_aksi.php?kode_nama=<?php echo $b['kode_nama']; ?>&aksi=ubah"
                                        class="btn btn-modern-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='training_proses.php?kode_nama=<?php echo $b['kode_nama']; ?>&proses=proseshapus' }"
                                        class="btn btn-modern-danger">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>

                            <?php
                                }
                            } else {
                            ?>

                            <tr>
                                <td colspan="6" class="text-center empty-state">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <h4>Data tidak ditemukan</h4>
                                    <p>Belum ada data training yang sesuai dengan pencarian.</p>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php if($halaman > 1){ ?>
                <ul class="pagination modern-pagination">
                    <?php
                    for($x = 1; $x <= $halaman; $x++){
                        if(isset($_GET['cari'])){
                            $link = "?cari=" . urlencode($_GET['cari']) . "&page=" . $x;
                        } else {
                            $link = "?page=" . $x;
                        }
                    ?>
                    <li class="<?php if($page == $x){ echo 'active'; } ?>">
                        <a href="<?php echo $link; ?>"><?php echo $x; ?></a>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
        </div>

        <?php
        $carikode = mysql_query("SELECT MAX(CAST(SUBSTRING(kode_nama, 3) AS UNSIGNED)) AS max_kode FROM tbl_namatraining") or die(mysql_error());
        $datakode = mysql_fetch_assoc($carikode);

        if ($datakode && $datakode['max_kode'] !== null) {
            $nilaikode = (int)$datakode['max_kode'];
            $nilaikode++;
            $kode_otomatis = "AB" . str_pad($nilaikode, 3, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "AB001";
        }
        ?>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" style="color: white;" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>

                        <h5 class="modal-title">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Data Training
                        </h5>
                    </div>

                    <div class="modal-body">
                        <form action="training_proses.php?proses=prosestambah" method="post"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Kode Training</label>
                                <input name="kode_nama" type="text" class="form-control"
                                    value="<?php echo $kode_otomatis; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Nama Training</label>
                                <input name="nama" type="text" class="form-control" placeholder="Masukkan nama"
                                    autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input name="alamat" type="text" class="form-control" placeholder="Masukkan alamat"
                                    autocomplete="off" required>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                                    Batal
                                </button>

                                <input type="submit" class="btn btn-modern-primary" name="SIMPAN" value="SIMPAN">
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div id="modalImportCSV" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" style="color: white;" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>

                        <h5 class="modal-title">
                            <span class="glyphicon glyphicon-upload"></span> Import Data Training CSV
                        </h5>
                    </div>

                    <div class="modal-body">
                        <form action="training_proses.php?proses=prosesimportcsv" method="post"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label>File CSV</label>
                                <input type="file" name="file_csv" class="form-control" accept=".csv" required>
                                <small>
                                    Format kolom:
                                    kode_nama;nama;alamat;jenis_kelamin;berat_lahir;umur;tb_lahir;lingkar_badan;lingkar_lengan;keputusan
                                </small>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                                    Batal
                                </button>

                                <button type="submit" class="btn btn-modern-primary">
                                    <span class="glyphicon glyphicon-upload"></span> IMPORT
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div id="modalHapusSemua" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header" style="background:#dc2626;">
                        <button type="button" style="color: white;" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>

                        <h5 class="modal-title">
                            <span class="glyphicon glyphicon-warning-sign"></span> Hapus Semua Data Training
                        </h5>
                    </div>

                    <div class="modal-body">
                        <p style="font-size:16px;">
                            Apakah Anda yakin ingin menghapus semua data training?
                        </p>

                        <p style="color:#dc2626; font-weight:bold;">
                            Data pada tabel nama training dan nilai kriteria akan terhapus permanen.
                        </p>

                        <form action="training_proses.php?proses=hapussemua" method="post">
                            <input type="hidden" name="konfirmasi_hapus" value="YA">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-modern-secondary" data-dismiss="modal">
                                    Batal
                                </button>

                                <button type="submit" class="btn btn-modern-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Ya, Hapus Semua
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>