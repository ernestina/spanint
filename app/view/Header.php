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


                <?php if (Session::get('kd_satker') == andi) { ?>

                    <ul>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboardPenerbitan">Penerbitan SP2D</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                <?php } ?>

                <?php if (Session::get('role') == ADMIN): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header ADMIN /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>
                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboardPenerbitan">Penerbitan SP2D</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Modul Manajemen User</h4>
                            <div class="collapse"> <!-- Class 'collapse' memberitahu bootstrap bahwa item ini disembunyikan dan bisa di-expand (lihat dokumentasi Bootstrap) -->
                                <ul>
                                    <li><a href="<?php echo URL; ?>userSpan/monitoringUserSpan">Monitoring User Aktif</a></li>
                                    <li><a href="<?php echo URL; ?>userSpan/pergantianUser">Monitoring Pergantian User</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi">Daftar DIPA dalam Proses Revisi</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Penolakan Revisi Karena Menyebabkan Pagu Minus</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus_51">Monitoring Pagu Minus Belanja Pegawai</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus">Monitoring Pagu Minus Non Belanja Pegawai</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Pagu dan Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Pagu dan Realisasi Belanja per BA</a></li>
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
                                    <li><a href="<?php echo URL; ?>dataSPM/Konversi">Daftar Invoice Hasil Konversi Yang Belum Di Proses di SPAN</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/PosisiSPM">Monitoring Posisi Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HoldSPM">Hold Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/ValidasiSpm">Daftar Penolakan PMRT</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HistorySpm">Histori Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/DurasiSpm">Durasi Penyelesaian SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/nmsatker">Daftar SP2D per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/KarwasUPSatker">Karwas UP</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/KarwasTUPSatker">Karwas TUP</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarian">Monitoring Status LHP per KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarianBulan">Monitoring Status LHP per Bulan</a></li>
                                    <li><a href="<?php echo URL; ?>dataMpnBi/MpnBi">Monitoring Rekap Penerimaan yang sudah Diinterface</a></li>
                                    <li><a href="<?php echo URL; ?>dataBPN/dataBPN">Monitoring Potongan SPM (Satker Pembayar)</a></li>
                                    <li><a href="<?php echo URL; ?>dataBPN/dataBPNSatker">Monitoring Potongan SPM (Satker Penerima)</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_IJP">Monitoring Imbalan Jasa Perbankan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_PFK">Monitoring Perhitungan Fihak Ketiga</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendSatkerPenerimaan">Suspend Satker Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendAkunPenerimaan">Suspend Akun Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/NTPNGanda">Daftar NTPN Terindikasi Ganda</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDroping/monitoringDroping">Penyaluran dan Droping Dana SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Monitoring Pelimpahan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Monitoring SP2D - Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Monitoring Retur SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringReturPkn">Monitoring Penyelesaian Retur - PKN</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBesok">SP2D Terbit di Atas Jam 3 Tertanggal Hari yang Sama</a></li>
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

                        <li class="subnav"><h4><span class="glyphicon glyphicon-download"></span>&nbsp;&nbsp;Unduh Pelaporan SPAN</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00258">Laporan Arus Kas Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00264">Laporan Realisasi Anggaran Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPCMR00051">Laporan Konsolidasi Saldo Kas KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/listLaporanPKN/BukuMerah">Laporan Buku Merah</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/listLaporanPKN/BukuBiru">Laporan Buku Biru</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/listLaporanSingle/SPCMR00005">Laporan Ikhtisar Kebutuhan Dana Harian</a>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/registerDJPU">Register DJPU</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <!--li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li-->
                                    <li><a href="<?php echo URL; ?>panduan/petunjukManual">Petunjuk Manual</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>




                <?php elseif (Session::get('role') == KANWIL): ?>



                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header KANWIL /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboardPenerbitan">Penerbitan SP2D</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Modul Manajemen User</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>userSpan/monitoringUserSpan">Monitoring User Aktif</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi">Daftar DIPA dalam Proses Revisi</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Penolakan Revisi Karena Menyebabkan Pagu Minus</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus_51">Monitoring Pagu Minus Belanja Pegawai</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus">Monitoring Pagu Minus Non Belanja Pegawai</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Pagu dan Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Pagu dan Realisasi Belanja per BA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiTransfer">Realisasi Belanja Transfer Daerah</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Modul Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSPM/Konversi">Daftar Invoice Hasil Konversi Yang Belum Di Proses di SPAN</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/PosisiSPM">Monitoring Posisi Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HoldSPM">Hold Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/ValidasiSpm">Daftar Penolakan PMRT</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HistorySpm">Histori Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/DurasiSpm">Durasi Penyelesaian SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/nmsatker">Daftar SP2D per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/KarwasUPSatker">Karwas UP</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/KarwasTUPSatker">Karwas TUP</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul><li><a href="<?php echo URL; ?>dataGR/grStatusHarian">Monitoring Status LHP per KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarianBulan">Monitoring Status LHP per Bulan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_IJP">Monitoring Imbalan Jasa Perbankan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_PFK">Monitoring Perhitungan Fihak Ketiga</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendSatkerPenerimaan">Suspend Satker Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendAkunPenerimaan">Suspend Akun Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/NTPNGanda">Daftar NTPN Terindikasi Ganda</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Monitoring Pelimpahan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Monitoring SP2D - Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Monitoring Retur SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBesok">SP2D Terbit di Atas Jam 3 Tertanggal Hari yang Sama</a></li>
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

                        <li class="subnav"><h4><span class="glyphicon glyphicon-download"></span>&nbsp;&nbsp;Unduh Pelaporan SPAN</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00258">Laporan Arus Kas Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00264">Laporan Realisasi Anggaran Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPCMR00051">Laporan Konsolidasi Saldo Kas KPPN</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/registerDJPU">Register DJPU</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <!--li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li-->
                                    <li><a href="<?php echo URL; ?>panduan/petunjukManual">Petunjuk Manual</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>



                <?php elseif (Session::get('role') == KPPN): ?>

                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header KPPN /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                                <!--<li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>
                                
                                <li class="subnav"><h4><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Persiapan Rollout</h4>
                                    <div class="collapse">
                                        <ul>
                                            <li><a href="<?php echo URL; ?>dataPersiapanRollout/downloadPagu">Download Data Pagu</a></li>
                                            <li><a href="<?php echo URL; ?>dataPersiapanRollout/downloadRealisasi">Download Data Realisasi</a></li>
                                            <li><a href="<?php echo URL; ?>dataPersiapanRollout/downloadToolRekonsiliasi">Download Aplikasi Rekonsiliasi</a></li>
                                        </ul>
                                    </div>
                                </li>-->

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
                                    <li><a href="<?php echo URL; ?>userSpan/monitoringUserSpan">Monitoring User Aktif</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi">Daftar DIPA dalam Proses Revisi</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Penolakan Revisi Karena Menyebabkan Pagu Minus</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus_51">Monitoring Pagu Minus Belanja Pegawai</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus">Monitoring Pagu Minus Non Belanja Pegawai</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Pagu dan Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Pagu dan Realisasi Belanja per BA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiTransfer">Realisasi Belanja Transfer Daerah</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Modul Komitmen</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSupplier/downloadSupplierXls">Download Supplier</a></li>
                                    <li><a href="<?php echo URL; ?>dataSupplier/cekSupplier">Cek Data Supplier</a></li> 
                                    <li><a href="<?php echo URL; ?>dataSupplier/downloadToolCekSupplier">Download Aplikasi Cek Supplier</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Modul Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataSPM/Konversi">Daftar Invoice Hasil Konversi Yang Belum Di Proses di SPAN</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/PosisiSPM">Monitoring Posisi Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HoldSPM">Hold Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/ValidasiSpm">Daftar Penolakan PMRT</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/HistorySpm">Histori Invoice</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/DurasiSpm">Durasi Penyelesaian SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/nmsatker">Daftar SP2D per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataPNBP/KarwasPNBP">Karwas Maksimum Pencairan (PNBP)</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/KarwasUPSatker">Karwas UP</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/KarwasTUPSatker">Karwas TUP</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarian">Monitoring Status LHP</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_IJP">Monitoring Imbalan Jasa Perbankan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/GR_PFK">Monitoring Perhitungan Fihak Ketiga</a></li>
                                    <li><a href="<?php echo URL; ?>dataMpnBi/MpnBi">Monitoring Rekap Penerimaan yang sudah Diinterface</a></li>
                                    <li><a href="<?php echo URL; ?>dataBPN/dataBPN">Monitoring Potongan SPM (Satker Pembayar)</a></li>
                                    <li><a href="<?php echo URL; ?>dataBPN/dataBPNSatker">Monitoring Potongan SPM (Satker Penerima)</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/KonfirmasiPenerimaan">Konfirmasi Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendSatkerPenerimaan">Suspend Satker Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/SuspendAkunPenerimaan">Suspend Akun Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataGR/NTPNGanda">Daftar NTPN Terindikasi Ganda</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Monitoring Pelimpahan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Monitoring SP2D - Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Monitoring Retur SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataKppn/sp2dBesok">SP2D Terbit di Atas Jam 3 Tertanggal Hari yang Sama</a></li>
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

                        <li class="subnav"><h4><span class="glyphicon glyphicon-download"></span>&nbsp;&nbsp;Unduh Pelaporan SPAN</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00258">Laporan Arus Kas Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00264">Laporan Realisasi Anggaran Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPCMR00051">Laporan Konsolidasi Saldo Kas KPPN</a></li>

                                </ul>
                            </div>
                        </li>
                        
                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/registerDJPU">Register DJPU</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                            <div class="collapse">
                                <ul>
                                    <!--li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li-->
                                    <li><a href="<?php echo URL; ?>panduan/petunjukManual">Petunjuk Manual</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>


                <?php elseif (Session::get('role') == SATKER): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header SATKER /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>home/dashboard/mingguan">SP2D - 7 Hari</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/bulanan">SP2D - 30 Hari</a></li>
                                    <li><a href="<?php echo URL; ?>home/dashboard/triwulanan">SP2D - 90 Hari</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RevisiDipa/<?php Session::get('kd_satker'); ?>"></i>Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi/<?php Session::get('kd_satker'); ?>"></i>Daftar DIPA dalam Proses Revisi</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1/<?php Session::get('kd_satker'); ?>"></i>Sisa Pagu</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail/<?php Session::get('kd_satker'); ?>"></i>Penolakan Revisi Karena Menyebabkan Pagu Minus</a></li>
									<li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Pagu dan Realisasi Belanja</a></li>
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
                                    <li><a href="<?php echo URL; ?>dataSPM/daftarsp2d/<?php Session::get('kd_satker'); ?>">Daftar SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataSPM/RekapSp2d">Rekap Penerbitan SP2D</a></li>
                                </ul>
                            </div>
                        </li>


                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/KonfirmasiPenerimaan">Konfirmasi Penerimaan</a></li>
                                    <li><a href="<?php echo URL; ?>dataBPN/dataBPN">Monitoring Potongan SPM (Satker Pembayar)</a></li>
                                    <li><a href="<?php echo URL; ?>dataBPN/dataBPNSatker">Monitoring Potongan SPM (Satker Penerima)</a></li>
									<li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanBA">Realisasi Pendapatan Per Akun</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Monitoring SP2D - Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Monitoring Retur SP2D</a></li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>

                            <!--li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                                <div class="collapse">
                                    <ul>
                                        <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                        <li><a href="<?php echo URL; ?>panduan/PanduanUAT">Dokumen UAT</a></li>
                                    </ul>
                                </div>
                            </li-->

                    </ul>


                <?php elseif (Session::get('role') == PKN): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header PKN /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDroping/monitoringDroping">Penyaluran dan Droping Dana SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Monitoring Pelimpahan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Modul Penerimaan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataGR/grStatusHarianBulan">Monitoring Status LHP per Bulan</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Monitoring SP2D - Bank</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringReturPkn">Monitoring Penyelesaian Retur - PKN</a></li>
                                    <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Monitoring Retur SP2D</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-download"></span>&nbsp;&nbsp;Unduh Pelaporan SPAN</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00258">Laporan Arus Kas Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPGLR00264">Laporan Realisasi Anggaran Tingkat KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/downloadLaporanKPPN/SPCMR00051">Laporan Konsolidasi Saldo Kas KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/listLaporanPKN/BukuMerah">Laporan Buku Merah</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/listLaporanPKN/BukuBiru">Laporan Buku Biru</a></li>
                                    <li><a href="<?php echo URL; ?>pelaporan/listLaporanSingle/SPCMR00005">Laporan Ikhtisar Kebutuhan Dana Harian</a>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>
                            <!--li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                                <div class="collapse">
                                    <ul>
                                        <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    </ul>
                                </div>
                            </li-->

                    </ul>


                <?php elseif (Session::get('role') == BLU): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header BLU /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;SP3B BLU</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataBLU/KarwasBLU">Monitoring SP3B BLU Tahunan</a></li>
                                    <li><a href="<?php echo URL; ?>dataBLU/CariSP3B">Cari SP3B BLU</a></li>		
                                </ul>
                            </div>
                        </li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;DATA REALISASI BLU</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataBLU/DataRealisasiBLU">Realisasi Belanja Per Ssatker BLU</a></li>
                                    <li><a href="<?php echo URL; ?>dataBLU/DataRealisasiBelanjaBLU">Realisasi Belanja 525 Per Ssatker BLU</a></li>		
                                </ul>
                            </div>
                        </li>
                        
                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/registerDJPU">Register DJPU</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>
                            <!--li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                                <div class="collapse">
                                    <ul>
                                        <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    </ul>
                                </div>
                            </li-->

                    </ul>


                <?php elseif (Session::get('role') == DJA): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header DJA /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Modul Penganggaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Sisa Pagu Belanja Realisasi dan Pencadangan</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Penolakan Revisi Karena Menyebabkan Pagu Minus</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/Detail_Fund_fail">Penolakan Revisi Karena Menyebabkan Pagu Minus Seluruh Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Pagu dan Realisasi Belanja per Satker</a></li>
                                    <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Pagu dan Realisasi Belanja per BA</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/registerDJPU">Register DJPU</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>

                            <!--li class="subnav"><h4><span class="glyphicon glyphicon-question-sign"></span>&nbsp;&nbsp;Panduan</h4>
                                <div class="collapse">
                                    <ul>
                                        <li><a href="<?php echo URL; ?>panduan/lihatPanduan1">Panduan Simpan ke Excel</a></li>
                                    </ul>
                                </div>
                            </li-->

                    </ul>


                <?php elseif (Session::get('role') == BANK): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header BANK /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Modul Kas</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataDroping/monitoringDroping">Penyaluran dan Droping Dana SP2D</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>

                <?php elseif (Session::get('role') == KL): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header KL /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Informasi DIPA</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/nmsatker">Informasi DIPA Satker</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/ProsesRevisi">Informasi DIPA Dalam Proses Revisi</a></li>

                                </ul>
                            </div>
                        </li>


                        <li class="subnav"><h4><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Data Realisasi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiAkunBA">Eselon 1 Per Jenis Belanja</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiAkunES1">Satker Per Jenis Belanja</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKegiatanBAES1">Kegiatan per Jenis Belanja </a></li>
									
									<li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKewenanganBAES1">Kewenangan per Jenis Belanja </a></li>


                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiSumberDanaBAES1">Sumber Dana per Jenis Belanja</a></li>


                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiWilayahBAES1">Wilayah per Jenis Belanja</a></li>

                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-gbp"></span>&nbsp;&nbsp;Data Ketersediaan Dana  <br><i>(Fund Available)</i></h4>
                            <div class="collapse">
                                <ul>

                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerEs1">Per Eselon 1</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaSatEs1">Per Satker </a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKegiatanBA">Per Kegiatan</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiOutputBA">Per Output</a></li>                                   
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerJenbel">Per Jenis Belanja</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerSdana">Per Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaEs1Jenbel">Per Eselon 1 - Jenis Belanja</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaEs1Sdana">Per Eselon 1 - Sumber Dana</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Informasi Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/RekapSp2dBAES1">Rekap SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/nmsatkerBAES1">Daftar SP2D Per satker</a></li>
									<li><a href="<?php echo URL; ?>BA_ES1/DataUPBAES1">Informasi Uang Persediaan Satker</a></li>
									<li><a href="<?php echo URL; ?>BA_ES1/KarwasTUPBaes1">Informasi Tambahan Uang Persediaan Satker</a></li>									
                                </ul>
                            </div>
                        </li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Informasi Pendapatan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanBA">Realisasi Pendapatan Per Akun</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanPerES1">Realisasi Pendapatan Per Eselon 1</a></li>
									<li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanPerSatkerES1">Realisasi Pendapatan Per Satker</a></li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>
                    </ul>

                <?php elseif (Session::get('role') == ES1): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header ES1 /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Informasi DIPA</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/nmsatker">Informasi DIPA Satker</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/ProsesRevisi">Informasi DIPA Dalam Proses Revisi</a></li>

                                </ul>
                            </div>
                        </li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Data Realisasi</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiAkunES1">Satker Per Jenis Belanja</a></li>
									<li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKegiatanBAES1">Kegiatan per Jenis Belanja </a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKewenanganBAES1"> Kewenangan Per Jenis Belanja</a></li>


                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiSumberDanaBAES1">Sumber Dana  Per Jenis Belanja</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiWilayahBAES1">Wilayah Per Jenis Belanja</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-gbp"></span>&nbsp;&nbsp;Data Ketersediaan Dana <br> <i>Fund Available</i></h4>
                            <div class="collapse">
                                <ul>

                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaEs1PerSat">Per Satker </a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKegiatanES1">Per Kegiatan</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiOutputES1">Per Output</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerJenbel">Per Jenis Belanja</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerSdana">Per Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaEs1SatJenbel">Per Satker - Jenis Belanja</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataFaEs1SatSdana">Per Satker - Sumber Dana</a></li>

                                </ul>
                            </div>
                        </li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Informasi Pembayaran</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/RekapSp2dBAES1">Rekap SP2D</a></li>
                                    <li><a href="<?php echo URL; ?>BA_ES1/nmsatkerBAES1">Daftar SP2D Per satker</a></li>   
									<li><a href="<?php echo URL; ?>BA_ES1/DataUPBAES1">Informasi Uang Persediaan Satker</a></li>
									<li><a href="<?php echo URL; ?>BA_ES1/KarwasTUPBaes1">Informasi Tambahan Uang Persediaan Satker</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Informasi Pendapatan</h4>
                            <div class="collapse">
                                <ul>
                                    <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanBA">Realisasi Pendapatan</a></li>
									<li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanPerSatkerES1">Realisasi Pendapatan Per Satker</a></li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="subnav"><h4><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Referensi</h4>
                            <div class="collapse">
                                <ul>
                                        <li><a href="<?php echo URL; ?>dataPDR/refAkun">Akun</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refKppn">KPPN</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refSdana">Sumber Dana</a></li>
                                    <li><a href="<?php echo URL; ?>dataPDR/refLokasi">Lokasi</a></li>
                                     <li><a href="<?php echo URL; ?>dataPDR/refSatker">Satuan Kerja</a></li>

                                </ul>
                            </div>
                        </li>
                    </ul>

                <?php elseif (Session::get('role') == UMADMIN): ?>


                    <!--//////////////////////////////////////// --> 
                    <!--/////////////// Header UMADMIN /////////// -->  
                    <!--//////////////////////////////////////// --> 

                    <ul>

                        <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>
                        <li class="subnav"><h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Modul Manajemen User</h4>
                            <div class="collapse"> <!-- Class 'collapse' memberitahu bootstrap bahwa item ini disembunyikan dan bisa di-expand (lihat dokumentasi Bootstrap) -->
                                <ul>
                                    <li><a href="<?php echo URL; ?>userSpan/monitoringUserSpan">Monitoring User Aktif</a></li>
                                    <li><a href="<?php echo URL; ?>userSpan/pergantianUser">Monitoring Pergantian User</a></li>
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