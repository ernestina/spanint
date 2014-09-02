<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail Data Pagu Minus Karena <i>Fund Fail</i></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <!--pdf-->
				<?php
<?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  
 if( isset($this->data) || isset($this->d_nama_kppn)){
	if (isset($this->data)) {
	foreach ($this->data as $value1) {
		$kdsatker=$value1->get_satker_code();
		$kdoutput=$value1->get_output_code();
		}
	}
	if (isset($this->d_nama_kppn)) {
		$kdkppn = $this->d_nama_kppn;
	 } else {
		$kdkppn = Session::get('id_user');
	 }

	?>
	    <a href="<?php echo URL; ?>PDF/Detail_Fund_fail_kd_PDF/<?php echo $kdsatker . "/" . $kdoutput. "/" . $kdkppn. "/" . $kdakun. "/" . $kf; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
<?php
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

<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <th class='mid'>No.</th>
            <!--th class='mid'>Tanggal Error</th-->
            <th class='mid'>Satker</th>
            <th>Kode KPPN</th>
            <th class='mid'>Akun</th>
            <th class='mid'>Program</th>
            <th class='mid'>Output</th>
            <th class='mid'>Dana</th>
            <!--th class='mid'>Description</th-->
            <th>Pagu Saat Ini</th>
            <th>Pagu Usulan Revisi</th>
            <th>Total Kontrak</th>
            <th>Blokir</th>
            <th>Realisasi</th>
            <th>Sisa/kurang</th>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<td colspan=12 align="center">Data Tidak ada karena akun sebelumnya menjadi hilang padahal sudah ada realisasi/kontrak .</td>';
                } else {
                    $tot_budget = 0;
                    $tot_encumbrance = 0;
                    $tot_actual = 0;
                    $tot_blokir = 0;
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        //echo "<td class='ratakiri'>" . $value->get_error_date() . "</td>";
                        echo "<td>" . $value->get_satker() . "</td>";
                        echo "<td>" . $value->get_kppn() . "</td>";
                        echo "<td>" . $value->get_akun() . "</td>";
                        echo "<td>" . $value->get_program() . "</td>";
                        echo "<td>" . $value->get_output() . "</td>";
                        echo "<td>" . $value->get_dana() . "</td>";
                        //echo "<td>" . $value->get_description() . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_budget_amt()) . "</td>";
                        echo "<td class='ratakanan'>  0 </td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_obligation()) . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_block_amount()) . "</td>";
                        echo "<td class='ratakanan'>" . number_format($value->get_actual_amt()) . "</td>";
                        echo "<td class='ratakanan'>" . number_format(0 - $value->get_obligation() - $value->get_block_amount() - $value->get_actual_amt()) . "</td>";
                        echo "</tr>	";
                        $tot_budget+=$value->get_budget_amt();
                        $tot_encumbrance+=$value->get_obligation();
                        $tot_blokir+=$value->get_block_amount();
                        $tot_actual+=$value->get_actual_amt();
                    }
                }
            }
            ?>
            <!--footernya ditaruh disini-->		
            <tr>
                <td colspan='7' class='ratatengah'><b>GRAND TOTAL<b></td>
                <td class='ratakanan'><b><?php echo number_format($tot_budget); ?></td>
				<td class='ratakanan'>0</td>
                <td class='ratakanan'><b><?php echo number_format($tot_encumbrance); ?></td>
                <td class='ratakanan'><b><?php echo number_format($tot_blokir); ?></td>
                <td class='ratakanan'><b><?php echo number_format($tot_actual); ?></td>
                <td class='ratakanan'><b><?php echo number_format(0 - $tot_encumbrance - $tot_blokir - $tot_actual); ?></td>
            </tr>
                <!--end footernya-->
        </tbody>
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
            
            <form id="filter-form" method="POST" action="#" enctype="multipart/form-data">

            <div class="modal-body">

                <!-- Paste Isi Fom mulai nangkene -->
                <div id="wakun" class="alert alert-danger" style="display:none;"></div>
                <label class="isian">Satker : </label>
                <input class="form-control" type="text" name="kd_satker" id="kd_satker">

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