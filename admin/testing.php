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
        <p><a href="testing.php"><button type="button" class="btn btn-primary btn-block active">DATA
                    TESTING</button></a>
        </p>
        <p><a href="metode.php"><button type="button" class="btn btn-primary btn-block">METODE</button></a></p>
        <p><a href="hasil.php"><button type="button" class="btn btn-primary btn-block">HASIL ANALISA</button></a>
        <p><a href="about.php"><button type="button" class="btn btn-primary btn-block">ABOUT</button></a>
        </p>
    </div>



    <div class="col-sm-8 text-left">
        <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 5px #888888;">
            <div class="bootstrap-table">
                <h4>Data Testing</h4>
                <hr>

                <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal"
                    class="btn btn-default col-md-2"><span class="glyphicon glyphicon-plus"></span>&emsp; TAMBAH
                    DATA</button>
                <br>
                <br>

                <br>



                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr style="box-shadow: 2px 2px 4px #888888;">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Testing</th>

                                <?php
							// untuk menampilkan data kriteria
								$data=mysql_query("SELECT * FROM tbl_kriteria order by kode_kriteria asc");
								while ($a=mysql_fetch_array($data)) {

									echo "<th class='text-center'>$a[nama_kriteria]</th>";

								}
								?>

                                <th class="text-center">Keputusan</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>

                        <tbody>

                            <?php
							//untuk menampilkan data testing
								$data=mysql_query("SELECT * FROM tbl_testing group by kode_nama order by kode_nama asc");
								$no=1;
								while ($a=mysql_fetch_array($data)) {
									$nomor = $no++;
									$kode= $a['kode_nama'];
									$nama= $a['nama'];
									echo "<tr>
									<td class='text-center'>$nomor</td>"; 

									echo "<td class='text-center'>$nama</td>";
								//untuk menampilkan nilai sub berdasarkan kriteria
									$query1 = mysql_query("SELECT nilai_testing as sub FROM tbl_testing WHERE kode_nama='".$kode."' ORDER BY kode_kriteria ");
									while ($result1 = mysql_fetch_array($query1)) {
										echo "<td class='text-center'>$result1[sub]</td>";
									} ?>

                            <td class="text-center">?</td>

                            <td class="text-center">
                                <a href="testing_aksi.php?kode_nama=<?php echo $a['kode_nama'] ?>&nama=<?php echo $a['nama'] ?>&aksi=ubah"
                                    class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>

                                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='testing_proses.php?kode_nama=<?php echo $a['kode_nama']; ?>&proses=proseshapus' }"
                                    class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>

                            </tr>
                        </tbody>

                        <?php }
                        ?>

                    </table>
                </div>

            </div>
        </div>



        <?php 
		$carikode = mysql_query("select max(kode_nama) from tbl_testing") or die (mysql_error());
  		// menjadikannya array
		$datakode = mysql_fetch_array($carikode);
  		// jika $datakode
		if ($datakode) {
			$nilaikode = substr($datakode[0], 2);
   		// menjadikan $nilaikode ( int )
			$kode = (int) $nilaikode;
   		// setiap $kode di tambah 1
			$kode = $kode + 1;
			$kode_otomatis = "AE".str_pad($kode, 2, "0", STR_PAD_LEFT);
		} else {
			$kode_otomatis = "AE01";
		}
		?>
        <!-- modal input -->
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
                        <?php
						$data=mysql_query("SELECT * FROM tbl_testing order by kode_nama desc");
						$a=mysql_fetch_array($data);
						?>

                        <form action="testing_proses.php?proses=prosestambah" method="post"
                            enctype="multipart/form-data">

                            <input type="" name="kode_nama" value="<?php echo $kode_otomatis ?>">

                            <div class="form-group">
                                <label>Nama Testing</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama testing">
                            </div>


                            <?php
								$hasil =mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
								while ($baris = mysql_fetch_array($hasil)) {
									$idK = $baris['kode_kriteria'];
									$labelK = $baris['nama_kriteria'];

                                    $kode_nama = $_GET['kode_nama'];


									echo "<div class=form-group>
									<label>".$labelK."</label>";

									echo "<select name=".$idK." class=form-control>";
									$hasil2 = mysql_query("SELECT * FROM tbl_subkriteria WHERE kode_kriteria='".$idK."' ORDER BY nilai_subkriteria DESC");
									while ($baris2 = mysql_fetch_array($hasil2)) {
										echo "<option selected value=".$baris2['nilai_subkriteria'].">".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";
									}

									echo "</select></div>";
								}

								?>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="SIMPAN" value="SIMPAN">
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </div>