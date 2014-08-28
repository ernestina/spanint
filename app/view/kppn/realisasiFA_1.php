<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Informasi Sisa Dana DIPA Satker</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
    <?php
    //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : realisasiFA_1.php  
if (Session::get('role') == SATKER) {
	foreach ($this->data as $value) {
		$kdsatker=$value->get_satker();
		$kdkppn=$value->get_kppn();
	}
} else {
	$kdsatker=Session::get('kd_satker');
}
if (Session::get('role') == KPPN) {
	$kdkppn=Session::get('id_user');
}
if (Session::get('role') == KANWIL || Session::get('role') == ADMIN ) {

	foreach ($this->data as $value) {
		$kdsatker=$value->get_satker();
		$kdkppn=$value->get_kppn();
	}

	$filter[$no++] = "A.KPPN IN (SELECT KDKPPN FROM T_KPPN WHERE KDKANWIL = '" . Session::get('id_user') . "')";
}


if(isset($this->account_code) || isset($this->program_code) || isset($this->output_code)){
	

   if (isset($this->account_code)) {
        $kdakun = $this->account_code;
    }else{
		$kdakun = 'null';
	}
    if (isset($this->program_code)) {
        $kdprogram = $this->program_code;
    }else{
		$kdprogram = 'null';
	}

    if (isset($this->output_code)) {
        $kdoutput = $this->output_code;
    }else{
		$kdoutput = 'null';
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
<a href="<?php echo URL; ?>PDF/RealisasiFA_1_PDF/<?php echo $kdsatker . "/" . $kdkppn . "/" . $kdakun . "/" . $kdprogram . "/" . $kdoutput; ?>" class="warning"><i class="icon icon-print icon-white"></i>PDF</a></li>
		<?php
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
                $nmsatker = '';
                foreach ($this->data as $value) {
                    $nmsatker = $value->get_nm_satker();
                }
                echo $nmsatker;
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server)<br/>" . $last_update->get_last_update() . " WIB";
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
                    <th class='mid'>No.</th>
                    <th class='mid'>Satker</th>
                    <th class='mid'>KPPN</th>
                    <th class='mid'>Akun Summary</th>
                    <th class='mid'>Program</th>
                    <th class='mid'>Output</th>
                    <th class='mid'>Dana</th>
                    <!--th class='mid'>Bank</th-->
                    <th>Kewenangan</th>
                    <!--th class='mid'>Lokasi</th>
                    <th class='mid'>Tipe Anggaran</th>
                    <th>Mata Uang</th-->
                    <th>Pagu</th>
                    <th>Pencadangan</th>
                    <th>Realisasi</th>
                    <th>Sisa pagu</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //$tot_budget=0;
                //$tot_actual=0;
                //$tot_encumbrance=0;
                //$tot_balancing=0;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    } else {
                        $tot_budget = 0;
                        $tot_encumbrance = 0;
                        $tot_actual = 0;
                        $tot_balancing = 0;
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_satker() . "</td>";
                            echo "<td>" . $value->get_kppn() . "</td>";
                            echo "<td style='text-align: right'><a href=" . URL . "dataDIPA/RealisasiFA/" . $value->get_satker() . "/" . $value->get_program() . "/" . $value->get_output() . "/" . $value->get_akun() . " target='_blank' '>" . $value->get_akun() . "</td>";
                            echo "<td>" . $value->get_program() . "</td>";
                            echo "<td>" . $value->get_output() . "</td>";
                            echo "<td>" . $value->get_dana() . "</td>";
                            //echo "<td>" . $value->get_bank() . "</td>";
                            echo "<td>" . $value->get_kewenangan() . "</td>";
                            //echo "<td>" . $value->get_lokasi() . "</td>";
                            //echo "<td>" . $value->get_budget_type() . "</td>";
                            //echo "<td>" . $value->get_currency_code() . "</td>";
                            echo "<td style='text-align: right'>" . number_format($value->get_budget_amt()) . "</td>";
                            echo "<td style='text-align: right'> " . number_format($value->get_encumbrance_amt()) . "</td>";
                            echo "<td style='text-align: right'> " . number_format($value->get_actual_amt()) . "</td>";

                            echo "<td style='text-align: right'>" . number_format($value->get_balancing_amt()) . "</td>";
                            echo "</tr>	";
                            $tot_budget+=$value->get_budget_amt();
                            $tot_encumbrance+=$value->get_encumbrance_amt();
                            $tot_actual+=$value->get_actual_amt();
                            $tot_balancing+=$value->get_balancing_amt();
                        }
                    }
                } else {
                    echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='8' class='ratatengah'><b>GRAND TOTAL<b></td>
                                <td class='ratakanan'><?php echo number_format($tot_budget); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_encumbrance); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_actual); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_balancing); ?></td>
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
                    <?php
                    //if (Session::get('role')!=SATKER) {
                    //echo "<div id='wkdsatker' class='error'></div>";
                    //echo "<label class='isian'>Satker: </label>";
                    //} 
                    ?>
                    <!--input type="<?php //if (Session::get('role')==SATKER) {echo "hidden";} else {echo "text";} ?>" name="kdsatker" id="kdsatker" value="<?php //if (isset($this->satker_code)){echo $this->satker_code;} ?>"-->

                    <div id="wakun" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Akun: </label>
                    <input class="form-control" type="text" name="akun" id="akun" value="<?php if (isset($this->account_code)) {
                        echo $this->account_code;
                    } ?>">

                    <div id="woutput" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Output : </label>
                    <input class="form-control" type="text" name="output" id="output">

                    <div id="wprogram" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Program : </label>
                    <input class="form-control" type="text" name="program" id="program">

                    <!--<div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal: </label>
                    <ul class="inline">
                    <li><input type="text" class="tanggal" name="tgl_awal" id="datepicker2" value="<?php if (isset($this->d_tgl_awal)) {
                        echo $this->d_tgl_awal;
                    } ?>" /> </li> <li>s/d</li>
                    <li><input type="text" class="tanggal" name="tgl_akhir" id="datepicker3" value="<?php if (isset($this->d_tgl_akhir)) {
                        echo $this->d_tgl_akhir;
                    } ?>"></li>
                    </ul>--->

                    <!--ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                    </ul-->
                    <!--End-->
                        

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
        $('#kdsatker').change(function() {
            if (document.getElementById('kdsatker').value != '') {
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

        /*$('#datepicker2').change(function() {
            if (document.getElementById('datepicker2').value != '' && document.getElementById('datepicker3').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

        $('#datepicker3').change(function() {
            if (document.getElementById('datepicker2').value != '' && document.getElementById('datepicker3').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

    }*/

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_kdsatker = document.getElementById('kdsatker').value;
        var v_akun = document.getElementById('akun').value;
        var v_tglawal = document.getElementById('datepicker2').value;
        var v_tglakhir = document.getElementById('datepicker3').value;

        var jml = 0;
        if (v_kdsatker == '' && v_akun == '' && v_output == '' && v_program == '' && v_tglawal == '' && v_tglakhir == '') {
            $('#wkdsatker').html('Harap isi salah satu parameter');
            $('#wkdsatker').fadeIn();
            $('#wakun').html('Harap isi salah satu parameter');
            $('#wakun').fadeIn();
            $('#woutput').html('Harap isi salah satu parameter');
            $('#woutput').fadeIn();
            $('#wprogram').html('Harap isi salah satu parameter');
            $('#wprogram').fadeIn();
            $('#woutput').html('Harap isi salah satu parameter');
            $('#woutput').fadeIn();
            $('#wprogram').html('Harap isi salah satu parameter');
            $('#wprogram').fadeIn();
            //$('#wtgl').html('Harap isi salah satu parameter');
            //$('#wtgl').fadeIn();
            jml++;
        }

        if (v_kdsatker != '' && v_kdsatker.length != 6) {
            $('#wkdsatker').html('Kode Satker harus 6 digit');
            $('#wkdsatker').fadeIn(200);
            jml++;
        }

        if (v_kdsatker != '' && !v_kdsatker.match(pattern)) {
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
</script>