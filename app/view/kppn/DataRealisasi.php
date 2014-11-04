<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Pagu dan Realisasi Belanja Per Satker </h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <?php
				//--------------------------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
				if (Session::get('role') == ADMIN  || Session::get('role') == DJA) {
					if( isset($this->d_nama_kppn) || isset($this->satker_code1)){
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							}
						} else {
							$kdkppn = 'null';
						}
						if (isset($this->satker_code)) {
							$kdsatker =$this->satker_code;
						} else {
							$kdsatker = 'null';
						}
						
					?>
					<a href="<?php echo URL; ?>PDF/DataRealisasi_PDF/<?php echo $kdkppn . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
					<?php
					}
				}
				if (Session::get('role') == KANWIL) {
					if( isset($this->d_nama_kppn) || isset($this->satker_code1)){
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							  }
						} else {
							$kdkppn = 'null';
						}
						if (isset($this->satker_code)) {
							$kdsatker = $this->satker_code;
						} else {
							$kdsatker = 'null';
						}							
						?>
						<a href="<?php echo URL; ?>PDF/DataRealisasi_PDF/<?php echo $kdkppn . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
						<?php
						}
				}
				if (Session::get('role') == KPPN) {
						if (isset($this->d_nama_kppn)) {
								$kdkppn = $this->d_kd_kppn;
						} else {
							$kdkppn = Session::get('id_user');
						}
						if (isset($this->satker_code)) {
							$kdsatker = $this->satker_code;
						} else {
							$kdsatker = 'null';
						}						
						?>
						<a href="<?php echo URL; ?>PDF/DataRealisasi_PDF/<?php echo $kdkppn . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
						<?php
				}
				//----------------------------------------------------		
?>                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
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
                if (isset($this->satker_code)){
                    echo "<br>Satker : ".$this->satker_code;
                }
                ?> 
                <br>Tanggal : s.d <?php

                echo (date('d-m-Y'));

                ?>
            </div>
            
            <div class="col-md-6 col-sm-12 align-right ">
                <?php

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

<!-- Blok Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
            <!--baris pertama-->
            <thead>
                <tr>
                    <th id="0" rowspan=2 class='mid'>No.</th>
                    <!--th>KPPN</th-->
                    <!--th>Tanggal</th-->
                    <th id="1"  rowspan=2 class='mid'>BA-Satker</th>

                    <th id="2"  rowspan=2 class='mid'> Nama Satker </th>
                    <th id="3"  rowspan=2 class='mid'> Ket </th>
					<!--tr>
						 <th id="3"  rowspan=2 class='mid'> Pagu Belanja </th>
						 <th id="3"  rowspan=2 class='mid'> Realisasi </th>
						 <th id="3"  rowspan=2 class='mid'> Sisa </th>
					
					</tr-->


                    <th  colspan=9 class='mid'>Jenis Belanja</th>
                    <th id="13"  rowspan=2 class='mid'>Total</th>
                </tr>
                <tr>
                    <th id="4"  class='mid' >Pegawai</th>
                    <th id="5"  class='mid' >Barang</th>
                    <th id="6"  class='mid' >Modal</th>
                    <th id="7"  class='mid' >Beban Bunga</th>
                    <th id="8"  class='mid' >Subsidi</th>
                    <th id="9"  class='mid' >Hibah</th>
                    <th id="10"  class='mid' >BanSos</th>
                    <th id="11"  class='mid' >Lain lain</th>
                    <th id="12"  class='mid'>Transfer</th>
                    

                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                    $no = 1;
                    $tot_pot = 0;

                    //var_dump ($this->data);
                    if (isset($this->data)) {
                        if (empty($this->data)) {
                            echo '<td colspan=14 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
                    } else {

                        $tot_pagu = 0;
						$tot_real = 0;
                        $tot_51 = 0;
                        $tot_52 = 0;
                        $tot_53 = 0;
                        $tot_54 = 0;
                        $tot_55 = 0;
                        $tot_56 = 0;
                        $tot_57 = 0;
                        $tot_58 = 0;
						$tot_61 = 0;
						$tot_pagu_51 = 0;
                        $tot_pagu_52 = 0;
                        $tot_pagu_53 = 0;
                        $tot_pagu_54 = 0;
                        $tot_pagu_55 = 0;
                        $tot_pagu_56 = 0;
                        $tot_pagu_57 = 0;
                        $tot_pagu_58 = 0;
						$tot_pagu_61 = 0;
                        $tot_bel = 0;
                        $tot_sisa = 0;
                        
                        /*foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_ba() . '-'. $value->get_satker(). "</td>";
                            echo "<td align='left'>" . $value->get_dipa() . "</td>";
							echo "<td align='left'> PAGU <br> REALISASI <br> SISA </td>";
                            echo "<td align='right'>" . number_format($value->get_pagu_51()) ."<br>". number_format($value->get_belanja_51())."<br>". number_format($value->get_pagu_51()-$value->get_belanja_51()). "</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu_52()) ."<br>". number_format($value->get_belanja_52())."<br>". number_format($value->get_pagu_52()-$value->get_belanja_52()). "</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu_53()) ."<br>". number_format($value->get_belanja_53())."<br>". number_format($value->get_pagu_53()-$value->get_belanja_53())."</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu_54()) ."<br>". number_format($value->get_belanja_54())."<br>". number_format($value->get_pagu_54()-$value->get_belanja_54()). "</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu_55()) ."<br>". number_format($value->get_belanja_55())."<br>". number_format($value->get_pagu_55()-$value->get_belanja_55()). "</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu_56()) ."<br>". number_format($value->get_belanja_56())."<br>". number_format($value->get_pagu_56()-$value->get_belanja_56()). "</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu_57()) ."<br>". number_format($value->get_belanja_57())."<br>". number_format($value->get_pagu_57()-$value->get_belanja_57()). "</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu_58()) ."<br>". number_format($value->get_belanja_58())."<br>". number_format($value->get_pagu_58()-$value->get_belanja_58()). "</td> ";
							echo "<td align='right'>" . number_format($value->get_pagu_61()) ."<br>". number_format($value->get_belanja_61())."<br>". number_format($value->get_pagu_61()-$value->get_belanja_61()). "</td> ";
                            echo "<td align='right'>" . number_format($value->get_pagu()) ."<br>". number_format($value->get_realisasi())."<br>". number_format($value->get_pagu()-$value->get_realisasi()).  "</td>"; */
                        
                
				
				
				
				foreach ($this->data as $value) {
                    echo "<tr>	";
                        echo "<td rowspan=2>" . $no++ . "</td>";
                        echo "<td rowspan=2>" . $value->get_ba() . '-'. $value->get_satker(). "</td>";
                        echo "<td rowspan=2 align='left'>" . $value->get_dipa() . "</td>";
				        echo "<td align='left'> PAGU <br> REALISASI <br> PERSENTASE </td>";
                        echo "<td align='right'>" . number_format($value->get_pagu_51()) ."<br>". number_format($value->get_belanja_51()). "<br>";
						if	($value->get_pagu_51() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_51()/$value->get_pagu_51()*100,2)."%)";
						}
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_52()) ."<br>". number_format($value->get_belanja_52()). "<br>";
						if	($value->get_pagu_52() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_52()/$value->get_pagu_52()*100,2)."%)";
						}
						
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_53()) ."<br>". number_format($value->get_belanja_53()). "<br>";
						if	($value->get_pagu_53() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_53()/$value->get_pagu_53()*100,2)."%)";
						}
						
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_54()) ."<br>". number_format($value->get_belanja_54()). "<br>";
						if	($value->get_pagu_54() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_54()/$value->get_pagu_54()*100,2)."%)";
						}
						
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_55()) ."<br>". number_format($value->get_belanja_55()). "<br>";
						if	($value->get_pagu_55() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_55()/$value->get_pagu_55()*100,2)."%)";
						}
						
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_56()) ."<br>". number_format($value->get_belanja_56()). "<br>";
						if	($value->get_pagu_56() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_56()/$value->get_pagu_56()*100,2)."%)";
						}
						
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_57()) ."<br>". number_format($value->get_belanja_57()). "<br>";
						if	($value->get_pagu_57() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_57()/$value->get_pagu_57()*100,2)."%)";
						}
						
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_58()) ."<br>". number_format($value->get_belanja_58()). "<br>";
						if	($value->get_pagu_58() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_58()/$value->get_pagu_58()*100,2)."%)";
						}
						
						"</td> ";
				        echo "<td align='right'>" . number_format($value->get_pagu_61()) ."<br>". number_format($value->get_belanja_61()). "<br>";
						if	($value->get_pagu_61() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_belanja_61()/$value->get_pagu_61()*100,2)."%)";
						}
						
						"</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu()) ."<br>". number_format($value->get_realisasi()). "<br> (". number_format($value->get_realisasi()/$value->get_pagu()*100,2)."%) </td>"; 
                    echo "</tr>	";
                    echo "<tr style='border-top: 1px solid black' !important>";
                        echo "<td align='left'> SISA </td>";
                        echo "<td align='right'>" . number_format($value->get_pagu_51()-$value->get_belanja_51()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_52()-$value->get_belanja_52()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_53()-$value->get_belanja_53()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_54()-$value->get_belanja_54()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_55()-$value->get_belanja_55()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_56()-$value->get_belanja_56()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_57()-$value->get_belanja_57()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_58()-$value->get_belanja_58()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu_61()-$value->get_belanja_61()). "</td> ";
                        echo "<td align='right'>" . number_format($value->get_pagu()-$value->get_realisasi()). "</td> ";
                    echo "</tr>";
                            
                            
                   
                            $tot_pagu+=$value->get_Pagu();
							$tot_real+=$value->get_realisasi();
                            $tot_51+=$value->get_belanja_51();
                            $tot_52+=$value->get_belanja_52();
                            $tot_53+=$value->get_belanja_53();
                            $tot_54+=$value->get_belanja_54();
                            $tot_55+=$value->get_belanja_55();
                            $tot_56+=$value->get_belanja_56();
                            $tot_57+=$value->get_belanja_57();
                            $tot_58+=$value->get_belanja_58();
							$tot_61+=$value->get_belanja_61();
							$tot_pagu_51+=$value->get_pagu_51();
                            $tot_pagu_52+=$value->get_pagu_52();
                            $tot_pagu_53+=$value->get_pagu_53();
                            $tot_pagu_54+=$value->get_pagu_54();
                            $tot_pagu_55+=$value->get_pagu_55();
                            $tot_pagu_56+=$value->get_pagu_56();
                            $tot_pagu_57+=$value->get_pagu_57();
                            $tot_pagu_58+=$value->get_pagu_58();
                            $tot_pagu_61+=$value->get_pagu_61();
                            }
                        }
                    } else {
                
                echo '<td colspan=12 id="filter-first" align="center">Masukkan filter terlebih dahulu.</td>';
                
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=3 rowspan=2 class='mid'><b>GRAND TOTAL<b></td>
					<td class='ratakiri'>PAGU <br> REALISASI <br> PERSENTASE</td>
					<td class='ratakanan'><?php echo number_format($tot_pagu_51); ?><br><?php echo number_format($tot_51); ?><br><?php if ($tot_pagu_51==0){echo '(0.00%)';} else {echo "("  .number_format($tot_51/$tot_pagu_51*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_52); ?><br><?php echo number_format($tot_52); ?><br><?php if ($tot_pagu_52==0){echo '(0.00%)';} else {echo "("  .number_format($tot_52/$tot_pagu_52*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_53); ?><br><?php echo number_format($tot_53); ?><br><?php if ($tot_pagu_53==0){echo '(0.00%)';} else {echo "("  .number_format($tot_53/$tot_pagu_53*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_54); ?><br><?php echo number_format($tot_54); ?><br><?php if ($tot_pagu_54==0){echo '(0.00%)';} else {echo "("  .number_format($tot_54/$tot_pagu_54*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_55); ?><br><?php echo number_format($tot_55); ?><br><?php if ($tot_pagu_55==0){echo '(0.00%)';} else {echo "("  .number_format($tot_55/$tot_pagu_55*100). "%)";}?> </td>
					<td class='ratakanan'><?php echo number_format($tot_pagu_56); ?><br><?php echo number_format($tot_56); ?><br><?php if ($tot_pagu_56==0){echo '(0.00%)';} else {echo "("  .number_format($tot_56/$tot_pagu_56*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_57); ?><br><?php echo number_format($tot_57); ?><br><?php if ($tot_pagu_57==0){echo '(0.00%)';} else {echo "("  .number_format($tot_57/$tot_pagu_57*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_58); ?><br><?php echo number_format($tot_58); ?><br><?php if ($tot_pagu_58==0){echo '(0.00%)';} else {echo "("  .number_format($tot_58/$tot_pagu_58*100). "%)";}?> </td>
					<td class='ratakanan'><?php echo number_format($tot_pagu_61); ?><br><?php echo number_format($tot_61); ?><br><?php if ($tot_pagu_61==0){echo '(0.00%)';} else {echo "("  .number_format($tot_61/$tot_pagu_61*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu); ?><br><?php echo number_format($tot_real); ?><br><?php echo "(" .number_format($tot_real/$tot_pagu*100). "%)";?> </td>
                </tr>
                <tr>
                    <td>SISA</td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_51-$tot_51); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_52-$tot_52); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_53-$tot_53); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_54-$tot_54); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_55-$tot_55); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_56-$tot_56); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_57-$tot_57); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_58-$tot_58); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_61-$tot_61); ?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu-$tot_real); ?> </td>
                    
                    
                </tr>

            </tfoot>
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
            
            <form id="filter-form" method="POST" action="DataRealisasi" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
						<option value='SEMUA' selected>SEMUA KPPN</option>
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
					<br>
                    <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Bagian Anggaran: </label>					
                    <select class="form-control" type="text" name="KodeBA" id="KodeBA">
                        <option value='' selected>- pilih -</option>
<?php
foreach ($this->data2 as $value2){
    echo "<option value = '" . $value2->get_dipa() . "'>" . $value2->get_dipa() . " | " . $value2->get_satker() . "</option>";
	}
?>
                    </select>
					
					
					
                        <br>
                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->satker_code)) {
    echo $this->satker_code;
} ?>">

                    
                    <br/>
                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!--Skrip-->
<script type="text/javascript" charset="utf-8">
    manualColumnMode = true;
    
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.error').fadeOut(0);
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