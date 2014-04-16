<div id="top">
	<div id="header">
        <h2>MONITORING SP2D - BANK <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?><br>
			KPPN <?php echo $nama_kppn; ?>
		</h2>
    </div>
</div>
<div id="top">
	<div id="kiri">
	<form method="POST" action="posisiSpm" enctype="multipart/form-data">
		
		<div id="winvoice" class="error"></div>
		No Invoice: <br>
		<input type="number" name="invoice" id="invoice">

		<div id="wtgl" class="error"></div>
		Tanggal: <br>
		<ul class="inline">
		<li style="margin-left: -40px"><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="" /> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir"></li>
		</ul>

		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

		<ul class="inline">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick="return cek_upload();"></li>
		<!--onClick="konfirm(); return false;"-->
		</ul>
	</form>
</div>



<div id="kanan">
		<table class="table-bordered zebra scroll" width="100%">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Nomor Invoce</th>
					<th>Nilai Invoice</th>
					<th>Tanggal Invoice</th>
					<th>Nama File</th>
					<th>Status Code</th>
					<th>Supplier</th>
					<th>Site Supplier</th>
					<th>Uraian Invoice</th>
					<th>Nama Kolom</th>
					<th>Nilai Kolom</th>
					<th>Error Message</th>
					
			</thead>
			<tbody>
			<?php 
			$no=1;
			//var_dump ($this->data);
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_invoice_num() . "</td>";
					echo "<td>" . $value->get_invoice_amount() . "</td>";
					echo "<td>" . $value->get_invoice_date() . "</td>";
					echo "<td>" . $value->get_file_name() . "</td>";
					echo "<td>" . $value->get_status_code() . "</td>";
					echo "<td>" . $value->get_vendor_name() . "</td>";
					echo "<td>" . $value->get_vendor_site_code() . "</td>";
					echo "<td>" . $value->get_description() . "</td>";
					echo "<td>" . $value->get_column_name() . "</td>";
					echo "<td>" . $value->get_column_value() . "</td>";
					echo "<td>" . $value->get_error_message() . "</td>";
					
				echo "</tr>	";
			} 
			?>
			</tbody>
        </table>
		</div>
</div>

<script type="text/javascript">
    $(function(){
        hideErrorId();
        hideWarning();
        
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
        $('#nosp2d').change(function(){
            if(document.getElementById('nosp2d').value !=''){
                $('#wsp2d').fadeOut(200);
            }
        });
		
		$('#barsp2d').change(function(){
            if(document.getElementById('barsp2d').value !=''){
                $('#wbarsp2d').fadeOut(200);
            }
        });
		$('#invoice').change(function(){
            if(document.getElementById('invoice').value !=''){
                $('#wpdf2').fadeOut(200);
            }
        });
		$('#bank').change(function(){
            if(document.getElementById('bank').value !=''){
                $('#wbank').fadeOut(200);
            }
        });
		$('#fxml').change(function(){
            if(document.getElementById('fxml').value !=''){
                $('#wfxml').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var v_nosp2d = document.getElementById('nosp2d').value;
		var v_barsp2d = document.getElementById('barsp2d').value;
		var v_invoice = document.getElementById('invoice').value;
		var v_bank = document.getElementById('bank').value;
		var v_tglawal = document.getElementById('tgl_awal').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		var v_fxml = document.getElementById('fxml').value;
		
        var jml = 0;
        if(v_nosp2d=='' && v_barsp2d=='' && v_invoice=='' && v_bank=='' && v_tglawal=='' && v_tglakhir=='' && v_fxml==''){
            $('#wsp2d').html('Harap isi salah satu parameter');
            $('#wsp2d').fadeIn();
			$('#wbarsp2d').html('Harap isi salah satu parameter');
            $('#wbarsp2d').fadeIn();
			
			
            jml++;
        }else{
            var fsplit = file_upload.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='spm';
            if(!cek_file){
                $('#wspm').html('File harus ber extensi spm, contoh 123456789.spm!');
                $('#wspm').fadeIn();
                jml++;
            } 
        }
		
		if(file_upload1==''){
            $('#wpdf1').html('File belum dipilih!');
            $('#wpdf1').fadeIn();
            jml++;
        }else{
            var fsplit = file_upload1.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf1').html('File harus ber extensi pdf, contoh abcdefghij.pdf!');
                $('#wpdf1').fadeIn();
                jml++;
            } 
        }
		
		if(file_upload2!='') {
			var fsplit = file_upload2.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf2').html('File tidak sesuai dengan format!');
                $('#wpdf2').fadeIn();
                jml++;
			}
		}
		
		if(file_upload3!='') {
			var fsplit = file_upload3.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf3').html('File tidak sesuai dengan format!');
                $('#wpdf3').fadeIn();
                jml++;
			}
		}
		
		if(file_upload4!='') {
			var fsplit = file_upload4.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf4').html('File tidak sesuai dengan format!');
                $('#wpdf4').fadeIn();
                jml++;
			}
		}
		
		if(file_upload5!='') {
			var fsplit = file_upload5.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf5').html('File tidak sesuai dengan format!');
                $('#wpdf5').fadeIn();
                jml++;
			}
		}
		
		if(file_upload6!='') {
			var fsplit = file_upload6.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf6').html('File tidak sesuai dengan format!');
                $('#wpdf6').fadeIn();
                jml++;
			}
		}
		
		if(file_upload7!='') {
			var fsplit = file_upload7.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf7').html('File tidak sesuai dengan format!');
                $('#wpdf7').fadeIn();
                jml++;
			}
		}
		
		if(file_upload8!='') {
			var fsplit = file_upload8.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf8').html('File tidak sesuai dengan format!');
                $('#wpdf8').fadeIn();
                jml++;
			}
		}
		
		if(file_upload9!='') {
			var fsplit = file_upload9.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf9').html('File tidak sesuai dengan format!');
                $('#wpdf9').fadeIn();
                jml++;
			}
		}
		
		if(file_upload10!='') {
			var fsplit = file_upload10.split('.');
            var ext = fsplit[fsplit.length-1];
            var cek_file = ext=='pdf';
            if(!cek_file){
                $('#wpdf10').html('File tidak sesuai dengan format!');
                $('#wpdf10').fadeIn();
                jml++;
			}
		}
		
        if(jml>0){
            return false;
        } 
    }
</script>