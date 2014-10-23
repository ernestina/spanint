<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail Rincian Pencadangan Dana</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <!-- PDF -->
                 <?php
			//-----------------------------------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : realisasiFA.php  
				if (isset($this->data)) { 
					foreach ($this->data as $value) {
						$code_id=$value->get_code_id();						
					}
				}
				?>
					<a href="<?php echo URL; ?>PDF/DetailEncumbrances_PDF/<?php echo $code_id; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
				<?php
			//--------------------------------------------------------
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
                    } else {
                        echo Session::get('user');
                    }


                    if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                        echo "<br>" . $this->d_tgl_awal . " s.d " . $this->d_tgl_akhir;
                    }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
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
                <th class='mid'>No.</th>
                <th class='ratakanan'>Nomor PO</th>
				<th class='ratakanan'>CAN</th>
				<th class='ratakanan'>Status</th>
				<th class='ratakanan'>TGL Approve</th>
				<th class='ratakanan'>Nomor Kontrak</th>
                <th class='ratakanan'>Uraian Kontrak</th>
				<th class='ratakanan'>Nilai Termin Ke-</th>
                <th class='ratakanan'>Nilai Termin</th>
                <th class='ratakanan'>Nilai Realisasi</th>
				<th class='ratakanan'>Nilai Sisa Encumbrance</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            $total;

            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=5 align="center">Tidak ada data.</td>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td class='mid'>" . $no++ . "</td>";
                        echo "<td class='mid'>" . $value->get_segment1() . "</td>";
                        echo "<td class='mid'>" . $value->get_attribute11() . "</td>";
                        echo "<td class='mid'>" . $value->get_status() . "</td>";
                        echo "<td class='mid'>" . $value->get_app_date() . "</td>";
                        echo "<td class='mid'>" . $value->get_attribute1() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_comments() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_description() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_encumbered_amount()) . "</td>";
                        echo "<td align='right'>" . number_format($value->get_billed_amount()) . "</td>";
                        echo "<td align='right'>" . number_format($value->get_sisa_encumbrence()) . "</td>";
                        $total = $total + $value->get_sisa_encumbrence();
                    }
				
                }
            } else {
                echo '<td colspan=5 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
            }
            ?>
        </tbody>
		<tfoot>
            <tr>
                <td colspan='9'></td>
                <td class='ratatengah'><b>GRAND TOTAL</td>
                <td align='right'><b><?php echo number_format($total); ?>
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
                        <div id="wkdkppn" class="error"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select type="text" name="kdkppn" id="kdkppn">
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
                    <br/>
<?php } ?>
                    
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal: </label>
                    
                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)){echo $this->d_tgl_awal;}?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)){echo $this->d_tgl_akhir;}?>">
                    </div>
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>