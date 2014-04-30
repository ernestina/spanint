<div id="top">
	<div id="header">
        <h2>GANTI USER SPAN (belum jadi) <?php //echo Session::get('user'); ?></h2>
    </div>

<a href="#xModal" class="modal">FORM ISIAN</a><br><br>
        <div id="xModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i></a>
	<div id="top">
	<form method="POST" action="HistorySpm" enctype="multipart/form-data">
		<div id="wnosurat" class="error"></div>
		<label class="isian">No. Surat: </label>
		<input type="text" name="no_surat" id="no_surat" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">
		
		<div id="wtglsurat" class="error"></div>
		<label class="isian">Tanggal Surat: </label>
		<input type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">
		
		<div id="wnama" class="error"></div>
		<label class="isian">Nama User: </label>
		<input type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">
		
		<div id="wnip" class="error"></div>
		<label class="isian">NIP User: </label>
		<input type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)){echo $this->d_invoice;}?>">


		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="KIRIM" onClick="return cek_upload();"></li>
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
					<th>Nama Unit</th>
					<th>No. Surat</th>
					<th>Tgl Surat</th>
					<th>Nama User</th>
					<th>NIP User</th>
					<th>Email User</th>
								
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
					echo "<td>" . $value->get_nama_unit() . "</td>";
					echo "<td>" . $value->get_no_surat() . "</td>";
					echo "<td>" . $value->get_tgl_surat() . "</td>";
					echo "<td>" . $value->get_nama_user1() . "</td>";
					echo "<td>" . $value->get_nip_user1() . "</td>";
					echo "<td>" . $value->get_email_user1() . "</td>";
					/*echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";
					echo "<td>" . $value->get_posisi_user1() . "</td>";*/
					
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