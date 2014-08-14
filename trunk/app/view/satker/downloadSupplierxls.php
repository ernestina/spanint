<?php
$filename = "datasupplier_".$this->kppn_code.$this->ekstensi;

header("Content-Type: application/octet-stream");
header("Content-Disposition: ,Filename=".$filename);


if (isset($this->data)){
		foreach ($this->data as $value){
			echo trim($value->get_nama_supplier())."|";
			echo trim($value->get_npwp_supplier())."|";
			echo trim($value->get_kdvalas())."|";
			echo trim($value->get_nm_bank())."|";
			echo trim($value->get_kd_bank())."|";
			echo trim($value->get_kd_swift())."|";
			echo trim($value->get_iban())."|";
			echo trim($value->get_asal_bank())."|";
			echo trim($value->get_norek_bank())."|";
			echo trim($value->get_norek_penerima())."|";
			echo trim($value->get_nm_pemilik_rek())."|";
			echo trim($value->get_npwp_penerima())."|";
			echo trim($value->get_nip_penerima())."|";
			echo trim($value->get_nm_penerima())."|";
			echo trim($value->get_tipe_supp())."|";
			echo trim($value->get_satker())."|";
			echo trim($value->get_v_supplier_number())."|";
			echo trim($value->get_kppn_code())." \r\n";
	}
}
?>