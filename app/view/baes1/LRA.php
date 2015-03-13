<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataDIPA/ProsesRevisi -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>I Account APBN</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
			<!-- PDF -->
			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
			  if (isset($this->d_kd_satker)) {
                
				$kdsatker = $this->d_kd_satker();
                
            }else{
				$kdsatker ='null';
			} 
			if (isset($this->d_nm_satker)) {
                
				$kdnmsatker = $this->d_nm_satker();
                
            }else{
				$kdnmsatker ='null';
			}

			if (isset($this->d_nama_kppn)) {
				foreach ($this->d_nama_kppn as $kppn) {
					$kdkppn = $kppn->get_kd_satker();
				  }
			}else{
				$kdkppn = 'null';
			}

			?>
            <div class="btn-group-sm">
                <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo URL; ?>PDF/DataLRA_BAES1_PDF/PDF">PDF</a></li>
                        <li><a href="<?php echo URL; ?>PDF/DataLRA_BAES1_PDF/XLS">EXCEL</a></li>
                      </ul>
            </div>
            
			<?php
				//----------------------------------------------------		
						?>
				
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
				
                <?php if (Session::get('role') != SATKER) { ?>
                    <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                <?php } ?>
                
            </div>
            
        </div>
        
        <div class="row top-padded-little">
            
            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                }
				
				echo session::get('user');
                if (isset($this->d_kd_satker) ) {
                    echo "<br/>Satker : " . $this->d_kd_satker ;
                }
                if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                    echo "<br/>Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
                }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12 align-right">
                <?php
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) :</br> " . $last_update->get_last_update() . " WIB";
                        }
                    }
                ?>
            </div>
            
        </div>
        
    </div>
</div>

<!--Tabel-->
<div id="table-container" class="wrapper">
    <table width="100%" class="footable">

        <thead>
            
            <tr>
                
                <th rowspan=2 >URAIAN</th>
                <th rowspan=2 >APBN</th>
                <th colspan=4>REALISASI</th>
                
            </tr>
            
			<tr>
                
                <th >BUN</th>
                <th >KPPN</th>
                <th >JUMLAH</th>
                <th >PERSENTASE</th>
            </tr>
			
			
			
        </thead>
        
        <tbody>
            
            <?php $no = 1; $total; ?>

            <?php if (isset($this->data)) { ?>
            
                <?php if (empty($this->data)) { ?>
            
                    <td colspan=8 class="align-center">Tidak ada data.</td>
            
                <?php } else { ?>
            
                    <?php 					
					// *fungsion bikin kurung buat negatif
								function format_currency($amount) {
									if($amount < 0)
										return str_replace("-", "","(".$amount.")");

									else return $amount;
								}
					
					foreach ($this->data as $value) { ?>
            
                        <tr>
                           
                            <td class="align-left"><pre><?php echo $value->get_deskripsi(); ?></pre></td>
                            <td class="align-right"><?php echo format_currency(number_format($value->get_apbn())); ?></td>
                            <td class="align-right"><?php echo format_currency(number_format($value->get_realisasi_bun())); ?></td>
                            <td class="align-right"><?php echo format_currency(number_format($value->get_realisasi_kppn())); ?></td>
                            <td class="align-right"><?php echo format_currency(number_format($value->get_jumlah())); ?></td>
                            <?php $pers = (float)$value->get_persentase(); ?>
							<td class="align-right"><?php echo $pers; ?></td>
                            <!--td class="align-center"><?php //if	($value->get_apbn() == 0) { 
							//echo '0.00%';
							//} 
						//else { echo 
						//"(". number_format($value->get_jumlah()/$value->get_apbn()*100,2)."%)";
						//} ; ?></td-->
                        </tr>

                    <?php } ?>
                            
                <?php } ?>
                            
            <?php } else { ?>
                            
                <td colspan=8 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>
            
            <?php } ?>
            
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
            
            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

                <div class="modal-body">
                    
	                <?php if (isset($this->kppn_list)) { ?>
                    
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control"  type="text" name="kdkppn" id="kdkppn">
                            <option value=''>SEMUA KPPN</option>
                            
                            <?php foreach ($this->kppn_list as $value1) { ?>
                            
                                <?php if ($kode_kppn == $value1->get_kd_d_kppn()) { ?>
                            
                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>" selected><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>
                            
                                <?php } else { ?>
                            
                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>"><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>
                            
                                <?php } ?>
                            
                            <?php } ?>
                            
                        </select>
                        
                        <br/>
                    
                    <?php } ?>
                    
                    <div id="wsatker" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Satker : </label>
                    <input class="form-control"  type="text" name="satker" id="satker" value="<?php if (isset($this->d_kd_satker)) {echo $this->d_kd_satker;}?>">
                    
                    <!--
                    <br/>
                    
                    <div id="wnamasatker" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Nama Satker : </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker">
                    -->
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary fullwidth" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    //Skrip validasi di sini

</script>