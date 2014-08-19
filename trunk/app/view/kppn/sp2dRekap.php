<div id="top">
	<div id="header">
        <h2>MONITORING Rekap SP2D Harian
		<?php if (isset($this->d_nama_kppn)) {
				foreach($this->d_nama_kppn as $kppn){
					echo "<br>".$kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
					$kode_kppn=$kppn->get_kd_satker();
				}
			}?>
			<?php if (isset($this->d_bank)) {
					if($this->d_bank=="MDRI"){
						echo "<br> Mandiri" ;
					}elseif($this->d_bank=="5"){
						echo "<br> Semua Bank" ;
					} else {
						echo "<br> ".$this->d_bank;
					}
			}
			?>
			<?php if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
					echo "<br>".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
			}
			?>
		</h2>
    </div>

<a href="#oModal" class="modal">FILTER DATA</a><br><br>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
				<a href="<?php
                    $_SERVER['PHP_SELF'];
                ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
</a>
	
<div id="top">	
	<form method="POST" action="sp2dRekap" enctype="multipart/form-data">
	
		<?php if (isset($this->kppn_list)) { ?>
		<div id="wkdkppn" class="error"></div>
		<label class="isian">Kode KPPN: </label>
		<select type="text" name="kdkppn" id="kdkppn">
		<?php foreach ($this->kppn_list as $value1){ 
				if ($kode_kppn==$value1->get_kd_d_kppn()){echo "<option value='".$value1->get_kd_d_kppn()."' selected>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";} 
				else {echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";}
			
		} ?>
		</select>
		<?php } ?>
		
		<div id="wtgl" class="error"></div>
		<label class="isian">Tanggal: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>"> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>"></li>
		</ul>
		
		<ul class="inline" style="margin-left: 150px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload()"></li>
		</ul>
	</form>
</div>
</div>
</div>

<?php
// untuk menampilkan last_update
if (isset($this->last_update)){
	foreach ($this->last_update as $last_update){ 
		echo "<td>Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB </td>";
	}
}
?>

<div id="fitur">
		<table width="100%" class="table table-bordered zebra">
            <!--baris pertama-->
			<thead>
				<tr>
					<th  style="halign: center">No.</th>
					<th >BANK</th>
					<th >GAJI</th>
					<th >NILAI GAJI</th>
					<th >NON GAJI</th>
					<th >NILAI NON GAJI</th>
					<th >TOTAL</th>
					<th >NILAI TOTAL</th>
					<th >RETUR</th>
					<th >NILAI RETUR</th>
					<th >VOID</th>
					<th >NILAI VOID</th>
				</tr>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			if (isset($this->data)){
				$gaji=0;
				$non_gaji=0;
				$total=0;
				$retur=0;
				$void=0;
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
					foreach ($this->data as $value){ 
						echo "<tr> ";
						echo "<td>" . $no++ . "</td>";
						if($value->get_payment_date()!=''){echo "<td align='left'>" . $value->get_payment_date(). "</td>";} else {echo "<td>???</td>";}
						//filter gaji
						if (isset($this->d_nama_kppn)) {
							if($value->get_invoice_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/1/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn." target='_blank'>" . $value->get_invoice_num(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_invoice_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/1/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_invoice_num(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'>" . number_format($value->get_check_amount()). "</a></td>";
						//filter non-gaji
						if (isset($this->d_nama_kppn)) {
							if($value->get_check_date()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/2/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn." target='_blank'>" . $value->get_check_date(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_check_date()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/2/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_check_date(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'> " . number_format($value->get_bank_account_name()). "</a></td>";
						$tot = $value->get_invoice_num() + $value->get_check_date();
						$nil_tot = $value->get_check_amount() + $value->get_bank_name();
						if($tot!=''){echo "<td>" . $tot. "</td>";} else {echo "<td>0</td>";}
						echo "<td align='right'>" . number_format($value->get_vendor_name()). "</a></td>";
						//filter retur
						if (isset($this->d_nama_kppn)) {
							if($value->get_check_number()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn." target='_blank'>" . $value->get_check_number(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_check_number()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_check_number(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'>" . number_format($value->get_bank_name()). "</a></td>";
						//filter void
						if (isset($this->d_nama_kppn)) {
							if($value->get_check_number_line_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ."/".$kode_kppn." target='_blank'>" . $value->get_check_number_line_num(). "</a></td>";} else {echo "<td>0</td>";}
						} else {
							if($value->get_check_number_line_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_check_number_line_num(). "</a></td>";} else {echo "<td>0</td>";}
						}
						echo "<td align='right'>" . number_format($value->get_vendor_ext_bank_account_num()). "</a></td>";
						echo "</tr> ";
						$gaji+=$value->get_invoice_num();
						$nil_gaji+=$value->get_check_amount();
						$non_gaji+=$value->get_check_date();
						$nil_non_gaji+=$value->get_bank_account_name();
						$total+=$tot;
						$nilai_tot+=$value->get_vendor_name();
						$retur+=$value->get_check_number();
						$nil_retur+=$value->get_bank_name();
						$void+=$value->get_check_number_line_num();
						$nil_void+=$value->get_vendor_ext_bank_account_num();
						
					}
					echo "<tr> ";
					echo "<td></td>";
					echo "<td><b>GRAND TOTAL</b></td>";
					echo "<td><b>".$gaji."</b></td>";
					echo "<td align='right'><b>".number_format($nil_gaji)."</b></td>";
					echo "<td><b>".$non_gaji."</b></td>";
					echo "<td align='right'><b>".number_format($nil_non_gaji)."</b></td>";
					echo "<td><b>".$total."</b></td>";
					echo "<td align='right'><b>".number_format($nilai_tot)."</b></td>";
					echo "<td><b>".$retur."</b></td>";
					echo "<td align='right'><b>".number_format($nil_retur)."</b></td>";
					echo "<td><b>".$void."</b></td>";
					echo "<td align='right'><b>".number_format($nil_void)."</b></td>";
				} 
			} else {
				echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
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
    $(function(){
        hideErrorId();
        hideWarning();
	    $("#tgl_awal").datepicker({
        maxDate: "dateToday",
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate, instance) {
            if (selectedDate != '') {
                $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                var date = $.datepicker.parseDate(instance.settings.dateFormat, selectedDate, instance.settings);
                date.setMonth(date.getMonth() + 1);
                console.log(selectedDate, date);
                $("#tgl_akhir").datepicker("option", "minDate", selectedDate);
                $("#tgl_akhir").datepicker("option", "maxDate", date);
            }
        }
    });
    $("#tgl_akhir").datepicker({
        maxDate: "dateToday",
        dateFormat: 'dd-mm-yy',
        onClose: function (selectedDate) {
            $("#tgl_awal").datepicker("option", "maxDate", selectedDate);
			}
		});		
	});
	
    function hideErrorId(){
        $('.error').fadeOut(0);
    }
	
	function hideWarning(){
		
		$('#tgl_awal').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#tgl_akhir').change(function(){
            if(document.getElementById('tgl_awal').value !='' && document.getElementById('tgl_akhir').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
    }
	
	function cek_upload(){
		var v_tglawal = document.getElementById('tgl_awal').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		var jml = 0;
		
		if(v_tglawal=='' || v_tglakhir==''){
			$('#wtgl').html('Harap isi kolom tanggal ');
            $('#wtgl').fadeIn();
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