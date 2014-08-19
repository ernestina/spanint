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
    'harian',
    'mingguan',
    'bulanan',
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
    'detailRekapSP2D_PDF',
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
    'posisiSpm',
    'detailposisiSpm',
    'HoldSpm',
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
    'RekapSp2d_PDF',
    '__destruct'
);

/*
 * akses Data Supplier
 */
$akses['DataSupplierKPPN'] = array(
    '__construct',
    'index',
    'downloadSupplierx',
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

?>