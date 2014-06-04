<!DOCTYPE html>
<html>
    <head>
        <title>.:Online Monitoring SPAN:.</title>
       	<!--javascript-nya-->			
		<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
		<script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/myjs.js"></script>
        <script src="<?php echo URL; ?>public/js/teamdf-jquery-number/jquery.number.js"></script>
        <script src="<?php echo URL; ?>public/js/gaugejs/raphael.2.1.0.min.js"></script>
        <script src="<?php echo URL; ?>public/js/gaugejs/justgage.1.0.1.min.js"></script>
        <script src="<?php echo URL; ?>public/js/canvasjs.min.js"></script>
        <script src="<?php echo URL; ?>public/js/paging.js"></script>
		
        <!--css-nya-->
		<link href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/ernest.css" rel="stylesheet">
		
		
        <script type="text/javascript">
            $(function() {
                $('#datepicker').datepicker();
                $('#datepicker1').datepicker();
                $('#datepicker2').datepicker({dateFormat: "dd-mm-yy"});
				$('#datepicker3').datepicker({dateFormat: "dd-mm-yy"});
            });
			$(document).ready(function() {
				$('#wrapper').css('min-height', window.innerHeight-90);
			});
			$(window).resize(function() {
				$('#wrapper').css('min-height', window.innerHeight-90);
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

						echo '<li class="subnav"><a href=' . URL . 'UserSpan/monitoringUserSpan>Modul MU</a>';

						echo '<ul>
                                <li><a href=' . URL . 'UserSpan/monitoringUserSpan></i>Monitoring Pergantian User</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=#>Modul SA</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataDIPA/nmsatker></i>Informasi Revisi DIPA</a></li>
								<li><a href=' . URL . 'dataDIPA/nmsatker1></i>Sisa Pagu Belanja Realisasi dan Encumbrance</a></li>
                            </ul>
                            </li>';
							
						echo '<li class="subnav"><a href=' . URL . 'dataSPM/posisiSPM></i>Modul PM</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataSPM/posisiSPM></i>Monitoring Posisi Invoice</a></li>
                                <li><a href=' . URL . 'dataSPM/holdSPM></i>Hold Invoice</a></li>
                                <li><a href='. URL . 'dataSPM/validasiSPM></i>Daftar Penolakan PMRT</a></li>
								<li><a href='. URL . 'dataSPM/historySPM></i>Histori Invoice</a></li>
								<li><a href='. URL . 'dataSPM/durasiSPM></i>Durasi Penyelesaian SP2D</a></li>
								<li><a href='. URL . 'dataSPM/nmSatker></i>Daftar SP2D per Satker</a></li>
                            </ul>
							</li>';
						echo '<li class="subnav"><a href='. URL .'dataGR/grStatusHarian>Modul GR</a>';
						echo '<ul>
                                <li><a href='. URL .'dataGR/grStatusHarian></i>Monitoring Status LHP</a></li>
								<li><a href='. URL .'dataGR/GR_IJP></i>Monitoring IJP</a></li>
								<li><a href='. URL .'dataGR/GR_PFK></i>Monitoring PFK</a></li>
                            </ul>
                            </li>';
                        echo '<li class="subnav"><a href=' . URL . 'dataKppn/monitoringSp2d>BANK</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/monitoringSp2d></i>Cek status SP2D</a></li>
                                <li><a href=' . URL . 'dataRetur/monitoringRetur></i>Daftar SP2D Retur</a></li>
                                <li><a href=' . URL . 'dataKppn/harianBO></i>Laporan SP2D Harian ke Bank</a></li>
								<li><a href=' . URL . 'dataKppn/sp2dHariIni></i>Laporan SP2D terbit dan tertanggal di hari yang sama</a></li>
								<li><a href=' . URL . 'dataKppn/Sp2dBesok></i>Laporan SP2D terbit di atas jam 3 tertanggal hari ini</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dBackdate></i>SP2D Backdate</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dNilaiMinus></i>SP2D Minus dan 0</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSudahVoid></i>SP2D Void</a></li>
								<li><a href=' . URL . 'dataKppn/Sp2dRekap></i>Rekap Penerbitan SP2D</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/Sp2dGajiDobel>Cek Gaji</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/Sp2dGajiDobel></i>Terindikasi dobel</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahTanggal></i>Terindikasi salah Tanggal</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahBank></i>Terindikasi salah Bank</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahRekening></i>Terindikasi salah PayGroup</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dCompareGaji></i>Perbandingan Gaji per Bulan</a></li>
                            </ul>
                            </li>';
						echo '<li class="nav"><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan</a>';
						echo '<ul>
								<li><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan Simpan ke Excel</a></li>
							</ul>
							</li>';
                    }
                    if (Session::get('role') == KANWIL) {


						echo '<li class="subnav"><a href=' . URL . 'UserSpan/monitoringUserSpan>Modul MU</a>';
						echo '<ul>
                                <li><a href=' . URL . 'UserSpan/monitoringUserSpan></i>Monitoring Pergantian User</a></li>
                            </ul>
                            </li>';

						echo '<li class="subnav"><a href=#>Modul SA</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataDIPA/nmsatker></i>Informasi Revisi DIPA</a></li>
								<li><a href=' . URL . 'dataDIPA/nmsatker1></i>Sisa Pagu Belanja Realisasi dan Encumbrance</a></li>
                            </ul>
                            </li>';
							

						echo '<li class="subnav"><a href=#>Modul PM</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataSPM/posisiSPM></i>Monitoring Posisi Invoice</a></li>
                                <li><a href=' . URL . 'dataSPM/holdSPM></i>Hold Invoice</a></li>
                                <li><a href='. URL . 'dataSPM/validasiSPM></i>Daftar Penolakan PMRT</a></li>
								<li><a href='. URL . 'dataSPM/historySPM></i>Histori Invoice</a></li>
								<li><a href='. URL . 'dataSPM/durasiSPM></i>Durasi Penyelesaian SP2D</a></li>
								<li><a href='. URL . 'dataSPM/nmSatker></i>Daftar SP2D per Satker</a></li>
                            </ul>
							</li>';
						echo '<li class="subnav"><a href=#>Modul GR</a>';
						echo '<ul>
                                <li><a href='. URL .'dataGR/grStatusHarian></i>Monitoring Status LHP</a></li>
								 <li><a href='. URL .'dataGR/GR_IJP></i>Monitoring IJP</a></li>
								<li><a href='. URL .'dataGR/GR_PFK></i>Monitoring PFK</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/monitoringSp2d>BANK</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/monitoringSp2d></i>Cek status SP2D</a></li>
                                <li><a href=' . URL . 'dataRetur/monitoringRetur></i>Daftar SP2D Retur</a></li>
                                <li><a href=' . URL . 'dataKppn/harianBO></i>SP2D Harian ke BO1</a></li>
								<li><a href=' . URL . 'dataKppn/sp2dHariIni></i>SP2D terbit dan tertanggal di hari yang sama</a></li>
								<li><a href=' . URL . 'dataKppn/Sp2dBesok></i>SP2D terbit diatas jam 3 tertanggal hari yang sama</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dBackdate></i>SP2D Backdate</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dNilaiMinus></i>SP2D Minus dan 0</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSudahVoid></i>SP2D Void</a></li>
								<li><a href=' . URL . 'dataKppn/Sp2dRekap></i>Rekap penerbitan SP2D</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/Sp2dGajiDobel>Cek Gaji</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/Sp2dGajiDobel></i>Terindikasi dobel</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahTanggal></i>Terindikasi salah Tanggal</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahBank></i>Terindikasi salah Bank</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahRekening></i>Terindikasi salah PayGroup</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dCompareGaji></i>Perbandingan Gaji per Bulan</a></li>
                            </ul>
                            </li>';
						echo '<li class="nav"><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan</a>';
						echo '<ul>
								<li><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan Simpan ke Excel</a></li>
							</ul>
							</li>';
						
                    }
                    if (Session::get('role') == KPPN) {
						echo '<li class="subnav"><a href=' . URL . 'UserSpan/monitoringUserSpan>Modul MU</a>';
						echo '<ul>
                                <li><a href=' . URL . 'UserSpan/monitoringUserSpan></i>Monitoring Pergantian User</a></li>
                            </ul>
                            </li>';
						
						echo '<li class="subnav"><a href=#>Modul SA</a>';
						echo '<ul>
                                <li><a href='  . URL . 'dataDIPA/nmsatker></i>Informasi Revisi DIPA</a></li>
                                <li><a href='  . URL . 'dataDIPA/nmsatker1></i>Sisa Pagu Belanja Realisasi dan Encumbrance</a></li>
                            </ul>
                            </li>';
						
						echo '<li class="subnav"><a href=#>Modul PM</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataSPM/posisiSPM></i>Monitoring Posisi Invoice</a></li>
                                <li><a href=' . URL . 'dataSPM/holdSPM></i>Hold Invoice</a></li>
                                <li><a href='. URL . 'dataSPM/validasiSPM></i>Daftar Penolakan PMRT</a></li>
								<li><a href='. URL . 'dataSPM/historySPM></i>Histori Invoice</a></li>
								<li><a href='. URL . 'dataSPM/durasiSPM></i>Durasi Penyelesaian SP2D</a></li>
								<li><a href='. URL . 'dataSPM/nmSatker></i>Daftar SP2D per Satker</a></li>
                            </ul>
							</li>';
						
						
						echo '<li class="subnav"><a href=#>Modul GR</a>';
						echo '<ul>
                                <li><a href='. URL .'dataGR/grStatusHarian></i>Monitoring Status LHP</a></li>
                                <li><a href='. URL .'dataGR/GR_IJP></i>Monitoring IJP</a></li>
								<li><a href='. URL .'dataGR/GR_PFK></i>Monitoring PFK</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/monitoringSp2d>BANK</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/monitoringSp2d></i>Cek status SP2D</a></li>
                                <li><a href=' . URL . 'dataRetur/monitoringRetur></i>Daftar SP2D Retur</a></li>
                                <li><a href=' . URL . 'dataKppn/harianBO></i>SP2D Harian ke BO1</a></li>
								<li><a href=' . URL . 'dataKppn/sp2dHariIni></i>SP2D terbit dan tertanggal di hari yang sama</a></li>
								<li><a href=' . URL . 'dataKppn/Sp2dBesok></i>SP2D terbit diatas jam 3 tertanggal hari yang sama</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dBackdate></i>SP2D Backdate</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dNilaiMinus></i>SP2D Minus dan 0</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSudahVoid></i>SP2D Void</a></li>
								<li><a href=' . URL . 'dataKppn/Sp2dRekap></i>Rekap penerbitan SP2D</a></li>
                            </ul>
                            </li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/Sp2dGajiDobel>Cek Gaji</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/Sp2dGajiDobel></i>Terindikasi dobel</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahTanggal></i>Terindikasi salah Tanggal</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahBank></i>Terindikasi salah Bank</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dSalahRekening></i>Terindikasi salah PayGroup</a></li>
                                <li><a href=' . URL . 'dataKppn/Sp2dCompareGaji></i>Perbandingan Gaji per Bulan</a></li>
                            </ul>
                            </li>';
						echo '<li class="nav"><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan</a>';
						echo '<ul>
								<li><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan Simpan ke Excel</a></li>
							</ul>
							</li>';
						
                    }
                    if (Session::get('role') == SATKER) {
						echo '<li class="subnav"><a href=#>Modul SA</a>';
						echo '<ul>
                                <li><a href='  . URL . 'dataDIPA/RevisiDipa/'.Session::get('kd_satker').'></i>Informasi DIPA</a></li>
                                <li><a href='  . URL . 'dataDIPA/RealisasiFA/'.Session::get('kd_satker').'></i>Sisa Pagu</a></li>
                            </ul>
                            </li>';echo '<li class="subnav"><a href=#>Modul PM</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataSPM/posisiSPM></i>Monitoring Posisi Invoice</a></li>
                                <li><a href=' . URL . 'dataSPM/holdSPM></i>Hold Invoice</a></li>
                                <li><a href='. URL . 'dataSPM/validasiSPM></i>Daftar Penolakan PMRT</a></li>
                                <li><a href='. URL . 'dataSPM/daftarsp2d/'.Session::get('kd_satker').'></i>Daftar SP2D</a></li>
                            </ul>
							</li>';
						echo '<li class="subnav"><a href=' . URL . 'dataKppn/monitoringSp2d>BANK</a>';
						echo '<ul>
                                <li><a href=' . URL . 'dataKppn/monitoringSp2d></i>Cek status SP2D</a></li>
                                <li><a href=' . URL . 'dataRetur/monitoringRetur></i>Daftar SP2D Retur</a></li>
                            </ul>
                            </li>';
						echo '<li class="nav"><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan</a>';
						echo '<ul>
								<li><a href=' . URL . 'dataKppn/lihatPanduan1>Panduan Simpan ke Excel</a></li>
							</ul>
							</li>';
					}
                    ?>
                    <li>
                        <a href="<?php echo URL; ?>auth/logout"><i class="icon-off"></i></a>
                    </li>
                    <li class="nav" style="float: right;">
                        <h3 style="margin-top: 13px"><a style="color: rgba(0,121,185,1); "><?php echo Session::get('user') ?></a></h3>
                    </li>
                </ul>
            </div>




