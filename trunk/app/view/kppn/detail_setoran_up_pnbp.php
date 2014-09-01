<!-- A beautiful app starts with a beautiful code :) -->

<!-- /dataPelimpahan/monitoringPelimpahan -->

<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Form Pengawasan PNBP - Setoran UP/TUP PNBP</h2>
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
    <table class="regtable">
        
        <!--baris pertama-->
        <thead>
            
            <tr>
                <th class="align-center">No.</th>
                <th class="align-center">NTPN</th>
                <th class="align-center">Kode Satker</th>
                <th class="align-center">KPPN</th>
                <th class="align-center">Tanggal</th>
                <th class="align-center">Akun</th>
                <th  class="align-right">Jumlah</th>
                <!--th>Usulan Revisi</th>
                <!--th>Tanggal</th-->
            </tr>
            
        </thead>
        <tbody class='ratatengah'>
            <?php
            $no = 1;
            $total = 0;

            //var_dump ($this->data);
            if (isset($this->data)) {
                if (empty($this->data)) {
                    echo '<tr><td colspan=14 class="align-center">Tidak ada data.</td></tr>';;
                } else {
                    foreach ($this->data as $value) {
                        echo "<tr>	";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $value->get_ntpn() . "</td>";
                        echo "<td>" . $value->get_satker_code() . "</td>";
                        echo "<td>" . $value->get_kppn_code() . "</td>";
                        echo "<td>" . $value->get_tanggal() . "</td>";
                        echo "<td>" . $value->get_account_code() . "</td>";
                        //echo "<td>" . $value->get_revision_no() . "</td>";
                        echo "<td align='right'>" . number_format($value->get_line_amount()) . "</td>";
                        //echo "<td>" . $value->get_last_update_date(). "</td>";
                        $total = $total + $value->get_line_amount;
                    }
                }
            } else {
                echo '<tr><td colspan=14 class="align-center" id="filter-first">Silahkan masukkan filer terlebih dahulu.</td></tr>';
            }
            ?>
        </tbody>
        <tfoot>
                <tr>
                    <td colspan='5'></td>
                    <td class='ratatengah'><b>GRAND TOTAL</td>
                    <td align='right'><b><?php echo number_format($total); ?>
                    </td>

                </tr>
            </tfoot>
        
    </table>
</div>

