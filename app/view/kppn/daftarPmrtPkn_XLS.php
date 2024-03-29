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
$objPHPExcel->getActiveSheet()->setCellValue('B4', "Jenis Belanja");
//p3
$objPHPExcel->getActiveSheet()->setCellValue('C4', "Jml SPM (S.D tgl 16 Desember 2014)");
//p4
$objPHPExcel->getActiveSheet()->setCellValue('D4', "Jml Netto (Rp.)(S.D tgl 16 Desember 2014) ");
//p5
$objPHPExcel->getActiveSheet()->setCellValue('E4', "Jml SPM( Diterima Tgl 17 Desember 2014)");
//p6
$objPHPExcel->getActiveSheet()->setCellValue('F4', "Jml Netto (Rp.)(Diterima Tgl 17 Desember 2014)");
//p7
$objPHPExcel->getActiveSheet()->setCellValue('G4', "Jml SPM( SP2D Terbit Tgl 17 Desember 2014)");
//p8
$objPHPExcel->getActiveSheet()->setCellValue('H4', "Jml Netto (Rp.)( SP2D Terbit Tgl 17 Desember 2014)");
//p9
$objPHPExcel->getActiveSheet()->setCellValue('I4', "Jml SPM( Dalam Proses Tgl 17 Desember 2014) ");
//p10
$objPHPExcel->getActiveSheet()->setCellValue('J4', "Jml Netto (Rp.)( Dalam Proses Tgl 17 Desember 2014)");
//p11
$objPHPExcel->getActiveSheet()->setCellValue('K4', "Jml SPM(Diterima Tgl 18 Desember 2014) ");
//p12
$objPHPExcel->getActiveSheet()->setCellValue('L4', "Jml Netto (Rp.)(Diterima Tgl 18 Desember 2014)");
//p13
$objPHPExcel->getActiveSheet()->setCellValue('M4', "Jml SPM(SP2D Terbit Tgl 18 Desember 2014) ");
//p14
$objPHPExcel->getActiveSheet()->setCellValue('N4', "Jml Netto (Rp.)(SP2D Terbit Tgl 18 Desember 2014) ");
//p15
$objPHPExcel->getActiveSheet()->setCellValue('O4', "Jml SPM(Dalam Proses Tgl 18 Desember 2014)");
//p16
$objPHPExcel->getActiveSheet()->setCellValue('P4', "Jml Netto (Rp.)(Dalam Proses Tgl 18 Desember 2014)");
//p17
$objPHPExcel->getActiveSheet()->setCellValue('Q4', "Jml SPM(Diterima Dan seterusnya s.d 30 Desember 2014)");
//p18
$objPHPExcel->getActiveSheet()->setCellValue('R4', "Jml Netto (Rp.)(Diterima Dan seterusnya s.d 30 Desember 2014)");
//p19
$objPHPExcel->getActiveSheet()->setCellValue('S4', "Jml SPM(SP2D Terbit Dan seterusnya s.d 30 Desember 2014)");
//p20
$objPHPExcel->getActiveSheet()->setCellValue('T4', "Jml Netto (Rp.)(SP2D Terbit Dan seterusnya s.d 30 Desember 2014)");
//p21
$objPHPExcel->getActiveSheet()->setCellValue('U4', "Jml SPM(Dalam Proses Dan seterusnya s.d 30 Desember 2014)");
//p22
$objPHPExcel->getActiveSheet()->setCellValue('V4', "Jml Netto (Rp.)(Dalam Proses Dan seterusnya s.d 30 Desember 2014)");

//Data
if (count($this->data) == 0) {
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Tidak Ada Data"); 
}else{
	$no=0;
	$dataArray= array();
	foreach ($this->data as $value) {
	$no++;

 
	$nil['p1']=$no;
	$nil['p2']=$value->get_akun();
	$nil['p3']=$value->get_jml_spm_dlm_proses_16();
	
	//pengecekan
	if ($value->get_nilai_spm_dlm_proses_16()==0){
		$nil['p4']='0';
	}else{
		$nil['p4']=$value->get_nilai_spm_dlm_proses_16();
	}			
	$nil['p5']=$value->get_jml_spm_diterima_17();
	
	if ($value->get_nilai_spm_diterima_17()==0){
		$nil['p6']='0';
	}else{
		$nil['p6']=$value->get_nilai_spm_diterima_17();
	}			
		$nil['p7']=$value->get_jml_spm_diterbitkan_17();
	if ($value->get_nilai_spm_diterbitkan_17()==0){
		$nil['p8']='0';
	}else{
		$nil['p8']=$value->get_nilai_spm_diterbitkan_17();
	}			

		$nil['p9']=$value->get_jml_spm_dlm_proses_17();

	if ($value->get_nilai_spm_dlm_proses_17()==0){
		$nil['p10']='0';
	}else{
		$nil['p10']=$value->get_nilai_spm_dlm_proses_17();
	}			
	
		$nil['p11']=$value->get_jml_spm_diterima_18();
	
	if ($value->get_nilai_spm_diterima_18==0){
		$nil['p12']='0';
	}else{
		$nil['p12']=$value->get_nilai_spm_diterima_18();
	}			
	
		$nil['p13']=$value->get_jml_spm_diterbitkan_18();
	
	if ($value->get_nilai_spm_diterbitkan_18()==0){
		$nil['p14']='0';
	}else{
		$nil['p14']=$value->get_nilai_spm_diterbitkan_18();
	}			
		$nil['p15']=$value->get_jml_spm_dlm_proses_18();

	if ($value->get_nilai_spm_dlm_proses_18()==0){
		$nil['p16']='0';
	}else{
		$nil['p16']=$value->get_nilai_spm_dlm_proses_18();
	}			
		$nil['p17']=$value->get_jml_spm_diterima_19();

	if ($value->get_nilai_spm_diterima_19==0){
		$nil['p18']='0';
	}else{
		$nil['p18']=$value->get_nilai_spm_diterima_19();
	}			
	$nil['p19']=$value->get_jml_spm_diterbitkan_19();
	if ($value->get_nilai_spm_diterbitkan_19()==0){
		$nil['p20']='0';
	}else{
		$nil['p20']=$value->get_nilai_spm_diterbitkan_19();
	}			
		$nil['p21']=$value->get_jml_spm_dlm_proses_19();
	if ($value->get_nilai_spm_dlm_proses_19()==0){
		$nil['p22']='0';
	}else{
		$nil['p22']=$value->get_nilai_spm_dlm_proses_19();
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