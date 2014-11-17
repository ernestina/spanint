<!-- A beautiful app starts with a beautiful code :) -->

<!-- /userSpan/monitoringUserSpan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-11 col-md-9 col-sm-12">
                <h2><?php echo $this->page_title; ?></h2>
            </div>
            <?php if (isset($this->kppn_list)) { ?>

            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">

                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

            </div>
            <?php } ?>
        </div>

        <div class="row top-padded-little">

            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->d_nama_kppn)) {
                    foreach ($this->d_nama_kppn as $kppn) {
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ") <br/> ";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                } else {
                    if (Session::get('role') == KPPN) {
                        echo Session::get('user').' <br/>';
                    } else {
                        echo "SEMUA KPPN <br/>";
                    }
                }
                if (isset($this->d_tgl_awal)) {
                    echo "Periode berakhir tanggal: ".$this->d_tgl_awal." s.d. ".$this->d_tgl_akhir;
                }
                ?>
            </div>

            <div class="col-md-6 col-sm-12 align-right">
                Update Data Terakhir (Waktu Server)<br/>Sesuai dengan yang ada di Cetakan PDF
            </div>

        </div>

    </div>
</div>

<div id="table-container" class="wrapper">
    <table class="footable">

        <thead>
            <tr>
                <th class="align-center">No.</th>
                <th class="align-center">Kode KPPN</th>
                <th class="align-center">Periode Berakhir Laporan</th>
                <th class="align-center">Nama File</th>
                <th class="align-center">Opsi</th>
            </tr>
        </thead>

        <tbody>

<?php $no = 1; ?>

<?php if (isset($this->data)) { ?>

    <?php if (empty($this->data)) { ?>

                <td colspan=5 class="align-center">Tidak ada data.</td>

                <?php } else { ?>

                    <?php foreach ($this->data as $value) {?>
                    <tr>
                        <td class="align-center"><?php echo $no++; ?></td>
                        <td class="align-center"><?php echo $value->get_kppn(); ?></td>
                        <td class="align-center"><?php echo $value->get_tgl_akhir_laporan(); ?></td>
                        <td class="align-center"><?php echo $value->get_request_id().".PDF"; ?></td>
                        <td><a href="<?php echo $this->fileURL.$value->get_request_id().".PDF"; ?>">Unduh File</a></td>
                    </tr>

                    <?php } ?>

                <?php } ?>

            <?php } else { ?>

            <td colspan=5 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>

        <?php } ?>

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

            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

                <div class="modal-body">

                    <?php if (isset($this->kppn_list)) { ?>

                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>

                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            
                            <option value="">SEMUA KPPN</option>

                        <?php foreach ($this->kppn_list as $value1) { ?>

                                <?php if ($kode_kppn == $value1->get_kd_d_kppn()) { ?>

                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>" selected><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>

                                <?php } else { ?>

                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>"><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>

                                <?php } ?>

                        <?php } ?>

                        </select>
						
					<?php } ?>
					
                    <?php if (false) { ?>  

                    <br/>                  
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal Akhir Periode: </label>
                    
					<div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)) { echo $this->d_tgl_awal; } ?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)) { echo $this->d_tgl_akhir; } ?>">
                    </div>
					<?php } ?>

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
        $('.alert-danger').fadeOut(0);
    }

    function hideWarning() {

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
        
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        
        if (v_tglawal == '' && v_tglakhir == '') {
            $('#wtgl').html('Harap isi tanggal');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
        
    }
</script>