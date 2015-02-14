<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring SP2D Gaji Terindikasi Salah Tanggal</h2>
            </div>
            <?php if (isset($this->kppn_list)){ ?>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
            <?php }?>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
    
			if (isset($this->d_nama_kppn)) {
				foreach ($this->d_nama_kppn as $kppn) {
						$kdkppn = $kppn->get_kd_satker();
					  }
			} else {
				$kdkppn = Session::get('id_user');
			}
			?>
		<a href="<?php echo URL; ?>PDF/sp2dSalahTanggal_PDF/<?php echo $kdkppn; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
		</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
		<a href="<?php echo URL; ?>PDF/sp2dSalahTanggal_PDF/<?php echo $kdkppn; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
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
                    <th>No.</th>
                    <th>Kode Satker</th>
                    <th>No. Invoice</th>
                    <th>No. SP2D</th>
                    <th>Tanggal SP2D</th>
                    <th>Tanggal Proses SP2D</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_kdsatker() . "</td>";
                            echo "<td>" . $value->get_invoice_num() . "</td>";
                            echo "<td>" . $value->get_check_number() . "</td>";
                            echo "<td>" . $value->get_payment_date() . "</td>";
                            echo "<td>" . $value->get_creation_date() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
                            echo "</tr>	";
                        }
                    }
                } else {
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
            <form id="filter-form" method="POST" action="sp2dSalahTanggal" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class='form-control' type="text" name="kdkppn" id="kdkppn">
                            <?php
                            foreach ($this->kppn_list as $value1) {
                                if ($kode_kppn == $value1->get_kd_d_kppn()) {
                                    echo "<option value='" . $value1->get_kd_d_kppn() . "' selected>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
                                } else {
                                    echo "<option value='" . $value1->get_kd_d_kppn() . "'>" . $value1->get_kd_d_kppn() . " | " . $value1->get_nama_user() . "</option>";
                                }
                            }
                            ?>
                        </select>
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

    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#kdkppn').change(function() {
            if (document.getElementById('kdkppn').value != '') {
                $('#wkdkppn').fadeOut(200);
            }
        })
    }

    function cek_upload() {
        var v_kdkppn = document.getElementById('kdkppn').value;

        var jml = 0;
        if (v_kdkppn == '') {
            $('#wkdkppn').html('Harap pilih kppn');
            $('#wkdkppn').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>