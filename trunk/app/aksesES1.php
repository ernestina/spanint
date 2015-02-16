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

?>
