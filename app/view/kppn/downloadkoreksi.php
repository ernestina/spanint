<?php

// foreach ($this->data as $value) {
    // $kdsatker = $value->get_nmsatker();
// }

// foreach ($this->data2 as $value) {
    // $tgl1 = $value->get_tgl1();
    // $tgl2 = $value->get_tgl2();
// }

$time = strtotime("now");
$filename = Session::get('id_user')."_ADKKOREKSI_".$time.".txt";

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;Filename=" . $filename);

if (isset($this->data)) {
    foreach ($this->data as $value) {
        echo trim($value->get_ntpn()) . ";";
        echo trim($value->get_file_name()) . ";";
        echo trim($value->get_gl_date()) . ";";
        echo trim($value->get_segment1()) . ";";
		echo trim($value->get_segment2()) . ";";
		echo trim($value->get_segment3()) . ";";
		echo trim($value->get_segment4()) . ";";
		echo trim($value->get_segment5()) . ";";
		echo trim($value->get_segment6()) . ";";
		echo trim($value->get_segment7()) . ";";
		echo trim($value->get_segment8()) . ";";
		echo trim($value->get_segment9()) . ";";
		echo trim($value->get_segment10()) . ";";
		echo trim($value->get_segment11()) . ";";
		echo trim($value->get_segment12()) . ";";
		echo trim($value->get_mata_uang()) . ";";
		echo trim($value->get_amount()) . ";";
        echo ";;;;;\r\n";
       
    }
}
?>
