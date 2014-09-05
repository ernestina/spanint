<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Rekap SP2D atas SPM</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
			//----------------------------------------------------
			//Development history
			//Revisi : 0
			//Kegiatan :1.mencetak hasil filter ke dalam pdf
			//File yang diubah : Rekap.php
			//Dibuat oleh : Rifan Abdul Rachman
			//Tanggal dibuat : 18-07-2014
			//----------------------------------------------------
			
			if( isset($this->d_bank) || isset($this->jendok) || isset($this->d_tgl_awal) ||
			isset($this->d_tgl_akhir)
			){
							$kdkppn=Session::get('id_user');
			
			if (isset($this->d_bank)) {
				$kdbank=$this->d_bank;
			}else{
				$kdbank='null';
			}
			
			if (isset($this->jendok)) {
				$jenis_spm=$this->jendok;
			}else{
				$jenis_spm='null';
			}
			
			if (isset($this->d_tgl_awal)) {
				$kdtgl_awal=$this->d_tgl_awal;
			}else{
				$kdtgl_awal='null';
			}
			if (isset($this->d_tgl_akhir)) {
				$kdtgl_akhir=$this->d_tgl_akhir;
			}else{
				$kdtgl_akhir='null';
			}
			
				?>
	<a href="<?php echo URL; ?>PDF/detailrekapsp2d1_PDF/<?php echo $jenis_spm."/". $kdkppn."/". $kdbank."/".$kdtgl_awal."/".$kdtgl_akhir;?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

<?php			
			}		
		?>		
				
		<?php
			//----------------------------------------------------		
		?>
                
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <!-- button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button -->
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php 
                    $nmsatker='';
                    foreach ($this->data as $value) 
                    {$jenis_spm=$value->get_attribute6() ;}
                     echo $jenis_spm;

                    //{$nmsatker=$value->get_nmsatker();} 
                    //echo $nmsatker;
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
            </tr>
        </thead>
        <tbody class='ratatengah'>
        <?php 
        $no=1;
        //var_dump ($this->data);
        if (isset($this->data)){
            if (empty($this->data)){
                echo '<td colspan=12 align="center">Tidak ada data.</td>';
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
            echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="sp2dRekap" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                    <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode KPPN: </label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                        <?php foreach ($this->kppn_list as $value1){ 
                        if ($kode_kppn==$value1->get_kd_d_kppn()){echo "<option value='".$value1->get_kd_d_kppn()."' selected>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";} 
                        else {echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";}

                        } ?>
                        </select>
                    </div>
                    <?php } ?>
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

<!-- Skrip -->
<script type="text/javascript" charset="utf-8">
    $(function(){
        hideErrorId();
        hideWarning();
    });
    
    function hideErrorId(){
        $('.alert').fadeOut(0);
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
</script>
