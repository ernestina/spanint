<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataRetur/monitoringRetur -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2><?php echo $this->judul; ?></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

					if ($this->d_kd_kppn != 'SEMUA') {
						$kdkppn = $this->d_kd_kppn;
					} else {
						$kdkppn = 'null';
					}
					if (isset($this->judul)) {
						$kdjudul = $this->judul;
					}
					
                ?>                
                <a href="<?php echo URL; ?>PDF/DataSPMAkhirTahun_PDF/<?php echo $kdkppn . "/" . $kdjudul; ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-print"></span> PDF</a>
                <?php 
			//----------------------------------------------------
				?>  
			
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            </div>
        </div>
        <div class="row top-padded">
            
            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                } else {
                    echo "SEMUA KPPN";   
                }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12 align-right">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) : " . $last_update->get_last_update() . " WIB";
                        }
                    }
                //tampilan di bawah ini buat contoh aja, kalau udah ada datanya bisa dihapus
                    echo "Update Data Terakhir (Waktu Server) : 05-12-2014 09:01:12 WIB";
                ?>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Tabel -->
<div id="table-container" class="wrapper" width= 80% style="font-size: 75%">
    <table class="footable">
        <!--baris pertama-->
        <thead class="align-center">
            <tr>
                <th rowspan=3>No.</th>
                <th rowspan=3>Jenis Belanja</th>
                <th rowspan=2 colspan=2>S.D tgl 16 Desember 2014</th>
                <th colspan=6>Tgl 17 Desember 2014</th>
                <th colspan=6>Tgl 18 Desember 2014</th>
                <th colspan=6>Dan seterusnya s.d 30 Desember 2014</th>
                
            </tr>
            <tr>
                <th colspan=2>Diterima</th>
                <th colspan=2>SP2D Terbit</th>
                <th colspan=2>Dalam Proses</th>
                <th colspan=2>Diterima</th>
                <th colspan=2>SP2D Terbit</th>
                <th colspan=2>Dalam Proses</th>
                <th colspan=2>Diterima</th>
                <th colspan=2>SP2D Terbit</th>
                <th colspan=2>Dalam Proses</th>
            </tr>
            <tr>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
                <th>Jml SPM</th>
                <th>Jml Netto (Rp.)</th>
            </tr>
        </thead>
        <tbody class='ratakanan'>
<?php
$no = 1;
if (isset($this->data)) {
    if (empty($this->data)) {
        echo '<td colspan=12 align="center">Tidak ada data.</td>';
    } else {
        foreach ($this->data as $value) {
            echo "<tr>	";
            echo "<td class='ratatengah'>" . $no++ . "</td>";
            echo "<td class='ratatengah'>" . $value->get_akun() . "</td>";
            //echo "<td>" . $value->get_upload_date() . "</td>";
            echo "<td>" . $value->get_jml_spm_dlm_proses_16() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_dlm_proses_16()) . "</td>";
            echo "<td>" . $value->get_jml_spm_diterima_17() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_diterima_17()) . "</td>";
            echo "<td>" . $value->get_jml_spm_diterbitkan_17() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_diterbitkan_17()) . "</td>";
            echo "<td>" . $value->get_jml_spm_dlm_proses_17() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_dlm_proses_17()) . "</td>";
            echo "<td>" . $value->get_jml_spm_diterima_18() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_diterima_18()) . "</td>";
            echo "<td>" . $value->get_jml_spm_diterbitkan_18() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_diterbitkan_18()) . "</td>";
            echo "<td>" . $value->get_jml_spm_dlm_proses_18() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_dlm_proses_18()) . "</td>";
            echo "<td>" . $value->get_jml_spm_diterima_19() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_diterima_19()) . "</td>";
            echo "<td>" . $value->get_jml_spm_diterbitkan_19() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_diterbitkan_19()) . "</td>";
            echo "<td>" . $value->get_jml_spm_dlm_proses_19() . "</td>";
            echo "<td>" . number_format($value->get_nilai_spm_dlm_proses_19()) . "</td>";
            echo "</tr>	";
            
            $jml_spm_dlm_proses_16 += $value->get_jml_spm_dlm_proses_16();
			$nilai_spm_dlm_proses_16 += $value->get_nilai_spm_dlm_proses_16();
            $jml_spm_diterima_17 += $value->get_jml_spm_diterima_17();
			$nilai_spm_diterima_17 += $value->get_nilai_spm_diterima_17();
            $jml_spm_diterbitkan_17 += $value->get_jml_spm_diterbitkan_17();
			$nilai_spm_diterbitkan_17 += $value->get_nilai_spm_diterbitkan_17();
            $jml_spm_dlm_proses_17 += $value->get_jml_spm_dlm_proses_17();
			$nilai_spm_dlm_proses_17 += $value->get_nilai_spm_dlm_proses_17();   
            $jml_spm_diterima_18 += $value->get_jml_spm_diterima_18();
			$nilai_spm_diterima_18 += $value->get_nilai_spm_diterima_18();
            $jml_spm_diterbitkan_18 += $value->get_jml_spm_diterbitkan_18();
			$nilai_spm_diterbitkan_18 += $value->get_nilai_spm_diterbitkan_18();
            $jml_spm_dlm_proses_18 += $value->get_jml_spm_dlm_proses_18();
			$nilai_spm_dlm_proses_18 += $value->get_nilai_spm_dlm_proses_18();   
            $jml_spm_diterima_19 += $value->get_jml_spm_diterima_19();
			$nilai_spm_diterima_19 += $value->get_nilai_spm_diterima_19();
            $jml_spm_diterbitkan_19 += $value->get_jml_spm_diterbitkan_19();
			$nilai_spm_diterbitkan_19 += $value->get_nilai_spm_diterbitkan_19();
            $jml_spm_dlm_proses_19 += $value->get_jml_spm_dlm_proses_19();
			$nilai_spm_dlm_proses_19 += $value->get_nilai_spm_dlm_proses_19();
			 
        }
    }
} else {
    echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
}
?>
            </tbody><tfoot>
            <tr class="ratakanan">
				<td>&nbsp;</td>
                <td ><b>GRAND TOTAL</b></td>
                <td ><b><?php echo $jml_spm_dlm_proses_16 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_dlm_proses_16) ; ?></b></td>
                <td ><b><?php echo $jml_spm_diterima_17 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_diterima_17) ; ?></b></td>
                <td ><b><?php echo $jml_spm_diterbitkan_17 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_diterbitkan_17) ; ?></b></td>
                <td ><b><?php echo $jml_spm_dlm_proses_17 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_dlm_proses_17) ; ?></b></td>
                <td ><b><?php echo $jml_spm_diterima_18 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_diterima_18) ; ?></b></td>
                <td ><b><?php echo $jml_spm_diterbitkan_18 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_diterbitkan_18) ; ?></b></td>
                <td ><b><?php echo $jml_spm_dlm_proses_18 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_dlm_proses_18) ; ?></b></td>
                <td ><b><?php echo $jml_spm_diterima_19 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_diterima_19) ; ?></b></td>
                <td ><b><?php echo $jml_spm_diterbitkan_19 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_diterbitkan_19) ; ?></b></td>
                <td ><b><?php echo $jml_spm_dlm_proses_19 ; ?></b></td>
                <td ><b><?php echo number_format($nilai_spm_dlm_proses_19) ; ?></b></td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            <option value='' selected>SEMUA</option>
                            <?php
                            foreach ($this->kppn_list as $value1) {
                                if ($kode_kppn == $value1->get_kd_d_kppn()) {
                                    echo "<option value='" . $value1->get_kd_d_kppn() . "' selected>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
                                } else {
                                    echo "<option value='" . $value1->get_kd_d_kppn() . "'>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
                                }
                            }
                            ?>
                        </select>
                    <br/>
<?php } ?>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Tombol Download -->
<div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                &nbsp;
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12">
            
                <a href="<?php echo $_SERVER['HTTP_REFERER']."Xls/xls/".$this->d_kd_kppn ; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-saved"></span> &nbsp; XLS</a>
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12">
            
                <a href="<?php echo $_SERVER['HTTP_REFERER']."Xls/csv/".$this->d_kd_kppn ; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-save"></span>  &nbsp; CSV</a>
                
            </div>
            
        </div>
        
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();
    });

    function hideErrorId() {
        $('.alert-danger').fadeOut(0);
    }

    function hideWarning() {

        $('#nosp2d').keyup(function() {
            if (document.getElementById('nosp2d').value != '') {
                $('#wsp2d').fadeOut(200);
            }
        })

        $('#barsp2d').keyup(function() {
            if (document.getElementById('barsp2d').value != '') {
                $('#wbarsp2d').fadeOut(200);
            }
        });

        $('#kdsatker').keyup(function() {
            if (document.getElementById('kdsatker').value != '') {
                $('#wsatker').fadeOut(200);
            }
        });

        $('#status').change(function() {
            if (document.getElementById('status').value != '') {
                $('#wstatus').fadeOut(200);
            }
        });

        $('#tgl_awal').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

        $('#tgl_akhir').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_nosp2d = document.getElementById('nosp2d').value;
        var v_barsp2d = document.getElementById('barsp2d').value;
        var v_kdsatker = document.getElementById('kdsatker').value;
        var v_status = document.getElementById('status').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_nosp2d == '' && v_barsp2d == '' && v_kdsatker == '' && v_status == '' && v_tglawal == '' && v_tglakhir == '') {
            $('#wsp2d').html('Harap isi salah satu parameter');
            $('#wsp2d').fadeIn();
            $('#wbarsp2d').html('Harap isi salah satu parameter');
            $('#wbarsp2d').fadeIn();
            $('#wsatker').html('Harap isi salah satu parameter');
            $('#wsatker').fadeIn();
            $('#wstatus').html('Harap isi salah satu parameter');
            $('#wstatus').fadeIn();
            $('#wbayar').html('Harap isi salah satu parameter');
            $('#wbayar').fadeIn();
            $('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (v_nosp2d != '' && v_nosp2d.length != 15) {
            $('#wsp2d').html('No. SP2D harus 15 digit');
            $('#wsp2d').fadeIn(200);
            jml++;
        }

        if (v_nosp2d != '' && !v_nosp2d.match(pattern)) {
            var wsp2d = 'No SP2D harus dalam bentuk angka!';
            $('#wsp2d').html(wsp2d);
            $('#wsp2d').fadeIn(200);
            jml++;
        }

        if (v_barsp2d != '' && v_barsp2d.length != 21) {
            $('#wbarsp2d').html('No. Transaksi harus 21 digit');
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }

        if (v_barsp2d != '' && !v_barsp2d.match(pattern)) {
            var wbarsp2d = 'No Transaksi harus dalam bentuk angka!';
            $('#wbarsp2d').html(wbarsp2d);
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }

        if (v_kdsatker != '' && v_kdsatker.length != 6) {
            $('#wsatker').html('Kode Satker harus 6 digit');
            $('#wsatker').fadeIn(200);
            jml++;
        }

        if (v_kdsatker != '' && !v_kdsatker.match(pattern)) {
            var wsatker = 'No Transaksi harus dalam bentuk angka!';
            $('#wsatker').html(wbarsp2d);
            $('#wsatker').fadeIn(200);
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>