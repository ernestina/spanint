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
    'Detail_Fund_Fail_KD',
    'RealisasiFA',
    'RealisasiFA_1',
    'nmsatker',
    'nmsatker1',
    'DetailRealisasiFA',
    'DataRealisasi',
    'DataRealisasiBA',
    'DataRealisasiTransfer',
    'DetailEncumbrances',
    'ProsesRevisi',
    'DetailRevisi',
    'Fund_fail',
    'Fund_fail_PDF',
    'RealisasiFA_PDF',
    'DataRealisasi_PDF',
    'DataRealisasiBA_PDF',
    'DataRealisasiTransfer_PDF',
    'DetailRevisi_PDF',
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
	'PosisiSPM',
    'HoldSPM',
    'detailHoldSPM',
    'HoldSpm',
    'ValidasiSpm',
    'errorSpm',
    'HistorySpm',
    'daftarsp2d',
    'RekapSp2d',
    'detailrekapsp2d',
    'HoldSpm_PDF',
    'HistorySpm_PDF',
    'daftarsp2d_PDF',
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

/*
 * akses modul PDF
 */
$akses['PDFSatker'] = array(
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
    'monitoringSp2d_PDF',
	'monitoringRetur_PDF',
	'posisiSpm_PDF',
	'detailposisiSpm_PDF',
	'holdSpm_PDF',
	'HistorySpm_PDF',
	'daftarsp2d_PDF',
	'detailrekapsp2d1_PDF',
    '__destruct'
);

?>
