<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2012 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @category PHPExcel
 * @package PHPExcel
 * @copyright Copyright (c) 2006 - 2012 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt LGPL
 * @version 1.7.7, 2012-05-19
 */
/*  ----------------------------------------------------
Development history
Revisi : 0
Kegiatan :1.mencetak hasil filter ke dalam xls
File yang dibuat : DataRealisasiBA_XLS.php
Dibuat oleh : Rifan Abdul Rachman
Tanggal dibuat : 12-02-2015
----------------------------------------------------
 */
/** Error reporting */
//error_reporting(E_ALL);
 
date_default_timezone_set('Asia/Jakarta');

//parameter
//-----------------------
$judul1=$this->judul1;  //judul
$judul='Laporan '.$judul1;

//-----------------------
 
/** Include PHPExcel */
require './././libs/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
 
// Create the worksheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Judul

$objPHPExcel->getActiveSheet()->setCellValue('A2', "Tanggal Cetak :".date('d-m-Y, g:i a'));
$objPHPExcel->getActiveSheet()->getStyle('A1:AZ1000')->getFont()->setName('Calibri');
$objPHPExcel->getActiveSheet()->setCellValue('A1',"$judul");
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
$objPHPExcel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(9);
$objPHPExcel->getActiveSheet()->getStyle('A3:AZ1000')->getFont()->setSize(11);
//Tanggal


// Header
//Data DIPA
//p1
$objPHPExcel->getActiveSheet()->setCellValue('A4', "No");
//p2
$objPHPExcel->getActiveSheet()->setCellValue('B4', "Kode Satker(DIPA PNBP)");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "Kode KPPN(DIPA PNBP)");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "No. DIPA(DIPA PNBP)");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Jenis Belanja(DIPA PNBP)");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Jumlah(DIPA PNBP)");



/*
 */
//Data
if (count($this->data1) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
		$no1=0;
	$dataArray1= array();
	foreach ($this->data1 as $value) {
		$no1++;
		$nil1['p1']=$no1;
		$nil1['p2']=$value->get_satker_code();
		$nil1['p3']=$value->get_kppn_code();
		$nil1['p4']=$value->get_dipa_no();
		$nil1['p5']=$value->get_jenis_belanja();
		
		//pengecekan
		if ($value->get_line_amount()==0){
			$nil1['p6']='0';
		}else{
			$nil1['p6']=$value->get_line_amount();
		}

		array_push($dataArray1,$nil1);

	}
	$nox1=$no1+3;
	$objPHPExcel->getActiveSheet()->fromArray($dataArray1, NULL, 'A5');

}
//Penerimaan PNBP
$nok1=$nox1+4;
//echo 'no:'.$nok1;
//p1
$objPHPExcel->getActiveSheet()->setCellValue('A'.$nok1, "No");
//p2
$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok1, "Kode Satker(Penerimaan PNBP)");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C'.$nok1, "Kode KPPN(Penerimaan PNBP)");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D'.$nok1, "Kode Akun(Penerimaan PNBP)");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E'.$nok1, "Jumlah(Penerimaan PNBP)");

$nok2=$nok1+1;
if (count($this->data2) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok2, "Tidak Ada Data"); 
}else{
	$no2=0;	
	$dataArray2= array();
	foreach ($this->data2 as $value) {
		$no2++;
		$nil2['p1']=$no2;
		$nil2['p2']=$value->get_satker_code();
		$nil2['p3']=$value->get_kppn_code();
		$nil2['p4']=$value->get_account_code();
		
		//pengecekan
		if ($value->get_line_amount()==0){
			$nil2['p5']='0';
		}else{
			$nil2['p5']=$value->get_line_amount();
		}

		array_push($dataArray2,$nil2);

	}
	$nox2=$no2+3;
		$objPHPExcel->getActiveSheet()->fromArray($dataArray2, NULL, 'A'.$nok2);
	
}
//BELANJA PNBP
$nok3=$nok2+4;
//p1
$objPHPExcel->getActiveSheet()->setCellValue('A'.$nok3, "No");
//p2
$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok3, "Kode Satker(BELANJA PNBP)");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C'.$nok3, "Kode KPPN(BELANJA PNBP)");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D'.$nok3, "Akun(BELANJA PNBP)");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E'.$nok3, "Jumlah(BELANJA PNBP)");

 $nok4=$nok3+1;
if (count($this->data3) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok4, "Tidak Ada Data"); 
}else{
	$no3=0;	
	$dataArray3= array();
	foreach ($this->data3 as $value) {
		$no3++;
		$nil3['p1']=$no3;
		$nil3['p2']=$value->get_satker_code();
		$nil3['p3']=$value->get_kppn_code();
		$nil3['p4']=$value->get_account_code();
		
		//pengecekan
		if ($value->get_line_amount()==0){
			$nil3['p5']='0';
		}else{
			$nil3['p5']=$value->get_line_amount();
		}

		array_push($dataArray3,$nil3);

	}
    
	$nox3=$no3+3;
	$objPHPExcel->getActiveSheet()->fromArray($dataArray3, NULL, 'A'.$nok4);
	
}

//UP PNBP
$nok5=$nok4+4;
 //p1
$objPHPExcel->getActiveSheet()->setCellValue('A'.$nok5, "No");
//p2
$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok5, "Kode Satker(UP PNBP)");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C'.$nok5, "Kode KPPN(UP PNBP)");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D'.$nok5, "Jenis SPM(UP PNBP)");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E'.$nok5, "Jumlah(UP PNBP)");
$nok6=$nok5+1;
if (count($this->data4) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok6, "Tidak Ada Data"); 
}else{
	$no4=0;		
	$dataArray4= array();
	foreach ($this->data4 as $value) {
		$no4++;
		$nil4['p1']=$no4;
		$nil4['p2']=$value->get_satker_code();
		$nil4['p3']=$value->get_kppn_code();
		$nil4['p4']=$value->get_jenis_spm();		
		//pengecekan
		if ($value->get_line_amount()==0){
			$nil4['p5']='0';
		}else{
			$nil4['p5']=$value->get_line_amount();
		}

		array_push($dataArray4,$nil4);

	}
		$nox4=$no4+3;
		$objPHPExcel->getActiveSheet()->fromArray($dataArray4, NULL, 'A'.$nok6);
	
}
 
//SETORAN UP/TUP PNBP
$nok7=$nok6+4;
 //p1
$objPHPExcel->getActiveSheet()->setCellValue('A'.$nok7, "No");
//p2
$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok7, "Kode Satker(SETORAN UP/TUP PNBP)");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C'.$nok7, "Kode KPPN(SETORAN UP/TUP PNBP)");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D'.$nok7, "Akun(SETORAN UP/TUP PNBP)");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E'.$nok7, "Jumlah(SETORAN UP/TUP PNBP)");
$nok8=$nok7+1;
if (count($this->data6) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$nok8, "Tidak Ada Data"); 
}else{
	$no5=0;		
	$dataArray5= array();
	foreach ($this->data6 as $value) {
		$no5++;
		$nil5['p1']=$no5;
		$nil5['p2']=$value->get_satker_code();
		$nil5['p3']=$value->get_kppn_code();
		$nil5['p4']=$value->get_account_code();
		//pengecekan
		if ($value->get_line_amount()==0){
			$nil5['p5']='0';
		}else{
			$nil5['p5']=$value->get_line_amount();
		}

		array_push($dataArray5,$nil5);

	}
		$nox4=$no4+3;
		$objPHPExcel->getActiveSheet()->fromArray($dataArray4, NULL, 'A'.$nok8);
	
}






//pengaturan
// Set page orientation and size
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

 



$objPHPExcel->getActiveSheet()->getStyle('A5:AQ1000')->getNumberFormat()->setFormatCode('0');
$objPHPExcel->getActiveSheet()->getStyle('B5:B1000')->getNumberFormat()->setFormatCode('000000');
$objPHPExcel->getActiveSheet()->getStyle('C5:C1000')->getNumberFormat()->setFormatCode('000');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//-------------------------------------
// Save as an Excel BIFF (xls) file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 // Redirect output to a client’s web browser (Excel2007)

header('Cache-Control: no-store, no-cache,must-revalidate');header('Cache-Control: pre-check=0, post-check=0, max-age=0');header('Pragma: no-cache');header('Expires: 0');header('Content-Transfer-Encoding: none');header('Content-Type: application/vnd.ms-excel;');header('Content-type: application/x-msexcel');header('Content-Disposition: attachment;filename="Laporan"'.' '.$judul1.'.xls');
 
$objWriter->save('php://output');
exit;

?>