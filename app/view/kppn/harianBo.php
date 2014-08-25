<div id="top">
    <div id="header">
        <h2>MONITORING PENERBITAN SP2D HARIAN KE BANK
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
        </h2>
    </div>
    <?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : harianBO.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------
    if( isset($this->d_bank) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)
	
	){
	
			$kdkppn = Session::get('id_user');

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

    <a href="<?php echo URL; ?>PDF/harianBO_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdbank; ?>" class="modal">PDF</a>

<?php
//----------------------------------------------------		
	
	
	}


?>

    <a href="#cModal" class="modal">FILTER DATA</a>
    <div id="cModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
$_SERVER['PHP_SELF'];
?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>

            <div id="top">
                <form method="POST" action="harianBO" enctype="multipart/form-data">

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

                    <div id="wbank" class="error"></div>
                    <label class="isian">Nama Bank: </label> 
                    <select type="text" name="bank" id="bank" value="<?php if (isset($this->bank)){echo $this->bank.MDRI;
} ?>">
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

                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal: </label>
                    <ul class="inline">
                        <li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)) {
    echo $this->d_tgl_awal;
} ?>"> </li> <li>s/d</li>
                        <li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)) {
        echo $this->d_tgl_akhir;
    } ?>"></li>
                    </ul>

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

<?php
// untuk menampilkan last_update
if (isset($this->last_update)) {
    foreach ($this->last_update as $last_update) {
        echo "<td>Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB </td>";
    }
}
?>

    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader' style="font-size: 80%">
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <th width='70px'>Tgl Selesai SP2D</th>
            <!--th width='70px'>Tgl SP2D</th-->
            <th>No, Tanggal SP2D</th>
            <!--th>Status</th-->
            <!--th>Tanggal Selesai SP2D</th>
            <th>No. Transaksi</th-->
            <th>No. Invoice, <br>Jumlah Rp</th>
            <th>Bank Pembayar</th>
            <th width='200px'>Bank Penerima, Nama,<br> No. Rekening Penerima</th>
            <th width='300px'>Deskripsi</th>
            <th>File Transaksi</th>
            <th>Status</th>

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
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
        </table>
        <b>Keterangan : </b></br>
        Sukses Overbooking = Dana sudah masuk ke Rekening Penerima </br>
        Sukses RTGS / SKN / Swift = Dana sudah ditransfer dari Bank Pembayar ke Bank Penerima, mekanisme transfer dana dari Bank Penerima ke Rekening Penerima tergantung pada Bank Penerima</br>
        Nomor Ref/SOR/BOR = Nomor bukti transaksi pada perbankan yang dapat digunakan untuk konfirmasi ke bank penerima
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

                                $('#bank').change(function() {
                                    if (document.getElementById('bank').value != '') {
                                        $('#wbank').fadeOut(200);
                                    }
                                });

                                $('#datepicker').change(function() {
                                    if (document.getElementById('datepicker').value != '' && document.getElementById('datepicker1').value != '') {
                                        $('#wtgl').fadeOut(200);
                                    }
                                });

                                $('#datepicker1').change(function() {
                                    if (document.getElementById('datepicker').value != '' && document.getElementById('datepicker1').value != '') {
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
                                    $('#wtgl').html('Harap isi parameter');
                                    $('#wtgl').fadeIn();
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