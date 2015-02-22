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
 * akses PNBP
 */
$akses['DataPNBPKPPN'] = array(
    '__construct',
    'KarwasPNBP',
    'DetailDipaPNBP',
    'DetailGRPNBP',
    'DetailUPPNBP',
    'DetailBelanjaPNBP',
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
    'DetailSetoranUPPNBP',
	'RealisasiFA_1_minus_51',
	'RealisasiFA_1_minus',
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
    'detailCoAPenerimaan',
    'KonfirmasiPenerimaan',
    'downloadkonfirmasi',
    'GR_PFK_PDF',
    'GR_IJP_PDF',
    'detailLhpRekap_PDF',
    'detailCoAPenerimaan',
    'KonfirmasiPenerimaan',
    'downloadkonfirmasi',
    'downloadSuspend',
    'SuspendSatkerPenerimaan',
    'SuspendAkunPenerimaan',
    'NTPNGanda',
    'DetailNTPNGanda',
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
	'Konversi',
	'KarwasUPSatker',
	'UPSatker',
	'KarwasTUPSatker',
	'TUPSatker',
    '__destruct'
);

/*
 * akses Data Supplier
 */
$akses['DataSupplierKPPN'] = array(
    '__construct',
    'index',
    'cekSupplier',
    'downloadSupplier',
    'downloadSupplierXls',
    'downloadToolCekSupplier',
    '__destruct'
);

/*
 * akses UserSpan
 */
$akses['UserSpanKPPN'] = array(
    '__construct',
    'monitoringUserSpan',
    'invoiceProses',
    'supplierProses',
    'kontrakProses',
    'pergantianUser',
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
 * akses Panduan
 */
$akses['PanduanKPPN'] = array(
    '__construct',
    'lihatPanduan1',
    'PanduanUAT',
    'petunjukManual',
    '__destruct'
);

/*
 * akses Pelaporan
 */
$akses['PelaporanKPPN'] = array(
    '__construct',
    'downloadLaporanKPPN',
    'downloadLaporanKPPN2',
    '__destruct'
);

/*
 * akses dataPMRT
 */
$akses['DataPMRTKPPN'] = array(
    '__construct',
    'cekPMRT',
    '__destruct'
);



/*
 * akses dataPersiapanRollout
 */
$akses['DataPersiapanRolloutKPPN'] = array(
    '__construct',
    'downloadPagu',
    'downloadRealisasi',
    'downloadToolRekonsiliasi',
    '__destruct'
);

/*
 * akses BPN
 */
$akses['DataBPNKPPN'] = array(
    '__construct',
    'dataBPN',
    'dataBPNSatker',
    '__destruct'
);

/*
 * akses MpnBi
 */
$akses['DataMpnBiKPPN'] = array(
    '__construct',
    'MpnBi',
    '__destruct'
);


/*
 * akses modul PDF
 */
$akses['PDFKPPN'] = array(
    '__construct',
    'index',
    'DataRealisasiBA_PDF',
    'cekSupplier_PDF',
    'daftarsp2d_PDF',
    'DataRealisasi_PDF',
    'DataRealisasiTransfer_PDF',
    'DetailBelanjaPNBP_PDF',
    'detailCoAPenerimaan_PDF',
    'DetailDipaPNBP_PDF',
    'DetailEncumbrances_PDF',
    'Detail_Fund_fail_kd_PDF',
    'Detail_Fund_fail_PDF',
    'DetailGRPNBP_PDF',
    'detailLhpRekap_PDF',
    'DetailNTPNGanda_PDF',
    'detailPenerimaan_PDF',
    'detailposisiSpm_PDF',
    'DetailRealisasiFA_PDF',
    'detailrekapsp2d1_PDF',
    'detailRekapSP2D2_PDF',
    'DetailRevisi_PDF',
    'DetailSetoranUPPNBP_PDF',
    'detailSp2dGaji_PDF',
    'DetailUPPNBP_PDF',
    'DurasiSpm_PDF',
    'errorSpm_PDF',
    'Fund_fail_PDF',
    'GR_IJP_PDF',
    'GR_PFK_DETAIL1_PDF',
    'GR_PFK_PDF',
    'harianBO_PDF',
    'HistorySpm_PDF',
    'HoldSpm_PDF',
    'KarwasPNBP_PDF',
    'KonfirmasiPenerimaan_PDF',
    'monitoringPelimpahan_PDF',
    'monitoringRetur_PDF',
    'monitoringSp2d_PDF',
    'monitoringUserSpan_PDF',
    'nmsatker_PDF',
    'nmsatker1_PDF',
    'nmsatkerSP2D_PDF',
    'NTPNGanda_PDF',
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
    'SuspendAkunPenerimaan_PDF',
    'SuspendSatkerPenerimaan_PDF',
    'ValidasiSpm_PDF',
    'KonversiSPM_PDF',
    'RealisasiFA_1_Minus_PDF',
    'RealisasiFA_1_Minus_51_PDF',
    'grStatusHarian_PDF',
    'grStatusHarianBulan_PDF',
    'KarwasUPSatker_PDF',
	'DataRealisasiAkunBA_BAES1_PDF',
    'DataRealisasiAkunES1_BAES1_PDF',
    'DataRealisasiKewenanganBAES1_BAES1_PDF',
    'DataRealisasiSumberDanaBAES1_BAES1_PDF',
	'DataRealisasiWilayahBAES1_BAES1_PDF',
	'DataFaBaPerEs1_BAES1_PDF',
	'DataFaBaSatEs1_BAES1_PDF',
	'DataRealisasiKegiatanBA_BAES1_PDF',
	'DataRealisasiOutputBA_BAES1_PDF',
	'DataFaBaPerJenbel_BAES1_PDF',
	'DataFaBaPerSdana_BAES1_PDF',
	'DataFaBaEs1Jenbel_BAES1_PDF',
	'DataFaBaEs1Sdana_BAES1_PDF',
	'nmsatkerBAES1_BAES1_PDF',
    'RekapSp2dBAES1_BAES1_PDF',
    'DataRealisasiPenerimaanBA_BAES1_PDF',
	'DataRealisasiPenerimaanPerES1_BAES1_PDF',
    'nmsatker_BAES1_PDF',
    'ProsesRevisi_BAES1_PDF',
	'dataBPN_PDF',
    'dataBPNSatker_PDF',
	'MpnBi_BAES1_PDF',
    '__destruct'
);
?>