<?php
include "header.php";

$per_hal = 100;

$filter_keputusan = "";
if(isset($_GET['keputusan']) && $_GET['keputusan'] != ""){
    $filter_keputusan = mysql_real_escape_string($_GET['keputusan']);
}

if($filter_keputusan != ""){
    $jumlah_record = mysql_query("SELECT COUNT(*) FROM tbl_hasil WHERE keputusan LIKE '$filter_keputusan'");
} else {
    $jumlah_record = mysql_query("SELECT COUNT(*) FROM tbl_hasil");
}

$jum = mysql_result($jumlah_record, 0);
$halaman = ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

if($page < 1){
    $page = 1;
}

$start = ($page - 1) * $per_hal;

$total_hasil_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_hasil");
$total_hasil = mysql_fetch_array($total_hasil_q);

$total_layak_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_hasil WHERE keputusan LIKE 'LAYAK' OR keputusan LIKE 'Layak'");
$total_layak = mysql_fetch_array($total_layak_q);

$total_tidak_layak_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_hasil WHERE keputusan LIKE 'TIDAK LAYAK' OR keputusan LIKE 'Tidak Layak'");
$total_tidak_layak = mysql_fetch_array($total_tidak_layak_q);
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
                    <button type="button" class="btn btn-primary btn-block active">
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

            <div class="hasil-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-stats"></span>
                        Hasil Klasifikasi
                    </span>

                    <h2>Hasil Analisa KNN</h2>

                    <p>
                        Daftar hasil klasifikasi metode K-Nearest Neighbor untuk prediksi stunting balita berdasarkan
                        data yang telah diproses.
                    </p>
                </div>

                <?php
                if($filter_keputusan != ""){
                    $tg = "laporan.php?keputusan=" . urlencode($filter_keputusan);
                } else {
                    $tg = "laporan.php";
                }
                ?>

                <!-- <a href="<?php echo $tg; ?>" target="_blank" class="btn btn-modern-primary">
                    <span class="glyphicon glyphicon-print"></span> Cetak Laporan
                </a> -->
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-folder-open"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_hasil['total']; ?></h3>
                            <p>Total Hasil</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-green">
                            <span class="glyphicon glyphicon-ok"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_layak['total']; ?></h3>
                            <p>Layak</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-orange">
                            <span class="glyphicon glyphicon-remove"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_tidak_layak['total']; ?></h3>
                            <p>Tidak Layak</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card">

                <div class="modern-title-wrap">
                    <div>
                        <h4>Daftar Hasil Klasifikasi</h4>
                        <div class="modern-subtitle">
                            Gunakan filter keputusan untuk melihat data berdasarkan kategori hasil.
                        </div>
                    </div>

                    <a href="metode.php" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-cog"></span> Proses Analisa Baru
                    </a>
                </div>

                <div class="hasil-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Data pada halaman ini berasal dari hasil analisa yang sudah disimpan dari halaman metode.
                </div>

                <div class="hasil-toolbar">
                    <form action="" method="get" class="hasil-filter-form">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-filter"></span>
                            </span>

                            <select name="keputusan" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Keputusan</option>

                                <option value="LAYAK" <?php if($filter_keputusan == "LAYAK"){ echo "selected"; } ?>>
                                    LAYAK
                                </option>

                                <option value="TIDAK LAYAK"
                                    <?php if($filter_keputusan == "TIDAK LAYAK"){ echo "selected"; } ?>>
                                    TIDAK LAYAK
                                </option>
                            </select>
                        </div>
                    </form>

                    <?php if($filter_keputusan != ""){ ?>
                    <a href="hasil.php" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-refresh"></span> Reset
                    </a>
                    <?php } ?>
                </div>

                <?php if($filter_keputusan != ""){ ?>
                <div class="hasil-filter-label">
                    Menampilkan data hasil klasifikasi:
                    <strong><?php echo $filter_keputusan; ?></strong>
                </div>
                <?php } else { ?>
                <div class="hasil-filter-label">
                    Menampilkan semua data hasil klasifikasi.
                </div>
                <?php } ?>

                <div class="table-responsive modern-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th class="text-center">Keputusan</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if($filter_keputusan != ""){
                                $brg = mysql_query("SELECT * FROM tbl_hasil 
                                    WHERE keputusan LIKE '$filter_keputusan'
                                    ORDER BY kode_hasil ASC 
                                    LIMIT $start, $per_hal");
                            } else {
                                $brg = mysql_query("SELECT * FROM tbl_hasil 
                                    ORDER BY kode_hasil ASC 
                                    LIMIT $start, $per_hal");
                            }

                            $no = $start + 1;

                            if(mysql_num_rows($brg) > 0){
                                while($b = mysql_fetch_array($brg)){
                                    $keputusan_class = "hasil-badge-default";

                                    if(strtoupper($b['keputusan']) == "LAYAK"){
                                        $keputusan_class = "hasil-badge-layak";
                                    } elseif(strtoupper($b['keputusan']) == "TIDAK LAYAK"){
                                        $keputusan_class = "hasil-badge-tidak";
                                    }
                            ?>

                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>

                                <td>
                                    <div class="hasil-user">
                                        <div class="hasil-avatar">
                                            <?php echo strtoupper(substr($b['nama'], 0, 1)); ?>
                                        </div>

                                        <div>
                                            <strong><?php echo $b['nama']; ?></strong>
                                            <small>Kode hasil: <?php echo $b['kode_hasil']; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <span class="<?php echo $keputusan_class; ?>">
                                        <?php echo $b['keputusan']; ?>
                                    </span>
                                </td>

                                <td class="text-center modern-action">
                                    <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hasil_hapus.php?kode_hasil=<?php echo $b['kode_hasil']; ?>' }"
                                        title="Delete" class="btn btn-modern-danger">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>

                            <?php
                                }
                            } else {
                            ?>

                            <tr>
                                <td colspan="4" class="text-center empty-state">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <h4>Data hasil belum tersedia</h4>
                                    <p>Silakan lakukan proses analisa pada halaman metode, lalu simpan hasilnya.</p>
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
                        if($filter_keputusan != ""){
                            $link = "?keputusan=" . urlencode($filter_keputusan) . "&page=" . $x;
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

    </div>
</div>