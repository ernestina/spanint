<div id="top">
	<div id="header">
        <h2>DURASI PEMROSESAN SPM - SP2D 
		<?php if (isset($this->d_nama_kppn)) {
				foreach($this->d_nama_kppn as $kppn){
					echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
					$kode_kppn=$kppn->get_kd_satker();
				}
			}
		
		else{ echo Session::get('user');
		} ?>
		</h2>
    </div>

<a href="#zModal" class="modal">FILTER DATA</a><br><br>
        <div id="zModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>
	
	<div id="top">
	<form method="POST" action="DurasiSpm" enctype="multipart/form-data">
		
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
		
		
		
		<label class="isian">Jenis SPM: </label>
		<select type="text" name="JenisSPM" id="JenisSPM">
			<option value=''>- pilih -</option>
			<option value='GAJI INDUK' <?php if ($this->status=="GAJI INDUK"){echo "GAJI INDUK";}?>>GAJI INDUK</option>
			<option value='GAJI SUSULAN' <?php if ($this->status=="GAJI SUSULAN"){echo "GAJI SUSULAN";}?>>GAJI SUSULAN</option>
			<option value='GAJI LAINNYA' <?php if ($this->status=="GAJI LAINNYA"){echo "GAJI LAINNYA";}?>>GAJI LAINNYA</option>	
			<option value='LANGSUNG' <?php if ($this->status=="GAJI LAINNYA"){echo "GAJI LAINNYA";}?>>LANGSUNG</option>	
			<option value='LS-KONTRAKTUAL' <?php if ($this->status=="LS-KONTRAKTUAL"){echo "LS-KONTRAKTUAL";}?>>LS-KONTRAKTUAL</option>
			<option value='DANA UP (UYHD)' <?php if ($this->status=="DANA UP (UYHD)"){echo "DANA UP (UYHD)";}?>>DANA UP (UYHD)</option>
			<option value='GANTI UP' <?php if ($this->status=="GANTI UP"){echo "GANTI UP";}?>>GANTI UP</option>
		</select>
		
		<label class="isian">Durasi: </label>	
		<select type="text" name="durasi" id="durasi">
			<option value=''>- pilih -</option>
			<option value="> 0 and durasi2 < '1" <?php if ($this->durasi=="< 1"){echo "Kurang dari 1 jam";}?>>Kurang dari satu jam</option>
			<option value="> '1" <?php if ($this->durasi=="> 1"){echo "Lebih dari 1 jam";}?>>Lebih dari satu jam</option>
			<option value="> '24" <?php if ($this->durasi=="> 24"){echo "Lebih dari 1 hari";}?>>Lebih dari satu hari</option>
			
		</select>
		
		<div id="winvoice" class="error"></div>
		<label class="isian">No Invoice: </label>
		<input type="text" name="invoice" id="invoice" value="<?php if (isset($this->invoice)){echo $this->invoice;}?>">
		
		<div id="winvoice" class="error"></div>
		<label class="isian">Kode Satker: </label>
		<input type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)){echo $this->kdsatker;}?>">

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

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick=""></li>
		<!--onClick="konfirm(); return false;"-->
		</ul>
	</form>
</div>
</div>
</div>



<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Nomor Invoice</th>
					<th>Nomor SP2D</th>
					<!--th>KPPN</th-->
					<th>Jenis SPM</th>
					<th>Tanggal Upload</th>
					<!--th>Jam Upload</th-->
					<th>Tanggal Selesai SP2D</th>
					<!--th>Jam Selesai SP2D</th-->
					<th>Durasi</th>
					
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
						echo "<td>" . $value->get_invoice_num() . "</td>";
						echo "<td>" . $value->get_check_number() . "</td>";
						echo "<td>" . $value->get_attribute1() . "</td>";
						echo "<td>" . strtoupper($value->get_aia_creation_date()) . ' '  . $value->get_jam_upload() . "</td>";
						//echo "<td>" . $value->get_jam_upload() . "</td>";
						echo "<td>" . $value->get_aca_creation_date() . ' ' . $value->get_jam_selesai_sp2d() .  "</td>";
						//echo "<td>" . $value->get_jam_selesai_sp2d() . "</td>";
						echo "<td>" . $value->get_durasi() . "</td>";
						
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

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
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