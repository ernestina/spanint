<div id="top">
	<div id="header">
        <h2>Monitoring PFK Akun 
		<?php $akun='';
		
		foreach ($this->data as $value) {
		$akun=$value->get_akun(); 
		} 
		echo $akun;
		?>
		</h2>
    
<table><tr><td width="90%">
</div>


</table>


<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Sumber Transaksi</th>
					<th>Nama wajib Bayar setor</th>
					<th>Tanggal Buku</th>
					<th>Tanggal Bayar</th>
					<th>NTPN/SP2D</th>
					<th>Rupiah</th>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			$tot_pot=0;
			
			//var_dump ($this->data);
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_keterangan() . "</td>";
					echo "<td>" . $value->get_nama_wajib_bayar_setor() . "</td>";
					echo "<td>" . $value->get_tanggal_buku() . "</td>";
					echo "<td>" . $value->get_tanggal_bayar() . "</td>";
					echo "<td>" . $value->get_ntpn() . "</td>";
					echo "<td align='right'>" . number_format($value->get_rupiah()) . "</td>";
				echo "</tr>	";
				$tot_pot = $tot_pot  + $value->get_rupiah() ;	
				}
			}
			}
			
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan='5'></td>
					<td class='ratatengah'><b>GRAND TOTAL</td>
					<td align='right'><b><?php
						echo number_format($tot_pot); ?>
					</td>
					
				</tr>
			</tfoot>
        </table>
		</div>
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