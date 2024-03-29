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
                <h2>Daftar NTPN Terindikasi Ganda  <?php //echo Tanggal::bulan_indo($this->d_bulan); ?></h2>
				
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
			 <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
			    					
			if (isset($this->d_bulan)) {
				$kdbulan = $this->d_bulan;
			} else {
				$kdbulan = "null";
			}
			if (isset($this->d_kd_kppn)) {
				$kdkppn = $this->d_kd_kppn;
			} else {
				$kdkppn = "null";
			}		
			?>
            <div class="btn-group-sm">
                <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo URL; ?>PDF/NTPNGanda_PDF/<?php echo $kdbulan . "/" . $kdkppn; ?>/PDF">PDF</a></li>
                        <li><a href="<?php echo URL; ?>PDF/NTPNGanda_PDF/<?php echo $kdbulan . "/" . $kdkppn; ?>/XLS">EXCEL</a></li>
                      </ul>
            </div>
			
			<?php
			//-------------------------					                
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
                    }
                }
                if (isset($this->d_bulan)) {
                    echo "Bulan : ".  Tanggal::bulan_indo($this->d_bulan);
                } else {
                    echo "Bulan : SEMUA BULAN";
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
    <table class="footable">
   
        <!--baris pertama-->
        <thead>
            <tr>
                <th class='mid'>No.</th>
                <th class='ratatengah'>Kode KPPN</th>
				<th class='ratatengah'>NTPN</th>
				<th class='ratatengah'>Bulan</th>
				<th class='ratatengah'>Tanggal Buku</th>
                <th class='ratakanan'>Nilai</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data NTPN ganda untuk bulan ini.</div>";
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td class='mid'>" . $no++ . "</td>";
						echo "<td>" . $value->get_segment2() . "</td>";
						//echo "<td>" . $value->get_ntpn() . "</td>";
						echo "<td><a href=" . URL . "dataGR/DetailNTPNGanda/" . $value->get_ntpn() . ">" . $value->get_ntpn() . "</a></td>";
						echo "<td>" . $value->get_segment1() . "</td>";
						echo "<td>" . $value->get_gl_date() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_amount()) . "</td>";
                        
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
    
<!--div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12" style="text-align: right">
                
                <input class='btn btn-default' style='width:100%' id='submit' class='sukses' type='submit' name='submit_file2' value='Unduh' onClick=''>
                
            </div>
            
        </div>
    </div>
</div-->
    
    


<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="NTPNGanda" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>

                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display: none"></div>
                        <label class="isian">Kode KPPN: </label>
                    
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            
                            <?php foreach ($this->kppn_list as $value1) { ?>
                            
                                <?php if ($kode_kppn == $value1->get_kd_d_kppn()) { ?>
                            
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
                        <option value='01' <?php if ($this->d_bulan == '01') {
    echo "selected";
} ?> >JANUARI</option>
                        <option value='02' <?php if ($this->d_bulan == '02') {
    echo "selected";
} ?> >FEBRUARI</option>
                        <option value='03' <?php if ($this->d_bulan == '03') {
    echo "selected";
} ?> >MARET</option>
                        <option value='04' <?php if ($this->d_bulan == '04') {
    echo "selected";
} ?> >APRIL</option>
                        <option value='05' <?php if ($this->d_bulan == '05') {
    echo "selected";
} ?> >MEI</option>
                        <option value='06' <?php if ($this->d_bulan == '06') {
    echo "selected";
} ?> >JUNI</option>
                        <option value='07' <?php if ($this->d_bulan == '07') {
    echo "selected";
} ?> >JULI</option>
                        <option value='08' <?php if ($this->d_bulan == '08') {
    echo "selected";
} ?> >AGUSTUS</option>
                        <option value='09' <?php if ($this->d_bulan == '09') {
    echo "selected";
} ?> >SEPTEMBER</option>
                        <option value='10' <?php if ($this->d_bulan == '10') {
    echo "selected";
} ?> >OKTOBER</option>
                        <option value='11' <?php if ($this->d_bulan == '11') {
    echo "selected";
} ?> >NOVEMBER</option>
                        <option value='12' <?php if ($this->d_bulan == '12') {
    echo "selected";
} ?> >DESEMBER</option>
                        <!--option value='Validated' <?php //if ($this->status==Validated){echo "selected";} ?>>Validated</option>
                        <option value='Error' <?php //if ($this->status==Error){echo "selected";} ?>>Error</option-->

                    </select>

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