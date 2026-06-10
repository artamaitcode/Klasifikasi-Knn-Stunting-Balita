<?php
include "header.php";

$total_testing_q = mysql_query("SELECT COUNT(DISTINCT kode_nama) AS total FROM tbl_testing");
$total_testing = mysql_fetch_array($total_testing_q);

$total_kriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$total_kriteria = mysql_fetch_array($total_kriteria_q);

$total_subkriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_subkriteria");
$total_subkriteria = mysql_fetch_array($total_subkriteria_q);

$kriteria_list = array();
$q_kriteria = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");
while($k = mysql_fetch_array($q_kriteria)){
    $kriteria_list[] = $k;
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

            <div class="testing-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-check"></span>
                        Data Uji Klasifikasi
                    </span>

                    <h2>Data Testing</h2>

                    <p>
                        Kelola data testing yang akan diproses menggunakan metode K-Nearest Neighbor untuk prediksi
                        stunting balita.
                    </p>
                </div>

                <button data-toggle="modal" data-target="#myModal" class="btn btn-modern-primary">
                    <span class="glyphicon glyphicon-plus"></span> Tambah Data
                </button>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-check"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $total_testing['total']; ?></h3>
                            <p>Total Data Testing</p>
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

            </div>

            <div class="modern-card">
                <div class="modern-title-wrap">
                    <div>
                        <h4>Daftar Data Testing</h4>
                        <div class="modern-subtitle">
                            Data baru yang akan dibandingkan dengan data training berdasarkan nilai kriteria.
                        </div>
                    </div>

                    <a href="metode.php" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-cog"></span> Proses Metode
                    </a>
                </div>

                <div class="testing-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Pastikan data kriteria dan sub kriteria sudah lengkap sebelum menambahkan data testing.
                </div>

                <div class="table-responsive modern-table testing-table-wrap">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode</th>
                                <th>Nama Testing</th>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    echo "<th class='text-center'>".$kriteria['nama_kriteria']."</th>";
                                }
                                ?>

                                <th class="text-center">Keputusan</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $data = mysql_query("SELECT kode_nama, nama FROM tbl_testing GROUP BY kode_nama ORDER BY kode_nama ASC");
                            $no = 1;

                            if(mysql_num_rows($data) > 0){
                                while($a = mysql_fetch_array($data)){
                                    $kode = $a['kode_nama'];
                                    $nama = $a['nama'];
                            ?>

                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>

                                <td class="text-center">
                                    <span class="badge-kode"><?php echo $kode; ?></span>
                                </td>

                                <td>
                                    <div class="training-user">
                                        <div class="training-avatar">
                                            <?php echo strtoupper(substr($nama, 0, 1)); ?>
                                        </div>

                                        <div>
                                            <strong><?php echo $nama; ?></strong>
                                            <small>Kode: <?php echo $kode; ?></small>
                                        </div>
                                    </div>
                                </td>

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    $kode_kriteria = $kriteria['kode_kriteria'];

                                    $q_nilai = mysql_query("SELECT nilai_testing AS nilai 
                                        FROM tbl_testing 
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
                                    <span class="badge-keputusan">?</span>
                                </td>

                                <td class="text-center modern-action">
                                    <a href="testing_aksi.php?kode_nama=<?php echo $kode; ?>&nama=<?php echo urlencode($nama); ?>&aksi=ubah"
                                        class="btn btn-modern-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='testing_proses.php?kode_nama=<?php echo $kode; ?>&proses=proseshapus' }"
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
                                <td colspan="<?php echo count($kriteria_list) + 5; ?>" class="text-center empty-state">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <h4>Data testing masih kosong</h4>
                                    <p>Silakan tambahkan data testing baru untuk memulai proses klasifikasi.</p>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <?php
        $carikode = mysql_query("SELECT MAX(CAST(SUBSTRING(kode_nama, 3) AS UNSIGNED)) AS max_kode FROM tbl_testing") or die(mysql_error());
        $datakode = mysql_fetch_assoc($carikode);

        if ($datakode && $datakode['max_kode'] !== null) {
            $nilaikode = (int)$datakode['max_kode'];
            $nilaikode++;
            $kode_otomatis = "AE" . str_pad($nilaikode, 2, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "AE01";
        }
        ?>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" style="color: white;" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>

                        <h5 class="modal-title">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Data Testing
                        </h5>
                    </div>

                    <div class="modal-body">
                        <form action="testing_proses.php?proses=prosestambah" method="post"
                            enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Kode Testing</label>
                                <input type="text" name="kode_nama" class="form-control"
                                    value="<?php echo $kode_otomatis; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Nama Testing</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama testing"
                                    autocomplete="off" required>
                            </div>

                            <div class="testing-form-grid">
                                <?php
                                $hasil = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");

                                while ($baris = mysql_fetch_array($hasil)) {
                                    $idK = $baris['kode_kriteria'];
                                    $labelK = $baris['nama_kriteria'];

                                    echo "<div class='form-group'>";
                                    echo "<label>".$labelK."</label>";
                                    echo "<select name='".$idK."' class='form-control' required>";
                                    echo "<option value=''>Pilih ".$labelK."</option>";

                                    $hasil2 = mysql_query("SELECT * FROM tbl_subkriteria 
                                        WHERE kode_kriteria='".$idK."' 
                                        ORDER BY nilai_subkriteria DESC");

                                    while ($baris2 = mysql_fetch_array($hasil2)) {
                                        echo "<option value='".$baris2['nilai_subkriteria']."'>";
                                        echo $baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")";
                                        echo "</option>";
                                    }

                                    echo "</select>";
                                    echo "</div>";
                                }
                                ?>
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