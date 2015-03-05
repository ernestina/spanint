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
    'dashboard',
    '__destruct'
);

/*
 * akses modul Dash
 */
$akses['DashboardSatker'] = array(
        '__construct',
        'index',
        'overviewSatker',
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
    'KonfirmasiPenerimaan',
    'downloadkonfirmasi',
    'downloadSuspend',
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
    'downloadSP2D',
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
 * akses Panduan
 */
$akses['PanduanSatker'] = array(
    '__construct',
    'lihatPanduan1',
    'PanduanUAT',
    '__destruct'
);

/*
 * akses Satker
 */
$akses['DataBPNSatker'] = array(
    '__construct',
    'dataBPN',
    'dataBPNSatker',
    '__destruct'
);

/*
 * akses modul PDF
 */
$akses['PDFSatker'] = array(
    '__construct',
    'cekSupplier_PDF',
    'daftarsp2d_PDF',
    'Detail_Fund_fail_kd_PDF',
    'Detail_Fund_fail_PDF',
    'DetailEncumbrances_PDF',
    'detailposisiSpm_PDF',
    'DetailRealisasiFA_PDF',
    'detailrekapsp2d1_PDF',
    'DetailRevisi_PDF',
    'errorSpm_PDF',
    'Fund_fail_PDF',
    'HoldSpm_PDF',
    'monitoringRetur_PDF',
    'monitoringSp2d_PDF',
    'monitoringUserSpan_PDF',
    'posisiSpm_PDF',
    'ProsesRevisi_PDF',
    'RealisasiFA_1_PDF',
    'RealisasiFA_PDF',
    'RekapSp2d_PDF',
    'RevisiDipa_PDF',
    'ValidasiSpm_PDF',
	'DataBPN_PDF',
    'DataBPNSatker_PDF',
	'MpnBi_PDF',
	'KarwasUPSatker_PDF',
	'registerDJPU_PDF',
	'refAkun_PDF',
	'refKppn_PDF',	
	'refSdana_PDF',
	'refLokasi_PDF',
	'refSatker_PDF',
	'KonfirmasiPenerimaan_PDF',
    '__destruct'
);

/*
 * akses PDR
 */
$akses['DataPDRSatker'] = array(
        '__construct',
        'index',
        'refAkun',
        'refKppn',
        'refSdana',
        'refLokasi',
    'refSatker',
        '__destruct'
);

$akses['BaEs1Satker'] = array(
        '__construct',
        'DataRealisasiPenerimaanBA',
    'DataRealisasiKegiatanBA',
    'DataRealisasiOutputBA',
    'DataFaBaPerJenbel',
    'DataFaBaPerSdana',
    'DetailEncumbrances',
        '__destruct'
);
?>
