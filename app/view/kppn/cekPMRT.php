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
                <th rowspan="2" >No.</th>
                <th rowspan="2" >Kode KPPN<br>Nomor Supplier<br>Tipe Supplier</th>
                <th colspan="4" >Data SPAN</th>
                <th colspan="4" >Data Upload</th>
                <th rowspan="2">Status</th>
            </tr>
            <tr>
                <th class="align-left">Nama Supplier<br>NPWP Supplier</th>
                <th class="align-left">Kode Valas<br>Kode Bank<br>Kode Swift<br>IBAN</th>
                <th class="align-left">Nomer Rekening<br>Nama Pemilik Rekening</th>
                <th class="align-left">Nama Penerima<br>NIP Penerima<br>NPWP Penerima</th>
                <th class="align-left">Nama Supplier<br>NPWP Supplier</th>
                <th class="align-left">Kode Valas<br>Kode Bank<br>Kode Swift<br>IBAN</th>
                <th class="align-left">Nomer Rekening<br>Nama Pemilik Rekening</th>
                <th class="align-left">Nama Penerima<br>NIP Penerima<br>NPWP Penerima</th>
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

    <div class="main-window-segment vertical-padded">
        <div class="container-fluid">
            <div class="row">

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
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Upload PMRT</h4>

            </div>

            <form id="filter-form" method="POST" action="cekSupplier" enctype="multipart/form-data">

                <div class="modal-body">
                    <div id="wfile_pmrt" class="alert alert-danger" style="display: none"></div>
                    <label class="isian">File PMRT : </label>
                    <input class='form-control' type="file" name="file_pmrt" id="file_pmrt" value="<?php if (isset($this->d_file_pmrt)) {
                            echo $this->d_file_pmrt;
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
    
    $(function() {
        hideErrorId();
        hideWarning();

    });

    function hideErrorId() {
        $('.alert-danger').fadeOut(0);
    }

    function hideWarning() {

        $('#file_pmrt').keyup(function() {
            if (document.getElementById('file_pmrt').value != '') {
                $('#wfile_pmrt').fadeOut(200);
            }
        })

    }

    function cek_upload() {
        var pattern = '^[0-9]+$';
        var v_file_pmrt = document.getElementById('file_pmrt').value;
        var v_filename = v_file_pmrt.replace(/^.*[\\\/]/, '').toUpperCase();
        var v_file_pmrt_depan = v_filename.substring(0, 4);
        var v_file_pmrt_extension = v_filename.substring(v_filename.length - 5);

        var jml = 0;
        
        if (v_file_pmrt_depan !== 'PMRT' || v_file_pmrt_extension !== '.XLSX') {
            var wfile_pmrt =  'file yang diupload bukan file pmrt';
            $('#wfile_pmrt').html(wfile_pmrt);
            $('#wfile_pmrt').fadeIn(200);
            jml++;
        }
        
        if (v_file_pmrt === '') {
            var wfile_pmrt = 'Harap pilih file yang akan diupload';
            $('#wfile_pmrt').html(wfile_pmrt);
            $('#wfile_pmrt').fadeIn(200);
            jml++;
        }

        if (jml > 0) {
            return false;
        }
    }
</script>