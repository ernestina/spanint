<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            <?php
			
			if (isset($this->data)) {
				foreach ($this->data as $value) {
					$ntb = $value->get_file_name();
				}
			}
			?>
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail NTPN Terindikasi Ganda  <?php //echo Tanggal::bulan_indo($this->d_bulan); ?></h2>
				
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                 <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
			    
			if($this->ntpn){
				$kdntpn=$this->ntpn;
			}else{
				foreach ($this->data as $value) {
					$kdntpn =$value->get_ntpn();
				}
			}
			
			?>
			<a href="<?php echo URL; ?>PDF/DetailNTPNGanda_PDF/<?php echo $kdntpn; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
			</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
			<a href="<?php echo URL; ?>PDF/DetailNTPNGanda_PDF/<?php echo $kdntpn; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
			<?php
			//---------------------------------				
                
			?>
  
  
            </div>
           
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php
                // $nmsatker = '';
                // foreach ($this->data as $value) {
                    // $nmsatker = $value->get_nmsatker();
                // }
                // echo $nmsatker;
                // ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server)<br/>" . $last_update->get_last_update() . " WIB";
                        }
                    }
                ?>
            </div>
            
        </div>
        
    </div>
</div>

<div id="table-container" class="wrapper">
    <table class="footable">
   
        <!--baris pertama-->
        <thead>
            <tr>
                <th class='mid'>No.</th>
				<th class='ratatengah'>NTPN</th>
				<th class='ratatengah'>Satker</th>
				<th class='ratatengah'>KPPN</th>
                <th class='ratatengah'>Akun</th>
				<th class='ratatengah'>Nama File</th>
				<th class='ratatengah'>Status</th>
				<th class='ratatengah'>Norek Persepsi</th>
				<th class='ratatengah'>Nomor Batch</th>
				<th class='ratakanan'>Nilai</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data NTPN ganda untuk bulan ini.</div>";
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td class='mid'>" . $no++ . "</td>";
						echo "<td>" . $value->get_ntpn() . "</td>";
						echo "<td>" . $value->get_segment1() . "</td>";
						echo "<td>" . $value->get_segment2() . "</td>";
						echo "<td>" . $value->get_segment3() . "</td>";
						echo "<td>" . $value->get_file_name() . "</td>";
						echo "<td>" . $value->get_status() . "</td>";
						echo "<td>" . $value->get_bank_account_num() . "</td>";
						echo "<td>" . $value->get_gr_batch_num() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_amount()) . "</td>";
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
    
<!--div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12" style="text-align: right">
                
                <input class='btn btn-default' style='width:100%' id='submit' class='sukses' type='submit' name='submit_file2' value='Unduh' onClick=''>
                
            </div>
            
        </div>
    </div>
</div-->
    
    


<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();
    });
    function toggle1(source) {
        checkboxes = document.getElementsByName('checkbox1[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
	function toggle2(source) {
        checkboxes = document.getElementsByName('checkbox2[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
	
	
	
    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_invoice = document.getElementById('invoice').value;

        var jml = 0;
        if (v_invoice == '') {
            $('#winvoice').html('Harap isi no invoice');
            $('#winvoice').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }

</script>