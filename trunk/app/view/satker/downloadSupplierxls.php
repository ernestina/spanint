<?php
if(!ini_get('safe_mode')) {
    set_time_limit(0);
    ini_set('max_input_time', -1);
	ini_set('memory_limit', -1);
	ini_set('max_execution_time', -1);	
}

$filename = "datasupplier_".$this->kppn_code.$this->ekstensi;

header("Content-Type: application/octet-stream");
header("Content-Disposition: ,Filename=".$filename);
header('Content-Transfer-Encoding: binary');
ob_end_clean();

if (isset($this->data)){
		foreach ($this->data as $value){
			echo $value->get_nama_supplier()."|";
			echo $value->get_npwp_supplier()."|";
			echo $value->get_kdvalas()."|";
			echo $value->get_nm_bank()."|";
			echo $value->get_kd_bank()."|";
			echo $value->get_kd_swift()."|";
			echo $value->get_iban()."|";
			echo $value->get_asal_bank()."|";
			echo $value->get_norek_bank()."|";
			echo $value->get_norek_penerima()."|";
			echo $value->get_nm_pemilik_rek()."|";
			echo $value->get_npwp_penerima()."|";
			echo $value->get_nip_penerima()."|";
			echo $value->get_nm_penerima()."|";
			echo $value->get_tipe_supp()."|";
			echo $value->get_satker()."|";
			echo $value->get_v_supplier_number())."|";
			echo $value->get_kppn_code()." \r\n";
	}
}
?>