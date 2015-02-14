<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Status LHP Interface</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
            
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
                <!-- PDF -->
				<?php
				//---------------------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
				if (Session::get('role') == ADMIN || Session::get('role') == KANWIL) {
					$kdkppn = $this->kppn;
					if (isset($this->d_tgl)) {
						$kdtgl = $this->d_tgl;
					}
				}
				if (Session::get('role') == KPPN) {
					$kdkppn = Session::get('id_user');
					if (isset($this->d_tgl)) {
						$kdtgl = $this->d_tgl;
					}
				}
				?>
					<a href="<?php echo URL; ?>PDF/detailLhpRekap_PDF/<?php echo $kdtgl . "/" . $kdkppn; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
					</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
					<a href="<?php echo URL; ?>PDF/detailLhpRekap_PDF/<?php echo $kdtgl . "/" . $kdkppn; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
					<?php

				//-------------------
 			?>
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <!-- Subtitle -->
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

<!-- Blok Tabel -->
<div id="table-container" class="wrapper">
    <table width="100%" class="footable">
        
        <!--baris pertama-->
        <thead>
            <tr>
                <th>No.</th>
                <th>Status File</th>
                <th>Tanggal Penerimaan</th>
                <th>Kode Bank</th>
                <th>Nomor Rekening Persepsi</th>
                <th>Jumlah Rupiah</th>
                <th>Nomor Batch</th>
                <th>Nama File</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
			$total = 0;
            foreach ($this->data as $value) {
                echo "<tr>	";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $value->get_status() . "</td>";
                echo "<td>" . $value->get_gl_date() . "</td>";
                echo "<td>" . $value->get_bank_code() . "</td>";
                echo "<td>" . $value->get_bank_account_num() . "</td>";
                echo "<td class='ratakanan'>" . number_format($value->get_keterangan()) . "</td>";
                echo "<td>" . $value->get_gr_batch_num() . "</td>";
                echo "<td class='ratakiri'><a href=" . URL . "dataGR/detailPenerimaan/" . $value->get_file_name() . "/".$this->kppn." >" . $value->get_file_name() . "</a></td>";
                if ($value->get_status() == 'Validated') {
                    echo "<td>Lakukan interface ulang</td>";
                } else if ($value->get_status() == 'Error') {
                    echo "<td>Cek File dan Upload Ulang</td>";
                } else {
                    echo "<td></td>";
                }
                echo "</tr>	";
				$total = $total + $value->get_keterangan();
				
            }
            ?>
			<tr>
                <td colspan='5' class='ratatengah'><b>GRAND TOTAL<b></td>
				<td class='ratakanan'><b><?php echo number_format($total); ?><b></td>
				<td class='ratatengah'></td>
				<td class='ratatengah'></td>
				<td class='ratatengah'></td>
			</tr>
        </tbody>
        
    </table>
</div>