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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "Tanggal");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "Bank");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Total File(Diterbitkan SPAN)");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Total Nilai(Diterbitkan SPAN)");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Total SP2D(Diterbitkan SPAN)");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "Total Transaksi(Diterbitkan SPAN)");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "Total File(Sudah Dijalankan Bank)");
//p9
$objPHPExcel->getActiveSheet()->setCellValue('I4', "Total Nilai(Sudah Dijalankan Bank)");
//p10
$objPHPExcel->getActiveSheet()->setCellValue('J4', "Total SP2D(Sudah Dijalankan Bank)");
//p11
$objPHPExcel->getActiveSheet()->setCellValue('K4', "Total Transaksi(Sudah Dijalankan Bank)");
//p12
$objPHPExcel->getActiveSheet()->setCellValue('L4', "Total File(Yang Belum Dijalankan Bank)");
//p13
$objPHPExcel->getActiveSheet()->setCellValue('M4', "Total Nilai(Yang Belum Dijalankan Bank)");
//p14
$objPHPExcel->getActiveSheet()->setCellValue('N4', "Total SP2D(Yang Belum Dijalankan Bank)");
//p15
$objPHPExcel->getActiveSheet()->setCellValue('O4', "Total Transaksi(Yang Belum Dijalankan Bank)");
//p16
$objPHPExcel->getActiveSheet()->setCellValue('P4', "Total Droping");
//p17
$objPHPExcel->getActiveSheet()->setCellValue('Q4', "Total Penihilan");
//p18
$objPHPExcel->getActiveSheet()->setCellValue('R4', "Selisih Rp.(DROPING-(SPAN+PENIHILAN))");
//p19
$objPHPExcel->getActiveSheet()->setCellValue('S4', "Keterangan");
//Data
if (count($this->data) == 0) {
	echo 'Tidak ada data'; 
}else{
	$selisih_span_bank_file = $value->get_jumlah_ftp_file_name()-$value->get_jml_ftp_file_name_bank();
	$selisih_span_bank_amount = $value->get_jumlah_check_amount()-$value->get_jml_check_amount_bank();
	$selisih_span_bank_number = $value->get_jumlah_check_number()-$value->get_jml_check_number_bank();
	$selisih_span_bank_line_number = $value->get_jumlah_check_number_line_num()-$value->get_jml_check_number_line_num_bank();
	$selisih_droping_span_nihil = $value->get_payment_amount()-($value->get_jumlah_check_amount()+$value->get_penihilan());
	if ($selisih_droping_span_nihil<0){ 
		$ket="Kurang Droping"; 
	}elseif($selisih_droping_span_nihil > 0){
		$ket="Lebih Droping";
	}else { 
		$ket="SAMA";
	}


	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;
	$nil['p1']=$no;
	$nil['p2']=$value->get_creation_date();
	$nil['p3']=$value->get_bank();
	if ($value->get_jumlah_ftp_file_name()==0){
		$nil['p4']='0';
	}else{
		$nil['p4']=$value->get_jumlah_ftp_file_name();
	}
	if ($value->get_jumlah_check_amount()==0){
		$nil['p5']='0';
	}else{
		$nil['p5']=$value->get_jumlah_check_amount();
	}
	if ($value->get_jumlah_check_number()==0){
		$nil['p6']='0';
	}else{
		$nil['p6']=$value->get_jumlah_check_number();
	}
	if ($value->get_jumlah_check_number_line_num()==0){
		$nil['p7']='0';
	}else{
		$nil['p7']=$value->get_jumlah_check_number_line_num();
	}	
	if ($value->get_jml_ftp_file_name_bank()==0){
		$nil['p8']='0';
	}else{
		$nil['p8']=$value->get_jml_ftp_file_name_bank();
	}
	if ($value->get_jml_check_amount_bank()==0){
		$nil['p9']='0';
	}else{
		$nil['p9']=$value->get_jml_check_amount_bank();
	}
	if ($value->get_jml_check_number_bank()==0){
		$nil['p10']='0';
	}else{
		$nil['p10']=$value->get_jml_check_number_bank();
	}
	if ($value->get_jml_check_number_line_num_bank()==0){
		$nil['p11']='0';
	}else{
		$nil['p11']=$value->get_jml_check_number_line_num_bank();
	}	
							
	if ($selisih_span_bank_file==0){
		$nil['p12']='0';
	}else{
		$nil['p12']=$selisih_span_bank_file;
	}
	if ($selisih_span_bank_amount==0){
		$nil['p13']='0';
	}else{
		$nil['p13']=$selisih_span_bank_amount;
	}
	if ($selisih_span_bank_number==0){
		$nil['p14']='0';
	}else{
		$nil['p14']=$selisih_span_bank_number;
	}
	if ($selisih_span_bank_line_number==0){
		$nil['p15']='0';
	}else{
		$nil['p15']=$selisih_span_bank_line_number;
	}	
	if ($value->get_payment_amount()==0){
		$nil['p16']='0';
	}else{
		$nil['p16']=$value->get_payment_amount();
	}
	if ($value->get_penihilan()==0){
		$nil['p17']='0';
	}else{
		$nil['p17']=$value->get_penihilan();
	}
	if ($selisih_droping_span_nihil==0){
		$nil['p18']='0';
	}else{
		$nil['p18']=$selisih_droping_span_nihil;
	}
	
		$nil['p19']=$ket;
		
	
			
	
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