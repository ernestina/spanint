<div id="top">
	<div id="header">
        <h2>Monitoring Imbalan Jasa Perbankan Bulan <?php echo Tanggal::bulan_indo($this->d_bulan); ?> <?php //echo $kode_satker; ?>
			<?php //echo Session::get('user'); ?>
		</h2>
    
<table><tr><td width="90%">
</div>

<form method="POST" action="GR_IJP" enctype="multipart/form-data">
	<select type="text" name="bulan" id="bulan" style="margin-top: 10px; padding-top: 5px; float: right">
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
		<table width="90%" class="table table-bordered zebra" style="font-size: 80%" id="example">
            <!--baris pertama-->
			<thead>
				<tr>
					<th rowspan=2 width="10px" class='mid'>No.</th>
					<!--th>KPPN</th-->
					<!--th>Tanggal</th-->
					<th rowspan=2 class='mid'>Bank - Cabang - No Rek</th>
					<!--th>Kode Cabang Bank</th-->
					<th colspan=31>Tanggal Penerimaan</th>
					<th rowspan=2 class='mid'>Total</th>
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
		$j1=0; $j2=0; $j3=0; $j4=0; $j5=0; $j6=0; $j7=0; $j8=0; $j9=0; $j10=0; 
		$j11=0; $j12=0; $j13=0; $j14=0; $j15=0; $j16=0; $j17=0; $j18=0; $j19=0; $j20=0;
		$j21=0; $j22=0; $j23=0; $j24=0; $j25=0; $j26=0; $j27=0; $j28=0; $j29=0; $j30=0; $j31=0; $jtotal=0;
		if (isset($this->data)){
			if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
			} else {
				foreach ($this->data as $value){ 
					echo "<tr class='ratakanan'>	";
					echo "<td>" . $no++ . "</td>";
					//echo "<td>" . $value->get_kppn() . "</td>";
					//echo "<td>" . $value->get_gl_date_char() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_bank_code() . ' - ' . $value->get_bank_branch_code() . '<br>'. $value->get_bank_account_num() . "</td>";
					echo "<td>" . number_format($value->get_n01()) . "</td>";
					echo "<td>" . number_format($value->get_n02()) . "</td>";
					echo "<td>" . number_format($value->get_n03()) . "</td>";
					echo "<td>" . number_format($value->get_n04()) . "</td>";
					echo "<td>" . number_format($value->get_n05()) . "</td>";
					echo "<td>" . number_format($value->get_n06()) . "</td>";
					echo "<td>" . number_format($value->get_n07()) . "</td>";
					echo "<td>" . number_format($value->get_n08()) . "</td>";
					echo "<td>" . number_format($value->get_n09()) . "</td>";
					echo "<td>" . number_format($value->get_n10()) . "</td>";
					echo "<td>" . number_format($value->get_n11()) . "</td>";
					echo "<td>" . number_format($value->get_n12()) . "</td>";
					echo "<td>" . number_format($value->get_n13()) . "</td>";
					echo "<td>" . number_format($value->get_n14()) . "</td>";
					echo "<td>" . number_format($value->get_n15()) . "</td>";
					echo "<td>" . number_format($value->get_n16()) . "</td>";
					echo "<td>" . number_format($value->get_n17()) . "</td>";
					echo "<td>" . number_format($value->get_n18()) . "</td>";
					echo "<td>" . number_format($value->get_n19()) . "</td>";
					echo "<td>" . number_format($value->get_n20()) . "</td>";
					echo "<td>" . number_format($value->get_n21()) . "</td>";
					echo "<td>" . number_format($value->get_n22()) . "</td>";
					echo "<td>" . number_format($value->get_n23()) . "</td>";
					echo "<td>" . number_format($value->get_n24()) . "</td>";
					echo "<td>" . number_format($value->get_n25()) . "</td>";
					echo "<td>" . number_format($value->get_n26()) . "</td>";
					echo "<td>" . number_format($value->get_n27()) . "</td>";
					echo "<td>" . number_format($value->get_n28()) . "</td>";
					echo "<td>" . number_format($value->get_n29()) . "</td>";
					echo "<td>" . number_format($value->get_n30()) . "</td>";
					echo "<td>" . number_format($value->get_n31()) . "</td>";
					echo "<td>" . number_format($value->get_jumlah()) . "</td>";
				echo "</tr>	";
				$j1=$j1+ $value->get_n01();
				$j2=$j2+ $value->get_n02();
				$j3=$j3+ $value->get_n03();
				$j4=$j4+ $value->get_n04();
				$j5=$j5+ $value->get_n05();
				$j6=$j6+ $value->get_n06();
				$j7=$j7+ $value->get_n07();
				$j8=$j8+ $value->get_n08();
				$j9=$j9+ $value->get_n09();
				$j10=$j10+ $value->get_n10();
				$j11=$j11+ $value->get_n11();
				$j12=$j12+ $value->get_n12();
				$j13=$j13+ $value->get_n13();
				$j14=$j14+ $value->get_n14();
				$j15=$j15+ $value->get_n15();
				$j16=$j16+ $value->get_n16();
				$j17=$j17+ $value->get_n17();
				$j18=$j18+ $value->get_n18();
				$j19=$j19+ $value->get_n19();
				$j20=$j20+ $value->get_n20();
				$j21=$j21+ $value->get_n21();
				$j22=$j22+ $value->get_n22();
				$j23=$j23+ $value->get_n23();
				$j24=$j24+ $value->get_n24();
				$j25=$j25+ $value->get_n25();
				$j26=$j26+ $value->get_n26();
				$j27=$j27+ $value->get_n27();
				$j28=$j28+ $value->get_n28();
				$j29=$j29+ $value->get_n29();
				$j30=$j30+ $value->get_n30();
				$j31=$j31+ $value->get_n31();
				$jtotal=$jtotal+ $value->get_jumlah();
					}
			echo "<tfoot style='font-weight: bold; font-size: 80% '>";
					echo "<tr class='ratakanan'>	";
					echo "<td> </td>";
					echo "<td class='ratakiri'> GRAND TOTAL </td>";
					echo "<td>" . number_format($j1) . "</td>";
					echo "<td>" . number_format($j2) . "</td>";
					echo "<td>" . number_format($j3) . "</td>";
					echo "<td>" . number_format($j4) . "</td>";
					echo "<td>" . number_format($j5) . "</td>";
					echo "<td>" . number_format($j6) . "</td>";
					echo "<td>" . number_format($j7) . "</td>";
					echo "<td>" . number_format($j8) . "</td>";
					echo "<td>" . number_format($j9) . "</td>";
					echo "<td>" . number_format($j10) . "</td>";
					echo "<td>" . number_format($j11) . "</td>";
					echo "<td>" . number_format($j12) . "</td>";
					echo "<td>" . number_format($j13) . "</td>";
					echo "<td>" . number_format($j14) . "</td>";
					echo "<td>" . number_format($j15) . "</td>";
					echo "<td>" . number_format($j16) . "</td>";
					echo "<td>" . number_format($j17) . "</td>";
					echo "<td>" . number_format($j18) . "</td>";
					echo "<td>" . number_format($j19) . "</td>";
					echo "<td>" . number_format($j20) . "</td>";
					echo "<td>" . number_format($j21) . "</td>";
					echo "<td>" . number_format($j22) . "</td>";
					echo "<td>" . number_format($j23) . "</td>";
					echo "<td>" . number_format($j24) . "</td>";
					echo "<td>" . number_format($j25) . "</td>";
					echo "<td>" . number_format($j26) . "</td>";
					echo "<td>" . number_format($j27) . "</td>";
					echo "<td>" . number_format($j28) . "</td>";
					echo "<td>" . number_format($j29) . "</td>";
					echo "<td>" . number_format($j30) . "</td>";
					echo "<td>" . number_format($j31) . "</td>";
					echo "<td>" . number_format($jtotal) . "</td>";
				echo "</tr>";
			echo "</tfoot>";
				
				
				} 
			} else {
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