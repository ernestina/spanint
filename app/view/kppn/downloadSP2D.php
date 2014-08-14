<?php
foreach ($this->data as $value){
			$kdsatker = $value->get_nmsatker();
	}

foreach ($this->data2 as $value){
			$tgl1 = $value->get_tgl1();
			$tgl2 = $value->get_tgl2();
}
$filename = $kdsatker."_".$tgl2."_".$tgl1.".txt";

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;Filename=".$filename);

if (isset($this->data)){
		foreach ($this->data as $value){
			echo trim($value->get_thang())."\t";
			echo trim($value->get_nmsatker())."\t";
			echo trim($value->get_invoice_num())."\t";
			echo trim($value->get_invoice_date())."\t";
			echo trim($value->get_check_number())."\t";
			echo trim($value->get_check_date())."\t";
			echo trim($value->get_kdbankpos())."\t";
			echo trim($value->get_pilih())." \r\n";
	}
}
?>