<?php

if (!ini_get('safe_mode')) {
    set_time_limit(0);
    ini_set('max_input_time', -1);
    ini_set('memory_limit', -1);
    ini_set('max_execution_time', -1);
}
	$filename = "datasupplier_" . $this->kppn_code . $this->ekstensi;
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: ,Filename=" . $filename);
	header('Content-Transfer-Encoding: binary');
	ob_end_clean();
	
	//setting alamat download dari ftp, contoh : $ftp_address = "ftp://spanuat:spanuat@10.100.93.134/APLIKASI/CEKSUPPLIER/data_supplier_kppn/datasupplier_088.xlsx";
	
	$server_ftp ='10.100.93.134';
	$user_ftp ='spanuat:spanuat';
	$direktori='APLIKASI/CEKSUPPLIER/data_supplier_kppn';
	$ekstensi=".xlsx";
	$download_addres="ftp://".$user_ftp."@".$server_ftp."/".$direktori."/".".xlsx";
	
	$ftp_address = "ftp://spanuat:spanuat@10.100.93.134/APLIKASI/CEKSUPPLIER/data_supplier_kppn/datasupplier_088.xlsx";
	
	//$file = "\\\\10.244.6.69\\tes_download\\datasupplier_004.txt";
	
	$file = $ftp_address;
	

	//$file = "\\\\192.168.1.5\\tes_download\\datasupplier_004.txt";
	$fd=fopen($file,"r");
	
	while (!feof($fd)){
		$buffer=fread($fd,1028);
		echo $buffer;
	}
	fclose($fd);
	exit;
	
?>