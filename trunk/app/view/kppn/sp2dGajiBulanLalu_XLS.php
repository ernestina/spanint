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
//p1
$objPHPExcel->getActiveSheet()->setCellValue('A4', "No");
//p2
$objPHPExcel->getActiveSheet()->setCellValue('B4', "Bank");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "'Des'.$kdtahun.'(Jumlah SP2D)'");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Jan(Jumlah SP2D)");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Feb(Jumlah SP2D)");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Mar(Jumlah SP2D)");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "Apr(Jumlah SP2D)");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "Mei(Jumlah SP2D)");
//p9
$objPHPExcel->getActiveSheet()->setCellValue('I4', "Jun(Jumlah SP2D)");
//p10
$objPHPExcel->getActiveSheet()->setCellValue('J4', "Jul(Jumlah SP2D)");
//p11
$objPHPExcel->getActiveSheet()->setCellValue('K4', "Ags(Jumlah SP2D)");
//p12
$objPHPExcel->getActiveSheet()->setCellValue('L4', "Sep(Jumlah SP2D)");
//p13
$objPHPExcel->getActiveSheet()->setCellValue('M4', "Okt(Jumlah SP2D)");
//p14
$objPHPExcel->getActiveSheet()->setCellValue('N4', "Nov(Jumlah SP2D)");
//p15
$objPHPExcel->getActiveSheet()->setCellValue('O4', "Des(Jumlah SP2D)");

//Data
if (count($this->data) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;
	$nil['p1']=$no;
	if ($value->get_payment_date()==0){
		$nil['p2']='0';
	}else{
		$nil['p2']=$value->get_payment_date();
	}
	if ($value->get_return_desc()==0){
		$nil['p3']='0';
	}else{
		$nil['p3']=$value->get_return_desc();
	}
	if ($value->get_invoice_num()==0){
		$nil['p4']='0';
	}else{
		$nil['p4']=$value->get_invoice_num();
	}
	if ($value->get_check_date()==0){
		$nil['p5']='0';
	}else{
		$nil['p5']=$value->get_check_date();
	}
	
	if ($value->get_creation_date()==0){
		$nil['p6']='0';
	}else{
		$nil['p6']=$value->get_creation_date();
	}
	
	if ($value->get_check_number()==0){
		$nil['p7']='0';
	}else{
		$nil['p7']=$value->get_check_number();
	}


	if ($value->get_check_number_line_num()==0){
		$nil['p8']='0';
	}else{
		$nil['p8']=$value->get_check_number_line_num();
	}		
	if ($value->get_check_amount()==0){
		$nil['p9']='0';
	}else{
		$nil['p9']=$value->get_check_amount();
	}	

	if ($value->get_bank_account_name()==0){
		$nil['p10']='0';
	}else{
		$nil['p10']=$value->get_bank_account_name();
	}	
	if ($value->get_bank_name()==0){
		$nil['p11']='0';
	}else{
		$nil['p11']=$value->get_bank_name();
	}
	
	if ($value->get_vendor_ext_bank_account_num()==0){
		$nil['p12']='0';
	}else{
		$nil['p12']=$value->get_vendor_ext_bank_account_num();
	}
	
	if ($value->get_vendor_name()==0){
		$nil['p13']='0';
	}else{
		$nil['p13']=$value->get_vendor_name();
	}
if ($value->get_invoice_description()==0){
		$nil['p14']='0';
	}else{
		$nil['p14']=$value->get_invoice_description();
	}
	if ($value->get_ftp_file_name()==0){
		$nil['p15']='0';
	}else{
		$nil['p15']=$value->get_ftp_file_name();
	}
		
		array_push($dataArray,$nil);

	}
    
	$nox=$no+3;
	$objPHPExcel->getActiveSheet()->fromArray($dataArray, NULL, 'A5');

}


//pengaturan
// Set page orientation and size
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

 



$objPHPExcel->getActiveSheet()->getStyle('A5:AQ1000')->getNumberFormat()->setFormatCode('0');
//$objPHPExcel->getActiveSheet()->getStyle('B5:B1000')->getNumberFormat()->setFormatCode('000');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//-------------------------------------
// Save as an Excel BIFF (xls) file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan"'.' '.$judul1.'.xls');header('Cache-Control: max-age=0');header("Pragma: no-cache");header("Expires: 0");header("Cache-Control: no-cache");
 
$objWriter->save('php://output');
exit;

?>