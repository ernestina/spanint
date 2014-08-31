<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Realisasi Belanja Transfer Daerah</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
         <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  
		if (Session::get('role') == KANWIL) {
		if(isset($this->lokasi) || isset($this->satker) ||
			isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
				if (isset($this->lokasi)) {
					$kdlokasi = $this->lokasi;
				} else {
					$kdlokasi = 'null';
				}

				if (isset($this->data3)) {
					foreach ($this->data3 as $satker) {
						$kdsatker = $satker->get_satker();
					  }
				} else {
					$kdsatker = 'null';
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

			<a href="<?php echo URL; ?>PDF/DataRealisasiTransfer_PDF/<?php echo $kdsatker . "/" . $kdlokasi . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

			<?php
			}
        }
        if (Session::get('role') == ADMIN || Session::get('role') == DJA) {
			if(isset($this->lokasi) || isset($this->satker) ||
			isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
				if (isset($this->lokasi)) {
					$kdlokasi = $this->lokasi;
				} else {
					$kdlokasi = 'null';
				}

				if (isset($this->data3)) {
					foreach ($this->data3 as $satker) {
						$kdsatker = $satker->get_satker();
					  }
				} else {
					$kdsatker = 'null';
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

			<a href="<?php echo URL; ?>PDF/DataRealisasiTransfer_PDF/<?php echo $kdsatker . "/" . $kdlokasi . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
			
			<?php
			}
        }

        if (Session::get('role') == KPPN) {
				if(isset($this->lokasi) || isset($this->satker) ||
			isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){

				if (isset($this->lokasi)) {
					$kdlokasi = $this->lokasi;
				} else {
					$kdlokasi = 'null';
				}

				if (isset($this->data3)) {
					foreach ($this->data3 as $satker) {
						$kdsatker = $satker->get_satker();					  
						}
				} else {
					$kdsatker = 'null';
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

			<a href="<?php echo URL; ?>PDF/DataRealisasiTransfer_PDF/<?php echo $kdsatker . "/" . $kdlokasi . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

			<?php
			}
		}

	
			//----------------------------------------------------		
		        
        ?>
 
                <?php
?>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
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
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server)<br/>" . $last_update->get_last_update() . " WIB";
                        }
                    }
                ?>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Blok Tabel -->
<div id="table-container" class="wrapper">
    <table width="100%" class="footable">
        <!--baris pertama-->
            <thead>
                <tr>
                    <th rowspan=2 width="10px" class='mid'>No.</th>
                    <!--th>KPPN</th-->
                    <!--th>Tanggal</th-->
                    <th rowspan=2 class='mid'>Lokasi</th>
                    <th rowspan=2 class='mid'>Nama Lokasi</th>

                    <!--th rowspan=2 class='mid' width='200px'> Nama Satker </th-->
                    <th style="text-align: right"> Realisasi </th>


                    <!--th colspan=9 class='mid'>Jenis Belanja</th>
                    <th rowspan=2 class='mid'>Sisa Pagu</th-->
                </tr>
                <!--tr >
                                <th class='mid' >Pegawai</th>
                                <th class='mid' >Barang</th>
                                <th class='mid' >Modal</th>
                                <th class='mid' >Beban Bunga</th>
                                <th class='mid' >Subsidi</th>
                                <th class='mid' >Hibah</th>
                                <th class='mid' >BanSos</th>
                                <th class='mid' >Lain lain</th>
                <!--th >Pencadangan Dana</th-->
                <!--th class='mid' >Total</th>
                
</tr-->
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                $tot_pot = 0;

                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=4 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_lokasi() . "</td>";
                            //echo "<td>" . $value->get_satker() . "</td>";
                            echo "<td align='left'>" . $value->get_nmlokasi() . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_Pagu()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_realisasi()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_52()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_53()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_54()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_55()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_56()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_57()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_58()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_encumbrance()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_51()+$value->get_belanja_52()+$value->get_belanja_53()+$value->get_belanja_54()
                            //+$value->get_belanja_55()+$value->get_belanja_56()+$value->get_belanja_57()+$value->get_belanja_58()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_pagu()-($value->get_belanja_51()+$value->get_belanja_52()+$value->get_belanja_53()+$value->get_belanja_54()
                            //+$value->get_belanja_55()+$value->get_belanja_56()+$value->get_belanja_57()+$value->get_belanja_58())) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_59()) . "</td>";

                            echo "</tr>	";
                            //$tot_pot = $tot_pot  + $value->get_amount() ;	
                        }
                    }
                }
                ?>
            </tbody>
    </table>
</div>

<!-- Blok Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="DataRealisasiTransfer" enctype="multipart/form-data">

                <div class="modal-body">
	                <div id="winvoice" class="alert alert-danger"></div>


<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            <option value='' selected>- Semua KPPN -</option>
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



                    <!--label class="isian">Kode Satker: </label>
                    <input type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)) {
    echo $this->kdsatker;
} ?>">
                    
                    </select-->


                    <div id="wkdkppn" class="alert alert-danger"></div>
                    <label class="isian">Satker: </label>
                    <select class="form-control" type="text" name="kdsatker" id="kdsatker">
                        <!--option value='' selected>- pilih -</option-->
                        <?php
                        foreach ($this->data2 as $value1)
                            echo "<option value = '" . $value1->get_satker() . "'>" . $value1->get_satker() . " | " . $value1->get_dipa() . "</option>";
                        //if ($kode_kppn==$value1->get_kd_d_kppn()){echo "<option value='".$value1->get_kd_d_kppn()."' selected>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";} 
                        //else {echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";}
                        ?>
                    </select>
                    <br/>
                    <div id="wkdkppn" class="alert alert-danger"></div>
                    <label class="isian">Kode Lokasi: </label>
                    <select class="form-control" type="text" name="kdlokasi" id="kdlokasi">
                        <option value='' selected>- pilih -</option>
<?php
foreach ($this->data4 as $value1)
    echo "<option value = '" . $value1->get_lokasi() . "'>" . $value1->get_lokasi() . " | " . $value1->get_nmlokasi() . "</option>";
?>
                    </select>
                    <br/>
                   <!--  <div id="wtgl" class="alert alert-danger"></div>
                    <label class="isian">Tanggal: </label>
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div> -->


                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Blok Skrip -->
<script type="text/javascript">
    $(function(){
        hideErrorId();
        hideWarning();
        
    });
    
    function cek_upload(){
        jml = 0;
        
        if (($('#nmsatker').val().length == 0) && ($('#kdsatker').val().length == 0) && ($('#revisi').val().length == 0) && ($('#kdkppn').val().length == 0)) {
			$('#winvoicea').html('Isi salah satu kolom terlebih dahulu.');
            $('#winvoicea').fadeIn();
            jml++;
        }
        
		if(($('#kdsatker').val().length != 6) && ($('#kdsatker').val().length > 0)){
			$('#winvoice').html('Kode Satker harus 6 digit.');
            $('#winvoice').fadeIn();
            jml++;
        }
        
		if(jml>0){
            return false;
        } 
    }
    
    function hideErrorId(){
        $('.alert').fadeOut(0);
    }

    function hideWarning(){
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });

    }
    
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
    
</script>