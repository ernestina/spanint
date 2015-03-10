<?php

$akses['AuthMenkeu'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

$akses['HomeMenkeu'] = array(
    '__construct',
    'index',
    'dashboard',
    '__destruct'
);

$akses['DashboardMenkeu'] = array(
        '__construct',
        'index',
        'overviewMenkeu',
        'overviewAdmin',
        'overviewKanwil',
        'overviewKPPN',
        'overviewSatker',
        '__destruct'
);

$akses['DataLRAMenkeu'] = array(
        '__construct',
        'DataLRA',
        '__destruct'
);


/*
 * akses modul BA_ES1
 */
$akses['BaEs1Menkeu'] = array(
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
    'DataFaPerBA',
    '__destruct'
);

/*
 * akses modul PDF
 */
$akses['PDFMENKEU'] = array(
    '__construct',
	'DataRealisasiKegiatanBA_BAES1_PDF',
    'DataRealisasiKegiatanES1_BAES1_PDF',
    'DataRealisasiAkunBA_BAES1_PDF',
    'DataRealisasiAkunES1_BAES1_PDF',
    'DataRealisasiKewenanganBAES1_BAES1_PDF',
    'nmsatker_BAES1_PDF',
    'ProsesRevisi_BAES1_PDF',	
	'DataRealisasiOutputBA_BAES1_PDF',
	'DataFaBaSatEs1_BAES1_PDF',
	'DataFaBaPerEs1_BAES1_PDF',
	'DataFaBaPerJenbel_BAES1_PDF',
	'DataFaBaPerSdana_BAES1_PDF',
	'DataFaBaEs1Jenbel_BAES1_PDF',
	'DataFaBaEs1Sdana_BAES1_PDF',	
    'DataRealisasiOutputES1_BAES1_PDF',
	'DataRealisasiWilayahBAES1_BAES1_PDF',
    'DataRealisasiSumberDanaBAES1_BAES1_PDF',
    'RekapSp2dBAES1_BAES1_PDF',
	'detailrekapsp2dBAES1_BAES1_PDF',
	'nmsatkerBAES1_BAES1_PDF',
    'DataRealisasiPenerimaanBA_BAES1_PDF',
	'DataRealisasiKabupatenBAES1_BAES1_PDF',
	'DataRealisasiPenerimaanPerES1_BAES1_PDF',
	'DataRealisasiPenerimaanPerSatkerES1_BAES1_PDF',
	'DataRealisasiKegiatanBAES1_BAES1_PDF',
	'DetailEncumbrances_BAES1_PDF',
	'DataUPBAES1_PDF',
	'KarwasTUPBaes1_PDF',
	'DataFaPerBA_BAES1_PDF',
	'daftarsp2d_PDF',
	'DataFaEs1PerSat_BAES1_PDF',
	'DataFaEs1SatJenbel_BAES1_PDF',
	'DataFaEs1SatSdana_BAES1_PDF',
	'DataRealisasiPenerimaanPerSatkerES1_PDF',
	'DetailRevisi_PDF',
	'refAkun_PDF',
	'refKppn_PDF',	
	'refSdana_PDF',
	'refLokasi_PDF',
	'refSatker_PDF',
	'registerDJPU_PDF',
	'RevisiDipa_PDF',
	'TUPSatker_PDF',
	'UPSatker_PDF',
    '__destruct'
);

?>