<?php

//-----------------------------------------------------------
// AKSES UNTUK PKN // -------------------------------------
//-----------------------------------------------------------


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
?>