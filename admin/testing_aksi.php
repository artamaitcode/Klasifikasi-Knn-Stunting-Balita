<?php
include 'header.php';

if (isset($_GET['aksi'])) {
	if ($_GET['aksi']=="ubah") {
		?>

<div class="container">

    <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 5px #888888;">
        <div class="bootstrap-table">
            <h4>Data Testing/ Ubah Data</h4>
            <br>

            <form action="testing_proses.php?proses=prosesubah" method="post" enctype="multipart/form-data">
                <table class="table">

                    <input type="" name="kode_nama" value="<?php echo $_GET['kode_nama'] ?>">

                    <div class="form-group">
                        <label>Nama Testing</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $_GET['nama'] ?>">
                    </div>


                    <?php
                                $hasil =mysql_query("SELECT * FROM tbl_kriteria ORDER BY kode_kriteria");
                                while ($baris = mysql_fetch_array($hasil)) {
                                    $idK = $baris['kode_kriteria'];
                                    $labelK = $baris['nama_kriteria'];
                                    $kode_nama = $_GET['kode_nama'];

                                    $hasil3 = mysql_query("SELECT * FROM tbl_training WHERE kode_kriteria='".$idK."' AND kode_nama='".$kode_nama."'");
                                    $result3 = mysql_fetch_array($hasil3);
                                    $sub = $result3['kode_subkriteria'];

                                    

                                    echo "<div class=form-group>
                                    <label>".$labelK."</label>";

                                    echo "<select name=".$idK." class=form-control>";
                                    echo "<option selected value=".$result3['nilai_training'].">".$result3['nilai_training']."</option>";

                                    $hasil2 = mysql_query("SELECT * FROM tbl_subkriteria WHERE kode_kriteria='".$idK."' ORDER BY nilai_subkriteria DESC");
                                    while ($baris2 = mysql_fetch_array($hasil2)) {

                                        echo "<option selected value=".$baris2['nilai_subkriteria'].">".$baris2['nama_subkriteria']." - (".$baris2['nilai_subkriteria'].")</option>";

                                    }
                                    echo "</select></div>";
                                }
                            
                                ?>


                </table>
                <div class="modal-footer">
                    <a href="testing.php" class="btn btn-primary" type="button" data-dismiss="modal">BATAL</a>
                    <input type="submit" class="btn btn-default" value="UBAH">
                </div>
            </form>
        </div>
    </div>
</div>




<?php 
		}
	}

	?>