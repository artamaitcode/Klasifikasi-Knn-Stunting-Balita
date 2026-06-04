<?php
include "header.php";
?>

<div class="row">
    <div class="col-sm-2 sidenav">
        <p><a href="index.php"><button type="button" class="btn btn-primary btn-block">BERANDA</button></a>
        </p>
        <p><a href="training.php"><button type="button" class="btn btn-primary btn-block">DATA
                    TRAINING</button></a>
        </p>
        <p><a href="testing.php"><button type="button" class="btn btn-primary btn-block">DATA
                    TESTING</button></a>
        </p>
        <p><a href="metode.php"><button type="button" class="btn btn-primary btn-block">METODE</button></a></p>
        <p><a href="hasil.php"><button type="button" class="btn btn-primary btn-block active">HASIL ANALISA</button></a>
        <p><a href="about.php"><button type="button" class="btn btn-primary btn-block">ABOUT</button></a>
        </p>
        </p>
    </div>

    <div class="col-sm-8 text-left">
        <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 5px #888888;">
            <div class="bootstrap-table">
                <h4>Hasil klasifikasi Penerima Bantuan Pangan Menggunkan Metode K-NN (K-Nearest Neighbor)</h4>
                <br>

                <?php 
				$per_hal=100;
				$jumlah_record=mysql_query("SELECT COUNT(*) from tbl_hasil");
				$jum=mysql_result($jumlah_record, 0);
				$halaman=ceil($jum / $per_hal);
				$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
				$start = ($page - 1) * $per_hal;
				?>





                <form action="" method="get">
                    <div class="input-group col-md-4 col-md-offset-8">
                        <span class="input-group-addon" id="basic-addon1"><span
                                class="glyphicon glyphicon-search"></span></span>
                        <select type="submit" name="keputusan" class="form-control" onchange="this.form.submit()">
                            <option>Pilih data ..</option>
                            <option>LAYAK</option>
                            <option>TIDAK LAYAK</option>
                        </select>
                    </div>
                </form>

                <br />
                <?php 
				if(isset($_GET['keputusan'])){
					$keputusan=mysql_real_escape_string($_GET['keputusan']);
					$tg="laporan.php?keputusan='$keputusan'";
					?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank"
                    class="btn btn-danger pull-right"><span></span>&emsp; Cetak Laporan</a><?php
				}else{
					$tg="laporan.php";
				}
				?>

                <?php 
				echo "<h4>&nbsp;&nbsp;&nbsp;Data hasil Klasifikasi <a style='color:blue'> ". $_GET['keputusan']."</a></h4>";
				?>

                <br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr style="box-shadow: 2px 2px 4px #888888;">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Keputusan</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                        <?php 
						if(isset($_GET['keputusan'])){
							$keputusan=mysql_real_escape_string($_GET['keputusan']);
							$brg=mysql_query("SELECT * FROM tbl_hasil where keputusan like '$keputusan'");
						}else{
							$brg=mysql_query("SELECT * FROM tbl_hasil order by kode_hasil asc limit $start, $per_hal");
						}
						$no=1;
						while($b=mysql_fetch_array($brg)){

							?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><?php echo $b['nama'] ?></td>
                            <td class="text-center"><?php echo $b['keputusan'] ?></td>
                            <td class="text-center">
                                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hasil_hapus.php?kode_hasil=<?php echo $b['kode_hasil']; ?>' }"
                                    title="Delete" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        <?php 
						}
						?>



                    </table>
                </div>

            </div>
        </div>
    </div>