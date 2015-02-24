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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "NTPN");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "Tanggal Penerimaan");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Nama");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Bagan Akun SPAN 2");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Bagan Akun SPAN 3");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "Bagan Akun SPAN 4");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "Bagan Akun SPAN 5");
//p9
$objPHPExcel->getActiveSheet()->setCellValue('I4', "Bagan Akun SPAN 6");
//p10
$objPHPExcel->getActiveSheet()->setCellValue('J4', "Bagan Akun SPAN 7");
//p11
$objPHPExcel->getActiveSheet()->setCellValue('K4', "Bagan Akun SPAN 8");
//p12
$objPHPExcel->getActiveSheet()->setCellValue('L4', "Bagan Akun SPAN 9");
//p13
$objPHPExcel->getActiveSheet()->setCellValue('M4', "Bagan Akun SPAN 10");
//p14
$objPHPExcel->getActiveSheet()->setCellValue('N4', "Bagan Akun SPAN 11");
//p15
$objPHPExcel->getActiveSheet()->setCellValue('O4', "Bagan Akun SPAN 12");
//p16
$objPHPExcel->getActiveSheet()->setCellValue('P4', "Mata Uang");
//p17
$objPHPExcel->getActiveSheet()->setCellValue('Q4', "Nilai");
//Data
if (count($this->data) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;

 
	$nil['p1']=$no;
	$nil['p2']=$value->get_ntpn();
	$nil['p3']=$value->get_gl_date();
	$nil['p4']=$value->get_resp_name();	
	$nil['p5']=$value->get_segment2();
	$nil['p6']=$value->get_segment3();
	$nil['p7']=$value->get_segment4();
	$nil['p8']=$value->get_segment5();
	$nil['p9']=$value->get_segment6();
	$nil['p10']=$value->get_segment7();
	$nil['p11']=$value->get_segment8();
	$nil['p12']=$value->get_segment9();
	$nil['p13']=$value->get_segment10();
	$nil['p14']=$value->get_segment11();
	$nil['p15']=$value->get_segment12();
	$nil['p16']=$value->get_mata_uang();

	if ($value->get_amount()==0){
	$nil['p17']='0';
}else{
	$nil['p17']=$value->get_amount();
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

header('Cache-Control: no-store, no-cache,must-revalidate');header('Cache-Control: pre-check=0, post-check=0, max-age=0');header('Pragma: no-cache');header('Expires: 0');header('Content-Transfer-Encoding: none');header('Content-Type: application/vnd.ms-excel;');header('Content-type: application/x-msexcel');header('Content-Disposition: attachment;filename="Laporan"'.' '.$judul1.'.xls');
 
$objWriter->save('php://output');
exit;

?>