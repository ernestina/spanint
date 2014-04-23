<div id="top">
	<div id="header">
        <h2>MONITORING Perbandingan SP2D dengan Bulan Lalu <?php echo Session::get('user'); ?><br>
		</h2>
    </div>

<div id="fitur">
		<table width="100%" class="table table-bordered zebra scroll">
            <!--baris pertama-->
			<thead>
				<tr>
					<th width="5%" rowspan="2" style="halign: center">No.</th>
					<th width="35%" rowspan="2">BANK</th>
					<th width="60%" colspan="12">Jumlah SP2D</th>
				</tr>
				<tr>
					<th width="5%">Janu</th>
					<th width="5%">Febru</th>
					<th width="5%">Maret</th>
					<th width="5%">April</th>
					<th width="5%">Mei</th>
					<th width="5%">Juni</th>
					<th width="5%">Juli</th>
					<th width="5%">Agust</th>
					<th width="5%">Sept</th>
					<th width="5%">Okto</th>
					<th width="5%">Nove</th>
					<th width="5%">Dese</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$no=1;
			if (isset($this->data)){
//				if (empty($this->data)){
//					echo "Tidak ada data";
//				} else {
					foreach ($this->data as $value){ 
						echo "<tr> ";
						echo "<td>" . $no++ . "</td>";
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
//			} 
			?>
			</tbody>
        </table>
		</div>
</div>

<script type="text/javascript">
    
</script>