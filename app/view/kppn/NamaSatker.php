<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Daftar SP2D Per Satker</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  

			if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {
			//-----------------------------
				IF(isset($this->d_nama_kppn) || isset($this->d_kd_satker) || isset($this->d_nm_satker) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)){
					
					if (isset($this->d_nama_kppn)) {
						foreach ($this->d_nama_kppn as $kppn) {
							$kdkppn = $kppn->get_kd_satker();
						  }
					} else {
						$kdkppn = 'null';
					}
					if (isset($this->d_kd_satker)) {
						$kdsatker = $this->d_kd_satker;
					} else {
						$kdsatker = 'null';
					}
					
					if (isset($this->d_nm_satker)) {
						$nmsatker = $this->d_nm_satker;
					} else {
						$nmsatker = 'null';
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
					<div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/nmsatkerSP2D_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/nmsatkerSP2D_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/XLS">EXCEL</a></li>
                          </ul>
                    </div>
                    
					<?php
					}
				//------------------------------
				}
			if (Session::get('role') == KPPN) {
			//-----------------------------
				
				if (isset($this->d_nama_kppn)) {
					foreach ($this->d_nama_kppn as $kppn) {
						$kdkppn = $kppn->get_kd_satker();
					  }
				} else {
					$kdkppn = Session::get('id_user');
				}
				if (isset($this->d_kd_satker)) {
					$kdsatker = $this->d_kd_satker;
				} else {
					$kdsatker = 'null';
				}
				
				if (isset($this->d_nm_satker)) {
					$nmsatker = $this->d_nm_satker;
				} else {
					$nmsatker = 'null';
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
					
                <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/nmsatkerSP2D_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/nmsatkerSP2D_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $nmsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>
                
				<?php
				
				
			//------------------------------
			}
			//------------------------------

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
                    if (isset($this->d_kd_satker)) {
                        echo "<br>Satker : ".$this->d_kd_satker;
                    }
                    if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                        echo "<br>Tanggal : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
                        $tgl_filter = $this->d_tgl_awal . "/" . $this->d_tgl_akhir;
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
                    <th class="align-center">No.</th>
                    <th>Kode Satker</th>
                    <th>Nama Satker</th>
                    <th class="align-right">Total SP2D</th>
                    <!--th>KPPN</th-->
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo '<td colspan=12 align="center">Tidak ada data.</td>';
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td class='align-center'>" . $no++ . "</td>";
                            echo "<td><a href=" . URL . "dataSPM/daftarsp2d/" . $value->get_kdsatker() . "/" . $tgl_filter . " >" . $value->get_kdsatker() . "</a></td>";
                            //echo "<td>" . $value->get_kdsatker() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_nmsatker() . "</td>";
                            //echo "<td>" . $value->get_kppn() . "</td>";
                            echo "<td class='ratakanan'>" . $value->get_total_sp2d() . "</td>";
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

<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="nmsatker" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="winvoice" class="alert alert-danger" style="display:none;"></div>

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
                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->d_kd_satker)) {
    echo $this->d_kd_satker;
} ?>">
                    <!--br/>
                    <label class="isian">Nama Satker: </label>
                    <input class="form-control" type="text" name="nmsatker" id="nmsatker" value="<?php //if (isset($this->nmsatker)){echo $this->nmsatker;} ?>"-->
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal: </label>
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
    
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy'
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