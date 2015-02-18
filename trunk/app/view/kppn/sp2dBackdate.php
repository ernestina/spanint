<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring SP2D Backdate</h2>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

if(isset($this->d_bank) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
    if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
		  }
	} else {
		$kdkppn = Session::get('id_user');
	}

    if (isset($this->d_bank)) {
        $kdbank = $this->d_bank;
    }else{
		$kdbank='null';
	}
    if (isset($this->d_tgl_awal)) {
        $kdtgl_awal = $this->d_tgl_awal;
    } else {
        $kdtgl_awal = 'null';
    }
    if (isset($this->d_tgl_akhir)) {
        $kdtgl_akhir = $this->d_tgl_akhir;
    } else {
        $kdtgl_akhir = 'null';
    }
    ?>
        <div class="btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
            </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo URL; ?>PDF/sp2dBackdate_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdbank; ?>/PDF">PDF</a></li>
                    <li><a href="<?php echo URL; ?>PDF/sp2dBackdate_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdbank; ?>/XLS">EXCEL</a></li>
                  </ul>
        </div>
    
<?php
//----------------------------------------------------		

}
?>          
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
           
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php
                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                            $kode_kppn = $kppn->get_kd_satker();
                        }
                    }
                    ?>
                    <?php
                    if (isset($this->d_bank)) {
                        if ($this->d_bank == "MDRI") {
                            echo "<br> Mandiri";
                        } elseif ($this->d_bank == "5") {
                            echo "<br> Semua Bank";
                        } else {
                            echo "<br> " . $this->d_bank;
                        }
                    }
                    ?>
                    <?php
                    if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                        echo $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
                    }
                    ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
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
                    <th>No.</th>
                    <th width='70px'>Tgl Selesai SP2D</th>
                    <!--th width='70px'>Tgl SP2D</th-->
                    <th>No, Tanggal SP2D</th>
                    <th>No. Invoice, <br>Jumlah Rp</th>
                    <th>Nama Bank</th>
                    <th width='200px'>Bank, Nama, No. Rek Supplier</th>
                    <th width='300px'>Deskripsi</th>
                    <th>File Transaksi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_creation_date() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_check_number_line_num() . '<br>' . $value->get_check_number() . '<br>' . $value->get_payment_date() . "</td>";
                            //echo "<td>" . $value->get_check_number() . "</td>";
                            //echo "<td>" . $value->get_return_code() . "</td>";
                            //echo "<td>" . $value->get_check_number_line_num() . "</td>";
                            //echo "<td>" . $value->get_invoice_num() . "</td>";
                            echo "<td class='ratakanan'>" . $value->get_invoice_num() . '<br>Rp ' . $value->get_check_amount() . "</td>";
                            echo "<td>" . $value->get_bank_account_name() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_bank_name() . '<br>Penerima: ' . $value->get_vendor_name() . '<br>No. Rek: ' . $value->get_vendor_ext_bank_account_num() . "</td>";
                            //echo "<td>" . $value->get_vendor_ext_bank_account_num() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
                            echo "<td>" . $value->get_ftp_file_name() . "</td>";
                            echo "<td>" . $value->get_return_desc() . '<br>' . $value->get_payment_method();
                            if ($value->get_payment_method() == 'OVERBOOKING') {
                                echo "<br>Ref No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                            } elseif ($value->get_payment_method() == 'SKN') {
                                echo "<br>SOR No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                            } elseif ($value->get_payment_method() == 'RTGS') {
                                echo "<br>BOR No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                            } elseif ($value->get_payment_method() == 'SWIFT') {
                                echo "<br>Swift No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                            } else {
                                echo "<br>Metode Pembayaran tidak terdaftar</td>";
                            }
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
            
            <form id="filter-form" method="POST" action="sp2dBackdate" enctype="multipart/form-data">

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
<?php } ?>

                    <div id="wbank" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Nama Bank: </label>
                    <select class="form-control" type="text" name="bank" id="bank">
                        <option value=''>- pilih -</option>
                        <option value='MDRI' <?php if ($this->d_bank == MDRI) {
    echo "selected";
} ?>>Mandiri</option>
                        <option value='BRI' <?php if ($this->d_bank == BRI) {
    echo "selected";
} ?>>BRI</option>
                        <option value='BNI' <?php if ($this->d_bank == BNI) {
    echo "selected";
} ?>>BNI</option>
                        <option value='BTN' <?php if ($this->d_bank == BTN) {
    echo "selected";
} ?>>BTN</option>
                        <option value='5' <?php if ($this->d_bank == 5) {
    echo "selected";
} ?>>SEMUA BANK</option>
                    </select>
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

<!-- Skrip -->
<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();
        
    });

    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {

        $('#bank').change(function() {
            if (document.getElementById('bank').value != '') {
                $('#wbank').fadeOut(200);
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
        var v_bank = document.getElementById('bank').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_bank == '') {
            $('#wbank').html('Harap isi parameter');
            $('#wbank').fadeIn();
            jml++;
        }

        if (v_tglawal == '' || v_tglakhir == '') {
            $('#wtgl').html('Harap isi kolom tanggal ');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }

</script>

<div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <b>Keterangan : </b></br>
                Sukses Overbooking = Dana sudah masuk ke Rekening Penerima </br>
                Sukses RTGS / SKN / Swift = Dana sudah ditransfer dari Bank Pembayar ke Bank Penerima, mekanisme transfer dana dari Bank Penerima ke Rekening Penerima tergantung pada Bank Penerima</br>
                Nomor Ref/SOR/BOR = Nomor bukti transaksi pada perbankan yang dapat digunakan untuk konfirmasi ke bank penerima
            </div>
            
        </div>
    </div>
</div>