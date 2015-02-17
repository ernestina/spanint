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
    '__destruct'
);

?>
