<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring SP2D Gaji Terindikasi Dobel</h2>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
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

			if (isset($this->d_bank)) {
				$kdbulan = $this->d_bank;
				
			}else{
				$kdbulan='null';
			}
			?>
        <div class="btn-group-sm">
            <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
            </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo URL; ?>PDF/sp2dGajiDobel_PDF/<?php echo $kdbulan . "/" . $kdkppn; ?>/PDF">PDF</a></li>
                    <li><a href="<?php echo URL; ?>PDF/sp2dGajiDobel_PDF/<?php echo $kdbulan . "/" . $kdkppn; ?>/XLS">EXCEL</a></li>
                  </ul>
        </div>
			
			<?php
    //----------------------------------------------------		
    ?>
                
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
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
                    <?php
                    if (isset($this->d_bank)) {
                        if ($this->d_bank == 13) {
                            echo "<br> Semua Bank";
                        } else {
                            echo "<br>" . $this->d_bank;
                        }
                    }
                    ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) : "; 
                            echo "<br>" . $last_update->get_last_update() . " WIB";
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
            
            <form id="filter-form" method="POST" action="sp2dGajiDobel" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
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
<?php } ?>

                    <div id="wbulan" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Bulan: </label>
                    <select class='form-control' type="text" name="bulan" id="bulan">
                        <option value=''>- pilih -</option>
                        <option value='JANUARI' <?php if ($this->d_bank == JANUARI) {
    echo "selected";
} ?>>Januari</option>
                        <option value='FEBRUARI' <?php if ($this->d_bank == FEBRUARI) {
    echo "selected";
} ?>>Pebruari</option>
                        <option value='MARET' <?php if ($this->d_bank == MARET) {
    echo "selected";
} ?>>Maret</option>
                        <option value='APRIL' <?php if ($this->d_bank == APRIL) {
    echo "selected";
} ?>>April</option>
                        <option value='MEI' <?php if ($this->d_bank == MEI) {
    echo "selected";
} ?>>Mei</option>
                        <option value='JUNI' <?php if ($this->d_bank == JUNI) {
    echo "selected";
} ?>>Juni</option>
                        <option value='JULI' <?php if ($this->d_bank == JULI) {
    echo "selected";
} ?>>Juli</option>
                        <option value='AGUSTUS' <?php if ($this->d_bank == AGUSTUS) {
        echo "selected";
    } ?>>Agustus</option>
                        <option value='SEPTEMBER' <?php if ($this->d_bank == SEPTEMBER) {
        echo "selected";
    } ?>>September</option>
                        <option value='OKTOBER' <?php if ($this->d_bank == OKTOBER) {
        echo "selected";
    } ?>>Oktober</option>
                        <option value='NOVEMBER' <?php if ($this->d_bank == NOVEMBER) {
        echo "selected";
    } ?>>Nopember</option>
                        <option value='DESEMBER' <?php if ($this->d_bank == DESEMBER) {
        echo "selected";
    } ?>>Desember</option>
                        <option value='13' <?php if ($this->d_bank == 13) {
        echo "selected";
    } ?>>Semua Bulan</option>
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
    $(function() {
        hideErrorId();
        hideWarning();
    });

    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#bulan').keyup(function() {
            if (document.getElementById('bulan').value != '') {
                $('#bulan').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_bulan = document.getElementById('bulan').value;
        var jml = 0;

        if (v_bulan == '') {
            $('#wbulan').html('Harap pilih bulan');
            $('#wbulan').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }

</script>