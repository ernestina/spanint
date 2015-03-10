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
?>