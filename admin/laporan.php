<?php
include '../assets/conn/config.php';
require('../assets/pdf/fpdf.php');
$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Image('../assets/img/bg.jpg',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(25.5,0.5,'Laporan Hasil Klasifikasi Bantuan Pangan ',0,'C');
$pdf->SetX(4);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(25.5,0.5,'Studi Kasus',0,'C');    
$pdf->SetX(4);
$pdf->MultiCell(25.5,0.5,'Di Kecamatan Kepohbaru',0,'C');
$pdf->SetX(4);
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(25.5,0.7,"LAPORAN HASIL KLASIFIKASI PENERIMA BANTUAN PANGAN",0,10,'C');
$pdf->ln(1);

$pdf->SetFont('Times','B',10);
$pdf->Cell(8,0.7,"Hasil Calon Penerima Bantuan Pangan Yang : ".$keputusan=$_GET['keputusan'],0,0,'C');

$pdf->ln(1);
$pdf->SetFillColor(128, 128, 128);
$pdf->Cell(3, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(11, 0.8, 'Nama', 1, 0, 'C');
$pdf->Cell(11, 0.8, 'Keputusan', 1, 1, 'C');
$pdf->SetFont('Times','',10);

$keputusan=$_GET['keputusan'];
$query=mysql_query("select * from tbl_hasil where keputusan=" . $keputusan);
$no=1;
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(3, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(11, 0.8, $lihat['nama'], 1, 0,'C');
	$pdf->Cell(11, 0.8, $lihat['keputusan'], 1, 1,'C');
	$no++;
}

$pdf->SetFont('Times','B',10);
$keputusan=$_GET['keputusan'];
$query=mysql_query("select count(*) as total from tbl_hasil where keputusan=" . $keputusan);
while($total=mysql_fetch_array($query)){
	$pdf->Cell(14, 0.8, "Total", 1, 0,'C');		
	$pdf->Cell(11, 0.8, $total['total'], 1, 0,'C');
}


$pdf->SetFont('Times','',12);
$pdf->SetX(2); 
$pdf->Cell(0,3,'Dikeluar di  		   : Bojonegoro',0,0,'L');
$pdf->SetX(2); 
$pdf->Cell(0,4,"Pada Tanggal 		: ".date("D-d/m/Y"),0,0,'L');


$pdf->Output("laporan hasil penerima bantuan pangan.pdf","I");

?>