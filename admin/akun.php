<?php 
include 'header.php';
?>

<!-- Bootstrap -->
<link href="../assets/css/cosmo.min.css" rel="stylesheet">
<link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">

<div class="container">
    <div class="panel panel-container" style="padding: 30px; box-shadow: 2px 2px 8px #888888;">
        <div class="bootstrap-table">
            <?php
				$username=$_SESSION['username'];
				$det=mysql_query("select * from tbl_akun where username='$username'")or die(mysql_error());
				while($d=mysql_fetch_array($det)){
					?>
            <form action="akun_proses.php" method="post" enctype="multipart/form-data">
                <table class="table">

                    <input type="hidden" class="form-control" name="kode_akun" value="<?php echo $d['kode_akun'] ?>">


                    <tr>
                        <td>Nama Lengkap</td>
                        <td><input type="text" class="form-control" name="nama_lengkap"
                                value="<?php echo $d['nama_lengkap'] ?>"></td>
                    </tr>

                    <tr>
                        <td>Username</td>
                        <td><input type="text" class="form-control" name="username"
                                value="<?php echo $d['username'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="text" class="form-control" name="password"
                                value="<?php echo $d['password'] ?>"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="submit" class="btn btn-primary" value="UBAH">
                            <a href="index.php" type="button" class="btn btn-default" data-dismiss="modal">BATAL</a>
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
					}
					?>
        </div>
    </div>
</div>
<?php include 'footer2.php'; ?>