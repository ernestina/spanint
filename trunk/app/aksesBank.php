<?php

//-----------------------------------------------------------
// AKSES UNTUK Bank // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeBank'] = array(
    '__construct',
    'index',
    '__destruct'
);

/*
 * akses modul auth
 */
$akses['AuthBank'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul DataDropping
 */
$akses['DataDropingBank'] = array(
    '__construct',
    'index',
    'monitoringDroping',
    'detailDroping',
    'detailSPAN',
    '__destruct'
);



/*
 * akses modul PDF
 */
$akses['PDFBank'] = array(
    '__construct',
    'index',
	'detailDroping_PDF',
	'detailSPAN_PDF',
    '__destruct'
);
?>