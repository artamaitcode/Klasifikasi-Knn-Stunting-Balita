<?php
include 'header.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi']=="ubah") {
		?>

<div class="container">

    <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 5px #888888;">
        <div class="bootstrap-table">
            <h4>Ubah Data</h4>
            <br>


            <?php
						$kode_nama=mysql_real_escape_string($_GET['kode_nama']);
						$det=mysql_query("select * from tbl_namatraining where kode_nama='$kode_nama'")or die(mysql_error());
						while($d=mysql_fetch_array($det)){
							?>
            <form action="training_proses.php?proses=prosesubah" method="post" enctype="multipart/form-data">
                <table class="table">

                    <input type="" readonly class="form-control" name="kode_nama" value="<?php echo $d['kode_nama'] ?>">

                    <tr>
                        <td>Nama Training</td>
                        <td><input name="nama" type="text" value="<?php echo $d['nama'] ?>" class="form-control"
                                autocomplete="off" required onsubmit="this.setCustomValidity('')">
                        </td>
                    </tr>


                    <tr>
                        <td>Alamat</td>
                        <td><input name="alamat" type="text" class="form-control" placeholder="alamat"
                                autocomplete="off" required onsubmit="this.setCustomValidity('')"
                                value="<?php echo $d['alamat'] ?>"></td>
                    </tr>



                </table>
                <div class="modal-footer">
                    <a href="training.php" class="btn btn-primary" type="button" data-dismiss="modal">BATAL</a>
                    <input type="submit" class="btn btn-default" value="UBAH">
                </div>
            </form>
            <?php 
						}
						?>
        </div>
    </div>
</div>




<?php 
		}
	}

	?>