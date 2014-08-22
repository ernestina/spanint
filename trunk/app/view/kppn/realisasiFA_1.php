<div id="top">
	<div id="header">
        <h2>INFORMASI SISA DANA DIPA SATKER <br>
		<?php $nmsatker='';
		foreach ($this->data as $value) {$nmsatker=$value->get_nm_satker();} 
		echo $nmsatker;
		?>
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
	<form method="POST" action="#" enctype="multipart/form-data">
		
		<?php  //if (Session::get('role')!=SATKER) {
		//echo "<div id='wkdsatker' class='error'></div>";
		//echo "<label class='isian'>Satker: </label>";
		//} ?>
		<!--input type="<?php 
		//if (Session::get('role')==SATKER) {echo "hidden";} else {echo "text";}?>" name="kdsatker" id="kdsatker" value="<?php //if (isset($this->satker_code)){echo $this->satker_code;}?>"-->
		
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
		</ul>--->

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
		</ul>
	</form>
</div>
</div>
</div>
<?php
                   // untuk menampilkan last_update
                   if (isset($this->last_update)){
foreach ($this->last_update as $last_update){ 
echo "Update Data Terakhir (Waktu Server)  " ?> <br/>
 <?php echo $last_update->get_last_update() . " WIB";
}
                    }
                    ?>



<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id="fixheader" style="font-size: 90%">
            <!--baris pertama-->
			<thead>
					<th class='mid'>No.</th>
					<th class='mid'>Satker</th>
					<th class='mid'>KPPN</th>
					<th class='mid'>Akun Summary</th>
					<th class='mid'>Program</th>
					<th class='mid'>Output</th>
					<th class='mid'>Dana</th>
					<!--th class='mid'>Bank</th-->
					<th>Kewenangan</th>
					<!--th class='mid'>Lokasi</th>
					<th class='mid'>Tipe Anggaran</th>
					<th>Mata Uang</th-->
					<th>Pagu</th>
					<th>Pencadangan</th>
					<th>Realisasi</th>
					<th>Sisa pagu</th>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			//$tot_budget=0;
			//$tot_actual=0;
			//$tot_encumbrance=0;
			//$tot_balancing=0;
			//var_dump ($this->data);
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
				$tot_budget=0;$tot_encumbrance=0;$tot_actual=0;$tot_balancing=0;
					foreach ($this->data as $value){ 
						echo "<tr>	";
						echo "<td>" . $no++ . "</td>";
						echo "<td>" . $value->get_satker() . "</td>";
						echo "<td>" . $value->get_kppn() . "</td>";
						echo "<td style='text-align: right'><a href=".URL."dataDIPA/RealisasiFA/".$value->get_satker()."/".$value->get_program()."/".$value->get_output()."/".$value->get_akun(). " target='_blank' '>" . $value->get_akun() . "</td>";
						echo "<td>" . $value->get_program() . "</td>";
						echo "<td>" . $value->get_output() . "</td>";
						echo "<td>" . $value->get_dana() . "</td>";
						//echo "<td>" . $value->get_bank() . "</td>";
						echo "<td>" . $value->get_kewenangan() . "</td>";
						//echo "<td>" . $value->get_lokasi() . "</td>";
						//echo "<td>" . $value->get_budget_type() . "</td>";
						//echo "<td>" . $value->get_currency_code() . "</td>";
						echo "<td style='text-align: right'>" . number_format($value->get_budget_amt()) . "</td>";
						echo "<td style='text-align: right'> " . number_format($value->get_encumbrance_amt()) . "</td>";
						echo "<td style='text-align: right'> " . number_format($value->get_actual_amt()) . "</td>";
						
						echo "<td style='text-align: right'>" . number_format($value->get_balancing_amt()) . "</td>";
						echo "</tr>	";
						$tot_budget+=$value->get_budget_amt();
						$tot_encumbrance+=$value->get_encumbrance_amt();
						$tot_actual+=$value->get_actual_amt();
						$tot_balancing+=$value->get_balancing_amt();
					
					}
				}
			} else {
				echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
			}
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan='8' class='ratatengah'><b>GRAND TOTAL<b></td>
					<td class='ratakanan'><?php echo number_format($tot_budget); ?></td>
					<td class='ratakanan'><?php echo number_format($tot_encumbrance); ?></td>
					<td class='ratakanan'><?php echo number_format($tot_actual); ?></td>
					<td class='ratakanan'><?php echo number_format($tot_balancing); ?></td>
				</tr>
			</tfoot>
        </table>
		<br>
		<br>
		<b><i>* kode B merupakan pengganti kode 5 (akun belanja) contoh B2 berarti 52, B3 berarti 53 </i></b></br>
		<b><i>* Akun summary merupakan penjumlahan dari satu atau lebih akun yang dananya dikontrol secara bersamaan </i></b></br>
		
		</div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
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
			"table": document.getElementById('example'),
			"datatable": oTable
		} );
	} );
</script>