<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Informasi DIPA Satker</h2>
            </div>
			 <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
            <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
			if (isset($this->d_kd_satker)) {
                
				$kdsatker = $this->d_kd_satker();
                
            }else{
				$kdsatker ='null';
			} 
			if (isset($this->d_nm_satker)) {
                
				$kdnmsatker = $this->d_nm_satker();
                
            }else{
				$kdnmsatker ='null';
			} 
			if (isset($this->eselon1)) {
                
				$kdeselon1 = $this->eselon1();
                
            }else{
				$kdeselon1 ='null';
			} 
			if (isset($this->d_kd_revisi)) {
                
				$kdkdrevisi = $this->d_kd_revisi();
                
            }else{
				$kdkdrevisi ='null';
			} 
			
			
			?>
            <a href="<?php echo URL; ?>PDF/nmsatker_BAES1_PDF/<?php echo $kdsatker . "/" . $kdnmsatker. "/" . $kdeselon1 . "/" . $kdkdrevisi; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
			</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
			<a href="<?php echo URL; ?>PDF/nmsatker_BAES1_PDF/<?php echo $kdsatker . "/" . $kdnmsatker. "/" . $kdeselon1 . "/" . $kdkdrevisi; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
			<?php

			//----------------------------------------------------		
			?>
            </div>
           
        </div>

        <div class="row" style="padding-top: 10px">

            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                } else {
                    echo Session::get('user');
                }
                if (isset($this->d_kd_revisi)) {
                    if ($this->d_kd_revisi == '0') {
                        echo "<br>Status Revisi : Belum Revisi";
                    } else if ($this->d_kd_revisi == '1') {
                        echo "<br>Status Revisi : Sudah Revisi";
                    }
                }
                if (isset($this->d_kd_satker)) {
                    echo "<br>Satker : " . $this->d_kd_satker;
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
    <table width="100%" class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th class="align-center">No.</th>
                <th class='align-center'>Kode Satker</th>
                <th>Nama Satker</th>
				<th>Eselon 1</th>
                <th class="align-center">Tanggal Posting Revisi</th>
                <th class="align-center">No. Revisi Terakhir</th>
                <!--th>KPPN</th-->
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=5 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td class='align-center'>" . $no++ . "</td>";
                        //echo "<td>" . $value->get_kppn() . "</td>";
                        echo "<td class='align-center'><a href=" . URL . "dataDIPA/RevisiDipa/" . $value->get_kdsatker() . " >" . $value->get_kdsatker() . "</a></td>";
                        //echo "<td>" . $value->get_kdsatker() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_nmsatker() . "</td>";
						echo "<td class='ratakiri'>" . $value->get_nmes1() . "</td>";
                        echo "<td class='align-center'>" . $value->get_tgl_rev() . "</td>";
                        echo "<td class='align-center'>" . $value->get_rev() . "</td>";
                        //echo "<td class='ratakanan'>" . $value->get_total_sp2d() . "</td>";
                        echo "</tr>	";
                    }
                }
            } else {
                echo '<td colspan=5 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
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

            <form id="filter-form" method="POST" action="nmsatker" enctype="multipart/form-data">

                <div class="modal-body">

<?php if (isset($this->data)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Eselon 1: </label>
                        <select class="form-control" type="text" name="eselon1" id="eselon1">
                            <option value='' selected>- pilih -</option>
    <?php
    //foreach ($this->data1 as $value1) {        
           // echo "<option value='" . $value1->get_nmba() . "' selected>" . $value1->get_nmba() . " | " . $value1->get_nmes1() . "</option>";       
    //}
	
			
    ?>
	
	<?php foreach ($this->data1 as $value1) { ?>

                                <?php if ($this->eselon1 == $value1->get_nmba()) { ?>

                                    <option value="<?php echo $value1->get_nmba(); ?>" selected><?php echo $value1->get_nmba(); ?> | <?php echo $value1->get_nmes1(); ?></option>

                                <?php } else { ?>

                                    <option value="<?php echo $value1->get_nmba(); ?>"><?php echo $value1->get_nmba(); ?> | <?php echo $value1->get_nmes1(); ?></option>

                                <?php } ?>

                            <?php } ?>
                        </select>
<?php } ?>

                    

                    </select -->
                    <br/>
                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)) {
    echo $this->kdsatker;
} ?>">
                    <br/>
                    <label class="isian">Nama Satker: </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker" value="<?php if (isset($this->nmsatker)) {
    echo $this->nmsatker;
} ?>">


                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">


                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function cek_upload() {
        if ($('#kdsatker').val().length > 0) && ($('#kdsatker').val().length != 6)  {
            $('#winvoice').html('Kode Satker harus 6 digit.');
            $('#winvoice').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }

    function hideErrorId() {
        $('.error').fadeOut(0);
    }

    function hideWarning() {
        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
            }
        });

    }

</script>