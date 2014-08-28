<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Data Pagu Minus <i>(Fund Fail)</i></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : fund_fail.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------	
	if(isset($this->d_nama_kppn) || isset($this->satker_code)){
		if (isset($this->d_nama_kppn)) {
			$kdkppn = $this->d_nama_kppn;
		} else {
			$kdkppn = Session::get('id_user');
		}
		if (isset($this->satker_code)) {
			$kdsatker = $this->satker_code;
		} else {
			$kdsatker = 'null';
		}

    ?>
    <a href="<?php echo URL; ?>PDF/Fund_fail_PDF/<?php echo $kdsatker . "/" . $kdkppn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

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
                } else {
                    echo Session::get('user');
                }
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

<!-- Blok Tabel -->
<div id="table-container" class="wrapper">
    <table width="100%" class="footable">
        <!--baris pertama-->
            <thead>
                <tr>
                    <th class='ratatengah'>No.</th>
                    <th class='ratatengah'>Tanggal Error</th>
                    <th class='ratatengah'>Satker</th>
                    <th class='ratatengah'>Kode KPPN</th>
                    <th class='ratatengah'>Akun</th>
                    <th class='ratatengah'>Program</th>
                    <th class='ratatengah'>Output</th>
                    <th class='ratatengah'>Dana</th>
                    <th class='ratatengah'>Description</th>
                    <th class='ratakanan'>Blokir/Kontrak</th>
                    <th class='ratakanan'>Realisasi</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=6 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td class='ratatengah'>" . $value->get_error_date() . "</td>";
                            echo "<td>" . $value->get_satker_code() . "</td>";
                            /*echo "<td><a href=" . URL . "dataDIPA/Detail_Fund_Fail_KD/" . $value->get_satker_code() . "/" . $value->get_output_code() . " target='_blank' '>" . $value->get_satker_code() . "</td>";*/
                            echo "<td>" . $value->get_kppn_code() . "</td>";
                            echo "<td>" . $value->get_account_code() . "</td>";
                            echo "<td>" . $value->get_program_code() . "</td>";
                            echo "<td>" . $value->get_output_code() . "</td>";
                            echo "<td>" . $value->get_dana_code() . "</td>";
                            $description = $value->get_description();
							if (substr($description,0,4) == 'Fund') {
								echo "<td><a href=" . URL . "dataDIPA/Detail_Fund_Fail_KD/1/" . $value->get_satker_code() . "/" . $value->get_output_code() . "/" .$value->get_account_code(). " target='_blank' '>" . $value->get_description() . "</td>";
							} else {
								echo "<td><a href=" . URL . "dataDIPA/Detail_Fund_Fail_KD/2/" . $value->get_satker_code() . "/" . $value->get_output_code() ."/" .$value->get_account_code(). " target='_blank' '>" . $value->get_description() . "</td>";
							}
							
							//echo "<td>" . $value->get_description() . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir_kontrak()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir_realisasi()) . "</td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo '<td colspan=6 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
                }
                ?>
            </tbody>
    </table>
</div>

<!-- Blok Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

                <div class="modal-body">
                    
	                <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display: none"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control"  type="text" name="kdkppn" id="kdkppn">
                            <option value='' selected>SEMUA KPPN</option>
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
                    <br/>
                    <div id="wakun" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Satker : </label>
                    <input class="form-control" type="text" name="kd_satker" id="kd_satker">
                        

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
</script>