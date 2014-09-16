<?php

// foreach ($this->data as $value) {
    // $kdsatker = $value->get_nmsatker();
// }

// foreach ($this->data2 as $value) {
    // $tgl1 = $value->get_tgl1();
    // $tgl2 = $value->get_tgl2();
// }


$time = strtotime("now");
$filename = Session::get('id_user')."_ADKKONFIRMASI_".$time.".txt";

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;Filename=" . $filename);

if (isset($this->data1)) {
    foreach ($this->data1 as $value) {
		echo trim($value->get_segment1()) . ";";
        echo trim($value->get_ntpn()) . ";";
        echo trim($value->get_file_name()) . ";";
        echo trim($value->get_segment3()) . ";";
        echo trim($value->get_amount()) . "\r\n";
       
    }
}
?>