<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Penyelesaian Retur - PKN</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
	//----------------------------------------------------
	//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
	if(isset($this->d_nama_kppn) || isset($this->d_bank) ||
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
			$kdtgl_awal='null'; 
		}
		if (isset($this->d_tgl_akhir)) {
			$kdtgl_akhir = $this->d_tgl_akhir;
		} else {
			$kdtgl_akhir ='null';
		}
    ?>
            <a href="<?php echo URL; ?>PDF/monitoringReturPkn_PDF/<?php echo $kdkppn. "/" . $kdbank . "/" .$kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>							
        <?php
	
	
	}
	
//----------------------------------------------------		
?>
                
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                Saldo Awal = 0 | Saldo Akhir = 0<br>
                    <?php
                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ") <br>";
                            $kode_kppn = $kppn->get_kd_satker();
                        }
                    }
                    ?>
                    <?php
                    if (isset($this->d_bank)) {
                        echo "Bank : " . $this->d_bank . "<br>";
                    }
                    ?>
                    <?php
                    if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                        echo "Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir . " <br>";
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

<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
            <thead>
                <tr>
                    <th >No.</th>
                    <th >Tgl SP2D</th>
                    <th >No. SP2D</th>
                    <th >Tgl SP2D-R</th>
                    <th >No SP2D-R</th>
                    <th >Debet</th>
                    <th >Kredit</th>
                    <th >Saldo</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    } else {
                        $saldo = 0;
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_statement_date() . "</td>";
                            echo "<td>" . $value->get_receipt_number() . "</td>";
                            echo "<td> " . $value->get_tgsp2d_pengganti() . " </td>";
                            echo "<td> " . $value->get_nosp2d_pengganti() . "</td>";
                            echo "<td align='right'>" . number_format($value->get_nilai_sp2d_pengganti()) . "</td>";
                            echo "<td align='right'> " . number_format($value->get_amount()) . " </td>";
                            echo "<td align='right'>" . number_format($saldo+=($value->get_amount() - $value->get_nilai_sp2d_pengganti())) . "</td>";
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
            
            <form id="filter-form" method="POST" action="monitoringReturPkn" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            <option value=''>- Semua KPPN -</option>
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

                    <div id="wbank" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Bank: </label>
                    <select class="form-control" type="text" name="bank" id="bank">
                        <option value=''>- pilih -</option>
                        <option value='MDRI' <?php if ($this->d_bank == MDRI) {
    echo "selected";
} ?>>Mandiri</option>
                        <option value='BRI' <?php if ($this->d_bank == BRI) {
    echo "selected";
} ?>>BRI</option>
                        <option value='BNI' <?php if ($this->d_bank == BNI) {
    echo "selected";
} ?>>BNI</option>
                        <option value='BTN' <?php if ($this->d_bank == BTN) {
    echo "selected";
} ?>>BTN</option>
                        <option value='SEMUA' <?php if ($this->d_bank == SEMUA) {
    echo "selected";
} ?>>SEMUA BANK</option>
                    </select>

                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal Retur: </label>
                    
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
    $(function() {
        hideErrorId();
        hideWarning();
    });

    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {

        $('#bank').change(function() {
            if (document.getElementById('bank').value != '') {
                $('#wbank').fadeOut(200);
            }
        });

        $('#tgl_awal').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

        $('#tgl_akhir').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_bank = document.getElementById('bank').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_bank == '' && v_tglawal == '' && v_tglakhir == '') {
            $('#wbank').html('Harap isi salah satu parameter');
            $('#wbank').fadeIn();
            $('#wtgl').html('Harap isi salah satu parameter');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }

</script>