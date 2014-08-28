<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Pelimpahan</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
                    //----------------------------------------------------
                    //Development history
                    //Revisi : 0
                    //Kegiatan :1.mencetak hasil filter ke dalam pdf
                    //File yang diubah : revisiDIPA.php
                    //Dibuat oleh : Rifan Abdul Rachman
                    //Tanggal dibuat : 18-07-2014
                    //----------------------------------------------------


                    if(isset($this->d_status) || isset($this->d_satker) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
                    $kdkppn=Session::get('id_user');
                        if (isset($this->d_status)) {
                            $kdstatus = $this->d_status;
                        } else {
                            $kdstatus = 'null';
                        }

                        if (isset($this->d_satker)) {
                            $kdsatker = $this->d_satker;
                        } else {
                            $kdsatker = Session::get('kd_satker');
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
                    <ul class="inline" style="float: right"><li>
                            <a href="<?php echo URL; ?>PDF/monitoringPelimpahan_PDF/<?php echo $kdsatker . "/" . $kdkppn. "/" . $kdstatus . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>						
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
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ") <br>";
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
                    <th rowspan="2" width='3%' class='mid'>No.</th>
                    <th colspan="5">Pelimpahan</th>
                    <th colspan="5">Penerimaan 501</th>
                    <th rowspan="2">Status Limpah</th>
                </tr>
                <tr>
                    <th width='10%' class='mid'>No. Rekening<br>Nama Rekening</th>
                    <th width='10%' class='mid'>No. Sakti</th>
                    <th width='20%' class='mid'>Nilai</th>
                    <th width='10%' class='mid'>Akun</th>
                    <th width='10%' class='mid'>Kode KPPN </th>
                    <th width='10%' class='mid'>No. Rekening<br>Nama Rekening</th>
                    <th width='10%' class='mid'>No. Sakti</th>
                    <th width='20%' class='mid'>Nilai</th>
                    <th width='10%' class='mid'>Akun</th>
                    <th width='10%' class='mid'>Kode KPPN </th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
<?php
$no = 1;
//var_dump($this->data);
if (isset($this->data)) {
    if (empty($this->data)) {
        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
    } else {
        foreach ($this->data as $value) {
            echo "<tr>	";
            echo "<td>" . $no++ . "</td>";
            echo "<td class='ratakiri'>" . $value->get_norek_persepsi() . "<br>" . $value->get_nmrek_persepsi() . "</td>";
            echo "<td>" . $value->get_nosakti_limpah . "</td>";
            echo "<td class='ratakanan'> " . $value->get_jml_terima()  . "</td>";
            echo "<td> " . $value->get_akun_terima() . " </td>";
            echo "<td> " . $value->get_kppn_anak() . " </td>";
            echo "<td>" . $value->get_norek_501() . "<br>" . $value->get_nmrek_501() . "</td>";
            echo "<td>" . $value->get_nosakti_bs . "</td>";
            echo "<td class='ratakanan'> " . $value->get_jml_limpah()  . "</td>";
            echo "<td> " . $value->get_akun_limpah() . " </td>";
            echo "<td> " . $value->get_kppn_induk() . " </td>";
            echo "<td>" .$value->get_status() . "</td>";
            echo "</tr>	";
        }
    }
} else {
    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
}
?>
            </tbody>
        </table>
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
            
            <form id="filter-form" method="POST" action="monitoringPelimpahan" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <?php if (count($this->kppn_anak)>1){ ?>
					<div id="wkppn_anak" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">KPPN Anak: </label>
                    <select class="form-control" type="text" name="kppn_anak" id="kppn_anak">                        
						<option value='SEMUA' <?php if ($this->d_status == 'SEMUA') {echo "selected";} ?>>SEMUA</option>
						<?php
                            foreach ($this->kppn_anak as $value2) {
                                if ($this->d_kppn_anak == $value2->get_kd_d_kppn()) {
                                    echo "<option value='" . $value2->get_kd_d_kppn() . "' selected>" . $value2->get_kd_d_kppn() . " | " . $value2->get_nama_user() . "</option>";
                                } else {
                                    echo "<option value='" . $value2->get_kd_d_kppn() . "'>" . $value2->get_kd_d_kppn() . " | " . $value2->get_nama_user() . "</option>";
                                }
                            }
                            ?>
                    </select>  
				<?php }?>
					
					<?php if (isset($this->kppn_induk)) { ?>
                    <br/>
					<div id="wkppn_induk" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">KPPN Induk: </label>
                    <select class="form-control" type="text" name="kppn_induk" id="kppn_induk">
                        <option value='SEMUA' <?php if ($this->d_status == 'SEMUA') {echo "selected";} ?>>SEMUA</option><?php
                            foreach ($this->kppn_induk as $value3) {
                                if ($this->d_kppn_induk == $value3->get_kd_d_kppn()) {
                                    echo "<option value='" . $value3->get_kd_d_kppn() . "' selected>" . $value3->get_kd_d_kppn() . " | " . $value3->get_nama_user() . "</option>";
                                } else {
                                    echo "<option value='" . $value3->get_kd_d_kppn() . "'>" . $value3->get_kd_d_kppn() . " | " . $value3->get_nama_user() . "</option>";
                                }
                            }
                            ?>
                    </select>  
					<?php } ?>

                    <div id="wstatus" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Status: </label>
                    <select class="form-control" type="text" name="status" id="status">
                        <option value=''>- pilih -</option>
                        <option value='RECONCILED' <?php if ($this->d_status == 'RECONCILED') {echo "selected";} ?>>RECONCILED</option>
                        <option value='UNRECONCILED' <?php if ($this->d_status == 'UNRECONCILED') {echo "selected";} ?>>UNRECONCILED</option>
                        <option value='SEMUA' <?php if ($this->d_status == 'SEMUA') {echo "selected";} ?>>SEMUA</option>
                    </select>                    
                    <br/>
                    <div id="wtgl" class="error"></div>
                    <label class="isian">Tanggal Pelimpahan: </label>
                    
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>
                        

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
        $('.error').fadeOut(0);
    }

    function hideWarning() {

        $('#status').change(function() {
            if (document.getElementById('status').value != '') {
                $('#wstatus').fadeOut(200);
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
        var pattern = '^[0-9]+$';
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_tglawal == '' && v_tglakhir == '') {
            $('#wbayar').html('Harap isi tanggal');
            $('#wbayar').fadeIn();
            $('#wtgl').html('Harap isi tanggal');
            $('#wtgl').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }

</script>