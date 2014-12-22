<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail Penyaluran & Droping Dana SP2D</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
<?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : dropingDetail.php  

if(isset($this->data)){
	if($this->d_id){
		$kdid=$this->d_id;
	}		
	if($this->d_bank){
		$kdbank=$this->d_bank;
	}
	if (isset($this->d_tanggal)) {
		$kdtanggal=$this->d_tanggal;
	}
    ?>	
     

            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <!--button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button-->
            <a href="<?php echo URL; ?>PDF/detailDroping_PDF/<?php echo $kdid . "/" .$kdbank . "/" . $kdtanggal; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
     
   <?php
//----------------------------------------------------			
	}
?>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php if (isset($this->d_bank)) {
					if($this->d_bank=="MDRI"){
						echo "Bank : Mandiri <br>" ;
					} elseif($this->d_bank=="SEMUA"){
						echo "SEMUA <br>" ;
					}else {
						echo "Bank : " . $this->d_bank;
                        echo "<br>";
					}
                }
                ?>
                <?php if (isset($this->d_tanggal)) {
                        echo "Tanggal : ".$this->d_tanggal;
                }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) : " . $last_update->get_last_update() . " WIB";
                        }
                    }
                ?>
            </div>
            
        </div>
        
    </div>
</div>

<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
			<thead>
                <tr>
					<th class='mid'>No.</th>
					<th >Tanggal - Jam</th>
					<th >Mata Uang</th>
					<th >Nomor Transaksi BAT</th>
					<th >Nilai Transaksi</th>
					<th >Nama Rekening</th>
                </tr>
			</thead>
			<tbody class='ratatengah'>
			<?php 
			$no=1;
			if (isset($this->data)){
				if (empty($this->data)){
					echo '<td colspan=12 align="center">Tidak ada data.</td>';
				} else {
					$total = 0;
					foreach ($this->data as $value){ 
						echo "<tr>	";
							echo "<td>" . $no++ . "</td>";
							echo "<td>" . $value->get_creation_date() . "</td>";
							echo "<td>" . $value->get_payment_currency_code() . "</td>";
							echo "<td>" . $value->get_bank_trxn_number() . "</td>";
							echo "<td align = 'right'>" . number_format($value->get_payment_amount()) . "</td>";
							$total+=$value->get_payment_amount();
							echo "<td>" . $value->get_attribute4() . "</td>";
						echo "</tr>	";
					}
				} 
			} else {
				echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
			}
			?>
			<td colspan="4"><b>TOTAL</b></td>
			<td align = 'right'><b><?php echo number_format($total) ?></b>    </td>
            <td>&nbsp;</td>
        </tbody>
    </table>
</div>

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
		
		$('#bank').change(function(){
            if(document.getElementById('bank').value !=''){
                $('#wbank').fadeOut(200);
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
		var pattern = '^[0-9]+$';
		var v_bank = document.getElementById('bank').value;
		var v_tglawal = document.getElementById('tgl_awal').value;
		var v_tglakhir = document.getElementById('tgl_akhir').value;
		
        var jml = 0;
        if(v_bank=='' && v_tglawal=='' && v_tglakhir==''){
			$('#wbank').html('Harap isi salah satu parameter');
            $('#wbank').fadeIn();
			$('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
            jml++;
        }
		
        if(jml>0){
            return false;
        } 
    }
</script>