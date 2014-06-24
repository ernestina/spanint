<?php

$total_gaji = 0;
$total_non_gaji = 0;
$total_lainnya = 0;
$total_void = 0;

$total_vol_gaji = 0;
$total_vol_non_gaji = 0;

$total_lhp_completed = 0;
$total_lhp_validated = 0;
$total_lhp_error = 0;
$total_lhp_etc = 0;

foreach ($this->data_sp2d_rekap as $sp2d_rekap_harian) {
    $total_gaji += $sp2d_rekap_harian->get_gaji();
    $total_non_gaji += $sp2d_rekap_harian->get_non_gaji();
    $total_void += $sp2d_rekap_harian->get_void();
    $total_lainnya += $sp2d_rekap_harian->get_lainnya();
    
    $total_vol_gaji += $sp2d_rekap_harian->get_vol_gaji();
    $total_vol_non_gaji += $sp2d_rekap_harian->get_vol_non_gaji();
}

foreach ($this->data_lhp_rekap as $lhp_rekap_harian) {
    $total_lhp_completed += $lhp_rekap_harian->get_lhp_completed();
    $total_lhp_validated += $lhp_rekap_harian->get_lhp_validated();
    $total_lhp_error += $lhp_rekap_harian->get_lhp_error();
    $total_lhp_etc += $lhp_rekap_harian->get_lhp_etc();
}
    
echo '{';

echo '"jumlahSPMGaji":"'.$total_gaji.'"'; echo ' , ';
echo '"jumlahSPMNonGaji":"'.$total_non_gaji.'"'; echo ' , ';
echo '"jumlahSPMLainnya":"'.$total_lainnya.'"'; echo ' , ';
echo '"jumlahSPMVoid":"'.$total_void.'"'; echo ' , ';

echo '"volumeSPMGaji":"'.round($total_vol_gaji/1000000000).'"'; echo ' , ';
echo '"volumeSPMNonGaji":"'.number_format(round($total_vol_non_gaji/1000000000)).'"'; echo ' , ';

echo '"jumlahLHPCompleted":"'.$total_lhp_completed.'"'; echo ' , ';
echo '"jumlahLHPValidated":"'.$total_lhp_validated.'"'; echo ' , ';
echo '"jumlahLHPError":"'.$total_lhp_error.'"'; echo ' , ';
echo '"jumlahLHPLainnya":"'.$total_lhp_etc.'"'; echo ' , ';

echo '"tanggalPeriode": [';

for ($i=29; $i>=0; $i--) {
    if ($i < 29) {
        echo ' , ';
    }
    echo '"'.date("d-m",time()-($i*24*60*60)).'"';
}

echo '] , ';

echo '"spmGajiDetail": [';

for ($i=29; $i>=0; $i--) {
    if ($i < 29) {
        echo ' , ';
    }
    echo '"'.$this->data_sp2d_rekap[$i]->get_gaji().'"';
}

echo '] , ';

echo '"spmNonGajiDetail": [';

for ($i=29; $i>=0; $i--) {
    if ($i < 29) {
        echo ' , ';
    }
    echo '"'.$this->data_sp2d_rekap[$i]->get_non_gaji().'"';
}

echo '] , ';

echo '"spmVoidDetail": [';

for ($i=29; $i>=0; $i--) {
    if ($i < 29) {
        echo ' , ';
    }
    echo '"'.$this->data_sp2d_rekap[$i]->get_void().'"';
}

echo '] , ';

echo '"spmLainnyaDetail": [';

for ($i=29; $i>=0; $i--) {
    if ($i < 29) {
        echo ' , ';
    }
    echo '"'.$this->data_sp2d_rekap[$i]->get_lainnya().'"';
}

echo '] , ';

$pos_count = 0;

foreach ($this->data_pos_spm as $value) {
    $pos_count++;
}

echo '"jumlahReturSudahProses":"'.$this->data_retur->get_retur_sudah_proses().'"'; echo ' , ';
echo '"jumlahReturBelumProses":"'.$this->data_retur->get_retur_belum_proses().'"'; echo ' , ';

echo '"jumlahSPMOngoing":"'.$pos_count.'"';

echo '}';

?>