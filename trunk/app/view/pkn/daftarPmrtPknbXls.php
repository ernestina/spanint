<?php
/* Data to be inserted into excel in an array of arrays
 * Each array is the avg monthly temp of a different city */


/*kode ini untuk menentukan dari kppn manadata ini berasal*/
if (isset($this->d_nama_kppn)) {
    foreach ($this->d_nama_kppn as $kppn) {
        //echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
        $kode_kppn = $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
        $kppn = $kppn->get_kd_satker();
    }
} else {
    $kode_kppn = "SEMUA KPPN"; 
    $kppn = "SEMUA";
}
$data = $this->data;


//ini untuk menentukan nama file dan eksetensi dari file yang didownload
$filename="SAT_".$this->judul."_".$kppn."_".date("Ymd")."_".date("His").".".$this->ex;
  
//Send headers
header('Content-Type: application/vnd.ms-excel'); 
header("Content-Disposition: attachment; filename=".$filename."");
header("Pragma: no-cache");
header("Expires: 0");


//untuk memastikan tidak ada data dari downloadan sebelumnya yang tertinggal
ob_clean();
flush(); 

$no=0;
//isi file ditentukan dari sini
  
/* Set your desired delimiter. You can make this a true
 * .csv and set $delimiter = ","; but I find that tabs
 * work better as commas can also be present in your data.
 * Note that you must use the .tsv or .xls file extension for Excel
 * to correctly interpret tabs. Otherwise if you are using commas
 * for your delimiter, use .csv for your file extension. */
if ($this->ex == 'xls'){
    $delimiter = " \t ";
    print $kode_kppn ." \r\n ";
    //ini untuk menulis header dari excel bersangkutan
    $header = array("Jenis Belanja", 
                   "SPM dalam proses 16 Des", "Nilai dalam proses 16 Des",
                   "SPM diterima 17 Des", "Nilai diterima 17 Des",
                   "SPM terbit 17 Des", "Nilai terbit 17 Des",
                   "SPM dalam proses 17 Des", "Nilai dalam proses 17 Des",
                   "SPM diterima 18 Des", "Nilai diterima 18 Des",
                   "SPM terbit 18 Des", "Nilai terbit 18 Des",
                   "SPM dalam proses 18 Des", "Nilai dalam proses 18 Des",
                   "SPM diterima 19 Des", "Nilai diterima 19 Des",
                   "SPM terbit 19 Des", "Nilai terbit 19 Des",
                   "SPM dalam proses 19 Des", "Nilai dalam proses 19 Des"
                  );

    foreach ($header as $header) {
        print $header . $delimiter;
    }
    print " \r\n ";
} else if ($this->ex == 'csv'){
    $delimiter = ",";
}



//ini untuk menentukan isi nilai per cellnya
foreach ($data as $value) {
    //Separate each datapoint in the row with the delimiter
    $dataRowString = $value->get_akun().$delimiter;
    //$dataRowString = $value->get_kppn().$delimiter;
    $dataRowString .= $value->get_jml_spm_dlm_proses_16().$delimiter;
    $dataRowString .= $value->get_nilai_spm_dlm_proses_16().$delimiter;
    $dataRowString .= $value->get_jml_spm_diterima_17().$delimiter;
    $dataRowString .= $value->get_nilai_spm_diterima_17().$delimiter;
    $dataRowString .= $value->get_jml_spm_diterbitkan_17().$delimiter;
    $dataRowString .= $value->get_nilai_spm_diterbitkan_17().$delimiter;
    $dataRowString .= $value->get_jml_spm_dlm_proses_17().$delimiter;
    $dataRowString .= $value->get_nilai_spm_dlm_proses_17().$delimiter;
    $dataRowString .= $value->get_jml_spm_diterima_18().$delimiter;
    $dataRowString .= $value->get_nilai_spm_diterima_18().$delimiter;
    $dataRowString .= $value->get_jml_spm_diterbitkan_18().$delimiter;
    $dataRowString .= $value->get_nilai_spm_diterbitkan_18().$delimiter;
    $dataRowString .= $value->get_jml_spm_dlm_proses_18().$delimiter;
    $dataRowString .= $value->get_nilai_spm_dlm_proses_18().$delimiter;
    $dataRowString .= $value->get_jml_spm_diterima_19().$delimiter;
    $dataRowString .= $value->get_nilai_spm_diterima_19().$delimiter;
    $dataRowString .= $value->get_jml_spm_diterbitkan_19().$delimiter;
    $dataRowString .= $value->get_nilai_spm_diterbitkan_19().$delimiter;
    $dataRowString .= $value->get_jml_spm_dlm_proses_19().$delimiter;
    $dataRowString .= $value->get_nilai_spm_dlm_proses_19();
    
    //var_dump($dataRowString);
    print $dataRowString . "\r\n";
}


?>