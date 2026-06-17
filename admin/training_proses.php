<?php
include '../assets/conn/config.php';
function buatKodeTraining(){
    $carikode = mysql_query("SELECT MAX(CAST(SUBSTRING(kode_nama, 3) AS UNSIGNED)) AS max_kode FROM tbl_namatraining");
    $datakode = mysql_fetch_assoc($carikode);

    if ($datakode && $datakode['max_kode'] !== null) {
        $nilaikode = (int)$datakode['max_kode'];
        $nilaikode++;
        return "AB" . str_pad($nilaikode, 3, "0", STR_PAD_LEFT);
    } else {
        return "AB001";
    }
}

function ambilKodeKriteria($keyword){
    $keyword = mysql_real_escape_string($keyword);

    $q = mysql_query("SELECT kode_kriteria FROM tbl_kriteria 
        WHERE nama_kriteria LIKE '%$keyword%' 
        LIMIT 1");

    if(mysql_num_rows($q) > 0){
        $r = mysql_fetch_assoc($q);
        return $r['kode_kriteria'];
    }

    return '';
}

function simpanNilaiTraining($kode_nama, $kode_kriteria, $nilai){
    $kode_nama = mysql_real_escape_string($kode_nama);
    $kode_kriteria = mysql_real_escape_string($kode_kriteria);
    $nilai = mysql_real_escape_string($nilai);

    if($kode_kriteria != '' && $nilai != ''){
        mysql_query("INSERT INTO tbl_training(kode_nama, kode_kriteria, nilai) 
            VALUES('$kode_nama', '$kode_kriteria', '$nilai')");
    }
}
if (isset($_GET['proses'])) {
	if ($_GET['proses']=="prosestambah") {
		$kode_nama=$_POST['kode_nama'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];
		
		mysql_query("insert into tbl_namatraining(kode_nama,nama,alamat,keputusan,distance,ranking,pilihan) values('$kode_nama','$nama','$alamat','?','0','0','?')");
		header("location:training.php");

	}elseif ($_GET['proses']=="prosesubah") {
		$kode_nama=$_POST['kode_nama'];
		$nama=$_POST['nama'];
		$alamat=$_POST['alamat'];

		mysql_query("update tbl_namatraining set nama='$nama', alamat='$alamat' where kode_nama='$kode_nama'");
		header("location:training.php");
		}elseif ($_GET['proses']=="hapussemua") {

    if(isset($_POST['konfirmasi_hapus']) && $_POST['konfirmasi_hapus'] == "YA") {

        mysql_query("DELETE FROM tbl_training") or die(mysql_error());
        mysql_query("DELETE FROM tbl_namatraining") or die(mysql_error());

        header("location:training.php?hapussemua=berhasil");
        exit;

    } else {

        header("location:training.php");
        exit;
    }

	}elseif ($_GET['proses']=="proseshapus") {
		$kode_nama=$_GET['kode_nama'];
		mysql_query("delete from tbl_namatraining where kode_nama='$kode_nama'");
		mysql_query("delete from tbl_training where kode_mekanik='$kode_training'");
		header("location:training.php");
		}elseif ($_GET['proses']=="prosesimportcsv") {

    $sukses = 0;
    $gagal = 0;
	
	

    if(!isset($_FILES['file_csv']) || $_FILES['file_csv']['error'] != 0){
        header("location:training.php?import=1&sukses=0&gagal=1");
        exit;
    }

    $nama_file = $_FILES['file_csv']['name'];
    $tmp_file = $_FILES['file_csv']['tmp_name'];
    $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));

    if($ext != 'csv'){
        header("location:training.php?import=1&sukses=0&gagal=1");
        exit;
    }

    $handle = fopen($tmp_file, "r");

    if($handle !== FALSE){

        $baris = 0;

        while(($data = fgetcsv($handle, 10000, ";")) !== FALSE){

            $baris++;

            // Lewati header CSV
            if($baris == 1){
                continue;
            }

            // Supaya kolom kosong tetap aman
            $data = array_pad($data, 10, '');

            // Bersihkan BOM dari Excel
            $data[0] = preg_replace('/^\xEF\xBB\xBF/', '', $data[0]);

            $kode_nama      = trim($data[0]);
            $nama           = trim($data[1]);
            $alamat         = trim($data[2]);
            $jenis_kelamin  = trim($data[3]);
            $berat_lahir    = trim($data[4]);
            $umur           = trim($data[5]);
            $tb_lahir       = trim($data[6]);
            $lingkar_badan  = trim($data[7]);
            $lingkar_lengan = trim($data[8]);
            $keputusan      = trim($data[9]);

            if($nama == '' || $alamat == ''){
                $gagal++;
                continue;
            }

            if($kode_nama == ''){
                $kode_nama = buatKodeTraining();
            }

            if($keputusan == ''){
                $keputusan = '?';
            }

            $kode_nama_safe = mysql_real_escape_string($kode_nama);
            $nama_safe = mysql_real_escape_string($nama);
            $alamat_safe = mysql_real_escape_string($alamat);
            $keputusan_safe = mysql_real_escape_string($keputusan);

            $cek = mysql_query("SELECT kode_nama FROM tbl_namatraining 
                WHERE kode_nama='$kode_nama_safe'");

            if(mysql_num_rows($cek) > 0){

                mysql_query("UPDATE tbl_namatraining SET 
                    nama='$nama_safe',
                    alamat='$alamat_safe',
                    keputusan='$keputusan_safe'
                    WHERE kode_nama='$kode_nama_safe'");

            } else {

                mysql_query("INSERT INTO tbl_namatraining
                    (kode_nama, nama, alamat, keputusan, distance, ranking, pilihan)
                    VALUES
                    ('$kode_nama_safe', '$nama_safe', '$alamat_safe', '$keputusan_safe', '0', '0', '?')");
            }

            // Hapus nilai lama agar tidak dobel
            mysql_query("DELETE FROM tbl_training WHERE kode_nama='$kode_nama_safe'");

            // Ambil kode kriteria dari tabel kriteria
            $kode_jenis_kelamin  = ambilKodeKriteria("Jenis Kelamin");
            $kode_berat_lahir    = ambilKodeKriteria("Berat");
            $kode_umur           = ambilKodeKriteria("Umur");
            $kode_tb_lahir       = ambilKodeKriteria("TB");
            $kode_lingkar_badan  = ambilKodeKriteria("Lingkar Badan");
            $kode_lingkar_lengan = ambilKodeKriteria("Lingkar Lengan");

            // Simpan nilai kriteria ke tbl_training
            simpanNilaiTraining($kode_nama, $kode_jenis_kelamin, $jenis_kelamin);
            simpanNilaiTraining($kode_nama, $kode_berat_lahir, $berat_lahir);
            simpanNilaiTraining($kode_nama, $kode_umur, $umur);
            simpanNilaiTraining($kode_nama, $kode_tb_lahir, $tb_lahir);
            simpanNilaiTraining($kode_nama, $kode_lingkar_badan, $lingkar_badan);
            simpanNilaiTraining($kode_nama, $kode_lingkar_lengan, $lingkar_lengan);

            $sukses++;
        }

        fclose($handle);
    }

    header("location:training.php?import=1&sukses=$sukses&gagal=$gagal");
    exit;

	}elseif ($_GET['proses']=="prosescari") {
		$cari=$_POST['cari'];
		header("location:training.php?cari=$cari");
	}
}

?>