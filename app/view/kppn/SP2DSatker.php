<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Daftar SP2D Satker</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
	if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {

		   foreach ($this->data as $value) {
				$satker = substr($value->get_invoice_num(), 7, 6);
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
		   ?>
		   <a href="<?php echo URL; ?>PDF/daftarsp2d_PDF/<?php echo $satker . "/" . $check_number . "/" . $invoice . "/" . $JenisSP2D . "/" . $JenisSPM . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>


			<?php
			//----------------------------------------------------		

			
}	
 	if (Session::get('role') == KPPN) {

		   foreach ($this->data as $value) {
				$satker = substr($value->get_invoice_num(), 7, 6);
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
		   ?>
		   <a href="<?php echo URL; ?>PDF/daftarsp2d_PDF/<?php echo $satker . "/" . $check_number . "/" . $invoice . "/" . $JenisSP2D . "/" . $JenisSPM . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>


			<?php
			//----------------------------------------------------		
	
}  

 	if (Session::get('role') == SATKER) {

		   foreach ($this->data as $value) {
				$satker = substr($value->get_invoice_num(), 7, 6);
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
		   ?>
		   <a href="<?php echo URL; ?>PDF/daftarsp2d_PDF/<?php echo $satker . "/" . $check_number . "/" . $invoice . "/" . $JenisSP2D . "/" . $JenisSPM . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>


			<?php
			//----------------------------------------------------		
	
}  

    ?>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->d_kd_satker)) {
                    echo "Satker : " . $this->d_kd_satker;
                }
                if (isset($this->d_invoice)) {
                    echo "<br>No. SP2D : " . $this->d_invoice;
                }
                if (isset($this->invoice)) {
                    echo "<br>No. Invoice : " . $this->invoice;
                }
                if (isset($this->JenisSPM)) {
                    foreach ($this->data2 as $value3) {
                        if($this->JenisSPM == $value3->get_jendok()){
                            echo "<br>Jenis SPM : " . $value3->get_attribute6();
                        }
                    }
                }
                if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                    echo "<br>Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
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


<div id="table-container" class="wrapper">
    <form method='POST' action='<?php echo URL;?>dataSPM/downloadSP2D' enctype='multipart/form-data'>
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th class='mid'>No.</th>
                <th>Nomor SP2D</th>
                <th>Tanggal Selesai SP2D</th>
                <th>Tanggal SP2D</th>
                <th class='ratakanan'>Nilai SP2D </th>
                <th>Nomor Invoice</th>
                <th>Tanggal Invoice</th>
                <th class='mid'>Jenis SPM </th>
                <th>Jenis SP2D</th>
                <th>Deskripsi</th>
                <th>Pilih <input type="checkbox" onClick="toggle(this)" /> </th>
            </tr>
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
                        echo "<td class='mid'>" . $no++ . "</td>";
                        echo "<td>" . $value->get_check_number() . "</td>";
                        echo "<td>" . $value->get_creation_date() . "</td>";
                        echo "<td>" . $value->get_check_date() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_amount()) . "</td>";
						if (Session::get('role') != SATKER) {
                        echo "<td><a href=" . URL . "dataSPM/HistorySpm/" . $value->get_invoice_num() . "/" . $value->get_check_number() . ">" . $value->get_invoice_num() . "</a></td>";
						}
						else {
						echo "<td>" . $value->get_invoice_num() . "</a></td>";
						}
                        echo "<td>" . $value->get_invoice_date() . "</td>";
                        echo "<td>" . $value->get_attribute6() . "</td>";
                        echo "<td>" . $value->get_jenis_sp2d() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_description() . "</td>";
                        echo "<td><input name='checkbox[]' type='checkbox' id='checkbox' value='" . $value->get_check_number() . "'> </td>";

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
    
<div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12" style="text-align: right">
                
                <input class='btn btn-default' style='width:100%' id='submit' class='sukses' type='submit' name='submit_file2' value='Unduh' onClick=''>
                
            </div>
            
        </div>
    </div>
</div>
    
    
</form>

<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="<?php echo URL;?>dataSPM/daftarsp2d/<?php echo $this->d_kd_satker?>" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>

                    <label class="isian">No SP2D: </label>
                    <input class="form-control" type="text" name="check_number" id="check_number" value="<?php if (isset($this->d_invoice)) {
                   echo $this->d_invoice;
               } ?>">
                    <br/>
                    <label class="isian">Nomor Invoice: </label>
                    <input class="form-control" type="text" name="invoice" id="invoice" value="<?php if (isset($this->invoice)) {
                   echo $this->invoice;
               } ?>">
                    <!--br/>
                    <label class="isian">Jenis SP2D: </label>
                    <select class="form-control" type="text" name="JenisSP2D" id="JenisSP2D">
                        <option value=''>- pilih -</option>
                        <option value='GAJI' <?php if ($this->status == "GAJI") {
                   echo "GAJI";
               } ?>>GAJI</option>
                        <option value='NON%GAJI%' <?php if ($this->status == "NON GAJI") {
                   echo "NON GAJI";
               } ?>>NON GAJI</option>
                        <option value='RETUR' <?php if ($this->status == "RETUR") {
                   echo "RETUR";
               } ?>>RETUR</option>	
                        <option value='LAINNYA' <?php if ($this->status == "LAINNYA") {
                            echo "LAINNYA";
                        } ?>>LAINNYA</option>	
                    </select-->
                    <br/>
                    <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Jenis SPM: </label>
                    <select class="form-control" type="text" name="JenisSPM" id="JenisSPM">
                        <option value='' selected>- pilih -</option>
                        <?php
                        foreach ($this->data2 as $value1) {
                            if($this->JenisSPM == $value1->get_jendok()){
                                echo "<option value = '" . $value1->get_jendok() . "' selected>" . $value1->get_attribute6() . "</option>";
                            } else {
                                echo "<option value = '" . $value1->get_jendok() . "' >" . $value1->get_attribute6() . "</option>";
                            }                           
                        }
                        ?>
                    </select>
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal SP2D: </label>
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>
                        

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
    function toggle(source) {
        checkboxes = document.getElementsByName('checkbox[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    function hideErrorId() {
        $('.alert').fadeOut(0);
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