<div id="top">
	<div id="header">
        <h2>MONITORING Perbandingan SP2D dengan Bulan Lalu Seluruh KPPN<br>
		</h2>
    </div>
</div>
<div id="top">
		<table class="table-bordered zebra scroll" width="100%">
            <!--baris pertama-->
			<thead>
				<tr>
					<th rowspan="2">No.</th>
					<th rowspan="2">Kode KPPN</th>
					<th rowspan="2">BANK</th>
					<th colspan="2">Jumlah. SP2D</th>
				</tr>
				<tr>
					<th>Maret</th>
					<th>April</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$no=1;
			if (isset($this->data)){
				if (empty($this->data)){
					echo "Tidak ada data";
				} else {
					foreach ($this->data as $value){ 
						if ($value->get_bulan()=="MARET"){
							echo "<tr>	";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_kdkppn() . "</td>";
							echo "<td>" . $value->get_bank_account_name() . "</td>";
							echo "<td>" . $value->get_jumlah_sp2d() . "</td>";
						} else if ($value->get_bulan()=="APRIL") {
							echo "<td>" . $value->get_jumlah_sp2d() . "</td>";
							echo "</tr>	";
						}
					}
				} 
			} 
			?>
			</tbody>
        </table>
		</div>
</div>

<script type="text/javascript">
    
</script>