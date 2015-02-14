<div id="top">
    <div id="header">
        <h2>DAFTAR SP2D SATKER <br> 
            <?php
            $nmsatker = '';
            foreach ($this->data as $value) {
                $nmsatker = $value->get_nmsatker();
            }
            echo $nmsatker;
            ?>

        </h2>
    </div>
	 <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
		<button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		
	</div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                
					<?php
				//----------------------------------------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : SP2DSatker.php  
				if (Session::get('role') == ADMIN ||
					Session::get('role') == KANWIL ) {

					if (isset($this->d_kd_satker)) {
						$satker = $this->d_kd_satker;
					}else{
					   foreach ($this->data as $value) {
							$satker = substr($value->get_invoice_num(), 7, 6);
						}
					}
					if (isset($this->jendok)) {
						$jendok = $this->jendok;
					}else{
						$jendok = 'null';
					}
					if (isset($this->d_invoice)) {
						$check_number = $this->d_invoice;
					}else{
						$check_number = 'null';
					}
					if (isset($this->invoice)) {
						$invoice = $this->invoice;
					}else{
						$invoice = 'null';
					}
					if (isset($this->JenisSP2D)) {
						$JenisSP2D = $this->JenisSP2D;
					}else{
						$JenisSP2D = 'null';
					}
					if (isset($this->JenisSPM)) {
						$JenisSPM = $this->JenisSPM;
					}else{
						$JenisSPM = 'null';
					}
					if (isset($this->d_tgl_awal)) {
						$kdtgl_awal = $this->d_tgl_awal;
					}else{
						$kdtgl_awal = 'null';
					}
					if (isset($this->d_tgl_akhir)) {
						$kdtgl_akhir = $this->d_tgl_akhir;
					}else{
						 $kdtgl_akhir = 'null';
					}
				  
					//----------------------------------------------------		
			
				}	
				if (Session::get('role') == KPPN) {

					if (isset($this->d_kd_satker)) {
						$satker = $this->d_kd_satker;
					}else{
					   foreach ($this->data as $value) {
							$satker = substr($value->get_invoice_num(), 7, 6);
						}
					}
					if (isset($this->jendok)) {
						$jendok = $this->jendok;
					}else{
						$jendok = 'null';
					}	   
					if (isset($this->d_invoice)) {
						$check_number = $this->d_invoice;
					}else{
						$check_number = 'null';
					}
					if (isset($this->invoice)) {
						$invoice = $this->invoice;
					}else{
						$invoice = 'null';
					}
					if (isset($this->JenisSP2D)) {
						$JenisSP2D = $this->JenisSP2D;
					}else{
						$JenisSP2D = 'null';
					}
					if (isset($this->JenisSPM)) {
						$JenisSPM = $this->JenisSPM;
					}else{
						$JenisSPM = 'null';
					}
					if (isset($this->d_tgl_awal)) {
						$kdtgl_awal = $this->d_tgl_awal;
					}else{
						$kdtgl_awal = 'null';
					}
					if (isset($this->d_tgl_akhir)) {
						$kdtgl_akhir = $this->d_tgl_akhir;
					}else{
						 $kdtgl_akhir = 'null';
					}
				  
					//----------------------------------------------------		
				
				}  

				if (Session::get('role') == SATKER) {

					   
					if (isset($this->d_kd_satker)) {
						$satker = $this->d_kd_satker;
					}else{
						$satker = Session::get('kd_satker');
					}
					if (isset($this->jendok)) {
						$jendok = $this->jendok;
					}else{
						$jendok = 'null';
					}
					   
					if (isset($this->d_invoice)) {
						$check_number = $this->d_invoice;
					}else{
						$check_number = 'null';
					}

					if (isset($this->invoice)) {
						$invoice = $this->invoice;
					}else{
						$invoice = 'null';
					}

					if (isset($this->JenisSP2D)) {
						$JenisSP2D = $this->JenisSP2D;
					}else{
						$JenisSP2D = 'null';
					}
					if (isset($this->JenisSPM)) {
						$JenisSPM = $this->JenisSPM;
					}else{
						$JenisSPM = 'null';
					}
					if (isset($this->d_tgl_awal)) {
						$kdtgl_awal = $this->d_tgl_awal;
					}else{
						$kdtgl_awal = 'null';
					}
					if (isset($this->d_tgl_akhir)) {
						$kdtgl_akhir = $this->d_tgl_akhir;
					}else{
						 $kdtgl_akhir = 'null';
					}
				  		
				
				}  
				 ?>
				   <a href="<?php echo URL; ?>PDF/daftarsp2d_PDF/<?php echo $satker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $jendok . "/" . $check_number . "/" . $invoice . "/" . $JenisSP2D . "/" . $JenisSPM; ?>/PDF" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
				</div>
				<div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
				   <a href="<?php echo URL; ?>PDF/daftarsp2d_PDF/<?php echo $satker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $jendok . "/" . $check_number . "/" . $invoice . "/" . $JenisSP2D . "/" . $JenisSPM; ?>/XLS" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>

					<?php			
					//----------------------------------------------------

		?>
            </div>           

    <a href="#xModal" class="modal">FILTER DATA</a><br><br>
    <div id="xModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
            $_SERVER['PHP_SELF'];
            ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
            <div id="top">
                <form method="POST" action="#" enctype="multipart/form-data">
                    <div id="winvoice" class="error"></div>

                    <label class="isian">No SP2D: </label>
                    <input type="text" name="check_number" id="check_number" value="<?php if (isset($this->check_number)) {
                echo $this->check_number;
            } ?>">

                    <label class="isian">Nomor Invoice: </label>
                    <input type="text" name="invoice" id="invoice" value="<?php if (isset($this->invoice)) {
                echo $this->invoice;
            } ?>">

                    <label class="isian">Jenis SP2D: </label>
                    <select type="text" name="JenisSP2D" id="JenisSP2D">
                        <option value=''>- pilih -</option>
                        <option value='GAJI' <?php if ($this->status == "GAJI") {
                echo "GAJI";
            } ?>>GAJI</option>
                        <option value='NON GAJI' <?php if ($this->status == "NON GAJI") {
                echo "NON GAJI";
            } ?>>NON GAJI</option>
                        <option value='RETUR' <?php if ($this->status == "RETUR") {
                echo "RETUR";
            } ?>>RETUR</option>	
                        <option value='LAINNYA' <?php if ($this->status == "LAINNYA") {
                echo "LAINNYA";
            } ?>>LAINNYA</option>	
                    </select>

                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal SP2D: </label>
                    <ul class="inline">
                        <li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->tgl_awal)) {
                echo $this->tgl_awal;
            } ?>" /> </li> <li>s/d</li>
                        <li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->tgl_akhir)) {
                echo $this->tgl_akhir;
            } ?>"></li>
                    </ul>

                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""></li>
                        <!--onClick="konfirm(); return false;"-->
                    </ul>
                </form>
            </div>
        </div>
    </div>
<?php
// untuk menampilkan last_update
if (isset($this->last_update)) {
    foreach ($this->last_update as $last_update) {
        echo "Update Data Terakhir (Waktu Server)  "
        ?> <br/>
        <?php
        echo $last_update->get_last_update() . " WIB";
    }
}
?>


    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader' style='font-size: 72%'>
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <th>Nomor SP2D</th>
            <th width='70px'>Tanggal Selesai SP2D</th>
            <th width='70px'>Tanggal SP2D</th>
            <th>Nilai SP2D </th>
            <th>Mata Uang </th>
            <th>Rate </th>
            <th>Tanggal Rate </th>
            <th>Nilai SP2D Ekuivalen </th>
            <th>Bank </th>
            <th>Nomor Invoice</th>
            <th width='70px'>Tanggal Invoice</th>
            <th width='70px'>Jenis SP2D</th>
            <th width='300px'>Description</th>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_check_number() . "</td>";
                            echo "<td>" . $value->get_creation_date() . "</td>";
                            echo "<td>" . $value->get_check_date() . "</td>";
                            echo "<td class='ratakanan'>" . number_format($value->get_amount()) . "</td>";
                            echo "<td>" . $value->get_currency_code() . "</td>";
                            echo "<td>" . number_format($value->get_exchange_rate()) . "</td>";
                            echo "<td>" . $value->get_exchange_date() . "</td>";
                            echo "<td>" . number_format($value->get_base_amount()) . "</td>";
                            echo "<td>" . $value->get_attribute6() . "</td>";
                            echo "<td><a href=" . URL . "dataSPM/HistorySpm/" . $value->get_invoice_num() . "/" . $value->get_check_number() . " >" . $value->get_invoice_num() . "</a></td>";
                            echo "<td>" . $value->get_invoice_date() . "</td>";
                            echo "<td>" . $value->get_jenis_sp2d() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_description() . "</td>";



                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();

        $("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
        });

        $("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
        });
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

    $(document).ready(function() {
        var oTable = $('#fixheader').dataTable({
            "sScrollY": 400,
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "bSort": false,
            "bPaginate": false,
            "bInfo": null,
            "bFilter": false,
            "oLanguage": {
                "sEmptyTable": "Tidak ada data di dalam tabel ini."

            },
        });

        var keys = new KeyTable({
            "table": document.getElementById('fixheader'),
            "datatable": oTable
        });
    });
</script>