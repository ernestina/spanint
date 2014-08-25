<div id="top">
    <div id="header">
        <h2>DATA REVISI DIPA <?php //echo Session::get('user');  ?>
            <?php
            $nmsatker = '';
            foreach ($this->data as $value) {
                $nmsatker = $value->get_nm_satker();
            }
            echo $nmsatker;
            ?>

        </h2>
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
	
	if( isset($this->account_code) ||
	isset($this->output_code) || isset($this->program_code) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)
	){
    if (isset($this->account_code)) {
        $kdakun = $this->account_code;
        $kdakun = rtrim($kdakun);
    } else {
        $kdakun = 'null';
    }

    if (isset($this->satker_code)) {
        $kdsatker = $this->satker_code;
        $kdsatker = rtrim($kdsatker);
    } else {
        $kdsatker = 'null';
    }

    if (isset($this->output_code)) {
        $kdoutput = $this->output_code;
        $kdoutput = rtrim($kdoutput);
    } else {
        $kdoutput = 'null';
    }
    if (isset($this->program_code)) {
        $kdprogram = $this->program_code;
        $kdprogram = rtrim($kdprogram);
    } else {
        $kdprogram = 'null';
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
            <a href="<?php echo URL; ?>PDF/revisiDIPA_PDF/<?php echo $kdsatker . "/" . $kdakun . "/" . $kdoutput . "/" . $kdprogram . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="warning"><i class="icon icon-file icon-white"></i>PDF</a></li>							
        <?php
//----------------------------------------------------		
	
	
	
	}

        ?>
        <li><a href="#yModal" class="modal">FILTER DATA</a></li></ul>
    <div id="yModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
        $_SERVER['PHP_SELF'];
        ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>

            <div id="top">

                <form method="POST" action="#" enctype="multipart/form-data">


                    <div id="wakun" class="error"></div>
                    <label class="isian">Akun : </label>
                    <input type="text" name="akun" id="akun">

                    <div id="woutput" class="error"></div>
                    <label class="isian">Output : </label>
                    <input type="text" name="output" id="output">

                    <div id="wprogram" class="error"></div>
                    <label class="isian">Program : </label>
                    <input type="text" name="program" id="program">

                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal: </label>
                    <ul class="inline">
                        <li><input type="text" class="tanggal" name="tgl_awal" id="datepicker" value="<?php if (isset($this->d_tgl_awal)) {
            echo $this->d_tgl_awal;
        } ?>"> </li> <li>s/d</li>
                        <li><input type="text" class="tanggal" name="tgl_akhir" id="datepicker1" value="<?php if (isset($this->d_tgl_akhir)) {
            echo $this->d_tgl_akhir;
        } ?>"></li>
                    </ul>

                    <ul class="inline"  style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                        <!--onClick="konfirm(); return false;"-->
                    </ul>
                </form>
            </div>
        </div>
    </div>

    <?php
    // untuk menampilkan last_update
    if (isset($this->last_update)) {
        foreach ($this->last_update as $last_update) {
            echo "Update Data Terakhir (Waktu Server)  "
            ?> <br/>
        <?php
        echo $last_update->get_last_update() . " WIB";
    }
}
?>
    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id="example" style="font-size: 90%">
            <!--baris pertama-->
            <thead>
            <th class='mid'>No.</th>
            <th class='mid'>Nomor DIPA</th>
            <th>Revisi Ke</th>
            <th>Tanggal Post Revisi</th>
            <th class='mid'>Pagu</th>
            <th class='mid'>Satker</th>
            <th class='mid'>Akun</th>
            <th class='mid'>Program</th>
            <th class='mid'>Output</th>
            <th class='mid'>Dana</th>
            <th class='mid'>Bank</th>
            <th>Kewenangan</th>
            <th>Tipe Anggaran</th>
            <th class='mid'>Kololari</th>
            <th>Kode Cadangan</th>

            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_dipa_no() . "</td>";
                            echo "<td>" . $value->get_revision_no() . "</td>";
                            echo "<td>" . $value->get_tanggal_posting_revisi() . ' ' . $value->get_jam_posting_revisi() . "</td>";
                            //echo "<td>" . $value->get_jam_posting_revisi() . "</td>";
                            echo "<td class='ratakanan'>" . $value->get_line_amount() . "</td>";
                            echo "<td>" . $value->get_satker_code() . "</td>";
                            //echo "<td>" . $value->get_kppn_code() . "</td>";
                            echo "<td>" . $value->get_account_code() . "</td>";
                            echo "<td>" . $value->get_program_code() . "</td>";
                            echo "<td>" . $value->get_output_code() . "</td>";
                            echo "<td>" . $value->get_dana_code() . "</td>";
                            echo "<td>" . $value->get_bank_code() . "</td>";
                            echo "<td>" . $value->get_kewenangan_code() . "</td>";
                            echo "<td>" . $value->get_budget_type() . "</td>";
                            echo "<td>" . $value->get_intraco_code() . "</td>";
                            echo "<td>" . $value->get_cadangan_code() . "</td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <br>
        <b><i>* Nilai Pagu Merupakan Pagu Awal DIPA, Untuk Melihat Sisa Pagu Tersedia Gunakan Menu Sisa Pagu Belanja Realisasi dan Encumbrance </i></b></br>
        <b><i>* Data Merupakan Data Per Tanggal Sebelumnya Pukul 19.00 </i></b></br>
    </div>
</div>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
                            $(function() {
                                hideErrorId();
                                hideWarning();

                            });

                            function hideErrorId() {
                                $('.error').fadeOut(0);
                            }

                            function hideWarning() {
                                $('#kd_satker').change(function() {
                                    if (document.getElementById('kd_satker').value != '') {
                                        $('#wkdsatker').fadeOut(200);
                                    }
                                });

                                $('#akun').change(function() {
                                    if (document.getElementById('akun').value != '') {
                                        $('#wakun').fadeOut(200);
                                    }
                                });

                                $('#output').change(function() {
                                    if (document.getElementById('output').value != '') {
                                        $('#woutput').fadeOut(200);
                                    }
                                });

                                $('#program').change(function() {
                                    if (document.getElementById('output').value != '') {
                                        $('#wprogram').fadeOut(200);
                                    }
                                });

                                $('#datepicker2').change(function() {
                                    if (document.getElementById('datepicker2').value != '' && document.getElementById('datepicker3').value != '') {
                                        $('#wtgl').fadeOut(200);
                                    }
                                });

                                $('#datepicker3').change(function() {
                                    if (document.getElementById('datepicker2').value != '' && document.getElementById('datepicker3').value != '') {
                                        $('#wtgl').fadeOut(200);
                                    }
                                });

                            }

                            function cek_upload() {
                                var pattern = '^[0-9]+$';
                                var v_kd_satker = document.getElementById('kd_satker').value;
                                var v_akun = document.getElementById('akun').value;
                                var v_output = document.getElementById('output').value;
                                var v_program = document.getElementById('program').value;
                                var v_tglawal = document.getElementById('datepicker2').value;
                                var v_tglakhir = document.getElementById('datepicker3').value;

                                var jml = 0;
                                if (v_kd_satker == '' && v_akun == '' && v_output == '' && v_program == '' && v_tglawal == '' && v_tglakhir == '') {
                                    $('#wkdsatker').html('Harap isi salah satu parameter');
                                    $('#wkdsatker').fadeIn();
                                    $('#wakun').html('Harap isi salah satu parameter');
                                    $('#wakun').fadeIn();
                                    $('#woutput').html('Harap isi salah satu parameter');
                                    $('#woutput').fadeIn();
                                    $('#wprogram').html('Harap isi salah satu parameter');
                                    $('#wprogram').fadeIn();
                                    $('#wtgl').html('Harap isi salah satu parameter');
                                    $('#wtgl').fadeIn();
                                    jml++;
                                }

                                if (v_kd_satker != '' && v_kd_satker.length != 6) {
                                    $('#wkdsatker').html('Kode Satker harus 6 digit');
                                    $('#wkdsatker').fadeIn(200);
                                    jml++;
                                }

                                if (v_kd_satker != '' && !v_kd_satker.match(pattern)) {
                                    var wkdsatker = 'Kode Satker harus dalam bentuk angka!';
                                    $('#wkdsatker').html(wkdsatker);
                                    $('#wkdsatker').fadeIn(200);
                                    jml++;
                                }

                                if (v_akun != '' && v_akun.length != 6) {
                                    $('#wakun').html('Kode Akun harus 6 digit');
                                    $('#wakun').fadeIn(200);
                                    jml++;
                                }

                                if (v_akun != '' && !v_akun.match(pattern)) {
                                    var wakun = 'Kode Akun harus dalam bentuk angka!';
                                    $('#wakun').html(wakun);
                                    $('#wakun').fadeIn(200);
                                    jml++;
                                }

                                if (v_output != '' && v_output.length != 7) {
                                    $('#woutput').html('Kode Output harus 7 digit');
                                    $('#woutput').fadeIn(200);
                                    jml++;
                                }

                                if (v_output != '' && !v_output.match(pattern)) {
                                    var woutput = 'Kode Akun harus dalam bentuk angka!';
                                    $('#woutput').html(woutput);
                                    $('#woutput').fadeIn(200);
                                    jml++;
                                }

                                if (v_program != '' && v_program.length != 7) {
                                    $('#wprogram').html('Kode Akun harus 7 digit');
                                    $('#wprogram').fadeIn(200);
                                    jml++;
                                }

                                if (v_program != '' && !v_program.match(pattern)) {
                                    var wprogram = 'Kode Akun harus dalam bentuk angka!';
                                    $('#wprogram').html(wprogram);
                                    $('#wprogram').fadeIn(200);
                                    jml++;
                                }

                                if (v_tglawal > v_tglakhir) {
                                    $('#wtgl').html('Tanggal awal tidak boleh melebihi tanggal akhir');
                                    $('#wtgl').fadeIn(200);
                                    jml++;
                                }

                                if (jml > 0) {
                                    return false;
                                }
                            }
                            $(document).ready(function() {
                                var oTable = $('#example').dataTable({
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
                                    "table": document.getElementById('example'),
                                    "datatable": oTable
                                });
                            });
</script>