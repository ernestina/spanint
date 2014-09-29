<!DOCTYPE HTML>
<html>

    <head>

        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?php echo URL; ?>public/monster-logo-small.ico"/>
        <link rel="icon" href="<?php echo URL; ?>public/monster-logo-small.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">

        <title>Online Monitoring SPAN - Beta Version 1.0</title>

        <!-- JQuery & Jquery Plugins -->
        <script src="<?php echo URL; ?>public/JQuery/jquery-2.1.1.min.js"></script>
        <script src="<?php echo URL; ?>public/JQuery/plugins/jquery.nanoscroller.min.js"></script>
        <link href="<?php echo URL; ?>public/JQuery/plugins/nanoscroller.css" rel="stylesheet">

        <!-- Bootstrap CSS & JS -->
        <script src="<?php echo URL; ?>public/Bootstrap/js/bootstrap.min.js"></script>
        <link href="<?php echo URL; ?>public/Bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Bootstrap Datepicker CSS & JS -->
        <script src="<?php echo URL; ?>public/Bootstrap/plugins/bootstrap-datepicker.js"></script>
        <script src="<?php echo URL; ?>public/Bootstrap/plugins/bootstrap-datepicker.id.js"></script>
        <link href="<?php echo URL; ?>public/Bootstrap/plugins/datepicker3.css" rel="stylesheet">

        <!-- ChartJS -->
        <script src="<?php echo URL; ?>public/ChartJS/Chart.min.js"></script>

        <!-- Application CSS -->
        <link href="<?php echo URL; ?>public/monster.css" rel="stylesheet">

    </head>

    <body>

        <!-- Sidebar -->
        <div id="sidebar" class="nano">

            <div class="nano-content">
                <!--//////////////////////////////////////// --> 
                <!--/////////////// Header ADMIN /////////// -->  
                <!--//////////////////////////////////////// --> 

                <?php if (Session::get('role') == ADMIN): ?>

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP - Hari Ini</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/mingguan">SP2D &amp; LHP - 7 Hari</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/bulanan">SP2D &amp; LHP - 30 Hari</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Modul Manajemen User</h4>
                            <div class="collapse"> <!-- Class 'collapse' memberitahu bootstrap bahwa item ini disembunyikan dan bisa di-expand (lihat dokumentasi Bootstrap) -->
                                <ul>
                                    <li><a href="<?php echo URL; ?>userSpan/monitoringUserSpan">Monitoring Pergantian User</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi">Informasi Proses Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Data Pagu Minus</a></li>
                                    <!--<li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Realisasi Belanja per BA</a></li>-->
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiTransfer">Realisasi Belanja Transfer Daerah</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Modul Komitmen</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSupplier/cekSupplier">Cek Data Supplier</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Modul Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSPM/PosisiSPM">Monitoring Posisi Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HoldSPM">Hold Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/ValidasiSpm">Daftar Penolakan PMRT</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HistorySpm">Histori Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/DurasiSpm">Durasi Penyelesaian SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/nmsatker">Daftar SP2D per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarian">Monitoring Status LHP</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_IJP">Monitoring IJP</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_PFK">Monitoring PFK</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendSatkerPenerimaan">Suspend Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendAkunPenerimaan">Suspend Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/NTPNGanda">NTPN Ganda</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDroping/monitoringDroping">Droping Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Pelimpahan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Cek Status SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Daftar SP2D Retur</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringReturPkn">Monitoring Penyelesaian Retur</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBesok">SP2D Terbit di Atas Jam 3 Tertanggal Hari Ini</a></li>
                                    <!--<li><a href="<?php echo URL; ?>dataKppn/harianBO">Laporan SP2D Harian ke Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dHariIni">Laporan SP2D Terbit dan Tertanggal di Hari yang Sama</a></li>-->
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBackdate">SP2D Backdate</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dNilaiMinus">SP2D Minus dan 0</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSudahVoid">SP2D Void</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dRekap">Rekap SP2D BO Pusat</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;Gaji</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dGajiDobel">Terindikasi Dobel</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahTanggal">Terindikasi Salah Tanggal</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahBank">Terindikasi Salah Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahRekening">Terindikasi Salah PayGroup</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dCompareGaji">Perbandingan Gaji per Bulan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-download"></span>&nbsp;&nbsp;Pelaporan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/LAK">Unduh LAK KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/LRA">Unduh LRA KPPN</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    <li><a href="<?php echo URL; ?>panduan/PanduanUAT">Dokumen UAT</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>




                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header KANWIL /////////// -->  
                    <!--//////////////////////////////////////// --> 

                <?php elseif (Session::get('role') == KANWIL): ?>

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP - Hari Ini</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/mingguan">SP2D &amp; LHP - 7 Hari</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/bulanan">SP2D &amp; LHP - 30 Hari</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Modul Manajemen User</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>userSpan/monitoringUserSpan">Monitoring Pergantian User</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi">Informasi Proses Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Data Pagu Minus</a></li>
                                    <!--<li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Realisasi Belanja per BA</a></li>-->
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiTransfer">Realisasi Belanja Transfer Daerah</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Modul Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSPM/PosisiSPM">Monitoring Posisi Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HoldSPM">Hold Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/ValidasiSpm">Daftar Penolakan PMRT</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HistorySpm">Histori Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/DurasiSpm">Durasi Penyelesaian SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/nmsatker">Daftar SP2D per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarian">Monitoring Status LHP</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_IJP">Monitoring IJP</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_PFK">Monitoring PFK</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendSatkerPenerimaan">Suspend Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendAkunPenerimaan">Suspend Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/NTPNGanda">NTPN Ganda</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Pelimpahan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Cek Status SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Daftar SP2D Retur</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBesok">SP2D Terbit di Atas Jam 3 Tertanggal Hari Ini</a></li>
                                    <!--<li><a href="<?php echo URL; ?>dataKppn/harianBO">Laporan SP2D Harian ke Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dHariIni">Laporan SP2D Terbit dan Tertanggal di Hari yang Sama</a></li>-->
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBackdate">SP2D Backdate</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dNilaiMinus">SP2D Minus dan 0</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSudahVoid">SP2D Void</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dRekap">Rekap SP2D BO Pusat</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;Gaji</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dGajiDobel">Terindikasi Dobel</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahTanggal">Terindikasi Salah Tanggal</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahBank">Terindikasi Salah Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahRekening">Terindikasi Salah PayGroup</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dCompareGaji">Perbandingan Gaji per Bulan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-download"></span>&nbsp;&nbsp;Pelaporan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/LAK">Unduh LAK KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/LRA">Unduh LRA KPPN</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    <li><a href="<?php echo URL; ?>panduan/PanduanUAT">Dokumen UAT</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header KPPN /////////// -->  
                    <!--//////////////////////////////////////// --> 

                <?php elseif (Session::get('role') == KPPN): ?>

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>


                        <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP - Hari Ini</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/mingguan">SP2D &amp; LHP - 7 Hari</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/bulanan">SP2D &amp; LHP - 30 Hari</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Modul Manajemen User</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>userSpan/monitoringUserSpan">Monitoring Pergantian User</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi">Informasi Proses Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Data Pagu Minus</a></li>
                                    <!--<li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Realisasi Belanja per BA</a></li>-->
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiTransfer">Realisasi Belanja Transfer Daerah</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Modul Komitmen</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSupplier/downloadSupplierXls">Download Supplier</a></li>
                                    <li><a href="<?php echo URL; ?>dataSupplier/cekSupplier">Cek Data Supplier</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Modul Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSPM/PosisiSPM">Monitoring Posisi Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HoldSPM">Hold Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/ValidasiSpm">Daftar Penolakan PMRT</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HistorySpm">Histori Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/DurasiSpm">Durasi Penyelesaian SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/nmsatker">Daftar SP2D per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataPNBP/KarwasPNBP">Karwas Maksimum Pencairan (PNBP)</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarian">Monitoring Status LHP</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_IJP">Monitoring IJP</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_PFK">Monitoring PFK</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/KonfirmasiPenerimaan">Konfirmasi Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendSatkerPenerimaan">Suspend Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendAkunPenerimaan">Suspend Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/NTPNGanda">NTPN Ganda</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Pelimpahan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Cek Status SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Daftar SP2D Retur</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBesok">SP2D Terbit di Atas Jam 3 Tertanggal Hari Ini</a></li>
                                    <!--<li><a href="<?php echo URL; ?>dataKppn/harianBO">Laporan SP2D Harian ke Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dHariIni">Laporan SP2D Terbit dan Tertanggal di Hari yang Sama</a></li>-->
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBackdate">SP2D Backdate</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dNilaiMinus">SP2D Minus dan 0</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSudahVoid">SP2D Void</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dRekap">Rekap SP2D BO Pusat</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;Gaji</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dGajiDobel">Terindikasi Dobel</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahTanggal">Terindikasi Salah Tanggal</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahBank">Terindikasi Salah Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dSalahRekening">Terindikasi Salah PayGroup</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dCompareGaji">Perbandingan Gaji per Bulan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-play-circle"></span>&nbsp;&nbsp;TV</h4>
                            <div class="collapse"> <!-- Class 'collapse' memberitahu bootstrap bahwa item ini disembunyikan dan bisa di-expand (lihat dokumentasi Bootstrap) -->
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/ticker/spm-sp2d" target="_blank">TV: Status SP2D</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-download"></span>&nbsp;&nbsp;Pelaporan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/LAK">Unduh LAK KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/LRA">Unduh LRA KPPN</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    <li><a href="<?php echo URL; ?>panduan/PanduanUAT">Dokumen UAT</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>

                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header SATKER /////////// -->  
                    <!--//////////////////////////////////////// --> 

                <?php elseif (Session::get('role') == SATKER): ?>

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RevisiDipa/<?php Session::get('kd_satker'); ?>"></i>Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi/<?php Session::get('kd_satker'); ?>"></i>Informasi Proses Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1/<?php Session::get('kd_satker'); ?>"></i>Sisa Pagu</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail/<?php Session::get('kd_satker'); ?>"></i>Data Pagu Minus</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Modul Supplier</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSupplier/cekSupplier">Cek Data Supplier</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Modul Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSPM/PosisiSPM">Monitoring Posisi Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HoldSPM">Hold Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/ValidasiSpm">Daftar Penolakan PMRT</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/daftarsp2d/<?php Session::get('kd_satker'); ?>">Daftar SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                </ul>
                            </div>
                        </li>


                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/KonfirmasiPenerimaan">Konfirmasi Penerimaan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Modul Supplier</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSupplier/cekSupplier">Cek Supplier</a></li>
                                </ul>
                            </div>
                        </li>


                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Cek Status SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Daftar SP2D Retur</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    <li><a href="<?php echo URL; ?>panduan/PanduanUAT">Dokumen UAT</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>

                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header PKN /////////// -->  
                    <!--//////////////////////////////////////// --> 

                <?php elseif (Session::get('role') == PKN): ?>

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDroping/monitoringDroping">Droping Dana</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Cek Status SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringReturPkn">Monitoring Penyelesaian Retur</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Daftar SP2D Retur</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    <li><a href="<?php echo URL; ?>panduan/PanduanUAT">Dokumen UAT</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>

                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header DJA /////////// -->  
                    <!--//////////////////////////////////////// --> 

                <?php elseif (Session::get('role') == DJA): ?>

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Data Pagu Minus</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Detail_Fund_fail">Data Pagu Minus Seluruh Satker</a></li>
                                    <!--<li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Realisasi Belanja per BA</a></li>-->
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    <li><a href="<?php echo URL; ?>panduan/PanduanUAT">Dokumen UAT</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>

                <?php endif; ?>

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
                    <a id="monster-logo-regular" class="navbar-brand navbar-left hidden-xs" href="<?php echo URL; ?>"><img src="<?php echo URL; ?>public/monster-logo-small.png">&nbsp;Online Monitoring - Beta Version 1.0</a>

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