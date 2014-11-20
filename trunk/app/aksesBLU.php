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
    '__destruct'
);
?>