<div id="top">
	<div id="header">
        <h2>HOLD INVOICE 
			 <?php 
			 if (isset($this->d_nama_kppn)) {
				foreach($this->d_nama_kppn as $kppn){
					echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
					$kode_kppn=$kppn->get_kd_satker();
				}
			}
			else {
				echo Session::get('user');
			}
			if (isset($this->d_kppn)) {
				$kd_kppn =$this->d_kppn;
			} else {
				$kd_kppn ="null";
			}
			if (isset($this->d_invoice)) {
				$invoice =$this->d_invoice;
			} else {
				$invoice ="null/null/null";
			}
			if (isset($this->d_status)) {
				$status =$this->d_status;
			} else {
				$status ="null";
			}
			?>
		</h2>
    </div>
<?php
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : holdSPM.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------
				?>
	<ul class="inline" style="float: right">
		<li>
			<a href="<?php echo URL; ?>dataSPM/holdSPM_PDF/<?php echo $kd_kppn."/".$invoice."/".$status; ?>" class="warning"><i class="icon icon-print icon-white"></i>PDF</a>
		</li>

		<li>
			<a href="#xModal" class="modal"><i class="fa fa-filter"></i>&nbsp; FILTER DATA</a>
		</li>
	</ul>
	
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="HoldSpm" enctype="multipart/form-data">
		<div id="winvoice" class="error"></div>
		
		
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
		
		<div id="wbank" class="error"></div>
		<label class="isian">Status Invoice: </label>
		<select type="text" name="STATUS" id="STATUS">
			<option value=''>- pilih -</option>
			<option value="IS NULL" <?php if ($this->status=="IS NULL"){echo "selected";}?>>Invoice Belum Di Cancel</option>
			<option value="IS NOT NULL" <?php if ($this->status=="IS NOT NULL"){echo "selected";}?>>Invoice Sudah Di Cancel</option>
		</select>
		
		<label class="isian">No Invoice: </label>
		<input type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">

		

		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return ();"></li>
		<!--onClick="konfirm(); return false;"-->
		</ul>
	</form>
</div>
</div>
</div>

<?php
                   // untuk menampilkan last_update
                   if (isset($this->last_update)){
foreach ($this->last_update as $last_update){ 
echo "Update Data Terakhir (Waktu Server)  " ?> <br/>
 <?php echo $last_update->get_last_update() . " WIB";
}
                    }
                    ?>

<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader' style='font-size: 90%'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Nomor Invoice</th>
					<th>Nilai Invoice</th>
					<th width='350px'>Uraian</th>
					<th width='200px'>Alasan Hold</th>
					<th width='200px' >Status Release</th>
					<th width='100px'>Tanggal Hold</th>
					<th width='200px'>Status Invoice</th>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_invoice_num() . "</td>";
					echo "<td class='ratakanan'>" . $value->get_invoice_amount() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_description() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_hold_reason() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_release_reason() . "</td>";
					echo "<td>" . $value->get_hold_date() . "</td>";
					echo "<td  class='ratakiri'>" . $value->get_keterangan() . "</td>";
				echo "</tr>	";
			} 
			?>
			</tbody>
        </table></br>
		<b>Keterangan : </b></br>
		Hold invoice adalah invoice yang sukses di FO tapi tidak muncul di MO</br>
		Disebabkan pagu dipa tidak mencukupi, atau tagihan (bruto) melebihi termin
		
		
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
			"table": document.getElementById('example'),
			"datatable": oTable
		} );
	} );
</script>