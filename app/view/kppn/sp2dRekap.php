<div id="top">
	<div id="header">
        <h2>MONITORING Rekap SP2D Harian <?php if (Session::get('role') == ADMIN) {echo "KPPN ".$this->d_kdkppn;} ?><br>
		<?php echo "Tanggal : ".date("d-m-Y",strtotime($this->d_tgl_awal))." s.d ".date("d-m-Y",strtotime($this->d_tgl_akhir)); ?>
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
	<form method="POST" action="Sp2dRekap" enctype="multipart/form-data">
		
		<div id="wtgl" class="error"></div>
		<label class="isian">Tanggal: </label>
		<ul class="inline">
		<li><input type="text" class="tanggal" name="tgl_awal" id="datepicker" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>"> </li> <li>s/d</li>
		<li><input type="text" class="tanggal" name="tgl_akhir" id="datepicker1" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>"></li>
		</ul>
		
		<ul class="inline" style="margin-left: 150px">
		<li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
		<li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload()"></li>
		</ul>
	</form>
</div>
</div>
</div>

<div id="fitur">
		<table width="100%" class="table table-bordered zebra">
            <!--baris pertama-->
			<thead>
				<tr>
					<th  style="halign: center">No.</th>
					<th >BANK</th>
					<th >GAJI</th>
					<th >NON GAJI</th>
					<th >TOTAL</th>
					<th >RETUR</th>
					<th >VOID</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$no=1;
			if (isset($this->data)){
				$gaji=0;
				$non_gaji=0;
				$total=0;
				$retur=0;
				$void=0;
					foreach ($this->data as $value){ 
						echo "<tr> ";
						echo "<td>" . $no++ . "</td>";
						if($value->get_payment_date()!=''){echo "<td>" . $value->get_payment_date(). "</td>";} else {echo "<td>???</td>";}
						if($value->get_invoice_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/1/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_invoice_num(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_check_date()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/2/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_check_date(). "</a></td>";} else {echo "<td>0</td>";}
						$tot = $value->get_invoice_num() + $value->get_check_date();
						if($tot!=''){echo "<td>" . $tot. "</td>";} else {echo "<td>0</td>";}
						if($value->get_check_number()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_check_number(). "</a></td>";} else {echo "<td>0</td>";}
						if($value->get_check_number_line_num()!=''){echo "<td><a href=".URL."dataKppn/detailRekapSP2D/" . $value->get_payment_date() . "/3/" . date('d-m-Y',strtotime($this->d_tgl_awal)) . "/" .  date('d-m-Y',strtotime($this->d_tgl_akhir)) ." target='_blank'>" . $value->get_check_number_line_num(). "</a></td>";} else {echo "<td>0</td>";}
						echo "</tr> ";
						$gaji+=$value->get_invoice_num();
						$non_gaji+=$value->get_check_date();
						$total+=$tot;
						$retur+=$value->get_check_number();
						$void+=$value->get_check_number_line_num();
					}
					echo "<tr> ";
					echo "<td></td>";
					echo "<td><b>TOTAL</b></td>";
					echo "<td><b>".$gaji."</b></td>";
					echo "<td><b>".$non_gaji."</b></td>";
					echo "<td><b>".$total."</b></td>";
					echo "<td><b>".$retur."</b></td>";
					echo "<td><b>".$void."</b></td>";
				} 
//			} 
			?>
			</tbody>
        </table>
		</div>
</div>

<script type="text/javascript">
    $(function(){
        hideErrorId();
        hideWarning();
		
		$("#datepicker").datepicker({dateFormat: "dd-mm-yy"
		});
		
		$("#datepicker1").datepicker({dateFormat: "dd-mm-yy"
		});
    });
	
    function hideErrorId(){
        $('.error').fadeOut(0);
    }
	
	function hideWarning(){
		
		$('#datepicker').change(function(){
            if(document.getElementById('datepicker').value !='' && document.getElementById('datepicker1').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
		$('#datepicker1').change(function(){
            if(document.getElementById('datepicker').value !='' && document.getElementById('datepicker1').value !=''){
                $('#wtgl').fadeOut(200);
            } 
        });
		
    }
	
	function cek_upload(){
		var v_tglawal = document.getElementById('datepicker').value;
		var v_tglakhir = document.getElementById('datepicker1').value;
		var jml = 0;
		
		if(v_tglawal=='' || v_tglakhir==''){
			$('#wtgl').html('Harap isi kolom tanggal ');
            $('#wtgl').fadeIn();
            jml++;
        }
		
		if(v_tglawal>v_tglakhir){
            $('#wtgl').html('Tanggal awal tidak boleh melebihi tanggal akhir');
            $('#wtgl').fadeIn(200);
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
</script>