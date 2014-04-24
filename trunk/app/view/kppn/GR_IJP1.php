<div id="top">
	<div id="header">
        <h2>Imbalan Jasa Perbankan <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?><br>
			<?php echo Session::get('user'); ?>
		</h2>
    </div>
<select type="text" name="bulan" id="bulan">
			<option value=''>Januari</option>
			<option value=''>Februari</option>
			<option value=''>Maret</option>
			<option value=''>April</option>
			<option value=''>Mei</option>
			<option value=''>Juni</option>
			<option value=''>Juli</option>
			<option value=''>Agustus</option>
			<option value=''>September</option>
			<option value=''>Oktober</option>
			<option value=''>November</option>
			<option value=''>Desember</option>
			<!--option value='Validated' <?php //if ($this->status==Validated){echo "selected";}?>>Validated</option>
			<option value='Error' <?php //if ($this->status==Error){echo "selected";}?>>Error</option-->
			
		</select>
<!--a href="#xModal" class="modal">FILTER DATA</a><br><br>
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="GR_IJP" enctype="multipart/form-data">
		<div id="wstatus" class="error"></div>
		<!--div id="wbank" class="status"></div-->
		<!--label class="isian">Status: </label>
		<select type="text" name="status" id="status">
			<option value=''>- pilih -</option>
			<option value='Validated' <?php if ($this->status==Validated){echo "selected";}?>>Validated</option>
			<option value='Error' <?php if ($this->status==Error){echo "selected";}?>>Error</option>
			
		</select>
		
		<label class="isian">Nama File: </label>
		<input type="text" name="nama_file" id="nama_file" value="<?php if (isset($this->nama_file)){echo $this->nama_file;}?>">


		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

		<!--ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick="return cek_upload();"></li>
		<!--onClick="konfirm(); return false;"-->
		<!--/ul>
	</form>
</div>
</div>
</div-->



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
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					//echo "<td>" . $value->get_kppn() . "</td>";
					//echo "<td>" . $value->get_gl_date_char() . "</td>";
					echo "<td>" . $value->get_bank_code() . '-'. $value->get_bank_account_num() . "</td>";
					//echo "<td>" . $value->get_bank_branch_code() . "</td>";
					//echo "<td>" . $value->get_bank_account_num() . "</td>";
					echo "<td>" . $value->get_transaksi() . "</td>";
					//echo "<td>" . $value->get_baris() . "</td>";
					
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