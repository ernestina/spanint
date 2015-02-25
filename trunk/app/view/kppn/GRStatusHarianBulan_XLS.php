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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "KPPN");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "Tanggal LHP 1");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Tanggal LHP 2");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Tanggal LHP 3");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Tanggal LHP 4");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "Tanggal LHP 5");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "Tanggal LHP 6");
//p9
$objPHPExcel->getActiveSheet()->setCellValue('I4', "Tanggal LHP 7");
//p10
$objPHPExcel->getActiveSheet()->setCellValue('J4', "Tanggal LHP 8");
//p11
$objPHPExcel->getActiveSheet()->setCellValue('K4', "Tanggal LHP 9");
//p12
$objPHPExcel->getActiveSheet()->setCellValue('L4', "Tanggal LHP 10");
//p13
$objPHPExcel->getActiveSheet()->setCellValue('M4', "Tanggal LHP 11");
//p14
$objPHPExcel->getActiveSheet()->setCellValue('N4', "Tanggal LHP 12");
//p15
$objPHPExcel->getActiveSheet()->setCellValue('O4', "Tanggal LHP 13");
//p16
$objPHPExcel->getActiveSheet()->setCellValue('P4', "Tanggal LHP 14");
//p17
$objPHPExcel->getActiveSheet()->setCellValue('Q4', "Tanggal LHP 15");
//p18
$objPHPExcel->getActiveSheet()->setCellValue('R4', "Tanggal LHP 16");
//p19
$objPHPExcel->getActiveSheet()->setCellValue('S4', "Tanggal LHP 17");
//p20
$objPHPExcel->getActiveSheet()->setCellValue('T4', "Tanggal LHP 18");
//p21
$objPHPExcel->getActiveSheet()->setCellValue('U4', "Tanggal LHP 19");
//p22
$objPHPExcel->getActiveSheet()->setCellValue('V4', "Tanggal LHP 20");
//p23
$objPHPExcel->getActiveSheet()->setCellValue('W4', "Tanggal LHP 21");
//p24
$objPHPExcel->getActiveSheet()->setCellValue('X4', "Tanggal LHP 22");
//p25
$objPHPExcel->getActiveSheet()->setCellValue('Y4', "Tanggal LHP 23");
//p26
$objPHPExcel->getActiveSheet()->setCellValue('Z4', "Tanggal LHP 24");
//p27
$objPHPExcel->getActiveSheet()->setCellValue('AA4', "Tanggal LHP 25");
//p28
$objPHPExcel->getActiveSheet()->setCellValue('AB4', "Tanggal LHP 26");
//p29
$objPHPExcel->getActiveSheet()->setCellValue('AC4', "Tanggal LHP 27");
//p30
$objPHPExcel->getActiveSheet()->setCellValue('AD4', "Tanggal LHP 28");
//p31
$objPHPExcel->getActiveSheet()->setCellValue('AE4', "Tanggal LHP 29");
//p32
$objPHPExcel->getActiveSheet()->setCellValue('AF4', "Tanggal LHP 30");
//p33
$objPHPExcel->getActiveSheet()->setCellValue('AG4', "Tanggal LHP 31");
//Data
if (count($this->data) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;

 
	$nil['p1']=$no;
	$nil['p2']=$nama_kppn.'|'.$value->get_kppn();
	
	//pengecekan
	if ($value->get_r01()==0){
		$nil['p3']='0';
	}else{
		$nil['p3']=$value->get_r01();
	}			
	if ($value->get_r02()==0){
		$nil['p4']='0';
	}else{
		$nil['p4']=$value->get_r02();
	}			
	if ($value->get_r03()==0){
		$nil['p5']='0';
	}else{
		$nil['p5']=$value->get_r03();
	}			
	if ($value->get_r04()==0){
		$nil['p6']='0';
	}else{
		$nil['p6']=$value->get_r04();
	}			
	if ($value->get_r05()==0){
		$nil['p7']='0';
	}else{
		$nil['p7']=$value->get_r05();
	}			

	if ($value->get_r06()==0){
		$nil['p8']='0';
	}else{
		$nil['p8']=$value->get_r06();
	}			
	if ($value->get_r07()==0){
		$nil['p9']='0';
	}else{
		$nil['p9']=$value->get_r07();
	}			
	if ($value->get_r08()==0){
		$nil['p10']='0';
	}else{
		$nil['p10']=$value->get_r08();
	}			
	if ($value->get_r09()==0){
		$nil['p11']='0';
	}else{
		$nil['p11']=$value->get_r09();
	}			
	if ($value->get_r10()==0){
		$nil['p12']='0';
	}else{
		$nil['p12']=$value->get_r10();
	}								
	if ($value->get_r11()==0){
		$nil['p13']='0';
	}else{
		$nil['p13']=$value->get_r11();
	}			
	if ($value->get_r12()==0){
		$nil['p14']='0';
	}else{
		$nil['p14']=$value->get_r12();
	}			
	if ($value->get_r13()==0){
		$nil['p15']='0';
	}else{
		$nil['p15']=$value->get_r13();
	}			
	if ($value->get_r14()==0){
		$nil['p16']='0';
	}else{
		$nil['p16']=$value->get_r14();
	}			
	if ($value->get_r15()==0){
		$nil['p17']='0';
	}else{
		$nil['p17']=$value->get_r15();
	}			
	if ($value->get_r16()==0){
		$nil['p18']='0';
	}else{
		$nil['p18']=$value->get_r16();
	}			
	if ($value->get_r17()==0){
		$nil['p19']='0';
	}else{
		$nil['p19']=$value->get_r17();
	}			
	if ($value->get_r18()==0){
		$nil['p20']='0';
	}else{
		$nil['p20']=$value->get_r18();
	}			
	if ($value->get_r19()==0){
		$nil['p21']='0';
	}else{
		$nil['p21']=$value->get_r19();
	}			
	if ($value->get_r20()==0){
		$nil['p22']='0';
	}else{
		$nil['p22']=$value->get_r20();
	}			
	if ($value->get_r21()==0){
		$nil['p23']='0';
	}else{
		$nil['p23']=$value->get_r21();
	}			
	if ($value->get_r22()==0){
		$nil['p24']='0';
	}else{
		$nil['p24']=$value->get_r22();
	}			
	if ($value->get_r23()==0){
		$nil['p25']='0';
	}else{
		$nil['p25']=$value->get_r23();
	}			
	if ($value->get_r24()==0){
		$nil['p26']='0';
	}else{
		$nil['p26']=$value->get_r24();
	}			
	if ($value->get_r25()==0){
		$nil['p27']='0';
	}else{
		$nil['p27']=$value->get_r25();
	}			

	if ($value->get_r26()==0){
		$nil['p28']='0';
	}else{
		$nil['p28']=$value->get_r26();
	}			
	if ($value->get_r27()==0){
		$nil['p29']='0';
	}else{
		$nil['p29']=$value->get_r27();
	}			
	if ($value->get_r28()==0){
		$nil['p30']='0';
	}else{
		$nil['p30']=$value->get_r28();
	}			

	if ($value->get_r29()==0){
		$nil['p31']='0';
	}else{
		$nil['p31']=$value->get_r29();
	}			

	if ($value->get_r30()==0){
		$nil['p32']='0';
	}else{
		$nil['p32']=$value->get_r30();
	}			
	if ($value->get_r31()==0){
		$nil['p33']='0';
	}else{
		$nil['p33']=$value->get_r31();
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