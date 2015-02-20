<?php

//-----------------------------------------------------------
// AKSES UNTUK UMADMIN // -------------------------------------
//-----------------------------------------------------------

/*
 * akses modul Home
 */
$akses['HomeUmAdmin'] = array(
    '__construct',
    'index',
    'dashboard',
    '__destruct'
);


/*
 * akses modul auth
 */
$akses['AuthUmAdmin'] = array(
    '__construct',
    'index',
    'login',
    'logout',
    '__destruct'
);

/*
 * akses modul DataDIPA User
 */
$akses['DataUMAdmin'] = array(
    '__construct',
    'monitoringUserSpan',
    'pergantianuser',
    'invoiceProses',
    'addDataUserSpan',
    '__destruct'
);

?>
