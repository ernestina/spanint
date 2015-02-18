<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataPelimpahan/monitoringPelimpahan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">			 
                <h2>Monitoring Rekap Penerimaan yang sudah Diinterface</h2>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">                
                <?php
				//---------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

				if (Session::get('role') == ADMIN || Session::get('role') == KANWIL || Session::get('role') == PKN) {

					if (isset($this->d_status)) {
							$kdstatus = $this->d_status;
					} else {
							$kdstatus = 'null';
					}
					if (isset($this->d_no_rek_persepsi)) {
							$kdnorek = $this->d_no_rek_persepsi;
					} else {
							$kdnorek = 'null';
					}
					if (isset($this->d_kppn_anak)) {
						$kdkppn_anak = $this->d_kppn_anak;
					} else {
						$kdkppn_anak = 'null';
					}
					if (isset($this->d_kppn_induk)) {
						$kdkppn_induk = $this->d_kppn_induk;
					} else {
						$kdkppn_induk = 'null';
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

			}

			if (Session::get('role') == KPPN) {
            

					if (isset($this->d_status)) {
						$kdstatus = $this->d_status;
					} else {
						$kdstatus = 'null';
					}
					if (isset($this->d_no_rek_persepsi)) {
							$kdnorek = $this->d_no_rek_persepsi;
					} else {
							$kdnorek = 'null';
					}

					if (isset($this->d_kppn_anak)) {
						$kdkppn_anak = $this->d_kppn_anak;
					} else {
						
						$kdkppn_anak = Session::get('id_user');			
					}
					if (isset($this->d_kppn_induk)) {
						$kdkppn_induk = 'null';
					} else {
						$kdkppn_induk = 'null';
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
				?>
			
					<?php }
					//------------------------------
        ?>
				<div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/monitoringPelimpahan_PDF/<?php echo $kdkppn_anak . "/" . $kdkppn_induk. "/" . $kdstatus . "/" .$kdnorek . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/monitoringPelimpahan_PDF/<?php echo $kdkppn_anak . "/" . $kdkppn_induk. "/" . $kdstatus . "/" .$kdnorek . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>
				 
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-md-6 col-sm-12">
                <?php
				if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                }
				?>
				<?php
				if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
					echo "<br>Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
				}
				
				?>
            </div>
            
            <div class="col-md-6 col-sm-12 align-right">
                <?php

                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "Update Data Terakhir (Waktu Server) : " . "<br>" . $last_update->get_last_update() . " WIB";
                    }
                }

                ?>
            </div>
            
        </div>
        
    </div>
</div>
    

<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable" >
        
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th colspan="2">KPPN Induk</th>
                <th colspan="2">KPPN Anak</th>
            </tr>
            <tr>
                <th >Transaksi</th>
                <th >Nilai <?php if($this->d_kd_kppn == '183'){ echo " (USD)";} ?></th>
                <th >Transaksi</th>
                <th >Nilai<?php if($this->d_kd_kppn == '183'){ echo " (USD)";} ?></th>
            </tr>
        </thead>
        
        <tbody class="align-center">
            
            <?php $no = 1; ?>

            <?php if (isset($this->data)) { ?>
            
                <?php if (empty($this->data)) { ?>
            
                    <td colspan=12 class="align-center">Tidak ada data.</td>
            
                <?php } else { ?>
            
                    <?php 
						foreach ($this->data as $value) {
                        if($this->d_kd_kppn == '183'){ $this->d_kd_kppn = "PNR";} ?>
                        
                        <tr>
                            <td ><?php echo $no++; ?></td>
                            <td class="align-left"><?php echo $value->get_tanggal_gl(); ?></td>
                            
                            <?php if ($value->get_trn_kbi()==0) { echo "<td>".number_format($value->get_trn_kbi())."</td>";} 
                                  else { echo "<td > <a href=" . URL . "dataGR/detailLhpRekap/" . date('Ymd', strtotime($value->get_tanggal_gl())) . "/".$this->d_kd_kppn." >" . number_format($value->get_trn_kbi()) . "</a>";} ?></td>
                            <td class="align-right"><?php echo number_format($value->get_rph_kbi()); ?></td>
                            <?php if ($value->get_trn_non_kbi()==0) { echo "<td>".number_format($value->get_trn_non_kbi())."</td>";                             } else { if($this->kdkcbi==3) { echo "<td ><a href=" . URL . "dataGR/detailLhpRekap/" . date('Ymd', strtotime($value->get_tanggal_gl())) . "/".$this->d_kd_kppn." >" . number_format($value->get_trn_non_kbi()) . "</a>";} else {echo "<td>".number_format($value->get_trn_non_kbi()); }} ?></td>
                            <td class="align-right"><?php echo number_format($value->get_rph_non_kbi()); ?></td>
                        </tr>
            
            <?php }
                } ?>
            
            <?php } else { ?>
                
                <td colspan=12 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>
            
            <?php } ?>
            
        </tbody>
    </table>
</div>

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-0" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="MpnBi" enctype="multipart/form-data">

                <div class="modal-body">
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class='alert alert-danger' style='display:none;'></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            <?php
                            foreach ($this->kppn_list as $value1) {
                                if ($this->d_kd_kppn == $value1->get_kd_d_kppn()) {
                                    echo "<option value='" . $value1->get_kd_d_kppn() . "' selected>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
                                } else {
                                    echo "<option value='" . $value1->get_kd_d_kppn() . "'>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
                                }
                            }
                            ?>
                        </select>
                    <?php } ?>
                    <br/>
                    
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal LHP: </label>
                    
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)) { echo $this->d_tgl_awal; } ?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)) { echo $this->d_tgl_akhir; } ?>">
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

    function hideErrorId() {
        $('.alert-danger').fadeOut(0);
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
        var v_no_rek_persepsi = document.getElementById('no_rek_persepsi').value;

        var jml = 0;
        
        if (v_tglawal == '' && v_tglakhir == '' && v_no_rek_persepsi = '') {
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

</script>