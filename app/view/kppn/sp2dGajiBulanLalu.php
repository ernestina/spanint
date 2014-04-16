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
					<th colspan="12">Jumlah. SP2D</th>
				</tr>
				<tr>
					<th>Januari</th>
					<th>Februari</th>
					<th>Maret</th>
					<th>April</th>
					<th>Mei</th>
					<th>Juni</th>
					<th>Juli</th>
					<th>Agustus</th>
					<th>Sepetember</th>
					<th>Oktober</th>
					<th>November</th>
					<th>Desember</th>
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
						echo "<tr> ";
						echo "<td>" . $no++ . "</td>";
						if($value->get_kdkppn()!=''){echo "<td>" . $value->get_kdkppn(). "</td>";} else {echo "<td>tidak ada data</td>";} 
						if($value->get_payment_date()!=''){echo "<td>" . $value->get_payment_date(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_invoice_num()!=''){echo "<td>" . $value->get_invoice_num(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_check_date()!=''){echo "<td>" . $value->get_check_date(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_creation_date()!=''){echo "<td>" . $value->get_creation_date(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_check_number()!=''){echo "<td>" . $value->get_check_number(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_check_number_line_num()!=''){echo "<td>" . $value->get_check_number_line_num(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_check_amount()!=''){echo "<td>" . $value->get_check_amount(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_bank_account_name()!=''){echo "<td>" . $value->get_bank_account_name(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_bank_name()!=''){echo "<td>" . $value->get_bank_name(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_vendor_ext_bank_account_num()!=''){echo "<td>" . $value->get_vendor_ext_bank_account_num(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_vendor_name()!=''){echo "<td>" . $value->get_vendor_name(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_invoice_description()!=''){echo "<td>" . $value->get_invoice_description(). "</td>";} else {echo "<td>0</td>";}
						if($value->get_ftp_file_name()!=''){echo "<td>" . $value->get_ftp_file_name(). "</td>";} else {echo "<td>0</td>";}
						echo "</tr> ";
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