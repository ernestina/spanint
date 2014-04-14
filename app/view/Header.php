<!DOCTYPE html>
<html>
    <head>
        <title>.:Aplikasi Persiapan Piloting SPAN:.</title>
        <script src="<?php echo URL; ?>public/js/Chart.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/myjs.js"></script>
        <script src="<?php echo URL; ?>public/js/teamdf-jquery-number/jquery.number.js"></script>
        <script src="<?php echo URL; ?>public/js/gaugejs/raphael.2.1.0.min.js"></script>
        <script src="<?php echo URL; ?>public/js/gaugejs/justgage.1.0.1.min.js"></script>
        <script src="<?php echo URL; ?>public/js/Chart.js"></script>
        <script src="<?php echo URL; ?>public/js/paging.js"></script>
        <link href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/ernest.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/dialog.css" rel="stylesheet">

        <script type="text/javascript">
            $(function() {
                $('#datepicker').datepicker();
                $('#datepicker1').datepicker();
                $('#datepicker2').datepicker();
            });
        </script>
    </head>
    <header><img src="<?php echo URL; ?>public/img/span-putih.png" width="40px" height="48px"></header>
    <body>
        <div id="wrapper">
            <div id="menu">
                <ul>
                    <li class="nav"><a href="#"></a></li>
                    <li class="nav"><a href="#"></a></li>
                    <li class="nav"><a href="#"></a></li>
                    <?php
                    if (Session::get('role') == ADMIN) {
                        echo '<li class="nav"><a href=' . URL . 'dataKppn/rekapAll>Beranda</a></li>';
                        echo '<li class="subnav"><a href=' . URL . 'dataKppn/rekapKanwil/2000>Per Kanwil</a>';
                        echo '<ul>
                                <li><a href=' . URL . 'dataKppn/rekapKanwil/2000></i>SUMUT</a></li>
                                <li><a href=' . URL . 'dataKppn/rekapKanwil/12000></i>JAKARTA</a></li>
                                <li><a href=' . URL . 'dataKppn/rekapKanwil/13000></i>JABAR</a></li>
                                <li><a href=' . URL . 'dataKppn/rekapKanwil/15000></i>JOGJA</a></li>
                                <li><a href=' . URL . 'dataKppn/rekapKanwil/16000></i>JATIM</a></li>
                                <li><a href=' . URL . 'dataKppn/rekapKanwil/23000></i>NTT</a></li>
                                <li><a href=' . URL . 'dataKppn/rekapKanwil/24000></i>SULSEL</a></li>
                            </ul>
                            </li>';
                        echo '<li class="nav"><a href=' . URL . 'dataKppn/rekapKppn>Per KPPN</a></li>';
						echo '<li class="nav"><a href=' . URL . 'dataKppn/rekapMasalah>Rekap Masalah</a></li>';
                    }
                    if (Session::get('role') == KANWIL) {
                        echo '<li class="nav"><a href=' . URL . 'dataKppn/monitoringSp2d>Cek</a></li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/harianBO>Laporan</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/harianBO></i>Harian BO I</a></li>
                                <li><a href=' . URL . 'dataKppn/sp2dHariIni></i>SP2D Tanggal hari ini</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dBesok></i>SP2D Tanggal besok</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dBackdate></i>SP2D Backdate</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dHarian></i>Total SP2D Harian</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dBelumVoid></i>Belum void</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSudahVoid></i>Sudah void</a></li>
                            </ul>
                            </li>';
                    }
                    ?>
                    <li class="nav">
                        <a href="<?php echo URL; ?>auth/logout">Logout</a>
                    </li>
                    <li class="nav" style="float: right; font-size: 70%">
                        <a style="color: #F2C45A ">Selamat datang,<?php echo Session::get('user') ?></a>
                    </li>
                </ul>
            </div>





