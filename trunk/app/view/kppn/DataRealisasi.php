<div id="top">
    <div id="header">
        <h2>Detail Realisasi Belanja Per Satker 
            <?php
            if (isset($this->d_nama_kppn)) {
                foreach ($this->d_nama_kppn as $kppn) {
                    echo $kppn->get_nama_user() . " (" . $kppn->get_kd_satker() . ")";
                    $kode_kppn = $kppn->get_kd_satker();
                }
            } else {
                echo Session::get('user');
            }
            ?>
            <br>
            Sampai Dengan

            <?php
            echo $kode_kppn;
            //Tanggal::tgl_indo(Tanggal::getTglSekarang()) ;
            echo (date('d-m-Y'));
            //echo $this->d_bulan;
            //$date = new DateTime(Tanggal::getTglSekarang());
            //$date->sub(new DateInterval('P1D'));
            //echo Tanggal::tgl_indo($date->format('Y-m-d') ). "\n";
            ?>
        </h2>
    </div>
    <?php
    //----------------------------------------------------
    //Development history
    //Revisi : 0
    //Kegiatan :1.mencetak hasil filter ke dalam pdf
    //File yang diubah : DataRealisasi.php
    //Dibuat oleh : Rifan Abdul Rachman
    //Tanggal dibuat : 18-07-2014
    //----------------------------------------------------
    if (isset($this->d_kd_kppn)) {
        $kdkppn = $this->d_kd_kppn;
    } else {
        $kdkppn = Session::get('id_user');
    }
    if (isset($this->satker_code1)) {
        $kdsatkerku = $this->satker_code1;
    }
    ?>
    <ul class="inline" style="float: right"><li>
            <a href="<?php echo URL; ?>PDF/DataRealisasi_PDF/<?php echo $kdkppn . "/" . $kdsatkerku; ?>"class="warning"><i class="icon icon-print icon-white"></i>PDF</a></li>

        <li><a href="#xModal" class="modal">FILTER DATA</a></li></ul>

    <br><br>
    <div id="xModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
    $_SERVER['PHP_SELF'];
    ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>
            <div id="top">

                <form method="POST" action="DataRealisasi" enctype="multipart/form-data">
                    <div id="winvoice" class="error"></div>


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

                    <label class="isian">Kode Satker: </label>
                    <input type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)) {
    echo $this->kdsatker;
} ?>">

                    <!--label class="isian">Pilih Periode: </label>
                    <select type="text" name="bulan" id="bulan">
                            <option value='JAN' <?php if ($this->d_bulan == '01') {
    echo "selected";
} ?> >Januari</option>
                            <option value='FEB' <?php if ($this->d_bulan == '02') {
    echo "selected";
} ?> >Februari</option>
                            <option value='MAR' <?php if ($this->d_bulan == '03') {
    echo "selected";
} ?> >Maret</option>
                            <option value='APR' <?php if ($this->d_bulan == '04') {
    echo "selected";
} ?> >April</option>
                            <option value='MAY' <?php if ($this->d_bulan == '05') {
    echo "selected";
} ?> >Mei</option>
                            <option value='JUN' <?php if ($this->d_bulan == '06') {
    echo "selected";
} ?> >Juni</option>
                            <option value='JUL' <?php if ($this->d_bulan == '07') {
    echo "selected";
} ?> >Juli</option>
                            <option value='AGT' <?php if ($this->d_bulan == '08') {
    echo "selected";
} ?> >Agustus</option>
                            <option value='SEP' <?php if ($this->d_bulan == '09') {
    echo "selected";
} ?> >September</option>
                            <option value='OCT' <?php if ($this->d_bulan == '10') {
        echo "selected";
    } ?> >Oktober</option>
                            <option value='NOV' <?php if ($this->d_bulan == '11') {
        echo "selected";
    } ?> >November</option>
                            <option value='DEC' <?php if ($this->d_bulan == '12') {
        echo "selected";
    } ?> >Desember</option>
                            <!--option value='Validated' <?php //if ($this->status==Validated){echo "selected";} ?>>Validated</option>
                            <option value='Error' <?php //if ($this->status==Error){echo "selected";} ?>>Error</option>
                            
                    </select-->


                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return ();"></li>
                    </ul>
                </form>
            </div></div>
    </div>
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
        <table width="100%" class="table table-bordered zebra" id="fixheader" style="font-size: 72%">
            <!--baris pertama-->
            <thead>
                <tr>
                    <th rowspan=2 width="10px" class='mid'>No.</th>
                    <!--th>KPPN</th-->
                    <!--th>Tanggal</th-->
                    <th rowspan=2 class='mid'>Satker</th>

                    <th rowspan=2 class='mid' width='200px'> Nama Satker </th>
                    <th rowspan=2 class='mid'> Pagu </th>


                    <th colspan=9 class='mid'>Jenis Belanja</th>
                    <th rowspan=2 class='mid'>Sisa Pagu</th>
                </tr>
                <tr >
                    <th class='mid' >Pegawai</th>
                    <th class='mid' >Barang</th>
                    <th class='mid' >Modal</th>
                    <th class='mid' >Beban Bunga</th>
                    <th class='mid' >Subsidi</th>
                    <th class='mid' >Hibah</th>
                    <th class='mid' >BanSos</th>
                    <th class='mid' >Lain lain</th>
                    <!--th >Pencadangan Dana</th-->
                    <th class='mid' >Total</th>

                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                $tot_pot = 0;

                //var_dump ($this->data);
                if (isset($this->data)) {
                    if (empty($this->data)) {
                        echo "<div class='alert alert-danger'><strong>Info! </strong>Tidak ada data.</div>";
                    } else {

                        $tot_pagu = 0;
                        $tot_51 = 0;
                        $tot_52 = 0;
                        $tot_53 = 0;
                        $tot_54 = 0;
                        $tot_55 = 0;
                        $tot_56 = 0;
                        $tot_57 = 0;
                        $tot_58 = 0;
                        $tot_bel = 0;
                        $tot_sisa = 0;
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_satker() . "</td>";
                            echo "<td align='left'>" . $value->get_dipa() . "</td>";
                            echo "<td align='right'>" . number_format($value->get_Pagu()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_51()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_52()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_53()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_54()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_55()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_56()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_57()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_58()) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_encumbrance()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_belanja_51() + $value->get_belanja_52() + $value->get_belanja_53() + $value->get_belanja_54() + $value->get_belanja_55() + $value->get_belanja_56() + $value->get_belanja_57() + $value->get_belanja_58()) . "</td>";
                            echo "<td align='right'>" . number_format($value->get_pagu() - ($value->get_belanja_51() + $value->get_belanja_52() + $value->get_belanja_53() + $value->get_belanja_54() + $value->get_belanja_55() + $value->get_belanja_56() + $value->get_belanja_57() + $value->get_belanja_58())) . "</td>";
                            //echo "<td align='right'>" . number_format($value->get_belanja_59()) . "</td>";

                            echo "</tr>	";
                            //$tot_pot = $tot_pot  + $value->get_amount() ;	
                            $tot_pagu+=$value->get_Pagu();
                            $tot_51+=$value->get_belanja_51();
                            $tot_52+=$value->get_belanja_52();
                            $tot_53+=$value->get_belanja_53();
                            $tot_54+=$value->get_belanja_54();
                            $tot_55+=$value->get_belanja_55();
                            $tot_56+=$value->get_belanja_56();
                            $tot_57+=$value->get_belanja_57();
                            $tot_58+=$value->get_belanja_58();
                            $tot_bel+=($value->get_belanja_51() + $value->get_belanja_52() + $value->get_belanja_53() + $value->get_belanja_54() + $value->get_belanja_55() + $value->get_belanja_56() + $value->get_belanja_57() + $value->get_belanja_58());
                            $tot_sisa+=($value->get_pagu() - ($value->get_belanja_51() + $value->get_belanja_52() + $value->get_belanja_53() + $value->get_belanja_54() + $value->get_belanja_55() + $value->get_belanja_56() + $value->get_belanja_57() + $value->get_belanja_58()));
                        }
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='3' class='ratatengah'><b>GRAND TOTAL<b></td>
                                <td class='ratakanan'><?php echo number_format($tot_pagu); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_51); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_52); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_53); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_54); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_55); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_56); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_57); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_58); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_bel); ?></td>
                                <td class='ratakanan'><?php echo number_format($tot_sisa); ?></td>
                                </tr>
                                </tfoot>
                                </table>
                                </div>
                                </div>
                                </div>
                                <script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.js"></script>
                                <script type="text/javascript" charset="utf-8" src="<?php echo URL; ?>public/js/jquery.dataTables.js"></script>
                                <script type="text/javascript" charset="utf-8">
                            $(function() {
                                hideErrorId();
                                hideWarning();

                            });

                            function hideErrorId() {
                                $('.error').fadeOut(0);
                            }

                            function hideWarning() {
                                $('#status').change(function() {
                                    if (document.getElementById('status').value != '') {
                                        $('#wstatus').fadeOut(200);
                                    }
                                });

                            }

                            function cek_upload() {
                                var v_status = document.getElementById('status').value;

                                var jml = 0;
                                if (v_status == '') {
                                    $('#wstatus').html('Harap pilih');
                                    $('#wstatus').fadeIn();
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