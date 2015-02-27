<?php

foreach ($this->data as $value) {
    $wa_number = $value->get_wa_number();
    $tgl = $value->get_payment_date();
}
if (isset($this->judul)){
    $wa_number = $this->judul;
    $tgl = date("d-m-Y h:i:s");
}

$filename = $wa_number . "_" . $tgl .".txt";

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;Filename=" . $filename);

if (isset($this->data)) {
    foreach ($this->data as $value) {
        echo trim($value->get_wa_number()) . ";";
        echo trim($value->get_ref_number()) . ";";
        echo trim($value->get_rm_name()) . ";";
        echo trim($value->get_payment_date()) . ";";
        echo trim($value->get_book_date()) . ";";
        echo trim($value->get_nod_number()) . ";";
        echo trim($value->get_nod_date()) . ";";
        echo trim($value->get_type()) . ";";
        echo trim($value->get_sp4hln_number()) . ";";
        echo trim($value->get_curr_loan()) . ";";
        echo trim($value->get_amount()) . ";";
        echo trim($value->get_rate_type()) . ";";
        echo trim($value->get_curr_eff()) . ";";
        echo trim($value->get_amount_curr_eff()) . ";";
        echo trim($value->get_amount_curr_local()) . ";";
        echo trim($value->get_apdpl_number()) . ";";
        echo trim($value->get_register_number()) . ";";
        echo trim($value->get_akun_code()) . ";";
        echo trim($value->get_output_code()) . ";";
        echo trim($value->get_dana_code()) . ";";
        echo trim($value->get_amount_service()) . ";";
        echo trim($value->get_medium_name()) . ";";
        echo trim($value->get_onlending_desc()) . ";";
        echo trim($value->get_dmfas_id()) . ";";
        echo trim($value->get_reksus_type()) . ";";
        echo trim($value->get_reksus_number()) . " \r\n";
    }
}
?>  