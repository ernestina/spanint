<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Histori Invoice</h2>
            </div>
                        
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
		<?php
		//----------------------------------------------------
		//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  
		if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {
			if (isset($this->d_nama_kppn)) {
				foreach ($this->d_nama_kppn as $kppn) {
					$kdkppn = $kppn->get_kd_satker();
				}
			} else {
				$kdkppn = 'null';
			}
			if (isset($this->invoice_num)) {
				$invoice = $this->invoice_num;
			} else {
				$invoice = 'null';
			}
			
		}
		
		if (Session::get('role') == KPPN) {				
			$kdkppn=Session::get('id_user');
			if (isset($this->invoice_num)) {
				$invoice = $this->invoice_num;
			} else {
				$invoice = 'null';
			}
			
			
		}
		 if (Session::get('role') == SATKER) {
			$kdkppn=Session::get('id_user');
			if (isset($this->invoice_num)) {
				$invoice = $this->invoice_num;
			} else {
				$invoice = 'null';
			}
			
			
		}
		?>
			
            <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/HistorySpm_PDF/<?php echo $invoice . "/" . $sp2d . "/" . $kdkppn; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/HistorySpm_PDF/<?php echo $invoice . "/" . $sp2d . "/" . $kdkppn; ?>/XLS">EXCEL</a></li>
                          </ul>
            </div>
                
			<?php
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
                        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                        $kode_kppn = $kppn->get_kd_satker();
                    }
                }
                if (isset($this->invoice_num)) {
                    echo "<br>No. Invoice : ".$this->invoice_num;
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
                <th>Nomor Invoce</th>
                <th>Reponse</th>
                <th>Nama User</th>
                <!--th>Posisi</th-->
                <th>Waktu Mulai</th>
                <th>Nomor SP2D</th>
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
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $value->get_invoice_num() . "</td>";
                        echo "<td>" . $value->get_response() . "</td>";
                        echo "<td>" . $value->get_user_name() . "</td>";
                        //echo "<td>" . $value->get_posisi() . "</td>";
                        echo "<td>" . $value->get_creation_date() . "</td>";
                        echo "<td>" . $value->get_check_number() . "</td>";

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
            
            <form id="filter-form" method="POST" action="HistorySpm" enctype="multipart/form-data">

                <div class="modal-body">

                    <div id="winvoice" class="alert alert-danger" style="display:none"></div>

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

                    <br/>
                    <label class="isian">No Invoice: </label>
                    <input class="form-control" type="text" name="invoice" id="invoice" value="<?php if (isset($this->d_invoice)) {
    echo $this->d_invoice;
} ?>">


                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->
                        

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
        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_invoice = document.getElementById('invoice').value;

        var jml = 0;
        if (v_invoice == '') {
            $('#winvoice').html('Harap isi nomor invoice.');
            $('#winvoice').fadeIn();
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>