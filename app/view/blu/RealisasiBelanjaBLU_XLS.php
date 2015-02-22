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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "BA-Satker");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "Nama Satker");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Rumpun");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Keterangan");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Pagu Pegawai");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "Realisasi Pegawai");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "Sisa Pegawai");
//p9
$objPHPExcel->getActiveSheet()->setCellValue('I4', "Pagu Barang");
//p10
$objPHPExcel->getActiveSheet()->setCellValue('J4', "Realisasi Barang");
//p11
$objPHPExcel->getActiveSheet()->setCellValue('K4', "Sisa Barang");
//p12
$objPHPExcel->getActiveSheet()->setCellValue('L4', "Pagu Jasa");
//p13
$objPHPExcel->getActiveSheet()->setCellValue('M4', "Realisasi Jasa");
//p14
$objPHPExcel->getActiveSheet()->setCellValue('N4', "Sisa Jasa");
//p15
$objPHPExcel->getActiveSheet()->setCellValue('O4', "Pagu Pemeliharaan");
//p16
$objPHPExcel->getActiveSheet()->setCellValue('P4', "Realisasi Pemeliharaan");
//p17
$objPHPExcel->getActiveSheet()->setCellValue('Q4', "Sisa Pemeliharaan");
//p18
$objPHPExcel->getActiveSheet()->setCellValue('R4', "Pagu Perjalanan");
//p19
$objPHPExcel->getActiveSheet()->setCellValue('S4', "Realisasi Perjalanan");
//p20
$objPHPExcel->getActiveSheet()->setCellValue('T4', "Sisa Perjalanan");
//p21
$objPHPExcel->getActiveSheet()->setCellValue('U4', "Pagu Peng. Endowment Fund");
//p22
$objPHPExcel->getActiveSheet()->setCellValue('V4', "Realisasi Peng. Endowment Fund");
//p23
$objPHPExcel->getActiveSheet()->setCellValue('W4', "Sisa Peng. Endowment Fund");
//p24
$objPHPExcel->getActiveSheet()->setCellValue('X4', "Pagu Brg&Jasa BLU Lainnya");
//p25
$objPHPExcel->getActiveSheet()->setCellValue('Y4', "Realisasi Brg&Jasa BLU Lainnya");
//p26
$objPHPExcel->getActiveSheet()->setCellValue('Z4', "Sisa Brg&Jasa BLU Lainnya");
//p27
$objPHPExcel->getActiveSheet()->setCellValue('AA4', "Pagu Total");
//p28
$objPHPExcel->getActiveSheet()->setCellValue('AB4', "Realisasi Total");
//p29
$objPHPExcel->getActiveSheet()->setCellValue('AC4', "Sisa Total");

//Data
if (count($this->data) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;

 
	$nil['p1']=$no;
	$nil['p2']=strtoupper($value->get_ba());
	$nil['p3']=strtoupper($value->get_satker());
	$nil['p4']=$value->get_dipa();
	$nil['p5']=$value->get_rumpun();
	
	//pengecekan
	if ($value->get_pagu_51()==0){
		$nil['p6']='0';
	}else{
		$nil['p6']=$value->get_pagu_51();
	}			
	if ($value->get_belanja_51()==0){
		$nil['p7']='0';
	}else{
		$nil['p7']=$value->get_belanja_51();
	}			
	if ($value->get_pagu_51()-$value->get_belanja_51()==0){
		$nil['p8']='0';
	}else{
		$nil['p8']=$value->get_pagu_51()-$value->get_belanja_51();
	}			
	if ($value->get_pagu_52()==0){
		$nil['p9']='0';
	}else{
		$nil['p9']=$value->get_pagu_52();
	}			
	if ($value->get_belanja_52()==0){
		$nil['p10']='0';
	}else{
		$nil['p10']=$value->get_belanja_52();
	}			

	if ($value->get_pagu_52()-$value->get_belanja_52()==0){
		$nil['p11']='0';
	}else{
		$nil['p11']=$value->get_pagu_52()-$value->get_belanja_52();
	}			
	if ($value->get_pagu_53()==0){
		$nil['p12']='0';
	}else{
		$nil['p12']=$value->get_pagu_53();
	}			
	if ($value->get_belanja_53()==0){
		$nil['p13']='0';
	}else{
		$nil['p13']=$value->get_belanja_53();
	}			
	if ($value->get_pagu_53()-$value->get_belanja_53()==0){
		$nil['p14']='0';
	}else{
		$nil['p14']=$value->get_pagu_53()-$value->get_belanja_53();
	}			
	if ($value->get_pagu_54()==0){
		$nil['p15']='0';
	}else{
		$nil['p15']=$value->get_pagu_54();
	}								
	if ($value->get_belanja_54()==0){
		$nil['p16']='0';
	}else{
		$nil['p16']=$value->get_belanja_54();
	}			
	if ($value->get_pagu_54()-$value->get_belanja_54()==0){
		$nil['p17']='0';
	}else{
		$nil['p17']=$value->get_pagu_54()-$value->get_belanja_54();
	}			
	if ($value->get_pagu_55()==0){
		$nil['p18']='0';
	}else{
		$nil['p18']=$value->get_pagu_55();
	}			
	if ($value->get_belanja_55()==0){
		$nil['p19']='0';
	}else{
		$nil['p19']=$value->get_belanja_55();
	}			
	if ($value->get_pagu_55()-$value->get_belanja_55()==0){
		$nil['p20']='0';
	}else{
		$nil['p20']=$value->get_pagu_55()-$value->get_belanja_55();
	}			
	if ($value->get_pagu_56()==0){
		$nil['p21']='0';
	}else{
		$nil['p21']=$value->get_pagu_56();
	}			
	if ($value->get_belanja_56()==0){
		$nil['p22']='0';
	}else{
		$nil['p22']=$value->get_belanja_56();
	}			
	if ($value->get_pagu_56()-$value->get_belanja_56()==0){
		$nil['p23']='0';
	}else{
		$nil['p23']=$value->get_pagu_56()-$value->get_belanja_56();
	}			
	if ($value->get_pagu_57()==0){
		$nil['p24']='0';
	}else{
		$nil['p24']=$value->get_pagu_57();
	}			
	if ($value->get_belanja_57()==0){
		$nil['p25']='0';
	}else{
		$nil['p25']=$value->get_belanja_57();
	}			
	if ($value->get_pagu_57()-$value->get_belanja_57()==0){
		$nil['p26']='0';
	}else{
		$nil['p26']=$value->get_pagu_57()-$value->get_belanja_57();
	}			
			
	if ($value->get_pagu()==0){
		$nil['p27']='0';
	}else{
		$nil['p27']=$value->get_pagu();
	}			

	if ($value->get_realisasi()==0){
		$nil['p28']='0';
	}else{
		$nil['p28']=$value->get_realisasi();
	}			

	if ($value->get_pagu()-$value->get_realisasi()==0){
		$nil['p29']='0';
	}else{
		$nil['p29']=$value->get_pagu()-$value->get_realisasi();
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
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan"'.' '.$judul1.'.xls');
 
$objWriter->save('php://output');
exit;

?>