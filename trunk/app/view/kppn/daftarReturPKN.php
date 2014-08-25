<div id="top">
    <div id="header">
        <h2>MONITORING Retur SP2D PKN<br>
        </h2>
    </div>
    <div style='display: block; float: left; font-weight: bold'>
        <?php
        // untuk menampilkan last_update
        if (isset($this->last_update)) {
            foreach ($this->last_update as $last_update) {
                echo "<br> Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB <br>";
            }
        }
        ?>
        Saldo Awal = 0 | Saldo Akhir = 0<br>
        <?php
        if (isset($this->d_nama_kppn)) {
            foreach ($this->d_nama_kppn as $kppn) {
                echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ") <br>";
                $kode_kppn = $kppn->get_kd_satker();
            }
        }
        ?>
        <?php
        if (isset($this->d_bank)) {
            echo "Bank : " . $this->d_bank . "<br>";
        }
        ?>
        <?php
        if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
            echo "Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir . " <br>";
        }
        ?>
    </div>
	    <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : revisiDIPA.php  
if(isset($this->d_nama_kppn) || isset($this->d_bank) ||
	isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)
	){	
	if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
		}
	}else{
		$kdkppn = 'null';		
	 }
	if (isset($this->d_bank)) {
		$kdbank = $this->d_bank;
	} else {
		$kdbank = 'null';
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
<ul class="inline" style="float: right"><li>
		<a href="<?php echo URL; ?>PDF/monitoringReturPkn_PDF/<?php echo $kdkppn. "/" . $kdbank . "/" .$kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="warning"><i class="icon icon-file icon-white"></i>PDF</a></li>							
	<?php


}

//----------------------------------------------------		
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
                <form method="POST" action="monitoringReturPKN" enctype="multipart/form-data">

<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="error"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select type="text" name="kdkppn" id="kdkppn">
                            <option value=''>- Semua KPPN -</option>
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
                    <label class="isian">Bank: </label>
                    <select type="text" name="bank" id="bank">
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
                        <option value='SEMUA_BANK' <?php if ($this->d_bank == SEMUA_BANK) {
    echo "selected";
} ?>>SEMUA BANK</option>
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
                    <th >No.</th>
                    <th >Tgl SP2D</th>
                    <th >No. SP2D</th>
                    <th >Tgl SP2D-R</th>
                    <th >No SP2D-R</th>
                    <th >Debet</th>
                    <th >Kredit</th>
                    <th >Saldo</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {
                        $saldo = 0;
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_statement_date() . "</td>";
                            echo "<td>" . $value->get_receipt_number() . "</td>";
                            echo "<td> " . $value->get_tgsp2d_pengganti() . " </td>";
                            echo "<td> " . $value->get_nosp2d_pengganti() . "</td>";
                            echo "<td align='right'>" . number_format($value->get_nilai_sp2d_pengganti()) . "</td>";
                            echo "<td align='right'> " . number_format($value->get_amount()) . " </td>";
                            echo "<td align='right'>" . number_format($saldo+=($value->get_amount() - $value->get_nilai_sp2d_pengganti())) . "</td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
        </table>
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
                                if (v_bank == '' && v_tglawal == '' && v_tglakhir == '') {
                                    $('#wbank').html('Harap isi salah satu parameter');
                                    $('#wbank').fadeIn();
                                    $('#wtgl').html('Harap isi salah satu parameter');
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