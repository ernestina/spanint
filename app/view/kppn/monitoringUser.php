<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Pergantian User</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
<?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : monitoringUser.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------

	if( isset($this->d_kd_kppn) || isset($this->d_nip)
	
	){
	
		 if (isset($this->d_kd_kppn)) {
			$kdkppn = $this->d_kd_kppn;
		} else {
			$kdkppn = Session::get('id_user');
		}
		if (isset($this->d_nip)) {
			$kdnip = $this->d_nip;
		}
    ?>

    <a href="<?php echo URL; ?>PDF/monitoringUserSpan_PDF/<?php echo $kdkppn . "/" . $kdnip; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
    <?php
    //----------------------------------------------------		
	}
   
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

<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            
            <tr>
                <th>No.</th>
                <!--th>KPPN</th-->
                <th>Nama</th>
                <th>User Name</th>
                <th>NIP</th>
                <th>Posisi</th>
                <!--th>Responsibility Name</th-->
                <th>Email Depkeu</th>
                <th>Tanggal Mulai Aktif</th>
                <th>Tanggal Berakhir</th>
            </tr>

        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=8 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        //echo "<td>" . $value->get_kdkppn() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_last_name() . "</td>";
                        echo "<td>" . $value->get_user_name() . "</td>";
                        echo "<td>" . $value->get_attribute1() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_name() . "</td>";
                        //echo "<td>" . $value->get_responsibility_name() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_email_address() . "</td>";
                        echo "<td>" . $value->get_start_date() . "</td>";
                        echo "<td>" . $value->get_end_date() . "</td>";
                        echo "</tr>	";
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
            
            <form id="filter-form" method="POST" action="monitoringUserSpan" enctype="multipart/form-data">

                <div class="modal-body">

                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
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
                    <div id="wnip" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">NIP: </label>
                    <input class="form-control" type="number" name="nip" id="nip" size="18" value="<?php if (isset($this->d_nip)) {
    echo $this->d_nip;
} ?>">
                        

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
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#nip').keyup(function() {
            if (document.getElementById('nip').value != '') {
                $('#wnip').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_nip = document.getElementById('nip').value;

        var jml = 0;


        if (jml > 0) {
            return false;
        }
    }

</script>