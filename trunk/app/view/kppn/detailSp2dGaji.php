<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail SP2D Gaji <?php echo $this->d_bank . " " . Tanggal::bulan_indo($this->d_bulan); ?></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : detailSp2dGaji.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------

if( isset($this->d_bank) || isset($this->d_bulan)){
	if(isset($this->d_nama_kppn)){
		foreach ($this->d_nama_kppn as $kppn) {
			$kdkppn = $kppn->get_kd_satker();
		  }
		} else {
			$kdkppn = Session::get('id_user');
		}

    if (isset($this->d_bank)) {
        $kdbank = $this->d_bank;
    }
    if (isset($this->d_bulan)) {
        $kdbulan = $this->d_bulan;
    }
    ?>

    <a href="<?php echo URL; ?>PDF/detailSp2dGaji_PDF/<?php echo $kdbank . "/" . $kdbulan . "/" . $kdkppn; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

    <?php
    //----------------------------------------------------		

}
    ?>
                
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <!-- button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button -->
                
            </div>
        </div>
        
        <div class="row" style="padding-top: 10px">
            
            <div class="col-md-6 col-sm-12">
                <?php if (isset($this->d_nama_kppn)) {
                        foreach($this->d_nama_kppn as $kppn){
                            echo $kppn->get_nama_user()." (".$kppn->get_kd_satker().")"; 
                            $kode_kppn=$kppn->get_kd_satker();
                        }
                    }?>
                    <?php if (isset($this->d_bank)) {
                            if($this->d_bank=="MDRI"){
                                echo "Mandiri" ;
                            }elseif($this->d_bank=="5"){
                                echo "Semua Bank" ;
                            } else {
                                echo "".$this->d_bank;
                            }
                    }
                    ?>
                    <?php if (isset($this->d_tgl_awal) && isset($this->d_tgl_akhir)) {
                            echo $this->d_tgl_awal." s.d ".$this->d_tgl_akhir;
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
            <th>No.</th>
            <th width='100px'>Tgl Selesai SP2D</th>
            <th>Tgl SP2D</th>
            <th>No. SP2D</th>
            <!--th>Status</th-->

            <!--th>No. Transaksi</th-->
            <th>No. Invoice</th>
            <th>Jumlah Rp</th>
            <th>Nama Bank</th>
            <th width='400px'>Deskripsi</th>

            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_creation_date() . "</td>";
                            echo "<td>" . $value->get_payment_date() . "</td>";
                            echo "<td>" . $value->get_check_number() . "</td>";
                            //echo "<td>" . $value->get_return_code() . "</td>";
                            //echo "<td>" . $value->get_check_number_line_num() . "</td>";
                            echo "<td>" . $value->get_invoice_num() . "</td>";
                            echo "<td class='ratakanan'>" . $value->get_check_amount() . "</td>";
                            echo "<td>" . $value->get_bank_account_name() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
    </table>
</div>