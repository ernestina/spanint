<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Data Revisi DIPA</h2>
            </div>
             
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
    <?php
	 //----------------------------------------------------
	//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : revisiDIPA.php  
	
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
		$kdsatker =Session::get('kd_satker');
    }
	if (isset($this->revisi)) {
        $kdrevisi = $this->revisi;
       
    } else {
        $kdrevisi = 'null';
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
        
        <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/RevisiDipa_PDF/<?php echo $kdsatker . "/" . $kdrevisi . "/" . $kdakun . "/" . $kdoutput . "/" . $kdprogram . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/RevisiDipa_PDF/<?php echo $kdsatker . "/" . $kdrevisi . "/" . $kdakun . "/" . $kdoutput . "/" . $kdprogram . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/XLS">EXCEL</a></li>
                          </ul>
        </div>

		<?php
//----------------------------------------------------			

        ?>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
           
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->satker_code)) {
                    echo "Satker : ".$this->satker_code;
                }
                if (isset($this->account_code)) {
                    echo "<br>Akun : ".$this->account_code;
                }
                if (isset($this->output_code)) {
                    echo "<br>Output : ".$this->output_code;
                }
                if (isset($this->program_code)) {
                    echo "<br>Program : ".$this->program_code;
                }
                if (isset($this->d_tgl_awal)&&isset($this->d_tgl_akhir)) {
                    echo "<br>Tanggal : ".$this->d_tgl_awal. " s.d ".$this->d_tgl_akhir;
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
                    <th class='mid'>No.</th>
                    <th>Nomor DIPA</th>
                    <th class='mid'>Revisi Ke</th>
                    <th class='mid'>Tanggal Post Revisi</th>
                    <th class='align-right'>Pagu</th>
                    <th class='mid'>Satker</th>
                    <th class='mid'>Akun</th>
                    <th class='mid'>Program</th>
                    <th class='mid'>Output</th>
                    <th class='mid'>Dana</th>
                    <th class='mid'>Bank</th>
                    <th class='mid'>Kewenangan</th>
                    <th class='mid'>Tipe Anggaran</th>
                    <th class='mid'>Kololari</th>
                    <th class='mid'>Kode Cadangan</th>
                </tr>

            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
				$total_dipa = 0 ;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=6 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_dipa_no() . "</td>";
                            echo "<td>" . $value->get_revision_no() . "</td>";
                            echo "<td>" . $value->get_tanggal_posting_revisi() . ' ' . $value->get_jam_posting_revisi() . "</td>";
                            //echo "<td>" . $value->get_jam_posting_revisi() . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_line_amount()) . "</td>";
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
							
							$total_dipa += $value->get_line_amount();
                        }
                    }
                } else {
                    echo '<td colspan=6 align="center">Silahkan masukkan filter terlebih dahulu.</td>';
                }
                ?>
            </tbody>
			
			<tfoot>
			<tr>
                    <td colspan='4' rowspan=2 class='ratatengah'><b>GRAND TOTAL<b></td>
					<td align='right'><b> <?php echo number_format($total_dipa) ;?> </b> </td>
					<td colspan='10' rowspan=2 class='ratatengah'></td>
            </tr>
			
			</tfoot>
			
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
	                <div id="wakun" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Akun : </label>
                    <input class="form-control" type="text" name="akun" id="akun" value="<?php if (isset($this->account_code)) {echo $this->account_code;}?>">
                    <br/>
                    <div id="woutput" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Output : </label>
                    <input class="form-control" type="text" name="output" id="output" value="<?php if (isset($this->account_code)) {echo $this->output_code;}?>">
                    <br/>
                    <div id="wprogram" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Program : </label>
                    <input class="form-control" type="text" name="program" id="program" value="<?php if (isset($this->account_code)) {echo $this->program_code;}?>">
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display: none"></div>
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
    
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy'
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