<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail Data Pagu Minus <i>(Fund Fail)</i>
                </h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
    //----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  
	if (Session::get('role') == ADMIN || Session::get('role') == KANWIL || Session::get('role') == SATKER) {
		
		if (isset($this->d_kd_satker)) {
			$kdsatker = $this->d_kd_satker;
		} else {
			foreach ($this->data as $value) {
				$kdsatker=$value->get_satker_code();
				}
		}		

		
		foreach ($this->data as $value) {
				$kdoutput=$value->get_output_code();
				$kdkppn=$value->get_kppn_code();
		}
		$kdakun1= $this->account_code1;
		$kf='2';
		?>
   
    <a href="<?php echo URL; ?>PDF/Detail_Fund_fail_kd_PDF/<?php echo $kf . "/" . $kdsatker . "/" . $kdoutput. "/" . $kdkppn . "/" . $kdakun1; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

<?php
	
	}
	
	if (Session::get('role') == KPPN) {
		
		if (isset($this->d_kd_satker)) {
			$kdsatker = $this->d_kd_satker;
		} else {
			foreach ($this->data as $value) {
				$kdsatker=$value->get_satker_code();
				}
		}		

		
		foreach ($this->data as $value) {
				$kdoutput=$value->get_output_code();
				$kdakun=$value->get_account_code();
		}
		if (isset($this->d_nama_kppn)) {
			foreach ($this->d_nama_kppn as $kppn) {
				$kdkppn = $kppn->get_kd_satker();
			}
		} else {
			$kdkppn = Session::get('id_user');
		}
		$kdakun1= $this->account_code1;		
		$kf='2';
		?>
   
    <a href="<?php echo URL; ?>PDF/Detail_Fund_fail_kd_PDF/<?php echo $kf . "/" . $kdsatker . "/" . $kdoutput. "/" . $kdkppn . "/" . $kdakun1; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

<?php
	
	}
			
		
		if (Session::get('role') == DJA) {

			if (isset($this->d_nama_kppn)) {
				foreach ($this->d_nama_kppn as $kppn) {
					$kdkppn = $kppn->get_kd_satker();
				  }
			} else {
				$kdkppn = 'null';
			}
			if (isset($this->d_kd_satker)) {
				$kdsatker = $this->d_kd_satker;
			} else {
				$kdsatker = 'null';
			}		
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
			$kf='2';
			$kdakun1= $this->account_code1;

			?>		   
			<a href="<?php echo URL; ?>PDF/Detail_Fund_fail_kd_PDF/<?php echo $kf . "/" . $kdsatker . "/" . $kdoutput. "/" . $kdkppn . "/" . $kdakun1; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
		<?php
		//----------------------------------------------------		
						
		}

	
?>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            <?php if (Session::get('role') != SATKER) { ?>
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
            <?php } ?>    
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
                if (isset($this->satker_code)) {
                    echo "Satker : " . $this->satker_code;
                }
                if (isset($this->account_code)) {
                    echo "<br>Akun : " . $this->account_code;
                }
                if (isset($this->output_code)) {
                    echo "<br>Output : " . $this->output_code;
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
                    <th class='mid'>No.</th>
                    <th class='mid'>Tanggal Error</th>
                    <th class='mid'>Satker</th>
                    <th class='mid'>Kode KPPN</th>
                    <th class='mid'>Akun</th>
                    <th class='mid'>Program</th>
                    <th class='mid'>Output</th>
                    <th class='mid'>Dana</th>
                    <!--th class='mid'>Description</th-->
                    <th class='ratakanan'>Pagu Saat Ini</th>
                    <th class='ratakanan'>Pagu Usulan Revisi</th>
                    <th class='ratakanan'>Total Kontrak</th>
                    <th class='ratakanan'>Blokir</th>
                    <th class='ratakanan'>Realisasi</th>
                    <th class='ratakanan'>Sisa/kurang</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=14 align="center">Data tidak ada karena akun sebelumnya menjadi hilang padahal sudah ada realisasi/kontrak .</td>';
                        //echo "<div class='alert alert-danger'><strong>Info! </strong>Data Tidak ada karena akun sebelumnya menjadi hilang padahal sudah ada realisasi/kontrak .</div>";
                    } else {
                        $tot_budget = 0;
                        $tot_encumbrance = 0;
                        $tot_actual = 0;
                        $tot_blokir = 0;
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td class='ratatengah'>" . $value->get_error_date() . "</td>";
                            echo "<td>" . $value->get_satker_code() . "</td>";
                            echo "<td>" . $value->get_kppn_code() . "</td>";
                            echo "<td>" . $value->get_account_code() . "</td>";
                            echo "<td>" . $value->get_program_code() . "</td>";
                            echo "<td>" . $value->get_output_code() . "</td>";
                            echo "<td>" . $value->get_dana_code() . "</td>";
                            //echo "<td>" . $value->get_description() . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_pagu_semula()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_pagu_revisi()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir_kontrak()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_blokir_realisasi()) . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_pagu_revisi() - $value->get_blokir_kontrak() - $value->get_blokir() - $value->get_blokir_realisasi()) . "</td>";
                            echo "</tr>	";
                            $tot_budget+=$value->get_pagu_revisi();
                            $tot_encumbrance+=$value->get_blokir_kontrak();
                            $tot_blokir+=$value->get_blokir();
                            $tot_actual+=$value->get_blokir_realisasi();
                        }
                    }
                }
                ?>
                <!--footernya ditaruh disini-->		
                <tr>
                    <td colspan='9' class='ratatengah'><b>GRAND TOTAL<b></td>
                    <td class='ratakanan'><b><?php echo number_format($tot_budget); ?></td>
                    <td class='ratakanan'><b><?php echo number_format($tot_encumbrance); ?></td>
                    <td class='ratakanan'><b><?php echo number_format($tot_blokir); ?></td>
                    <td class='ratakanan'><b><?php echo number_format($tot_actual); ?></td>
                    <td class='ratakanan'><b><?php echo number_format($tot_budget - $tot_encumbrance - $tot_blokir - $tot_actual); ?></td>
                </tr>
                <!--end footernya-->
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
                    <div id="wakun" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Satker : </label>
                    <input class='form-control' type="text" name="kd_satker" id="kd_satker">

                    <!--div id="woutput" class="error"></div>
                    <label class="isian">Output : </label>
                    <input type="text" name="output" id="output">
                    
                    <div id="wprogram" class="error"></div>
                    <label class="isian">Program : </label>
                    <input type="text" name="program" id="program">
                    
                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal: </label>
                    <ul class="inline">
                    <li><input type="text" class="tanggal" name="tgl_awal" id="datepicker" value="<?php if (isset($this->d_tgl_awal)) {
                echo $this->d_tgl_awal;
            } ?>"> </li> <li>s/d</li>
                    <li><input type="text" class="tanggal" name="tgl_akhir" id="datepicker1" value="<?php if (isset($this->d_tgl_akhir)) {
                echo $this->d_tgl_akhir;
            } ?>"></li>
                    </ul-->
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Skrip -->