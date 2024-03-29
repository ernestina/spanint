<?php

//-----------------------------------------------------------
// AKSES UNTUK Admin // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeBLU'] = array(
    '__construct',
    'index',
    'dashboard',
    'dashboardPenerbitan',
    '__destruct'
);

/*
 * akses modul auth
 */
$akses['AuthBLU'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

$akses['PanduanBLU'] = array(
    'lihatPanduan1',
    '__destruct'
);

$akses['DataBLU'] = array(
    'KarwasBLU',
	'DaftarSP3',
	'CariSP3B',
    'DataRealisasiBLU',
    'DataRealisasiBelanjaBLU',
    '__destruct'
);



/*
 * akses modul PDF
 */
$akses['PDFBLU'] = array(
    '__construct',
    'KarwasBLU_PDF',
    'DaftarSP3_PDF',
    'DataRealisasiBLU_PDF',
    'CariSP3B_PDF',
    'DataRealisasiBLU_PDF',
    'DataRealisasiBelanjaBLU_PDF',
	'registerDJPU_PDF',
	'refAkun_PDF',
	'refKppn_PDF',	
	'refSdana_PDF',
	'refLokasi_PDF',
	'refSatker_PDF',
    '__destruct'
);

/*
 * akses PDR
 */
$akses['DataPDRBLU'] = array(
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