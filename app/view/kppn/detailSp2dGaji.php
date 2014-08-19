<div id="top">
	<div id="header">
        <h2>Detail SP2D Gaji <?php echo $this->d_bank." ".Tanggal::bulan_indo($this->d_bulan);?><br>
		<?php if (isset($this->d_nama_kppn)) {
			foreach($this->d_nama_kppn as $kppn){
				echo "<br>".$kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
				$kode_kppn=$kppn->get_kd_satker();
			}
		}?>
		</h2>
    </div>
	
<?php
// untuk menampilkan last_update
if (isset($this->last_update)){
	foreach ($this->last_update as $last_update){ 
		echo "<td>Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB </td>";
	}
}
?>
<?php
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : detailSp2dGaji.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------
				/*
 				$kdkppn='null';				
				$kdbank='null';
				$kdtgl_awal='null';
				$kdtgl_akhir='null'; 
 */		


				$kdkppn=Session::get('id_user');
			
			if (isset($this->d_bank)) {
				$kdbank=$this->d_bank;
			}
			if (isset($this->d_bulan)) {
				$kdbulan=$this->d_bulan;
			}
			
						
				?>
			 
				<a href="<?php echo URL; ?>DataKppn/detailSp2dGaji_PDF/<?php echo $kdbank."/".$kdbulan."/".$kdkppn; ?>" class="modal">PDF</a>
							
		<?php
			//----------------------------------------------------		
		?>

<div id="fitur">
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th width='100px'>Tgl Selesai SP2D</th>
					<th>Tgl SP2D</th>
					<th>No. SP2D</th>
					<!--th>Status</th-->
					
					<!--th>No. Transaksi</th-->
					<th>No. Invoice</th>
					<th>Jumlah Rp</th>
					<th>Nama Bank</th>
					<th width='400px'>Deskripsi</th>
					
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
							echo "<td>" . $value->get_creation_date() . "</td>";
							echo "<td>" . $value->get_payment_date() . "</td>";
							echo "<td>" . $value->get_check_number() . "</td>";
							//echo "<td>" . $value->get_return_code() . "</td>";
							
							//echo "<td>" . $value->get_check_number_line_num() . "</td>";
							echo "<td>" . $value->get_invoice_num() . "</td>";
							echo "<td class='ratakanan'>" . $value->get_check_amount() . "</td>";
							echo "<td>" . $value->get_bank_account_name() . "</td>";
							echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
						echo "</tr>	";
					}
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
		
		$("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
		});
		
		$("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
		});
    });
	
    function hideErrorId(){
        $('.error').fadeOut(0);
    }

    function hideWarning(){
		
        $('#nosp2d').keyup(function() {
            if (document.getElementById('nosp2d').value != '') {
                $('#wsp2d').fadeOut(200);
            }
        })
		
		$('#barsp2d').keyup(function(){
            if(document.getElementById('barsp2d').value !=''){
                $('#wbarsp2d').fadeOut(200);
            }
        });
		
		$('#kdsatker').keyup(function(){
            if(document.getElementById('kdsatker').value !=''){
                $('#wsatker').fadeOut(200);
            }
        });
		
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });
		
		$('#bank').change(function(){
            if(document.getElementById('bank').value !=''){
                $('#wbank').fadeOut(200);
            }
        });
		
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
		
		$('#fxml').keyup(function(){
            if(document.getElementById('fxml').value !=''){
                $('#wfxml').fadeOut(200);
            }
        });

    }
	
    function cek_upload(){
		var pattern = '^[0-9]+$';
		var v_nosp2d = document.getElementById('nosp2d').value;
		var v_barsp2d = document.getElementById('barsp2d').value;
		var v_kdsatker = document.getElementById('kdsatker').value;
		var v_invoice = document.getElementById('invoice').value;
		var v_bank = document.getElementById('bank').value;
		var v_tglawal = document.getElementById('datepicker').value;
		var v_tglakhir = document.getElementById('datepicker1').value;
		var v_fxml = document.getElementById('fxml').value;
		
        var jml = 0;
        if(v_nosp2d=='' && v_barsp2d=='' && v_kdsatker==''&& v_invoice=='' && v_bank=='' && v_tglawal=='' && v_tglakhir=='' && v_fxml==''){
            $('#wsp2d').html('Harap isi salah satu parameter');
            $('#wsp2d').fadeIn();
			$('#wbarsp2d').html('Harap isi salah satu parameter');
            $('#wbarsp2d').fadeIn();
			$('#wsatker').html('Harap isi salah satu parameter');
            $('#wsatker').fadeIn();
			$('#winvoice').html('Harap isi salah satu parameter');
            $('#winvoice').fadeIn();
			$('#wbank').html('Harap isi salah satu parameter');
            $('#wbank').fadeIn();
			$('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
			$('#wfxml').html('Harap isi salah satu parameter');
            $('#wfxml').fadeIn();
            jml++;
        }
		
		if(v_nosp2d !='' && v_nosp2d.length != 15 ){
            $('#wsp2d').html('No. SP2D harus 15 digit');
            $('#wsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_nosp2d !='' && !v_nosp2d.match(pattern)){
            var wsp2d = 'No SP2D harus dalam bentuk angka!';
            $('#wsp2d').html(wsp2d);
            $('#wsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_barsp2d !='' && v_barsp2d.length != 21 ){
            $('#wbarsp2d').html('No. Transaksi harus 21 digit');
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_barsp2d !='' && !v_barsp2d.match(pattern)){
            var wbarsp2d = 'No Transaksi harus dalam bentuk angka!';
            $('#wbarsp2d').html(wbarsp2d);
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }
		
		if(v_kdsatker !='' && v_kdsatker.length != 6 ){
            $('#wsatker').html('Kode Satker harus 6 digit');
            $('#wsatker').fadeIn(200);
            jml++;
        }
		
		if(v_kdsatker !='' && !v_kdsatker.match(pattern)){
            var wsatker = 'No Transaksi harus dalam bentuk angka!';
            $('#wsatker').html(wbarsp2d);
            $('#wsatker').fadeIn(200);
            jml++;
        }
		
		if(v_invoice !='' && v_invoice.length != 18 ){
            $('#winvoice').html('No. invoice harus 18 digit');
            $('#winvoice').fadeIn(200);
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