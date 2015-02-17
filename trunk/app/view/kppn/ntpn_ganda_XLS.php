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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "Kode KPPN");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "NTPN");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Bulan");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Tanggal Buku");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Nilai");

//Data
if (count($this->data) == 0) {
	echo 'Tidak ada data'; 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;
	$nil['p1']=$no;
	$nil['p2']=$value->get_segment2();
	$nil['p3']=$value->get_ntpn();
	$nil['p4']=$value->get_segment1();
	$nil['p5']=$value->get_gl_date();
	
	if ($value->get_amount()==0){
		$nil['p6']='0';
	}else{
		$nil['p6']=$value->get_amount();
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
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');
 

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(11.1);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setAutoSize(true);


$objPHPExcel->getActiveSheet()->getStyle('A5:AQ1000')->getNumberFormat()->setFormatCode('0');
//$objPHPExcel->getActiveSheet()->getStyle('B5:B1000')->getNumberFormat()->setFormatCode('000');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//-------------------------------------
// Save as an Excel BIFF (xls) file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan"'.' '.$judul1.'.xlsx');
header('Cache-Control: max-age=0');
 
$objWriter->save('php://output');
exit;

?>