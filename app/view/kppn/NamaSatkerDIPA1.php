<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataDIPA/nmsatker -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Informasi Revisi DIPA</h2>
            </div>
			
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <!-- PDF -->   
                <?php
                //----------------------------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
                if (Session::get('role') == ADMIN || Session::get('role') == DJA || Session::get('role') == KANWIL) {
                    if (isset($this->d_nama_kppn) || isset($this->kdsatker) || isset($this->nmsatker) || isset($this->d_kd_revisi)) {
                        if (isset($this->d_nama_kppn)) {
                            foreach ($this->d_nama_kppn as $kppn) {
                                $kdkppn = $kppn->get_kd_satker();
                            }
                        } else {
                            $kdkppn = 'null';
                        }
						if (isset($this->kdsatker)) {
							$kdsatker = $this->kdsatker;
						} else {
							$kdsatker = 'null';
						}

						if (isset($this->nmsatker)) {
							$nmsatker = $this->nmsatker;
						} else {
							$nmsatker = 'null';
						}

                        if (isset($this->d_kd_revisi)) {
                            $kdrevisi = $this->d_kd_revisi;
                        } else {
                            $kdrevisi = 'null';
                        }
                        ?>
                        
                    <div class="btn-group-sm">
                        <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                        </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo URL; ?>PDF/nmsatker_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdrevisi; ?>/PDF">PDF</a></li>
                                <li><a href="<?php echo URL; ?>PDF/nmsatker_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdrevisi; ?>/XLS">EXCEL</a></li>
                              </ul>
                    </div>	
            
                <?php
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
					if (isset($this->kdsatker)) {
						$kdsatker = $this->kdsatker;
					} else {
						$kdsatker = 'null';
					}

					if (isset($this->nmsatker)) {
						$nmsatker = $this->nmsatker;
					} else {
						$nmsatker = 'null';
					}

                    if (isset($this->d_kd_revisi)) {
                        $kdrevisi = $this->d_kd_revisi;
                    } else {
                        $kdrevisi = 'null';
                    }
                    ?>
                        
                <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/nmsatker_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdrevisi; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/nmsatker_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdrevisi; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>	

                    <?php
                }
                //------------------------------
                ?>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

            <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

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

<!-- Blok Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">

        <thead>

            <tr>
                <th class="align-center">No.</th>
                <th class="align-center">KPPN</th>
                <th class="align-center">Kode Satker</th>
                <th>Nama Satker</th>
                <th class="align-center">Tanggal Posting Revisi</th>
                <th class="align-center">No. Revisi Terakhir</th>
            </tr>

        </thead>

        <tbody>

            <?php $no = 1; ?>

            <?php if (isset($this->data)) { ?>

                <?php if (empty($this->data)) { ?>

                <td colspan=6 align="center">Tidak ada data.</td>

            <?php } else { ?>

                <?php foreach ($this->data as $value) { ?>

                    <tr>
                        <td class="align-center"><?php echo $no++; ?></td>
                        <td class="align-center"><?php echo $value->get_kppn(); ?></td>
                        <td class="align-center"><a href="<?php echo URL; ?>dataDIPA/RevisiDipa/<?php echo $value->get_kdsatker(); ?>"><?php echo $value->get_kdsatker(); ?></a></td>
                        <td><?php echo $value->get_nmsatker(); ?></td>
                        <td class="align-center"><?php echo $value->get_tgl_rev(); ?></td>
                        <td class="align-center"><?php echo $value->get_rev(); ?></td>
                    </tr></a>

                <?php } ?>

            <?php } ?>

        <?php } else { ?>

            <td colspan=6 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>

        <?php } ?>

        </tbody>
    </table>
</div>

<!-- Blok Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>

            <form id="filter-form" method="POST" action="nmsatker" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="winvoicea" class="alert alert-danger" style="display:none;"></div>

                    <?php if (isset($this->kppn_list)) { ?>

                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">

                            <option value="" selected>Pilih salah satu...</option>

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

                    <!-- label class="isian">Status Revisi: </label>
                    <select class="form-control" type="text" name="revisi" id="revisi">

                        <option value="">Pilih salah satu...</option>
                        <option value="0" <?php
                        if ($this->d_kd_revisi == '0') {
                            echo 'selected';
                        }
                        ?>>BELUM REVISI</option>
                        <option value="1" <?php
                        if ($this->d_kd_revisi == '1') {
                            echo 'selected';
                        }
                        ?>>SUDAH REVISI</option>

                    </select>

                    <br/-->

                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php
                        if (isset($this->d_kd_satker)) {
                            echo $this->d_kd_satker;
                        }
                        ?>">

                    <br/>

                    <!--label class="isian">Nama Satker: </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker" value="<?php //if (isset($this->nmsatker)){ echo $this->nmsatker; }   ?>"-->


                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- Blok Skrip -->
<script type="text/javascript">
    $(function() {

        hideWarning();

    });

    function cek_upload() {
        jml = 0;

        if (($('#nmsatker').val().length == 0) && ($('#kdsatker').val().length == 0) && ($('#revisi').val().length == 0) && ($('#kdkppn').val().length == 0)) {
            $('#winvoicea').html('Isi salah satu kolom terlebih dahulu.');
            $('#winvoicea').fadeIn();
            jml++;
        }

        if (($('#kdsatker').val().length != 6) && ($('#kdsatker').val().length > 0)) {
            $('#winvoice').html('Kode Satker harus 6 digit.');
            $('#winvoice').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }

    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
            }
        });

    }

</script>