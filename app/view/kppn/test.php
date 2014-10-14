<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring PFK Bulan <?php echo ($this->d_bulan); ?></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
	if( isset($this->d_bulan) || isset($this->d_kd_kppn)	
	){
		if (isset($this->d_bulan)) {
			$kdbulan = $this->d_bulan;
		}else{
			$kdbulan =null;
		}
    if (isset($this->d_kd_kppn)) {
			$kdkppn = $this->d_kd_kppn;
		}else{
			$kdkppn=Session::get('id_user');
		}
	
    ?>
    <a href="<?php echo URL; ?>PDF/GR_PFK_PDF/<?php echo $kdbulan. "/" . $kdkppn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
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
                <?php
            if (isset($this->d_nama_kppn)) {
                foreach ($this->d_nama_kppn as $kppn) {
                    echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                    $kode_kppn = $kppn->get_kd_satker();
                }
            } else {
                echo "SEMUA KPPN";
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
            <th>No.</th>
            <th>Akun</th>
            <th>Uraian Akun</th>
            <th>Potongan SPM</th>
            <th>Setoran MPN</th>
            <th>Total</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                $tot_pot_spm = 0;
                $tot_set_mpn = 0;
                $tot_total = 0;
                //var_dump ($this->data);
                if ($this->d_bulan == 'januari') {
                    $bulan = 'january';
                }
                if ($this->d_bulan == 'februari') {
                    $bulan = 'february';
                }
                if ($this->d_bulan == 'maret') {
                    $bulan = 'march';
                }
                if ($this->d_bulan == 'april') {
                    $bulan = 'april';
                }
                if ($this->d_bulan == 'mei') {
                    $bulan = 'may';
                }
                if ($this->d_bulan == 'juni') {
                    $bulan = 'june';
                }
                if ($this->d_bulan == 'juli') {
                    $bulan = 'july';
                }
                if ($this->d_bulan == 'agustus') {
                    $bulan = 'august';
                }
                if ($this->d_bulan == 'september') {
                    $bulan = 'september';
                }
                if ($this->d_bulan == 'oktober') {
                    $bulan = 'october';
                }
                if ($this->d_bulan == 'november') {
                    $bulan = 'november';
                }
                if ($this->d_bulan == 'desember') {
                    $bulan = 'december';
                }
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            //echo "<td>" . $value->get_akun() . "</td>";
                            echo "<td><a href=" . URL . "dataGR/GR_PFK_DETAIL/" . $value->get_akun() . "/" . $bulan . "/" . $_POST['kdkppn'] . ">" . $value->get_akun() . "</a></td>";
                            echo "<td align='left' >" . $value->get_uraian_akun() . "</td>";
                            echo "<td align='right'>" . number_format($value->get_potongan_spm()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_setoran_mpn()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_total()) . "</td>";
                            echo "</tr>	";
                            $tot_pot_spm = $tot_pot_spm + $value->get_potongan_spm();
                            $tot_set_mpn = $tot_set_mpn + $value->get_setoran_mpn();
                            $tot_total = $tot_total + $value->get_total();
                        }
                        echo "<tr>	";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td><b>GRAND TOTAL</td>";
                        echo "<td align='right'><b>" . number_format($tot_pot_spm) . "</td>";
                        echo "<td align='right'><b>" . number_format($tot_set_mpn) . "</td>";
                        echo "<td align='right'><b>" . number_format($tot_total) . "</td>";
                        echo "</tr>	";
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
            
            <form id="filter-form" method="POST" action="GR_PFK" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn" >
                            <option value='SEMUA KPPN'>Semua KPPN</option>
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

                    <br>    
                    <label class="isian">Pilih bulan: </label>
                    <select type="text" class="form-control" name="bulan" id="bulan">
                        <option value='januari' <?php if ($this->d_bulan == 'januari') {
    echo "selected";
} ?> >Januari</option>
                        <option value='februari' <?php if ($this->d_bulan == 'februari') {
    echo "selected";
} ?> >Februari</option>
                        <option value='maret' <?php if ($this->d_bulan == 'maret') {
    echo "selected";
} ?> >Maret</option>
                        <option value='april' <?php if ($this->d_bulan == 'april') {
    echo "selected";
} ?> >April</option>
                        <option value='mei' <?php if ($this->d_bulan == 'mei') {
    echo "selected";
} ?> >Mei</option>
                        <option value='juni' <?php if ($this->d_bulan == 'juni') {
    echo "selected";
} ?> >Juni</option>
                        <option value='juli' <?php if ($this->d_bulan == 'juli') {
    echo "selected";
} ?> >Juli</option>
                        <option value='agustus' <?php if ($this->d_bulan == 'agustus') {
    echo "selected";
} ?> >Agustus</option>
                        <option value='september' <?php if ($this->d_bulan == 'september') {
    echo "selected";
} ?> >September</option>
                        <option value='oktober' <?php if ($this->d_bulan == 'oktober') {
    echo "selected";
} ?> >Oktober</option>
                        <option value='november' <?php if ($this->d_bulan == 'november') {
    echo "selected";
} ?> >November</option>
                        <option value='desember' <?php if ($this->d_bulan == 'desember') {
                    echo "selected";
                } ?> >Desember</option>
                        <!--option value='Validated' <?php //if ($this->status==Validated){echo "selected";}?>>Validated</option>
                        <option value='Error' <?php //if ($this->status==Error){echo "selected";}?>>Error</option-->
                    </select>
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript" charset="utf-8">
    
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#status').change(function() {
            if (document.getElementById('status').value != '') {
                $('#wstatus').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_status = document.getElementById('status').value;

        var jml = 0;
        if (v_status == '') {
            $('#wstatus').html('Harap pilih');
            $('#wstatus').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }
</script>