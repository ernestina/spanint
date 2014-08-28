<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Penyaluran & Droping Dana SP2D</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <!--pdf-->
                
                <?php
		//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : droping.php  
	if( isset($this->d_nama_kppn) || isset($this->d_bank) ||
		isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)
	
	){
		if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
                $kdkppn = $kppn->get_kd_satker();
		}
	}else{
		$kdkppn = 'null';		
     }
	
    if (isset($this->d_bank)) {
        $kdbank = $this->d_bank;
    } else {
        $kdbank = 'null';
    }

    if (isset($this->d_tgl_awal)) {
        $kdtgl_awal = $this->d_tgl_awal;
    } else {
        $kdtgl_awal = 'null';
    }
    if (isset($this->d_tgl_akhir)) {
        $kdtgl_akhir = $this->d_tgl_akhir;
    } else {
        $kdtgl_akhir = 'null';
    }
    ?>

    <a href="<?php echo URL; ?>PDF/monitoringDroping_PDF/<?php echo $kdbank . "/" .$kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
        <?php
//----------------------------------------------------		

	
	}
	
?>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
            <?php if (isset($this->d_bank)) {
                if($this->d_bank=="MDRI"){
                    echo "<br> Mandiri" ;
                } elseif($this->d_bank=="SEMUA_BANK"){
                    echo "<br> SEMUA_BANK" ;
                }else {
                    echo $this->d_bank;
                    echo "<br>" ;
                }
			}
			?>
			<?php if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
					echo "Periode : ".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
			}
			?>
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
                <th >Tanggal</th>
                <th >Bank</th>
                <th >Total File</th>
                <th >Total Transaksi SP2D</th>
                <th style="text-align:right">Total Nilai</th>
                <th style="text-align:right">Total Droping</th>
                <th style="text-align:right">Selisih</th>
                <th >Keterangan</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
        <?php 
        $no=1;
        if (isset($this->data)){
            if (empty($this->data)){
                echo '<td colspan=9 align="center">Tidak ada data.</td>';
            } else {
                foreach ($this->data as $value){ 
                    echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $value->get_creation_date() . "</td>";
                        echo "<td>" . $value->get_bank() . "</td>";
                        echo "<td>" . number_format($value->get_jumlah_ftp_file_name()) . "</td>";
                        echo "<td>" . number_format($value->get_jumlah_check_number_line_num()) . "</td>";
                        echo "<td align = 'right'>" . number_format($value->get_jumlah_check_amount()) . "</td>";
                        echo "<td align = 'right'><a href=".URL."dataDroping/detailDroping/" . $value->get_id()."/".$value->get_bank()."/".$value->get_creation_date()." target='_blank'>" . number_format($value->get_payment_amount()) . "</a></td>";
                        $selisih = $value->get_payment_amount()-$value->get_jumlah_check_amount();
                        echo "<td align = 'right'>" . number_format($selisih) . "</td>";
                        if ($selisih<0) { echo "<td>Kurang Droping</td>"; } else if ($selisih > 0) {echo "<td>Lebih Droping</td>";} else { echo "<td></td>";};
                    echo "</tr>	";
                }
            } 
        } else {
            echo '<td colspan=9 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
        }
        ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="monitoringDroping" enctype="multipart/form-data">

                <div class="modal-body">

                    <?php  if (Session::get('role')!=SATKER) {
                    echo "<div id='wbank' class='alert alert-danger' style='display:none;'></div>";
                    echo "<label class='isian'>Nama Bank: </label>";
                    echo "<select class='form-control' type='text' name='bank' id='bank'>";
                    ?>  <option value=''>- pilih -</option>
                        <option value='MDRI' <?php if ($this->d_bank==MDRI){echo "selected";}?>>Mandiri</option>
                        <option value='BRI' <?php if ($this->d_bank==BRI){echo "selected";}?>>BRI</option>
                        <option value='BNI' <?php if ($this->d_bank==BNI){echo "selected";}?>>BNI</option>
                        <option value='BTN' <?php if ($this->d_bank==BTN){echo "selected";}?>>BTN</option>
                        <option value='SEMUA_BANK' <?php if ($this->d_bank==SEMUA_BANK){echo "selected";}?>>SEMUA BANK</option>
                    </select>
                    <?php } else {
                        echo "<input class='form-control' type='hidden' name='bank' id='bank' value=''>";
                    } ?>
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal: </label>
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript" charset="utf-8">
    $(function(){
        hideErrorId();
        hideWarning();
        
        $('#datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });

    });
	
    function hideErrorId(){
        $('.alert').fadeOut(0);
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