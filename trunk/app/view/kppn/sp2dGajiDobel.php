<div id="top">
	<div id="header">
        <h2>MONITORING SP2D Gaji Terindikasi  Dobel <?php if (Session::get('role') == ADMIN) {echo "KPPN ".$this->d_kdkppn;} //else{echo Session::get('user');} ?><br>
		</h2>
    </div>

<a href="#bModal" class="modal">FILTER DATA</a><br><br>
        <div id="bModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>
	
<div id="top">

	<form method="POST" action="sp2dGajiDobel" enctype="multipart/form-data">
	
		<?php if (Session::get('role') == ADMIN) { ?>
		<div id="wkdkppn" class="error"></div>
		<label class="isian">Kode KPPN: </label>
		<input type="number" name="kdkppn" id="kdkppn" size="3" value="<?php if (isset($this->d_kdkppn)){echo $this->d_kdkppn;}?>">
		<?php } ?>
		
		<div id="wbulan" class="error"></div>
		<label class="isian">Bulan: </label>
		<select type="text" name="bulan" id="bulan">
			<option value=''>- pilih -</option>
			<option value='JANUARI' <?php if ($this->d_bank==JANUARI){echo "selected";}?>>Januari</option>
			<option value='FEBRUARI' <?php if ($this->d_bank==FEBRUARI){echo "selected";}?>>Pebruari</option>
			<option value='MARET' <?php if ($this->d_bank==MARET){echo "selected";}?>>Maret</option>
			<option value='APRIL' <?php if ($this->d_bank==APRIL){echo "selected";}?>>April</option>
			<option value='MEI' <?php if ($this->d_bank==MEI){echo "selected";}?>>Mei</option>
			<option value='JUNI' <?php if ($this->d_bank==JUNI){echo "selected";}?>>Juni</option>
			<option value='JULI' <?php if ($this->d_bank==JULI){echo "selected";}?>>Juli</option>
			<option value='AGUSTUS' <?php if ($this->d_bank==AGUSTUS){echo "selected";}?>>Agustus</option>
			<option value='SEPTEMBER' <?php if ($this->d_bank==SEPTEMBER){echo "selected";}?>>Sepetember</option>
			<option value='OKTOBER' <?php if ($this->d_bank==OKTOBER){echo "selected";}?>>Oktober</option>
			<option value='NOVEMBER' <?php if ($this->d_bank==NOVEMBER){echo "selected";}?>>Nopember</option>
			<option value='DESEMBER' <?php if ($this->d_bank==DESEMBER){echo "selected";}?>>Desember</option>
			<option value='13' <?php if ($this->d_bank==13){echo "selected";}?>>Semua Bulan</option>
		</select>

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
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
					<th>Kode Satker</th>
					<th>No. Invoice</th>
					<th>No. SP2D</th>
					<th>Deskripsi</th>
					
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
							echo "<td>" . $value->get_kdsatker() . "</td>";
							echo "<td>" . $value->get_invoice_num() . "</td>";
							echo "<td>" . $value->get_check_number() . "</td>";
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
    });
	
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
        $('#bulan').keyup(function(){
            if(document.getElementById('bulan').value !=''){
                $('#bulan').fadeOut(200);
            }
        });

    }
	
    function cek_upload(){
		var v_bulan = document.getElementById('bulan').value;
        var jml = 0;
		
        if(v_bulan==''){
			$('#wbulan').html('Harap pilih bulan');
            $('#wbulan').fadeIn();
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