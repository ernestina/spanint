<?php

if (isset($this->ekstensi)) {
    $ekstensi = $this->ekstensi;
}
$filename = "supp" . Session::get('kd_satker') . date("dmYHis");
$filenames = $filename . $ekstensi;

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;Filename=" . $filenames);

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?> \n";
if (isset($this->data)) {
    foreach ($this->data as $value) {
        echo "<" . $filename . "s><" . $filename . ">";
        echo "<nama_supplier>" . trim($value->get_nama_supplier()) . "</nama_supplier>";
        echo "<npwp_supplier>" . trim($value->get_npwp_supplier()) . "</npwp_supplier>";
        echo "<kdvalas>" . trim($value->get_kdvalas()) . "</kdvalas>";
        echo "<nm_bank>" . trim($value->get_nm_bank()) . "</nm_bank>";
        echo "<cabang>" . trim($value->get_cabang()) . "</cabang>";
        echo "<kd_bank>" . trim($value->get_kd_bank()) . "</kd_bank>";
        echo "<kd_swift>" . trim($value->get_kd_swift()) . "</kd_swift>";
        echo "<iban>" . trim($value->get_iban()) . "</iban>";
        echo "<asal_bank>" . trim($value->get_asal_bank()) . "</asal_bank>";
        echo "<norek_bank>" . trim($value->get_norek_bank()) . "</norek_bank>";
        echo "<norek_penerima>" . trim($value->get_norek_penerima()) . "</norek_penerima>";
        echo "<nm_pemilik_rek>" . trim($value->get_nm_pemilik_rek()) . "</nm_pemilik_rek>";
        echo "<npwp_penerima>" . trim($value->get_npwp_penerima()) . "</npwp_penerima>";
        echo "<nip_penerima>" . trim($value->get_nip_penerima()) . "</nip_penerima>";
        echo "<nm_penerima>" . trim($value->get_nm_penerima()) . "</nm_penerima>";
        echo "<tipe_supp>" . trim($value->get_tipe_supp()) . "</tipe_supp>";
        echo "<satker>" . trim($value->get_satker()) . "</satker>";
        echo "<v_supplier_number>" . trim($value->get_v_supplier_number()) . "</v_supplier_number>";
        echo "<kppn_code>" . trim($value->get_kppn_code()) . "</kppn_code>";
        echo "<email>" . trim($value->get_email()) . "</email>";
        echo "<alamat>" . trim($value->get_alamat()) . "</alamat>";
        echo "<city>" . trim($value->get_city()) . "</city>";
        echo "<provinsi>" . trim($value->get_provinsi()) . "</provinsi>";
        echo "<negara>" . trim($value->get_negara()) . "</negara>";
        echo "<zip>" . trim($value->get_zip()) . "</zip>";
        echo "<phone>" . trim($value->get_phone()) . "</phone>";
        echo "<update_date>" . trim($value->get_update_date()) . "</update_date>";
        echo "<kode_sandi>" . trim($value->get_kode_sandi()) . "</kode_sandi>";
        echo "</" . $filename . "></" . $filename . "s>";
    }
}
?>