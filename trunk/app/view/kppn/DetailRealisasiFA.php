<div id="top">
	<div id="header">
        <h2>Detail Realisasi
		<?php //$akun='';
		
		//foreach ($this->data as $value) {
		//$akun=$value->get_akun(); 
		//} 
		//echo //$akun;
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
					<th>Nomor Invoice</th>
					<th>Tanggal Invoice</th>
					<th>Status Invoice</th>
					<th>Nomor SP2D</th>
					<th>Tanggal SP2D</th>
					<th>Nilai Realisasi</th>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			$tot_pot=0;
			
			//var_dump ($this->data);
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info!  </strong>Tidak ada data.</div>";
				} else {
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_invoice_num() . "</td>";
					//echo "<td>" . $value->get_status() . "</td>";
					echo "<td>" . $value->get_invoice_date() . "</td>";
					echo "<td>" . $value->get_status() . "</td>";
					echo "<td>" . $value->get_check_number() . "</td>";
					echo "<td>" . $value->get_check_date() . "</td>";
					echo "<td align='right'>" . number_format($value->get_amount()) . "</td>";
					
				echo "</tr>	";
				$tot_pot = $tot_pot  + $value->get_amount() ;	
				}
			}
			}
			
			?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan='4'></td>
					<td class='ratatengah'><b>GRAND TOTAL</td>
					<td align='right'><b><?php
						echo number_format($tot_pot); ?>
					</td>
					
				</tr>
			</tfoot>
        </table>
		<!--br>
		<b><i>Keterangan Status:  </i></b></br>
		<b><i>REJECTED : Reject (Tidak mengembalikan Pagu, Harus di Batalkan)</i></b></br-->
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