<div id="top">
	<div id="header">
        <h2>DETAIL ALASAN PENOLAKAN PMRT <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?>
			<?php //echo Session::get('user'); ?>
		</h2>
    </div>

<!--a href="#xModal" class="modal">FILTER DATA</a><br><br>
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="errorSpm" enctype="multipart/form-data">
		<div id="winvoice" class="error"></div>
		
		<label class="isian">No INVOICE: </label>
		<input type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">


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
		<table width="100%" class="table table-bordered zebra" id='fixheader' style="font-size: 80%">
            <!--baris pertama-->
			<thead>
					<th class='mid'>No.</th>
					<th class='mid'>Nomor, Tanggal Invoice</th>
					<th>Nilai Invoice</th>
					<!--th>Tanggal Invoice</th-->
					<th class='mid'>Uraian Invoice</th>
					<th class='mid'>Nama File</th>
					<th>Status Code</th>
					<th class='mid'>Supplier</th>
					<th>Site Supplier</th>
					
					<th class='mid'>Nama Kolom</th>
					<th class='mid'>Nilai Kolom</th>
					<th class='mid'>Error Message</th>
					
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			//var_dump ($this->data);
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_invoice_num() . '<br>' . $value->get_invoice_date() . "</td>";
					echo "<td class='ratakanan'>" . $value->get_invoice_amount() . "</td>";
					//echo "<td>" . $value->get_invoice_date() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_description() . "</td>";
					echo "<td>" . $value->get_file_name() . "</td>";
					echo "<td>" . $value->get_status_code() . "</td>";
					echo "<td>" . $value->get_vendor_name() . "</td>";
					echo "<td>" . $value->get_vendor_site_code() . "</td>";
					
					echo "<td>" . $value->get_column_name() . "</td>";
					echo "<td>" . $value->get_column_value() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_error_message() . "</td>";
					
				echo "</tr>	";
			} 
			}
			}
			else {
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