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
    'harian',
    'mingguan',
    'bulanan',
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
    'RevisiDipa_PDF',
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
    'RekapSp2d_PDF',
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
?>