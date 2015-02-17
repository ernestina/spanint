<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Realisasi Belanja per Kegiatan</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
        
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                
                <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  
		
        if (Session::get('role') == ADMIN || Session::get('role') == DJA  || Session::get('role') == KANWIL) {
		
			if (isset($this->d_nama_kppn)) {
                foreach ($this->d_nama_kppn as $kppn) {
                    $kdkppn = $kppn->get_kd_satker();
                }
            }else{
				$kdkppn ='null';
			} 
			
			?>
            <a href="<?php echo URL; ?>PDF/DataRealisasiBA_PDF/<?php echo $kdkppn; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
			</div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
			<a href="<?php echo URL; ?>PDF/DataRealisasiBA_PDF/<?php echo $kdkppn; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
			<?php
        }

        if (Session::get('role') == KPPN) {
            
                    $kdkppn = Session::get('id_user');
			?>
            <a href="<?php echo URL; ?>PDF/DataRealisasiBA_PDF/<?php echo $kdkppn; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
			</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
			<a href="<?php echo URL; ?>PDF/DataRealisasiBA_PDF/<?php echo $kdkppn; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
			<?php
		}

//------------------------------
        ?>
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
                <th class='mid'>No.</th>
                <th class='mid'>Kode | Nama Kegiatan</th>
                <th class='mid'>Pagu </th>
                <th class='mid'>Realisasi</th>
                <th class='mid'>Persentase<br>Realisasi</th>
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
                        echo "<td>" . $no++ . "</td>";
                        echo "<td align='left'>" . $value->get_kdkegiatan() . " | " . $value->get_nmkegiatan() . "</td>";
                        echo "<td align='right'>" . number_format($value->get_budget_amt()) . "</td> ";
                        echo "<td align='right'>" . number_format($value->get_actual_amt()) .
						"</td> ";
						echo "<td align='right'>";
						if($value->get_budget_amt() == 0) { 
							echo "0.00%" ;
						} else {
                        echo   number_format(($value->get_actual_amt()/$value->get_budget_amt())*100, 2) ."%" ;
                        "</td> ";
						}
                        echo "</tr>	";
                        
							$tot_pagu+=$value->get_budget_amt();
							$tot_real+=$value->get_actual_amt();
                            
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
                    <!--td colspan='2' rowspan=2 class='ratatengah'><b>GRAND TOTAL<b></td>
					<td class='ratakiri'>PAGU <br> REALISASI</td>
                  
					<td class='ratakanan'><?php  echo number_format($tot_pagu_51); ?><br><?php echo number_format($tot_51); ?><br><?php if ($tot_pagu_51==0){echo '(0.00%)';} else {echo "("  .number_format($tot_51/$tot_pagu_51*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_52); ?><br><?php echo number_format($tot_52); ?><br><?php if ($tot_pagu_52==0){echo '(0.00%)';} else {echo "("  .number_format($tot_52/$tot_pagu_52*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_53); ?><br><?php echo number_format($tot_53); ?><br><?php if ($tot_pagu_53==0){echo '(0.00%)';} else {echo "("  .number_format($tot_53/$tot_pagu_53*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_54); ?><br><?php echo number_format($tot_54); ?><br><?php if ($tot_pagu_54==0){echo '(0.00%)';} else {echo "("  .number_format($tot_54/$tot_pagu_54*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_55); ?><br><?php echo number_format($tot_55); ?><br><?php if ($tot_pagu_55==0){echo '(0.00%)';} else {echo "("  .number_format($tot_55/$tot_pagu_55*100). "%)";}?> </td>
					<td class='ratakanan'><?php echo number_format($tot_pagu_56); ?><br><?php echo number_format($tot_56); ?><br><?php if ($tot_pagu_56==0){echo '(0.00%)';} else {echo "("  .number_format($tot_56/$tot_pagu_56*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_57); ?><br><?php echo number_format($tot_57); ?><br><?php if ($tot_pagu_57==0){echo '(0.00%)';} else {echo "("  .number_format($tot_57/$tot_pagu_57*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu_58); ?><br><?php echo number_format($tot_58); ?><br><?php if ($tot_pagu_58==0){echo '(0.00%)';} else {echo "("  .number_format($tot_58/$tot_pagu_58*100). "%)";}?> </td>
					<td class='ratakanan'><?php echo number_format($tot_pagu_61); ?><br><?php echo number_format($tot_61); ?><br><?php if ($tot_pagu_61==0){echo '(0.00%)';} else {echo "("  .number_format($tot_61/$tot_pagu_61*100). "%)";}?> </td>
                    <td class='ratakanan'><?php echo number_format($tot_pagu); ?><br><?php echo number_format($tot_real); ?><br><?php if ($tot_pagu==0){echo '(0.00%)';} else {echo "(" .number_format($tot_real/$tot_pagu*100). "%)";}?> </td!-->
            </tr>

        </tfoot>
    </table>
</div>

<?php if (isset($this->kppn_list)) { ?>

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="DataRealisasiBA" enctype="multipart/form-data">

                <div class="modal-body">
                    
                <!-- Paste Isi Fom mulai nangkene -->
                <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                <label class="isian">Kode KPPN: </label>
                <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                    <option value='' selected>- Semua KPPN -</option>
                    <?php
                    foreach ($this->kppn_list as $value1)
                        if ($kode_kppn == $value1->get_kd_d_kppn()) {
                            echo "<option value='" . $value1->get_kd_d_kppn() . "' selected>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
                        } else {
                            echo "<option value='" . $value1->get_kd_d_kppn() . "'>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
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
    
<?php } ?>

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