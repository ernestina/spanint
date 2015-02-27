<!-- A beautiful app starts with a beautiful code :) -->

<!-- /userSpan/monitoringUserSpan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Referensi Register DJPU</h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
			<?php
                   
                        
						if (isset($this->d_nip)) {
						$kdnip = $this->d_nip;
                    } else {
						$kdnip = 'null';
                     }

                    if (isset($this->d_name)) {
                        $kdnama = $this->d_name;
                    } else {
                        $kdnama = 'null';
                    }
					?>
						<div class="btn-group-sm">
						<button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
						</button>
							  <ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo URL; ?>PDF/registerDJPU_PDF/<?php echo $kdnip . "/" . $kdnama; ?>/PDF">PDF</a></li>
								<li><a href="<?php echo URL; ?>PDF/registerDJPU_PDF/<?php echo $kdnip . "/" . $kdnama; ?>/XLS">EXCEL</a></li>
							  </ul>
                </div>

					
					<?php
				
			
			
			?>

            </div>

            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">

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
                }
                if (isset($this->d_nip)) {
                    echo "<br> Kode Register : ".$this->d_nip;
                }
                ?>
                
            </div>

            <div class="col-md-6 col-sm-12 align-right">
                
                <?php
                // untuk menampilkan last_update
                if (isset($this->data) && (count($this->data) > 0)) {
                    echo "Update Data Terakhir (Waktu Server)<br/>" . $this->data[0]->get_d_period() . "";
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
                <th class="align-center">Status di SPAN</th>
                <th class="align-center">REG_NO</th>
                <th class="align-left">NAME</th>
                <th class="align-center">CRED_NAME</th>
                <th class="align-center">CURR</th>
                <th class="align-center">COUNTRY</th>
                <th class="align-center">CRED_TYPE</th>
                <th class="align-center">CARA_TARIK</th>
                
                <th class="align-right">AMT_ORI</th>
                <th class="align-right">AMT_AMEND</th>
                <th class="align-right">AMT_NET</th>
                <th class="align-center">BENEF</th>
                <th class="align-center">STATUS</th>
                
                <th class="align-center">&nbsp;D_SIGNED&nbsp;</th>
                <th class="align-center">D_EFFECTIVE</th>
                <th class="align-center">D_DRAWLIM</th>
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
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $no++; ?></td>
                        
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_status_span(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_reg_no(); ?></td>
                        <td class="align-left" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_name(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_cred_name(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_curr(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_country(); ?></th>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_cred_type(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_cara_tarik(); ?></td>

                        <td class="align-right" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo number_format($value->get_amt_ori()); ?></td>
                        <td class="align-right" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo number_format($value->get_amt_amend()); ?></td>
                        <td class="align-right" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo number_format($value->get_amt_net()); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_benef(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_status(); ?></td>

                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_d_signed(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_d_effective(); ?></td>
                        <td class="align-center" <?php if ($value->get_status_span() == "Belum Terdaftar") { echo 'style="background:#FFC2C2"'; } ?>><?php echo $value->get_d_drawlim(); ?></td>
                        
                    </tr>

        <?php } ?>

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

            <form id="filter-form" method="POST" action="registerDJPU" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <div id="wmaster" class="alert alert-danger" style="display:none;"></div><br/>

                    <div id="wnip" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Register: </label>

                    <input class="form-control" type="text" name="nip" id="nip" value="<?php if (isset($this->d_nip)) { echo $this->d_nip; } ?>"><br/>
                    
                    <div id="wname" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Nama: </label>

                    <input class="form-control" type="text" name="name" id="name" value="<?php if (isset($this->d_name)) { echo $this->d_name; } ?>">
                    
                    <input type="hidden" name="secret" id="secret" value="secret">

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim Filter</button><br/><br/>
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return showAll()">Tampilkan Semua</button>
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
                $('#wmaster').fadeOut(200);
            }
        });
        $('#name').keyup(function() {
            if (document.getElementById('name').value != '') {
                $('#wname').fadeOut(200);
                $('#wmaster').fadeOut(200);
            }
        });
    }

    function cek_upload() {
        var v_nip = document.getElementById('nip').value;
        var v_name = document.getElementById('name').value;

        var jml = 0;
        
        if (v_nip == '' && v_name == '') {
            $('#wmaster').html('Harap isi salah satu parameter');
            $('#wmaster').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
    
    function showAll() {
        $('#nip').val('');
        $('#name').val('');
        
        return true;
    }
        

</script>