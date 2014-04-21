<div id="top">
	<div id="header">
        <h2>MONITORING SP2D Gaji Terindikasi Salah BANK <?php echo Session::get('user'); ?><br>
		</h2>
    </div>
</div>
<div id="top">
		<table class="table-bordered zebra scroll" width="100%">
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Kode Satker</th>
					<th>No. Invoice</th>
					<th>No. SP2D</th>
					<th>BO I</th>
					<th>Bank Rekening Penerima</th>
					<th>Nama Supplier</th>
					<th>Rekening Supplier</th>
					<th>Deskripsi</th>
					
			</thead>
			<tbody>
			<?php 
			$no=1;
			if (isset($this->data)){
				if (empty($this->data)){
					echo "Tidak ada data";
				} else {
					foreach ($this->data as $value){ 
						echo "<tr>	";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_kdsatker() . "</td>";
							echo "<td>" . $value->get_invoice_num() . "</td>";
							echo "<td>" . $value->get_check_number() . "</td>";
							echo "<td>" . $value->get_bank_account_name() . "</td>";
							echo "<td>" . $value->get_bank_name() . "</td>";
							echo "<td>" . $value->get_vendor_name() . "</td>";
							echo "<td>" . $value->get_vendor_ext_bank_account_num() . "</td>";
							echo "<td>" . $value->get_invoice_description() . "</td>";
						echo "</tr>	";
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