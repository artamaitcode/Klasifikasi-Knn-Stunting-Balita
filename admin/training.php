<?php
include "header.php";
?>

<div class="container-fluid text-center">
    <div class="row content">
    <div class="col-sm-2 sidenav">
        <p><a href="index.php"><button type="button" class="btn btn-primary btn-block">BERANDA</button></a>
        </p>
        <p><a href="training.php"><button type="button" class="btn btn-primary btn-block active">DATA
                    TRAINING</button></a>
        </p>
        <p><a href="testing.php"><button type="button" class="btn btn-primary btn-block">DATA TESTING</button></a>
        </p>
        <p><a href="metode.php"><button type="button" class="btn btn-primary btn-block">METODE</button></a></p>
        <p><a href="hasil.php"><button type="button" class="btn btn-primary btn-block">HASIL ANALISA</button></a>
        <p><a href="about.php"><button type="button" class="btn btn-primary btn-block">ABOUT</button></a>
        </p>
    </div>

    <div class="col-sm-8 text-left">
        <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 5px #888888;">
            <div class="bootstrap-table">
                <h4>Data Training</h4>
                <hr>
            </div>
            <hr>
            <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal"
                class="btn btn-default col-md-2"><span class="glyphicon glyphicon-plus"></span>&emsp; TAMBAH
                DATA</button>
            <br>
            <!-- <hr>
            <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal"
                class="btn btn-default col-md-2"><span class="glyphicon glyphicon-plus"></span>&emsp; IMPORT
                DATA</button>
            <br> -->
            <br>


            <?php 
				$per_hal=20;
				$jumlah_record=mysql_query("SELECT COUNT(*) from tbl_namatraining");
				$jum=mysql_result($jumlah_record, 0);
				$halaman=ceil($jum / $per_hal);
				$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
				$start = ($page - 1) * $per_hal;
				?>
            <br>

            <div class="table-responsive">
                <table class="table table-bordered thead-dark" id="table">
                    <thead class="thead-dark">
                        <tr style="box-shadow: 2px 2px 4px #888888;">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Training</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
							if(isset($_GET['cari'])){
								$cari=mysql_real_escape_string($_GET['cari']);
								$brg=mysql_query("select * from tbl_namatraining where nama like '$cari'");
							}else{
								$brg=mysql_query("SELECT * FROM tbl_namatraining order by kode_nama asc limit $start, $per_hal");
							}
							$no=1;
							while($b=mysql_fetch_array($brg)){

								?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><?php echo $b['nama'] ?></td>
                            <td><?php echo $b['alamat'] ?></td>

                            <td class="text-center">
                                <a href="nilai.php?kode_nama=<?php echo $b['kode_nama']; ?>"
                                    class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span></a>
                            </td>

                            <td class="text-center">
                                <a href="training_aksi.php?kode_nama=<?php echo $b['kode_nama']; ?>&aksi=ubah"
                                    class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>

                                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='training_proses.php?kode_nama=<?php echo $b['kode_nama']; ?>&proses=proseshapus' }"
                                    class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        <?php 
							}
							?>
                    </tbody>
                </table>
            </div>
            <ul class="pagination">
                <?php 
					for($x=1;$x<=$halaman;$x++){
						?>
                <li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
                <?php
					}
					?>
            </ul>
        </div>
    </div>
    <!-- modal input -->
    <?php 
// Query untuk mendapatkan nilai maksimum dari substring kode_nama
$carikode = mysql_query("SELECT MAX(CAST(SUBSTRING(kode_nama, 3) AS UNSIGNED)) AS max_kode FROM tbl_namatraining") or die(mysql_error());

// Mengambil hasil query sebagai array asosiatif
$datakode = mysql_fetch_assoc($carikode);

// Memeriksa apakah ada hasil yang ditemukan
if ($datakode && $datakode['max_kode'] !== null) {
    // Mendapatkan nilai max_kode
    $nilaikode = (int)$datakode['max_kode'];
    // Menambahkan nilai tersebut dengan 1
    $nilaikode++;
    // Menghasilkan kode baru dengan menambahkan nol di depan agar selalu tiga digit
    $kode_otomatis = "AB" . str_pad($nilaikode, 3, "0", STR_PAD_LEFT);
} else {
    // Jika tidak ada hasil, memulai dengan AB001
    $kode_otomatis = "AB001";
}

// // Menampilkan kode otomatis
// echo $kode_otomatis;
?>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-image: linear-gradient(to right, #232526, #414345);">
                    <button type="button" style="color: white;" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                    <h5 class="modal-title">
                        <font color="white">Tambah Data</font>
                    </h5>
                </div>

                <div class="modal-body">
                    <form action="training_proses.php?proses=prosestambah" method="post" enctype="multipart/form-data">


                        <input name="kode_nama" type="" class="form-control" value="<?php echo $kode_otomatis ?>">


                        <div class="form-group">
                            <label>Nama Training</label>
                            <input name="nama" type="text" class="form-control" placeholder="Nama" autocomplete="off"
                                required onsubmit="this.setCustomValidity('')">
                        </div>


                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" type="text" class="form-control" placeholder="Alamat"
                                autocomplete="off" required onsubmit="this.setCustomValidity('')">
                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="SIMPAN" value="SIMPAN">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
