<?php
if (isset($this->ekstensi)){
	$ekstensi = $this->ekstensi;
}
$filename = "supp".Session::get('kd_satker').date("dmYHis").$ekstensi;

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;Filename=".$filename);

if (isset($this->data)){
		foreach ($this->data as $value){
			echo trim($value->get_nama_supplier())."delimiter";
			echo trim($value->get_npwp_supplier())."delimiter";
			echo trim($value->get_kdvalas())."delimiter";
			echo trim($value->get_nm_bank())."delimiter";
			echo trim($value->get_cabang())."delimiter";
			echo trim($value->get_kd_bank())."delimiter";
			echo trim($value->get_kd_swift())."delimiter";
			echo trim($value->get_iban())."delimiter";
			echo trim($value->get_asal_bank())."delimiter";
			echo trim($value->get_norek_bank())."delimiter";
			echo trim($value->get_norek_penerima())."delimiter";
			echo trim($value->get_nm_pemilik_rek())."delimiter";
			echo trim($value->get_npwp_penerima())."delimiter";
			echo trim($value->get_nip_penerima())."delimiter";
			echo trim($value->get_nm_penerima())."delimiter";
			echo trim($value->get_tipe_supp())."delimiter";
			echo trim($value->get_satker())."delimiter";
			echo trim($value->get_v_supplier_number())."delimiter";
			echo trim($value->get_kppn_code())."delimiter";
			echo trim($value->get_email())."delimiter";
			echo trim($value->get_alamat())."delimiter";
			echo trim($value->get_city())."delimiter";
			echo trim($value->get_provinsi())."delimiter";
			echo trim($value->get_negara())."delimiter";
			echo trim($value->get_zip())."delimiter";
			echo trim($value->get_phone())."delimiter";
			echo trim($value->get_update_date())."delimiter";
			echo trim($value->get_kode_sandi())."\r\n";
	}
}
?>