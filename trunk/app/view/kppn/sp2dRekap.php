<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Rekap SP2D Harian</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <!-- PDF -->
				                <?php
	                //----------------------------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
                if (Session::get('role') == KANWIL) {
                    IF(isset($this->d_nama_kppn) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							}
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
									
					<a href="<?php echo URL; ?>PDF/sp2dRekap_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

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
							$kdtgl_awal = 'null';
						}
						if (isset($this->d_tgl_akhir)) {
							$kdtgl_akhir = $this->d_tgl_akhir;
						} else {
							$kdtgl_akhir = 'null';
						}
					?>
									
					<a href="<?php echo URL; ?>PDF/sp2dRekap_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

					<?php
					}
                }
				
                if (Session::get('role') == KPPN) {
                  
                    IF(isset($this->d_nama_kppn) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
						
						$kdkppn=Session::get('id_user');
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
									
					<a href="<?php echo URL; ?>PDF/sp2dRekap_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

					<?php
					}
					
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
                <?php if (isset($this->d_nama_kppn)) {
                        foreach($this->d_nama_kppn as $kppn){
                            echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
                            $kode_kppn=$kppn->get_kd_satker();
                        }
                    }?>
                    <?php if (isset($this->d_bank)) {
                            if($this->d_bank=="MDRI"){
                                echo "<br> Mandiri" ;
                            }elseif($this->d_bank=="5"){
                                echo "<br> Semua Bank" ;
                            } else {
                                echo "<br> ".$this->d_bank;
                            }
                    }
                    ?>
                    <?php if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                            echo "<br>".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
                    }
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
        <thead>
				<tr>
					<th data-hide="phone, tablet" data-ignore="true">No.</th>
					<th data-toggle="true">Bank</th>
					<th data-hide="phone, tablet">Gaji</th>
					<th data-hide="phone, tablet" style="text-align: right">Nilai Gaji</th>
					<th data-hide="phone, tablet" >Non Gaji</th>
					<th data-hide="phone, tablet" style="text-align: right">Nilai Non Gaji</th>
					<th data-hide="phone, tablet">Total</th>
					<th data-hide="phone, tablet" style="text-align: right">Nilai Total</th>
					<th data-hide="phone, tablet">Retur</th>
					<th data-hide="phone, tablet" style="text-align: right">Nilai Retur</th>
					<th data-hide="phone, tablet">Void</th>
					<th data-hide="phone, tablet" style="text-align: right">Nilai Void</th>
				</tr>
			</thead>
        <tbody>
            <?php

			$no=1;

			if (isset($this->data)) {
                
				$gaji=0;
				$non_gaji=0;
				$total=0;
				$retur=0;
				$void=0;
                
				if (empty($this->data)) {
                    
					echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    
				} else {
                    
					foreach ($this->data as $value) {
                        
						echo '<tr> ';
                        
						echo '<td>' . $no++ . '</td>';
                        
						if ($value->get_payment_date()!='') { echo "<td align='left'>" . $value->get_payment_date(). "</td>"; } else { echo "<td>???</td>"; }
						//filter gaji
						if (isset($this->d_nama_kppn)) {
							if ($value->get_invoice_num()!='') { echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/1/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn.">" . $value->get_invoice_num(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_invoice_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/1/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) .">" . $value->get_invoice_num(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'>" . number_format($value->get_check_amount()). "</a></td>";
						//filter non-gaji
						if (isset($this->d_nama_kppn)) {
							if($value->get_check_date()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/2/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn.">" . $value->get_check_date(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_check_date()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/2/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) .">" . $value->get_check_date(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'> " . number_format($value->get_bank_account_name()). "</a></td>";
						$tot = $value->get_invoice_num() + $value->get_check_date();
						$nil_tot = $value->get_check_amount() + $value->get_bank_name();
						if($tot!=''){echo "<td>" . $tot. "</td>";} else {echo "<td>0</td>";}
						echo "<td align='right'>" . number_format($value->get_vendor_name()). "</a></td>";
						//filter retur
						if (isset($this->d_nama_kppn)) {
							if($value->get_check_number()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn.">" . $value->get_check_number(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_check_number()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) .">" . $value->get_check_number(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'>" . number_format($value->get_bank_name()). "</a></td>";
						//filter void
						if (isset($this->d_nama_kppn)) {
							if($value->get_check_number_line_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn.">" . $value->get_check_number_line_num(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_check_number_line_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) .">" . $value->get_check_number_line_num(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'>" . number_format($value->get_vendor_ext_bank_account_num()). "</a></td>";
						echo "</tr> ";
						$gaji+=$value->get_invoice_num();
						$nil_gaji+=$value->get_check_amount();
						$non_gaji+=$value->get_check_date();
						$nil_non_gaji+=$value->get_bank_account_name();
						$total+=$tot;
						$nilai_tot+=$value->get_vendor_name();
						$retur+=$value->get_check_number();
						$nil_retur+=$value->get_bank_name();
						$void+=$value->get_check_number_line_num();
						$nil_void+=$value->get_vendor_ext_bank_account_num();
						
					}
					echo "<tr> ";
					echo "<td></td>";
					echo "<td><b>GRAND TOTAL</b></td>";
					echo "<td><b>".$gaji."</b></td>";
					echo "<td align='right'><b>".number_format($nil_gaji)."</b></td>";
					echo "<td><b>".$non_gaji."</b></td>";
					echo "<td align='right'><b>".number_format($nil_non_gaji)."</b></td>";
					echo "<td><b>".$total."</b></td>";
					echo "<td align='right'><b>".number_format($nilai_tot)."</b></td>";
					echo "<td><b>".$retur."</b></td>";
					echo "<td align='right'><b>".number_format($nil_retur)."</b></td>";
					echo "<td><b>".$void."</b></td>";
					echo "<td align='right'><b>".number_format($nil_void)."</b></td>";
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
            
            <form id="filter-form" method="POST" action="sp2dRekap" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none"></div>
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
                    <div id="wtgl" class="alert alert-danger" style="display:none"></div>
                    <label class="isian">Tanggal: </label>
                    
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>

                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Skrip -->
<script type="text/javascript">

    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
    
    function cek_upload(){
		var v_tglawal = document.getElementById('tgl_awal').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		var jml = 0;
		
		if(v_tglawal=='' || v_tglakhir==''){
			$('#wtgl').html('Harap isi kolom tanggal terlebih dahulu.');
            $('#wtgl').fadeIn();
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
    
    $('#tgl_awal').change(function(){
        if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
            $('#wtgl').fadeOut(200);
        } 
    });

    $('#tgl_akhir').change(function(){
        if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
            $('#wtgl').fadeOut(200);
        } 
    });

</script>