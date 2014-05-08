<div id="top">
	<div id="header">
        <h2>MONITORING SP2D Gaji Terindikasi Salah Tanggal <?php if (Session::get('role') == ADMIN) {echo "Semua KPPN";} //else{echo Session::get('user');} ?><br>
		</h2>
    </div>

<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Kode Satker</th>
					<th>No. Invoice</th>
					<th>No. SP2D</th>
					<th>Tanggal SP2D</th>
					<th>Tanggal Proses SP2D</th>
					<th>Deskripsi</th>
					
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
							echo "<td>" . $value->get_kdsatker() . "</td>";
							echo "<td>" . $value->get_invoice_num() . "</td>";
							echo "<td>" . $value->get_check_number() . "</td>";
							echo "<td>" . $value->get_payment_date() . "</td>";
							echo "<td>" . $value->get_creation_date() . "</td>";
							echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
						echo "</tr>	";
					}
				} 
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