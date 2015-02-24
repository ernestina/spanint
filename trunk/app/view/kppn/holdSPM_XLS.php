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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "Nomor Invoice");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "Nilai Invoice");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Uraian");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Alasan Hold");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Status Release");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "Tanggal Hold");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "Status Invoice");

//Data
if (count($this->data) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;
	$nil['p1']=$no;
	$nil['p2']=$value->get_invoice_num();
	if ($value->get_invoice_amount()==0){
		$nil['p3']='0';
	}else{
		$nil['p3']=$value->get_invoice_amount();
	}		
	$nil['p4']=$value->get_description();
	$nil['p5']=$value->get_hold_reason();
	$nil['p6']=$value->get_release_reason();
	$nil['p7']=$value->get_hold_date();
	$nil['p8']=$value->get_keterangan();
	
	
			
	
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