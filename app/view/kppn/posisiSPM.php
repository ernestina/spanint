<div id="top">
	<div id="header">
        <h2>MONITORING POSISI SPM <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?><br>
			<?php echo Session::get('user'); ?>
		</h2>
    </div>

<!--a href="#zModal" class="modal">FILTER DATA</a><br><br>
        <div id="zModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>
	
	<div id="top">
	<form method="POST" action="posisiSpm" enctype="multipart/form-data">
		
		<div id="winvoice" class="error"></div>
		<label class="isian">No Invoice: </label>
		<input type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">

		<div id="wtgl" class="error"></div>
		<label class="isian">Tanggal: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>" /> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>"></li>
		</ul>

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
					<th>Nomor Invoice</th>
					<th>Nilai Invoice Rp</th>
					<th>Deskripsi Invoice</th>
					<th>Approval Status</th>
					<th>Status</th>
					<!--th>original_recipient</th-->
					<th>User</th>
					<th>Posisi User</th>
					<th>Mulai</th>
					<!--th>Jam Mulai</th>
					<th>Selesai</th>
					<th>Durasi</th-->
			</thead>
			<tbody>
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
						
						//echo "<td>" . $value->get_ou_name() . "</td>";
						echo "<td><a href=''>" . $value->get_invoice_num() . "</a></td>";
						echo "<td class='ratakanan'>" . $value->get_invoice_amount() . "</td>";
						echo "<td>" . $value->get_invoice_description() . "</td>";
						echo "<td>" . $value->get_wfapproval_status() . "</td>";
						echo "<td>" . $value->get_status() . "</td>";
						//echo "<td>" . $value->get_original_recipient() . "</td>";
						echo "<td>" . $value->get_to_user() . ' ' . $value->get_original_recipient() . "</td>";
						echo "<td>" . $value->get_fu_description() . "</td>";
						echo "<td>" . $value->get_begin_date() . ' ' . $value->get_time_begin_date() . "</td>";
						//echo "<td>" . $value->get_time_begin_date() . "</td>";
						//echo "<td>" . $value->get_end_date() . ' ' . $value->get_time_end_date() . "</td>";
						//echo "<td>" . $value->get_time_end_date() . "</td>";
						//echo "<td> &nbsp </td>";
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
	/*
	$(function(){
        hideErrorId();
        hideWarning();
		
		$("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
		});
		
		$("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
		});
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
		$('#tgl_awal').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#tgl_akhir').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });

    }
    
    function cek_upload(){
		var v_invoice = document.getElementById('invoice').value;
		var v_tglawal = document.getElementById('tgl_awal').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		
        var jml = 0;
        if(v_invoice=='' && v_tglawal=='' && v_tglakhir==''){
            $('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
			$('#wtgl').html('Harap isi tanggal');
            $('#wtgl').fadeIn();
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
	*/
</script>