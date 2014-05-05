<div id="top">
	<div id="header">
        <h2>PENOLAKAN UPLOAD PMRT <?php //echo $nama_satker; ?> <?php //echo $kode_satker; ?>
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
	<form method="POST" action="ValidasiSpm" enctype="multipart/form-data">
		<div id="wsatker" class="error"></div>
		<label class="isian">Kode Satker: </label>
		<input type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)){echo $this->kdsatker;}?>">

		<label class="isian">Nama File: </label>
		<input type="text" name="file_name" id="file_name" value="<?php if (isset($this->file_name)){echo $this->file_name;}?>">
		
		<div id="wtgl" class="error"></div>
		<label class="isian">Tanggal: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->tgl_awal)){echo $this->tgl_awal;}?>" /> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->tgl_akhir)){echo $this->tgl_akhir;}?>"></li>
		</ul>

		<input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
		<input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
		<input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
		<input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
		<input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker."_".$kode_kppn."_".date("d-m-y")."_"; ?>">
		<!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

		<ul class="inline" style="margin-left: 130px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="CARI" onClick=""></li>
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
					<th>Tanggal Upload</th>
					<th>Nama File</th>
					<th>Kode Satker</th>
					<th>Status Code</th>
					
					
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
					echo "<td>" . $value->get_creation_date() . "</td>";
					echo "<td><a href=".URL."dataSPM/errorSpm/".$value->get_file_name()." target='_blank' '>" . $value->get_file_name() . "</a></td>";
					echo "<td>" . $value->get_satker_code() . "</td>";
					echo "<td>" . $value->get_status_code() . "</td>";
					
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
		
		$("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
		});
		
		$("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
		});
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
				
		$('#kdsatker').change(function(){
            if(document.getElementById('kdsatker').value !=''){
                $('#wsatker').fadeOut(200);
            }
        });
		
		$('#datepicker').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#datepicker1').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
    }
    
    function cek_upload(){
		var v_invoice = document.getElementById('kdsatker').value;
		
        var jml = 0;
		if(v_invoice==''){
			$('#wsatker').html('Harap isi no invoice');
            $('#wsatker').fadeIn();
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
			"table": document.getElementById('fixheader'),
			"datatable": oTable
		} );
	} );
</script>