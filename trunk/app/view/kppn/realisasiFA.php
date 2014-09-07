<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Informasi Sisa Pagu Per Akun DIPA Satker</h2>
				<?php //echo 'kdakun:'.$value->get_akun(); ?>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

	$kdakun1 = $this->account_code1;	
	if (Session::get('role') == ADMIN || Session::get('role') == KANWIL  || Session::get('role') == KPPN) {
	
	 
			 if (isset($this->account_code)) {	 
				$kdakun = $this->account_code;		
			}else{
				if (isset($this->data)) {
					 foreach ($this->data as $value) {
						$kdakun =$value->get_akun();
					}
				}
			}
			if (isset($this->program_code)) {
				$kdprogram = $this->program_code;
			}else{
				if (isset($this->data)) {
					foreach ($this->data as $value) {
						$kdprogram =$value->get_program();
					}
				}
			}
			if (isset($this->output_code)) {
				$kdoutput = $this->output_code;
			}else{
				if (isset($this->data)) {
					 foreach ($this->data as $value) {
						$kdoutput =$value->get_output();
					}
				}
			}
			if (isset($this->satker_code)) {
				$kdsatker = $this->satker_code;
			}else{
				if (isset($this->data)) {
					foreach ($this->data as $value) {
						$kdsatker =$value->get_satker();
					}
				}
			}
			?>
				<a href="<?php echo URL; ?>PDF/RealisasiFA_PDF/<?php echo $kdsatker . "/" . $kdprogram . "/" . $kdoutput . "/" . $kdakun . "/" . $kdakun1; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
			<?php
	
	}
	
	if (Session::get('role') == SATKER) {
			 if (isset($this->account_code)) {	 
				$kdakun = $this->account_code;		
			}else{
				if (isset($this->data)) {
					 foreach ($this->data as $value) {
						$kdakun =$value->get_akun();
					}
				}
			}
			if (isset($this->program_code)) {
				$kdprogram = $this->program_code;
			}else{
				if (isset($this->data)) {
					foreach ($this->data as $value) {
						$kdprogram =$value->get_program();
					}
				}
			}
			if (isset($this->output_code)) {
				$kdoutput = $this->output_code;
			}else{
				if (isset($this->data)) {
					 foreach ($this->data as $value) {
						$kdoutput =$value->get_output();
					}
				}
			}

					$kdsatker =Session::get('kd_satker');
			?>
				<a href="<?php echo URL; ?>PDF/RealisasiFA_PDF/<?php echo $kdsatker . "/" . $kdprogram . "/" . $kdoutput . "/" . $kdakun . "/" . $kdakun1; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
			<?php
	
	
	}

	if (Session::get('role') == DJA) {
			
			 if (isset($this->account_code)) {	 
				$kdakun = $this->account_code;		
			}else{
				if (isset($this->data)) {
					 foreach ($this->data as $value) {
						$kdakun =$value->get_akun();
					}
				}
			}
			if (isset($this->program_code)) {
				$kdprogram = $this->program_code;
			}else{
				if (isset($this->data)) {
					foreach ($this->data as $value) {
						$kdprogram =$value->get_program();
					}
				}
			}
			if (isset($this->output_code)) {
				$kdoutput = $this->output_code;
			}else{
				if (isset($this->data)) {
					 foreach ($this->data as $value) {
						$kdoutput =$value->get_output();
					}
				}
			}
			if (isset($this->satker_code)) {
				$kdsatker = $this->satker_code;
			}else{
				if (isset($this->data)) {
					foreach ($this->data as $value) {
						$kdsatker =$value->get_satker();
					}
				}
			}

			?>
				<a href="<?php echo URL; ?>PDF/RealisasiFA_PDF/<?php echo $kdsatker . "/" . $kdprogram . "/" . $kdoutput . "/" . $kdakun . "/" . $kdakun1; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
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
                        $kdsatker = $value->get_satker();
                    }

                    echo $nmsatker;
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
                <th class='ratatengah'>No.</th>
                <th class='ratatengah'>Satker</th>
                <th class='ratatengah'>KPPN</th>
                <th class='ratatengah'>Akun</th>
                <th class='ratatengah'>Program</th>
                <th class='ratatengah'>Output</th>
                <th class='ratatengah'>Dana</th>
                <!--th class='mid'>Bank</th-->
                <th>Kewenangan</th>
                <th class='ratatengah'>Lokasi</th>
                <th class='ratatengah'>Tipe Anggaran</th>
                <!--th>Mata Uang</th-->
                <th class='ratakanan'>Pagu</th>
                <th class='ratakanan'>Pencadangan</th>
                <th class='ratakanan'>Realisasi</th>
                <th class='ratakanan'>Sisa pagu</th>
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
                    '<td colspan=12 align="center">Tidak ada data.</td>';
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
                        echo "<td>" . $value->get_akun() . "</td>";
                        echo "<td>" . $value->get_program() . "</td>";
                        echo "<td>" . $value->get_output() . "</td>";
                        echo "<td>" . $value->get_dana() . "</td>";
                        //echo "<td>" . $value->get_bank() . "</td>";
                        echo "<td>" . $value->get_kewenangan() . "</td>";
                        echo "<td>" . $value->get_lokasi() . "</td>";
                        echo "<td>" . $value->get_budget_type() . "</td>";
                        //echo "<td>" . $value->get_currency_code() . "</td>";
                        echo "<td style='text-align: right'>" . number_format($value->get_budget_amt()) . "</td>";
                        echo "<td style='text-align: right'><a href=" . URL . "dataDIPA/DetailEncumbrances/" . $value->get_code_id() . " target='_blank' '>" . number_format($value->get_encumbrance_amt()) . "</td>";
                        echo "<td style='text-align: right'><a href=" . URL . "dataDIPA/DetailRealisasiFA/" . $value->get_code_id() . " target='_blank' '>" . number_format($value->get_actual_amt()) . "</td>";

                        echo "<td style='text-align: right'>" . number_format($value->get_balancing_amt()) . "</td>";
                        echo "</tr>	";
                        $tot_budget+=$value->get_budget_amt();
                        $tot_encumbrance+=$value->get_encumbrance_amt();
                        $tot_actual+=$value->get_actual_amt();
                        $tot_balancing+=$value->get_balancing_amt();
						 ?>
                        <tr>
                            <td colspan='10' class='ratatengah'><b>GRAND TOTAL</b></td>
                            <td class='ratakanan'><b><?php echo number_format($tot_budget); ?></b></td>
                            <td class='ratakanan'><b><?php echo number_format($tot_encumbrance); ?></b></td>
                            <td class='ratakanan'><b><?php echo number_format($tot_actual); ?></b></td>
                            <td class='ratakanan'><b><?php echo number_format($tot_balancing); ?></b></td>
                        </tr>
                        <?php
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
            
            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

                <div class="modal-body">
                    
                <!-- Paste Isi Fom mulai nangkene -->
                <?php
                //if (Session::get('role')!=SATKER) {
                //echo "<div id='wkdsatker' class='error'></div>";
                //echo "<label class='isian'>Satker: </label>";
                //} 
                ?>
                <!--input type="<?php //if (Session::get('role')==SATKER) {echo "hidden";} else {echo "text";}?>" name="kdsatker" id="kdsatker" value="<?php //if (isset($this->satker_code)){echo $this->satker_code;}?>"-->

                <div id="wakun" class='alert alert-danger' style='display:none;'></div>
                <label class="isian">Akun: </label>
                <input class='form-control' type="text" name="akun" id="akun" value="<?php if (isset($this->account_code)) {
                    echo $this->account_code;
                } ?>">

                <div id="woutput" class='alert alert-danger' style='display:none;'></div>
                <label class="isian">Output : </label>
                <input class='form-control' type="text" name="output" id="output">

                <div id="wprogram" class='alert alert-danger' style='display:none;'></div>
                <label class="isian">Program : </label>
                <input class='form-control' type="text" name="program" id="program">

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
            $('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
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

<div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <b>Keterangan : </b></br>
                Data Merupakan Data Per Tanggal Sebelumnya Pukul 19.00 
            </div>
            
        </div>
    </div>
</div>