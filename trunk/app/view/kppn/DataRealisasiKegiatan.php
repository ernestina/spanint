<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Realisasi Belanja per Jenis Kegiatan</h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  
		
        if (isset($this->kegiatan)) {
                
				$kdkegiatan = $this->kegiatan;
                
            }else{
				$kdkegiatan ='null';
			} 
			
			?>
            <div class="btn-group-sm">
                <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo URL; ?>PDF/DataRealisasiKegiatanBAES1_BAES1_PDF/<?php echo $kdkegiatan; ?>/PDF">PDF</a></li>
                        <li><a href="<?php echo URL; ?>PDF/DataRealisasiKegiatanBAES1_BAES1_PDF/<?php echo $kdkegiatan; ?>/XLS">EXCEL</a></li>
                      </ul>
            </div>
            
			<?php

//------------------------------
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
<div id="table-container" class="wrapper" style="font-size: 85%">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th rowspan=2 width="10px" class='mid'>No.</th>
                <!--th>KPPN</th-->
                <!--th>Tanggal</th-->
                <th rowspan=2 class='mid'>Kode Program</th>
                <th rowspan=2 class='mid' width='150px'> Kode|Jenis Kegiatan </th>
                <th rowspan=2 class='mid'> Keterangan </th>
                <th  colspan=9 class='mid'>Jenis Belanja</th>
                <th   rowspan=2 class='mid'>Total</th>
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

            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            $tot_pot = 0;
			
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=12 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td rowspan=2>" . $no++ . "</td>";
						echo "<td rowspan=2 class='ratakiri'>" . $value->get_dipa(). "</td>";
                        echo "<td rowspan=2 class='ratakiri'>" . $value->get_ba()." | ". $value->get_nmba() . "</td>";
                        echo "<td align='left'> PAGU <br> REALISASI </td>";
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
                        echo "<td align='right'>" . number_format($value->get_pagu()) ."<br>". number_format($value->get_realisasi()). "<br>";
						if	($value->get_pagu() == 0) { 
							echo '0.00%';
						} 
						else { echo 
						"(". number_format($value->get_realisasi()/$value->get_pagu()*100,2)."%)";
						}

						"</td>"; 

                        echo "</tr>	";
                        echo "<tr>	";
                            echo "<td align='left'>SISA</td>";
                            echo "<td align='right'>". number_format($value->get_pagu_51()-$value->get_belanja_51()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_52()-$value->get_belanja_52()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_53()-$value->get_belanja_53()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_54()-$value->get_belanja_54()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_55()-$value->get_belanja_55()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_56()-$value->get_belanja_56()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_57()-$value->get_belanja_57()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_58()-$value->get_belanja_58()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu_61()-$value->get_belanja_61()). "</td> ";
                            echo "<td align='right'>". number_format($value->get_pagu()-$value->get_realisasi())."</td> ";
                        echo "</tr>	";
                        
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
					echo "<tr>";
						
					echo "</tr>";
					
					
                }
            } else {
                
                echo '<td colspan=12 id="filter-first" align="center">Masukkan filter terlebih dahulu.</td>';
                
            }
            ?>
        </tbody>
        <tfoot>
           
			<tr>
                    <td colspan='3' rowspan=2 class='ratatengah'><b>GRAND TOTAL<b></td>
					<td class='ratakiri'>PAGU <br> REALISASI</td>                 
					<td class='ratakanan'><?php echo number_format($tot_pagu_51); ?><br><?php echo number_format($tot_51); ?><br><?php if ($tot_pagu_51==0){echo '(0.00%)';} else {echo "("  .number_format($tot_51/$tot_pagu_51*100,2). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_52); ?><br><?php echo number_format($tot_52); ?><br><?php if ($tot_pagu_52==0){echo '(0.00%)';} else {echo "("  .number_format($tot_52/$tot_pagu_52*100,2). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_53); ?><br><?php echo number_format($tot_53); ?><br><?php if ($tot_pagu_53==0){echo '(0.00%)';} else {echo "("  .number_format($tot_53/$tot_pagu_53*100,2). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_54); ?><br><?php echo number_format($tot_54); ?><br><?php if ($tot_pagu_54==0){echo '(0.00%)';} else {echo "("  .number_format($tot_54/$tot_pagu_54*100,2). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_55); ?><br><?php echo number_format($tot_55); ?><br><?php if ($tot_pagu_55==0){echo '(0.00%)';} else {echo "("  .number_format($tot_55/$tot_pagu_55*100,2). "%)";}?> </td>
					<td class='ratakanan'><?php echo number_format($tot_pagu_56); ?><br><?php echo number_format($tot_56); ?><br><?php if ($tot_pagu_56==0){echo '(0.00%)';} else {echo "("  .number_format($tot_56/$tot_pagu_56*100,2). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_57); ?><br><?php echo number_format($tot_57); ?><br><?php if ($tot_pagu_57==0){echo '(0.00%)';} else {echo "("  .number_format($tot_57/$tot_pagu_57*100,2). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_58); ?><br><?php echo number_format($tot_58); ?><br><?php if ($tot_pagu_58==0){echo '(0.00%)';} else {echo "("  .number_format($tot_58/$tot_pagu_58*100,2). "%)";}?> </td>
					<td class='ratakanan'><?php echo number_format($tot_pagu_61); ?><br><?php echo number_format($tot_61); ?><br><?php if ($tot_pagu_61==0){echo '(0.00%)';} else {echo "("  .number_format($tot_61/$tot_pagu_61*100,2). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu); ?><br><?php echo number_format($tot_real); ?><br><?php if ($tot_pagu==0){echo '(0.00%)';} else {echo "(" .number_format($tot_real/$tot_pagu*100,2). "%)";}?> </td>
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
            
            <form id="filter-form" method="POST" action="DataRealisasiKegiatanBAES1" enctype="multipart/form-data">

                <div class="modal-body">
                    
                <!-- Paste Isi Fom mulai nangkene -->
                <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                <label class="isian">Kode KEGAIATAN: </label>
                <select class="form-control" type="text" name="kegiatan" id="kegiatan">
                    <option value='' selected>- Pilih -</option>
                    <?php
                    foreach ($this->data1 as $value1)
                        if ($kegiatan == $value1->get_ba()) {
                            echo "<option value='" . $value1->get_ba() . "' selected>" . $value1->get_ba() . " | " . $value1->get_nmba() . "</option>";
                        } else {
                            echo "<option value='" . $value1->get_ba() . "'>" . $value1->get_ba() . " | " . $value1->get_nmba() . "</option>";
                        }
                    ?>
                    <!--/select>


                    <div id="wkdkppn" class="error"></div>
                    <label class="isian">Kode Lokasi: </label>
                    <select type="text" name="kdlokasi" id="kdlokasi">
                    <option value='' selected>- pilih -</option>
                    <?php
                    //foreach ($this->data2 as $value1) 
                    //echo "<option value = '".$value1->get_lokasi()."'>".$value1->get_lokasi()."</option>";
                    //if ($kode_kppn==$value1->get_kd_d_kppn()){echo "<option value='".$value1->get_kd_d_kppn()."' selected>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";} 
                    //else {echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";}
                    ?>
                    </select--> 


                    <input class="form-control" type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input class="form-control" type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input class="form-control" type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input class="form-control" type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input class="form-control" type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                        

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