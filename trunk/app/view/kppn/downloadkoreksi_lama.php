<?php
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

	foreach ($this->data as $value) {
	$ntpn = $value->get_ntpn();
	}

$filename = "cakyus.xlsx";

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;Filename=" . $filename);


// Add some data
if (isset($this->data)){
	$no = 0;
	$objPHPExcel->setActiveSheetIndex(0);
	foreach ($this->data as $value) {
	$no++;
	
	// $cell = $objPHPExcel->getActiveSheet()->GetCell('A'.$no);
	// $cell->SetValue($value->get_ntpn());
	//$PHPExcelObject->getActiveSheet()->getStyle($cell)->getNumberFormat()->setFormatCode('0');
	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$no, $value->get_ntpn());
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$no, $value->get_file_name());
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$no, $value->get_gl_date());
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$no, $value->get_segment1());
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$no, $value->get_segment2());
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$no, $value->get_segment3());
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$no, $value->get_segment4());
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$no, $value->get_segment5());
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$no, $value->get_segment6());
	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$no, $value->get_segment7());
	$objPHPExcel->getActiveSheet()->SetCellValue('K'.$no, $value->get_segment8());
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$no, $value->get_segment9());
	$objPHPExcel->getActiveSheet()->SetCellValue('M'.$no, $value->get_segment10());
	$objPHPExcel->getActiveSheet()->SetCellValue('N'.$no, $value->get_segment11());
	$objPHPExcel->getActiveSheet()->SetCellValue('O'.$no, $value->get_segment12());
	$objPHPExcel->getActiveSheet()->SetCellValue('P'.$no, $value->get_mata_uang());
	$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$no, $value->get_amount());
	}
}
$objPHPExcel->getDefaultStyle()
    ->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
$objPHPExcel->getActiveSheet()->setTitle('ADK Konfirmasi');
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('php://output');
