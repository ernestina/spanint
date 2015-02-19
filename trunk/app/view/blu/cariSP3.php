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
                <h2>Cari SP3B </h2>
				
								
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
			<!--pdf-->
			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
			//-----------------------------------
				if (Session::get('role') == BLU) {
					if (isset($this->kdsatkerr)) {
						$kdsatker = $this->kdsatkerr;
					}else{
						$kdsatker='null';
					}
					if (isset($this->invoice)) {
						$kdinvoice = $this->invoice;
						$kdinvoice1=substr($kdinvoice,0,6);
						$kdinvoice2=substr($kdinvoice,7,6);
						$kdinvoice3=substr($kdinvoice,14,6);
						$kdinvoice4=$kdinvoice1.'-'.$kdinvoice2.'-'.$kdinvoice3;
						
					}else{
						$kdinvoice4='null';
					}
					if (isset($this->d_tgl_awal) AND isset($this->d_tgl_akhir) ) {
						$kd_tgl_awal = $this->d_tgl_awal;
						$kd_tgl_akhir = $this->d_tgl_akhir;
					}else{
						$kd_tgl_awal ='null';
						$kd_tgl_akhir ='null';
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
        <div class="btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
            </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo URL; ?>PDF/CariSP3B_PDF/<?php echo $kdsatker . "/" . $kd_tgl_awal . "/" . $kd_tgl_akhir . "/" . $kdinvoice4; ?>/PDF">PDF</a></li>
                    <li><a href="<?php echo URL; ?>PDF/CariSP3B_PDF/<?php echo $kdsatker . "/" . $kd_tgl_awal . "/" . $kd_tgl_akhir . "/" . $kdinvoice4; ?>/XLS">EXCEL</a></li>
                  </ul>
        </div>
				<?php
				//----------------------------------
				?>
                
            </div> 
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                                
                    <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                  
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
				if (isset($this->data1)) {
                    foreach ($this->data1 as $value) {
					
						$SATKER =  $value->get_satker();
						$NMSATKER = $value->get_nmsatker();
                        $NMBA		= $value->get_pendapatan();
						$BA		= $value->get_kppn();
                       
                    }
					echo  " Kode Satker/Satuan Kerja : " . $SATKER. " / ".$NMSATKER ;?>
					<br>
					<?php
					echo  " Kode BA/Kementerian : " . $BA. " / ".$NMBA ;
                }
                
				if (isset($this->kdsatker)){
                    echo "Satker : ".$this->kdsatker;
                }
                if (isset($this->invoice)){
                    echo "<br>No. SP3B : ".$this->invoice;
                }
				if ($this->d_tgl_awal !='' and d_tgl_akhir !=''){
                    echo "<br>Tanggal : " .$this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
                }
                
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
				<th>KPPN</th>				
				<th>No SP3B</th>
                <th>Tanggal SP3B</th>
				<th>Nomor SP2B</th>
				<th>Tanggal SP2B</th>
				<th>Nilai SP3B</th>
				<th>Akun</th>
				<th>Program</th>
				<th>Output</th>
				<th>Penerimaan</th>
                <th>Pengeluaran</th>						
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
						echo "<td class='ratatengah'>" . $value->get_kppn() . "</td>";						
						echo "<td class='ratatengah'>" . $value->get_invoice_num() . "</td>";
						echo "<td class='ratatengah'>" . $value->get_invoice_date() . "</td>";
						echo "<td class='ratatengah'>" . $value->get_check_number() . "</td>";
						echo "<td class='ratatengah'>" . $value->get_check_date() . "</td>";
						echo "<td class='ratakanan'>" . number_format($value->get_check_amount()) . "</td>";
						echo "<td class='ratatengah'>" . $value->get_akun() . "</td>";
						echo "<td class='ratatengah'>" . $value->get_program() . "</td>";
						echo "<td class='ratatengah'>" . $value->get_output() . "</td>";
						echo "<td class='ratakanan'>" . $value->get_pendapatan() . "</td>";
						echo "<td class='ratakanan'>" . $value->get_belanja() . "</td>";						
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


<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="CariSP3B" enctype="multipart/form-data">

                <div class="modal-body">
				
					<div id="winvoice" class="error"></div>
                    
                <!-- Paste Isi Fom mulai nangkene -->
                
					 
					<div id="wprogram" class='alert alert-danger' style='display:none;'></div>
					<label class="isian">No. SP3B : </label>
					<input class='form-control' type="text" name="invoice" id="invoice"value="<?php if (isset($this->invoice)) {
							echo $this->invoice;
					} ?>">
					
                     <br>
					 
					<div id="wprogram" class='alert alert-danger' style='display:none;'></div>
					<label class="isian">Satker : </label>
					<input class='form-control' type="text" name="kdsatker" id="kdsatker"value="<?php if (isset($this->kdsatker)) {
							echo $this->kdsatker;
					} ?>">
					<br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal SP3B: </label>
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>

					
                    <input class="form-control" type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input class="form-control" type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input class="form-control" type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input class="form-control" type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input class="form-control" type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="">Kirim</button>
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