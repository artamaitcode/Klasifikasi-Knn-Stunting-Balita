<?php
include "header.php";
if (isset($_GET['aksi'])) {
	if ($_GET['aksi']=="simpanhasil") {
		$kode_hasil= $_POST['kode_hasil'];
		$nama= $_POST['nama'];
		$keputusan= $_POST['keputusan'];
		mysql_query("insert into tbl_hasil(kode_hasil,nama,keputusan) values('$kode_hasil','$nama','$keputusan')");
		header("location:hasil.php");
		
	}
}
?>

<div class="row content">
    <div class="col-sm-2 sidenav">
        <p><a href="index.php"><button type="button" class="btn btn-primary btn-block">BERANDA</button></a>
        </p>
        <p><a href="training.php"><button type="button" class="btn btn-primary btn-block">DATA
                    TRAINING</button></a>
        </p>
        <p><a href="testing.php"><button type="button" class="btn btn-primary btn-block">DATA TESTING</button></a>
        </p>
        <p><a href="metode.php"><button type="button" class="btn btn-primary btn-block active">METODE</button></a></p>
        <p><a href="hasil.php"><button type="button" class="btn btn-primary btn-block">HASIL ANALISA</button></a>
        <p><a href="about.php"><button type="button" class="btn btn-primary btn-block">ABOUT</button></a>
        </p>
    </div>

    <div class="col-sm-8 text-left">
        <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 5px #888888;">
            <div class="bootstrap-table">
                <h4> <b>Klasifikasi Penerima Bantuan Pangan Menggunakan Metode K-NN </b></h4>
            </div>

            <div class="row">
            </div>
            <div class="bootstrap-table">
                <!-- modal input -->
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    <form action="" method="get" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Pilih Nama</label>
                            <select class='form-control' name='kode_nama' autocomplete='off'>
                                <option disabled selected>Pilih</option>";
                                <?php
								$b1=mysql_query("SELECT * from tbl_testing group by kode_nama order by kode_nama asc");
								while($b=mysql_fetch_array($b1)){
									?>

                                <option value="<?php echo $b['kode_nama'] ?>">
                                    <?php echo $b['kode_nama'] ?> -
                                    <?php echo $b['nama'] ?></option>

                                <?php
								}
								?>
                            </select>
                        </div>
                        <label>Nilai K</label>
                        <input name="nilai_k" type="" class="form-control" value="3">

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-danger" name="proses" value=" PENGUJIAN">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="panel panel-container" style="padding: 50px; box-shadow: 2px 2px 5px #888888;">
            <div class="bootstrap-table">
                <!-- modal dataset training -->
                <h4>Data Training</h4>
                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr style="box-shadow: 2px 2px 4px #888888;">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama </th>

                                <?php
							// untuk menampilkan data kriteria
								$data=mysql_query("SELECT * FROM tbl_kriteria order by kode_kriteria asc");
								while ($a=mysql_fetch_array($data)) {

									echo "<th class='text-center'>$a[nama_kriteria]</th>";

								}
								?>

                                <th class="text-center">Keputusan</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
							//untuk menampilkan data mekanik
							$data=mysql_query("SELECT * FROM tbl_namatraining order by kode_nama asc");
							$no=1;
							while ($a=mysql_fetch_array($data)) {
								$nomor = $no++;
								$kode= $a['kode_nama'];
								$nama= $a['nama'];
								echo "<tr>
								<td class='text-center'>$nomor</td>"; 

								echo "<td>$nama</td>";
								//untuk menampilkan nilai sub berdasarkan kriteria
								$query1 = mysql_query("SELECT nilai_training as sub FROM tbl_training WHERE kode_nama='".$kode."' ORDER BY kode_kriteria ");
								while ($result1 = mysql_fetch_array($query1)) {
									echo "<td class='text-center'>$result1[sub]</td>";
								} ?>

                            <td class="text-center"><?php echo $a['keputusan'] ?></td>

                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
                <br>


                <!-- modal dataset testing -->
                <h4>Data Testing</h4>
                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr style="box-shadow: 2px 2px 4px #888888;">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama </th>

                                <?php
							// untuk menampilkan data kriteria
							$data=mysql_query("SELECT * FROM tbl_kriteria order by kode_kriteria asc");
							while ($a=mysql_fetch_array($data)) {

								echo "<th class='text-center'>$a[nama_kriteria]</th>";

							}
							?>

                                <th class="text-center">Keputusan</th>
                            </tr>
                        </thead>

                        <?php
					//cek data mekanik
					$data=mysql_query("SELECT * FROM tbl_testing where kode_nama='$_GET[kode_nama]' limit 1");
					while ($a=mysql_fetch_array($data)) {

						if (empty($a['kode_nama'])) {

						}else{
						}
						?>

                        <tbody>

                            <?php
							//untuk menampilkan data mekanik
							$data=mysql_query("SELECT * FROM tbl_testing where kode_nama='$_GET[kode_nama]' limit 1");
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
                            </tr>
                        </tbody>
                        <?php } }?>

                    </table>
                </div>
                <br>



                <!-- modal euclidean distance -->
                <h4>Euclidean Distance</h4>
                <div class="table-responsive">
                    <table class="table table-bordered thead-dark" id="table">
                        <thead class="thead-dark">
                            <tr style="box-shadow: 2px 2px 4px #888888;">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>

                                <?php
							// untuk menampilkan data kriteria
							$data=mysql_query("SELECT * FROM tbl_kriteria order by kode_kriteria asc");
							while ($a=mysql_fetch_array($data)) {

								echo "<th class='text-center'>$a[nama_kriteria]</th>";

							}
							?>

                                <th class="text-center">Distance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							//untuk menampilkan data mekanik
						$data=mysql_query("SELECT * FROM tbl_namatraining  order by kode_nama");
						$no=1;
						$jumlah = 0;
						while ($a=mysql_fetch_array($data)) {
							$sum = 0.0;
							$nomor = $no++;
							$kode= $a['kode_nama'];
							$nama= $a['nama'];
							echo "<tr>
							<td class='text-center'>$nomor</td>"; 

							echo "<td>$nama</td>";
								//untuk menampilkan nilai sub berdasarkan kriteria
							$query2 = mysql_query("SELECT kp.nilai_training as subtraining, kp.kode_kriteria as kode_kriteria FROM  tbl_training kp, tbl_kriteria k
								WHERE kp.kode_nama='".$kode."' AND k.kode_kriteria=kp.kode_kriteria ORDER BY kp.kode_kriteria");
							while($result2=mysql_fetch_array($query2)) {
								$val1=$result2['subtraining'];

								$query3 = mysql_query("SELECT nilai_testing as subtesting FROM tbl_testing where kode_kriteria='$result2[kode_kriteria]' and kode_nama='$_GET[kode_nama]'");
								$result3=mysql_fetch_assoc($query3);
								$val2=$result3['subtesting'];

								$dua=2;
								$val= pow(($val2-$val1),$dua);
								$sum +=($val);
								$akr= sqrt($sum);
								$akar = number_format($akr,2);
								echo "<td class='text-center'>$val</td>";

							}
							echo "<td class='text-center'>$akar</td>";
							echo "</tr>";
							$jumlah++;
						//ambil nilai distance
							mysql_query("update tbl_namatraining set distance='$akr' where kode_nama='$a[kode_nama]'");
						}
						?>
                    </table>
                </div>
                <br>



                <!-- modal rangking -->
                <?php
				$brg=mysql_query("SELECT * FROM tbl_namatraining order by distance asc");
				$rank=1;
				while($b=mysql_fetch_array($brg)){

					$kode_nama=$b['kode_nama'];
					?>

                <?php
					$ubah = mysql_query("Update tbl_namatraining set ranking='$rank' where kode_nama='$b[kode_nama]'");
					$rank++;
					?>
                <?php 
				}
				?>


                <!-- modal pengelompokan -->
                <?php
				$bg=mysql_query("SELECT * FROM tbl_namatraining order by distance asc");
				while($bt=mysql_fetch_array($bg)){
					$kode_nama=$bt['kode_nama'];
					$nilai_k = $_GET['nilai_k'];
					?>

                <?php
					if ($bt['ranking']<=$nilai_k) {
						$ubah = mysql_query("Update tbl_namatraining set pilihan='Ya' where kode_nama='$bt[kode_nama]'");
							# code...
					}else{
						$ubah = mysql_query("Update tbl_namatraining set pilihan='Tidak' where kode_nama='$bt[kode_nama]'");
					}
					?>
                <?php 
				}
				?>



                <!-- modal nearest neighbhor -->
                <h4>Klasifikasi Nearest Neighbhor</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr style="box-shadow: 2px 2px 4px #888888;">
                            <th class="text-center">Kode</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Dinstance</th>
                            <th class="text-center">Rangking</th>
                            <th class="text-center">Pilih</th>
                            <th class="text-center">Keputusan</th>
                        </tr>
                        <?php 

						$brg=mysql_query("SELECT * FROM tbl_namatraining order by distance asc");
						while($b=mysql_fetch_array($brg)){


							?>
                        <tr>
                            <td class="text-center"><?php echo $b['kode_nama'] ?></td>
                            <td><?php echo $b['nama'] ?></td>
                            <td class="text-center"><?php echo number_format($b['distance'],3) ?></td>
                            <td class="text-center"><?php echo $b['ranking'] ?></td>
                            <td class="text-center"><?php echo $b['pilihan'] ?></td>
                            <td class="text-center"><?php echo $b['keputusan'] ?></td>
                        </tr>

                        <?php 
						}
						?>
                    </table>
                </div>
                <br>



                <!-- modal kesimpulan -->
                <?php 
				$warga=mysql_query("SELECT * FROM tbl_namatraining order by kode_nama asc");
				while($ba=mysql_fetch_array($warga)){
					?>

                <?php 
					$bg=mysql_query("SELECT count(*) as jumlahditerima  FROM tbl_namatraining where pilihan='Ya' and keputusan='LAYAK'");
					$a=mysql_fetch_array($bg);

					$bg1=mysql_query("SELECT count(*) as jumlahtidakditerima  FROM tbl_namatraining where pilihan='Ya' and keputusan='TIDAK LAYAK'");
					$a1=mysql_fetch_array($bg1);
					?>



                <?php
					$jumlahditerima=$a['jumlahditerima'];
					$jumlahtidakditerima=$a1['jumlahtidakditerima'];
					if ($a['jumlahditerima']>$a1['jumlahtidakditerima']) {
					
						$hasil='Layak';
						$hasill='kategori Layak lebih banyak daripada Tidak Layak';

					}else{
						$hasil='Tidak Layak';
						$hasill='kategori Tidak Layak lebih banyak daripada Layak';


					} }

					$data=mysql_query("SELECT * FROM tbl_testing where kode_nama='$_GET[kode_nama]'");
					$a=mysql_fetch_array($data);
					?>

                <h4>Kesimpulan :</h4>
                <div class="text-justify" style="padding: 20px; box-shadow: 2px 2px 5px #888888;">
                    <h4>Hasil perhitungan ini mengambil <b><?php echo $_GET['nilai_k'] ?></b> data terbaik
                        asecending
                        <b>(K=<?php echo $_GET['nilai_k'] ?>)</b> yang menggunakan <b>Klasifikasi Nearest
                            Neighbhor(K-NN)</b>, adapun kesimpulan dari Klasifikasi Nearest Neighbhor(K-NN)
                        adalah :
                        <b><?php echo $hasill ?></b>, Layak berjumlah <b>(<?php echo $jumlahditerima ?>)</b>
                        sedangkan
                        Tidak Layak berjumlah <b>(<?php echo $jumlahtidakditerima ?>)</b>, sehingga dapat
                        disimpulkan
                        calon penerima bantuan pangan bernama <b><?php echo $a['nama'] ?></b>. Keputusan kelayakan
                        penerima bantuan pangan hasilnya : <b>(<?php echo $hasil ?>)</b>
                    </h4>

                </div>



                <!-- modal input data baru -->
                <?php 
					$carikode = mysql_query("select max(kode_hasil) from tbl_hasil") or die (mysql_error());
					$datakode = mysql_fetch_array($carikode);
					if ($datakode) {
						$nilaikode = substr($datakode[0], 1);
						$kode = (int) $nilaikode;
						$kode = $kode + 1;
						$kode_otomatis = "H".str_pad($kode, 2, "0", STR_PAD_LEFT);
					} else {
						$kode_otomatis = "H01";
					}
					?>

                <form action="metode.php?aksi=simpanhasil" method="post" enctype="multipart/form-data">

                    <input type="hidden" class="form-control" name="kode_hasil" value="<?php echo $kode_otomatis ?>">

                    <input name="nama" type="hidden" class="form-control" value="<?php echo $a['nama'] ?>">

                    <input type="hidden" class="form-control" name="keputusan" value="<?php echo $hasil ?>">

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger" name="proses" value="SIMPAN HASIL ANALISA">
                    </div>
                </form>

            </div>
        </div>
    </div>