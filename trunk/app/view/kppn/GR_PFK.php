<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <?php $akun = '';

                foreach ($this->data as $value) {
                    $akun = $value->get_akun();
                    } ?>
                <h2>Monitoring PFK Akun <?php echo $akun ?></h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                

            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

			<?php
			//----------------------------------------------------
			//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  

			if (isset($this->d_nm_kdkppn)) {
				$kdkppn =$this->d_nm_kdkppn;
			}else{
				$kdkppn =Session::get('id_user');
			}			
			if (isset($this->bulan)) {
				$kdbulan =$this->bulan;
			}else{
				$kdbulan ='null';
			}
			if (isset($this->d_tgl)) {
				$kdakun =$this->d_tgl;					
			}else{
				$kdakun ='null';	
			}
			?>
                <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/GR_PFK_DETAIL1_PDF/<?php echo $kdakun . "/" . $kdbulan . "/" . $kdkppn; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/GR_PFK_DETAIL1_PDF/<?php echo $kdakun . "/" . $kdbulan . "/" . $kdkppn; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>
			
			<?php
			//----------------------------------------------------		
			?>

            </div>
        </div>

        <div class="row" style="padding-top: 10px">

            <div class="col-md-6 col-sm-12">
<?php
/*$akun = '';

foreach ($this->data as $value) {
    $akun = $value->get_akun();
}
echo "AKUN " .$akun ." " ; */
if (isset($this->d_nama_kppn)) {
    foreach ($this->d_nama_kppn as $kppn) {
        echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
    }
}

echo " Bulan " .Tanggal::bulan_indo($this->bulan);
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
                <th>Sumber Transaksi</th>
                <th>Nama wajib Bayar setor</th>
                <th>Tanggal Buku</th>
                <th>Tanggal Bayar</th>
                <th>NTPN/SP2D</th>
                <th>Rupiah</th>
            </tr>
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
            echo "<td>" . $value->get_keterangan() . "</td>";
            echo "<td>" . $value->get_nama_wajib_bayar_setor() . "</td>";
            echo "<td>" . $value->get_tanggal_buku() . "</td>";
            echo "<td>" . $value->get_tanggal_bayar() . "</td>";
            echo "<td>" . $value->get_ntpn() . "</td>";
            echo "<td align='right'>" . number_format($value->get_rupiah()) . "</td>";
            echo "</tr>	";
            $tot_pot = $tot_pot + $value->get_rupiah();
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

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>

            <form id="filter-form" method="POST" action="sp2dRekap" enctype="multipart/form-data">

                <div class="modal-body">

                    <!-- Paste Isi Fom mulai nangkene -->
<?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
                        <label class="isian">Kode KPPN: </label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                            <select class="form-control" type="text" name="kdkppn" id="kdkppn">
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
                        </div>
<?php } ?>
                    <br/>
                    <div id="wtgl" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">Tanggal: </label>

                    <div class="input-daterange input-group" id="datepicker" style="width: 100%">
                        <input class="form-control" type="text" class="tanggal" name="tgl_awal" id="tgl_awal" value="<?php if (isset($this->d_tgl_awal)) {
    echo $this->d_tgl_awal;
} ?>">
                        <span class="input-group-addon">s.d.</span>
                        <input class="form-control" type="text" class="tanggal" name="tgl_akhir" id="tgl_akhir" value="<?php if (isset($this->d_tgl_akhir)) {
    echo $this->d_tgl_akhir;
} ?>">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>