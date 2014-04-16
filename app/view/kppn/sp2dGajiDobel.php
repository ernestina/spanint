<div id="top">
	<div id="header">
        <h2>MONITORING SP2D Gaji Terindikasi  Dobel Seluruh KPPN<br>
		</h2>
    </div>
</div>
<div id="top">
	<div id="kiri">
	<form method="POST" action="sp2dGajiDobel" enctype="multipart/form-data">
		
		<div id="wbulan" class="error"></div>
		Bulan: <br>
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

		<ul class="inline">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
		</ul>
	</form>
</div>
<div id="top">
		<table class="table-bordered zebra scroll" width="100%">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Kode KPPN</th>
					<th>Kode Satker</th>
					<th>No. Invoice</th>
					<th>No. SP2D</th>
					<th>Deskripsi</th>
					
			</thead>
			<tbody>
			<?php 
			$no=1;
			if (isset($this->data)){
				if (empty($this->data)){
					echo "Tidak ada data";
				} else {
					foreach ($this->data as $value){ 
						echo "<tr>	";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_kdkppn() . "</td>";
							echo "<td>" . $value->get_kdsatker() . "</td>";
							echo "<td>" . $value->get_invoice_num() . "</td>";
							echo "<td>" . $value->get_check_number() . "</td>";
							echo "<td>" . $value->get_invoice_description() . "</td>";
						echo "</tr>	";
					}
				} 
			} 
			?>
			</tbody>
        </table>
		</div>
</div>
<style>
.ui-datepicker { width: 14em; padding: .1em .1em 0; }
.ui-datepicker-calendar {
    display: none;
    }
</style>
<script type="text/javascript">
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
</script>