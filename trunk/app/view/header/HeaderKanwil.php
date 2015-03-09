<ul>
    <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>
    <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>dashboard/overviewKanwil/1">Overview</a></li>
                <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP</a></li>
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

    <li class="subnav"><h4><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Informasi DIPA</h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>dataDIPA/nmsatker">Informasi Revisi DIPA</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/ProsesRevisi">Daftar DIPA dalam Proses Revisi</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/Fund_fail">Penolakan Revisi Karena Menyebabkan Pagu Minus</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus_51">Monitoring Pagu Minus Belanja Pegawai</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/RealisasiFA_1_minus">Monitoring Pagu Minus Non Belanja Pegawai</a></li>
            </ul>
        </div>
    </li>
                        
    <li class="subnav"><h4><span class="glyphicon glyphicon-gbp"></span>&nbsp;&nbsp;Data Ketersediaan Dana <br> <i>Fund Available</i></h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaPerBA">Per Bagian Anggaran </a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaSatEs1">Per Satker </a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiOutputBA">Per Output</a></li>-->
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerJenbel">Per Jenis Belanja</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerSdana">Per Sumber Dana</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaEs1SatJenbel">Per Satker - Jenis Belanja</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaEs1SatSdana">Per Satker - Sumber Dana</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/nmsatker1">Per Akun</a></li>
            </ul>
        </div>
    </li>
                    
    <li class="subnav"><h4><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Data Realisasi Belanja</h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasi">Pagu dan Realisasi Belanja per Satker</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiBA">Pagu dan Realisasi Belanja per BA</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiKegiatan">Pagu dan Realisasi Belanja per Program-Kegiatan</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKewenanganBAES1">Pagu dan Realisasi Belanja per Jenis Kewenangan</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiSumberDanaBAES1">Pagu dan Realisasi Belanja per Sumber Dana</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiWilayahBAES1">Pagu dan Realisasi Belanja per Wilayah</a></li>
                <li><a href="<?php echo URL; ?>dataDIPA/DataRealisasiTransfer">Realisasi Belanja Transfer Daerah</a></li>
            </ul>
        </div>
    </li>

    <li class="subnav"><h4><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Data Realisasi Penerimaan</h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanBA">Realisasi Pendapatan Per Akun</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiPenerimaanPerSatkerES1">Realisasi Pendapatan Per Satker</a></li>
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
                <li><a href="<?php echo URL; ?>dataPelimpahan/monitoringPelimpahan"></i>Monitoring Pelimpahan</a></li>
                <li><a href="<?php echo URL; ?>dataGR/grStatusHarianBulan">Monitoring Status LHP per Bulan</a></li>
                <li><a href="<?php echo URL; ?>dataGR/GR_IJP">Monitoring Imbalan Jasa Perbankan</a></li>
                <li><a href="<?php echo URL; ?>dataGR/GR_PFK">Monitoring Perhitungan Fihak Ketiga</a></li>
                <li><a href="<?php echo URL; ?>dataGR/SuspendSatkerPenerimaan">Suspend Satker Penerimaan</a></li>
                <li><a href="<?php echo URL; ?>dataGR/SuspendAkunPenerimaan">Suspend Akun Penerimaan</a></li>
                <li><a href="<?php echo URL; ?>dataGR/NTPNGanda">Daftar NTPN Terindikasi Ganda</a></li>
            </ul>
        </div>
    </li>

    <li class="subnav"><h4><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Bank</h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>dataKppn/monitoringSp2d">Monitoring SP2D - Bank</a></li>
                <li><a href="<?php echo URL; ?>dataRetur/monitoringRetur">Monitoring Retur SP2D</a></li>
                <li><a href="<?php echo URL; ?>dataKppn/sp2dBesok">SP2D Terbit di Atas Jam 3 Tertanggal Hari yang Sama</a></li>
                <li><a href="<?php echo URL; ?>dataKppn/sp2dBackdate">SP2D Backdate</a></li>
                <li><a href="<?php echo URL; ?>dataKppn/sp2dNilaiMinus">SP2D Minus dan 0</a></li>
                <li><a href="<?php echo URL; ?>dataKppn/sp2dSudahVoid">SP2D Void</a></li>
                <li><a href="<?php echo URL; ?>dataKppn/sp2dRekap">Rekap SP2D BO Pusat</a></li>
            </ul>
        </div>
    </li>

    <li class="subnav"><h4><span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;Monitoring SP2D Gaji</h4>
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
                <li><a href="<?php echo URL; ?>panduan/petunjukManual">Petunjuk Manual</a></li>
            </ul>
        </div>
    </li>
</ul>