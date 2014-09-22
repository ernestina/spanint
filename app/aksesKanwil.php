<?php

//-----------------------------------------------------------
// AKSES UNTUK Kanwil // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeKanwil'] = array(
    '__construct',
    'index',
    'dashboard',
    '__destruct'
);


/*
 * akses modul auth
 */
$akses['AuthKanwil'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul DataDIPA User
 */
$akses['DataDIPAKanwil'] = array(
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
 * akses modul DataGR
 */
$akses['DataGRKanwil'] = array(
    '__construct',
    'GR_PFK',
    'GR_PFK_DETAIL',
    'GR_IJP',
    'GR_STATUS_LHP',
    'grStatusHarian',
    'detailLhpRekap',
    'detailPenerimaan',
    'detailCoAPenerimaan',
	'SuspendSatkerPenerimaan',
    'SuspendAkunPenerimaan',
    'NTPNGanda',
    'DetailNTPNGanda',
    '__destruct'
);

/*
 * akses modul DataJSON
 */
$akses['DataJSONKanwil'] = array(
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
$akses['DataKppnKanwil'] = array(
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
 * akses Data SPM
 */
$akses['DataSPMKanwil'] = array(
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
    'HoldSPM_PDF',
    'HistorySpm_PDF',
    'daftarsp2d_PDF',
    '__destruct'
);

/*
 * akses UserSpan
 */
$akses['UserSpanKanwil'] = array(
    '__construct',
    'monitoringUserSpan',
    '__destruct'
);

/*
 * akses DataPelimpahan
 */
$akses['DataPelimpahanKanwil'] = array(
    '__construct',
    'monitoringPelimpahan',
    '__destruct'
);

/*
 * akses Panduan
 */
$akses['PanduanKanwil'] = array(
    '__construct',
    'lihatPanduan1',
    'PanduanUAT',
    '__destruct'
);

/*
 * akses modul PDF
 */
$akses['PDFKanwil'] = array(
    '__construct',
    'index',
    'DataRealisasiBA_PDF',
    'daftarsp2d_PDF',
    'DataRealisasi_PDF',
    'DataRealisasiTransfer_PDF',
    'Detail_Fund_fail_kd_PDF',
    'Detail_Fund_fail_PDF',
    'DetailEncumbrances_PDF',
    'detailLhpRekap_PDF',
    'detailPenerimaan_PDF',
    'detailposisiSpm_PDF',
    'DetailRealisasiFA_PDF',
    'detailrekapsp2d1_PDF',
    'detailRekapSP2D2_PDF',
    'DetailRevisi_PDF',
    'detailSp2dGaji_PDF',
    'DurasiSpm_PDF',
    'errorSpm_PDF',
    'Fund_fail_PDF',
    'GR_IJP_PDF',
    'GR_PFK_DETAIL1_PDF',
    'GR_PFK_PDF',
    'harianBO_PDF',
    'HistorySpm_PDF',
    'HoldSpm_PDF',
    'monitoringPelimpahan_PDF',
    'monitoringRetur_PDF',
    'monitoringSp2d_PDF',
    'monitoringUserSpan_PDF',
    'nmsatker_PDF',
    'nmsatker1_PDF',
    'nmsatkerSP2D_PDF',
    'posisiSpm_PDF',
    'ProsesRevisi_PDF',
    'RealisasiFA_1_PDF',
    'RealisasiFA_PDF',
    'RekapSp2d_PDF',
    'RevisiDipa_PDF',
    'sp2dBackdate_PDF',
    'sp2dBesok_PDF',
    'sp2dCompareGaji_PDF',
    'sp2dGajiDobel_PDF',
    'sp2dHariIni_PDF',
    'sp2dNilaiMinus_PDF',
    'sp2dRekap_PDF',
    'sp2dSalahBank_PDF',
    'sp2dSalahRekening_PDF',
    'sp2dSalahTanggal_PDF',
    'sp2dSudahVoid_PDF',
    'ValidasiSpm_PDF',
    '__destruct'
);
?>