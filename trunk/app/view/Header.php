<!DOCTYPE HTML>
<html>

    <head>

        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?php echo URL; ?>public/monster-logo-small.ico"/>
        <link rel="icon" href="<?php echo URL; ?>public/monster-logo-small.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">

        <title>Online Monitoring SPAN </title>

        <!-- JQuery & Jquery Plugins -->
        <script src="<?php echo URL; ?>public/JQuery/jquery-2.1.1.min.js"></script>
        <script src="<?php echo URL; ?>public/JQuery/plugins/jquery.nanoscroller.min.js"></script>
        <link href="<?php echo URL; ?>public/JQuery/plugins/nanoscroller.css" rel="stylesheet">

        <!-- Bootstrap CSS & JS -->
        <script src="<?php echo URL; ?>public/Bootstrap/js/bootstrap.min.js"></script>
        <link href="<?php echo URL; ?>public/Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/font-awesome.css" rel="stylesheet">

        <!-- Bootstrap Datepicker CSS & JS -->
        <script src="<?php echo URL; ?>public/Bootstrap/plugins/bootstrap-datepicker.js"></script>
        <script src="<?php echo URL; ?>public/Bootstrap/plugins/bootstrap-datepicker.id.js"></script>
        <link href="<?php echo URL; ?>public/Bootstrap/plugins/datepicker3.css" rel="stylesheet">

        <!-- D3 & C3 -->
        <script src="<?php echo URL; ?>public/D3/d3.min.js"></script>
        <script src="<?php echo URL; ?>public/C3/c3.min.js"></script>
        <link href="<?php echo URL; ?>public/C3/c3.min.css" rel="stylesheet">

        <!-- ChartJS -->
        <script src="<?php echo URL; ?>public/ChartJS/Chart.min.js"></script>

        <!-- Application CSS -->
        <link href="<?php echo URL; ?>public/monster.css" rel="stylesheet">

    </head>

    <body>

        <!-- Sidebar -->
        <div id="sidebar" class="nano">

            <div class="nano-content">
                <?php   
                if (Session::get('role') == ADMIN): require_once('header/HeaderAdmin.php');
                elseif (Session::get('role') == KANWIL): require_once('header/HeaderKanwil.php');  
                elseif (Session::get('role') == KPPN): require_once('header/HeaderKPPN.php');
                elseif (Session::get('role') == SATKER): require_once('header/HeaderSatker.php');
                elseif (Session::get('role') == PKN): require_once('header/HeaderPKN.php');
                elseif (Session::get('role') == BLU): require_once('header/HeaderBLU.php');
                elseif (Session::get('role') == DJA): require_once('header/HeaderDJA.php');
                elseif (Session::get('role') == BANK): require_once('header/HeaderBank.php'); 
                elseif (Session::get('role') == KL): require_once('header/HeaderKL.php'); 
                elseif (Session::get('role') == ES1): require_once('header/HeaderES1.php');      
                elseif (Session::get('role') == UMADMIN): require_once('header/HeaderUmadmin.php');    
                elseif (Session::get('role') == MENKEU): require_once('header/HeaderMenkeu.php');      
                endif; 
                ?>
            </div>

        </div>

        <!-- Jendela Utama -->

        <div id="main-content">

            <!-- Navigasi atas -->

            <nav id="main-bar" class="navbar navbar-default" role="navigation">
                <div class="container-fluid">

                    <div id="mainmenu-left-single" class="navbar-text btn-group hidden-xs hidden-sm hidden-md navbar-left">
                        <a id="menu-toggle-thin" class="btn btn-outline" onclick="toggleSidebar()"><span class="glyphicon glyphicon-th-list"></span> Menu</a>
                        <span id="tv-unit-title" style="display: none; padding-left: 20px;"><?php echo Session::get('user') ?></span>
                    </div>

                    <div id="menu-package" class="navbar-text btn-group hidden-lg" style="float: left;">
                        <a type="button" id="menu-toggle-wide" class="btn btn-outline" onclick="toggleSidebar()"><span class="glyphicon glyphicon-th-list"></span> <span class="hidden-xs">Menu</span></a>
                        <a type="button" class="btn btn-outline" id="button-user-small" data-toggle="tooltip" data-placement="bottom" title="<?php echo Session::get('user') ?>"><span class="glyphicon glyphicon-user"></span> <span class="hidden-xs">Pengguna</span></a>
                        <a type="button" class="btn btn-outline" href="<?php echo URL; ?>auth/logout"><span class="glyphicon glyphicon-lock"></span> <span class="hidden-xs">Keluar</span></a>
                    </div>

                    <a id="span-logo-regular" class="navbar-brand hidden-xs hidden-sm hidden-md navbar-left" href="http://www.span.depkeu.go.id/" target="blank"><img src="<?php echo URL; ?>public/span-logo.png">&nbsp;&nbsp;</a>
                    <a id="monster-logo-regular" class="navbar-brand navbar-left hidden-xs" href="<?php echo URL; ?>"><img src="<?php echo URL; ?>public/monster-logo-small.png">&nbsp;Online Monitoring : <?php echo Session::get('ta'); ?></a>

                    <a id="span-logo-small" class="navbar-brand hidden-lg" href="<?php echo URL; ?>"><img src="<?php echo URL; ?>public/span-logo-small.png"></a>
                    <a id="monster-logo-small" class="navbar-brand navbar-left visible-xs" href="http://www.span.depkeu.go.id/"><img src="<?php echo URL; ?>public/monster-logo-small.png"></a>

                    <div id="mainmenu-right" class="navbar-text btn-group hidden-xs hidden-sm hidden-md navbar-right" style="padding-right: 10px">
                        <a type="button" class="btn btn-outline" id="button-user-large" data-toggle="tooltip" data-placement="bottom" title="<?php echo Session::get('user') ?>"><span class="glyphicon glyphicon-user"></span> <span id="nav-user-name"><?php echo Session::get('user') ?></span></a>
                        <a type="button" class="btn btn-outline" href="<?php echo URL; ?>auth/logout"><span class="glyphicon glyphicon-lock"></span> Keluar</a>
                    </div>

                </div>
            </nav>

            <div id="content-container">

                <!-- Bersambung ke konten utama -->