<div id="top">
    <div id="header">
        <h2>MONITORING Retur SP2D<br>

            <?php
            if (isset($this->d_nama_kppn)) {
                foreach ($this->d_nama_kppn as $kppn) {
                    echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ") <br>";
                    $kode_kppn = $kppn->get_kd_satker();
                }
            }
            ?>
        </h2>
    </div>
    <?php
// untuk menampilkan last_update
    if (isset($this->last_update)) {
        foreach ($this->last_update as $last_update) {
            echo "Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB <br>";
        }
    }
    ?>
    <div style='display: block; float: left; font-weight: bold'>

        <?php
        if (isset($this->d_status)) {
            echo "Status : " . $this->d_status . "<br>";
        }
        ?>
        <?php
        if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
            echo "Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
        }
        ?>

    </div>

    <?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : daftarretur.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------

if(isset($this->d_nosp2d) || isset($this->d_barsp2d) ||
 isset($this->d_kdsatker) || isset($this->d_bank) || 
 isset($this->d_status) || isset($this->d_tgl_awal) ||
 isset($this->d_tgl_akhir))
{
    $kdkppn = Session::get('id_user');
    if (isset($this->d_nosp2d)) {
        $kdnosp2d = $this->d_nosp2d;
    }else{
		$kdnosp2d='null';
	}

    if (isset($this->d_barsp2d)) {
        $kdbarsp2d = $this->d_barsp2d;
    }else{
		$kdbarsp2d='null';
	}
    if (isset($this->d_kdsatker)) {
        $kdsatker = $this->d_kdsatker;
    }else{
		$kdsatker='null';
	}
	
	
    if (isset($this->d_bank)) {
        $kdbank = $this->d_bank;
    }else{
		$kdbank='null';
	}
    if (isset($this->d_status)) {
        $kdstatus = $this->d_status;
    }else{
		$kdstatus='null';
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
    <a href="<?php echo URL; ?>PDF/monitoringRetur_PDF/<?php echo $kdkppn . "/" . $kdnosp2d . "/" . $kdbarsp2d . "/" . $kdsatker . "/" . $kdbank . "/" . $kdstatus . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="modal">PDF</a>


<?php
//----------------------------------------------------		



}


?>
    <a href="#oModal" class="modal">FILTER DATA</a>
    <div id="oModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
$_SERVER['PHP_SELF'];
?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>

            <div id="top">	
                <form method="POST" action="monitoringRetur" enctype="multipart/form-data">

                        <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="error"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select type="text" name="kdkppn" id="kdkppn">
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

                    <div id="wsp2d" class="error"></div>
                    <label class="isian">No SP2D: </label>
                    <input type="number" name="nosp2d" id="nosp2d" size="15" value="<?php if (isset($this->d_nosp2d)) {
    echo $this->d_nosp2d;
} ?>">

                    <div id="wbarsp2d" class="error" ></div>
                    <label class="isian">No Transaksi: </label>
                    <input type="number" name="barsp2d" id="barsp2d" value="<?php if (isset($this->d_barsp2d)) {
                        echo $this->d_barsp2d;
                    } ?>">

<?php
if (Session::get('role') != SATKER) {
    echo "<div id='wsatker' class='error'></div>";
    echo "<label class='isian'>Kode Satker: </label>";
}
?>
                    <input type="<?php if (Session::get('role') == SATKER) {
    echo "hidden";
} else {
    echo "number";
} ?>" name="kdsatker" id="kdsatker" size="15" value="<?php if (isset($this->d_kdsatker)) {
    echo $this->d_kdsatker;
} ?>">

                    <div id="wstatus" class="error"></div>
                    <label class="isian">Status: </label>
                    <select type="text" name="status" id="status">
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

                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal Retur: </label>
                    <ul class="inline">
                        <li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)) {
    echo $this->d_tgl_awal;
} ?>"> </li> <li>s/d</li>
                        <li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)) {
    echo $this->d_tgl_akhir;
} ?>"></li>
                    </ul>

                    <ul class="inline" style="margin-left: 150px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>



    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader' style="font-size: 80%">
            <!--baris pertama-->
            <thead>
                <tr>
                    <th rowspan="2" width='3%' class='mid'>No.</th>
                    <th rowspan="2" width='10%' class='mid'>Kode Satker <br> Nama Satker</th>
                    <th colspan="4">SP2D Retur</th>
                    <th colspan="3">SP2D Pengganti</th>
                    <th rowspan="2">Bank Pembayar <br> Status Retur</th>
                </tr>
                <tr>
                    <th width='10%' class='mid'>Tgl. SP2D<br>No. SP2D<br>No. Transaksi</th>
                    <th width='10%' class='mid'>Bank Penerima <br>Nama Penerima<br>No. Rekening Penerima <br>Jumlah</th>
                    <th width='20%' class='mid'>Uraian SP2D</th>
                    <th width='10%' class='mid'>Alasan Retur</th>
                    <th width='10%' class='mid'>Tgl Proses <br>SP2D Pengganti</th>
                    <th width='10%' class='mid'>Tgl. SP2D<br>No. SP2D</th>
                    <th width='10%' class='mid'>Bank Penerima <br>Nama Penerima<br>No. Rekening Penerima <br>Jumlah</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
<?php
$no = 1;
if (isset($this->data)) {
    if (empty($this->data)) {
        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
    } else {
        foreach ($this->data as $value) {
            echo "<tr>	";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $value->get_kdsatker() . "<br>" . $value->get_nmsatker() . "</td>";
            echo "<td>" . $value->get_statement_date() . "<br>" . $value->get_sp2d_number() . "<br>" . $value->get_receipt_number() . "</td>";
            echo "<td class='ratakiri'> " . $value->get_bank_name() . '<br>Penerima: ' . $value->get_vendor_name() . ' <br>No. Rek: ' . $value->get_vendor_ext_bank_account_num() . "<br> Rp. " . $value->get_amount() . "</td>";
            echo "<td class='ratakiri'> " . $value->get_invoice_description() . " </td>";
            echo "<td class='ratakiri'> " . $value->get_keterangan_retur() . " </td>";
            echo "<td>" . $value->get_tgl_proses_sp2d_pengganti() . "</td>";
            echo "<td>" . $value->get_tgsp2d_pengganti() . "<br> " . $value->get_nosp2d_pengganti() . "</td>";
            echo "<td class='ratakiri'> " . $value->get_bank_name_pengganti() . '<br>Penerima: ' . $value->get_vendor_name_pengganti() . ' <br>No. Rek: ' . $value->get_vendor_account_num_pengganti() . "<br> Rp. " . $value->get_nilai_sp2d_pengganti() . "</td>";
            echo "<td>" . $value->get_bank_account_name() . "<br>" . $value->get_status_retur() . "</td>";
            echo "</tr>	";
        }
    }
} else {
    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
}
?>
            </tbody>
        </table>
        <b>Keterangan : </b></br>
        SP2D Retur = SP2D yang diretur oleh Bank Penerima </br>
        SP2D Pengganti = SP2D yang diterbitkan untuk menggantikan SP2D Retur
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
                            $(function() {
                                hideErrorId();
                                hideWarning();
                                $("#tgl_awal").datepicker({
                                    maxDate: "dateToday",
                                    dateFormat: 'dd-mm-yy',
                                    onClose: function(selectedDate, instance) {
                                        if (selectedDate != '') {
                                            $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                                            var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                                            date.setMonth(date.getMonth() + 1);
                                            console.log(selectedDate, date);
                                            $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                                            $("#tgl_akhir").datepicker("option", "maxDate", date);
                                        }
                                    }
                                });

                                $("#tgl_akhir").datepicker({
                                    maxDate: "dateToday",
                                    dateFormat: 'dd-mm-yy',
                                    onClose: function(selectedDate) {
                                        $("#tgl_awal").datepicker("option", "maxDate", selectedDate);
                                    }
                                });
                            });

                            function hideErrorId() {
                                $('.error').fadeOut(0);
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

                            $(document).ready(function() {
                                var oTable = $('#fixheader').dataTable({
                                    "sScrollY": 400,
                                    "sScrollX": "100%",
                                    "sScrollXInner": "100%",
                                    "bSort": false,
                                    "bPaginate": false,
                                    "bInfo": null,
                                    "bFilter": false,
                                    "oLanguage": {
                                        "sEmptyTable": "Tidak ada data di dalam tabel ini."

                                    },
                                });

                                var keys = new KeyTable({
                                    "table": document.getElementById('fixheader'),
                                    "datatable": oTable
                                });
                            });
</script>