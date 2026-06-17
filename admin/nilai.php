<?php
include "header.php";

if(!isset($_GET['kode_nama'])){
    header("location:training.php");
    exit;
}

$kode_nama = mysql_real_escape_string($_GET['kode_nama']);

$q_nama = mysql_query("SELECT * FROM tbl_namatraining WHERE kode_nama='$kode_nama'") or die(mysql_error());
$b = mysql_fetch_array($q_nama);

if(!$b){
    header("location:training.php");
    exit;
}

$kriteria_list = array();
$q_kriteria = mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria ASC");
while($k = mysql_fetch_array($q_kriteria)){
    $kriteria_list[] = $k;
}

$q_cek = mysql_query("SELECT * FROM tbl_training WHERE kode_nama='$kode_nama' LIMIT 1");
$cek_nilai = mysql_fetch_array($q_cek);

$total_kriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_kriteria");
$total_kriteria = mysql_fetch_array($total_kriteria_q);

$total_subkriteria_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_subkriteria");
$total_subkriteria = mysql_fetch_array($total_subkriteria_q);

$total_nilai_q = mysql_query("SELECT COUNT(*) AS total FROM tbl_training WHERE kode_nama='$kode_nama'");
$total_nilai = mysql_fetch_array($total_nilai_q);
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

            <div class="nilai-page-header">
                <div>
                    <span class="home-badge">
                        <span class="glyphicon glyphicon-list-alt"></span>
                        Detail Data Training
                    </span>

                    <h2>Nilai Training</h2>

                    <p>
                        Kelola nilai kriteria untuk data training bernama <b><?php echo $b['nama']; ?></b>.
                        Data ini akan menjadi acuan pada proses klasifikasi K-Nearest Neighbor.
                    </p>
                </div>

                <div class="nilai-header-action">
                    <a href="training.php" class="btn btn-modern-secondary">
                        <span class="glyphicon glyphicon-arrow-left"></span> Kembali
                    </a>

                    <?php if(empty($cek_nilai['kode_nama'])){ ?>
                    <button data-toggle="modal" data-target="#myModal" class="btn btn-modern-primary">
                        <span class="glyphicon glyphicon-plus"></span> Tambah Nilai
                    </button>
                    <?php } ?>
                </div>
            </div>

            <div class="row dashboard-summary">

                <div class="col-md-4 col-sm-6">
                    <div class="summary-card">
                        <div class="summary-icon summary-blue">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <div class="summary-info">
                            <h3><?php echo $b['kode_nama']; ?></h3>
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
                            <h3><?php echo $total_kriteria['total']; ?></h3>
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
                            <h3><?php echo $total_nilai['total']; ?></h3>
                            <p>Nilai Terisi</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modern-card">
                <div class="modern-title-wrap">
                    <div>
                        <h4>Data Training <?php echo $b['nama']; ?></h4>
                        <div class="modern-subtitle">
                            Detail nilai training berdasarkan kriteria dan keputusan akhir.
                        </div>
                    </div>

                    <?php if(!empty($cek_nilai['kode_nama'])){ ?>
                    <a href="nilai_aksi.php?kode_nama=<?php echo $b['kode_nama']; ?>&aksi=ubah"
                        class="btn btn-modern-primary">
                        <span class="glyphicon glyphicon-pencil"></span> Ubah Nilai
                    </a>
                    <?php } ?>
                </div>

                <div class="nilai-info-box">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    Setiap data training cukup memiliki satu set nilai. Jika data sudah ada, gunakan tombol ubah untuk
                    memperbarui nilai.
                </div>

                <div class="nilai-profile-card">
                    <div class="nilai-profile-avatar">
                        <?php echo strtoupper(substr($b['nama'], 0, 1)); ?>
                    </div>

                    <div class="nilai-profile-info">
                        <h4><?php echo $b['nama']; ?></h4>
                        <p>
                            <span class="badge-kode"><?php echo $b['kode_nama']; ?></span>
                            <span class="nilai-address"><?php echo $b['alamat']; ?></span>
                        </p>
                    </div>

                    <div class="nilai-profile-decision">
                        <?php
                        $decision_class = "hasil-badge-default";

                        if(strtoupper($b['keputusan']) == "LAYAK"){
                            $decision_class = "hasil-badge-layak";
                        } elseif(strtoupper($b['keputusan']) == "TIDAK LAYAK"){
                            $decision_class = "hasil-badge-tidak";
                        }
                        ?>

                        <span class="<?php echo $decision_class; ?>">
                            <?php echo $b['keputusan']; ?>
                        </span>
                    </div>
                </div>

                <div class="table-responsive modern-table nilai-table-wrap">
                    <table class="table table-bordered" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Training</th>

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
                            <?php if(!empty($cek_nilai['kode_nama'])){ ?>

                            <tr>
                                <td class="text-center">1</td>

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

                                <?php
                                foreach($kriteria_list as $kriteria){
                                    $kode_kriteria = $kriteria['kode_kriteria'];

                                    $q_nilai = mysql_query("SELECT nilai_training AS nilai 
                                        FROM tbl_training 
                                        WHERE kode_nama='$kode_nama' 
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
                                    <span class="<?php echo $decision_class; ?>">
                                        <?php echo $b['keputusan']; ?>
                                    </span>
                                </td>

                                <td class="text-center modern-action">
                                    <a href="nilai_aksi.php?kode_nama=<?php echo $b['kode_nama']; ?>&aksi=ubah"
                                        class="btn btn-modern-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>

                                    <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='nilai_proses.php?kode_nama=<?php echo $b['kode_nama']; ?>&proses=proseshapus' }"
                                        class="btn btn-modern-danger">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>

                            <?php } else { ?>

                            <tr>
                                <td colspan="<?php echo count($kriteria_list) + 4; ?>" class="text-center empty-state">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <h4>Nilai training belum diisi</h4>
                                    <p>Klik tombol Tambah Nilai untuk mengisi nilai kriteria pada data training ini.</p>

                                    <button data-toggle="modal" data-target="#myModal" class="btn btn-modern-primary">
                                        <span class="glyphicon glyphicon-plus"></span> Tambah Nilai
                                    </button>
                                </td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" style="color: white;" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>

                        <h5 class="modal-title">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Nilai Training
                        </h5>
                    </div>

                    <div class="modal-body">
                        <form action="nilai_proses.php?proses=prosestambah" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="kode_nama" value="<?php echo $b['kode_nama']; ?>">

                            <div class="nilai-modal-user">
                                <div class="nilai-profile-avatar small">
                                    <?php echo strtoupper(substr($b['nama'], 0, 1)); ?>
                                </div>

                                <div>
                                    <strong><?php echo $b['nama']; ?></strong>
                                    <small><?php echo $b['kode_nama']; ?> - <?php echo $b['alamat']; ?></small>
                                </div>
                            </div>

                            <div class="nilai-form-grid">
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

                            <div class="form-group">
                                <label>Keputusan</label>
                                <select name="keputusan" class="form-control" required>
                                    <option value="Stunting">Stunting</option>
                                    <option value="Tidak Stunting">Tidak Stunting</option>
                                </select>
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