<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2><?php echo $this->page_title;?></h2>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <?php
                //----------------------------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
                if (Session::get('role') == ADMIN || Session::get('role') == PKN || Session::get('role') == KANWIL) {
                    if (isset($this->d_kd_kppn) || isset($this->d_nosp2d) ||
                            isset($this->d_spm) || isset($this->d_kdsatker) ||
                            isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)) {
                        
						if (isset($this->d_kd_kppn)) {
						$kdkppn = $this->d_kd_kppn;
                    } else {
						$kdkppn = 'null';
                     }

                    if (isset($this->d_spm)) {
                        $kdspm = $this->d_spm;
                    } else {
                        $kdspm = 'null';
                    }

                    if (isset($this->d_nosp2d)) {
                        $kdnosp2d = $this->d_nosp2d;
                    } else {
                        $kdnosp2d = 'null';
                    }
                    if (isset($this->d_kdsatker)) {
                        $kdsatker = $this->d_kdsatker;
                    } else {
                        $kdsatker = 'null';
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
					
                    }
                }
                if (Session::get('role') == KPPN) {

                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            $kdkppn = $kppn->get_kd_satker();
                        }
                    } else {
                        $kdkppn = Session::get('id_user');
                    }

                                        if (isset($this->d_spm)) {
                        $kdspm = $this->d_spm;
                    } else {
                        $kdspm = 'null';
                    }

                    if (isset($this->d_nosp2d)) {
                        $kdnosp2d = $this->d_nosp2d;
                    } else {
                        $kdnosp2d = 'null';
                    }
                    if (isset($this->d_kdsatker)) {
                        $kdsatker = $this->d_kdsatker;
                    } else {
                        $kdsatker = 'null';
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
					
                    //----------------------------------------------------		
                }
                if (Session::get('role') == SATKER) {

					if (isset($this->d_kd_kppn)) {
						$kdkppn = $this->d_kd_kppn;
                    } else {
						$kdkppn = 'null';
                     }

                    if (isset($this->d_spm)) {
                        $kdspm = $this->d_spm;
                    } else {
                        $kdspm = 'null';
                    }

                    if (isset($this->d_nosp2d)) {
                        $kdnosp2d = $this->d_nosp2d;
                    } else {
                        $kdnosp2d = 'null';
                    }
                    if (isset($this->d_kdsatker)) {
                        $kdsatker = $this->d_kdsatker;
                    } else {
                        $kdsatker = 'null';
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
                


                    <?php
                    //----------------------------------------------------		
                }


                //----------------------------------------------------		
                ?>
								<div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/DataBPNSatker_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdspm; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/DataBPNSatker_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdspm; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>



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
                if (isset($this->d_spm)) {
                    echo "<br>No. SPM : ".$this->d_spm;
                }
                if (isset($this->d_nosp2d)) {
                    echo "       No. SP2D : ".$this->d_nosp2d;
                }
                if (isset($this->d_kdsatker)) {
                    echo "<br>Kode Satker : ".$this->d_kdsatker;
                }
                if (isset($this->d_tgl_awal) and isset($this->d_tgl_akhir)) {
                    echo "       Tanggal : ".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
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
                <th class='mid'>No.</th>
                <th class='mid'>No. SPM<br>Tgl. SPM</th>
                <th class='mid'>No. SP2D/NTPN<br>Tgl. SP2D<br>No. Tagihan</th>
                <th class='mid'>Satker Penerima</th>
                <th class='mid' width='25%'>Uraian SPM</th>
                <th class='mid'>Atas Nama</th>
                <th class='mid'>Setoran</th>
                <th class='mid'>Akun</th>
                <th class='mid'>Jumlah</th>
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
                        echo "<td>" . $value->get_no_spm()."<br>".$value->get_tgl_spm() . "</td>";
                        echo "<td>" . $value->get_no_sp2d()."<br>".$value->get_tgl_sp2d() . "<br>".$value->get_no_tagihan(). "</td>";
                        echo "<td class='align-left'>" . $value->get_satker() . "</td>";
                        echo "<td class='align-left'>" . $value->get_description() . "</td>";
                        echo "<td class='align-left'>" . $value->get_nama2() . "</td>";
                        echo "<td class='align-left'>" . $value->get_deskripsi_akun() . "</td>";
                        echo "<td>" . $value->get_akun() . "</td>";
                        echo "<td class='right'>" . number_format($value->get_nilai_ori()) . "</td>";
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

            <form id="filter-form" method="POST" action="dataBPNSatker" enctype="multipart/form-data">

                <div class="modal-body">

                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class='alert alert-danger' style='display:none;'></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
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
                    
                    <br/>
                    <div id="wspm" class='alert alert-danger' style='display:none;'></div>
                    <label class="isian">No SPM: </label>
                    <input class="form-control" type="text" name="spm" id="spm" value="<?php
                    if (isset($this->d_spm)) {
                        echo $this->d_spm;
                    }
                    ?>">
                    
                    <br/>
                    <div id="wsp2d" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">No SP2D: </label>
                    <input class="form-control" type="number" name="nosp2d" id="nosp2d" size="15" value="<?php if (isset($this->d_nosp2d)) {echo $this->d_nosp2d;}?>">


                    <?php
                    if (Session::get('role') != SATKER) {
                        echo "<br/><div id='wsatker' class='alert alert-danger' style='display:none;'></div>";
                        echo "<label class='isian'>Kode Satker: </label>";
                    }
                    ?>

                    <input class="form-control" type="<?php
                           if (Session::get('role') == SATKER) {
                               echo "hidden";
                           } else {
                               echo "number";
                           }
                           ?>" name="kdsatker" id="kdsatker" size="6" value="<?php
                           if (isset($this->d_kdsatker)) {
                               echo $this->d_kdsatker;
                           }
                           ?>">
                    <br/>
                    <div id="wtgl" class='alert alert-danger' style='display:none;'></div>
                    <label class="isian">Tanggal SPM: </label>
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)) {
                            echo $this->d_tgl_awal;
                        } ?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)) {
                            echo $this->d_tgl_akhir;
                        } ?>">
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
        $('.error').fadeOut(0);
    }

    function hideWarning() {

        $('#spm').keyup(function() {
            if (document.getElementById('spm').value != '') {
                $('#wspm').fadeOut(200);
            }
        });

        $('#nosp2d').keyup(function() {
            if (document.getElementById('nosp2d').value != '') {
                $('#wsp2d').fadeOut(200);
            }
        })

        $('#kdsatker').keyup(function() {
            if (document.getElementById('kdsatker').value != '') {
                $('#wsatker').fadeOut(200);
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

        //document.getElementById('spm').value = document.getElementById('spm').value.replace(/</g, '').replace(/>/g, '');

        var pattern = '^[0-9]+$';
        var v_spm = document.getElementById('spm').value;
        var v_nosp2d = document.getElementById('nosp2d').value;
        var v_kdsatker = document.getElementById('kdsatker').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_spm == '' && v_nosp2d == ''  && v_kdsatker == '' && (v_tglawal == '' || v_tglakhir == '')) {
            $('#wspm').html('Harap isi salah satu parameter');
            $('#wspm').fadeIn();
            jml++;
        }

        if (v_nosp2d != '' && v_nosp2d.length != 15) {
            $('#wsp2d').html('No. SP2D harus 15 digit');
            $('#wsp2d').fadeIn(200);
            jml++;
        }

        if (v_nosp2d != '' && !v_nosp2d.match(pattern)) {
            var wsp2d = 'No SP2D harus dalam bentuk angka!';
            $('#wsp2d').html(wsp2d);
            $('#wsp2d').fadeIn(200);
            jml++;
        }

        if (v_kdsatker != '' && v_kdsatker.length != 6) {
            $('#wsatker').html('Kode Satker harus 6 digit');
            $('#wsatker').fadeIn(200);
            jml++;
        }

        if (v_kdsatker != '' && !v_kdsatker.match(pattern)) {
            var wsatker = 'Kode Satker harus dalam bentuk angka!';
            $('#wsatker').html(wsatker);
            $('#wsatker').fadeIn(200);
            jml++;
        }

        if (v_spm != '' && v_spm.length != 18) {
            $('#wspm').html('No. spm harus 18 digit');
            $('#wspm').fadeIn(200);
            jml++;
        }



        if (jml > 0) {
            return false;
        }
    }

</script>
