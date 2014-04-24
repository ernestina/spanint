<div id="top">
	<div id="header">
        <h2>Monitoring Imbalan Jasa Perbankan <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?><br>
			<?php echo Session::get('user'); ?>
		</h2>
    </div>
<table><tr><td>
<form method="POST" action="GR_IJP" enctype="multipart/form-data">
	<select type="text" name="bulan" id="bulan" style="margin-top: 10px; margin-left: 800px; padding-top: 7px;">
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



<div id="fitur">
		<table width="100%" class="table table-bordered zebra scroll">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<!--th>KPPN</th-->
					<!--th>Tanggal</th-->
					<th>Bank, No Rek</th>
					<!--th>Kode Cabang Bank</th-->
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>
					<th>6</th>
					<th>7</th>
					<th>8</th>
					<th>9</th>
					<th>10</th>
					<th>11</th>
					<th>12</th>
					<th>13</th>
					<th>14</th>
					<th>15</th>
					<th>16</th>
					<th>17</th>
					<th>18</th>
					<th>19</th>
					<th>20</th>
					<th>21</th>
					<th>22</th>
					<th>23</th>
					<th>24</th>
					<th>25</th>
					<th>26</th>
					<th>27</th>
					<th>28</th>
					<th>29</th>
					<th>30</th>
					<th>31</th>
					<th>Total</th>
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
					echo "<td style='text-align: left'>" . $value->get_bank_code() . '-'. $value->get_bank_account_num() . "</td>";
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

<script type="text/javascript">
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