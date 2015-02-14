
<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail CoA Penerimaan <br/></h2>
				<h3>NTPN: <?php echo $this->d_tgl; ?></h3>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">                
                <!-- PDF -->
			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

				$kdntpn=$this->d_tgl;
				?>
				<a href="<?php echo URL; ?>PDF/detailCoAPenerimaan_PDF/<?php echo $kdntpn; ?>/PDF" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
				</div><div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 10px;">
				<a href="<?php echo URL; ?>PDF/detailCoAPenerimaan_PDF/<?php echo $kdntpn; ?>/XLS" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print-xls"></span> XLS</a>
                
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


<!-- Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
        <!--baris pertama-->
        <thead>
            <tr>
                <th class='ratatengah'>No.</th>
                <th class='ratatengah'>NTPN</th>
                <th class='ratatengah'>Satker</th>
                <th class='ratatengah'>KPPN</th>
                <th class='ratatengah'>Akun</th>
                <th class='ratatengah'>Mata Uang</th>
                <th class='ratatengah'>Nilai</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            foreach ($this->data as $value) {
                echo "<tr>	";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $value->get_ntpn() . "</td>";
                echo "<td>" . $value->get_segment1() . "</td>";
                echo "<td>" . $value->get_segment2() . "</td>";
                echo "<td>" . $value->get_segment3() . "</td>";
				echo "<td>" . $value->get_mata_uang() . "</td>";
                echo "<td class='ratakanan'>" . number_format($value->get_amount()) . "</td>";
                echo "</tr>	";
            }
            ?>
        </tbody>
    </table>
</div>