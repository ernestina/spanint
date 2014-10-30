<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataRetur/monitoringRetur -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Retur SP2D</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

                if(isset($this->d_nosp2d) || isset($this->d_barsp2d) || isset($this->d_kdsatker) || isset($this->d_bank) || isset($this->d_status) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)) {
					if (isset($this->d_nama_kppn)) {
					foreach ($this->d_nama_kppn as $kppn) {
							$kdkppn = $kppn->get_kd_satker();
						  }
					} else {
						$kdkppn = Session::get('id_user');
					}
                    
                    
                    if (isset($this->d_nosp2d)) {
                        $kdnosp2d = $this->d_nosp2d;
                    } else {
                        $kdnosp2d='null';
                    }

                    if (isset($this->d_barsp2d)) {
                        $kdbarsp2d = $this->d_barsp2d;
                    } else {
                        $kdbarsp2d='null';
                    }
                    if (isset($this->d_kdsatker)) {
                        $kdsatker = $this->d_kdsatker;
                    } else {
                        $kdsatker='null';
                    }


                    if (isset($this->d_bank)) {
                        $kdbank = $this->d_bank;
                    } else {
                        $kdbank='null';
                    }
                    if (isset($this->d_status)) {
                        $kdstatus = $this->d_status;
                    } else {
                        $kdstatus='null';
                    }
                    if (isset($this->d_tgl_awal)) {
                        $kdtgl_awal = $this->d_tgl_awal;
                    } else {
							$kdtgl_awal='null';
                    }
                    if (isset($this->d_tgl_akhir)) {
                        $kdtgl_akhir = $this->d_tgl_akhir;
                    } else {
                        $kdtgl_akhir ='null';
                    }
                ?>
                
                <a href="<?php echo URL; ?>PDF/monitoringRetur_PDF/<?php echo $kdkppn . "/" . $kdnosp2d . "/" . $kdbarsp2d . "/" . $kdsatker . "/" . $kdbank . "/" . $kdstatus . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-print"></span> PDF</a>


                <?php } ?>       
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
            
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
                ?>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th rowspan=2 class="align-center">No.</th>
                <th rowspan=2 class="align-center">Kode Satker <br> Nama Satker</th>
                <th colspan=5 class="align-center">SP2D Retur</th>
                <th colspan=3 class="align-center">SP2D Pengganti</th>
                <th rowspan=2 class="align-center">Status Retur</th>
                
            </tr>
            <tr>
                <th class="align-center">Tgl. SP2D<br>No. SP2D<br>No. Transaksi</th>
                <th rowspan=2 class="align-center">Bank Pembayar</th>
                <th width="200px">Bank Penerima <br>Nama Penerima<br>No. Rekening Penerima <br>Jumlah</th>
                <th>Uraian SP2D</th>
                <th>Alasan Retur</th>
                <th class="align-center">Tgl Proses <br>SP2D Pengganti</th>
                <th class="align-center">Tgl. SP2D<br>No. SP2D</th>
                <th width="200px">Bank Penerima <br>Nama Penerima<br>No. Rekening Penerima <br>Jumlah</th>
            </tr>
        </thead>
        <tbody>
<?php
$no = 1;
if (isset($this->data)) {
    if (empty($this->data)) {
        echo '<td colspan=12 align="center">Tidak ada data.</td>';
    } else {
        foreach ($this->data as $value) {
            echo "<tr>	";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $value->get_kdsatker() . "<br>" . $value->get_nmsatker() . "</td>";
            echo "<td>" . $value->get_statement_date() . "<br>" . $value->get_sp2d_number() . "<br>" . $value->get_receipt_number() . "</td>";
            echo "<td>" . $value->get_bank_account_name() . "</td>";
            echo "<td width='200px'> " . $value->get_bank_name() . '<br>Penerima: ' . $value->get_vendor_name() . ' <br>No. Rek: ' . $value->get_vendor_ext_bank_account_num() . "<br> Rp. " . number_format($value->get_amount()) . "</td>";
            echo "<td class='ratakiri'> " . $value->get_invoice_description() . " </td>";
            echo "<td class='ratakiri'> " . $value->get_keterangan_retur() . " </td>";
            echo "<td>" . $value->get_tgl_proses_sp2d_pengganti() . "</td>";
            echo "<td>" . $value->get_tgsp2d_pengganti() . "<br> " . $value->get_nosp2d_pengganti() . "</td>";
            echo "<td class='ratakiri'> " . $value->get_bank_name_pengganti() . '<br>Penerima: ' . $value->get_vendor_name_pengganti() . ' <br>No. Rek: ' . $value->get_vendor_account_num_pengganti() . "<br> Rp. " . number_format($value->get_nilai_sp2d_pengganti()) . "</td>";
            echo "<td> KPPN " . $value->get_status_retur() . "</td>";
            echo "</tr>	";
        }
    }
} else {
    echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
}
?>
            </tbody>
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
            
            <form id="filter-form" method="POST" action="monitoringRetur" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
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
                    <div id="wsp2d" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">No SP2D: </label>
                    <input class="form-control" type="number" name="nosp2d" id="nosp2d" size="15" value="<?php if (isset($this->d_nosp2d)) {
    echo $this->d_nosp2d;
} ?>">
                    <br/>
                    <div id="wbarsp2d" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">No Transaksi: </label>
                    <input class="form-control" type="number" name="barsp2d" id="barsp2d" value="<?php if (isset($this->d_barsp2d)) {
                        echo $this->d_barsp2d;
                    } ?>">

<?php
if (Session::get('role') != SATKER) {
    echo "<div id='wsatker' class='error'></div>";
    echo "<label class='isian'>Kode Satker: </label>";
}
?>
                    <input class="form-control" type="<?php if (Session::get('role') == SATKER) {
    echo "hidden";
} else {
    echo "number";
} ?>" name="kdsatker" id="kdsatker" size="15" value="<?php if (isset($this->d_kdsatker)) {
    echo $this->d_kdsatker;
} ?>">
                    <br/>
                    <div id="wstatus" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Status: </label>
                    <select class="form-control" type="text" name="status" id="status">
                        <option value=''>- pilih -</option>
                        <option value='SUDAH PROSES' <?php if ($this->d_status == 'SUDAH PROSES') {
    echo "selected";
} ?>>SUDAH PROSES</option>
                        <option value='BELUM PROSES' <?php if ($this->d_status == 'BELUM PROSES') {
    echo "selected";
} ?>>BELUM PROSES</option>
                        <option value='SEMUA' <?php if ($this->d_status == 'SEMUA') {
    echo "selected";
} ?>>SEMUA</option>
                    </select>
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal: </label>
                    
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

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