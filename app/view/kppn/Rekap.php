<div id="top">
	<div id="header">
        <h2>REKAP SP2D ATAS SPM <br> 
		
		
		<?php 
		$nmsatker='';
		foreach ($this->data as $value) 
		{$jenis_spm=$value->get_attribute6() ;}
		 echo $jenis_spm;
		
		//{$nmsatker=$value->get_nmsatker();} 
		//echo $nmsatker;
		?>
			
		</h2>
    </div>
<?php
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : Rekap.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------
			foreach ($this->data as $value) {
			$kdkppn=substr($value->get_check_number(),2,3);
			$kdjendok=$value->get_jendok();
			$kdjensp2d=$value->get_jenis_sp2d();
			
			} 
				$check_number='null';
				$invoice='null';
				$JenisSP2D='null';
				$JenisSPM='null';
				$kdtgl_awal='null';
				$kdtgl_akhir='null';
			if (isset($this->d_invoice)) {
				$check_number=$this->d_invoice;
				
				}

			if (isset($this->invoice)) {
				$invoice=$this->invoice;
				}
			
			if (isset($this->JenisSP2D)) {
				$JenisSP2D=$this->JenisSP2D;
			}
			if (isset($this->JenisSPM)) {
				$JenisSPM=$this->JenisSPM;
			}
			if (isset($this->d_tgl_awal)) {
				$kdtgl_awal=$this->d_tgl_awal;
				list($bln,$tgl,$thn)=explode('/',$kdtgl_awal);
				$kdtgl_awal=$bln."-".$tgl."-".$thn;
			}
			if (isset($this->d_tgl_akhir)) {
				$kdtgl_akhir=$this->d_tgl_akhir;
				list($bln,$tgl,$thn)=explode('/',$kdtgl_akhir);				
				$kdtgl_akhir=$bln."-".$tgl."-".$thn;
			}
			
				?>
			<a href="<?php echo URL; ?>dataSPM/detailrekapsp2d_PDF/<?php echo $kdjendok."/".$kdkppn;?>" class="modal">PDF</a>

			
		<?php
			//----------------------------------------------------		
		?>


<?php
                   // untuk menampilkan last_update
                   if (isset($this->last_update)){
foreach ($this->last_update as $last_update){ 
echo "Update Data Terakhir (Waktu Server)  " ?> <br/>
 <?php echo $last_update->get_last_update() . " WIB";
}
                    }
                    ?>


<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader' style='font-size: 90%'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Nomor SP2D</th>
					<th width='70px'>Tanggal Selesai SP2D</th>
					<th width='70px'>Tanggal SP2D</th>
					<th>Nilai SP2D </th>
					<th>Nomor Invoice</th>
					<th width='70px'>Tanggal Invoice</th>
					<th>Jenis SPM </th>
					<th width='70px'>Jenis SP2D</th>
					<th width='300px'>Description</th>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			//var_dump ($this->data);
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
				} else {
			foreach ($this->data as $value){ 
				echo "<tr>	";
					echo "<td>" . $no++ . "</td>";
					echo "<td>" . $value->get_check_number() . "</td>";
					echo "<td>" . $value->get_creation_date() . "</td>";
					echo "<td>" . $value->get_check_date() . "</td>";
					echo "<td class='ratakanan'>" . $value->get_amount() . "</td>";
					
					echo "<td><a href=".URL."dataSPM/HistorySpm/".$value->get_invoice_num()."/".$value->get_check_number()." target='_blank' '>" . $value->get_invoice_num(). "</a></td>";
					echo "<td>" . $value->get_invoice_date() . "</td>";
					echo "<td>" . $value->get_attribute6() . "</td>";
					echo "<td>" . $value->get_jenis_sp2d() . "</td>";
					echo "<td class='ratakiri'>" . $value->get_description() . "</td>";
					
					
					
				echo "</tr>	";
			} 
			}
			}
			else {
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
		
		$("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
		});
		
		$("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
		});
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });

    }
    
    function cek_upload(){
		var v_invoice = document.getElementById('invoice').value;
		
        var jml = 0;
		if(v_invoice==''){
			$('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
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