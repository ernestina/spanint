<div id="top">
	<div id="header">
        <h2>MONITORING SP2D Gaji Terindikasi Salah BANK 
		<?php if (isset($this->d_nama_kppn)) {
			foreach($this->d_nama_kppn as $kppn){
				echo "<br>".$kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
				$kode_kppn=$kppn->get_kd_satker();
			}
		}?><br>
		</h2>
    </div>

<?php if (isset($this->kppn_list)) { ?>	
<a href="#bModal" class="modal">FILTER DATA</a><br><br>
        <div id="bModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>
	
<div id="top">

	<form method="POST" action="sp2dSalahBank" enctype="multipart/form-data">
	
		
		<div id="wkdkppn" class="error"></div>
		<label class="isian">Kode KPPN: </label>
		<select type="text" name="kdkppn" id="kdkppn">
		<?php foreach ($this->kppn_list as $value1){ 
				if ($kode_kppn==$value1->get_kd_d_kppn()){echo "<option value='".$value1->get_kd_d_kppn()."' selected>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";} 
				else {echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";}
			
		} ?>
		</select>

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
		</ul>
	</form>
</div>
</div>
</div>
<?php } ?>
	
<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Kode Satker</th>
					<th>No. Invoice</th>
					<th>No. SP2D</th>
					<th>BO I</th>
					<th>Bank Rekening Penerima</th>
					<th>Nama Supplier</th>
					<th>Rekening Supplier</th>
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
							echo "<td>" . $value->get_bank_account_name() . "</td>";
							echo "<td>" . $value->get_bank_name() . "</td>";
							echo "<td>" . $value->get_vendor_name() . "</td>";
							echo "<td>" . $value->get_vendor_ext_bank_account_num() . "</td>";
							echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
						echo "</tr>	";
					}
				} 
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
	$(document).ready( function () {
        hideErrorId();
        hideWarning();
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
	
	function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
        $('#kdkppn').change(function() {
            if (document.getElementById('kdkppn').value != '') {
                $('#wkdkppn').fadeOut(200);
            }
        })
	}
	
	function cek_upload(){
		var v_kdkppn = document.getElementById('kdkppn').value;
		
        var jml = 0;
        if(v_kdkppn=='' ){
            $('#wkdkppn').html('Harap pilih kppn');
            $('#wkdkppn').fadeIn();
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
</script>