<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            <?php
			
			if (isset($this->ntpn)) {
				foreach ($this->data as $value) {
					$ntb = $value->get_file_name();
				}
			}
			?>
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Konfirmasi Penerimaan Berdasarkan NTPN dan AKUN</h2>
				<h4>NTPN: <?php echo $this->ntpn; ?> - NTB: <?php echo $ntb; ?> </h4>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                               <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
			    if (Session::get('role') == KPPN) {
                    IF(isset($this->ntpn) ){
					
							$kdkppn=Session::get('id_user');
						if (isset($this->ntpn)) {
							$kdntpn = $this->ntpn;
						} else {
							$kdntpn = "null";
						}
						
					?>
                
        <div class="btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
            </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo URL; ?>PDF/KonfirmasiPenerimaan_PDF/<?php echo $kdntpn; ?>/PDF">PDF</a></li>
                    <li><a href="<?php echo URL; ?>PDF/KonfirmasiPenerimaan_PDF/<?php echo $kdntpn; ?>/XLS">EXCEL</a></li>
                  </ul>
        </div>
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
                // $nmsatker = '';
                // foreach ($this->data as $value) {
                    // $nmsatker = $value->get_nmsatker();
                // }
                // echo $nmsatker;
                // ?>
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
				<th>NTPN</th>
				<th>NTB<br>Kode Billing</th>
                <th>Tanggal Penerimaan</th>
				<th class='ratatengah'>Nama</th>
				<th class='ratatengah'>Bagan Akun SPAN</th>
				<th>Mata Uang</th>
                <th class='ratakanan'>Nilai</th>
                <!--th>keterangan</th-->
                <th>Pilih (koreksi) <input type="checkbox" name="checkboxToggle1" onClick="toggle1(this)" /> </th>
				<th>Pilih (konfirmasi) <input type="checkbox" name="checkboxToggle2" onClick="toggle2(this)" /> </th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=8 class="align-center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td class='mid'>" . $no++ . "</td>";
						echo "<td>" . $value->get_ntpn() . "</td>";
						echo "<td>" . $value->get_file_name() . "<br>".$value->get_billingcode()."</td>";
						echo "<td>" . $value->get_gl_date() . "</td>";
						echo "<td>" . $value->get_resp_name() . "</td>";
						echo "<td>" . $value->get_segment1(). "." .$value->get_segment2(). "." .$value->get_segment3(). "." .$value->get_segment4()."." .$value->get_segment5(). "." .$value->get_segment6(). "." .$value->get_segment7(). "." .$value->get_segment8(). "." .$value->get_segment9(). "." .$value->get_segment10(). "." .$value->get_segment11(). "." .$value->get_segment12()."</td>";
						echo "<td>" . $value->get_mata_uang() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_amount()) . "</td>";
                        echo "<td><input class='check-box-1' name='checkbox1[]' type='checkbox' id='checkbox1' value='".$value->get_gr_batch_num()."'> </td>";
						echo "<td><input class='check-box-2' name='checkbox2[]' type='checkbox' id='checkbox2' value='".$value->get_gr_batch_num()."'> </td>";
                        echo "</tr>	";
                    }
                }
            } else {
                echo '<td colspan=8 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
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
            
            <form id="filter-form" method="POST" action="KonfirmasiPenerimaan" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="wntpn" class="alert alert-danger" style="display:none;"></div>

                    <label class="isian">NTPN: </label>
                    <input class="form-control" type="text" name="ntpn" id="ntpn" value="<?php if (isset($this->ntpn)) {
                   echo $this->ntpn;
					} ?>">
                    <br/>
                    
                    <div id="wbillingcode" class="alert alert-danger" style="display:none;"></div>

                    <label class="isian">Kode Billing: </label>
                    <input class="form-control" type="text" name="billingcode" id="billingcode" value="<?php if (isset($this->billingcode)) {
                   echo $this->billingcode;
					} ?>">
                    <br/>
					
					<div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Akun PNBP: </label>
                    <select class="form-control" type="text" name="akun" id="akun">
                        <option value='' >- pilih -</option>
                        <?php
                        foreach ($this->data2 as $value1)
                            if ($value1->get_segment3()==$this->akun){
                                echo "<option value = '" . $value1->get_segment3() . "' selected>" . $value1->get_segment3() . " | ". $value1->get_keterangan(). " </option>";
                            } else {
                                echo "<option value = '" . $value1->get_segment3() . "'>" . $value1->get_segment3() . " | ". $value1->get_keterangan(). " </option>";
                            }
                       
                        ?>
                    </select>
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
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
    
    function emptyToggle(what) {
        
        checkboxes = document.getElementsByName(what);
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = false;
        }
        
    }
    
    $('.check-box-1').each(function() {
        $(this).change(function() {
            if ($(this).is(':checked')) {
                emptyToggle('checkboxToggle2');
                emptyToggle('checkbox2[]');
            } else {
                emptyToggle('checkboxToggle1');
            }
        });
    });
    
    $('.check-box-2').each(function() {
        $(this).change(function() {
            if ($(this).is(':checked')) {
                emptyToggle('checkboxToggle1');
                emptyToggle('checkbox1[]');
            } else {
                emptyToggle('checkboxToggle2');
            }
        });
    });
    
    function toggle1(source) {
        checkboxes = document.getElementsByName('checkbox1[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
        emptyToggle('checkboxToggle2');
        emptyToggle('checkbox2[]');
    }
	
	function toggle2(source) {
        checkboxes = document.getElementsByName('checkbox2[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
        emptyToggle('checkboxToggle1');
        emptyToggle('checkbox1[]');
    }
	
    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#ntpn').keyup(function() {
            if (document.getElementById('ntpn').value != '') {
                $('#wntpn').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_ntpn = document.getElementById('ntpn').value;
        var v_billingcode = document.getElementById('billingcode').value;

        var jml = 0;
        if (v_ntpn == '' && v_billingcode == '') {
            $('#wntpn').html('Harap isi No NTPN atau Kode Billing');
            $('#wntpn').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }

</script>