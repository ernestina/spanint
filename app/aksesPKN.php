<?php

//-----------------------------------------------------------
// AKSES UNTUK PKN // -------------------------------------
//-----------------------------------------------------------


/*
 * akses modul home
 */
$akses['HomePKN'] = array(
    '__construct',
    'index',
    '__destruct'
);

/*
 * akses modul auth
 */
$akses['AuthPKN'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul Data KPPN
 */
$akses['DataKppnPKN'] = array(
    '__construct',
    'index',
    'monitoringSp2d',
    'lihatPanduan1',
    '__destruct'
);

/*
 * akses modul DataDropping
 */
$akses['DataDropingPKN'] = array(
    '__construct',
    'index',
    'monitoringDroping',
    'detailDroping',
    'detailDroping_PDF',
    'detailSPAN',
    'detailSPAN_PDF',
    '__destruct'
);/*
 * akses modul DataGR
 */
$akses['DataGRPKN'] = array(
    '__construct',
    'grStatusHarianBulan',
    'detailLhpRekap',
    'detailPenerimaan',
    'detailCoAPenerimaan',
    '__destruct'
);

/*
 * akses Data Retur
 */
$akses['DataReturPKN'] = array(
    '__construct',
    'index',
    'monitoringRetur',
    'monitoringReturPkn',
    '__destruct'
);

/*
 * akses Panduan
 */
$akses['PanduanPKN'] = array(
    '__construct',
    'lihatPanduan1',
    'PanduanUAT',
    '__destruct'
);

/*
 * akses Pelaporan
 */
$akses['PelaporanPKN'] = array(
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
 * akses DataPelimpahan
 */
$akses['DataPelimpahanPKN'] = array(
    '__construct',
    'monitoringPelimpahan',
    '__destruct'
);

/*
 * akses DataPMRTPKN
 */
$akses['DataPMRTPKN'] = array(
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
 * akses modul PDF
 */
$akses['PDFPKN'] = array(
    '__construct',
    'index',
    'detailDroping_PDF',
    'monitoringDroping_PDF',
    'monitoringPelimpahan_PDF',
    'monitoringRetur_PDF',
    'monitoringReturPkn_PDF',
    'monitoringSp2d_PDF',
    'DataSPMAkhirTahun_PDF',
    'DataSPMAkhirTahunNihil_PDF',
    'DataSPMAkhirTahunBUN_PDF',
    'grStatusHarianBulan_PDF',
	'registerDJPU_PDF',
	'refAkun_PDF',
	'refKppn_PDF',	
	'refSdana_PDF',
	'refLokasi_PDF',
	'refSatker_PDF',
	'detailLhpRekap_PDF',
	'detailPenerimaan_PDF',
	'detailSPAN_PDF',
    '__destruct'
);

/*
 * akses PDR
 */
$akses['DataPDRPKN'] = array(
        '__construct',
        'index',
        'registerDJPU',
        'refAkun',
        'refKppn',
        'refSdana',
        'refLokasi',
        '__destruct'
);

?>