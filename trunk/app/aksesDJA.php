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
    'Detail_Fund_fail_kd',
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
    'Fund_fail_PDF',
    'RealisasiFA_PDF',
    'DataRealisasi_PDF',
    'DataRealisasiBA_PDF',
    'DataRealisasiTransfer_PDF',
    'DetailRevisi_PDF',
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
    'daftarsp2d_PDF',
    'RekapSp2d_PDF',
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

/*
 * akses modul PDF
 */
$akses['PDFDJA'] = array(
    '__construct',
    'index',
    'RevisiDipa_PDF',
    'Fund_fail_PDF',
	'Detail_Fund_fail_kd_PDF',
    'RealisasiFA_PDF',
    'RealisasiFA_1_PDF',
    'DataRealisasi_PDF',
    'DataRealisasiBA_PDF',
    'DataRealisasiTransfer_PDF',
    'DetailRevisi_PDF',
	'daftarsp2d_PDF',
	'detailrekapsp2d1_PDF',
	'monitoringUserSpan_PDF',
    '__destruct'
);
?>