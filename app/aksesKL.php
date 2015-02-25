<?php

//-----------------------------------------------------------
// AKSES UNTUK Satker // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeKL'] = array(
    '__construct',
    'index',
    'dashboard',
    '__destruct'
);


/*
 * akses modul auth
 */
$akses['AuthKL'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul BA_ES1
 */
$akses['BaEs1KL'] = array(
    '__construct',
    'DataRealisasiKegiatanBA',
    'DataRealisasiKegiatanES1',
    'DataRealisasiAkunBA',
    'DataRealisasiAkunES1',
    'DataRealisasiKewenanganBAES1',
    'nmsatker',
    'ProsesRevisi',
    'DataRealisasiOutputBA',
    'DataFaBaSatEs1',
    'DataFaBaPerEs1',
    'DataFaBaPerJenbel',
    'DataFaBaPerSdana',
    'DataFaBaEs1Jenbel',
    'DataFaBaEs1Sdana',
    'DataRealisasiOutputES1',
	'DataRealisasiWilayahBAES1',
	'DataRealisasiSumberDanaBAES1',
	'RekapSp2dBAES1',
	'detailrekapsp2dBAES1',
	'nmsatkerBAES1',
	'DataRealisasiPenerimaanBA',
	'DataRealisasiKabupatenBAES1',
	'DataRealisasiPenerimaanPerES1',
	'DataRealisasiPenerimaanPerSatkerES1',
	'DataRealisasiKegiatanBAES1',
	'DetailEncumbrances',
	'DataUPBAES1',
	'KarwasTUPBaes1',
    '__destruct'
);

$akses['dataDIPAKL'] = array(
    '__construct',
    'RevisiDipa',
	'DetailRevisi',
    '__destruct'
);
$akses['dataSPMKL'] = array(
    '__construct',
    'daftarsp2d',
	'UPSatker',
	'TUPSatker',
    '__destruct'
);
/*
 * akses modul PDF
 */
$akses['PDFKL'] = array(
    '__construct',
    'index',
    'DataRealisasiAkunBA_BAES1_PDF',
    'DataRealisasiAkunES1_BAES1_PDF',
    'DataRealisasiKewenanganBAES1_BAES1_PDF',
    'DataRealisasiSumberDanaBAES1_BAES1_PDF',
	'DataRealisasiWilayahBAES1_BAES1_PDF',
	'DataFaBaPerEs1_BAES1_PDF',
	'DataFaBaSatEs1_BAES1_PDF',
	'DataFaBaPerJenbel_BAES1_PDF',
	'DataFaBaPerSdana_BAES1_PDF',
	'DataFaBaEs1Jenbel_BAES1_PDF',
	'DataFaBaEs1Sdana_BAES1_PDF',	
	'DataFaEs1PerSat_BAES1_PDF',
	'DataFaEs1SatJenbel_BAES1_PDF',
	'DataFaEs1SatSdana_BAES1_PDF',
	'DataRealisasiKegiatanBA_BAES1_PDF',
    'DataRealisasiKegiatanES1_BAES1_PDF',
	'DataRealisasiOutputBA_BAES1_PDF',
	'DataRealisasiKabupatenBAES1_BAES1_PDF',
	'nmsatkerBAES1_BAES1_PDF',
    'RekapSp2dBAES1_BAES1_PDF',
    'DataRealisasiPenerimaanBA_BAES1_PDF',
	'DataRealisasiPenerimaanPerES1_BAES1_PDF',
    'nmsatker_BAES1_PDF',
    'ProsesRevisi_BAES1_PDF',	
    'DataRealisasiOutputES1_BAES1_PDF',
	'detailrekapsp2dBAES1_BAES1_PDF',
	'DataRealisasiPenerimaanPerSatkerES1_BAES1_PDF',
	'DataRealisasiKegiatanBAES1_BAES1_PDF',
	'DetailEncumbrances_BAES1_PDF',
	'registerDJPU_PDF',
	'refAkun_PDF',
	'refKppn_PDF',	
	'refSdana_PDF',
	'refLokasi_PDF',
	'RevisiDipa_PDF',
	'DetailRevisi_PDF',
    '__destruct'
);

/*
 * akses PDR
 */
$akses['DataPDRKL'] = array(
        '__construct',
        'index',
        'refAkun',
        'refKppn',
        'refSdana',
        'refLokasi',
        '__destruct'
);

?>
