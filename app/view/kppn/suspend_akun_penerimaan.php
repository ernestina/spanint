<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            <?php
			
			if (isset($this->data)) {
				foreach ($this->data as $value) {
					$ntb = $value->get_file_name();
				}
			}
			?>
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Suspend Akun Penerimaan <?php //echo $this->d_bulan; ?></h2>
				
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                             <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
			    if (Session::get('role') == KPPN) {
                    IF(isset($this->d_bulan) || isset($this->ntpn) ){
					
							$kdkppn=Session::get('id_user');
						if (isset($this->d_bulan)) {
							$kdbulan = $this->d_bulan;
						} else {
							$kdbulan = "null";
						}
						if (isset($this->ntpn)) {
							$kdntpn = $this->ntpn;
						} else {
							$kdntpn = "null";
						}
						
					?>
						<a href="<?php echo URL; ?>PDF/SuspendAkunPenerimaan_PDF/<?php echo $kdbulan . "/" . $kdntpn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
					<?php
					}
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
                if (isset($this->d_kd_kppn)){
                    echo "KPPN : ".$this->d_kd_kppn;                
                }
                if (isset($this->d_bulan)){
                    echo "BULAN : ".$this->d_bulan;                
                }
                if (isset($this->ntpn)){
                    echo "NTPN : ".$this->d_ntpn;                
                }
                if (isset($this->d_koreksi)){
                    echo "KOREKSI : ".$this->d_koreksi;                
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

<div id="table-container" class="wrapper">
    <form method='POST' action='downloadkonfirmasi' enctype='multipart/form-data'>
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th class='mid'>No.</th>
                <th>Tanggal Penerimaan</th>
				<th class='ratatengah'>Nama</th>
				<th class='ratatengah'>Bagan Akun SPAN</th>
				<th>Mata Uang</th>
                <th class='ratakanan'>Nilai</th>
                <!--th>keterangan</th-->
                <th>Pilih (koreksi) <input type="checkbox" onClick="toggle1(this)" /> </th>
				<!--th>Pilih (konfirmasi) <input type="checkbox" onClick="toggle2(this)" /> </th-->
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
						echo "<td>" . $value->get_gl_date() . "</td>";
						echo "<td>" . $value->get_resp_name() . "</td>";
						echo "<td>" . $value->get_segment1(). "." .$value->get_segment2(). "." .$value->get_segment3(). "." .$value->get_segment4()."." .$value->get_segment5(). "." .$value->get_segment6(). "." .$value->get_segment7(). "." .$value->get_segment8(). "." .$value->get_segment9(). "." .$value->get_segment10(). "." .$value->get_segment11(). "." .$value->get_segment12()."</td>";
						echo "<td>" . $value->get_mata_uang() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_amount()) . "</td>";
                        echo "<td><input name='checkbox1[]' type='checkbox' id='checkbox1' value='".$value->get_gr_batch_num()."'> </td>";
						//echo "<td><input name='checkbox2[]' type='checkbox' id='checkbox2' value='".$value->get_gr_batch_num()."'> </td>";
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
            
            <form id="filter-form" method="POST" action="SuspendAkunPenerimaan" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
					
					<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display: none"></div>
                        <label class="isian">Kode KPPN: </label>
                    
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            
                            <?php foreach ($this->kppn_list as $value1) { ?>
                            
                                <?php if ($this->d_kd_kppn == $value1->get_kd_d_kppn()) { ?>
                            
                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>" selected><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>
                            
                                <?php } else { ?>
                            
                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>"><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>
                            
                                <?php } ?>
                            
                            <?php } ?>
                            
                        </select>
                    
                        <br/>
                    
                    <?php } ?>
					

					
					<label class="isian">Pilih bulan: </label>
					
                    <select class="form-control" type="text" name="bulan" id="bulan">
					
						<option value="" selected>SEMUA BULAN</option>
						
                        <option value='JAN' <?php if ($this->d_bulan == 'JAN') {
    echo "selected";
} ?> >JANUARI</option>
                        <option value='FEB' <?php if ($this->d_bulan == 'FEB') {
    echo "selected";
} ?> >FEBRUARI</option>
                        <option value='MAR' <?php if ($this->d_bulan == 'MAR') {
    echo "selected";
} ?> >MARET</option>
                        <option value='APR' <?php if ($this->d_bulan == 'APR') {
    echo "selected";
} ?> >APRIL</option>
                        <option value='MAY' <?php if ($this->d_bulan == 'MAY') {
    echo "selected";
} ?> >MEI</option>
                        <option value='JUN' <?php if ($this->d_bulan == 'JUN') {
    echo "selected";
} ?> >JUNI</option>
                        <option value='JUL' <?php if ($this->d_bulan == 'JUL') {
    echo "selected";
} ?> >JULI</option>
                        <option value='AUG' <?php if ($this->d_bulan == 'AUG') {
    echo "selected";
} ?> >AGUSTUS</option>
                        <option value='SEP' <?php if ($this->d_bulan == 'SEP') {
    echo "selected";
} ?> >SEPTEMBER</option>
                        <option value='OCT' <?php if ($this->d_bulan == 'OCT') {
    echo "selected";
} ?> >OKTOBER</option>
                        <option value='NOV' <?php if ($this->d_bulan == 'NOV') {
    echo "selected";
} ?> >NOVEMBER</option>
                        <option value='DEC' <?php if ($this->d_bulan == 'DEC') {
    echo "selected";
} ?> >DESEMBER</option>
                        <!--option value='Validated' <?php //if ($this->status==Validated){echo "selected";} ?>>Validated</option>
                        <option value='Error' <?php //if ($this->status==Error){echo "selected";} ?>>Error</option-->

                    </select>
                    <br/>
                    <label class="isian">Koreksi: </label>
                    <select class="form-control" type="text" name="koreksi" id="koreksi">
                        <option value='' <?php if ($this->d_koreksi == '') {
    echo "selected";
} ?> >SEMUA</option>
                        <option value='BELUM' <?php if ($this->d_koreksi == 'BELUM') {
    echo "selected";
} ?> >Belum Koreksi</option>
                        <option value='SUDAH' <?php if ($this->d_koreksi == 'SUDAH') {
    echo "selected";
} ?> >Sudah Koreksi</option>
                    </select>
                    <br/>

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

<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();
    });
    function toggle1(source) {
        checkboxes = document.getElementsByName('checkbox1[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
	function toggle2(source) {
        checkboxes = document.getElementsByName('checkbox2[]');
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