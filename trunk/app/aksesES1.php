<?php

//-----------------------------------------------------------
// AKSES UNTUK BAES1 // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeES1'] = array(
    '__construct',
    'index',
    'dashboard',
    '__destruct'
);


/*
 * akses modul auth
 */
$akses['AuthES1'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul BA_ES1
 */
$akses['BaEs1ES1'] = array(
    '__construct',
    'DataRealisasiKegiatanBA',
    'DataRealisasiKegiatanES1',
    'DataRealisasiAkunBA',
    'DataRealisasiAkunES1',
    'DataRealisasiKewenanganBAES1',
    'nmsatker',
    'ProsesRevisi',
    'DataRealisasiOutputBA',
    'DataRealisasiOutputES1',
    'DataRealisasiWilayahBAES1',
    'DataRealisasiSumberDanaBAES1',
    'RekapSp2dBAES1',
    'detailrekapsp2dBAES1',
    'nmsatkerBAES1',
    'DataRealisasiPenerimaanBA',
    'DataRealisasiKabupatenBAES1',
    'DataRealisasiPenerimaanPerES1',
    'DataRealisasiKegiatanBAES1',
    'DataFaBaPerJenbel',
    'DataFaBaPerSdana',
    'DataFaEs1PerSat',
    'DataFaEs1SatJenbel',
    'DataFaEs1SatSdana',
    'DetailEncumbrances',
	'DataRealisasiPenerimaanPerSatkerES1',
	'DataUPBAES1',
    'KarwasTUPBaes1',
    '__destruct'
);

$akses['dataDIPAES1'] = array(
    '__construct',
    'RevisiDipa',
    'DetailRevisi',
    '__destruct'
);
$akses['dataSPMES1'] = array(
    '__construct',
    'daftarsp2d',
	'TUPSatker',
	'UPSatker',
    '__destruct'
);
/*
 * akses modul PDF
 */
$akses['PDFES1'] = array(
    '__construct',
    'index',
    'DataRealisasiAkunES1_BAES1_PDF',
    'DataRealisasiAkunBA_BAES1_PDF',
    'DataRealisasiKewenanganBAES1_BAES1_PDF',
    'DataRealisasiSumberDanaBAES1_BAES1_PDF',
    'DataRealisasiWilayahBAES1_BAES1_PDF',
    'DataRealisasiKegiatanES1_BAES1_PDF',
	'DataRealisasiKegiatanBAES1_BAES1_PDF',
    'DataRealisasiKegiatanBA_BAES1_PDF',
    'DataRealisasiOutputES1_BAES1_PDF',
    'DataRealisasiOutputBA_BAES1_PDF',
	'DataRealisasiPenerimaanBA_BAES1_PDF',
	'DataRealisasiPenerimaanPerES1_BAES1_PDF',
	'DataRealisasiPenerimaanPerSatkerES1_PDF',
	'detailrekapsp2dBAES1_BAES1_PDF',
	'DetailRevisi_PDF',
	'DataFaEs1SatSdana_BAES1_PDF',
	 'DataFaBaPerJenbel_BAES1_PDF',
    'DataFaBaPerSdana_BAES1_PDF',
    'DataFaEs1PerSat_BAES1_PDF',
    'DataFaEs1SatJenbel_BAES1_PDF',
    'nmsatker_BAES1_PDF',
    'ProsesRevisi_BAES1_PDF',
    'nmsatkerBAES1_BAES1_PDF',
    'RekapSp2dBAES1_BAES1_PDF',
	'RevisiDipa_PDF',	
	'nmsatkerBAES1_BAES1_PDF',
	'DataRealisasiKabupatenBAES1_BAES1_PDF',
	'registerDJPU_PDF',
	'refAkun_PDF',
	'refKppn_PDF',	
	'refSdana_PDF',
	'refLokasi_PDF',
	'refSatker_PDF',
	'DetailEncumbrances_BAES1_PDF',
	'DataUPBAES1_PDF',
	'KarwasTUPBaes1_PDF',
	'daftarsp2d_PDF',
	'UPSatker_PDF',
	'TUPSatker_PDF',
    '__destruct'
);

/*
 * akses PDR
 */
$akses['DataPDREs1'] = array(
        '__construct',
        'index',
        'refAkun',
        'refKppn',
        'refSdana',
        'refLokasi',
        '__destruct'
);
?>
