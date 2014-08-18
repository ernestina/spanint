<?php

//-----------------------------------------------------------
// AKSES UNTUK DJA // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul auth
 */
$akses['AuthDJA'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul DataDIPA User
 */
$akses['DataDIPADJA'] = array(
    '__construct',
    'RevisiDipa',
    'Fund_fail',
    'Detail_Fund_Fail',
    'Detail_Fund_Fail_kd',
    'RealisasiFA',
    'nmsatker',
    'nmsatker1',
    'DetailRealisasiFA',
    'DataRealisasi',
    'DataRealisasiBA',
    'DataRealisasiTransfer',
    'DetailEncumbrances',
    'ProsesRevisi',
    'DetailRevisi',
    '__destruct'
);


/*
 * akses Data SPM
 */
$akses['DataSPMDJA'] = array(
    '__construct',
    'daftarsp2d',
    'RekapSp2d',
    'detailrekapsp2d',
    '__destruct'
);

/*
 * akses UserSpan
 */
$akses['UserSpanDJA'] = array(
    '__construct',
    'monitoringUserSpan',
    '__destruct'
);

?>