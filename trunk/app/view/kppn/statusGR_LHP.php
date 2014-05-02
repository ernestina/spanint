<div id="top">
	<div id="header">
        <h2>STATUS FILE LHP INTERFACE <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?>
			<?php //echo Session::get('user'); ?>
		</h2>
    </div>

<a href="#xModal" class="modal">FILTER DATA</a><br><br>
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="GRstatus" enctype="multipart/form-data">
		<div id="winvoice" class="error"></div>
		
		<div id="wbank" class="status"></div>
		<label class="isian">Status: </label>
		<select type="text" name="status" id="status">
			<option value=''>- pilih -</option>
			<option value='Validated' <?php if ($this->status==Validated){echo "selected";}?>>Validated</option>
			<option value='Error' <?php if ($this->status==Error){echo "selected";}?>>Error</option>
			<option value='Completed' <?php if ($this->status==Completed){echo "selected";}?>>Completed</option>
			
		</select>
		
		<label class="isian">Nama File: </label>
		<input type="text" name="nama_file" id="nama_file" value="<?php if (isset($this->nama_file)){echo $this->nama_file;}?>">


		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick="return cek_upload();"></li>
		<!--onClick="konfirm(); return false;"-->
		</ul>
	</form>
</div>
</div>
</div>



<div id="fitur">
		<table width="100%" class="table table-bordered zebra scroll">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>KPPN</th>
					<th>Bulan</th>
					<th>01</th>
					<th>02</th>
					<th>03</th>
					<th>04</th>
					<th>05</th>
					<th>06</th>
					<th>07</th>
					<th>08</th>
					<th>09</th>
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
					<th>28</th>
					<th>29</th>
					<th>30</th>
					<th>31</th>
					
			</thead>
			<tbody>
			<?php 
			$no=1;
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_kppn() . "</td>";
					echo "<td>" . $value->get_bulan() . "</td>";
					echo "<td>" . $value->get_01() . "</td>";
					echo "<td>" . $value->get_02() . "</td>";
					echo "<td>" . $value->get_03() . "</td>";
					echo "<td>" . $value->get_04() . "</td>";
					echo "<td>" . $value->get_05() . "</td>";
					echo "<td>" . $value->get_06() . "</td>";
					echo "<td>" . $value->get_07() . "</td>";
					echo "<td>" . $value->get_08() . "</td>";
					echo "<td>" . $value->get_09() . "</td>";
					echo "<td>" . $value->get_10() . "</td>";
					echo "<td>" . $value->get_11() . "</td>";
					echo "<td>" . $value->get_12() . "</td>";
					echo "<td>" . $value->get_13() . "</td>";
					echo "<td>" . $value->get_14() . "</td>";
					echo "<td>" . $value->get_15() . "</td>";
					echo "<td>" . $value->get_16() . "</td>";
					echo "<td>" . $value->get_17() . "</td>";
					echo "<td>" . $value->get_18() . "</td>";
					echo "<td>" . $value->get_19() . "</td>";
					echo "<td>" . $value->get_20() . "</td>";
					echo "<td>" . $value->get_21() . "</td>";
					echo "<td>" . $value->get_22() . "</td>";
					echo "<td>" . $value->get_23() . "</td>";
					echo "<td>" . $value->get_24() . "</td>";
					echo "<td>" . $value->get_25() . "</td>";
					echo "<td>" . $value->get_26() . "</td>";
					echo "<td>" . $value->get_27() . "</td>";
					echo "<td>" . $value->get_28() . "</td>";
					echo "<td>" . $value->get_29() . "</td>";
					echo "<td>" . $value->get_30() . "</td>";
					echo "<td>" . $value->get_31() . "</td>";
					
				echo "</tr>	";
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
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var v_invoice = document.getElementById('invoice').value;
		
        var jml = 0;
		if(v_invoice==''){
			$('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
            jml++;
        }
		if(jml>0){
            return false;
        } 
    }
</script>