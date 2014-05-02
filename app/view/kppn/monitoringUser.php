<div id="top">
	<div id="header">
        <h2>MANAJEMEN USER
			 <?php //echo Session::get('user'); ?>
		</h2>
    </div>

<a href="#oModal" class="modal">FILTER DATA</a><br><br>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>

<div id="top">
	<form method="POST" action=" monitoringUserSpan" enctype="multipart/form-data">
		
		<div id="wnip" class="error"></div>
		<label class="isian">NIP: </label>
		<input type="number" name="nip" id="nip" size="15">

	
		<ul class="inline" style="margin-left: 150px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="Cari" onClick="return cek_upload();"></li>
		<!--onClick="konfirm(); return false;"-->
		</ul>
	</form>
</div>
</div>
</div>


<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id="example">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<!--th>KPPN</th-->
					<th>Nama</th>
					<th>User Name</th>
					<th>NIP</th>
					<th>Posisi</th>
					<!--th>Responsibility Name</th-->
					<th>Email Depkeu</th>
					<th>Tanggal Mulai Aktif</th>
					<th>Tanggal Berakhir</th>

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
					//echo "<td>" . $value->get_kdkppn() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_last_name() . "</td>";
					echo "<td>" . $value->get_user_name() . "</td>";
					echo "<td>" . $value->get_attribute1() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_name() . "</td>";
					//echo "<td>" . $value->get_responsibility_name() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_email_address() . "</td>";
					echo "<td>" . $value->get_start_date() . "</td>";
					echo "<td>" . $value->get_end_date() . "</td>";
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
<script type="text/javascript" charset="utf-8">
    $(function(){
        hideErrorId();
        hideWarning();
        
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
        $('#nip').keyup(function(){
            if(document.getElementById('nip').value !=''){
                $('#wnip').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var pattern = '^[0-9]+$';
		var v_nip = document.getElementById('nip').value;
		
		
        var jml = 0;
        if(v_nip == ''){
            $('#wnip').html('Harap isi NIP pegawai');
            $('#wnip').fadeIn();
            jml++;
        }
		
		if(v_nip !='' && v_nip.length != 18 ){
            $('#wnip').html('NIP harus 18 digit');
            $('#wnip').fadeIn(200);
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
	$(document).ready( function () {
		var oTable = $('#example').dataTable( {
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