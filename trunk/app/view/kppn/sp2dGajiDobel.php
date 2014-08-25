<div id="top">
    <div id="header">
        <h2>MONITORING SP2D Gaji Terindikasi  Dobel 
            <?php
            if (isset($this->d_nama_kppn)) {
                foreach ($this->d_nama_kppn as $kppn) {
                    echo "<br>" . $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                    $kode_kppn = $kppn->get_kd_satker();
                }
            }
            ?>
            <?php
            if (isset($this->d_bank)) {
                if ($this->d_bank == 13) {
                    echo "<br> Semua Bank";
                } else {
                    echo "<br>" . $this->d_bank;
                }
            }
            ?>
            <br>
        </h2>
    </div>
    <?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : sp2dGajiDobel.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------
    
if (isset($this->d_bank)){
	   $kdkppn = Session::get('id_user');

    if (isset($this->d_bank)) {
        $kdbulan = $this->d_bank;
    }else{
		$kdbulan='null';
	}
    ?>

    <a href="<?php echo URL; ?>PDF/sp2dGajiDobel_PDF/<?php echo $kdbulan . "/" . $kdkppn; ?>" class="modal">PDF</a>

    <?php
 

}

    //----------------------------------------------------		
    ?>

    <a href="#bModal" class="modal">FILTER DATA</a><br><br>
    <div id="bModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
    $_SERVER['PHP_SELF'];
    ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>

            <div id="top">

                <form method="POST" action="sp2dGajiDobel" enctype="multipart/form-data">

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
<?php } ?>

                    <div id="wbulan" class="error"></div>
                    <label class="isian">Bulan: </label>
                    <select type="text" name="bulan" id="bulan">
                        <option value=''>- pilih -</option>
                        <option value='JANUARI' <?php if ($this->d_bank == JANUARI) {
    echo "selected";
} ?>>Januari</option>
                        <option value='FEBRUARI' <?php if ($this->d_bank == FEBRUARI) {
    echo "selected";
} ?>>Pebruari</option>
                        <option value='MARET' <?php if ($this->d_bank == MARET) {
    echo "selected";
} ?>>Maret</option>
                        <option value='APRIL' <?php if ($this->d_bank == APRIL) {
    echo "selected";
} ?>>April</option>
                        <option value='MEI' <?php if ($this->d_bank == MEI) {
    echo "selected";
} ?>>Mei</option>
                        <option value='JUNI' <?php if ($this->d_bank == JUNI) {
    echo "selected";
} ?>>Juni</option>
                        <option value='JULI' <?php if ($this->d_bank == JULI) {
    echo "selected";
} ?>>Juli</option>
                        <option value='AGUSTUS' <?php if ($this->d_bank == AGUSTUS) {
        echo "selected";
    } ?>>Agustus</option>
                        <option value='SEPTEMBER' <?php if ($this->d_bank == SEPTEMBER) {
        echo "selected";
    } ?>>Sepetember</option>
                        <option value='OKTOBER' <?php if ($this->d_bank == OKTOBER) {
        echo "selected";
    } ?>>Oktober</option>
                        <option value='NOVEMBER' <?php if ($this->d_bank == NOVEMBER) {
        echo "selected";
    } ?>>Nopember</option>
                        <option value='DESEMBER' <?php if ($this->d_bank == DESEMBER) {
        echo "selected";
    } ?>>Desember</option>
                        <option value='13' <?php if ($this->d_bank == 13) {
        echo "selected";
    } ?>>Semua Bulan</option>
                    </select>

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>

                <?php
// untuk menampilkan last_update
                if (isset($this->last_update)) {
                    foreach ($this->last_update as $last_update) {
                        echo "<td>Update Data Terakhir (Waktu Server) = " . $last_update->get_last_update() . " WIB </td>";
                    }
                }
                ?>

    <div id="fitur">
        <table width="100%" class="table table-bordered zebra" id='fixheader'>
            <!--baris pertama-->
            <thead>
            <th>No.</th>
            <th>Kode Satker</th>
            <th>No. Invoice</th>
            <th>No. SP2D</th>
            <th>Deskripsi</th>

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
            echo "<td>" . $value->get_kdsatker() . "</td>";
            echo "<td>" . $value->get_invoice_num() . "</td>";
            echo "<td>" . $value->get_check_number() . "</td>";
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
</div>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
                            $(function() {
                                hideErrorId();
                                hideWarning();
                            });

                            function hideErrorId() {
                                $('.error').fadeOut(0);
                            }

                            function hideWarning() {
                                $('#bulan').keyup(function() {
                                    if (document.getElementById('bulan').value != '') {
                                        $('#bulan').fadeOut(200);
                                    }
                                });

                            }

                            function cek_upload() {
                                var v_bulan = document.getElementById('bulan').value;
                                var jml = 0;

                                if (v_bulan == '') {
                                    $('#wbulan').html('Harap pilih bulan');
                                    $('#wbulan').fadeIn();
                                    jml++;
                                }

                                if (jml > 0) {
                                    return false;
                                }
                            }

                            $(document).ready(function() {
                                var oTable = $('#fixheader').dataTable({
                                    "sScrollY": 400,
                                    "sScrollX": "100%",
                                    "sScrollXInner": "100%",
                                    "bSort": false,
                                    "bPaginate": false,
                                    "bInfo": null,
                                    "bFilter": false,
                                    "oLanguage": {
                                        "sEmptyTable": "Tidak ada data di dalam tabel ini."

                                    },
                                });

                                var keys = new KeyTable({
                                    "table": document.getElementById('fixheader'),
                                    "datatable": oTable
                                });
                            });
</script>