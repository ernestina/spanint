<div id="top">
	<div id="header">
        <h2>HOLD INVOICE <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?><br>
			KPPN <?php echo $nama_kppn; ?>
		</h2>
    </div>

<a href="#xModal" class="modal">FILTER DATA</a><br><br>
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="RealisasiFA" enctype="multipart/form-data">
		
		<div id="winvoice" class="error"></div>
		<label class="isian">Satker: </label>
		<input type="text" name="satker" id="satker" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">
		
		<div id="winvoice" class="error"></div>
		<label class="isian">Akun: </label>
		<input type="text" name="satker" id="satker" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">

		<div id="wtgl" class="error"></div>
		<label class="isian">Tanggal: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>" /> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>"></li>
		</ul>


		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick="return cek_upload();"></li>
		<!--onClick="konfirm(); return false;"-->
		</ul>
	</form>
</div>
</div>
</div>



<div id="fitur">
		<table class="table-bordered zebra scroll" width="100%">
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
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var v_invoice = document.getElementById('invoice').value;
		
        var jml = 0;
		if(v_invoice==''){
			$('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
            jml++;
        }
		if(jml>0){
            return false;
        } 
    }
</script>