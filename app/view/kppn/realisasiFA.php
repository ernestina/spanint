<div id="top">
	<div id="header">
        <h2>REALISASI FA <?php echo Session::get('user'); ?><br>
		</h2>
    </div>

<a href="#wModal" class="modal">FILTER DATA</a><br><br>
        <div id="wModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="RealisasiFA" enctype="multipart/form-data">
		
		<div id="wkdsatker" class="error"></div>
		<label class="isian">Satker: </label>
		<input type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->satker_code)){echo $this->satker_code;}?>">
		
		<div id="wakun" class="error"></div>
		<label class="isian">Akun: </label>
		<input type="text" name="akun" id="akun" value="<?php if (isset($this->account_code)){echo $this->account_code;}?>">
		
		<div id="woutput" class="error"></div>
		<label class="isian">Output : </label>
		<input type="text" name="output" id="output">
		
		<div id="wprogram" class="error"></div>
		<label class="isian">Program : </label>
		<input type="text" name="program" id="program">

		<!--<div id="wtgl" class="error"></div>
		<label class="isian">Tanggal: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="datepicker2" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>" /> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="datepicker3" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>"></li>
		</ul>-->

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick="return cek_upload();"></li>
		</ul>
	</form>
</div>
</div>
</div>
<div id="fitur">
		<table width="100%" class="table table-bordered zebra scroll">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Satker</th>
					<th>KPPN</th>
					<th>Akun</th>
					<th>Program</th>
					<th>Output</th>
					<th>Dana</th>
					<th>Bank</th>
					<th>Kewenangan</th>
					<th>Lokasi</th>
					<th>Budget Type</th>
					<th>Currency_code</th>
					<th>Budget Amount</th>
					<th>Encumbrance Amount</th>
					<th>Actual Amount</th>
					<th>Balancing Amount</th>
			</thead>
			<tbody>
			<?php 
			$no=1;
			//var_dump ($this->data);
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_satker() . "</td>";
					echo "<td>" . $value->get_kppn() . "</td>";
					echo "<td>" . $value->get_akun() . "</td>";
					echo "<td>" . $value->get_program() . "</td>";
					echo "<td>" . $value->get_output() . "</td>";
					echo "<td>" . $value->get_dana() . "</td>";
					echo "<td>" . $value->get_bank() . "</td>";
					echo "<td>" . $value->get_kewenangan() . "</td>";
					echo "<td>" . $value->get_lokasi() . "</td>";
					echo "<td>" . $value->get_budget_type() . "</td>";
					echo "<td>" . $value->get_currency_code() . "</td>";
					echo "<td>" . $value->get_budget_amt() . "</td>";
					echo "<td>" . $value->get_encumbrance_amt() . "</td>";
					echo "<td>" . $value->get_actual_amt() . "</td>";
					echo "<td>" . $value->get_balancing_amt() . "</td>";
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
        $('#kdsatker').change(function(){
            if(document.getElementById('kdsatker').value !=''){
                $('#wkdsatker').fadeOut(200);
            }
        });
		
		$('#akun').change(function(){
            if(document.getElementById('akun').value !=''){
                $('#wakun').fadeOut(200);
            }
        });
		
		$('#output').change(function(){
            if(document.getElementById('output').value !=''){
                $('#woutput').fadeOut(200);
            }
        });
		
		$('#program').change(function(){
            if(document.getElementById('output').value !=''){
                $('#wprogram').fadeOut(200);
            }
        });
		
		$('#datepicker2').change(function(){
            if(document.getElementById('datepicker2').value !='' && document.getElementById('datepicker3').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#datepicker3').change(function(){
            if(document.getElementById('datepicker2').value !='' && document.getElementById('datepicker3').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });

    }
    
    function cek_upload(){
		var pattern = '^[0-9]+$';
		var v_kdsatker = document.getElementById('kdsatker').value;
		var v_akun = document.getElementById('akun').value;
		var v_tglawal = document.getElementById('datepicker2').value;
		var v_tglakhir = document.getElementById('datepicker3').value;
		
        var jml = 0;
        if(v_kdsatker=='' && v_akun=='' && v_output=='' && v_program=='' && v_tglawal=='' && v_tglakhir=='' ){
            $('#wkdsatker').html('Harap isi salah satu parameter');
            $('#wkdsatker').fadeIn();
			$('#wakun').html('Harap isi salah satu parameter');
            $('#wakun').fadeIn();
			$('#woutput').html('Harap isi salah satu parameter');
            $('#woutput').fadeIn();
			$('#wprogram').html('Harap isi salah satu parameter');
            $('#wprogram').fadeIn();
			$('#woutput').html('Harap isi salah satu parameter');
            $('#woutput').fadeIn();
			$('#wprogram').html('Harap isi salah satu parameter');
            $('#wprogram').fadeIn();
			$('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
            jml++;
        }
		
		if(v_kdsatker !='' && v_kdsatker.length != 6 ){
            $('#wkdsatker').html('Kode Satker harus 6 digit');
            $('#wkdsatker').fadeIn(200);
            jml++;
        }
		
		if(v_kdsatker !='' && !v_kdsatker.match(pattern)){
            var wkdsatker = 'Kode Satker harus dalam bentuk angka!';
            $('#wkdsatker').html(wkdsatker);
            $('#wkdsatker').fadeIn(200);
            jml++;
        }
		
		if(v_akun !='' && v_akun.length != 6 ){
            $('#wakun').html('Kode Akun harus 6 digit');
            $('#wakun').fadeIn(200);
            jml++;
        }
		
		if(v_akun !='' && !v_akun.match(pattern)){
            var wakun = 'Kode Akun harus dalam bentuk angka!';
            $('#wakun').html(wakun);
            $('#wakun').fadeIn(200);
            jml++;
        }
		
		if(v_output !='' && v_output.length != 7 ){
            $('#woutput').html('Kode Output harus 7 digit');
            $('#woutput').fadeIn(200);
            jml++;
        }
		
		if(v_output !='' && !v_output.match(pattern)){
            var woutput = 'Kode Akun harus dalam bentuk angka!';
            $('#woutput').html(woutput);
            $('#woutput').fadeIn(200);
            jml++;
        }
		
		if(v_program !='' && v_program.length != 7 ){
            $('#wprogram').html('Kode Akun harus 7 digit');
            $('#wprogram').fadeIn(200);
            jml++;
        }
		
		if(v_program !='' && !v_program.match(pattern)){
            var wprogram = 'Kode Akun harus dalam bentuk angka!';
            $('#wprogram').html(wprogram);
            $('#wprogram').fadeIn(200);
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
</script>