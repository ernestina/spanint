<div id="top">
    <div id="header">
        <h2>MONITORING Pelimpahan<br>

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
    //File yang diubah : revisiDIPA.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------
	
	
	if(isset($this->d_status) || isset($this->d_satker) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
	$kdkppn=Session::get('id_user');
		if (isset($this->d_status)) {
			$kdstatus = $this->d_status;
		} else {
			$kdstatus = 'null';
		}

		if (isset($this->d_satker)) {
			$kdsatker = $this->d_satker;
		} else {
			$kdsatker = Session::get('kd_satker');
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
            <a href="<?php echo URL; ?>PDF/monitoringPelimpahan_PDF/<?php echo $kdsatker . "/" . $kdkppn. "/" . $kdstatus . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="warning"><i class="icon icon-file icon-white"></i>PDF</a></li>							
        <?php
	
	
	}
	
//----------------------------------------------------		
?>
    <a href="#oModal" class="modal">FILTER DATA</a>
    <div id="oModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php$_SERVER['PHP_SELF'];?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>

            <div id="top">	
                <form method="POST" action="monitoringPelimpahan" enctype="multipart/form-data">

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

                    <div id="wstatus" class="error"></div>
                    <label class="isian">Status: </label>
                    <select type="text" name="status" id="status">
                        <option value=''>- pilih -</option>
                        <option value='RECONCILED' <?php if ($this->d_status == 'RECONCILED') {echo "selected";} ?>>RECONCILED</option>
                        <option value='UNRECONCILED' <?php if ($this->d_status == 'UNRECONCILED') {echo "selected";} ?>>UNRECONCILED</option>
                        <option value='SEMUA' <?php if ($this->d_status == 'SEMUA') {echo "selected";} ?>>SEMUA</option>
                    </select>                    

                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal Pelimpahan: </label>
                    <ul class="inline">
                        <li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)) {echo $this->d_tgl_awal;} ?>"> </li> <li>s/d</li>
                        <li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)) {echo $this->d_tgl_akhir;} ?>"></li>
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
                    <th colspan="5">Pelimpahan</th>
                    <th colspan="5">Penerimaan 501</th>
                    <th rowspan="2">Status Limpah</th>
                </tr>
                <tr>
                    <th width='10%' class='mid'>No. Rekening<br>Nama Rekening</th>
                    <th width='10%' class='mid'>No. Sakti</th>
                    <th width='20%' class='mid'>Nilai</th>
                    <th width='10%' class='mid'>Akun</th>
                    <th width='10%' class='mid'>Kode KPPN </th>
                    <th width='10%' class='mid'>No. Rekening<br>Nama Rekening</th>
                    <th width='10%' class='mid'>No. Sakti</th>
                    <th width='20%' class='mid'>Nilai</th>
                    <th width='10%' class='mid'>Akun</th>
                    <th width='10%' class='mid'>Kode KPPN </th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
<?php
$no = 1;
//var_dump($this->data);
if (isset($this->data)) {
    if (empty($this->data)) {
        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
    } else {
        foreach ($this->data as $value) {
            echo "<tr>	";
            echo "<td>" . $no++ . "</td>";
            echo "<td class='ratakiri'>" . $value->get_norek_persepsi() . "<br>" . $value->get_nmrek_persepsi() . "</td>";
            echo "<td>" . $value->get_nosakti_limpah . "</td>";
            echo "<td class='ratakanan'> " . $value->get_jml_terima()  . "</td>";
            echo "<td> " . $value->get_akun_terima() . " </td>";
            echo "<td> " . $value->get_kppn_anak() . " </td>";
            echo "<td>" . $value->get_norek_501() . "<br>" . $value->get_nmrek_501() . "</td>";
            echo "<td>" . $value->get_nosakti_bs . "</td>";
            echo "<td class='ratakanan'> " . $value->get_jml_limpah()  . "</td>";
            echo "<td> " . $value->get_akun_limpah() . " </td>";
            echo "<td> " . $value->get_kppn_induk() . " </td>";
            echo "<td>" .$value->get_status() . "</td>";
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
                                var v_tglawal = document.getElementById('tgl_awal').value;
                                var v_tglakhir = document.getElementById('tgl_akhir').value;

                                var jml = 0;
                                if (v_tglawal == '' && v_tglakhir == '') {
                                    $('#wbayar').html('Harap isi tanggal');
                                    $('#wbayar').fadeIn();
                                    $('#wtgl').html('Harap isi tanggal');
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