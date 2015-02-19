<!-- A beautiful app starts with a beautiful code :) -->

<!-- /userSpan/monitoringUserSpan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Pergantian User</h2>
            </div>
			<div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <?php if (Session::get('role') == ADMIN) { ?>
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                <?php } ?>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">

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
//buat ambil LoV posisi user dari tabel T_POSISI
/*
if (isset($this->d_posisi)) {
    foreach ($this->d_posisi as $posisi) {
        echo $posisi->get_kd_posisi();
        $posisi_user = $posisi->get_kd_posisi();
    }
}
*/
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
    <table class="footable align-center">

        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th colspan="3">Semula</th>
                <th colspan="3">Menjadi</th>
                <th rowspan="2">No. Surat</th>
                <th rowspan="2">Tanggal Awal<br>Status</th>
                <th rowspan="2">Tanggal Akhir<br>Status</th>
                <th rowspan="2">Catatan</th>
                <th rowspan="2">Cek Data</th>
            </tr>
            <tr>
                <th >Nama, NIP</th>
                <th >Email</th>
                <th >Posisi</th>
                <th >Nama, NIP</th>
                <th >Email</th>
                <th >Posisi</th>
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
                        <td><?php echo $no++; ?></td>
                        <td class="align-left"><?php echo $value->get_nama_usr_awal(); echo "<br>"; 
                            echo $value->get_nip_usr_awal();  ?></td>
                        <td ><?php echo $value->get_email_usr_awal(); ?></td>
                        <td ><?php echo $value->get_posisi_user_awal(); ?></td>
                        <td class="align-left"><?php echo $value->get_nama_usr_pengganti(); echo "<br>"; 
                            echo $value->get_nip_usr_pengganti();  ?></td>
                        <td ><?php echo $value->get_email_usr_pengganti(); ?></td>
                        <td ><?php echo $value->get_posisi_user_pengganti(); ?></td>
                        <td ><?php echo $value->get_surat(); ?></td>
                        <td ><?php echo $value->get_tanggal_awal(); echo "<br>"; 
                            echo $value->get_status_setup_awal();  ?></td>
                        <td ><?php echo $value->get_tanggal_akhir(); echo "<br>"; 
                            echo $value->get_status_setup_akhir();  ?></td>
                        <td class="align-left"><?php echo $value->get_catatan(); ?></td>
                        <td ><?php 
                            //$posisi = {"KASI PD, KASI BANK, dsb"}                               
                            //if($value->get_posisi_user_awal == $posisi) { ?>
                                <a href="<?php echo URL; ?>userSpan/invoiceProses">Cek Data</a>
                            <?php //} else {
                                //echo "OK";
                            //}
                            
                            ?>
                        
                        </td>
                        
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
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Tambah Data Pergantian User</h4>

            </div>

            <form id="filter-form" method="POST" action="<?php URL; ?>gantiUserSpan/addDataUser" enctype="multipart/form-data">

                <div class="modal-body">

<?php if (isset($this->kppn_list)) { ?>

                        <div id="warning-all" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">KPPN: </label>

                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">

    <?php foreach ($this->kppn_list as $value1) { ?>

        <?php if ($kode_kppn == $value1->get_kd_d_kppn()) { ?>

                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>" selected><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>

                                <?php } else { ?>

                                    <option value="<?php echo $value1->get_kd_d_kppn(); ?>"><?php echo $value1->get_kd_d_kppn(); ?> | <?php echo $value1->get_nama_user(); ?></option>

        <?php } ?>

                            <?php } ?>

                        </select>

                        <?php } ?>
                    
                    <div id="wnip" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">NIP</label>
                    <div class="input-group" id="nip" style="width: 100%">
                        <input class="form-control" type="text" class="nip1" name="nip1" id="nip1" value="<?php //if (isset($this->nip_usr_awal)) {
                            //echo $this->nip_usr_awal; } ?>">
                        <span class="input-group-addon">diganti</span>
                        <input class="form-control" type="text" class="nip2" name="nip2" id="nip2" value="<?php //if (isset($this->nip_usr_pengganti)) {
                            //echo $this->nip_usr_pengganti; } ?>">
                    </div>
                    
                    <label class="isian">Nama</label>
                    <div class="input-group" id="nama" style="width: 100%">
                        <input class="form-control" type="text" class="nama1" name="nama1" id="nama1" value="<?php //if (isset($this->nama_usr_awal)) {
                            //echo $this->nama_usr_awal; } ?>">
                        <span class="input-group-addon">diganti</span>
                        <input class="form-control" type="text" class="nama2" name="nama2" id="nama2" value="<?php //if (isset($this->nama_usr_pengganti)) {
                            //echo $this->nama_usr_pengganti; } ?>">
                    </div>
                    
                    <label class="isian">Email</label>
                    <div class="input-group" id="email" style="width: 100%">
                        <input class="form-control" type="text" class="email1" name="email1" id="email1" value="<?php //if (isset($this->email_usr_awal)) {
                            //echo $this->email_usr_awal; } ?>">
                        <span class="input-group-addon">diganti</span>
                        <input class="form-control" type="text" class="email2" name="email2" id="email2" value="<?php //if (isset($this->email_usr_pengganti)) {
                            //echo $this->email_usr_pengganti; } ?>">
                    </div>
                    
                    <label class="isian">Posisi</label>
                    <div class="input-group" id="posisi" style="width: 100%">
                        <select class="form-control" type="text" name="posisi1" id="posisi1">
                            <?php   //foreach ($this->posisi as $values) {
                                    //if ($posisi_user == $values->get_kd_posisi()) { ?>
                                <option value="<?php //echo $values->get_kd_posisi(); ?>" selected><?php //echo $values->get_kd_posisi(); ?></option>
                                <?php //} else { ?>
                                <option value="<?php //echo $values->get_kd_posisi(); ?>"><?php //echo $value1->get_kd_posisi(); ?></option>
                            <?php //} ?>
                            <?php //} ?>

                        </select>
                        <span class="input-group-addon">diganti</span>
                        <select class="form-control" type="text" name="posisi2" id="posisi2">
                            <?php   //foreach ($this->posisi as $values) {
                                    //if ($posisi_user == $values->get_kd_posisi()) { ?>
                                <option value="<?php //echo $values->get_kd_posisi(); ?>" selected><?php //echo $values->get_kd_posisi(); ?></option>
                                <?php //} else { ?>
                                <option value="<?php //echo $values->get_kd_posisi(); ?>"><?php //echo $value1->get_kd_posisi(); ?></option>
                            <?php //} ?>
                            <?php //} ?>

                        </select>
                    </div>
                    
                    <label class="isian">No. Surat:</label>
                    
                    <input class="form-control" type="text" name="surat" id="surat" size="18" value="<?php //if (isset($this->surat)) {
                            //echo $this->surat;
                        //} ?>">
                    
                    <label class="isian">Tanggal: </label>
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tanggal_awal" id="tanggal_awal" value="<?php if (isset($this->tanggal_awal)) {
                            echo $this->tanggal_awal;
                        } ?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tanggal_akhir" id="tanggal_akhir" value="<?php if (isset($this->tanggal_akhir)) {
                            echo $this->tanggal_akhir;
                        } ?>">
                    </div>
                    
                    <label class="isian">Status Awal dan Akhir:</label>
                    <div class="input-group" id="posisi" style="width: 100%">
                        <select class="form-control" type="text" name="status1" id="status1">
                            <option selected>-- pilih --</option>    
                            <option value="<?php //echo $values->get_kd_posisi(); ?>">Tunda</option>
                            <option value="<?php //echo $values->get_kd_posisi(); ?>">Selesai</option>
                        </select>
                        <span class="input-group-addon">dan</span>
                        <select class="form-control" type="text" name="status2" id="status2">
                            <option selected>-- pilih --</option>    
                            <option value="<?php //echo $values->get_kd_posisi(); ?>">Tunda</option>
                            <option value="<?php //echo $values->get_kd_posisi(); ?>">Selesai</option>
                        </select>
                    </div>
                    
                    <label class="isian">Catatan:</label>
                    
                    <input class="form-control" type="text" name="catatan" id="catatan" size="18" value="<?php //if (isset($this->catatan)) {
                            //echo $this->catatan;
                        //} ?>">
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

        $('#kdkppn').change(function() {
            if (document.getElementById('kdkppn').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#nip1').keyup(function() {
            if (document.getElementById('nip1').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#nip2').keyup(function() {
            if (document.getElementById('nip2').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#nama1').keyup(function() {
            if (document.getElementById('nama1').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#nama2').keyup(function() {
            if (document.getElementById('nama2').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#email1').keyup(function() {
            if (document.getElementById('email1').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#email2').keyup(function() {
            if (document.getElementById('email2').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#status1').change(function() {
            if (document.getElementById('status1').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#status2').change(function() {
            if (document.getElementById('status2').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#posisi1').change(function() {
            if (document.getElementById('posisi1').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#posisi2').change(function() {
            if (document.getElementById('posisi2').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#tanggal_awal').change(function() {
            if (document.getElementById('tanggal_awal').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#tanggal_akhir').change(function() {
            if (document.getElementById('tanggal_akhir').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });
        
        $('#surat').keyup(function() {
            if (document.getElementById('surat').value != '') {
                $('#warning-all').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        
        var v_nip1 = document.getElementById('nip1').value;
        var v_nip2 = document.getElementById('nip2').value;
        var v_nama1 = document.getElementById('nama1').value;
        var v_nama2 = document.getElementById('nama2').value;
        var v_email1 = document.getElementById('email1').value;
        var v_email2 = document.getElementById('email2').value;
        var v_posisi1 = document.getElementById('posisi1').value;
        var v_posisi2 = document.getElementById('posisi2').value;
        var v_tanggal_awal = document.getElementById('tanggal_awal').value;
        var v_tanggal_akhir = document.getElementById('tanggal_akhir').value;
        var v_status1 = document.getElementById('status1').value;
        var v_status2 = document.getElementById('status2').value;
        var v_surat = document.getElementById('surat').value;
        var v_kdkppn = document.getElementById('kdkppn').value;

        var pattern = '^[0-9]+$';
        
        if (v_kdkppn == '' || v_nip1 == '' || v_nip2 == '' || v_nama1 == '' || v_nama2 == '' || v_email1 == '' || v_email2 == '' || v_posisi1 == '' || v_posisi2 == '' || v_tanggal_awal == '' || v_tanggal_akhir == '' || v_status1 == '' || v_status2 == '' || v_surat == '') {
            
            $('#warning-all').html('Isi semua parameter, cuy');
            $('#warning-all').fadeIn(200);
            return false;
            
        }
        
        if ((v_nip1 != '' && v_nip1.length != 18) || (v_nip2 != '' && v_nip2.length != 18)) {
            $('#warning-all').html('NIP harus 18 digit, dong!');
            $('#warning-all').fadeIn(200);
            return false;

        }

        if (v_nip1 != '' && !v_nip1.match(pattern)) {
            var wsp2d = 'NIP harus dalam bentuk angka!';
            $('#warning-all').html(wsp2d);
            $('#warning-all').fadeIn(200);
            return false;
        }

        if (v_tgl_awal != '' && v_tgl_akhir != ''){
            if(v_tgl_awal > v_tgl_akhir){
                $('#warning-all').html('Tanggal awal gak boleh lebih dari tanggal akhir');
                $('#warning-all').fadeIn(200);
                return false;
            }
        }

    }

</script>