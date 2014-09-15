<?php

/*if (!ini_get('safe_mode')) {
    set_time_limit(0);
    ini_set('max_input_time', -1);
    ini_set('memory_limit', -1);
    ini_set('max_execution_time', -1);
}*/

	/*$server_ftp ='10.100.93.134';
	$user_ftp ='spanuat:spanuat';
	$direktori='APLIKASI/CEKSUPPLIER/data_supplier_kppn';
	$filename = "datasupplier_" . $this->kppn_code . $this->ekstensi;
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment ,Filename=" . $filename);
	header('Content-Transfer-Encoding: binary');
	ob_end_clean();*/
	
	//setting alamat download dari ftp, contoh : $ftp_address = "ftp://spanuat:spanuat@10.100.93.134/APLIKASI/CEKSUPPLIER/data_supplier_kppn/datasupplier_088.txt";
	//ftp://10.100.93.134/APLIKASI/CEKSUPPLIER/data_supplier_kppn/datasupplier_088.txt
	
	//$ftp_address = "ftp://".$user_ftp."@".$server_ftp."/".$direktori."/".$filename;
        $ftp_address ='http://10.100.244.253/public/datasupplier_088.txt';
	//var_dump($ftp_address);
	//$download_addres="ftp://".$user_ftp."@".$server_ftp."/".$direktori."/".$filename;
	header('location:' . $ftp_address);
	
	/*$file = $ftp_address;
	$fd=fopen($file,"r");
	
	while (!feof($fd)){
		$buffer=fread($fd,1028);
		echo $buffer;
	}
	fclose($fd);*/
	exit;
	
?>