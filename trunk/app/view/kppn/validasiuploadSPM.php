<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Daftar Penolakan PMRT</h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <!--pdf-->
                <?php
                //----------------------------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
                if (Session::get('role') == KANWIL) {
                    IF (isset($this->d_nama_kppn) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)) {
                        if (isset($this->d_nama_kppn)) {
                            foreach ($this->d_nama_kppn as $kppn) {
                                $kdkppn = $kppn->get_kd_satker();
                            }
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

                        $filename = 'null';
                        $kdsatker = 'null';
                        ?>

                        <a href="<?php echo URL; ?>PDF/ValidasiSpm_PDF/<?php echo $kdkppn . "/" . $filename . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
        <?php
    }
}
if (Session::get('role') == ADMIN) {
    IF (isset($this->d_nama_kppn) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)) {
        if (isset($this->d_nama_kppn)) {
            foreach ($this->d_nama_kppn as $kppn) {
                $kdkppn = $kppn->get_kd_satker();
            }
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

        $filename = 'null';
        $kdsatker = 'null';
        ?>

                        <a href="<?php echo URL; ?>PDF/ValidasiSpm_PDF/<?php echo $kdkppn . "/" . $filename . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                        <?php
                    }
                }
                if (Session::get('role') == SATKER) {
                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            $kdkppn = $kppn->get_kd_satker();
                        }
                    } else {
                        foreach ($this->data as $value) {
                            $filename1 = $value->get_file_name();
                            $kdsatker = $value->get_satker_code();
                            $kdkppn = substr($filename1, 4, 3);
                        }
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

                    $filename = 'null';
                    $kdsatker = 'null';
                    ?>

                    <a href="<?php echo URL; ?>PDF/ValidasiSpm_PDF/<?php echo $kdkppn . "/" . $filename . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                    <?php
                }
                if (Session::get('role') == KPPN) {

                    $kdkppn = Session::get('id_user');



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

                    $filename = 'null';
                    $kdsatker = 'null';
                    ?>

                    <a href="<?php echo URL; ?>PDF/ValidasiSpm_PDF/<?php echo $kdkppn . "/" . $filename . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
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
                <?php
                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                }
                if (isset($this->d_satker_code)) {
                    echo "<br>Satker : ".$this->d_satker_code;
                }
                if (isset($this->d_file_name)) {
                    echo "<br>Nama File : ".$this->d_file_name;
                }
                if (isset($this->d_tgl_awal)&&isset($this->d_tgl_akhir)) {
                    echo "<br>Tanggal : ".$this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
                }
                ?>
            </div>

            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                // untuk menampilkan last_update
                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "Update Data Terakhir (Waktu Server) :<br> " . $last_update->get_last_update() . " WIB";
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
                <th>No.</th>
                <th>Tanggal Upload</th>
                <th>Nama File</th>
                <th>Kode Satker</th>
                <th>Status Code</th>
            </tr>

        </thead>
        <tbody class='ratatengah'>
<?php
$no = 1;
//var_dump ($this->data);
if (isset($this->data)) {
    if (empty($this->data)) {
        echo '<td colspan=5 align="center">Tidak ada data.</td>';
    } else {
        foreach ($this->data as $value) {
            echo "<tr>	";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $value->get_creation_date() . "</td>";
            echo "<td><a href=" . URL . "dataSPM/errorSpm/" . $value->get_file_name() . " target='_blank' '>" . $value->get_file_name() . "</a></td>";
            echo "<td>" . $value->get_satker_code() . "</td>";
            echo "<td>" . $value->get_status_code() . "</td>";

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

            <form id="filter-form" method="POST" action="ValidasiSpm" enctype="multipart/form-data">

                <div class="modal-body">

<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display: none"></div>
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
                    <?php if (Session::get('role') != SATKER) { ?>
                    <label class="isian">Kode SATKER: </label>
                    <?php } ?>	
                    <input class="form-control" type="<?php
                        if (Session::get('role') == SATKER) {
                            echo "hidden";
                        } else {
                            echo "number";
                        }
                        ?>" name="kdsatker" id="kdsatker" size="15" value="<?php
                    if (isset($this->d_satker_code)) {
                        echo $this->d_satker_code;
                    }
                    ?>">
                    <br/>
                    <label class="isian">Nama File: </label>
                    <input class="form-control" type="text" name="file_name" id="file_name" value="<?php
                           if (isset($this->d_file_name)) {
                               echo $this->d_file_name;
                           }
                           ?>">
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Tanggal: </label>
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
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript" charset="utf-8">

    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });

    $(function() {
        hideErrorId();
        hideWarning();
    });

    function hideErrorId() {
        $('.error').fadeOut(0);
    }

    function hideWarning() {

        $('#kdsatker').change(function() {
            if (document.getElementById('kdsatker').value != '') {
                $('#wsatker').fadeOut(200);
            }
        });

        $('#datepicker').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });

        $('#datepicker1').change(function() {
            if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                $('#wtgl').fadeOut(200);
            }
        });
    }

    function cek_upload() {
        var v_invoice = document.getElementById('kdsatker').value;

        var jml = 0;
        if (v_invoice == '') {
            $('#wsatker').html('Harap isi no invoice');
            $('#wsatker').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }
</script>