<div id="top">
    <div id="header">
        <h2>MONITORING POSISI INVOICE 
            <?php
            if (isset($this->d_nama_kppn)) {
                foreach ($this->d_nama_kppn as $kppn) {
                    echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                    $kode_kppn = $kppn->get_kd_satker();
                }
            }
            ?>
        </h2>
    </div>
<?php if (Session::get('role') == ADMIN OR Session::get('role') == KANWIL) { ?>
        <a href="#oModal" class="modal">FILTER DATA</a><br><br>
        <div id="oModal" class="modalDialog" >
            <div>
                <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
                <a href="<?php
    $_SERVER['PHP_SELF'];
    ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
                </a>

                <div id="top">	

                    <form method="POST" action="posisiSpm" enctype="multipart/form-data">

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

                        <ul class="inline" style="margin-left: 150px">
                            <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                            <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return cek_upload();"></li>
                        </ul>
                    </form>

                </div>
            </div>
        </div>
    <?php } ?>
    <?php
    // untuk menampilkan last_update
    if (isset($this->last_update)) {
        foreach ($this->last_update as $last_update) {
            echo "Update Data Terakhir (Waktu Server)  "
            ?> <br/>
        <?php
        echo $last_update->get_last_update() . " WIB";
    }
}
?>
    <div id="fitur">
        <table width="100%" class="table table-bordered zebra ratatengah" id="fixheader">
            <!--baris pertama-->
            <thead>
            <th class='mid'>No.</th>
            <!--th>KPPN</th-->
            <th class='mid'>Nomor Invoice</th>
            <th class='mid'>Nilai Invoice Rp</th>
            <th width='350px' class='mid'>Deskripsi Invoice</th>
            <th width='70px'>Approval Status</th>
            <th width='70px' class='mid'>Status</th>
            <!--th>original_recipient</th-->
            <th class='mid'>User</th>
            <!--th>Posisi User</th-->
            <th class='mid'>Mulai</th>
            <!--th>Jam Mulai</th>
            <th>Selesai</th>
            <th>Durasi</th-->
            </thead>
            <tbody>
                <?php
                $no = 1;
                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";

                            //echo "<td>" . $value->get_ou_name() . "</td>";
                            echo "<td>" . $value->get_invoice_num() . "</td>";
                            //echo "<td><a href=".URL."dataSPM/detailposisiSpm/".$value->get_invoice_num()." target='_blank' '>" . $value->get_invoice_num() . "</a></td>";
                            echo "<td class='ratakanan'>" . $value->get_invoice_amount() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
                            echo "<td>" . $value->get_wfapproval_status() . "</td>";
                            echo "<td>" . $value->get_status() . "</td>";
                            //echo "<td>" . $value->get_original_recipient() . "</td>";
                            echo "<td class='ratakiri'>" . $value->get_to_user() . ' ' . $value->get_fu_description() . "</td>";
                            //echo "<td>" . $value->get_fu_description() . "</td>";
                            echo "<td>" . $value->get_begin_date() . '<br>' . $value->get_time_begin_date() . "</td>";
                            //echo "<td>" . $value->get_time_begin_date() . "</td>";
                            //echo "<td>" . $value->get_end_date() . ' ' . $value->get_time_end_date() . "</td>";
                            //echo "<td>" . $value->get_time_end_date() . "</td>";
                            //echo "<td> &nbsp </td>";
                            echo "</tr>	";
                        }
                    }
                } else {
                    echo "<div class='alert alert-info'><strong>Info! </strong>Silakan masukan filter.</div>";
                }
                ?>
            </tbody>
        </table></br>
        <b>Keterangan : </b></br>
        Daftar Diatas Meunjukkan Invoice Yang Sedang Dalam Proses Oleh User
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8">
                            $(function() {
                                hideErrorId();
                                hideWarning();

                                $("#tgl_awal").datepicker({dateFormat: "dd-mm-yy"
                                });

                                $("#tgl_akhir").datepicker({dateFormat: "dd-mm-yy"
                                });
                            });


                            function hideErrorId() {
                                $('.error').fadeOut(0);
                            }

                            function hideWarning() {
                                $('#invoice').keyup(function() {
                                    if (document.getElementById('invoice').value != '') {
                                        $('#winvoice').fadeOut(200);
                                    }
                                });
                                $('#tgl_awal').change(function() {
                                    if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                                        $('#wtgl').fadeOut(200);
                                    }
                                });

                                $('#tgl_akhir').change(function() {
                                    if (document.getElementById('tgl_awal').value != '' && document.getElementById('tgl_akhir').value != '') {
                                        $('#wtgl').fadeOut(200);
                                    }
                                });

                            }

                            function cek_upload() {
                                var v_invoice = document.getElementById('invoice').value;
                                var v_tglawal = document.getElementById('tgl_awal').value;
                                var v_tglakhir = document.getElementById('tgl_akhir').value;

                                var jml = 0;
                                if (v_invoice == '' && v_tglawal == '' && v_tglakhir == '') {
                                    $('#winvoice').html('Harap isi no invoice');
                                    $('#winvoice').fadeIn();
                                    $('#wtgl').html('Harap isi tanggal');
                                    $('#wtgl').fadeIn();
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
                                    "table": document.getElementById('example'),
                                    "datatable": oTable
                                });
                            });
</script>