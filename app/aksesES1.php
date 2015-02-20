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
/*
 * akses modul PDF
 */
$akses['PDFES1'] = array(
    '__construct',
    'index',
    'DataRealisasiAkunES1_BAES1_PDF',
    'DataRealisasiKewenanganBAES1_BAES1_PDF',
    'DataRealisasiSumberDanaBAES1_BAES1_PDF',
	'DataRealisasiWilayahBAES1_BAES1_PDF',
	'DataRealisasiKegiatanES1_BAES1_PDF',
	'DataRealisasiOutputES1_BAES1_PDF',
    'DataRealisasiPenerimaanBA_BAES1_PDF',
	'detailrekapsp2dBAES1_BAES1_PDF',
    'nmsatker_BAES1_PDF',
    'ProsesRevisi_BAES1_PDF',
	'nmsatkerBAES1_BAES1_PDF',
    'RekapSp2dBAES1_BAES1_PDF',
    '__destruct'
);
?>
