<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail Realisasi</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <!--pdf-->
                <!--karena gak ada button filter, button pdf tak pindah ke kanan ya-->
				                 
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
            
                <?php
			//-----------------------------------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : realisasiFA.php  
				if (isset($this->data)) {
					foreach ($this->data as $value) {
						$code_id=$value->get_code_id();						
					}
				}
				?>
					
                <a href="<?php echo URL; ?>PDF/DetailRealisasiFA_PDF/<?php echo $code_id; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
				</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                <a href="<?php echo URL; ?>PDF/DetailRealisasiFA_PDF/<?php echo $code_id; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
				<?php
			//--------------------------------------------------------
			?>  

                
                <!--button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button-->
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                &nbsp;
                <?php /*
                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                            $kode_kppn = $kppn->get_kd_satker();
                        }
                    } */
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server):<br/>" . $last_update->get_last_update() . " WIB";
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
        <th>No.</th>
        <th>Nomor Invoice</th>
        <th>Tanggal Invoice</th>
        <th>Status Invoice</th>
        <th>Nomor SP2D</th>
        <th>Tanggal SP2D</th>
        <th>Nilai Realisasi</th>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            $tot_pot = 0;

            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=12 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $value->get_invoice_num() . "</td>";
                        //echo "<td>" . $value->get_status() . "</td>";
                        echo "<td>" . $value->get_invoice_date() . "</td>";
                        echo "<td>" . $value->get_status() . "</td>";
                        echo "<td>" . $value->get_check_number() . "</td>";
                        echo "<td>" . $value->get_check_date() . "</td>";
                        echo "<td align='right'>" . number_format($value->get_amount()) . "</td>";

                        echo "</tr>	";
                        $tot_pot = $tot_pot + $value->get_amount();
                    }
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan='5'></td>
                <td class='ratatengah'><b>GRAND TOTAL</td>
                <td align='right'><b><?php echo number_format($tot_pot); ?>
                </td>

            </tr>
        </tfoot>
    </table>
</div>

<!--Filter-->
<!--Skrip-->
<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.alert').fadeOut(0);
    }

    function hideWarning() {
        $('#status').change(function() {
            if (document.getElementById('status').value != '') {
                $('#wstatus').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var v_status = document.getElementById('status').value;

        var jml = 0;
        if (v_status == '') {
            $('#wstatus').html('Harap pilih');
            $('#wstatus').fadeIn();
            jml++;
        }
        if (jml > 0) {
            return false;
        }
    }
</script>
<div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <b>Keterangan : </b></br>
                Data Merupakan Invoice Yang di Proses Dengan Aplikasi SPAN 
            </div>
            
        </div>
    </div>
</div>