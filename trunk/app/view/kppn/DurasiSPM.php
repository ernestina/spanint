<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Durasi Penyelesaian SP2D</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <!--pdf-->
				                <?php
	                //----------------------------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
                if (Session::get('role') == KANWIL) {
                    IF(isset($this->d_nama_kppn) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							}
						}else{
							$kdkppn ='null';
						} 
						if (isset($this->d_tgl_awal)) {
							$kdtgl_awal = $this->d_tgl_awal;
						} else {
							$kdtgl_awal='null';
						}
						if (isset($this->d_tgl_akhir)) {
							$kdtgl_akhir = $this->d_tgl_akhir;
						} else {
							$kdtgl_akhir ='null';
						}						
						if (isset($this->d_invoice)) {
							$invoice = $this->d_invoice;
						} else {
							$invoice ='null';
						}
						if (isset($this->d_kdsatker)) {
							$kdsatker = $this->d_kdsatker;
						} else {
							$kdsatker ='null';
						}						
						if (isset($this->d_jendok)) {
							$jenisspm = $this->d_jendok;
						} else {
							$jenisspm ='null';
						}
						if (isset($this->d_durasi)) {
							$durasi = $this->d_durasi;
						} else {
							$durasi ='null';
						}
					?>
									
					<a href="<?php echo URL; ?>PDF/DurasiSpm_PDF/<?php echo $kdkppn . "/" . $invoice . "/" . $jenisspm . "/" . $durasi . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

					<?php
					}
                }
                if (Session::get('role') == ADMIN) {
                    IF(isset($this->d_nama_kppn) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							}
						} 
						if (isset($this->d_tgl_awal)) {
							$kdtgl_awal = $this->d_tgl_awal;
						} else {
							$kdtgl_awal='null';
						}
						if (isset($this->d_tgl_akhir)) {
							$kdtgl_akhir = $this->d_tgl_akhir;
						} else {
							$kdtgl_akhir ='null';
						}
						
						if (isset($this->d_invoice)) {
							$invoice = $this->d_invoice;
						} else {
							$invoice ='null';
						}
						if (isset($this->d_kdsatker)) {
							$kdsatker = $this->d_kdsatker;
						} else {
							$kdsatker ='null';
						}
						
						if (isset($this->d_jendok)) {
							$jenisspm = $this->d_jendok;
						} else {
							$jenisspm ='null';
						}
						if (isset($this->d_durasi)) {
							$durasi = $this->d_durasi;
						} else {
							$durasi ='null';
						}
						
						
						
					?>
									
					<a href="<?php echo URL; ?>PDF/DurasiSpm_PDF/<?php echo $kdkppn . "/" . $invoice . "/" . $jenisspm . "/" . $durasi . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

					<?php
					}
                }
				
                if (Session::get('role') == KPPN) {
                  
						
						$kdkppn = Session::get('id_user');
						
						if (isset($this->d_tgl_awal)) {
							$kdtgl_awal = $this->d_tgl_awal;
						} else {
							$kdtgl_awal='null';
						}
						if (isset($this->d_tgl_akhir)) {
							$kdtgl_akhir = $this->d_tgl_akhir;
						} else {
							$kdtgl_akhir ='null';
						}
						
						if (isset($this->d_invoice)) {
							$invoice = $this->d_invoice;
						} else {
							$invoice ='null';
						}
						if (isset($this->d_kdsatker)) {
							$kdsatker = $this->d_kdsatker;
						} else {
							$kdsatker ='null';
						}						
						if (isset($this->d_jendok)) {
							$jenisspm = $this->d_jendok;
						} else {
							$jenisspm ='null';
						}
						if (isset($this->d_durasi)) {
							$durasi = $this->d_durasi;
						} else {
							$durasi ='null';
						}

					?>
									
					<a href="<?php echo URL; ?>PDF/DurasiSpm_PDF/<?php echo $kdkppn . "/" . $invoice . "/" . $jenisspm . "/" . $durasi . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

					<?php
					}
					
                
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
                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                }
                if (isset($this->d_invoice)) {
                    echo "<br>No. Invoice : ".$this->d_invoice;
                }
                if (isset($this->d_kdsatker)) {
                    echo "<br>Satker : ".$this->d_kdsatker;
                }
                if (isset($this->d_jendok)) {
                    echo "<br>Jenis SPM : ".$this->d_jendok;
                }
                if (isset($this->d_durasi)) {
                    if($this->d_durasi==1){
                        echo "<br>Durasi : Kurang dari 1 jam";
                    }else if($this->d_durasi==2){
                        echo "<br>Durasi : Lebih dari 1 jam";
                    } else if($this->d_durasi==3){
                        echo "<br>Durasi : Lebih dari 1 hari";
                    }
                }
                if (isset($this->d_tgl_awal)&&isset($this->d_tgl_akhir)) {
                    echo "<br>Tanggal : ".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
                }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) :<br> " . $last_update->get_last_update() . " WIB";
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
                    <th>No.</th>
                    <th>Nomor Invoice</th>
                    <th>Nomor SP2D</th>
                    <!--th>KPPN</th-->
                    <th>Jenis SPM</th>
                    <th>Tanggal Upload</th>
                    <!--th>Jam Upload</th-->
                    <th>Tanggal Selesai SP2D</th>
                    <!--th>Jam Selesai SP2D</th-->
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=7 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td><a href=" . URL . "dataSPM/HistorySpm/" . $value->get_invoice_num() . "/" . $value->get_check_number() . " >" . $value->get_invoice_num() . "</a></td>";
                            echo "<td>" . $value->get_check_number() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_attribute1() . "</td>";
                            echo "<td>" . strtoupper($value->get_aia_creation_date()) . ' ' . $value->get_jam_upload() . "</td>";
                            //echo "<td>" . $value->get_jam_upload() . "</td>";
                            echo "<td>" . $value->get_aca_creation_date() . ' ' . $value->get_jam_selesai_sp2d() . "</td>";
                            //echo "<td>" . $value->get_jam_selesai_sp2d() . "</td>";
                            
                            echo "<td>" . $value->get_durasi() . "</td>";

                            echo "</tr>	";
                        }
                    }
                } else {
                    echo '<td colspan=7 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
                }
                ?>
            </tbody>
    </table>
</div>

<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="DurasiSpm" enctype="multipart/form-data">

                <div class="modal-body">

                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
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
                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Jenis SPM: </label>
                    <select class="form-control" type="text" name="JenisSPM" id="JenisSPM">
                        <option value='' selected>- pilih -</option>
                        <?php
                        foreach ($this->data2 as $value1)
                            if ($value1->get_attribute1()==$this->d_jendok){
                                echo "<option value = '" . $value1->get_attribute1() . "' selected>" . $value1->get_attribute1() . "</option>";
                            } else {
                                echo "<option value = '" . $value1->get_attribute1() . "'>" . $value1->get_attribute1() . "</option>";
                            }
                       
                        ?>
                    </select>
                    <br/>
                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Durasi: </label>	
                    <select class="form-control" type="text" name="durasi" id="durasi">
                        <option value=''>- pilih -</option>
                        <option value="1" <?php if ($this->d_durasi == "1") {
                            echo "selected";
                        } ?>>Kurang dari satu jam</option>
                        <option value="2" <?php if ($this->d_durasi == "2") {
                            echo "selected";
                        } ?>>Lebih dari satu jam</option>
                        <option value="3" <?php if ($this->d_durasi == "3") {
                            echo "selected";
                        } ?>>Lebih dari satu hari</option>

                    </select>
                    <br/>
                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">No Invoice: </label>
                    <input class="form-control" type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)) {
                            echo $this->d_invoice;
                        } ?>">
                    <br/>
                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->d_kdsatker)) {
                            echo $this->d_kdsatker;
                        } ?>">
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
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
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
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
        var v_invoice = document.getElementById('invoice').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;
        var v_JenisSPM = document.getElementById('JenisSPM').value;
        var v_durasi = document.getElementById('durasi').value;
        var v_kdsatker = document.getElementById('kdsatker').value;


        var jml = 0;
        if (v_invoice == '' && v_tglawal == '' && v_tglakhir == '' && v_JenisSPM == '' && v_durasi == '' && v_kdsatker == '') {
            $('#winvoice').html('Harap isi salah satu parameter');
            $('#winvoice').fadeIn();
            $('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>