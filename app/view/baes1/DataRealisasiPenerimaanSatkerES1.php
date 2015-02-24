<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Realisasi Pendapatan Per Satker</h2>
            </div>
			 
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
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
			if (isset($this->eselon1)) {
                
				$kdeselon1 = $this->eselon1();
                
            }else{
				$kdeselon1 ='null';
			} 
			if (isset($this->d_kd_revisi)) {
                
				$kdkdrevisi = $this->d_kd_revisi();
                
            }else{
				$kdkdrevisi ='null';
			} 
			
			
			?>
            <div class="btn-group-sm">
                <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo URL; ?>PDF/nmsatker_BAES1_PDF/<?php echo $kdsatker . "/" . $kdnmsatker. "/" . $kdeselon1 . "/" . $kdkdrevisi; ?>/PDF">PDF</a></li>
                        <li><a href="<?php echo URL; ?>PDF/nmsatker_BAES1_PDF/<?php echo $kdsatker . "/" . $kdnmsatker. "/" . $kdeselon1 . "/" . $kdkdrevisi; ?>/XLS">EXCEL</a></li>
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
               
				echo Session::get('user');
                ?>
                <br>Tanggal : s.d <?php
                echo (date('d-m-Y'));
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
                <th class='mid'>Kode| Nama Satker</th>
                <th class='mid'>Pagu </th>
                <th class='mid'>Realisasi</th>
                <th class='mid'>Persentase<br>Realisasi</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            $tot_pagu = 0;
			$tot_real = 0;
			
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=12 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
					
					 $style = '';

                            if (substr($value->get_kdkegiatan(), 6, 1) == null) {

                                $style = ' style="background: #FFC2C2" ';
								$nomor = '';

                            }
							else {
								$nomor =  $no++;
							
							}
							
                        echo "<tr>	";
                        echo "<td".$style. ">" . $nomor . "</td>";
						$eselon1 = substr($value->get_kdkegiatan(), 0,5);
						$satker = substr($value->get_kdkegiatan(), 6,6);
						echo "<td class='ratakiri' ".$style. "><a href=" . URL . "BA_ES1/DataRealisasiPenerimaanBA/" . $eselon1."/". $satker . ">" . $value->get_kdkegiatan() . " | ".$value->get_nmkegiatan(). " </td>";
                        echo "<td align='right' ".$style. ">" . number_format($value->get_budget_amt()) . "</td> ";
                        echo "<td align='right' ".$style. ">" . number_format($value->get_actual_amt()) .
						"</td> ";
						echo "<td align='right' ".$style. ">";
						if($value->get_budget_amt() == 0) { 
							echo "0.00%" ;
						} else {
                        echo   number_format(($value->get_actual_amt()/$value->get_budget_amt())*100, 2) ."%" ;
                        "</td ".$style. "> ";
						}
                        echo "</tr>	";
                        
						 if (substr($value->get_kdkegiatan(), 6, 1) == null) {
							$tot_pagu+=$value->get_budget_amt();
							$tot_real+=$value->get_actual_amt();
                          }  
                    }
					echo "<tr>";
					echo "</tr>";				
                }
            } else {
                
                echo '<td colspan=12 id="filter-first" align="center">Masukkan filter terlebih dahulu.</td>';
                
            }
            ?>
        
        
           
			<tr>
                    <td colspan='2' rowspan=2 class='ratatengah'><b>GRAND TOTAL<b></td>
					<td align='right'><b> <?php echo number_format($tot_pagu) ;?> </b> </td>
					<td align='right'><b> <?php echo number_format($tot_real) ;?> </b></td>
					<td align='right'><b> <?php if($tot_pagu == 0) {echo '0.00%';} else { echo  number_format($tot_real/$tot_pagu*100,2). '%' ;}?> </b></td>
            </tr>

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

            <form id="filter-form" method="POST" action="DataRealisasiPenerimaanPerSatkerES1" enctype="multipart/form-data">

                <div class="modal-body">

<?php if (isset($this->data)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Eselon 1: </label>
                        <select class="form-control" type="text" name="eselon1" id="eselon1">
                            <option value='' selected>- pilih -</option>
    <?php
    //foreach ($this->data1 as $value1) {        
           // echo "<option value='" . $value1->get_nmba() . "' selected>" . $value1->get_nmba() . " | " . $value1->get_nmes1() . "</option>";       
    //}
	
			
    ?>
	
	<?php foreach ($this->data1 as $value1) { ?>

                                <?php if ($this->eselon1 == $value1->get_nmba()) { ?>

                                    <option value="<?php echo $value1->get_nmba(); ?>" selected><?php echo $value1->get_nmba(); ?> | <?php echo $value1->get_nmes1(); ?></option>

                                <?php } else { ?>

                                    <option value="<?php echo $value1->get_nmba(); ?>"><?php echo $value1->get_nmba(); ?> | <?php echo $value1->get_nmes1(); ?></option>

                                <?php } ?>

                            <?php } ?>
                        </select>
<?php } ?>

                    

                    </select -->
                    <br/>
                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)) {
    echo $this->kdsatker;
} ?>">
                    <br/>
                    <label class="isian">Nama Satker: </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker" value="<?php if (isset($this->nmsatker)) {
    echo $this->nmsatker;
} ?>">


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

    }

    function cek_upload() {
        var v_status = document.getElementById('status').value;

        var jml = 0;
        if (v_status == '') {
            $('#wstatus').html('Harap pilih');
            $('#wstatus').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }
</script>