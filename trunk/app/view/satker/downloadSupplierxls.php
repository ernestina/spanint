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
	
	$server_ftp ='192.168.1.5';
	$user_ftp ='';
	$direktori='tes_download';
	$filename='datasupplier_'.$this->kppn_code;
	
	$file = "\\\\".$user_ftp.$server_ftp."\\".$direktori."\\".$filename.$this->ekstensi;
	
	

	//$file = "\\\\192.168.1.5\\tes_download\\datasupplier_004.txt";
	$fd=fopen($file,"r");
	
	while (!feof($fd)){
		$buffer=fread($fd,1028);
		echo $buffer;
	}
	fclose($fd);
	exit;
	
?>