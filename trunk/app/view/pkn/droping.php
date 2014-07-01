<div id="top">
	<div id="header">
        <h2>MONITORING Penyaluran & Droping Dana SP2D<br>
		<?php if (isset($this->d_bank)) {
					if($this->d_bank=="MDRI"){
						echo "<br> Mandiri" ;
					} elseif($this->d_bank=="SEMUA_BANK"){
						echo "<br> SEMUA_BANK" ;
					}else {
						echo "<br> ".$this->d_bank;
					}
			}
			?>
			<?php if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
					echo "Periode : ".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
			}
			?>
		</h2>
    </div>

<a href="#oModal" class="modal">FILTER DATA</a>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>

	<div id="top">	
		<form method="POST" action="monitoringDroping" enctype="multipart/form-data">
		
		<?php  if (Session::get('role')!=SATKER) {
		echo "<div id='wbank' class='error'></div>";
		echo "<label class='isian'>Nama Bank: </label>";
		echo "<select type='text' name='bank' id='bank'>";
		?>  <option value=''>- pilih -</option>
			<option value='MDRI' <?php if ($this->d_bank==MDRI){echo "selected";}?>>Mandiri</option>
			<option value='BRI' <?php if ($this->d_bank==BRI){echo "selected";}?>>BRI</option>
			<option value='BNI' <?php if ($this->d_bank==BNI){echo "selected";}?>>BNI</option>
			<option value='BTN' <?php if ($this->d_bank==BTN){echo "selected";}?>>BTN</option>
			<option value='SEMUA_BANK' <?php if ($this->d_bank==SEMUA_BANK){echo "selected";}?>>SEMUA BANK</option>
		</select>
		<?php } else {
			echo "<input type='hidden' name='bank' id='bank' value=''>";
		} ?>
		
		<div id="wtgl" class="error"></div>
		<label class="isian">Tanggal: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>"> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>"></li>
		</ul>


		<ul class="inline" style="margin-left: 150px">
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
		echo "Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB";
	}
}
?>

<div id="fitur">

		<table width="100%" class="table table-bordered zebra" id='fixheader' style="font-size: 80%">
            <!--baris pertama-->
			<thead>
					<th class='mid'>No.</th>
					<th >Tanggal</th>
					<th >Total File</th>
					<th >Total Transaksi SP2D</th>
					<th >Total Nilai</th>
					<th >Total Droping</th>
					<th >Selisih</th>
					<th >Keterangan</th>
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
							echo "<td>" . number_format($value->get_jumlah_ftp_file_name()) . "</td>";
							echo "<td>" . number_format($value->get_jumlah_check_number_line_num()) . "</td>";
							echo "<td align = 'right'>" . number_format($value->get_jumlah_check_amount()) . "</td>";
							echo "<td align = 'right'><a href=".URL."dataDroping/detailDroping/" . $this->d_bank."/".$value->get_creation_date()." target='_blank'>" . number_format($value->get_payment_amount()) . "</a></td>";
							$selisih = $value->get_payment_amount()-$value->get_jumlah_check_amount();
							echo "<td align = 'right'>" . number_format($selisih) . "</td>";
							if ($selisih<0) { echo "<td>Kurang Droping</td>"; } else if ($selisih > 0) {echo "<td>Lebih Droping</td>";} else { echo "<td></td>";};
						echo "</tr>	";
					}
				} 
			} else {
				echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
			}
			?>
			</tbody>
        </table></div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
    $(function(){
        hideErrorId();
        hideWarning();
	    $("#tgl_awal").datepicker({
        maxDate: "dateToday",
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') {
                $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 1);
                console.log(selectedDate, date);
                $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                $("#tgl_akhir").datepicker("option", "maxDate", date);
            }
        }
    });
	
    $("#tgl_akhir").datepicker({
        maxDate: "dateToday",
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate) {
            $("#tgl_awal").datepicker("option", "maxDate", selectedDate);
			}
		});		
	});
	
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
		
		$('#bank').change(function(){
            if(document.getElementById('bank').value !=''){
                $('#wbank').fadeOut(200);
            }
        });
		
		$('#tgl_awal').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#tgl_akhir').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });

    }
	
    function cek_upload(){
		var pattern = '^[0-9]+$';
		var v_bank = document.getElementById('bank').value;
		var v_tglawal = document.getElementById('tgl_awal').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		
        var jml = 0;
        if(v_bank=='' && v_tglawal=='' && v_tglakhir==''){
			$('#wbank').html('Harap isi salah satu parameter');
            $('#wbank').fadeIn();
			$('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
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