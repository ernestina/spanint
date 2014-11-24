<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            <?php
			/*if (isset($this->data1) ); {
				if (empty($this->data)) {
                    echo '<td colspan=11 align="center">Tidak ada data.</td>';
				}
				else{
					foreach ($this->data1 as $value) {
                        $jml_invoice=$value->get_jml_invoice();
						$jml_pmrt=$value->get_jml_pmrt();
						$jml_nil_invoice=$value->get_jml_nilai_inv();
					}
				}
			} */
			?>
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>MONITORING SP3 BLU PER TAHUN</h2>
								
            </div>
              <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php if (Session::get('role') != KPPN) { ?>
                    <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                <?php } ?>
        
            </div>
           <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <!--pdf-->
				<?php
							//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

				//-----------------------------------
				if (Session::get('role') == BLU) {
					if (isset($this->data)) {
						foreach ($this->data as $kppn) {
							$kdkppn = $kppn->get_kppn();
							$kdsatker = $kppn->get_satker();
						}
					}else{
						$kdkppn='null';
						$kdsatker='null';
					}
					$kdkppn='null';
					$kdsatker='null';
					if (isset($this->ppp)) {
						$kdppp = $this->ppp;
						
					}else{
						$kdppp='null';
					}
					
					
					
				}
				 if (Session::get('role') == ADMIN) {
					if (isset($this->d_nama_kppn)) {
						foreach ($this->d_nama_kppn as $kppn) {
							$kdkppn = $kppn->get_kd_satker();
						}
					}else{
						$kdkppn='null';
					}
				 
				 
				 }
				   if (Session::get('role') == KPPN) {
					  $kdkppn = Session::get('id_user');
				   }
				
				 
				?>
				<a href="<?php echo URL; ?>PDF/KarwasBLU_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdppp; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

				<?php
				//----------------------------------
				?>
                
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
                            echo "Update Data Terakhir (Waktu Server):<br/>" . $last_update->get_last_update() . " WIB";
                        }
                    }
                ?>
            </div>
            
        </div>
        
    </div>
</div>


<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th>No.</th>				
				<th>Satker</th>
                <th>Nama Satker</th>
				<th>Rumpun</th>
				<th>KPPN</th>
				<th>Jan</th>
				<th>Feb</th>
                <th>Mar</th>
				<th>Apr</th>
                <th>Mei</th>
                <th>Jun</th> 
				<th>Jul</th> 
                <th>Agu</th> 
				<th>Sep</th> 
				<th>Okt</th> 
				<th>Nov</th> 
				<th>Des</th> 
				<th>total</th> 				
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;	
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=11 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";				
						echo "<td>" . $value->get_satker() . "</td>";
						echo "<td class='ratakiri'>" . $value->get_nmsatker() . "</td>";
						echo "<td class='ratakiri'>" . $value->get_rumpun() . "</td>";
						echo "<td>" . $value->get_kppn() . "</td>";
						//echo "<td>" . $value->get_september() . "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/01/". $value->get_satker() .">" . $value->get_januari() .  "</td>";
                        echo "<td><a href=" . URL . "dataBLU/DaftarSP3/02/". $value->get_satker() .">" . $value->get_februari() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/03/". $value->get_satker() .">" . $value->get_maret() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/04/". $value->get_satker() .">" . $value->get_april() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/05/". $value->get_satker() .">" . $value->get_mei() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/06/". $value->get_satker() .">" . $value->get_juni() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/07/". $value->get_satker() .">" . $value->get_juli() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/08/". $value->get_satker() .">" . $value->get_agustus() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/09/". $value->get_satker() .">" . $value->get_september() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/10/". $value->get_satker() .">" . $value->get_oktober() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/11/". $value->get_satker() .">" . $value->get_november() .  "</td>";
						echo "<td><a href=" . URL . "dataBLU/DaftarSP3/12/". $value->get_satker() .">" . $value->get_desember() .  "</td>";
						$total = $value->get_januari()+$value->get_februari()+$value->get_maret()+$value->get_april()+$value->get_mei()+$value->get_juni()+
						$value->get_juli()+$value->get_agustus()+$value->get_september()+$value->get_oktober()+$value->get_november()+$value->get_desember();
						echo "<td>" .$total. "</td>";
                        echo "</tr>	";
                    }
                }
            } else {
                echo '<td colspan=11 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
            }
            ?>
        </tbody>
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
            
            <form id="filter-form" method="POST" action="Konversi" enctype="multipart/form-data">

                <div class="modal-body">
                    
                <!-- Paste Isi Fom mulai nangkene -->
                <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                <label class="isian">Kode KPPN: </label>
                <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                    <option value='' selected>- SEMUA KPPN -</option>
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

<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.error').fadeOut(0);
    }

    function hideWarning() {
        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_invoice = document.getElementById('invoice').value;

        var jml = 0;
        if (v_invoice == '') {
            $('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }
</script>