<div id="top">
	<div id="header">
        <h2>DETAIL PENERIMAAN FILE : <?php echo $this->d_tgl; ?> <?php //echo $kode_satker; ?>
			<?php //echo Session::get('user'); ?>
		</h2>
    </div>

	<div id="fitur">
		<table width="100%" class="table table-bordered zebra scroll">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>NTPN</th>
					<th>NTB</th>
					<th>Tanggal Penerimaan</th>
					<th>Kode Bank</th>
					<th>Nomor Rekening Persepsi</th>
					<th>Jumlah Rupiah</th>
					<th>Satker/KPPN/Akun</th>
					
			</thead>
			<tbody>
			<?php 
			$no=1;
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_status() . "</td>";
					echo "<td>" . $value->get_file_name() . "</td>";
					echo "<td>" . $value->get_gl_date() . "</td>";
					echo "<td>" . $value->get_bank_code() . "</td>";
					echo "<td>" . $value->get_bank_account_num() . "</td>";
					echo "<td>" . $value->get_keterangan() . "</td>";
					echo "<td>" . $value->get_resp_name() . "</td>";
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