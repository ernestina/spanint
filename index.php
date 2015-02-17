<?php

/*
 * error reporting on
 */

error_reporting(E_ALL ^ E_NOTICE);

/*
 * define the sitepath OM SPAN/
 */

$sitepath = realpath(dirname(__FILE__));
define('ROOT',$sitepath);

//echo $sitepath;

/*
 * define the sitepath url
 */

$base_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/';

define('URL',$base_url);

/*
 * define role
 */
define('ADMIN','admin');
define('SATKER','satker');
define('KPPN','kppn');
define('PKN','pkn');
define('KANWIL','kanwil');
define('DJA','dja');
define('BLU','blu');
define('BANK','bank');
define('KL','kl');
define('ES1','es1');

$path = array(
    ROOT.'/libs/',
    ROOT.'/app/controllers/',
    ROOT.'/app/models/'
);

//include ROOT.'/config/config.php';
include ROOT.'/libs/Autoloader.php';
include ROOT.'/libs/config.php';
include ROOT.'/app/akses.php';

Autoloader::setCacheFilePath(ROOT.'/libs/cache.txt');
Autoloader::setClassPaths($path);
Autoloader::register();
$registry = new Registry();
//$registry->upload = new Upload();
$registry->view = new View();
$registry->db = new Database();
$registry->auth = new Auth();


//menambahkan level user 
$registry->auth->add_roles('admin'); //admin
$registry->auth->add_roles('satker'); //satker
$registry->auth->add_roles('kppn'); //kppn
$registry->auth->add_roles('kanwil'); //kanwil
$registry->auth->add_roles('pkn'); //pkn
$registry->auth->add_roles('dja'); //dja
$registry->auth->add_roles('blu'); //blu
$registry->auth->add_roles('bank'); //bank
$registry->auth->add_roles('kl'); //blu
$registry->auth->add_roles('es1'); //bank
$registry->auth->add_roles('guest'); //guest

//menambahkan akses ke level user
//level admin
$registry->auth->add_access('auth','admin',$akses['AuthAdmin']);
$registry->auth->add_access('home','admin',$akses['HomeAdmin']);
$registry->auth->add_access('dataDIPA','admin',$akses['DataDIPAAdmin']);
$registry->auth->add_access('dataPDR','admin',$akses['DataPDRAdmin']);
$registry->auth->add_access('dataDroping','admin',$akses['DataDropingAdmin']);
$registry->auth->add_access('dataGR','admin',$akses['DataGRAdmin']);
$registry->auth->add_access('dataJSON','admin',$akses['DataJSONAdmin']);
$registry->auth->add_access('dataKppn','admin',$akses['DataKppnAdmin']);
$registry->auth->add_access('dataRetur','admin',$akses['DataReturAdmin']);
$registry->auth->add_access('dataRetur','admin',$akses['DataSatkerAdmin']);
$registry->auth->add_access('dataSPM','admin',$akses['DataSPMAdmin']);
$registry->auth->add_access('dataSupplier','admin',$akses['DataSupplierAdmin']);
$registry->auth->add_access('dataUser','admin',$akses['DataUserAdmin']);
$registry->auth->add_access('userSpan','admin',$akses['UserSpanAdmin']);
$registry->auth->add_access('dataPelimpahan','admin',$akses['DataPelimpahanAdmin']);
$registry->auth->add_access('PDF','admin',$akses['PDFAdmin']);
$registry->auth->add_access('panduan','admin',$akses['PanduanAdmin']);
$registry->auth->add_access('pelaporan','admin',$akses['PelaporanAdmin']);
if (Session::get('kd_satker') == andi ){
    $registry->auth->add_access('dataUser','admin',$akses['DataUserAdmin']);   
}
$registry->auth->add_access('dataPMRTPKN','admin',$akses['DataPMRTPKNAdmin']);
$registry->auth->add_access('dataBPN','admin',$akses['DataBPNAdmin']);
$registry->auth->add_access('BA_ES1','admin',$akses['BaEs1Admin']);

//level satker
$registry->auth->add_access('auth','satker',$akses['AuthSatker']);
$registry->auth->add_access('home','satker',$akses['HomeSatker']);
$registry->auth->add_access('dataDIPA','satker',$akses['DataDIPASatker']);
$registry->auth->add_access('dataJSON','satker',$akses['DataJSONSatker']);
$registry->auth->add_access('dataKppn','satker',$akses['DataKppnSatker']);
$registry->auth->add_access('dataGR','satker',$akses['DataGRSatker']);
$registry->auth->add_access('dataRetur','satker',$akses['DataReturSatker']);
$registry->auth->add_access('dataSPM','satker',$akses['DataSPMSatker']);
$registry->auth->add_access('dataSupplier','satker',$akses['DataSupplierSatker']);
$registry->auth->add_access('PDF','satker',$akses['PDFSatker']);
$registry->auth->add_access('panduan','satker',$akses['PanduanSatker']);


//level kppn
$registry->auth->add_access('auth','kppn',$akses['AuthKPPN']);
$registry->auth->add_access('home','kppn',$akses['HomeKPPN']);
$registry->auth->add_access('dataPNBP','kppn',$akses['DataPNBPKPPN']);
$registry->auth->add_access('dataDIPA','kppn',$akses['DataDIPAKPPN']);
$registry->auth->add_access('dataGR','kppn',$akses['DataGRKPPN']);
$registry->auth->add_access('dataJSON','kppn',$akses['DataJSONKPPN']);
$registry->auth->add_access('dataKppn','kppn',$akses['DataKppnKPPN']);
$registry->auth->add_access('dataRetur','kppn',$akses['DataReturKPPN']);
$registry->auth->add_access('dataSPM','kppn',$akses['DataSPMKPPN']);
$registry->auth->add_access('dataSupplier','kppn',$akses['DataSupplierKPPN']);
$registry->auth->add_access('userSpan','kppn',$akses['UserSpanAdmin']);
$registry->auth->add_access('dataPelimpahan','kppn',$akses['DataPelimpahanKPPN']);
$registry->auth->add_access('PDF','kppn',$akses['PDFKPPN']);
$registry->auth->add_access('panduan','kppn',$akses['PanduanKPPN']);
$registry->auth->add_access('pelaporan','kppn',$akses['PelaporanKPPN']);
$registry->auth->add_access('dataPersiapanRollout','kppn',$akses['DataPersiapanRolloutKPPN']);
$registry->auth->add_access('dataPMRT','kppn',$akses['DataPMRTKPPN']);

//level pkn
$registry->auth->add_access('auth','pkn',$akses['AuthPKN']);
$registry->auth->add_access('home','pkn',$akses['HomePKN']);
$registry->auth->add_access('dataKppn','pkn',$akses['DataKppnPKN']);
$registry->auth->add_access('dataDroping','pkn',$akses['DataDropingPKN']);
$registry->auth->add_access('dataRetur','pkn',$akses['DataReturPKN']);
$registry->auth->add_access('PDF','pkn',$akses['PDFPKN']);
$registry->auth->add_access('panduan','pkn',$akses['PanduanPKN']);
$registry->auth->add_access('pelaporan','pkn',$akses['PelaporanPKN']);
$registry->auth->add_access('dataPelimpahan','pkn',$akses['DataPelimpahanPKN']);
$registry->auth->add_access('dataGR','pkn',$akses['DataGRPKN']);
$registry->auth->add_access('dataPMRTPKN','pkn',$akses['DataPMRTPKN']);


//level kanwil
$registry->auth->add_access('auth','kanwil',$akses['AuthKanwil']);
$registry->auth->add_access('home','kanwil',$akses['HomeKanwil']);
$registry->auth->add_access('dataDIPA','kanwil',$akses['DataDIPAKanwil']);
$registry->auth->add_access('dataGR','kanwil',$akses['DataGRKanwil']);
$registry->auth->add_access('dataJSON','kanwil',$akses['DataJSONKanwil']);
$registry->auth->add_access('dataKppn','kanwil',$akses['DataKppnKanwil']);
$registry->auth->add_access('dataSPM','kanwil',$akses['DataSPMKanwil']);
$registry->auth->add_access('userSpan','kanwil',$akses['UserSpanKanwil']);
$registry->auth->add_access('dataPelimpahan','kanwil',$akses['DataPelimpahanKanwil']);
$registry->auth->add_access('PDF','kanwil',$akses['PDFKanwil']);
$registry->auth->add_access('panduan','kanwil',$akses['PanduanKanwil']);
$registry->auth->add_access('pelaporan','kanwil',$akses['PelaporanKanwil']);
$registry->auth->add_access('dataRetur','kanwil',$akses['DataReturKanwil']);

//level dja
$registry->auth->add_access('auth','dja',$akses['AuthDJA']);
$registry->auth->add_access('home','dja',$akses['HomeDJA']);
$registry->auth->add_access('dataDIPA','dja',$akses['DataDIPADJA']);
$registry->auth->add_access('dataSPM','dja',$akses['DataSPMDJA']);
$registry->auth->add_access('userSpan','dja',$akses['UserSpanDJA']);
$registry->auth->add_access('PDF','dja',$akses['PDFDJA']);
$registry->auth->add_access('panduan','dja',$akses['PanduanDJA']);

//level blu
$registry->auth->add_access('auth','blu',$akses['AuthBLU']);
$registry->auth->add_access('home','blu',$akses['HomeBLU']);
$registry->auth->add_access('panduan','blu',$akses['PanduanBLU']);
$registry->auth->add_access('dataBLU','blu',$akses['DataBLU']);
$registry->auth->add_access('PDF','blu',$akses['PDFBLU']);

//level bank
$registry->auth->add_access('auth','bank',$akses['AuthBank']);
$registry->auth->add_access('home','bank',$akses['HomeBank']);
$registry->auth->add_access('dataDroping','bank',$akses['DataDropingBank']);
$registry->auth->add_access('PDF','bank',$akses['PDFBank']);

//level KL
$registry->auth->add_access('auth','kl',$akses['AuthKL']);
$registry->auth->add_access('home','kl',$akses['HomeKL']);
$registry->auth->add_access('BA_ES1','kl',$akses['BaEs1KL']);

//level ES1
$registry->auth->add_access('auth','es1',$akses['AuthES1']);
$registry->auth->add_access('home','es1',$akses['HomeES1']);
$registry->auth->add_access('BA_ES1','es1',$akses['BaEs1ES1']);

//levelguest
$registry->auth->add_access('auth','guest',$akses['AuthAdmin']);




$registry->exception = new ClassException();
$registry->bootstrap = new Bootstrap($registry);

$registry->bootstrap->loader();
