<?php
include "header.php";
?>

<div class="container">
    <div class="row">
    </div>
    <!--/.row-->


    <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 5px #888888;">
        <div class="bootstrap-table">
            <?php
				//menampilkan nama mekanik 
				$kode_nama=$_GET['kode_nama'];
				$brg=mysql_query("SELECT * FROM tbl_namatraining where kode_nama='$kode_nama'");
				$b=mysql_fetch_array($brg);
				?>
            <h4>Data Training <?php  echo $b['nama'] ?></h4>
            <hr>

            <?php 
				//cek data mekanik
				$kode_nama=$_GET['kode_nama'];
				$br=mysql_query("SELECT * FROM tbl_training where kode_nama='$kode_nama'");
				$bg=mysql_fetch_array($br);

				if (empty($bg['kode_nama'])) {
					?>
            <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal"
                class="btn btn-default col-md-2"><span class="glyphicon glyphicon-plus"></span>&emsp; TAMBAH
                DATA</button>
            <br>
            <br>
            <br>
            <?php }else{

				}
				?>


            <div class="table-responsive">
                <table class="table table-bordered thead-dark" id="table">
                    <thead class="thead-dark">
                        <tr style="box-shadow: 2px 2px 4px #888888;">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Training</th>

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

                        <?php
					//cek data mekanik
							if (empty($bg['kode_nama'])) {

							}else{
								?>


                    <tbody>
                        <?php
							//untuk menampilkan data mekanik
									$data=mysql_query("SELECT * FROM tbl_namatraining  where kode_nama='$_GET[kode_nama]' order by kode_nama asc");
									$no=1;
									while ($a=mysql_fetch_array($data)) {
										$nomor = $no++;
										$kode= $a['kode_nama'];
										$nama= $a['nama'];
										echo "<tr>
										<td class='text-center'>$nomor</td>"; 

										echo "<td class='text-center'>$nama</td>";
								//untuk menampilkan nilai sub berdasarkan kriteria
										$query1 = mysql_query("SELECT nilai_training as sub FROM tbl_training WHERE kode_nama='".$kode."' ORDER BY kode_kriteria ");
										while ($result1 = mysql_fetch_array($query1)) {
											echo "<td class='text-center'>$result1[sub]</td>";
										} ?>

                        <td class="text-center"><?php echo $a['keputusan'] ?></td>

                        <td class="text-center">
                            <a href="nilai_aksi.php?kode_nama=<?php echo $a['kode_nama'] ?>&aksi=ubah"
                                class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>

                            <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='nilai_proses.php?kode_nama=<?php echo $b['kode_nama']; ?>&proses=proseshapus' }"
                                class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>

                        </tr>
                    </tbody>
                    <?php } }?>

                </table>
            </div>
        </div>
    </div>




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
                    <form action="nilai_proses.php?proses=prosestambah" method="post" enctype="multipart/form-data">


                        <input type="hidden" name="kode_nama" value="<?php echo $_GET['kode_nama'] ?>">

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
                        <div class="form-group">
                            <label>Keputusan</label>
                            <select name="keputusan" class="form-control">
                                <option selected>LAYAK</option>
                                <option>TIDAK LAYAK</option>
                            </select>
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