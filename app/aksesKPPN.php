<?php

//-----------------------------------------------------------
// AKSES UNTUK KPPN // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeKPPN'] = array(
    '__construct',
    'index',
    'ticker',
    'dashboard',
    '__destruct'
);


/*
 * akses modul auth
 */
$akses['AuthKPPN'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul DataDIPA User
 */
$akses['DataDIPAKPPN'] = array(
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
$akses['DataGRKPPN'] = array(
    '__construct',
    'GR_PFK',
    'GR_PFK_DETAIL',
    'GR_IJP',
    'GR_STATUS_LHP',
    'grStatusHarian',
    'detailLhpRekap',
    'detailPenerimaan',
    'GR_PFK_PDF',
    'GR_IJP_PDF',
    'detailLhpRekap_PDF',
    '__destruct'
);

/*
 * akses modul DataJSON
 */
$akses['DataJSONKPPN'] = array(
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
$akses['DataKppnKPPN'] = array(
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
    'monitoringSp2d_PDF',
    'harianBO_PDF',
    'sp2dHariIni_PDF',
    'sp2dBesok_PDF',
    'sp2dBackdate_PDF',
    'sp2dSudahVoid_PDF',
    'sp2dGajiDobel_PDF',
    'sp2dSalahTanggal_PDF',
    'sp2dSalahBank_PDF',
    'sp2dSalahRekening_PDF',
    'detailSp2dGaji_PDF',
    '__destruct'
);

/*
 * akses Data Retur
 */
$akses['DataReturKPPN'] = array(
    '__construct',
    'index',
    'monitoringRetur',
    'monitoringReturPkn',
    'monitoringRetur_PDF',
    '__destruct'
);


/*
 * akses Data SPM
 */
$akses['DataSPMKPPN'] = array(
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
    'HoldSPM_PDF',
    'HistorySpm_PDF',
    'daftarsp2d_PDF',
    'downloadSP2D',
    '__destruct'
);

/*
 * akses Data Supplier
 */
$akses['DataSupplierKPPN'] = array(
    '__construct',
    'index',
    'downloadSupplierXls',
    '__destruct'
);

/*
 * akses UserSpan
 */
$akses['UserSpanKPPN'] = array(
    '__construct',
    'monitoringUserSpan',
    '__destruct'
);

/*
 * akses DataPelimpahan
 */
$akses['DataPelimpahanKPPN'] = array(
    '__construct',
    'monitoringPelimpahan',
    '__destruct'
);

/*
 * akses modul DataPNBP User
 */
$akses['DataPNBPKPPN'] = array(
    '__construct',
    'DetailDipaPNBP',
	'DetailGRPNBP',
	'DetailUPPNBP',
	'DetailBelanjaPNBP',
    '__destruct'
);

/*
 * akses modul PDF
 */
$akses['PDFKPPN'] = array(
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
    'GR_PFK_PDF',
    'GR_IJP_PDF',
    'detailLhpRekap_PDF',
    'monitoringSp2d_PDF',
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
	'holdSpm_PDF',
	'HistorySpm_PDF',
	'daftarsp2d_PDF',
	'detailrekapsp2d1_PDF',
	'monitoringUserSpan_PDF',
	'posisiSpm_PDF',
	'monitoringPelimpahan_PDF',
    '__destruct'
);
?>