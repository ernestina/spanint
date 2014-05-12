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
					echo "<td>" . $value->get_n01() . "</td>";
					echo "<td>" . $value->get_n02() . "</td>";
					echo "<td>" . $value->get_n03() . "</td>";
					echo "<td>" . $value->get_n04() . "</td>";
					echo "<td>" . $value->get_n05() . "</td>";
					echo "<td>" . $value->get_n06() . "</td>";
					echo "<td>" . $value->get_n07() . "</td>";
					echo "<td>" . $value->get_n08() . "</td>";
					echo "<td>" . $value->get_n09() . "</td>";
					echo "<td>" . $value->get_n10() . "</td>";
					echo "<td>" . $value->get_n11() . "</td>";
					echo "<td>" . $value->get_n12() . "</td>";
					echo "<td>" . $value->get_n13() . "</td>";
					echo "<td>" . $value->get_n14() . "</td>";
					echo "<td>" . $value->get_n15() . "</td>";
					echo "<td>" . $value->get_n16() . "</td>";
					echo "<td>" . $value->get_n17() . "</td>";
					echo "<td>" . $value->get_n18() . "</td>";
					echo "<td>" . $value->get_n19() . "</td>";
					echo "<td>" . $value->get_n20() . "</td>";
					echo "<td>" . $value->get_n21() . "</td>";
					echo "<td>" . $value->get_n22() . "</td>";
					echo "<td>" . $value->get_n23() . "</td>";
					echo "<td>" . $value->get_n24() . "</td>";
					echo "<td>" . $value->get_n25() . "</td>";
					echo "<td>" . $value->get_n26() . "</td>";
					echo "<td>" . $value->get_n27() . "</td>";
					echo "<td>" . $value->get_n28() . "</td>";
					echo "<td>" . $value->get_n29() . "</td>";
					echo "<td>" . $value->get_n30() . "</td>";
					echo "<td>" . $value->get_n31() . "</td>";
					echo "<td>" . $value->get_jumlah() . "</td>";
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