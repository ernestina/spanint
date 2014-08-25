<div id="top">
    <div id="header">
        <h2>DETAIL DATA PAGU MINUS (FUND FAIL) <?php //echo Session::get('user');  ?>
            <?php
            if (isset($this->d_nama_kppn)) {
                foreach ($this->d_nama_kppn as $kppn) {
                    echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                    $kode_kppn = $kppn->get_kd_satker();
                }
            } else {
                echo Session::get('user');
            }
            ?>

        </h2>
    </div>
    <?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : fund_fail.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------	
	if(
	isset($this->data) || isset($this->d_nama_kppn)
	){
		if (isset($this->data)) {
			foreach ($this->data as $value1) {
			 $kdsatker=$value1->get_satker_code();
			$kdoutput=$value1->get_output_code();
			}
		}
	
		if (isset($this->d_nama_kppn)) {
			$kdkppn = $this->d_nama_kppn;
		} else {
			$kdkppn = Session::get('id_user');
		}

    ?>
    <ul class="inline" style="float: right"><li>
    <a href="<?php echo URL; ?>PDF/Detail_Fund_fail_kd_PDF/<?php echo $kdsatker . "/" . $kdoutput. "/" . $kdkppn; ?>" class="warning"><i class="icon icon-print icon-white"></i>PDF</a></li>

<?php
//----------------------------------------------------		

	
	}
?>

    <a href="#yModal" class="modal">FILTER DATA</a><br><br>
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
                    <label class="isian">Satker : </label>
                    <input type="text" name="kd_satker" id="kd_satker">

                    <!--div id="woutput" class="error"></div>
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
                    </ul-->

                    <ul class="inline"  style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                        <!--onClick="konfirm(); return false;"-->
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id="example" style="font-size: 90%">
            <!--baris pertama-->
            <thead>
            <th class='mid'>No.</th>
            <th class='mid'>Tanggal Error</th>
            <th class='mid'>Satker</th>
            <th>Kode KPPN</th>
            <th class='mid'>Akun</th>
            <th class='mid'>Program</th>
            <th class='mid'>Output</th>
            <th class='mid'>Dana</th>
            <!--th class='mid'>Description</th-->
            <th>Pagu Saat Ini</th>
            <th>Pagu Usulan Revisi</th>
            <th>Total Kontrak</th>
            <th>Blokir</th>
            <th>Realisasi</th>
            <th>Sisa/kurang</th>

            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Data Tidak ada karena akun sebelumnya menjadi hilang padahal sudah ada realisasi/kontrak .</div>";
                    } else {
                        $tot_budget = 0;
                        $tot_encumbrance = 0;
                        $tot_actual = 0;
                        $tot_blokir = 0;
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_error_date() . "</td>";
                            echo "<td>" . $value->get_satker_code() . "</td>";
                            echo "<td>" . $value->get_kppn_code() . "</td>";
                            echo "<td>" . $value->get_account_code() . "</td>";
                            echo "<td>" . $value->get_program_code() . "</td>";
                            echo "<td>" . $value->get_output_code() . "</td>";
                            echo "<td>" . $value->get_dana_code() . "</td>";
                            //echo "<td>" . $value->get_description() . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_pagu_semula()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_pagu_revisi()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir_kontrak()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir_realisasi()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_pagu_revisi() - $value->get_blokir_kontrak() - $value->get_blokir() - $value->get_blokir_realisasi()) . "</td>";
                            echo "</tr>	";
                            $tot_budget+=$value->get_pagu_revisi();
                            $tot_encumbrance+=$value->get_blokir_kontrak();
                            $tot_blokir+=$value->get_blokir();
                            $tot_actual+=$value->get_blokir_realisasi();
                        }
                    }
                }
                ?>
                <!--footernya ditaruh disini-->		
                <tr>
                    <td colspan='9' class='ratatengah'><b>GRAND TOTAL<b></td>
                                <td class='ratakanan'><b><?php echo number_format($tot_budget); ?></td>
                                <td class='ratakanan'><b><?php echo number_format($tot_encumbrance); ?></td>
                                <td class='ratakanan'><b><?php echo number_format($tot_blokir); ?></td>
                                <td class='ratakanan'><b><?php echo number_format($tot_actual); ?></td>
                                <td class='ratakanan'><b><?php echo number_format($tot_budget - $tot_encumbrance - $tot_blokir - $tot_actual); ?></td>
                                </tr>
                                <!--end footernya-->
                                </tbody>
                                <tfoot>

                                </tfoot>

                                </table>
                                <br>
                                <br>
                                <!--b><i>* Nilai Pagu Merupakan Pagu Awal DIPA, Untuk Melihat Sisa Pagu Tersedia Gunakan Menu Sisa Pagu Belanja Realisasi dan Encumbrance </i></b></br>
                                <b><i>* Data Merupakan Data Per Tanggal Sebelumnya Pukul 19.00 </i></b></br-->
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
                                                "fnServerData":getRows,
                                    },
                                });

                                var keys = new KeyTable({
                                    "table": document.getElementById('example'),
                                    "datatable": oTable
                                });
                            });
                                </script>