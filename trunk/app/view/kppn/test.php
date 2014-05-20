<div id="top">
	<div id="header">
        <h2>Monitoring PFK Bulan <?php echo ($this->d_bulan); ?> <?php //echo $kode_satker; ?>
			<?php //echo Session::get('user'); ?>
			<?php if (isset($this->d_nama_kppn)) {
				foreach($this->d_nama_kppn as $kppn){
					echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
					$kode_kppn=$kppn->get_kd_satker();
				}
			}?>
		</h2>
</div>


<a href="#oModal" class="modal">FILTER DATA</a><br><br>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>
<div id="top">	
<form method="POST" action="GR_PFK" enctype="multipart/form-data">

<?php if (isset($this->kppn_list)) { ?>
		<div id="wkdkppn" class="error"></div>
		<label class="isian">Kode KPPN: </label>
		<select type="text" name="kdkppn" id="kdkppn">
		<?php foreach ($this->kppn_list as $value1){ 
				if ($kode_kppn==$value1->get_kd_d_kppn()){echo "<option value='".$value1->get_kd_d_kppn()."' selected>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";} 
				else {echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";}
			
		} ?>
		</select>
		<?php } ?>
		

	<label class="isian">Pilih bulan: </label>
	<select type="text" name="bulan" id="bulan">
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
	</select>
	<!--input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick="return cek_upload();" style='margin-top: -50px'-->
	<ul class="inline" style="margin-left: 250px">
	<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
	</ul>
</form>
</div>
</div>
</div>


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
					echo "<td><a href=".URL."dataGR/GR_PFK_DETAIL/".$value->get_akun()."/".$bulan."/".$_POST['kdkppn']." target='_blank' '>" . $value->get_akun() . "</a></td>";
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