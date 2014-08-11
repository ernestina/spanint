<div id="top">
	<div id="header">
        <h2>Daftar Locked Akun Dalam Proses Revisi  
		<?php if (isset($this->d_nama_kppn)) {
				foreach($this->d_nama_kppn as $kppn){
					echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
					$kode_kppn=$kppn->get_kd_satker();
				}
			}
		
		else{ echo Session::get('user');}
		
		
			if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
			echo "<br>".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
			}
			
		 ?>
		</h2>
    </div>



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
		<table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
			<thead>
					<th>No.</th>
					<th>Kode Satker</th>
					<th>KPPN</th>
					<th>Dana</th>
					<th>Program</th>
					<th>Output</th>
					<th>Akun</th>
					<th>Revisi Ke</th>
					<th>Ususlan Revisi</th>
					<th>Tanggal</th>
					
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			$total;
			
			//var_dump ($this->data);
			if (isset($this->data)){
				if (empty($this->data)){
					echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada akun yang di lock.</div>";
				} else {
					foreach ($this->data as $value){ 
					echo "<tr>	";
						echo "<td>" . $no++ . "</td>";
						echo "<td>" . $value->get_satker_code() . "</td>";
						echo "<td>" . $value->get_kppn() . "</td>";
						echo "<td>" . $value->get_dana() . "</td>";
						echo "<td>" . $value->get_program() . "</td>";
						echo "<td>" . $value->get_output() . "</td>";
						echo "<td>" . $value->get_akun() . "</td>";
						echo "<td>" . $value->get_revision_no() . "</td>";
						echo "<td align='right'>" . number_format($value->get_usulan_revisi()) . "</td>";
						echo "<td>" . $value->get_last_update_date(). "</td>";
						
						
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
		$('#invoice').keyup(function(){
            if(document.getElementById('invoice').value !=''){
                $('#winvoice').fadeOut(200);
            }
        });
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
		var v_invoice = document.getElementById('invoice').value;
		var v_tglawal = document.getElementById('tgl_awal').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		
        var jml = 0;
        if(v_invoice=='' && v_tglawal=='' && v_tglakhir==''){
            $('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
			$('#wtgl').html('Harap isi tanggal');
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
			"table": document.getElementById('example'),
			"datatable": oTable
		} );
	} );
</script>