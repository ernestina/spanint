<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataPelimpahan/monitoringPelimpahan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Daftar SPM TUP NIHIL</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
			    if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {
				//-----------------------------
					IF(isset($this->d_nama_kppn) || isset($this->d_kd_satker) || isset($this->sumber_dana)){
						
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							  }
						} else {
							$kdkppn = 'null';
						}
						if (isset($this->d_kd_satker)) {
							$kd_satker = $this->d_kd_satker;
						}else{		
							$kd_satker =	Session::get('kd_satker');					
						}
						if (isset($this->sumber_dana)) {
							$sumber_dana = $this->sumber_dana;
						}else{
							$sumber_dana = 'null';
						
						}
						if (isset($this->d_tgl_awal)) {
							$d_tgl_awal = $this->d_tgl_awal;
						}else{
							$d_tgl_awal = 'null';
						
						}
						if (isset($this->d_tgl_akhir)) {
							$d_tgl_akhir = $this->d_tgl_akhir;
						}else{
							$d_tgl_akhir = 'null';
						
						}
						
						
						?>
                 
					<?php
						}
					//------------------------------
				}

				if (Session::get('role') == KPPN || Session::get('role') == KL || Session::get('role') == ES1 ) {
                    
					
						if (isset($this->d_kd_satker)) {
							$kd_satker = $this->d_kd_satker;
						}else{		
							$kd_satker =	Session::get('kd_satker');					
						}
						if (isset($this->sumber_dana)) {
							$sumber_dana = $this->sumber_dana;
						}else{
							$sumber_dana = 'null';
						
						}
						if (isset($this->d_tgl_awal)) {
							$d_tgl_awal = $this->d_tgl_awal;
						}else{
							$d_tgl_awal = 'null';
						
						}
						if (isset($this->d_tgl_akhir)) {
							$d_tgl_akhir = $this->d_tgl_akhir;
						}else{
							$d_tgl_akhir = 'null';
						
						}
						
						
						?>
						
					<?php
					
                }
				if (Session::get('role') == SATKER) {
				//-----------------------------
					
					
					$kd_satker =	Session::get('kd_satker');
					
					if (isset($this->sumber_dana)) {
							$sumber_dana = $this->sumber_dana;
						}else{
							$sumber_dana = 'null';
						
						}
						if (isset($this->d_tgl_awal)) {
							$d_tgl_awal = $this->d_tgl_awal;
						}else{
							$d_tgl_awal = 'null';
						
						}
						if (isset($this->d_tgl_akhir)) {
							$d_tgl_akhir = $this->d_tgl_akhir;
						}else{
							$d_tgl_akhir = 'null';
						
						}
						
						
						?>
					<?php
				}
				//------------------------------

			?>
				<div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/TUPSatker_PDF/<?php echo $sumber_dana . "/" . $kd_satker . "/" . $d_tgl_awal . "/" . $d_tgl_akhir; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/TUPSatker_PDF/<?php echo $sumber_dana . "/" . $kd_satker . "/" . $d_tgl_awal . "/" . $d_tgl_akhir; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>		

                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
           
        </div>
        
        <div class="row top-padded-little">
            
            <div class="col-md-6 col-sm-12">
                
                <?php
                    if (isset($this->nmsatker)) {

                        foreach ($this->nmsatker as $value1) {
                            $satker = $value1->get_nmsatker();
							//var_dump($value1);
                        }
                    }
                    echo $satker . " ";
            
                ?>
				<br>
                
             
            </div>
			
            
			
			
            <div class="col-md-6 col-sm-12 align-right">
                <?php

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
    <table class="footable table table-bordered">
	
		<thead>
		
			<tr style="background: #f3f3f3;">
				
				
			</tr>
			<tr style="background: #f3f3f3;">
				<th>No.</th>
				<th>Kode Satker</th>
				<th>Jenis SPM</th>
				<th>Nomor Invoice</th>
				<th>Tanggal Invoice</th>
				<th>Nomor SP2D</th>
				<th>Tanggal SP2D</th>
				<th>Nilai</th>
				<!--td>Jumlah</td>
				
				<th class='mid'>No.</th>
				<th>Kode Satker</th>
				<th>Jenis SPM</th>
				<th>Nomor Invoice</th>
				<th>Tanggal Invoice</th>
				<th>Nomor SP2D</th>
				<th>Nilai</th>
				<td>Jumlah</td-->
			</tr>
		
		</thead>
        
        <tbody>
                
                <?php

                    $no = 1;
					$total_penerimaan = 0;
					
					$disp_rows = array();
					
                    //var_dump ($this->data);
                    if (isset($this->data1)) {
                        if (empty($this->data1)) {
                            
                        } else {
                            foreach ($this->data1 as $value) {
								$disp_rows[$no] = "<tr>	"
								. "<td class='ratatengah'>" . $no . "</td>"
								. "<td class='ratatengah'>" . $value->get_satker_code() . "</td>"
                                . "<td class='ratatengah'>" . $value->get_jenis_spm() . "</td>"
                                . "<td class='ratatengah'>" . $value->get_invoice_num() . "</td>"
								. "<td class='ratatengah'>" . $value->get_invoice_date() . "</td>"
								. "<td class='ratatengah'>" . $value->get_check_num() . "</td>"
								. "<td class='ratatengah'>" . $value->get_tanggal_sp2d() . "</td>"
                                . "<td style='text-align: right'>" . number_format($value->get_line_amount()) . "</td>";
								$total_penerimaan = $total_penerimaan + $value->get_line_amount();
								$no++;
                            }
							
                        }
                    } 
					
					foreach ($disp_rows as $rows) { if ($rows != "" || $rows != undefined) { echo $rows; } }
					
					echo "<tfoot> " ;	
					echo "<tr> " ;	
					echo "<td colspan='6'>GRAND TOTAL</td> ";
					echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_penerimaan)."</td>";	
					echo "</tr> " ;	
					
					echo "</tfoot> " ;	
					
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
            
            <form id="filter-form" method="POST" action="KarwasUP" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <div id="winvoice" class="error"></div>


	<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select type="text" name="kdkppn" id="kdkppn">
                            <option value='' selected>Semua KPPN</option>
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



                   <?php if (isset($this->kdsatker)) {
					echo $this->kdsatker;
					} ?>


                    <div id="satker" class="alert alert-danger"></div>
                    <label class="isian">Satker PNBP: </label>
                    <select class="form-control" type="text" name="kdsatker" id="kdsatker">
                        <!--option value='' selected>- pilih -</option-->
                        <?php
                        foreach ($this->data5 as $value1) {
                            echo "<option value = '" . $value1->get_satker_code() . "'>" . $value1->get_satker_code() . " | " . $value1->get_nmsatker() . "</option>";
						}
                       
                        ?>
                    </select>
					
                    <br/>
                    
                    <br/> 

                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->
                        

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
        $('#ppp').keyup(function() {
            if (document.getElementById('ppp').value != '') {
                $('#wppp').fadeOut(200);
            }
        });

    }

    function cek_upload() {

        
        
    }

</script>