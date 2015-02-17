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
    '__destruct'
);

?>
