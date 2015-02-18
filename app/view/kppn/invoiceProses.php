<!-- A beautiful app starts with a beautiful code :) -->

<!-- /userSpan/monitoringUserSpan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Invoice Menggantung</h2>
            </div>
			<div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <a href="#" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-thumbs-up"></span> Supplier</a>

            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <a href="#" class="btn btn-default fullwidth"><span class="glyphicon glyphicon-hand-right"></span> Kontrak</a>

                <?php
                /*---------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
                if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {
                    if (isset($this->d_kd_kppn) || isset($this->d_nip)) {
                        if (isset($this->d_kd_kppn)) {
                            $kdkppn = $this->d_kd_kppn;
                        } else {
                            $kdkppn = 'null';
                        }
                        if (isset($this->d_nip)) {
                            $kdnip = $this->d_nip;
                        } else {
                            $kdnip = 'null';
                        }
                        ?>
                        <a href="<?php echo URL; ?>PDF/monitoringUserSpan_PDF/<?php echo $kdkppn . "/" . $kdnip; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                        </div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                        <a href="<?php echo URL; ?>PDF/monitoringUserSpan_PDF/<?php echo $kdkppn . "/" . $kdnip; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
						<?php
                    }
                }
                if (Session::get('role') == KPPN) {
                    if (isset($this->d_kd_kppn)) {
                        $kdkppn = $this->d_kd_kppn;
                    } else {
                        $kdkppn = Session::get('id_user');
                    }
                    if (isset($this->d_nip)) {
                        $kdnip = $this->d_nip;
                    } else {
                        $kdnip = 'null';
                    }
                    ?>
                        <a href="<?php echo URL; ?>PDF/monitoringUserSpan_PDF/<?php echo $kdkppn . "/" . $kdnip; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                        </div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                        <a href="<?php echo URL; ?>PDF/monitoringUserSpan_PDF/<?php echo $kdkppn . "/" . $kdnip; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
                    <?php
                }
                //------------------------------*/
                ?>

            </div>

            
        </div>

        <div class="row">

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

            <div class="col-md-6 col-sm-12 align-right">
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

        <thead>
            <tr>
                <th class="align-center">No.</th>
                <th class="align-center">Nama Pegawai, NIP</th>
                <th class="align-center">Posisi</th>
                <th class="align-center">Tanggal Invoice</th>
                <th class="align-center">No. Invoice</th>
                <th class="align-center" width='40%'>Deskripsi Invoice</th>
                <th class="align-center">Status</th>
                <!--th class="align-center">NIP</th>
                
                <th class="align-center">Posisi</th-->
            </tr>
        </thead>

        <tbody>

<?php $no = 1; ?>

<?php if (isset($this->data)) { ?>

    <?php if (empty($this->data)) { ?>

                <td colspan=8 class="align-center">Tidak ada data.</td>

                <?php } else { ?>

                    <?php foreach ($this->data as $value) { ?>

                    <tr>
                        <td class="align-center"><?php echo $no++; ?></td>
                        <td class="align-left"><?php echo $value->get_nama_pegawai(); echo "<br>"; 
                            echo $value->get_username();  ?></td>
                        <td class="align-center"><?php echo $value->get_posisi(); ?></td>
                        <td class="align-center"><?php echo $value->get_tgl_invoice(); ?></td>
                        <td class="align-center"><?php echo $value->get_no_invoice(); ?></td>
                        <td class="align-left"><?php echo $value->get_desc_invoice(); ?></td>
                        <td class="align-center"><?php echo $value->get_wfapproval_status(); echo "<br>"; 
                            echo $value->get_status();  ?></td>
                        <!--td class="align-center"><?php echo $value->get_username(); ?></td>
                        
                        <td class="align-center"><?php echo $value->get_posisi(); ?></td-->
                    </tr>

        <?php }  ?>

    <?php } ?>

<?php } else { ?>

            <td colspan=8 class="align-center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>

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

            <form id="filter-form" method="POST" action="invoiceProses" enctype="multipart/form-data">

                <div class="modal-body">

<?php if (isset($this->kppn_list)) { ?>

                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>

                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">

    <?php foreach ($this->kppn_list as $value1) { ?>

        <?php if ($kode_kppn == $value1->get_kd_d_kppn()) { ?>

                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>" selected><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>

                                <?php } else { ?>

                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>"><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>

        <?php } ?>

                            <?php } ?>

                        </select>

                        <br/>

                        <?php } ?>

                    <!--div id="wnip" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">NIP: </label>

                    <input class="form-control" type="number" name="nip" id="nip" size="18" value="<?php if (isset($this->d_nip)) {
                            echo $this->d_nip;
                        } ?>"-->

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
        $('#nip').keyup(function() {
            if (document.getElementById('nip').value != '') {
                $('#wnip').fadeOut(200);
            }
        });

    }

    /*
    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_nip = document.getElementById('nip').value;

        var jml = 0;

        if (jml > 0) {
            return false;
        }
    }
    */

</script>