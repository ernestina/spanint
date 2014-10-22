<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Cek Data Supplier</h2>
            </div>

            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <!-- PDF --> 
                <?php
//----------------------------------------------------
//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : fund_fail.php  


                if (Session::get('role') == ADMIN) {
                    if (isset($this->d_kd_kppn) || isset($this->d_tipesup) || isset($this->d_nrs) || isset($this->d_namasupplier) || isset($this->d_npwpsupplier) || isset($this->d_nip) || isset($this->d_namapenerima) || isset($this->d_norek) || isset($this->d_namarek) || isset($this->d_npwppenerima)) {

                        if (isset($this->d_kd_kppn)) {
                            $kdkppn = $this->d_kd_kppn;
                        } else {
                            foreach ($this->d_nama_kppn as $kppn) {
                                $kdkppn = $kppn->get_kd_satker();
                            }
                        }

                        if (isset($this->d_tipesup)) {
                            $kdtipesup = $this->d_tipesup;
                        } else {
                            $kdtipesup = 'null';
                        }
                        if (isset($this->d_nrs)) {
                            $kdnrs = $this->d_nrs;
                        } else {
                            $kdnrs = 'null';
                        }
                        if (isset($this->d_namasupplier)) {
                            $kdnamasupplier = $this->d_namasupplier;
                        } else {
                            $kdnamasupplier = 'null';
                        }
                        if (isset($this->d_npwpsupplier)) {
                            $kdnpwpsupplier = $this->d_npwpsupplier;
                        } else {
                            $kdnpwpsupplier = 'null';
                        }
                        if (isset($this->d_nip)) {
                            $kdnip = $this->d_nip;
                        } else {
                            $kdnip = 'null';
                        }
                        if (isset($this->d_namapenerima)) {
                            $kdnamapenerima = $this->d_namapenerima;
                        } else {
                            $kdnamapenerima = 'null';
                        }
                        if (isset($this->d_norek)) {
                            $kdnorek = $this->d_norek;
                        } else {
                            $kdnorek = 'null';
                        }
                        if (isset($this->d_namarek)) {
                            $kdnamarek = $this->d_namarek;
                        } else {
                            $kdnamarek = 'null';
                        }
                        if (isset($this->d_npwppenerima)) {
                            $kdnpwppenerima = $this->d_npwppenerima;
                        } else {
                            $kdnpwppenerima = 'null';
                        }
                        ?>
                        <a href="<?php echo URL; ?>PDF/cekSupplier_PDF/<?php echo $kdkppn . "/" . $kdtipesup . "/" . $kdnrs . "/" . $kdnamasupplier . "/" . $kdnpwpsupplier . "/" . $kdnip . "/" . $kdnamapenerima . "/" . $kdnorek . "/" . $kdnamarek . "/" . $kdnpwppenerima; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                        <?php
                    }
                }

                if (Session::get('role') == KPPN) {
                    if (isset($this->d_tipesup) || isset($this->d_nrs) || isset($this->d_namasupplier) || isset($this->d_npwpsupplier) || isset($this->d_nip) || isset($this->d_namapenerima) || isset($this->d_norek) || isset($this->d_namarek) || isset($this->d_npwppenerima)) {


                        $kdkppn = Session::get('id_user');
                        if (isset($this->d_tipesup)) {
                            $kdtipesup = $this->d_tipesup;
                        } else {
                            $kdtipesup = 'null';
                        }
                        if (isset($this->d_nrs)) {
                            $kdnrs = $this->d_nrs;
                        } else {
                            $kdnrs = 'null';
                        }
                        if (isset($this->d_namasupplier)) {
                            $kdnamasupplier = $this->d_namasupplier;
                        } else {
                            $kdnamasupplier = 'null';
                        }
                        if (isset($this->d_npwpsupplier)) {
                            $kdnpwpsupplier = $this->d_npwpsupplier;
                        } else {
                            $kdnpwpsupplier = 'null';
                        }
                        if (isset($this->d_nip)) {
                            $kdnip = $this->d_nip;
                        } else {
                            $kdnip = 'null';
                        }
                        if (isset($this->d_namapenerima)) {
                            $kdnamapenerima = $this->d_namapenerima;
                        } else {
                            $kdnamapenerima = 'null';
                        }
                        if (isset($this->d_norek)) {
                            $kdnorek = $this->d_norek;
                        } else {
                            $kdnorek = 'null';
                        }
                        if (isset($this->d_namarek)) {
                            $kdnamarek = $this->d_namarek;
                        } else {
                            $kdnamarek = 'null';
                        }
                        if (isset($this->d_npwppenerima)) {
                            $kdnpwppenerima = $this->d_npwppenerima;
                        } else {
                            $kdnpwppenerima = 'null';
                        }
                        ?>
                        <a href="<?php echo URL; ?>PDF/cekSupplier_PDF/<?php echo $kdkppn . "/" . $kdtipesup . "/" . $kdnrs . "/" . $kdnamasupplier . "/" . $kdnpwpsupplier . "/" . $kdnip . "/" . $kdnamapenerima . "/" . $kdnorek . "/" . $kdnamarek . "/" . $kdnpwppenerima; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                        <?php
                    }
                }
                if (Session::get('role') == SATKER) {

                    if (isset($this->d_kd_kppn)) {
                        $kdkppn = $this->d_kd_kppn;
                    } else {
                        foreach ($this->data as $value) {
                            $kdkppn = $value->get_kppn_code();
                        }
                    }

                    if (isset($this->d_tipesup)) {
                        $kdtipesup = $this->d_tipesup;
                    } else {
                        $kdtipesup = 'null';
                    }
                    if (isset($this->d_nrs)) {
                        $kdnrs = $this->d_nrs;
                    } else {
                        $kdnrs = 'null';
                    }
                    if (isset($this->d_namasupplier)) {
                        $kdnamasupplier = $this->d_namasupplier;
                    } else {
                        $kdnamasupplier = 'null';
                    }
                    if (isset($this->d_npwpsupplier)) {
                        $kdnpwpsupplier = $this->d_npwpsupplier;
                    } else {
                        $kdnpwpsupplier = 'null';
                    }
                    if (isset($this->d_nip)) {
                        $kdnip = $this->d_nip;
                    } else {
                        $kdnip = 'null';
                    }
                    if (isset($this->d_namapenerima)) {
                        $kdnamapenerima = $this->d_namapenerima;
                    } else {
                        $kdnamapenerima = 'null';
                    }
                    if (isset($this->d_norek)) {
                        $kdnorek = $this->d_norek;
                    } else {
                        $kdnorek = 'null';
                    }
                    if (isset($this->d_namarek)) {
                        $kdnamarek = $this->d_namarek;
                    } else {
                        $kdnamarek = 'null';
                    }
                    if (isset($this->d_npwppenerima)) {
                        $kdnpwppenerima = $this->d_npwppenerima;
                    } else {
                        $kdnpwppenerima = 'null';
                    }
                    ?>
                    <a href="<?php echo URL; ?>PDF/cekSupplier_PDF/<?php echo $kdkppn . "/" . $kdtipesup . "/" . $kdnrs . "/" . $kdnamasupplier . "/" . $kdnpwpsupplier . "/" . $kdnip . "/" . $kdnamapenerima . "/" . $kdnorek . "/" . $kdnamarek . "/" . $kdnpwppenerima; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
                    <?php
                }
                ?>                
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

            </div>
        </div>

        <div class="row" style="padding-top: 10px">

            <div class="col-md-6 col-sm-12">
                <?php
                if (isset($this->d_kd_kppn)) {
                    echo "KPPN : ".$this->d_kd_kppn;
                }
                if (isset($this->d_tipesup)) {
                    echo "<br>Tipe Supp : ".$this->d_tipesup;
                }
                if (isset($this->d_nrs)) {
                    echo "<br>NRS : ".$this->d_nrs;
                }
                if (isset($this->d_namasupplier)) {
                    echo "<br>Nama Supp : ".$this->d_namasupplier;
                }
                if (isset($this->d_npwpsupplier)) {
                    echo "<br>NPWP Supp : ".$this->d_npwpsupplier;
                }
                if (isset($this->d_nip)) {
                    echo "<br>NIP Penerima : ".$this->d_nip;
                }
                if (isset($this->d_namapenerima)) {
                    echo "<br>Nama Penerima : ".$this->d_namapenerima;
                }
                if (isset($this->d_norek)) {
                    echo "<br>No. Rek Penerima : ".$this->d_norek;
                }
                if (isset($this->d_namarek)) {
                    echo "<br>Nama Rekening : ".$this->d_namarek;
                }
                if (isset($this->d_npwppenerima)) {
                    echo "<br>NPWP Penerima : ".$this->d_npwppenerima;
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

<form name='listSupplier' method='POST' action='downloadSupplier' enctype='multipart/form-data'>

    <!-- Tabel -->
    <div id="table-container" class="wrapper">
        <table class="footable">
            <!--baris pertama-->
            <thead>
                <tr>
                    <th width='5px'>No.</th>
                    <th>Kode KPPN</th>
                    <th>NRS / Tipe Kode Pos</th>
                    <th>Nama Supplier<br>NPWP Supplier</th>
                    <th>Nama Bank</th>
                    <th>KD NAB - Kode Valas</th>
                    <th>Nama Penerima</th>
                    <th width='300px'>Nama pemilik Rekening<br>Nomor Rekening</th>
                    <th>SWIFT / IBAN</th>
                    <th>NPWP Penerima</th>
                    <th>NIP Penerima</th>
                    <th>pilih <input type="checkbox" onClick="toggle(this)" /> </th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
<?php
$no = 1;

if (isset($this->data)) {
    if (empty($this->data)) {
        echo '<td colspan=12 align="center">Tidak ada data.</td>';
    } else {
        foreach ($this->data as $value) {
            echo "<tr>	";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $value->get_kppn_code() . "</td>";
            echo "<td>" . $value->get_v_supplier_number() . " / " . $value->get_tipe_supp() . "</td>";
            echo "<td class='ratakiri'>" . $value->get_nama_supplier() . "<br>" . $value->get_npwp_supplier() . "</td>";
            echo "<td class='ratakiri'>" . $value->get_nm_bank() . "</td>";
            echo "<td>" . $value->get_asal_bank() . " - " . $value->get_kdvalas() . "</td>";
            echo "<td class='ratakiri'>" . $value->get_nm_penerima() . "</td>";
            echo "<td class='ratakiri'>" . $value->get_nm_pemilik_rek() . "<br>" . $value->get_norek_penerima() . "</td>";
            echo "<td>" . $value->get_kd_swift() . " / " . $value->get_iban() . "</td>";
            echo "<td>" . $value->get_npwp_penerima() . "</td>";
            echo "<td>" . $value->get_nip_penerima() . "</td>";
            echo "<td><input name='checkbox[]' type='checkbox' id='checkbox' value='" . $value->get_ids() . "'> </td>";
            echo "</tr>	";
        }
    }
} else {
    echo '<td colspan=12 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
}
?>

            </tbody>
        </table>
    </div>

    <input id='download_ext' type='hidden' name='download_ext' value='txt'>

    <div class="main-window-segment vertical-padded">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-10 col-md-6 col-sm-12"><h4>Unduh file</h4></div>

                <div class="col-lg-1 col-md-3 col-sm-12">

                    <input style='width: 100%' class='btn btn-default' type='button' name='submit_txt' value='Unduh .txt' onclick='downloadSupplier("txt");'>


                </div>
                <div class="col-lg-1 col-md-3 col-sm-12">

                    <input style='width: 100%' class='btn btn-default' type='button' name='submit_xml' value='Unduh .xml' onclick='downloadSupplier("xml");'> 

                </div>

            </div>
        </div>
    </div>

</form>

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>

            <form id="filter-form" method="POST" action="cekSupplier" enctype="multipart/form-data">

                <div class="modal-body">
                    <br/>
                    <div id="wtipesup" class="alert alert-danger" style="display: none"></div>
                    <label class='isian'>Tipe Supplier: </label>
                    <select class='form-control' type='text' name='tipesup' id='tipesup'>
                        <option value='1' <?php if ($this->d_tipesup == 1) {
    echo "selected";
} ?>>1. Satker</option>
                        <option value='2' <?php if ($this->d_tipesup == 2) {
    echo "selected";
} ?>>2. Penyedia BJ</option>
                        <option value='3' <?php if ($this->d_tipesup == 3) {
                            echo "selected";
                        } ?>>3. Pegawai</option>
                        <option value='4' <?php if ($this->d_tipesup == 4) {
                            echo "selected";
                        } ?>>4. BA.999</option>
                        <option value='5' <?php if ($this->d_tipesup == 5) {
                            echo "selected";
                        } ?>>5. Transfer Daerah</option>
                        <option value='6' <?php if ($this->d_tipesup == 6) {
                            echo "selected";
                        } ?>>6. PP/Banyak Penerima</option>
                        <option value='7' <?php if ($this->d_tipesup == 7) {
                            echo "selected";
                        } ?>>7. Lain-lain</option>
                    </select>
                    <br/>
                    <div id="wnrs" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">NRS: </label>
                    <input class='form-control' type="number" name="nrs" id="nrs" size="15" value="<?php if (isset($this->d_nrs)) {
                            echo $this->d_nrs;
                        } ?>">
                    <br/>
                    <div id="wnamasupplier" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Nama Supplier / Kode Satker: </label>
                    <input class='form-control' type="text" name="namasupplier" id="namasupplier" value="<?php if (isset($this->d_namasupplier)) {
                            echo $this->d_namasupplier;
                        } ?>">
                    <br/>
                    <div id="wnpwpsupplier" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">NPWP Supplier: </label>
                    <input class='form-control' type="text" name="npwpsupplier" id="npwpsupplier" value="<?php if (isset($this->d_npwpsupplier)) {
                            echo $this->d_npwpsupplier;
                        } ?>">
                    <br/>
                    <div id="wnip" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">NIP Penerima: </label>
                    <input class='form-control' type="number" name="nip" id="nip" size="18" value="<?php if (isset($this->d_nip)) {
                            echo $this->d_nip;
                        } ?>">
                    <br/>
                    <div id="wnamapenerima" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Nama Penerima: </label>
                    <input class='form-control' type="text" name="namapenerima" id="namapenerima" value="<?php if (isset($this->d_namapenerima)) {
                            echo $this->d_namapenerima;
                        } ?>">
                    <br/>
                    <div id="wnorek" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Nomor Rek.: </label>
                    <input class='form-control' type="text" name="norek" id="norek" value="<?php if (isset($this->d_norek)) {
                            echo $this->d_norek;
                        } ?>">
                    <br/>
                    <div id="wnamarek" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">Nama Rek.: </label>
                    <input class='form-control' type="text" name="namarek" id="namarek" value="<?php if (isset($this->d_namarek)) {
                            echo $this->d_namarek;
                        } ?>">
                    <br/>
                    <div id="wnpwppenerima" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">NPWP Penerima: </label>
                    <input class='form-control' type="text" name="npwppenerima" id="npwppenerima" value="<?php if (isset($this->d_npwppenerima)) {
                            echo $this->d_npwppenerima;
                        } ?>">


                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/javascript" charset="utf-8">

    function downloadSupplier(type) {

        $("#alert-nocheck").hide();
        $("#alert-toomanycheck").hide();

        if (type == "txt") {
            $("#download_ext").val("txt");
        }
        if (type == "xml") {
            $("#download_ext").val("xml");
        }

        var countChecked = $("#checkbox:checked").length;

        if (countChecked == 0) {
            alert('Tidak ada data yang dipilih.');
        } else if (countChecked > 1000) {
            alert('Terlalu banyak data yang dipilih. Maksimal data yang dipilih sebanyak 1000 baris.');
        } else {
            document.listSupplier.submit();
        }

    }

    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.alert-danger').fadeOut(0);
    }

    function toggle(source) {
        checkboxes = document.getElementsByName('checkbox[]');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function hideWarning() {

        $('#tipesup').keyup(function() {
            if (document.getElementById('tipesup').value != '') {
                $('#wtipesup').fadeOut(200);
            }
        })

        $('#nrs').keyup(function() {
            if (document.getElementById('nrs').value != '') {
                $('#wnrs').fadeOut(200);
            }
        });

        $('#namasupplier').keyup(function() {
            if (document.getElementById('namasupplier').value != '') {
                $('#wnamasupplier').fadeOut(200);
            }
        });

        $('#npwpsupplier').keyup(function() {
            if (document.getElementById('npwpsupplier').value != '') {
                $('#wnpwpsupplier').fadeOut(200);
            }
        });

        $('#nip').keyup(function() {
            if (document.getElementById('nip').value != '') {
                $('#wnip').fadeOut(200);
            }
        });

        $('#namapenerima').keyup(function() {
            if (document.getElementById('namapenerima').value != '') {
                $('#wnamapenerima').fadeOut(200);
            }
        });

        $('#norek').keyup(function() {
            if (document.getElementById('norek').value != '') {
                $('#wnorek').fadeOut(200);
            }
        });

        $('#namarek').keyup(function() {
            if (document.getElementById('namarek').value != '') {
                $('#wnamarek').fadeOut(200);
            }
        });

        $('#npwppenerima').keyup(function() {
            if (document.getElementById('npwppenerima').value != '') {
                $('#wnpwppenerima').fadeOut(200);
            }
        });

    }

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_tipesup = document.getElementById('tipesup').value;
        var v_nrs = document.getElementById('nrs').value;
        var v_namasupplier = document.getElementById('namasupplier').value;
        var v_npwpsupplier = document.getElementById('npwpsupplier').value;
        var v_nip = document.getElementById('nip').value;
        var v_namapenerima = document.getElementById('namapenerima').value;
        var v_norek = document.getElementById('norek').value;
        var v_namarek = document.getElementById('namarek').value;
        var v_npwppenerima = document.getElementById('npwppenerima').value;

        var jml = 0;

        if (v_tipesup == '2' && v_norek == '') {
            var wnorek = 'Untuk tipe supplier 2, nomor rekening harus diisi';
            $('#wnorek').html(wnorek);
            $('#wnorek').fadeIn(200);
            jml++;
        }

<?php if (Session::get('role') == SATKER) { ?>
            if (v_tipesup == '1' || v_tipesup == '3') {
                document.getElementById("namasupplier").value = '<?php echo Session::get('kd_satker'); ?>';
            }
<?php } else { ?>
            if (v_namasupplier == '') {
                var wnamasupplier = 'Nama Supplier / Kode Satker harus diisi';
                $('#wnamasupplier').html(wnamasupplier);
                $('#wnamasupplier').fadeIn(200);
                jml++;
            }
<?php } ?>

        if ((v_tipesup == '4' || v_tipesup == '5' || v_tipesup == '6' || v_tipesup == '7') && v_npwpsupplier == '') {
            var wnpwpsupplier = 'Untuk tipe supplier selain 1,2 atau 3, npwp harus diisi';
            $('#wnpwpsupplier').html(wnpwpsupplier);
            $('#wnpwpsupplier').fadeIn(200);
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>