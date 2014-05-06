<div id="top">
	<div id="header">
        <h2>Detail SP2D <?php 
		if ($this->d_jendok==1) {
			echo "Gaji ";
		} else if ($this->d_jendok==2) {
			echo "Non-Gaji ";
		} else if ($this->d_jendok==3) {
			echo "Retur ";
		} else if ($this->d_jendok==4) {
			echo "Void ";
		} else {
			echo "";
		}
		echo $this->d_bank;?><br>
			<?php echo "Tanggal : ".date("d-m-Y",strtotime($this->d_tgl_awal))." s.d ".date("d-m-Y",strtotime($this->d_tgl_akhir)); ?>
			 <?php if (Session::get('role') == ADMIN) {echo "KPPN ".$this->d_kdkppn;} //else{echo Session::get('user');} ?>
		</h2>
    </div>

<!--<a href="#oModal" class="modal">FILTER DATA</a><br><br>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>
	
	<div id="top">	
		<form method="POST" action="detailSp2dGaji" enctype="multipart/form-data">
		<?php if (Session::get('role') == ADMIN) { ?>
		<div id="wkdkppn" class="error"></div>
		<label class="isian">Kode KPPN: </label>
		<input type="number" name="kdkppn" id="kdkppn" size="3" value="<?php if (isset($this->d_kdkppn)){echo $this->d_kdkppn;}?>">
		<?php } ?>
		
		<div id="wbulan" class="error"></div>
		<label class="isian">Bulan: </label>
		<select type="text" name="bulan" id="bulan" style="margin-top: 10px; padding-top: 7px; float: right">
			<option value='01' <?php if ($this->d_bulan=='01'){echo "selected";}?> >Januari</option>
			<option value='02' <?php if ($this->d_bulan=='02'){echo "selected";}?> >Februari</option>
			<option value='03' <?php if ($this->d_bulan=='03'){echo "selected";}?> >Maret</option>
			<option value='04' <?php if ($this->d_bulan=='04'){echo "selected";}?> >April</option>
			<option value='05' <?php if ($this->d_bulan=='05'){echo "selected";}?> >Mei</option>
			<option value='06' <?php if ($this->d_bulan=='06'){echo "selected";}?> >Juni</option>
			<option value='07' <?php if ($this->d_bulan=='07'){echo "selected";}?> >Juli</option>
			<option value='08' <?php if ($this->d_bulan=='08'){echo "selected";}?> >Agustus</option>
			<option value='09' <?php if ($this->d_bulan=='09'){echo "selected";}?> >September</option>
			<option value='10' <?php if ($this->d_bulan=='10'){echo "selected";}?> >Oktober</option>
			<option value='11' <?php if ($this->d_bulan=='11'){echo "selected";}?> >November</option>
			<option value='12' <?php if ($this->d_bulan=='12'){echo "selected";}?> >Desember</option>
		</select>
		
		<div id="wbank" class="error"></div>
		<label class="isian">Nama Bank: </label>
		<select type="text" name="bank" id="bank">
			<option value=''>- pilih -</option>
			<option value='MDRI' <?php if ($this->d_bank==MDRI){echo "selected";}?>>Mandiri</option>
			<option value='BRI' <?php if ($this->d_bank==BRI){echo "selected";}?>>BRI</option>
			<option value='BNI' <?php if ($this->d_bank==BNI){echo "selected";}?>>BNI</option>
			<option value='BTN' <?php if ($this->d_bank==BTN){echo "selected";}?>>BTN</option>
			<option value='SEMUA_BANK' <?php if ($this->d_bank==SEMUA_BANK){echo "selected";}?>>SEMUA BANK</option>
		</select>

		<ul class="inline" style="margin-left: 150px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
		</ul>
	</form>
</div>
</div>
</div>-->
<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th width='100px'>Tgl Selesai SP2D</th>
					<th width='100px'>Tgl SP2D</th>
					<th>No. SP2D</th>
					<!--th>Status</th-->
					
					<!--th>No. Transaksi</th-->
					<th>No. Invoice</th>
					<th>Jumlah Rp</th>
					<th>Nama Bank</th>
					<th width='500px'>Deskripsi</th>
					
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
					foreach ($this->data as $value){ 
						echo "<tr>	";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_creation_date() . "</td>";
							echo "<td>" . $value->get_payment_date() . "</td>";
							echo "<td>" . $value->get_check_number() . "</td>";
							//echo "<td>" . $value->get_return_code() . "</td>";
							
							//echo "<td>" . $value->get_check_number_line_num() . "</td>";
							echo "<td>" . $value->get_invoice_num() . "</td>";
							echo "<td class='ratakanan'>" . $value->get_check_amount() . "</td>";
							echo "<td>" . $value->get_bank_account_name() . "</td>";
							echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
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
    $(function(){
        hideErrorId();
        hideWarning();
		
		$("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
		});
		
		$("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
		});
    });
	
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
		
        $('#nosp2d').keyup(function() {
            if (document.getElementById('nosp2d').value != '') {
                $('#wsp2d').fadeOut(200);
            }
        })
		
		$('#barsp2d').keyup(function(){
            if(document.getElementById('barsp2d').value !=''){
                $('#wbarsp2d').fadeOut(200);
            }
        });
		
		$('#kdsatker').keyup(function(){
            if(document.getElementById('kdsatker').value !=''){
                $('#wsatker').fadeOut(200);
            }
        });
		
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });
		
		$('#bank').change(function(){
            if(document.getElementById('bank').value !=''){
                $('#wbank').fadeOut(200);
            }
        });
		
		$('#datepicker').change(function(){
            if(document.getElementById('datepicker').value !='' && document.getElementById('datepicker1').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#datepicker1').change(function(){
            if(document.getElementById('datepicker').value !='' && document.getElementById('datepicker1').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#fxml').keyup(function(){
            if(document.getElementById('fxml').value !=''){
                $('#wfxml').fadeOut(200);
            }
        });

    }
	
    function cek_upload(){
		var pattern = '^[0-9]+$';
		var v_nosp2d = document.getElementById('nosp2d').value;
		var v_barsp2d = document.getElementById('barsp2d').value;
		var v_kdsatker = document.getElementById('kdsatker').value;
		var v_invoice = document.getElementById('invoice').value;
		var v_bank = document.getElementById('bank').value;
		var v_tglawal = document.getElementById('datepicker').value;
		var v_tglakhir = document.getElementById('datepicker1').value;
		var v_fxml = document.getElementById('fxml').value;
		
        var jml = 0;
        if(v_nosp2d=='' && v_barsp2d=='' && v_kdsatker==''&& v_invoice=='' && v_bank=='' && v_tglawal=='' && v_tglakhir=='' && v_fxml==''){
            $('#wsp2d').html('Harap isi salah satu parameter');
            $('#wsp2d').fadeIn();
			$('#wbarsp2d').html('Harap isi salah satu parameter');
            $('#wbarsp2d').fadeIn();
			$('#wsatker').html('Harap isi salah satu parameter');
            $('#wsatker').fadeIn();
			$('#winvoice').html('Harap isi salah satu parameter');
            $('#winvoice').fadeIn();
			$('#wbank').html('Harap isi salah satu parameter');
            $('#wbank').fadeIn();
			$('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
			$('#wfxml').html('Harap isi salah satu parameter');
            $('#wfxml').fadeIn();
            jml++;
        }
		
		if(v_nosp2d !='' && v_nosp2d.length != 15 ){
            $('#wsp2d').html('No. SP2D harus 15 digit');
            $('#wsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_nosp2d !='' && !v_nosp2d.match(pattern)){
            var wsp2d = 'No SP2D harus dalam bentuk angka!';
            $('#wsp2d').html(wsp2d);
            $('#wsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_barsp2d !='' && v_barsp2d.length != 21 ){
            $('#wbarsp2d').html('No. Transaksi harus 21 digit');
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_barsp2d !='' && !v_barsp2d.match(pattern)){
            var wbarsp2d = 'No Transaksi harus dalam bentuk angka!';
            $('#wbarsp2d').html(wbarsp2d);
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_kdsatker !='' && v_kdsatker.length != 6 ){
            $('#wsatker').html('Kode Satker harus 6 digit');
            $('#wsatker').fadeIn(200);
            jml++;
        }
		
		if(v_kdsatker !='' && !v_kdsatker.match(pattern)){
            var wsatker = 'No Transaksi harus dalam bentuk angka!';
            $('#wsatker').html(wbarsp2d);
            $('#wsatker').fadeIn(200);
            jml++;
        }
		
		if(v_invoice !='' && v_invoice.length != 18 ){
            $('#winvoice').html('No. invoice harus 18 digit');
            $('#winvoice').fadeIn(200);
            jml++;
        }
		
		if(v_tglawal>v_tglakhir){
            $('#wtgl').html('Tanggal awal tidak boleh melebihi tanggal akhir');
            $('#wtgl').fadeIn(200);
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
	
	$(document).ready( function () {
		var oTable = $('#fixheader').dataTable( {
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
		} );
				
		var keys = new KeyTable( {
			"table": document.getElementById('fixheader'),
			"datatable": oTable
		} );
	} );
</script>