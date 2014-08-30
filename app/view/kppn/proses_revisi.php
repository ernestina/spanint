<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Informasi Proses Revisi DIPA
            <?php


            if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                echo "<br>" . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
            }
            ?></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <!-- PDF -->
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
				
			<?php if (Session::get('role') != SATKER) { ?>
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			<?php } ?>
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
                echo Session::get('user');
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

<!--Tabel-->
<div id="table-container" class="wrapper">
    <table width="100%" class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th align='center'>No.</th>
                <th align='center'>Kode Satker</th>
                <th>Nama Satker</th>
                <th align='center'>KPPN</th>
                <th align='center'>Revisi Ke</th>
                <th align='center'>Tahapan Proses</th>
                <th align='center'>Tanggal</th>
                <th align='center'>Locked Akun</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            $no = 1;
            $total;

            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=8 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td align='center'>" . $no++ . "</td>";
                        echo "<td align='center'>" . $value->get_satker_code() . "</td>";
                        echo "<td>" . $value->get_nmsatker() . "</td>";
                        echo "<td align='center'>" . $value->get_kppn() . "</td>";
                        echo "<td align='center'>" . $value->get_revision_no() . "</td>";
                        echo "<td align='center'>" . $value->get_meaning() . "</td>";
                        echo "<td align='center'>" . $value->get_last_update_date() . "</td>";
                        echo "<td align='center'><a href=" . URL . "dataDIPA/DetailRevisi/" . $value->get_satker_code() . " target='_blank' '> Lihat Detail </td>";

                        //$total = $total + $value->get_encumbered_amount();
                    }
                }
            } else {
                echo '<td colspan=8 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
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
            
            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

                <div class="modal-body">
                    
	                <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control"  type="text" name="kdkppn" id="kdkppn">
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
                    <div id="wsatker" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Kode Satker : </label>
                    <input class="form-control"  type="text" name="satker" id="satker">
                    
                    <br/>
                    <div id="wnamasatker" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Nama Satker : </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker">
                    
                    <br/>
                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript">

    $(function() {
        hideErrorId();
        hideWarning();
    });


    function hideErrorId() {
        $('.error').fadeOut(0);
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