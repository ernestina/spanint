<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataPelimpahan/monitoringPelimpahan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Form Pengawasan PNBP - UP PNBP</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <button type="button" class="btn btn-default fullwidth" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                
            </div>
        </div>
        
        <div class="row top-padded-little">
            
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
            
            <div class="col-md-6 col-sm-12 align-right">
                <?php

                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "Update Data Terakhir (Waktu Server) : " . $last_update->get_last_update() . " WIB";
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
                <th class="align-center">No.</th>
                <th class="align-center">Kode Satker</th>
                <th class="align-center">Jendok</th>
                <th class="align-center">Jenis SPM</th>
                <th class="align-center">Nomor Invoice</th>
                <th class="align-center">Tanggal Invoice</th>
                <th>Deskripsi</th>
                <th class="align-center">Nomor Sp2d</th>
                <th class="align-center">Tanggal Sp2d</th>
                <th class="align-right">Jumlah</th>
                <!--th>Usulan Revisi</th>
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
                    echo '<tr><td colspan=10 class="align-center">Tidak ada data.</td></tr>';
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $value->get_satker_code() . "</td>";
                        echo "<td>" . $value->get_jendok() . "</td>";
                        echo "<td>" . $value->get_jenis_spm() . "</td>";
                        echo "<td>" . $value->get_invoice_num() . "</td>";
                        echo "<td>" . $value->get_tanggal() . "</td>";
                        echo "<td class='align-left'>" . $value->get_description() . "</td>";
                        echo "<td>" . $value->get_check_num() . "</td>";
                        echo "<td>" . $value->get_tanggal_sp2d() . "</td>";
                        echo "<td align='right'>" . number_format($value->get_line_amount()) . "</td>";
                        //echo "<td>" . $value->get_last_update_date(). "</td>";
                        echo "</tr>";
                        $total = $total + $value->get_line_amount();
                    }
                }
            } else {
                echo '<tr><td colspan=10 class="align-center" id="filter-first">Silahkan masukkan filer terlebih dahulu.</td></tr>';
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan='9' class='ratatengah'><b>GRAND TOTAL</b></td>
                <td align='right'><b><?php echo number_format($total); ?></b></td>
            </tr>
        </tfoot>
    </table>
</div>

