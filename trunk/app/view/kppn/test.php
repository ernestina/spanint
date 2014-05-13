<div id="top">
	<div id="header">
        <h2>Monitoring PFK Bulan <?php echo ($this->d_bulan); ?> <?php //echo $kode_satker; ?>
			<?php //echo Session::get('user'); ?>
		</h2>
    
<table><tr><td width="90%">
</div>

<form method="POST" action="GR_PFK" enctype="multipart/form-data">
	<select type="text" name="bulan" id="bulan" style="margin-top: 10px; padding-top: 5px; float: right">
			<option value='januari' <?php if ($this->d_bulan=='januari'){echo "selected";}?> >Januari</option>
			<option value='februari' <?php if ($this->d_bulan=='februari'){echo "selected";}?> >Februari</option>
			<option value='maret' <?php if ($this->d_bulan=='maret'){echo "selected";}?> >Maret</option>
			<option value='april' <?php if ($this->d_bulan=='april'){echo "selected";}?> >April</option>
			<option value='mei' <?php if ($this->d_bulan=='mei'){echo "selected";}?> >Mei</option>
			<option value='juni' <?php if ($this->d_bulan=='juni'){echo "selected";}?> >Juni</option>
			<option value='juli' <?php if ($this->d_bulan=='juli'){echo "selected";}?> >Juli</option>
			<option value='agustus' <?php if ($this->d_bulan=='agustus'){echo "selected";}?> >Agustus</option>
			<option value='september' <?php if ($this->d_bulan=='september'){echo "selected";}?> >September</option>
			<option value='oktober' <?php if ($this->d_bulan=='oktober'){echo "selected";}?> >Oktober</option>
			<option value='november' <?php if ($this->d_bulan=='november'){echo "selected";}?> >November</option>
			<option value='desember' <?php if ($this->d_bulan=='desember'){echo "selected";}?> >Desember</option>
			<!--option value='Validated' <?php //if ($this->status==Validated){echo "selected";}?>>Validated</option>
			<option value='Error' <?php //if ($this->status==Error){echo "selected";}?>>Error</option-->
			
		</select></td>
<td><input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick="return cek_upload();"></td>
</tr>
</form>
</table>


<!--table cellpadding="0" cellspacing="0" border="0" class="display KeyTable" id="example">
	<thead>
		<tr>
			<th>Rendering engine</th>
			<th>Browser</th>
			<th>Platform(s)</th>
			<th>Engine version</th>
			<th>CSS grade</th>
		</tr>
	</thead>
	<tbody>
		<tr class="gradeX">
			<td>Trident</td>
			<td>Internet
				 Explorer 4.0</td>
			<td>Win 95+</td>
			<td class="center">4</td>
			<td class="center">X</td>
		</tr-->



<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Akun</th>
					<th>Uraian Akun</th>
					<th>Potongan SPM</th>
					<th>Setoran MPN</th>
					<th>Total</th>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			$tot_pot_spm=0;
			$tot_set_mpn=0;
			$tot_total=0;
			//var_dump ($this->data);
			if ($this->d_bulan=='januari'){ $bulan = 'january'; }
			if ($this->d_bulan=='februari'){ $bulan = 'february'; }
			if ($this->d_bulan=='maret'){ $bulan = 'march'; }
			if ($this->d_bulan=='april'){ $bulan = 'april'; }
			if ($this->d_bulan=='mei'){ $bulan = 'may'; }
			if ($this->d_bulan=='juni'){ $bulan = 'june'; }
			if ($this->d_bulan=='juli'){ $bulan = 'july'; }
			if ($this->d_bulan=='agustus'){ $bulan = 'august'; }
			if ($this->d_bulan=='september'){ $bulan = 'september'; }
			if ($this->d_bulan=='oktober'){ $bulan = 'october'; }
			if ($this->d_bulan=='november'){ $bulan = 'november'; }
			if ($this->d_bulan=='desember'){ $bulan = 'december'; }
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					//echo "<td>" . $value->get_akun() . "</td>";
					echo "<td><a href=".URL."dataGR/GR_PFK_DETAIL/".$value->get_akun()."/".$bulan." target='_blank' '>" . $value->get_akun() . "</a></td>";
					echo "<td align='left' >" . $value->get_uraian_akun() . "</td>";
					echo "<td align='right'>" . number_format($value->get_potongan_spm()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_setoran_mpn()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_total()) . "</td>";
				echo "</tr>	";
				$tot_pot_spm = $tot_pot_spm  + $value->get_potongan_spm() ;
				$tot_set_mpn = $tot_set_mpn  + $value->get_setoran_mpn() ;
				$tot_total 	= $tot_total  + $value->get_total() ;
			}
				echo "<tr>	";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td><b>GRAND TOTAL</td>";
					echo "<td align='right'><b>" . number_format($tot_pot_spm) . "</td>";
					echo "<td align='right'><b>" . number_format($tot_set_mpn) . "</td>";
					echo "<td align='right'><b>" . number_format($tot_total)  . "</td>";
				echo "</tr>	";
			}
			}
			else {
				echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
			}
			?>
			</tbody>
        </table>
		</div>
</div>
</div>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
    $(function(){
        hideErrorId();
        hideWarning();
        
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
		$('#status').change(function(){
            if(document.getElementById('status').value !=''){
                $('#wstatus').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var v_status = document.getElementById('status').value;
		
        var jml = 0;
		if(v_status==''){
			$('#wstatus').html('Harap pilih');
            $('#wstatus').fadeIn();
            jml++;
        }
		if(jml>0){
            return false;
        } 
    }
	
	$(document).ready( function () {
		var oTable = $('#example').dataTable( {
			"sScrollY": "300px",
			"sScrollX": "100%",
			"sScrollXInner": "110%",
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