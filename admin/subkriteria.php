<?php 
include "header.php";

$per_hal = 20;

if(isset($_GET['cari'])){
    $cari = mysql_real_escape_string($_GET['cari']);

    $jumlah_record = mysql_query("SELECT COUNT(*) FROM tbl_subkriteria 
        LEFT JOIN tbl_kriteria ON tbl_subkriteria.kode_kriteria = tbl_kriteria.kode_kriteria
        WHERE tbl_subkriteria.kode_subkriteria LIKE '%$cari%'
        OR tbl_subkriteria.nama_subkriteria LIKE '%$cari%'
        OR tbl_kriteria.nama_kriteria LIKE '%$cari%'
        OR tbl_subkriteria.nilai_subkriteria LIKE '%$cari%'");
} else {
    $jumlah_record = mysql_query("SELECT COUNT(*) FROM tbl_subkriteria");
}

$jum = mysql_result($jumlah_record, 0);
$halaman = ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$start = ($page - 1) * $per_hal;

$total_subkriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_subkriteria");
$total_subkriteria = mysql_fetch_array($total_subkriteria_q);

$total_kriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$total_kriteria = mysql_fetch_array($total_kriteria_q);

$nilai_tertinggi_q = mysql_query("SELECT MAX(nilai_subkriteria) AS nilai FROM tbl_subkriteria");
$nilai_tertinggi = mysql_fetch_array($nilai_tertinggi_q);

if($nilai_tertinggi['nilai'] == ""){
    $nilai_tertinggi['nilai'] = 0;
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

            <div class="subkriteria-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-th-list"></span>
                        Master Sub Kriteria
                    </span>

                    <h2>Data Sub Kriteria</h2>

                    <p>
                        Kelola pilihan sub kriteria dan nilai yang digunakan untuk proses input data training serta data
                        testing.
                    </p>
                </div>

                <button data-toggle="modal" data-target="#myModal" class="btn btn-modern-primary">
                    <span class="glyphicon glyphicon-plus"></span> Tambah Data
                </button>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-purple">
                            <span class="glyphicon glyphicon-th-list"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_subkriteria['total']; ?></h3>
                            <p>Total Sub Kriteria</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-th-large"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_kriteria['total']; ?></h3>
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
                            <h3><?php echo $nilai_tertinggi['nilai']; ?></h3>
                            <p>Nilai Tertinggi</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card">
                <div class="modern-title-wrap">
                    <div>
                        <h4>Daftar Data Sub Kriteria</h4>
                        <div class="modern-subtitle">
                            Sub kriteria digunakan sebagai pilihan nilai pada setiap kriteria.
                        </div>
                    </div>

                    <a href="kriteria.php" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-th-large"></span> Lihat Kriteria
                    </a>
                </div>

                <div class="subkriteria-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Pastikan setiap sub kriteria berada pada kriteria yang benar agar nilai training dan testing tidak
                    salah arah.
                </div>

                <div class="training-toolbar">
                    <form action="subkriteria_proses.php?proses=prosescari" method="post" class="modern-search">
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control"
                                placeholder="Cari kode, nama sub kriteria, kriteria, atau nilai..."
                                value="<?php if(isset($_GET['cari'])){ echo htmlspecialchars($_GET['cari']); } ?>"
                                autocomplete="off">

                            <span class="input-group-btn">
                                <button class="btn btn-modern-primary" type="submit">
                                    <span class="glyphicon glyphicon-search"></span> Cari
                                </button>
                            </span>
                        </div>
                    </form>

                    <?php if(isset($_GET['cari'])){ ?>
                    <a href="subkriteria.php" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                    </a>
                    <?php } ?>
                </div>

                <div class="table-responsive modern-table">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th>Nama Sub Kriteria</th>
                                <th>Kriteria</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            if(isset($_GET['cari'])){
                                $cari = mysql_real_escape_string($_GET['cari']);

                                $data = mysql_query("SELECT tbl_subkriteria.*, tbl_kriteria.nama_kriteria 
                                    FROM tbl_subkriteria 
                                    LEFT JOIN tbl_kriteria ON tbl_subkriteria.kode_kriteria = tbl_kriteria.kode_kriteria
                                    WHERE tbl_subkriteria.kode_subkriteria LIKE '%$cari%'
                                    OR tbl_subkriteria.nama_subkriteria LIKE '%$cari%'
                                    OR tbl_kriteria.nama_kriteria LIKE '%$cari%'
                                    OR tbl_subkriteria.nilai_subkriteria LIKE '%$cari%'
                                    ORDER BY tbl_subkriteria.kode_subkriteria ASC
                                    LIMIT $start, $per_hal");
                            } else {
                                $data = mysql_query("SELECT tbl_subkriteria.*, tbl_kriteria.nama_kriteria 
                                    FROM tbl_subkriteria 
                                    LEFT JOIN tbl_kriteria ON tbl_subkriteria.kode_kriteria = tbl_kriteria.kode_kriteria
                                    ORDER BY tbl_subkriteria.kode_subkriteria ASC 
                                    LIMIT $start, $per_hal");
                            }

                            $no = $start + 1;

                            if(mysql_num_rows($data) > 0){
                                while($d = mysql_fetch_array($data)){
                            ?>

                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>

                                <td class="text-center">
                                    <span class="badge-kode"><?php echo $d['kode_subkriteria']; ?></span>
                                </td>

                                <td>
                                    <div class="subkriteria-name">
                                        <div class="subkriteria-icon">
                                            <span class="glyphicon glyphicon-th-list"></span>
                                        </div>

                                        <div>
                                            <strong><?php echo $d['nama_subkriteria']; ?></strong>
                                            <small>Kode: <?php echo $d['kode_subkriteria']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="kriteria-pill">
                                        <?php echo $d['kode_kriteria']; ?> - <?php echo $d['nama_kriteria']; ?>
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="badge-nilai"><?php echo $d['nilai_subkriteria']; ?></span>
                                </td>

                                <td class="text-center modern-action">
                                    <a href="subkriteria_aksi.php?kode_subkriteria=<?php echo $d['kode_subkriteria']; ?>&aksi=ubah"
                                        class="btn btn-modern-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='subkriteria_proses.php?kode_subkriteria=<?php echo $d['kode_subkriteria']; ?>&proses=proseshapus' }"
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
                                    <h4>Data sub kriteria tidak ditemukan</h4>
                                    <p>Silakan tambahkan data sub kriteria baru atau gunakan kata kunci pencarian lain.
                                    </p>
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
        $carikode = mysql_query("SELECT MAX(CAST(SUBSTRING(kode_subkriteria, 2) AS UNSIGNED)) AS max_kode FROM tbl_subkriteria") or die(mysql_error());
        $datakode = mysql_fetch_assoc($carikode);

        if ($datakode && $datakode['max_kode'] !== null) {
            $nilaikode = (int)$datakode['max_kode'];
            $nilaikode++;
            $kode_otomatis = "S" . str_pad($nilaikode, 2, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "S01";
        }
        ?>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" style="color: white;" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>

                        <h5 class="modal-title">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Data Sub Kriteria
                        </h5>
                    </div>

                    <div class="modal-body">
                        <form action="subkriteria_proses.php?proses=prosestambah" method="post"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Kode Sub Kriteria</label>
                                <input name="kode_subkriteria" type="text" class="form-control"
                                    value="<?php echo $kode_otomatis; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Nama Sub Kriteria</label>
                                <input name="nama_subkriteria" type="text" class="form-control"
                                    placeholder="Masukkan nama sub kriteria" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label>Kriteria</label>
                                <select name="kode_kriteria" class="form-control" required>
                                    <option value="">Pilih Kriteria</option>

                                    <?php 
                                    $kriteria = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");
                                    while($k = mysql_fetch_array($kriteria)){
                                    ?>

                                    <option value="<?php echo $k['kode_kriteria']; ?>">
                                        <?php echo $k['kode_kriteria']; ?> - <?php echo $k['nama_kriteria']; ?>
                                    </option>

                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nilai Sub Kriteria</label>
                                <input name="nilai_subkriteria" type="number" class="form-control"
                                    placeholder="Masukkan nilai sub kriteria" autocomplete="off" required>
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

    </div>
</div>