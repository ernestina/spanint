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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "WA_NUMBER");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "REF_NUMBER");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "RM_NAME");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "PAYMENT_DATE");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "BOOK_DATE");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "NOD_NUMBER");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "NOD_DATE");
//p9
$objPHPExcel->getActiveSheet()->setCellValue('I4', "NOD_TYPE");
//p10
$objPHPExcel->getActiveSheet()->setCellValue('J4', "SP4HLN_NUMBER");
//p11
$objPHPExcel->getActiveSheet()->setCellValue('K4', "CURR_LOAN");
//p12
$objPHPExcel->getActiveSheet()->setCellValue('L4', "AMOUNT");
//p13
$objPHPExcel->getActiveSheet()->setCellValue('M4', "RATE_TYPE");
//p14
$objPHPExcel->getActiveSheet()->setCellValue('N4', "CURR_EFF");
//p15
$objPHPExcel->getActiveSheet()->setCellValue('O4', "AMOUNT_CURR_EFF");
//p16
$objPHPExcel->getActiveSheet()->setCellValue('P4', "AMOUNT_CURR_LOCAL");
//p17
$objPHPExcel->getActiveSheet()->setCellValue('Q4', "APDPL_NUMBER");
//p18
$objPHPExcel->getActiveSheet()->setCellValue('R4', "REGISTER_NUMBER");
//p19
$objPHPExcel->getActiveSheet()->setCellValue('S4', "AKUN_CODE");
//p20
$objPHPExcel->getActiveSheet()->setCellValue('T4', "OUTPUT_CODE");
//p21
$objPHPExcel->getActiveSheet()->setCellValue('U4', "DANA_CODE");
//p22
$objPHPExcel->getActiveSheet()->setCellValue('V4', "AMOUNT_SERVICE");
//p23
$objPHPExcel->getActiveSheet()->setCellValue('W4', "MEDIUM_NAME");
//p24
$objPHPExcel->getActiveSheet()->setCellValue('X4', "ONLENDING_DESC");
//p25
$objPHPExcel->getActiveSheet()->setCellValue('Y4', "DMFAS_ID");
//p26
$objPHPExcel->getActiveSheet()->setCellValue('Z4', "REKSUS_TYPE");
//p27
$objPHPExcel->getActiveSheet()->setCellValue('AA4', "REKSUS_NUMBER");

//Data
if (count($this->data) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;

 
	$nil['p1']=$no;
	$nil['p2']=$value->get_wa_number();
	$nil['p3']=$value->get_ref_number();
	$nil['p4']=$value->get_rm_name();
	$nil['p5']=$value->get_payment_date();
	$nil['p6']=$value->get_book_date();
	$nil['p7']=$value->get_nod_number();
	$nil['p8']=$value->get_nod_date();
	$nil['p9']=$value->get_type();
	$nil['p10']=$value->get_sp4hln_number();
	$nil['p11']=$value->get_curr_loan();
	$nil['p12']=$value->get_amount();
	$nil['p13']=$value->get_rate_type();
	$nil['p14']=$value->get_curr_eff();
	$nil['p15']=$value->get_amount_curr_eff();
	$nil['p16']=$value->get_amount_curr_local();
	$nil['p17']=$value->get_apdpl_number();
	$nil['p18']=$value->get_register_number();
	$nil['p19']=$value->get_akun_code();
	$nil['p20']=$value->get_output_code();
	$nil['p21']=$value->get_dana_code();
	$nil['p22']=$value->get_amount_service();
	$nil['p23']=$value->get_medium_name();
	$nil['p24']=$value->get_onlending_desc();
	$nil['p25']=$value->get_dmfas_id();
	$nil['p26']=$value->get_reksus_type();
	$nil['p27']=$value->get_reksus_number();
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
$objPHPExcel->getActiveSheet()->getStyle('J5:J1000')->getNumberFormat()->setFormatCode('0000');


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