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

            if ($_POST['kdlokasi'] != '') {

                echo ', Kode Lokasi ' . $_POST['kdlokasi'];
            }
            ?>
            <br>
            Sampai Dengan

            <?php
            //echo 
            //Tanggal::tgl_indo(Tanggal::getTglSekarang()) ;
            //echo (date('d-m-y'));


            $date = new DateTime(Tanggal::getTglSekarang());
            $date->sub(new DateInterval('P1D'));
            echo Tanggal::tgl_indo($date->format('Y-m-d')) . "\n";
            ?>
        </h2>
    </div>

    <a href="#xModal" class="modal">FILTER DATA</a><br><br>
    <div id="xModal" class="modalDialog" >
        <div>
            <h2 style="border-bottom: 1px solid #eee; padding-bottom: 10px">FILTER</h2>
            <a href="<?php
            $_SERVER['PHP_SELF'];
            ?>" title="Tutup" class="close"><i class="icon-remove icon-white" style="margin-left: 5px; margin-top: 2px"></i>
            </a>
            <div id="top">

                <form method="POST" action="DataRealisasiLokasi" enctype="multipart/form-data">
                    <div id="winvoice" class="error"></div>


                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="error"></div>
                        <label class="isian">Kode KPPN: </label>
                        <select type="text" name="kdkppn" id="kdkppn">
                            <option value='' selected>- Semua KPPN -</option>
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

                    </select>


                    <div id="wkdkppn" class="error"></div>
                    <label class="isian">Kode Lokasi: </label>
                    <select type="text" name="kdlokasi" id="kdlokasi">
                        <option value='' selected>- pilih -</option>
<?php
foreach ($this->data2 as $value1)
    echo "<option value = '" . $value1->get_lokasi() . "'>" . $value1->get_lokasi() . " | " . $value1->get_nmlokasi() . "</option>";
//if ($kode_kppn==$value1->get_kd_d_kppn()){echo "<option value='".$value1->get_kd_d_kppn()."' selected>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";} 
//else {echo "<option value='".$value1->get_kd_d_kppn()."'>".$value1->get_kd_d_kppn()." | ".$value1->get_nama_user()."</option>";}
?>
                    </select>


                    <input type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->

                    <ul class="inline" style="margin-left: 130px">
                        <li><input id="reset" class="normal" type="reset" name="reset_file" value="RESET" onClick=""></li>
                        <li><input id="submit" class="sukses" type="submit" name="submit_file" value="SUBMIT" onClick="return ();"></li>
                        <!--onClick="konfirm(); return false;"-->
                    </ul>
                </form>
            </div></div>
    </div>

    <div id="fitur" style="overflow: scroll">
        <table width="100%" class="table table-bordered zebra" id="fixheader" style="font-size: 70%">
            <!--baris pertama-->
            <thead>
                <tr>
                    <th rowspan=2 width="10px" class='mid'>No.</th>
                    <!--th>KPPN</th-->
                    <!--th>Tanggal</th-->
                    <th rowspan=2 class='mid'>Lokasi</th>
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
                        foreach ($this->data as $value) {
                            echo "<tr>	";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . $value->get_lokasi() . "</td>";
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
                        }
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <!--tr>
                        <td colspan='4'></td>
                        <td class='ratatengah'><b>GRAND TOTAL</td>
                        <td align='right'><b><?php //echo number_format($tot_pot);  ?>
                        </td>
                        
                </tr-->
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