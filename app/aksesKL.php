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
?>
