<!-- Ndas -->
<div class="main-window-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Posisi Invoice</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <?php
                //----------------------------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
                if (Session::get('role') == KANWIL) {
                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            $kdkppn = $kppn->get_kd_satker();
                        }
						?>
						<a href="<?php echo URL; ?>PDF/posisiSpm_PDF/<?php echo $kdkppn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
						<?php
                    } 

                }
                if (Session::get('role') == ADMIN) {
                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            $kdkppn = $kppn->get_kd_satker();
                        }
						?>
						<a href="<?php echo URL; ?>PDF/posisiSpm_PDF/<?php echo $kdkppn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
						<?php
                    } 
                }
				if (Session::get('role') == SATKER) {
						if(!empty($this->data)){
							foreach ($this->data as $value) {
								$kdkppn=substr($value->get_invoice_num(),8,6);
							}
						
						}else{
							$kdkppn = 'null';
							
						}
					?>
					<a href="<?php echo URL; ?>PDF/posisiSpm_PDF/<?php echo $kdkppn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
					<?php
                }
                if (Session::get('role') == KPPN) {
                   $kdkppn=Session::get('id_user');
					?>
						<a href="<?php echo URL; ?>PDF/posisiSpm_PDF/<?php echo $kdkppn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
						<?php
                }
                //----------------------------------------------------		
                ?>
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                <?php if (Session::get('role') == ADMIN OR Session::get('role') == KANWIL) { ?>
                    <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                <?php } ?>
                
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
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) : " . $last_update->get_last_update() . " WIB";
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
                <th class='mid'>No.</th>
                <!--th>KPPN</th-->
                <th class='mid'>Nomor Invoice</th>
                <th class='ratakanan'>Nilai Invoice Rp</th>
                <th width='350px'>Deskripsi Invoice</th>
                <th class='mid' width='70px'>Approval Status</th>
                <th width='70px' class='mid'>Status</th>
                <!--th>original_recipient</th-->
                <th class='mid'>User</th>
                <!--th>Posisi User</th-->
                <th class='mid'>Mulai</th>
                <!--th>Jam Mulai</th>
                <th>Selesai</th>
                <th>Durasi</th-->
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=12 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td class='mid'>" . $no++ . "</td>";

                        //echo "<td>" . $value->get_ou_name() . "</td>";
                        echo "<td  class='mid'>" . $value->get_invoice_num() . "</td>";
                        //echo "<td><a href=".URL."dataSPM/detailposisiSpm/".$value->get_invoice_num()." target='_blank' '>" . $value->get_invoice_num() . "</a></td>";
                        echo "<td class='ratakanan'>" . $value->get_invoice_amount() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
                        echo "<td class='mid'>" . $value->get_wfapproval_status() . "</td>";
                        echo "<td class='mid'>" . $value->get_status() . "</td>";
                        //echo "<td>" . $value->get_original_recipient() . "</td>";
                        echo "<td class='mid'>" . $value->get_to_user() . ' ' . $value->get_fu_description() . "</td>";
                        //echo "<td>" . $value->get_fu_description() . "</td>";
                        echo "<td class='mid'>" . $value->get_begin_date() . '<br>' . $value->get_time_begin_date() . "</td>";
                        //echo "<td>" . $value->get_time_begin_date() . "</td>";
                        //echo "<td>" . $value->get_end_date() . ' ' . $value->get_time_end_date() . "</td>";
                        //echo "<td>" . $value->get_time_end_date() . "</td>";
                        //echo "<td> &nbsp </td>";
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

<?php if (Session::get('role') == ADMIN OR Session::get('role') == KANWIL) { ?>
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="PosisiSPM" enctype="multipart/form-data">

                <div class="modal-body">

                    <?php if (isset($this->kppn_list)) { ?>
                            <div id="wkdkppn" class="alert alert-danger" style="display:none"></div>
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
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<?php } ?>

<script type="text/javascript" charset="utf-8">
        $(function() {
            hideWarning();
        });


        function hideErrorId() {
            $('.alert-danger').fadeOut(0);
        }

        function hideWarning() {
            $('#invoice').keyup(function() {
                if (document.getElementById('invoice').value != '') {
                    $('#winvoice').fadeOut(200);
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
            var v_invoice = document.getElementById('invoice').value;
            var v_tglawal = document.getElementById('tgl_awal').value;
            var v_tglakhir = document.getElementById('tgl_akhir').value;

            var jml = 0;
            if (v_invoice == '' && v_tglawal == '' && v_tglakhir == '') {
                $('#winvoice').html('Harap isi no invoice');
                $('#winvoice').fadeIn();
                $('#wtgl').html('Harap isi tanggal');
                $('#wtgl').fadeIn();
                jml++;
            }

            if (jml > 0) {
                return false;
            }
        }
</script>