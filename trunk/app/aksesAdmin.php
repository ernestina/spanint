<?php

//-----------------------------------------------------------
// AKSES UNTUK Admin // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeAdmin'] = array(
    '__construct',
    'index',
    'harian',
    'mingguan',
    'bulanan',
    '__destruct'
);


/*
 * akses modul auth
 */
$akses['AuthAdmin'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul DataDIPA User
 */
$akses['DataDIPAAdmin'] = array(
    '__construct',
    'RevisiDipa',
    'Fund_fail',
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
    'Fund_fail_PDF',
    'RealisasiFA_PDF',
    'DataRealisasi_PDF',
    'DataRealisasiBA_PDF',
    'DataRealisasiTransfer_PDF',
    'DetailRevisi_PDF',
    '__destruct'
);

/*
 * akses modul DataDropping
 */
$akses['DataDropingAdmin'] = array(
    '__construct',
    'index',
    'monitoringDroping',
    'detailDroping',
    'detailDroping_PDF',
    '__destruct'
);

/*
 * akses modul DataGR
 */
$akses['DataGRAdmin'] = array(
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
$akses['DataJSONAdmin'] = array(
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
$akses['DataKppnAdmin'] = array(
    '__construct',
    'index',
    'monitoringSp2d',
    'harianBO',
    'sp2dHariIni',
    'sp2dBesok',
    'sp2dBackdate',
    'sp2dHarian',
    'sp2dNilaiMinus',
    'sp2dSudahVoid',
    'sp2dGajiDobel',
    'sp2dSalahTanggal',
    'sp2dSalahBank',
    'sp2dSalahRekening',
    'sp2dCompareGaji',
    'sp2dRekap',
    'detailSp2dGaji',
    'detailRekapSP2D',
    'lihatPanduan1',
    '__destruct'
);

/*
 * akses Data Retur
 */
$akses['DataReturAdmin'] = array(
    '__construct',
    'index',
    'monitoringRetur',
    'monitoringReturPkn',
    '__destruct'
);


/*
 * akses Data SPM
 */
$akses['DataSPMAdmin'] = array(
    '__construct',
    'PosisiSPM',
    'detailposisiSpm',
    'HoldSPM',
    'ValidasiSpm',
    'errorSpm',
    'HistorySpm',
    'DurasiSpm',
    'nmsatker',
    'daftarsp2d',
    'RekapSp2d',
    'detailrekapsp2d',
    'detailposisiSpm_PDF',
    'HoldSpm_PDF',
    'HistorySpm_PDF',
    'daftarsp2d_PDF',
    '__destruct'
);

/*
 * akses Data User
 */
$akses['DataUserAdmin'] = array(
    '__construct',
    'index',
    'addDataUser',
    'updDataUser',
    'delDataUser',
    '__destruct'
);

/*
 * akses UserSpan
 */
$akses['UserSpanAdmin'] = array(
    '__construct',
    'monitoringUserSpan',
    'monitoringUserSpan_PDF',
    '__destruct'
);

/*
 * akses DataPelimpahan
 */
$akses['DataPelimpahanAdmin'] = array(
    '__construct',
    'monitoringPelimpahan',
    '__destruct'
);

/*
 * akses modul PDF
 */
$akses['PDFAdmin'] = array(
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
	'detailDroping_PDF',
    'GR_PFK_PDF',
    'GR_IJP_PDF',
    'detailLhpRekap_PDF',
    'monitoringSp2d_PDF',
	'monitoringDroping_PDF',
    'harianBO_PDF',
    'sp2dHariIni_PDF',
    'sp2dBesok_PDF',
    'sp2dBackdate_PDF',
    'sp2dNilaiMinus_PDF',
    'sp2dSudahVoid_PDF',
    'sp2dGajiDobel_PDF',
    'sp2dSalahTanggal_PDF',
    'sp2dSalahBank_PDF',
    'sp2dSalahRekening_PDF',
    'detailSp2dGaji_PDF',
	'monitoringRetur_PDF',
	'posisiSpm_PDF',
	'detailposisiSpm_PDF',
	'HoldSpm_PDF',
	'HistorySpm_PDF',
	'daftarsp2d_PDF',
	'detailrekapsp2d1_PDF',
	'monitoringUserSpan_PDF',
	'posisiSpm_PDF',
	'monitoringPelimpahan_PDF',
	'monitoringReturPkn_PDF',
    '__destruct'
);


?>