<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataPelimpahan/monitoringPelimpahan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">			 
                <h2>Monitoring Pelimpahan</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <?php
				//---------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

				if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {

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
				<a href="<?php echo URL; ?>PDF/monitoringPelimpahan_PDF/<?php echo $kdkppn_anak . "/" . $kdkppn_induk. "/" . $kdstatus . "/" .$kdnorek . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-print"></span> PDF</a>
                               
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
            
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-md-6 col-sm-12">
                <?php
				if (isset($this->d_kppn_induk)) {
					echo "Dari - Ke KPPN : " . $this->d_kppn_induk . " - " ;
				}
				?>
				<?php
				if (isset($this->d_kppn_anak)) {
					echo $this->d_kppn_anak . "<br/>";
				}
				?>
				<?php
				if (isset($this->d_status)) {
					echo "Status : " . $this->d_status . "<br/>";
				}
				?>
				<?php
				if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
					echo "Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
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
    <table class="footable">
        
        <thead>
            <tr>
                <th rowspan="2" >No.</th>
                <th colspan="6" >Pencatatan Pelimpahan oleh KPPN</th>
                <th colspan="6" >Penerimaan pada Rekening Sub RKUN 501</th>
                <th rowspan="2">Status Limpah</th>
            </tr>
            <tr>
                <th class="align-left">No. Rekening<br>Nama Rekening</th>
                <th class="align-center" width='100px'>Tanggal</th>
                <th class="align-center">No. Sakti</th>
                <th class="align-right">Nilai</th>
                <th class="align-center">Akun</th>
                <th class="align-center">Kode KPPN </th>
                <th class="align-center">No. Rekening<br>Nama Rekening</th>
                <th class="align-center" width='100px'>Tanggal</th>
                <th class="align-center">No. Sakti</th>
                <th class="align-center">Nilai</th>
                <th class="align-center">Akun</th>
                <th class="align-center">Kode KPPN </th>
            </tr>
        </thead>
        
        <tbody style='font-size: 94%'>
            
            <?php $no = 1; ?>

            <?php if (isset($this->data)) { ?>
            
                <?php if (empty($this->data)) { ?>
            
                    <td colspan=12 class="align-center">Tidak ada data.</td>
            
                <?php } else { ?>
            
                    <?php 
						$terima = 0;
						$limpah = 0;
						foreach ($this->data as $value) { ?>
                        
                        <tr>
                            <td class="align-center"><?php echo $no++; ?></td>
                            <td class="align-left"><?php echo $value->get_norek_persepsi(); ?><br><?php echo $value->get_nmrek_persepsi(); ?></td>
                            <td class="align-center"><?php echo $value->get_tgl_limpah(); ?></td>
                            <td class="align-center"><?php echo $value->get_nosakti_limpah(); ?></td>
                            <td class="align-right"><?php echo number_format($value->get_jml_limpah()); ?></td>
                            <td class="align-center"><?php echo $value->get_akun_limpah(); ?></td>
                            <td class="align-center"><?php echo $value->get_kppn_anak(); ?></td>
                            <td class="align-center"><?php echo $value->get_norek_501(); ?><br><?php echo $value->get_nmrek_501(); ?></td>
                            <td class="align-center"><?php echo $value->get_tgl_terima(); ?></td>
                            <td class="align-center"><?php echo $value->get_nosakti_bs(); ?></td>
                            <td class="align-right"><?php echo number_format($value->get_jml_terima()); ?></td>
                            <td class="align-center"><?php echo $value->get_akun_terima(); ?></td>
                            <td class="align-center"><?php echo $value->get_kppn_induk(); ?></td>
                            <td class="align-center"><?php echo $value->get_status(); ?></td>
                        </tr>
            
                    <?php 
						$terima += $value->get_jml_terima();
						$limpah += $value->get_jml_limpah();
						} ?>
            
                <?php } ?>
            
            <?php } else { ?>
                
                <td colspan=12 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>
            
            <?php } ?>
            
        </tbody>
		<tfoot>
            <tr>
				<td class='ratatengah'><b><b></td>
                <td colspan='3' class='ratatengah'><b>GRAND TOTAL<b></td>
                <td class='ratakanan'><?php echo number_format($limpah); ?></td>
                <td colspan='2' class='ratatengah'><b><b></td>
                <td colspan='3' class='ratatengah'><b>GRAND TOTAL<b></td>
                <td class='ratakanan'><?php echo number_format($terima); ?></td>
                <td colspan='2' class='ratatengah'><b><b></td>
				<td class='ratatengah'><b><b></td>
            </tr>
        </tfoot>
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
            
            <form id="filter-form" method="POST" action="monitoringPelimpahan" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <?php if (count($this->kppn_anak)>1) { ?>
                    
                        <div id="wkppn_anak" class="alert alert-danger" style="display: none"></div>
                        <label class="isian">KPPN Anak: </label>
                    
                        <select class="form-control" type="text" name="kppn_anak" id="kppn_anak">  
                            
                            <option value='SEMUA' <?php if ($this->d_status == 'SEMUA') { echo 'selected'; } ?>>SEMUA</option>

                            <?php foreach ($this->kppn_anak as $value2) { ?>
                            
                                <?php if ($this->d_kppn_anak == $value2->get_kd_d_kppn()) { ?>
                            
                                    <option value="<?php echo $value2->get_kd_d_kppn(); ?>" selected><?php echo $value2->get_kd_d_kppn(); ?> | <?php echo $value2->get_nama_user(); ?></option>
                            
                                <?php } else { ?>
                            
                                    <option value="<?php echo $value2->get_kd_d_kppn(); ?>" ><?php echo $value2->get_kd_d_kppn(); ?> | <?php echo $value2->get_nama_user(); ?></option>
                            
                                <?php } ?>
                            
                            <?php } ?>

                        </select>  
                    
                        <br/>
                    
				    <?php }?>
					
					<?php if (isset($this->kppn_induk)) { ?>
                    
                        <div id="wkppn_induk" class="alert alert-danger" style="display: none"></div>
                        <label class="isian">KPPN Induk: </label>
                    
                        <select class="form-control" type="text" name="kppn_induk" id="kppn_induk">
                            
                            <option value="SEMUA" <?php if ($this->d_status == 'SEMUA') {echo 'selected';} ?>>SEMUA</option>

                            <?php foreach ($this->kppn_induk as $value3) { ?>
                            
                                <?php if ($this->d_kppn_induk == $value3->get_kd_d_kppn()) { ?>
                            
                                    <option value="<?php echo $value3->get_kd_d_kppn(); ?>" selected><?php echo $value3->get_kd_d_kppn(); ?> | <?php echo $value3->get_nama_user(); ?></option>
                            
                                <?php } else { ?>
                            
                                    <option value="<?php echo $value3->get_kd_d_kppn(); ?>" ><?php echo $value3->get_kd_d_kppn(); ?> | <?php echo $value3->get_nama_user(); ?></option>
                            
                                <?php } ?>
                            
                            <?php } ?>

                        </select> 
                    
                        <br/>
                    
					<?php } ?>
                    
                    <div id="wno_rek_persepsi" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">No Rekening: </label>
                    <input class="form-control" type="number" name="no_rek_persepsi" id="no_rek_persepsi" value="<?php if (isset($this->d_no_rek_persepsi)) {echo $this->d_no_rek_persepsi;}?>"><br/>

                    <div id="wstatus" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Status: </label>
                    
                    <select class="form-control" type="text" name="status" id="status">
                        
                        <option value="">Pilih salah satu...</option>
                        <option value="RECONCILED" <?php if ($this->d_status == 'RECONCILED') { echo 'selected'; } ?>>RECONCILED</option>
                        <option value="UNRECONCILED" <?php if ($this->d_status == 'UNRECONCILED') { echo 'selected'; } ?>>UNRECONCILED</option>
                        <option value="SEMUA" <?php if ($this->d_status == 'SEMUA') { echo "selected"; } ?>>SEMUA</option>
                        
                    </select>      
                    
                    <br/>
                    
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal Pelimpahan: </label>
                    
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