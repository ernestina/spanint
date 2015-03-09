<ul>
    <li class="nav"><h4><a href="<?php echo URL; ?>home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Beranda</a></h4></li>
    <li class="subnav"><h4><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Dashboard</h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>dashboard/overviewSatker">Overview</a></li>
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

    <li class="subnav"><h4><span class="glyphicon glyphicon-gbp"></span>&nbsp;&nbsp;Data Ketersediaan Dana  <br><i>(Fund Available)</i></h4>
        <div class="collapse">
            <ul>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiKegiatanBA">Per Kegiatan</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataRealisasiOutputBA">Per Output</a></li>                      
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerJenbel">Per Jenis Belanja</a></li>
                <li><a href="<?php echo URL; ?>BA_ES1/DataFaBaPerSdana">Per Sumber Dana</a></li>
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
</ul>