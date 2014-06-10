<div id="top">
	<div id="header">
        <h2>Detail Realisasi Belanja Per Bagian Anggaran 
		<?php if (isset($this->d_nama_kppn)) {
				foreach($this->d_nama_kppn as $kppn){
					echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
					$kode_kppn=$kppn->get_kd_satker();
				}
			}
			else {echo Session::get('user');}?>
			<br>
			Sampai Dengan
			
			<?php 
			//echo 
			//Tanggal::tgl_indo(Tanggal::getTglSekarang()) ;
			//echo (date('d-m-y'));
			

		$date = new DateTime(Tanggal::getTglSekarang());
		$date->sub(new DateInterval('P1D'));
		echo Tanggal::tgl_indo($date->format('Y-m-d') ). "\n";			
			?>
		</h2>
    
<table><tr><td width="90%">
</div>

</table>


<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id="fixheader" style="font-size: 72%">
            <!--baris pertama-->
			<thead>
			<tr>
					<th rowspan=2 width="10px" class='mid'>No.</th>
					<!--th>KPPN</th-->
					<!--th>Tanggal</th-->
					<th rowspan=2 class='mid'>Kode BA</th>
					<th rowspan=2 class='mid'> Nama BA </th>
					<th rowspan=2 class='mid'> Pagu </th>
					<th colspan=9 class='mid'>Jenis Belanja</th>
					<th rowspan=2 class='mid' >Sisa Pagu</th>
			</tr>
			<tr >
					<th >Pegawai</th>
					<th >Barang</th>
					<th >Modal</th>
					<th >Beban Bunga</th>
					<th >Subsidi</th>
					<th >Hibah</th>
					<th >BanSos</th>
					<th >Lain lain</th>
					<!--th >Pencadangan Dana</th-->
					<th >Total</th>
					
			</tr>
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
					echo "<td>" . $value->get_ba() . "</td>";
					echo "<td align='left'>" . $value->get_nmba() . "</td>";
					echo "<td align='right'>" . number_format($value->get_Pagu()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_51()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_52()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_53()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_54()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_55()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_56()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_57()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_58()) . "</td>";
					//echo "<td align='right'>" . number_format($value->get_encumbrance()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_belanja_51()+$value->get_belanja_52()+$value->get_belanja_53()+$value->get_belanja_54()
					+$value->get_belanja_55()+$value->get_belanja_56()+$value->get_belanja_57()+$value->get_belanja_58()) . "</td>";
					echo "<td align='right'>" . number_format($value->get_pagu()-($value->get_belanja_51()+$value->get_belanja_52()+$value->get_belanja_53()+$value->get_belanja_54()
					+$value->get_belanja_55()+$value->get_belanja_56()+$value->get_belanja_57()+$value->get_belanja_58())) . "</td>";
					//echo "<td align='right'>" . number_format($value->get_belanja_59()) . "</td>";
					
				echo "</tr>	";
				//$tot_pot = $tot_pot  + $value->get_amount() ;	
				}
			}
			}
			
			?>
			</tbody>
			<tfoot>
				<!--tr>
					<td colspan='4'></td>
					<td class='ratatengah'><b>GRAND TOTAL</td>
					<td align='right'><b><?php
						//echo number_format($tot_pot); ?>
					</td>
					
				</tr-->
			</tfoot>
        </table>
		</div>
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
		var oTable = $('#example').dataTable( {
			"sScrollY": "300px",
			"sScrollX": "100%",
			"sScrollXInner": "110%",
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