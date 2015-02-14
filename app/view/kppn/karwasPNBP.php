<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataPelimpahan/monitoringPelimpahan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Karwas Maksimum Pencairan (PNBP)</h2>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
			if (Session::get('role') == KPPN) {
				IF(isset($this->nmsatker) || isset($this->ppp) ){
				
					$kdkppn=Session::get('id_user');
					if (isset($this->ppp)) {
						$kdppp = $this->ppp;
					} else {
						$kdppp = "null";
					}
					if (isset($this->nmsatker)) {
						foreach ($this->nmsatker as $satker) {
							$kdsatker = $satker->get_satker_code();
						}
					}else{			
						if (isset($this->data1)) {
							foreach ($this->data1 as $value) {
								$kdsatker =$value->get_satker_code();
							}
						}
					} 
				?>
					<a href="<?php echo URL; ?>PDF/KarwasPNBP_PDF/<?php echo $kdkppn . "/" . $kdppp . "/" . $kdsatker; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
					</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
					<a href="<?php echo URL; ?>PDF/KarwasPNBP_PDF/<?php echo $kdkppn . "/" . $kdppp . "/" . $kdsatker; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
				<?php
				}
			}
			?>

                
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
    <table class="regtable table table-bordered">
        
        <tbody>
                <tr style="background: #f3f3f3;">
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">DIPA PNBP</td>
                </tr>
                <tr style="background: #f3f3f3;">
                    <td>No.</td>
					<td>Kode Satker</td>
					<td>Kode KPPN</td>
                    <td>No. DIPA</td>
                    <td>Jenis Belanja</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php
					
                    $no = 1;
					$total_dipa = 0;
                    //var_dump ($this->data);
                    if (isset($this->data1)) {
                        if (empty($this->data1)) {
                            echo '<tr><td colspan=6 class="align-center">Tidak ada data.</td></tr>';
                        } else {
                            foreach ($this->data1 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
                                echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td>" . $value->get_dipa_no() . "</td>";
                                echo "<td>" . $value->get_jenis_belanja() . "</td>";
                                echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailDipaPNBP/". $value->get_jenis_belanja(). "/"
								. $_POST['kdsatker'] . " >" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_dipa = $total_dipa + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_dipa)."</td>";
                            echo "</tr> " ;	
                        }
                    } 
					// else {
                        // echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    // }
                ?>
                
                <tr style="background: #f3f3f3;">
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">Penerimaan PNBP</td>
                </tr>
                <tr style="background: #f3f3f3;">
                    <td>No.</td>
					<td>Kode Satker</td>
                    <td>Kode KPPN</td>
                    <td colspan=2>Kode Akun</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_penerimaan = 0;
                    //var_dump ($this->data);
                    if (isset($this->data2)) {
                        if (empty($this->data2)) {
                            echo '<tr><td colspan=6 class="align-center">Tidak ada data.</td></tr>';
                        } else {
                            foreach ($this->data2 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
								echo "<td>" . $value->get_satker_code() . "</td>";
                                echo "<td >" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_account_code() . "</td>";
                                
                                echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailGRPNBP/". $value->get_account_code(). "/"
								. $_POST['kdsatker'] . " >" . number_format($value->get_line_amount()) ."</td>";
								$total_penerimaan = $total_penerimaan + $value->get_line_amount();
								//echo "</tr>	";
								
                                //echo "</tr>	";
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_penerimaan)."</td>";
                            echo "</tr> " ;	
                        }
                    } 
					// else {
                        // echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    // }
                ?>
				
                <tr style="background: #f3f3f3;">
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">UP PNBP</td>
                </tr>
                <tr style="background: #f3f3f3;">
                    <td>No.</td>
					<td>Kode Satker</td>
                    <td>Kode KPPN</td>
                    <td colspan=2>Jenis SPM</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_up = 0;
                    //var_dump ($this->data);
                    if (isset($this->data4)) {
                        if (empty($this->data4)) {
                            echo '<tr><td colspan=6 class="align-center">Tidak ada data.</td></tr>';
                        } else {
                            foreach ($this->data4 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
                                echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_jenis_spm() . "</td>";
								echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailUPPNBP/". $value->get_jenis_spm(). "/"
								. $_POST['kdsatker'] . " >" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_up = $total_up + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_up)."</td>";
							echo "</tr> " ;	
							
                        }
                    } 
					// else {
                        // echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                    // }
                ?>
				
				<tr style="background: #f3f3f3;">
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">BELANJA PNBP</td>
                </tr>
                <tr style="background: #f3f3f3;">
                    <td>No.</td>
                    <td>Kode Satker</td>
					<td>Kode KPPN</td>
                    <td colspan=2>Akun</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_belanja =0;
                    //var_dump ($this->data);
                    if (isset($this->data3)) {
                        if (empty($this->data3)) {
                            echo '<tr><td colspan=6 class="align-center">Tidak ada data.</td></tr>';
                        } else {
                            foreach ($this->data3 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
								echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_account_code() . "</td>";
                                //echo "<td>" . $value->get_line_amount() . "</td>";
								echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailBelanjaPNBP/". $value->get_account_code(). "/"
								. $_POST['kdsatker'] . " >" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_belanja = $total_belanja + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_belanja)."</td>";
							echo "</tr> " ;	
							
                        }
                    } 
					else {
                        echo '<tr><td colspan=6 class="align-center">Silahkan masukkan filer terlebih dahulu.</td></tr>';
                    }
                ?>
				
				<tr style="background: #f3f3f3;">
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold;">SETORAN UP/TUP PNBP</td>
                </tr>
                <tr style="background: #f3f3f3;">
                    <td>No.</td>
                    <td>Kode Satker</td>
					<td>Kode KPPN</td>
                    <td colspan=2>Akun</td>
                    <td>Jumlah</td>
                </tr>
                
                <?php

                    $no = 1;
					$total_setoran_up =0;
                    //var_dump ($this->data);
                    if (isset($this->data6)) {
                        if (empty($this->data6)) {
                            echo '<tr><td colspan=6 class="align-center">Tidak ada data.</td></tr>';
                        } else {
                            foreach ($this->data6 as $value) {
                                echo "<tr>	";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $value->get_satker_code() . "</td>";
								echo "<td>" . $value->get_kppn_code() . "</td>";
                                echo "<td colspan=2>" . $value->get_account_code() . "</td>";
                                //echo "<td>" . $value->get_line_amount() . "</td>";
								echo "<td style='text-align: right'><a href=" . URL . "dataPNBP/DetailSetoranUPPNBP/". $value->get_account_code(). "/"
								. $_POST['kdsatker'] . " >" . number_format($value->get_line_amount()) ."</td>";

                                echo "</tr>	";
								$total_setoran_up = $total_setoran_up + $value->get_line_amount();
                            }
							echo "<tr> " ;	
							echo "<td colspan='5'>GRAND TOTAL</td> ";
							echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($total_setoran_up)."</td>";
							
							echo "</tr> " ;	
                        }
                    } 
					else {
                        echo '<tr><td colspan=6 class="align-center" id="filter-first">Silahkan masukkan filer terlebih dahulu.</td></tr>';
                    }
					$pendapatan_hitung = $this->ppp/100;
					//echo 'pendapatan_hitung :'.$pendapatan_hitung;
					$maksimum_pencairan = ($pendapatan_hitung * $total_penerimaan) - $total_belanja;
					?>
					<tr>
                    <td colspan=6 style="padding-top: 20px; padding-bottom: 20px; font-weight: bold; background: #f3f3f3;">MAKSIMUM PENCAIRAN</td>
					</tr>
					<?php
					echo "<tr> " ;	
					echo "<td colspan='5'>MAKSIMUM PENCAIRAN (MP) SAAT INI</td> ";
					echo "<td style='text-align: right';padding-top: 20px; padding-bottom: 10px; font-weight: bold;>". number_format($maksimum_pencairan)."</td>";
                    echo "</tr> " ;	
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
            
            <form id="filter-form" method="POST" action="KarwasPNBP" enctype="multipart/form-data">

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
                    
                    <div id="wppp" class="alert alert-danger"></div>
					<label class="isian">PPP (DALAM PERSENTASE): </label>
                    <input class="form-control" type="text" name="ppp" id="ppp" value="<?php if (isset($this->ppp)) {
					echo $this->ppp;
					} ?>">
                    
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

        var jml = 0;
        
        if ($('#ppp').val() > 100 || $('#ppp').val() < 0) {
            $('#wppp').html('Masukkan angka antara 0 - 100.');
            $('#wppp').fadeIn();
            jml++;
        }
        
        if ($('#ppp').val() == '') {
            $('#wppp').html('Masukkan nilai persentase.');
            $('#wppp').fadeIn();
            jml++;
        }
        
        if (jml > 0) {
            return false;
        }
        
    }

</script>