<div id="top">
	<div id="header">
        <h2>Monitoring Status LHP <?php //echo $this->d_bulan; ?> <?php //echo $kode_satker; ?>
		KPPN 
		<?php if (isset($this->d_nama_kppn)) {
				foreach($this->d_nama_kppn as $kppn){
					echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
					$kode_kppn=$kppn->get_kd_satker();
				}
			}
		else{echo Session::get('user');}?>
		</h2>
    </div>
<!--<table><tr><td width="90%">
<form method="POST" action="GR_IJP" enctype="multipart/form-data">
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
			option value='Validated' <?php //if ($this->status==Validated){echo "selected";}?>>Validated</option>
			<option value='Error' <?php //if ($this->status==Error){echo "selected";}?>>Error</option
			
		</select></td>
<td><input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick="return cek_upload();"></td>
</tr>
</form>
</table>-->
<?php if (Session::get('role') == ADMIN OR Session::get('role') == KANWIL) { ?>
<a href="#oModal" class="modal">FILTER DATA</a><br><br>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>

	<div id="top">	
	
		<form method="POST" action="grStatusHarian" enctype="multipart/form-data">
		
		<?php if (isset($this->kppn_list)) { ?>
		<div id="wkdkppn" class="error"></div>
		<label class="isian">Kode KPPN: </label>
		<select type="text" name="kdkppn" id="kdkppn">
		<?php foreach ($this->kppn_list as $value1){ 
			echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";
		} ?>
		</select>
		<?php } ?>
		
		<ul class="inline" style="margin-left: 150px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
		</ul>
	</form>
	
</div>
</div>
</div>
<?php } ?>

<div id="fitur">
		<table width="100%" class="table table-bordered" style="font-size: 80%">
            <!--baris pertama-->
			<thead>
				<tr>
					<th rowspan=2 width="10px">No.</th>
					<th rowspan=2 width="70px">Bulan</th>
					<th colspan=31>Tanggal LHP</th>
				</tr>
				<tr>
					<th width="30px">1</th>
					<th width="30px">2</th>
					<th width="30px">3</th>
					<th width="30px">4</th>
					<th width="30px">5</th>
					<th width="30px">6</th>
					<th width="30px">7</th>
					<th width="30px">8</th>
					<th width="30px">9</th>
					<th width="30px">10</th>
					<th width="30px">11</th>
					<th width="30px">12</th>
					<th width="30px">13</th>
					<th width="30px">14</th>
					<th width="30px">15</th>
					<th width="30px">16</th>
					<th width="30px">17</th>
					<th width="30px">18</th>
					<th width="30px">19</th>
					<th width="30px">20</th>
					<th width="30px">21</th>
					<th width="30px">22</th>
					<th width="30px">23</th>
					<th width="30px">24</th>
					<th width="30px">25</th>
					<th width="30px">26</th>
					<th width="30px">27</th>
					<th width="30px">28</th>
					<th width="30px">29</th>
					<th width="30px">30</th>
					<th width="30px">31</th>
				</tr>
					
			</thead>
			<tbody>
		<?php 
		$no=1;
		if (isset($this->data)){
			if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
			} else {
				foreach ($this->data as $value){ 
					if ($value->get_n01()==0){$warna01='F5F5F5';} elseif ($value->get_n01()==1){$warna01='A4C639';}elseif ($value->get_n01()==2){$warna01='FFBF00';}elseif ($value->get_n01()==3){$warna01='FF2800';}elseif ($value->get_n01()==4){$warna01='B2BEB5';}elseif ($value->get_n01()==5){$warna01='99666CC';}elseif ($value->get_n01()==9){$warna01='C19A6B';}else{$warna01='000000';}
					if ($value->get_n02()==0){$warna02='F5F5F5';} elseif ($value->get_n02()==1){$warna02='A4C639';}elseif ($value->get_n02()==2){$warna02='FFBF00';}elseif ($value->get_n02()==3){$warna02='FF2800';}elseif ($value->get_n02()==4){$warna02='B2BEB5';}elseif ($value->get_n02()==5){$warna02='99666CC';}elseif ($value->get_n02()==9){$warna02='C19A6B';}else{$warna02='000000';}
					if ($value->get_n03()==0){$warna03='F5F5F5';} elseif ($value->get_n03()==1){$warna03='A4C639';}elseif ($value->get_n03()==2){$warna03='FFBF00';}elseif ($value->get_n03()==3){$warna03='FF2800';}elseif ($value->get_n03()==4){$warna03='B2BEB5';}elseif ($value->get_n03()==5){$warna03='99666CC';}elseif ($value->get_n03()==9){$warna03='C19A6B';}else{$warna03='000000';}
					if ($value->get_n04()==0){$warna04='F5F5F5';} elseif ($value->get_n04()==1){$warna04='A4C639';}elseif ($value->get_n04()==2){$warna04='FFBF00';}elseif ($value->get_n04()==3){$warna04='FF2800';}elseif ($value->get_n04()==4){$warna04='B2BEB5';}elseif ($value->get_n04()==5){$warna04='99666CC';}elseif ($value->get_n04()==9){$warna04='C19A6B';}else{$warna04='000000';}
					if ($value->get_n05()==0){$warna05='F5F5F5';} elseif ($value->get_n05()==1){$warna05='A4C639';}elseif ($value->get_n05()==2){$warna05='FFBF00';}elseif ($value->get_n05()==3){$warna05='FF2800';}elseif ($value->get_n05()==4){$warna05='B2BEB5';}elseif ($value->get_n05()==5){$warna05='99666CC';}elseif ($value->get_n05()==9){$warna05='C19A6B';}else{$warna05='000000';}
					if ($value->get_n06()==0){$warna06='F5F5F5';} elseif ($value->get_n06()==1){$warna06='A4C639';}elseif ($value->get_n06()==2){$warna06='FFBF00';}elseif ($value->get_n06()==3){$warna06='FF2800';}elseif ($value->get_n06()==4){$warna06='B2BEB5';}elseif ($value->get_n06()==5){$warna06='99666CC';}elseif ($value->get_n06()==9){$warna06='C19A6B';}else{$warna06='000000';}
					if ($value->get_n07()==0){$warna07='F5F5F5';} elseif ($value->get_n07()==1){$warna07='A4C639';}elseif ($value->get_n07()==2){$warna07='FFBF00';}elseif ($value->get_n07()==3){$warna07='FF2800';}elseif ($value->get_n07()==4){$warna07='B2BEB5';}elseif ($value->get_n07()==5){$warna07='99666CC';}elseif ($value->get_n07()==9){$warna07='C19A6B';}else{$warna07='000000';}
					if ($value->get_n08()==0){$warna08='F5F5F5';} elseif ($value->get_n08()==1){$warna08='A4C639';}elseif ($value->get_n08()==2){$warna08='FFBF00';}elseif ($value->get_n08()==3){$warna08='FF2800';}elseif ($value->get_n08()==4){$warna08='B2BEB5';}elseif ($value->get_n08()==5){$warna08='99666CC';}elseif ($value->get_n08()==9){$warna08='C19A6B';}else{$warna08='000000';}
					if ($value->get_n09()==0){$warna09='F5F5F5';} elseif ($value->get_n09()==1){$warna09='A4C639';}elseif ($value->get_n09()==2){$warna09='FFBF00';}elseif ($value->get_n09()==3){$warna09='FF2800';}elseif ($value->get_n09()==4){$warna09='B2BEB5';}elseif ($value->get_n09()==5){$warna09='99666CC';}elseif ($value->get_n09()==9){$warna09='C19A6B';}else{$warna09='000000';}
					if ($value->get_n10()==0){$warna10='F5F5F5';} elseif ($value->get_n10()==1){$warna10='A4C639';}elseif ($value->get_n10()==2){$warna10='FFBF00';}elseif ($value->get_n10()==3){$warna10='FF2800';}elseif ($value->get_n10()==4){$warna10='B2BEB5';}elseif ($value->get_n10()==5){$warna10='99666CC';}elseif ($value->get_n10()==9){$warna10='C19A6B';}else{$warna10='000000';}
					if ($value->get_n11()==0){$warna11='F5F5F5';} elseif ($value->get_n11()==1){$warna11='A4C639';}elseif ($value->get_n11()==2){$warna11='FFBF00';}elseif ($value->get_n11()==3){$warna11='FF2800';}elseif ($value->get_n11()==4){$warna11='B2BEB5';}elseif ($value->get_n11()==5){$warna11='99666CC';}elseif ($value->get_n11()==9){$warna11='C19A6B';}else{$warna11='000000';}
					if ($value->get_n12()==0){$warna12='F5F5F5';} elseif ($value->get_n12()==1){$warna12='A4C639';}elseif ($value->get_n12()==2){$warna12='FFBF00';}elseif ($value->get_n12()==3){$warna12='FF2800';}elseif ($value->get_n12()==4){$warna12='B2BEB5';}elseif ($value->get_n12()==5){$warna12='99666CC';}elseif ($value->get_n12()==9){$warna12='C19A6B';}else{$warna12='000000';}
					if ($value->get_n13()==0){$warna13='F5F5F5';} elseif ($value->get_n13()==1){$warna13='A4C639';}elseif ($value->get_n13()==2){$warna13='FFBF00';}elseif ($value->get_n13()==3){$warna13='FF2800';}elseif ($value->get_n13()==4){$warna13='B2BEB5';}elseif ($value->get_n13()==5){$warna13='99666CC';}elseif ($value->get_n13()==9){$warna13='C19A6B';}else{$warna13='000000';}
					if ($value->get_n14()==0){$warna14='F5F5F5';} elseif ($value->get_n14()==1){$warna14='A4C639';}elseif ($value->get_n14()==2){$warna14='FFBF00';}elseif ($value->get_n14()==3){$warna14='FF2800';}elseif ($value->get_n14()==4){$warna14='B2BEB5';}elseif ($value->get_n14()==5){$warna14='99666CC';}elseif ($value->get_n14()==9){$warna14='C19A6B';}else{$warna14='000000';}
					if ($value->get_n15()==0){$warna15='F5F5F5';} elseif ($value->get_n15()==1){$warna15='A4C639';}elseif ($value->get_n15()==2){$warna15='FFBF00';}elseif ($value->get_n15()==3){$warna15='FF2800';}elseif ($value->get_n15()==4){$warna15='B2BEB5';}elseif ($value->get_n15()==5){$warna15='99666CC';}elseif ($value->get_n15()==9){$warna15='C19A6B';}else{$warna15='000000';}
					if ($value->get_n16()==0){$warna16='F5F5F5';} elseif ($value->get_n16()==1){$warna16='A4C639';}elseif ($value->get_n16()==2){$warna16='FFBF00';}elseif ($value->get_n16()==3){$warna16='FF2800';}elseif ($value->get_n16()==4){$warna16='B2BEB5';}elseif ($value->get_n16()==5){$warna16='99666CC';}elseif ($value->get_n16()==9){$warna16='C19A6B';}else{$warna16='000000';}
					if ($value->get_n17()==0){$warna17='F5F5F5';} elseif ($value->get_n17()==1){$warna17='A4C639';}elseif ($value->get_n17()==2){$warna17='FFBF00';}elseif ($value->get_n17()==3){$warna17='FF2800';}elseif ($value->get_n17()==4){$warna17='B2BEB5';}elseif ($value->get_n17()==5){$warna17='99666CC';}elseif ($value->get_n17()==9){$warna17='C19A6B';}else{$warna17='000000';}
					if ($value->get_n18()==0){$warna18='F5F5F5';} elseif ($value->get_n18()==1){$warna18='A4C639';}elseif ($value->get_n18()==2){$warna18='FFBF00';}elseif ($value->get_n18()==3){$warna18='FF2800';}elseif ($value->get_n18()==4){$warna18='B2BEB5';}elseif ($value->get_n18()==5){$warna18='99666CC';}elseif ($value->get_n18()==9){$warna18='C19A6B';}else{$warna18='000000';}
					if ($value->get_n19()==0){$warna19='F5F5F5';} elseif ($value->get_n19()==1){$warna19='A4C639';}elseif ($value->get_n19()==2){$warna19='FFBF00';}elseif ($value->get_n19()==3){$warna19='FF2800';}elseif ($value->get_n19()==4){$warna19='B2BEB5';}elseif ($value->get_n19()==5){$warna19='99666CC';}elseif ($value->get_n19()==9){$warna19='C19A6B';}else{$warna19='000000';}
					if ($value->get_n20()==0){$warna20='F5F5F5';} elseif ($value->get_n20()==1){$warna20='A4C639';}elseif ($value->get_n20()==2){$warna20='FFBF00';}elseif ($value->get_n20()==3){$warna20='FF2800';}elseif ($value->get_n20()==4){$warna20='B2BEB5';}elseif ($value->get_n20()==5){$warna20='99666CC';}elseif ($value->get_n20()==9){$warna20='C19A6B';}else{$warna20='000000';}
					if ($value->get_n21()==0){$warna21='F5F5F5';} elseif ($value->get_n21()==1){$warna21='A4C639';}elseif ($value->get_n21()==2){$warna21='FFBF00';}elseif ($value->get_n21()==3){$warna21='FF2800';}elseif ($value->get_n21()==4){$warna21='B2BEB5';}elseif ($value->get_n21()==5){$warna21='99666CC';}elseif ($value->get_n21()==9){$warna21='C19A6B';}else{$warna21='000000';}
					if ($value->get_n22()==0){$warna22='F5F5F5';} elseif ($value->get_n22()==1){$warna22='A4C639';}elseif ($value->get_n22()==2){$warna22='FFBF00';}elseif ($value->get_n22()==3){$warna22='FF2800';}elseif ($value->get_n22()==4){$warna22='B2BEB5';}elseif ($value->get_n22()==5){$warna22='99666CC';}elseif ($value->get_n22()==9){$warna22='C19A6B';}else{$warna22='000000';}
					if ($value->get_n23()==0){$warna23='F5F5F5';} elseif ($value->get_n23()==1){$warna23='A4C639';}elseif ($value->get_n23()==2){$warna23='FFBF00';}elseif ($value->get_n23()==3){$warna23='FF2800';}elseif ($value->get_n23()==4){$warna23='B2BEB5';}elseif ($value->get_n23()==5){$warna23='99666CC';}elseif ($value->get_n23()==9){$warna23='C19A6B';}else{$warna23='000000';}
					if ($value->get_n24()==0){$warna24='F5F5F5';} elseif ($value->get_n24()==1){$warna24='A4C639';}elseif ($value->get_n24()==2){$warna24='FFBF00';}elseif ($value->get_n24()==3){$warna24='FF2800';}elseif ($value->get_n24()==4){$warna24='B2BEB5';}elseif ($value->get_n24()==5){$warna24='99666CC';}elseif ($value->get_n24()==9){$warna24='C19A6B';}else{$warna24='000000';}
					if ($value->get_n25()==0){$warna25='F5F5F5';} elseif ($value->get_n25()==1){$warna25='A4C639';}elseif ($value->get_n25()==2){$warna25='FFBF00';}elseif ($value->get_n25()==3){$warna25='FF2800';}elseif ($value->get_n25()==4){$warna25='B2BEB5';}elseif ($value->get_n25()==5){$warna25='99666CC';}elseif ($value->get_n25()==9){$warna25='C19A6B';}else{$warna25='000000';}
					if ($value->get_n26()==0){$warna26='F5F5F5';} elseif ($value->get_n26()==1){$warna26='A4C639';}elseif ($value->get_n26()==2){$warna26='FFBF00';}elseif ($value->get_n26()==3){$warna26='FF2800';}elseif ($value->get_n26()==4){$warna26='B2BEB5';}elseif ($value->get_n26()==5){$warna26='99666CC';}elseif ($value->get_n26()==9){$warna26='C19A6B';}else{$warna26='000000';}
					if ($value->get_n27()==0){$warna27='F5F5F5';} elseif ($value->get_n27()==1){$warna27='A4C639';}elseif ($value->get_n27()==2){$warna27='FFBF00';}elseif ($value->get_n27()==3){$warna27='FF2800';}elseif ($value->get_n27()==4){$warna27='B2BEB5';}elseif ($value->get_n27()==5){$warna27='99666CC';}elseif ($value->get_n27()==9){$warna27='C19A6B';}else{$warna27='000000';}
					if ($value->get_n28()==0){$warna28='F5F5F5';} elseif ($value->get_n28()==1){$warna28='A4C639';}elseif ($value->get_n28()==2){$warna28='FFBF00';}elseif ($value->get_n28()==3){$warna28='FF2800';}elseif ($value->get_n28()==4){$warna28='B2BEB5';}elseif ($value->get_n28()==5){$warna28='99666CC';}elseif ($value->get_n28()==9){$warna28='C19A6B';}else{$warna28='000000';}
					if ($value->get_n29()==0){$warna29='F5F5F5';} elseif ($value->get_n29()==1){$warna29='A4C639';}elseif ($value->get_n29()==2){$warna29='FFBF00';}elseif ($value->get_n29()==3){$warna29='FF2800';}elseif ($value->get_n29()==4){$warna29='B2BEB5';}elseif ($value->get_n29()==5){$warna29='99666CC';}elseif ($value->get_n29()==9){$warna29='C19A6B';}else{$warna29='000000';}
					if ($value->get_n30()==0){$warna30='F5F5F5';} elseif ($value->get_n30()==1){$warna30='A4C639';}elseif ($value->get_n30()==2){$warna30='FFBF00';}elseif ($value->get_n30()==3){$warna30='FF2800';}elseif ($value->get_n30()==4){$warna30='B2BEB5';}elseif ($value->get_n30()==5){$warna30='99666CC';}elseif ($value->get_n30()==9){$warna30='C19A6B';}else{$warna30='000000';}
					if ($value->get_n31()==0){$warna31='F5F5F5';} elseif ($value->get_n31()==1){$warna31='A4C639';}elseif ($value->get_n31()==2){$warna31='FFBF00';}elseif ($value->get_n31()==3){$warna31='FF2800';}elseif ($value->get_n31()==4){$warna31='B2BEB5';}elseif ($value->get_n31()==5){$warna31='99666CC';}elseif ($value->get_n31()==9){$warna31='C19A6B';}else{$warna31='000000';}
					echo "<tr class='ratakanan'>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td style='text-align: left' >" . Tanggal::bulan_indo($value->get_bulan()) . "</td>";
					echo "<td bgcolor='#". $warna01 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."01/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna02 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."02/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna03 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."03/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna04 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."04/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna05 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."05/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna06 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."06/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna07 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."07/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna08 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."08/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna09 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."09/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna10 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."10/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna11 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."11/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna12 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."12/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna13 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."13/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna14 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."14/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna15 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."15/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna16 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."16/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna17 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."17/".$_POST['kdkppn']."target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna18 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."18/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna19 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."19/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna20 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."20/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna21 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."21/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna22 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."22/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna23 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."23/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna24 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."24/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna25 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."25/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna26 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."26/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna27 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."27/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna28 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."28/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna29 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."29/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna30 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."30/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
					echo "<td bgcolor='#". $warna31 ."'><a href=".URL."dataGR/detailLhpRekap/".$value->get_tahun()."".$value->get_bulan()."31/".$_POST['kdkppn']." target='_blank' style='text-decoration:none'><center>&nbsp</center></a></td>";
				echo "</tr>	";
					}
				} 
			} else {
				echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
			}
			?>
			</tbody>
        </table>
		<br>
		<b><i>* Klik pada kolom warna untuk melihat detail transaksi </i></b></br>
		<b>Keterangan : </b>
		<table style="font-size: 80%">
			<tr>
				<th width="10px" >Warna</th>
				<th width="70px" >Keterangan</th>
				<th width="70px" >Tindakan</th>
				<th width="10px" >Warna</th>
				<th width="70px" >Keterangan</th>
				<th width="70px" >Tindakan</th>
			</tr>
			<tr>
				<td bgcolor='#F5F5F5'></td>
				<td>Data belum masuk</td>
				<td>Konfirmasi ke Bank dan Upload</td>
				<td bgcolor='#B2BEB5'></td>
				<td>Ada data belum pengecekan</td>
				<td>Lakukan pengecekan</td>
			</tr>
			<tr>
				<td bgcolor='#A4C639'></td>
				<td>Semua Data Completed</td>
				<td>Tidak ada</td>
				<td bgcolor='#99666CC'></td>
				<td>Ada data yang belum oke</td>
				<td>Lakukan pengecekan</td>
			</tr>
			<tr>
				<td bgcolor='#FFBF00'></td>
				<td>Ada yang belum diinterface</td>
				<td>Lakukan interface</td>
				<td bgcolor='#C19A6B'></td>
				<td>Hari Libur</td>
				<td>Tidak ada</td>
			</tr>
			<tr>
				<td bgcolor='#FF2800'></td>
				<td>Data error</td>
				<td>upload ulang ADK</td>
				<td bgcolor='#000000'></td>
				<td>Tidak Terdefenisi</td>
				<td>Belum tahu</td>
			</tr>
		</table>
		</div>
</div>

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
</script>