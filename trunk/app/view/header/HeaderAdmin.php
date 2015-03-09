<ul>
    <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>
    <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>dashboard/overviewAdmin">Overview</a></li>
                <li><a href="<?php echo URL; ?>home/dashboard/harian">SP2D &amp; LHP</a></li>
                <li><a href="<?php echo URL; ?>home/dashboardPenerbitan">Penerbitan SP2D</a></li>
            </ul>
        </div>
    </li>

    <li class="subnav"><h4><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Modul Manajemen User</h4>
        <div class="collapse">
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
                <li><a href="<?php echo URL; ?>panduan/petunjukManual">Petunjuk Manual</a></li>
            </ul>
        </div>
    </li>
</ul>