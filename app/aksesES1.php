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
    '__destruct'
);
?>
