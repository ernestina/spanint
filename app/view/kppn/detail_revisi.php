<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Daftar Akun yang dikunci karena Proses Revisi</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
            
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                <?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : posisiSPM.php  

           if(isset($this->d_kdsatker)){
                $kdkppn = Session::get('id_user');
                if (isset($this->d_kdsatker)) {
                    $kdsatker = $this->d_kdsatker;
                }
                ?>
                
                <a href="<?php echo URL; ?>PDF/DetailRevisi_PDF/<?php echo $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
            <?php
            //----------------------------------------------------		

           }

            ?>
                
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
                if (isset($this->satker_code)) {
                    echo "<br>Satker : " . $this->satker_code;
                }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-12" style="text-align: right;">
                <?php
                    // untuk menampilkan last_update
                    if (isset($this->last_update)) {
                        foreach ($this->last_update as $last_update) {
                            echo "Update Data Terakhir (Waktu Server) :</br>" . $last_update->get_last_update() . " WIB";
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
                <th>Kode Satker</th>
                <th>KPPN</th>
                <th>Dana</th>
                <th>Program</th>
                <th>Output</th>
                <th>Akun</th>
                <th>Revisi Ke</th>
                <th>Usulan Revisi</th>
                <!--th>Tanggal</th-->
            </tr>

        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            $total;

            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada akun yang di lock.</div>";
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $value->get_satker_code() . "</td>";
                        echo "<td>" . $value->get_kppn() . "</td>";
                        echo "<td>" . $value->get_dana() . "</td>";
                        echo "<td>" . $value->get_program() . "</td>";
                        echo "<td>" . $value->get_output() . "</td>";
                        echo "<td>" . $value->get_akun() . "</td>";
                        echo "<td>" . $value->get_revision_no() . "</td>";
                        echo "<td align='right'>" . number_format($value->get_usulan_revisi()) . "</td>";
                        //echo "<td>" . $value->get_last_update_date(). "</td>";
                    }
                }
            } else {
                echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
            }
            ?>
        </tbody>
        
    </table>
</div>