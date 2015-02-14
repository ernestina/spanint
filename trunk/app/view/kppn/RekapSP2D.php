<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Rekap Penerbitan SP2D</h2>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                <!--pdf-->
				<?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  

if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {
//-----------------------------
	
	if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
		  }
	} else {
		$kdkppn = 'null';
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
	
}
//------------------------------


if (Session::get('role') == SATKER) {
//-----------------------------
	
	if (isset($this->d_nama_kppn)) {
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
		  }
	} else {
		$kdkppn = 'null';
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
	
}

?>
    <a href="<?php echo URL; ?>PDF/RekapSp2d_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
    </div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
    <a href="<?php echo URL; ?>PDF/RekapSp2d_PDF/<?php echo $kdkppn . "/" . $kdtgl_awal . "/" . $kdtgl_akhir; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
	<?php
//------------------------------

?>                
                
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
                        if (Session::get('role') == KPPN) {
                            echo Session::get('user');
                        } elseif (Session::get('role') == ADMIN) {
                            echo "Semua KPPN";
                        }
                    }


                    if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                        echo "<br> Periode : " . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
                    } else {
                        echo "<br> Periode : s.d " . date("d-m-Y");
                    }
                    ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) :<br> " . $last_update->get_last_update() . " WIB";
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
                <th>No.</th>
                <th>Jenis SPM</th>
                <!--th>Jenis SP2D</th-->
                <th>Total Nilai</th>
                <th>Total SP2D</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $jum_sp2d;

            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=12 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $value->get_attribute6() . "</td>";
                        //echo "<td>" . $value->get_jenis_sp2d() . "</td>";
                        echo "<td align='right'>" . number_format($value->get_total_sp2d()) . "</td>";
                        //echo "<td>" . $value->get_jumlah_sp2d() . "</td>";

                        if (isset($_POST['kdkppn'])) {
                            $kppn = $_POST['kdkppn'];
                        } 
						if  (Session::get('role') == KPPN) {
							 $kppn = Session::get('id_user');
						}
						
                        echo "<td td align='right'><a href=" . URL . "dataSPM/detailrekapsp2d/" . $value->get_jendok() . "/" . $kppn . "/" . $_POST['tgl_awal'] . "/" . $_POST['tgl_akhir'] . ">" . number_format($value->get_jumlah_sp2d()) . "</td>";

                        echo "</tr>	";
                        $jum_sp2d = $jum_sp2d + $value->get_jumlah_sp2d();
                    }
                }
            } else {
                echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan='2'></td>
                <td class='ratatengah'><b>GRAND TOTAL</td>
                <td align='right'><b><?php echo number_format($jum_sp2d); ?>
                </td>

            </tr>
        </tfoot>
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
            
            <form id="filter-form" method="POST" action="RekapSp2d" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select class="form-control" type="text" name="kdkppn" id="kdkppn">
                            <option value='' selected>- Semua KPPN-</option>
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
<?php }
?>

                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal: </label>
                    
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>

                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="">Kirim</button>
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

    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });

    function hideErrorId() {
        $('.alert').fadeOut(0);
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