<?php

//-----------------------------------------------------------
// AKSES UNTUK Satker // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeSatker'] = array(
    '__construct',
    'index',
    'mingguan',
    'bulanan',
    'triwulanan',
    '__destruct'
);


/*
 * akses modul auth
 */
$akses['AuthSatker'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul DataDIPA User
 */
$akses['DataDIPASatker'] = array(
    '__construct',
    'RevisiDipa',
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
    '__destruct'
);

/*
 * akses modul DataGR
 */
$akses['DataGRSatker'] = array(
    '__construct',
    'GR_PFK',
    'GR_PFK_DETAIL',
    'GR_IJP',
    'GR_STATUS_LHP',
    'grStatusHarian',
    'detailLhpRekap',
    'detailPenerimaan',
    '__destruct'
);

/*
 * akses modul DataJSON
 */
$akses['DataJSONSatker'] = array(
    '__construct',
    'pieJenisSP2D',
    'pieNominalSP2D',
    'pieReturSP2D',
    'pieStatusLHP',
    'pieStatusDIPA',
    'listSPMOngoing',
    'listSP2DFinished',
    'summaryUnit',
    'lineHistSP2D',
    'lastUpdate',
    '__destruct'
);

/*
 * akses modul Data KPPN
 */
$akses['DataKppnSatker'] = array(
    '__construct',
    'index',
    'monitoringSp2d',
    'detailRekapSP2D',
    'lihatPanduan1',
    '__destruct'
);

/*
 * akses Data Retur
 */
$akses['DataReturSatker'] = array(
    '__construct',
    'index',
    'monitoringRetur',
    '__destruct'
);


/*
 * akses Data SPM
 */
$akses['DataSPMSatker'] = array(
    '__construct',
    'posisiSpm',
    'detailposisiSpm',
    'HoldSpm',
    'ValidasiSpm',
    'errorSpm',
    'HistorySpm',
    'daftarsp2d',
    'RekapSp2d',
    'detailrekapsp2d',
    '__destruct'
);


/*
 * akses Data Supplier
 */
$akses['DataSupplierSatker'] = array(
    '__construct',
    'index',
    'cekSupplier',
    'downloadSupplier',
    '__destruct'
);
