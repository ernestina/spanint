<!DOCTYPE html>
<html>
    <head>
        <title>.:SPAN Interface:.</title>
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
        <!--link href="<?php echo URL; ?>public/css/dialog.css" rel="stylesheet"-->

        <script type="text/javascript">
            $(function() {
                $('#datepicker').datepicker();
                $('#datepicker1').datepicker();
                $('#datepicker2').datepicker({dateFormat: "dd-mm-yy"});
				$('#datepicker3').datepicker({dateFormat: "dd-mm-yy"});
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
						echo '<li class="subnav"><a href=#>Modul PM</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataSPM/posisiSPM></i>Monitoring Posisi SPM</a></li>
                                <li><a href=' . URL . 'dataSPM/holdSPM></i>Hold SPM</a></li>
                                <li><a href=#></i>Detail Gagal Unggah SPM</a></li>
                            </ul>
							</li>';
						echo '<li class="subnav"><a href=#>Modul SA</a>';
						echo '<ul>
                                <li><a href='  . URL . 'dataDIPA/revisiDIPA></i>Informasi Revisi DIPA</a></li>
                                <li><a href='  . URL . 'dataDIPA/realisasiFA></i>Sisa Pagu Belanja Realisasi dan Encumbrance</a></li>
                            </ul>
                            </li>';
						
						echo '<li class="subnav"><a href=#>Modul GR - blom di masukan</a>';
						echo '<ul>
                                <li><a href=#></i>Konfirmasi</a></li>
                                <li><a href=#></i>IJP</a></li>
								<li><a href=#></i>PFK</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/monitoringSp2d>XICO</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/monitoringSp2d></i>Cek status SP2D</a></li>
                                <li><a href=' . URL . 'dataKppn/harianBO></i>Laporan SP2D Harian ke BO1</a></li>
								<li><a href=' . URL . 'dataKppn/sp2dHariIni></i>Laporan SP2D tertanggal hari ini</a></li>
								<li><a href=' . URL . 'dataKppn/Sp2dBesok></i>Laporan SP2D tertanggal besok</a></li>
								<!--<li><a href=' . URL . 'dataKppn/Sp2dHarian></i>Jumlah SP2D Harian ke Bank</a></li>-->
                                <li><a href=' . URL . 'dataKppn/Sp2dBackdate></i>SP2D Backdate</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dNilaiMinus></i>SP2D Minus dan 0</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSudahVoid></i>SP2D Void</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/Sp2dGajiDobel>Cek Gaji</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/Sp2dGajiDobel></i>Terindikasi dobel</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahTanggal></i>Teridikasi salah Tanggal</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahBank></i>Terindikasi salah Bank</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahRekening></i>Teridikasi salah Rekening</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dCompareGaji></i>Perbandingan Gaji dengan bulan lalu</a></li>
                            </ul>
                            </li>';
                        echo '<li class="subnav"><a href=#>XICO dan BS - belum dimasukan</a>';
						echo '<ul>
                                <li><a href=#></i>Rekon harian XICO dan BS</a></li>
                                <li><a href=#></i>Flag Check</a></li>
                                <li><a href=#></i>Hasil</a></li>
                            </ul>
                            </li>';
                    }
                    ?>
                    <li>
                        <a href="<?php echo URL; ?>auth/logout"><i class="icon-off"></i></a>
                    </li>
                    <!--li class="nav" style="float: right; font-size: 70%">
                        <a style="color: #F2C45A ">Selamat datang,<?php //echo Session::get('user') ?></a>
                    </li-->
                </ul>
            </div>





