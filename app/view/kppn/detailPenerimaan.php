<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Detail Penerimaan File: <?php echo $this->d_tgl; ?></h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <!-- PDF -->
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
            
                <!-- button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button -->
                
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
                <th>No.</th>
                <th>NTPN</th>
                <th>NTB</th>
                <th>Tanggal Penerimaan</th>
                <th>Kode Bank</th>
                <th>Nomor Rekening Persepsi</th>
                <th>Jumlah Rupiah</th>
                <th>Satker/KPPN/Akun</th>
            </tr>
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            foreach ($this->data as $value) {
                echo "<tr>	";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $value->get_status() . "</td>";
                echo "<td>" . $value->get_file_name() . "</td>";
                echo "<td>" . $value->get_gl_date() . "</td>";
                echo "<td>" . $value->get_bank_code() . "</td>";
                echo "<td>" . $value->get_bank_account_num() . "</td>";
                echo "<td class='ratakanan'>" . $value->get_keterangan() . "</td>";
                echo "<td>" . $value->get_resp_name() . "</td>";
                echo "</tr>	";
            }
            ?>
        </tbody>
    </table>
</div>