<?php

//-----------------------------------------------------------
// AKSES UNTUK Admin // -------------------------------------
//-----------------------------------------------------------


$akses['DataUserAdmin'] = array(
        '__construct',
        'index',
        'addDataUser',
        'updDataUser',
        'delDataUser',
        '__destruct'
);

$akses['OverviewPenganggaranAdmin'] = array(
        '__construct',
        'index',
        'overview',
        '__destruct'
);

$akses['DashboardAdmin'] = array(
        '__construct',
        'index',
        'overviewAdmin',
        '__destruct'
);

/*
 * akses modul Home
 */
$akses['HomeAdmin'] = array(
    '__construct',
    'index',
    'dashboard',
    'dashboardPenerbitan',
    '__destruct'
);

/*
 * akses PDR
 */
$akses['DataPDRAdmin'] = array(
        '__construct',
        'index',
        'registerDJPU',
        'refAkun',
        'refKppn',
        'refSdana',
        'refLokasi',
        '__destruct'
);

/*
 * akses PNBP
 */
$akses['DataPNBPAdmin'] = array(
    '__construct',
    'KarwasPNBP',
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
	'RealisasiFA_1_minus_51',
	'RealisasiFA_1_minus',
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
    'detailSPAN',
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
    'grStatusHarianBulan',
    'detailLhpRekap',
    'detailPenerimaan',
    'detailCoAPenerimaan',
    'SuspendSatkerPenerimaan',
    'SuspendAkunPenerimaan',
    'NTPNGanda',
    'DetailNTPNGanda',
    'downloadkonfirmasi',
    'downloadSuspend',
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
$akses['DataSupplierAdmin'] = array(
    '__construct',
    'index',
    'cekSupplier',
    'downloadSupplier',
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
    'pergantianUser',
    'addDataUserSpan',
    'invoiceProses',
    'supplierProses',
    'kontrakProses',
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
 * akses Panduan
 */
$akses['PanduanAdmin'] = array(
    '__construct',
    'lihatPanduan1',
    'PanduanUAT',
    'petunjukManual',
    '__destruct'
);

/*
 * akses DataPMRTPKNADMIN
 */
$akses['DataPMRTPKNAdmin'] = array(
    '__construct',
    'DataSPMAkhirTahun',
    'DataSPMAkhirTahunNihil',
    'DataSPMAkhirTahunBUN',
    'DataSPMAkhirTahunXls',
    'DataSPMAkhirTahunNihilXls',
    'DataSPMAkhirTahunBUNXls',
    '__destruct'
);

/*
 * akses Pelaporan
 */
$akses['PelaporanAdmin'] = array(
    '__construct',
    'downloadLaporanKPPN',
    'downloadLaporanKPPN2',
    'downloadLaporanPKNBM',
    'downloadLaporanPKNBB',
    'lihatLaporan',
    'listLaporanPKN',
    'listLaporanKPPN',
    'listLaporanSingle',
    '__destruct'
);

/*
 * akses BPN
 */
$akses['DataBPNAdmin'] = array(
    '__construct',
    'dataBPN',
    'dataBPNSatker',
    '__destruct'
);

/*
 * akses MpnBi
 */
$akses['DataMpnBiAdmin'] = array(
    '__construct',
    'MpnBi',
    '__destruct'
);

/*
 * akses modul BA_ES1
 */
$akses['BaEs1Admin'] = array(
    '__construct',
    'DataRealisasiKegiatanBA',
    'DataRealisasiKegiatanES1',
    'DataRealisasiAkunBA',
    'DataRealisasiAkunES1',
    'DataRealisasiKewenanganBAES1',
    'DataRealisasiOutputBA',
    'DataRealisasiOutputES1',
    'DataFaBaPerEs1',
    'DataFaBaSatEs1',
    'DataFaBaPerJenbel',
    'nmsatker',
    'ProsesRevisi',
    '__destruct'
);

/*
 * akses modul PDF
 */
$akses['PDFAdmin'] = array(
    '__construct',
    'index',
    'DataRealisasiBA_PDF',
    'cekSupplier_PDF',
    'daftarsp2d_PDF',
    'DataRealisasi_PDF',
    'DataRealisasiTransfer_PDF',
    'Detail_Fund_fail_kd_PDF',
    'Detail_Fund_fail_PDF',
    'detailDroping_PDF',
    'DetailEncumbrances_PDF',
    'detailLhpRekap_PDF',
    'detailPenerimaan_PDF',
    'detailCoAPenerimaan_PDF',
    'detailposisiSpm_PDF',
    'DetailRealisasiFA_PDF',
    'detailrekapsp2d1_PDF',
    'detailRekapSP2D2_PDF',
    'DetailRevisi_PDF',
    'detailSp2dGaji_PDF',
	'detailDroping_PDF',
	'detailSPAN_PDF',
    'DurasiSpm_PDF',
    'errorSpm_PDF',
    'Fund_fail_PDF',
    'GR_IJP_PDF',
    'GR_PFK_DETAIL1_PDF',
    'GR_PFK_PDF',
    'harianBO_PDF',
    'HistorySpm_PDF',
    'HoldSpm_PDF',
    'monitoringDroping_PDF',
    'monitoringPelimpahan_PDF',
    'monitoringRetur_PDF',
    'monitoringReturPkn_PDF',
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
    'KonversiSPM_PDF',
    'RealisasiFA_1_Minus_PDF',
    'RealisasiFA_1_Minus_51_PDF',
    'grStatusHarian_PDF',
    'grStatusHarianBulan_PDF',
    'DataSPMAkhirTahun_PDF',
    'DataSPMAkhirTahunNihil_PDF',
    'DataSPMAkhirTahunBUN_PDF',
    'SuspendAkunPenerimaan_PDF',
    'SuspendSatkerPenerimaan_PDF',
    'NTPNGanda_PDF',
    'KarwasUPSatker_PDF',
	'UPSatker_PDF',
	'KarwasTUPSatker_PDF',
	'TUPSatker_PDF',
	'DataRealisasiKegiatanBA_BAES1_PDF',
	'DataRealisasiKegiatanES1_BAES1_PDF',
	'DataRealisasiAkunBA_BAES1_PDF',
	'DataRealisasiAkunES1_BAES1_PDF',
    'DataRealisasiKewenanganBAES1_BAES1_PDF',
	'DataRealisasiOutputBA_BAES1_PDF',
	'DataRealisasiOutputES1_BAES1_PDF',
    'nmsatker_BAES1_PDF',
    'ProsesRevisi_BAES1_PDF',
	'DataFaBaPerEs1_BAES1_PDF',
    'DataFaBaSatEs1_BAES1_PDF',
    'DataFaBaPerJenbel_BAES1_PDF',
	'DataFaEs1PerSat_BAES1_PDF',
	'DataFaEs1SatJenbel_BAES1_PDF',
	'DataFaEs1SatSdana_BAES1_PDF',
	'DataBPN_PDF',
    'DataBPNSatker_PDF',
	'MpnBi_PDF',
	'registerDJPU_PDF',
	'refAkun_PDF',
	'refKppn_PDF',	
	'refSdana_PDF',
	'refLokasi_PDF',
	
    '__destruct'
);
?>