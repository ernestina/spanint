<div id="top">
	<div id="header">
        <h2>MONITORING Perbandingan SP2D dengan Bulan Lalu <?php //echo Session::get('user'); ?><br>
		</h2>
    </div>

<div id="fitur">
		<table width="100%" class="table table-bordered zebra">
            <!--baris pertama-->
			<thead>
				<tr>
					<th width="5%" rowspan="2" valign: "middle">No.</th>
					<th width="35%" rowspan="2">BANK</th>
					<th width="60%" colspan="12">Jumlah SP2D</th>
				</tr>
				<tr>
					<th width="5%">Jan</th>
					<th width="5%">Feb</th>
					<th width="5%">Mar</th>
					<th width="5%">Apr</th>
					<th width="5%">Mei</th>
					<th width="5%">Jun</th>
					<th width="5%">Jul</th>
					<th width="5%">Ags</th>
					<th width="5%">Sep</th>
					<th width="5%">Okt</th>
					<th width="5%">Nov</th>
					<th width="5%">Des</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$no=1;
			if (isset($this->data)){
				$jan=0;
				$feb=0;
				$mar=0;
				$apr=0;
				$mei=0;
				$jun=0;
				$jul=0;
				$ags=0;
				$sep=0;
				$okt=0;
				$nop=0;
				$des=0;
					foreach ($this->data as $value){ 
						echo "<tr> ";
						echo "<td>" . $no++ . "</td>";
						if($value->get_payment_date()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). " target='_blank'>" . $value->get_payment_date(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_invoice_num()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/01 target='_blank'>" . $value->get_invoice_num(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_check_date()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/02 target='_blank'>" . $value->get_check_date(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_creation_date()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/03 target='_blank'>" . $value->get_creation_date(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_check_number()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/04 target='_blank'>" . $value->get_check_number(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_check_number_line_num()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/05 target='_blank'>" . $value->get_check_number_line_num(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_check_amount()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/06 target='_blank'>" . $value->get_check_amount(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_bank_account_name()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/07 target='_blank'>" . $value->get_bank_account_name(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_bank_name()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/08 target='_blank'>" . $value->get_bank_name(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_vendor_ext_bank_account_num()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/09 target='_blank'>" . $value->get_vendor_ext_bank_account_num(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_vendor_name()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/10 target='_blank'>" . $value->get_vendor_name(). "</td>";} else {echo "</a><td>0</td>";}
						if($value->get_invoice_description()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/11 target='_blank'>" . $value->get_invoice_description(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_ftp_file_name()!=''){echo "<td><a href=".URL."dataKppn/detailSp2dGaji/" . $value->get_payment_date(). "/12 target='_blank'>" . $value->get_ftp_file_name(). "</a></td>";} else {echo "<td>0</td>";}
						echo "</tr> ";
						$jan+=$value->get_invoice_num();
						$feb+=$value->get_check_date();
						$mar+=$value->get_creation_date();
						$apr+=$value->get_check_number();
						$mei+=$value->get_check_number_line_num();
						$jun+=$value->get_check_amount();
						$jul+=$value->get_bank_account_name();
						$ags+=$value->get_bank_name();
						$sep+=$value->get_vendor_ext_bank_account_num();
						$okt+=$value->get_vendor_name();
						$nop+=$value->get_invoice_description();
						$des+=$value->get_ftp_file_name();
					}
					echo "<tr> ";
					echo "<td></td>";
					echo "<td><b>TOTAL</b></td>";
					echo "<td><b>".$jan."</b></td>";
					echo "<td><b>".$feb."</b></td>";
					echo "<td><b>".$mar."</b></td>";
					echo "<td><b>".$apr."</b></td>";
					echo "<td><b>".$mei."</b></td>";
					echo "<td><b>".$jun."</b></td>";
					echo "<td><b>".$jul."</b></td>";
					echo "<td><b>".$ags."</b></td>";
					echo "<td><b>".$sep."</b></td>";
					echo "<td><b>".$okt."</b></td>";
					echo "<td><b>".$nop."</b></td>";
					echo "<td><b>".$des."</b></td>";
				} 
//			} 
			?>
			</tbody>
        </table>
		</div>
</div>

<script type="text/javascript">
    
</script>