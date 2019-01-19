<?php
include "fpdf.php";
include "../conn.php";

$pdf = new FPDF();
$pdf->AddPage();

//untuk judul
$pdf->setFont('Arial','B',12); 
$pdf->setXY(75,5);
$pdf->cell(30,6,'Laporan Nilai Siswa'); 

//untuk data pendukung
$semester=$_GET['semester'];
$nama_siswa=$_GET['nama_siswa'];
$nis=$_GET['nis'];
$tanggal=date('D,d-M-Y');
$photo="../logo/".$_GET['photo'];

//untuk data siswa
$pdf->setFont('Arial','B',8);
$pdf->setXY(24,20);$pdf->cell(24,6,'Nama Siswa : '.$nama_siswa);
$pdf->setXY(24,25);$pdf->cell(24,6,'NIS : '.$nis);

$pdf->Image($photo,150,10,20,20);

$pdf->setFont('Arial','I',8);
$pdf->setXY(140,35);$pdf->cell(24,6,'Tanggal Cetak : '.$tanggal);

//untuk header
$pdf->setFont('Arial','',8);
$pdf->setFillColor(233,233,233);
$y_axis1 = 40;
$pdf->setY($y_axis1);

//untuk ontaint
$y_initial = 46;
$pdf->setX(25);

//header
$pdf->cell(10,6,'No',1,0,'C',1); 
$pdf->cell(50,6,'Nama Pelajaran',1,0,'C',1); 
$pdf->cell(20,6,'NA KOG',1,0,'C',1);
$pdf->cell(20,6,'NA PSIKO',1,0,'C',1); 
$pdf->cell(20,6,'NA AFEK',1,0,'C',1);
$pdf->cell(20,6,'KETERAGAN',1,0,'C',1);
$y = $y_initial + $row;

$id_siswa=$_GET['id_siswa'];

$nilai = mysql_query("SELECT nama_matapelajaran, nakog, napsi, naafek, ket FROM tbl_nilai nilai, setup_matapelajaran matapelajaran WHERE nilai.id_siswa='$id_siswa' and nilai.id_matapelajaran=matapelajaran.id_matapelajaran order by matapelajaran.nama_matapelajaran asc");

$no = 0;
$row = 6;
while ($daftar = mysql_fetch_array($nilai)){
	$tugas=$daftar['nakog'];
	$uts=$daftar['napsi'];
	$uas=$daftar['naafek'];
	$uas=$daftar['ket'];

	
	$no++;
	$pdf->setY($y);
	$pdf->setX(25);
	$pdf->cell(10,6,$no,1,0,'C');
	$pdf->cell(50,6,$daftar['nama_matapelajaran'],1,0,'L');
	$pdf->cell(20,6,$nakog,1,0,'L');
	$pdf->cell(20,6,$napsi,1,0,'C');
    $pdf->cell(20,6,$naafek,1,0,'R');
	$pdf->cell(20,6,$ket,1,0,'R');
	$y = $y + $row;
}


$pdf->Output();
?>