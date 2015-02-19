<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring SP2D - Bank</h2>
            </div>
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <?php
                //----------------------------------------------------
                //Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
                if (Session::get('role') == ADMIN || Session::get('role') == PKN || Session::get('role') == KANWIL) {
                    if (isset($this->d_nama_kppn) || isset($this->d_nosp2d) ||
                            isset($this->d_barsp2d) || isset($this->d_kdsatker) ||
                            isset($this->d_invoice) || isset($this->d_bank) || isset($this->d_status) ||
                            isset($this->d_bayar) || isset($this->d_tgl_awal) || isset($this->d_tgl_akhir)
							|| isset($this->d_vendor_name)) {
                        
						if (isset($this->d_nama_kppn)) {
                            foreach ($this->d_nama_kppn as $kppn) {
                                $kdkppn = $kppn->get_kd_satker();
                            }
                        } else {
                            $kdkppn = 'null';
                        }

                        if (isset($this->d_nosp2d)) {
                            $kdnosp2d = $this->d_nosp2d;
                        } else {
                            $kdnosp2d = 'null';
                        }

                        if (isset($this->d_barsp2d)) {
                            $kdbarsp2d = $this->d_barsp2d;
                        } else {
                            $kdbarsp2d = 'null';
                        }
                        if (isset($this->d_kdsatker)) {
                            $kdsatker = $this->d_kdsatker;
                        } else {
                            $kdsatker = 'null';
                        }

                        if (isset($this->d_invoice)) {
                            $kdnoinvoice = $this->d_invoice;
                        } else {
                            $kdnoinvoice = 'null';
                        }

                        if (isset($this->d_bank)) {
                            $kdbank = $this->d_bank;
                        } else {
                            $kdbank = 'null';
                        }
                        if (isset($this->d_status)) {
                            $kdstatus = $this->d_status;
                        } else {
                            $kdstatus = 'null';
                        }

                        if (isset($this->d_bayar)) {
                            $kdbayar = $this->d_bayar;
                        } else {
                            $kdbayar = 'null';
                        }


                        if (isset($this->d_tgl_awal)) {
                            $kdtgl_awal = $this->d_tgl_awal;
                        } else {
                            $kdtgl_awal = 'null';
                        }
                        if (isset($this->d_tgl_akhir)) {
                            $kdtgl_akhir = $this->d_tgl_akhir;
                        } else {
                            $kdtgl_akhir = 'null';
                        }
						
						if (isset($this->d_fxml)) {
                            $kd_fxml = $this->d_fxml;
                        } else {
                            $kd_fxml = 'null';
                        }
                        if (isset($this->d_vendor_name)) {
                            $kd_vendor_name = $this->d_vendor_name;
                        } else {
                            $kd_vendor_name = 'null';
                        }
                        ?>
                <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/monitoringSp2d_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdnoinvoice . "/" . $kdbarsp2d . "/" . $kdstatus . "/" . $kdbayar . "/" . $kdbank . "/" . $kd_vendor_name . "/" . $kd_fxml; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/monitoringSp2d_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdnoinvoice . "/" . $kdbarsp2d . "/" . $kdstatus . "/" . $kdbayar . "/" . $kdbank . "/" . $kd_vendor_name . "/" . $kd_fxml; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>
                        
                        <?php
                        //----------------------------------------------------		
                    }
                }
                if (Session::get('role') == KPPN) {

                    if (isset($this->d_nama_kppn)) {
                        foreach ($this->d_nama_kppn as $kppn) {
                            $kdkppn = $kppn->get_kd_satker();
                        }
                    } else {
                        $kdkppn = Session::get('id_user');
                    }

                    if (isset($this->d_nosp2d)) {
                        $kdnosp2d = $this->d_nosp2d;
                    } else {
                        $kdnosp2d = 'null';
                    }

                    if (isset($this->d_barsp2d)) {
                        $kdbarsp2d = $this->d_barsp2d;
                    } else {
                        $kdbarsp2d = 'null';
                    }
                    if (isset($this->d_kdsatker)) {
                        $kdsatker = $this->d_kdsatker;
                    } else {
                        $kdsatker = 'null';
                    }

                    if (isset($this->d_invoice)) {
                        $kdnoinvoice = $this->d_invoice;
                    } else {
                        $kdnoinvoice = 'null';
                    }

                    if (isset($this->d_bank)) {
                        $kdbank = $this->d_bank;
                    } else {
                        $kdbank = 'null';
                    }
                    if (isset($this->d_status)) {
                        $kdstatus = $this->d_status;
                    } else {
                        $kdstatus = 'null';
                    }

                    if (isset($this->d_bayar)) {
                        $kdbayar = $this->d_bayar;
                    } else {
                        $kdbayar = 'null';
                    }


                    if (isset($this->d_tgl_awal)) {
                        $kdtgl_awal = $this->d_tgl_awal;
                    } else {
                        $kdtgl_awal = 'null';
                    }
                    if (isset($this->d_tgl_akhir)) {
                        $kdtgl_akhir = $this->d_tgl_akhir;
                    } else {
                        $kdtgl_akhir = 'null';
                    }
					if (isset($this->d_fxml)) {
                            $kd_fxml = $this->d_fxml;
                        } else {
                            $kd_fxml = 'null';
                        }
                      
					if (isset($this->d_vendor_name)) {
						$kd_vendor_name = $this->d_vendor_name;
					} else {
						$kd_vendor_name = 'null';
					}
                    ?>
                <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/monitoringSp2d_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdnoinvoice . "/" . $kdbarsp2d . "/" . $kdstatus . "/" . $kdbayar . "/" . $kdbank . "/" . $kd_vendor_name . "/" . $kd_fxml; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/monitoringSp2d_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdnoinvoice . "/" . $kdbarsp2d . "/" . $kdstatus . "/" . $kdbayar . "/" . $kdbank . "/" . $kd_vendor_name . "/" . $kd_fxml; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>


                    <?php
                    //----------------------------------------------------		
                }
                if (Session::get('role') == SATKER) {

					if (isset($this->d_nama_kppn)) {
						foreach ($this->d_nama_kppn as $kppn) {
							$kdkppn = $kppn->get_kd_satker();
						}
                    } else {
						$kdkppn = 'null';
                     }

                    if (isset($this->d_nosp2d)) {
                        $kdnosp2d = $this->d_nosp2d;
                    } else {
                        $kdnosp2d = 'null';
                    }

                    if (isset($this->d_barsp2d)) {
                        $kdbarsp2d = $this->d_barsp2d;
                    } else {
                        $kdbarsp2d = 'null';
                    }
                    if (isset($this->d_kdsatker)) {
                        $kdsatker = $this->d_kdsatker;
                    } else {
                        $kdsatker = 'null';
                    }

                    if (isset($this->d_invoice)) {
                        $kdnoinvoice = $this->d_invoice;
                    } else {
                        $kdnoinvoice = 'null';
                    }

                    if (isset($this->d_bank)) {
                        $kdbank = $this->d_bank;
                    } else {
                        $kdbank = 'null';
                    }
                    if (isset($this->d_status)) {
                        $kdstatus = $this->d_status;
                    } else {
                        $kdstatus = 'null';
                    }

                    if (isset($this->d_bayar)) {
                        $kdbayar = $this->d_bayar;
                    } else {
                        $kdbayar = 'null';
                    }


                    if (isset($this->d_tgl_awal)) {
                        $kdtgl_awal = $this->d_tgl_awal;
                    } else {
                        $kdtgl_awal = 'null';
                    }
                    if (isset($this->d_tgl_akhir)) {
                        $kdtgl_akhir = $this->d_tgl_akhir;
                    } else {
                        $kdtgl_akhir = 'null';
                    }
					
 					if (isset($this->d_fxml)) {
                            $kd_fxml = $this->d_fxml;
                        } else {
                            $kd_fxml = 'null';
                        }
					if (isset($this->d_vendor_name)) {
						$kd_vendor_name = $this->d_vendor_name;
					} else {
						$kd_vendor_name = 'null';
					}
                    ?>
                <div class="btn-group-sm">
                    <button type="button" class="btn btn-default dropdown-toggle fullwidth" data-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-print"></span>&nbsp; Cetak <span class="caret"></span>
                    </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo URL; ?>PDF/monitoringSp2d_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdnoinvoice . "/" . $kdbarsp2d . "/" . $kdstatus . "/" . $kdbayar . "/" . $kdbank . "/" . $kd_vendor_name . "/" . $kd_fxml; ?>/PDF">PDF</a></li>
                            <li><a href="<?php echo URL; ?>PDF/monitoringSp2d_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdnoinvoice . "/" . $kdbarsp2d . "/" . $kdstatus . "/" . $kdbayar . "/" . $kdbank . "/" . $kd_vendor_name . "/" . $kd_fxml; ?>/XLS">EXCEL</a></li>
                          </ul>
                </div>        

                    <?php
                    //----------------------------------------------------		
                }

                //----------------------------------------------------		
                ?>
            </div>
			<div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">

                <button type="button" style="width: 100%" class="btn btn-default" data-toggle="modal" data-target="#modal-app-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>

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
                <th class='mid'>No.</th>
                <th width='100px' class='mid'>Tgl Selesai SP2D</th>
                <th width='100px' class='mid'>Tgl SP2D</th>
                <th class='mid'>No. SP2D</th>
                <!--th>Status</th-->

                <!--th>No. Transaksi</th-->
                <th>No. Invoice, <br>Jumlah Rp</th>
                <!--th>Jumlah Rp</th-->
                <th class='mid'>Bank Pembayar</th>
                <th width='250px'>Bank Penerima, Nama,<br> No. Rekening Penerima</th>
                <th >Deskripsi</th>
                <!--th>File Transaksi</th-->
                <th class='mid'>Status</th>
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
                        echo "<td>" . $value->get_creation_date() . "</td>";
                        echo "<td>" . $value->get_payment_date() . "</td>";
                        echo "<td>" . $value->get_check_number() . "</td>";
                        //echo "<td>" . $value->get_return_code() . "</td>";
                        //echo "<td>" . $value->get_check_number_line_num() . "</td>";
                        echo "<td class='ratakanan'>" . $value->get_invoice_num() . '<br>Rp ' . number_format($value->get_check_amount()) . "</td>";
                        //echo "<td class='ratakanan'>" . $value->get_check_amount() . "</td>";
                        echo "<td>" . $value->get_bank_account_name() . "</td>";
                        //echo "<td>" . $value->get_bank_name() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_bank_name() . '<br>Penerima: ' . $value->get_vendor_name() . '<br>No. Rek: ' . $value->get_vendor_ext_bank_account_num() . "</td>";
                        //echo "<td>" . $value->get_vendor_ext_bank_account_num() . "</td>";
                        echo "<td class='ratakiri'>" . $value->get_invoice_description() . "</td>";
                        //echo "<td>" . $value->get_ftp_file_name() . "</td>";
                        echo "<td>" . $value->get_return_desc() . '<br>' . $value->get_payment_method();
                        if ($value->get_payment_method() == 'OVERBOOKING') {
                            echo "<br>Ref No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                        } elseif ($value->get_payment_method() == 'SKN') {
                            echo "<br>SOR No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                        } elseif ($value->get_payment_method() == 'RTGS') {
                            echo "<br>BOR No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                        } elseif ($value->get_payment_method() == 'SWIFT') {
                            echo "<br>Swift No: " . $value->get_sorbor_number() . "<br>Tanggal: " . $value->get_sorbor_date() . "</td>";
                        } else {
                            echo "<br>Metode Pembayaran tidak terdaftar</td>";
                        }
                        /* if ($value->get_return_desc()!=''){
                          echo "<td>" . $value->get_return_desc() . "</td>";
                          } else {
                          echo "<td>Belum dikonfirmasi oleh Bank</td>";
                          } */
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

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>

            <form id="filter-form" method="POST" action="monitoringSp2d" enctype="multipart/form-data">

                <div class="modal-body">

                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class='alert alert-danger' style='display:none;'></div>
                        <label class="isian">Kode KPPN: </label>
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
                    <?php } ?>
                    <br/>
                    <div id="wsp2d" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">No SP2D: </label>
                    <input class="form-control" type="number" name="nosp2d" id="nosp2d" size="15" value="<?php if (isset($this->d_nosp2d)) {echo $this->d_nosp2d;}?>"><br/>
                    <div id="wbarsp2d" class="alert alert-danger" style="display:none;"></div>
                    <label class="isian">No Transaksi: </label>
                    <input class="form-control" type="number" name="barsp2d" id="barsp2d" value="<?php
                           if (isset($this->d_barsp2d)) {
                               echo $this->d_barsp2d;
                           }
                           ?>">


                    <?php
                    if (Session::get('role') != SATKER) {
                        echo "<br/><div id='wsatker' class='alert alert-danger' style='display:none;'></div>";
                        echo "<label class='isian'>Kode Satker: </label>";
                    }
                    ?>

                    <input class="form-control" type="<?php
                           if (Session::get('role') == SATKER) {
                               echo "hidden";
                           } else {
                               echo "number";
                           }
                           ?>" name="kdsatker" id="kdsatker" size="15" value="<?php
                           if (isset($this->d_kdsatker)) {
                               echo $this->d_kdsatker;
                           }
                           ?>">
                    <br/>
                    <div id="winvoice" class='alert alert-danger' style='display:none;'></div>
                    <label class="isian">No Invoice: </label>
                    <input class="form-control" type="text" name="invoice" id="invoice" value="<?php
                    if (isset($this->d_invoice)) {
                        echo $this->d_invoice;
                    }
                    ?>"><br/>
                    <div id="wvendor_name" class='alert alert-danger' style='display:none;'></div>
                    <label class="isian">Nama Penerima: </label>
                    <input class="form-control" type="text" name="vendor_name" id="vendor_name" value="<?php
                    if (isset($this->d_vendor_name)) {
                        echo $this->d_vendor_name;
                    }
                    ?>">



                    <?php
                    if (Session::get('role') != SATKER) {
                        echo "<br/><div id='wbank' class='alert alert-danger' style='display:none;'></div>";
                        echo "<label class='isian'>Nama Bank: </label>";
                        echo "<select class='form-control' type='text' name='bank' id='bank'>";
                        ?>  <option value=''>- pilih -</option>
                        <option value='MDRI' <?php
                        if ($this->d_bank == MDRI) {
                            echo "selected";
                        }
                        ?>>Mandiri</option>
                        <option value='BRI' <?php
                        if ($this->d_bank == BRI) {
                            echo "selected";
                        }
                        ?>>BRI</option>
                        <option value='BNI' <?php
                        if ($this->d_bank == BNI) {
                            echo "selected";
                        }
                        ?>>BNI</option>
                        <option value='BTN' <?php
                        if ($this->d_bank == BTN) {
                            echo "selected";
                        }
                        ?>>BTN</option>
                        <option value='5' <?php
                            if ($this->d_bank == 5) {
                                echo "selected";
                            }
                            ?>>SEMUA BANK</option>
                        </select>
    <?php
} else {
    echo "<input type='hidden' name='bank' id='bank' value=''>";
}
?>
                    <br/>
                    <div id="wstatus" class='alert alert-danger' style='display:none;'></div>
                    <label class="isian">Status: </label>
                    <select class="form-control" type="text" name="status" id="status">
                        <option value=''>- pilih -</option>
                        <option value='SUKSES' <?php
                                if ($this->d_status == SUKSES) {
                                    echo "selected";
                                }
                                ?>>SUKSES</option>
                        <option value='TIDAK' <?php
                        if ($this->d_status == TIDAK) {
                            echo "selected";
                        }
                        ?>>TIDAK SUKSES</option>
                        <option value='SEMUA' <?php
                        if ($this->d_status == SEMUA) {
                            echo "selected";
                        }
                        ?>>SEMUA</option>
                    </select>
                    <br/>
                    <div id="wbayar" class='alert alert-danger' style='display:none;'></div>
                    <label class="isian">Cara Bayar: </label>
                    <select class="form-control" type="text" name="bayar" id="bayar">
                        <option value=''>- pilih -</option>
                        <option value='OVERBOOKING' <?php
                        if ($this->d_bayar == OVERBOOKING) {
                            echo "selected";
                        }
                        ?>>OVERBOOKING</option>
                        <option value='SKN' <?php
                        if ($this->d_bayar == SKN) {
                            echo "selected";
                        }
                        ?>>SKN</option>
                        <option value='RTGS' <?php
                        if ($this->d_bayar == RTGS) {
                            echo "selected";
                        }
                        ?>>RTGS</option>
                        <option value='SWIFT' <?php
                        if ($this->d_bayar == SWIFT) {
                            echo "selected";
                        }
                        ?>>SWIFT</option>
                        <option value='SEMUA' <?php
                        if ($this->d_bayar == SEMUA) {
                            echo "selected";
                        }
                        ?>>SEMUA</option>
                    </select>
                    <br/>
                    <div id="wtgl" class='alert alert-danger' style='display:none;'></div>
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

<!-- Skrip -->
<script type="text/javascript" charset="utf-8">
    $(function() {
        hideErrorId();
        hideWarning();
    });



    function hideErrorId() {
        $('.error').fadeOut(0);
    }

    function hideWarning() {

        $('#nosp2d').keyup(function() {
            if (document.getElementById('nosp2d').value != '') {
                $('#wsp2d').fadeOut(200);
            }
        });

        $('#barsp2d').keyup(function() {
            if (document.getElementById('barsp2d').value != '') {
                $('#wbarsp2d').fadeOut(200);
            }
        });

        $('#kdsatker').keyup(function() {
            if (document.getElementById('kdsatker').value != '') {
                $('#wsatker').fadeOut(200);
            }
        });

        $('#invoice').keyup(function() {
            if (document.getElementById('invoice').value != '') {
                $('#winvoice').fadeOut(200);
            }
        });

        $('#vendor_name').keyup(function() {
            if (document.getElementById('vendor_name').value != '') {
                $('#wvendor_name').fadeOut(200);
            }
        });

        $('#bank').change(function() {
            if (document.getElementById('bank').value != '') {
                $('#wbank').fadeOut(200);
            }
        });

        $('#status').change(function() {
            if (document.getElementById('status').value != '') {
                $('#wstatus').fadeOut(200);
            }
        });

        $('#bayar').change(function() {
            if (document.getElementById('bayar').value != '') {
                $('#wbayar').fadeOut(200);
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

        document.getElementById('invoice').value = document.getElementById('invoice').value.replace(/</g, '').replace(/>/g, '');

        var pattern = '^[0-9]+$';
        var v_nosp2d = document.getElementById('nosp2d').value;
        var v_barsp2d = document.getElementById('barsp2d').value;
        var v_kdsatker = document.getElementById('kdsatker').value;
        var v_invoice = document.getElementById('invoice').value;
        var v_vendor_name = document.getElementById('vendor_name').value;
        var v_bank = document.getElementById('bank').value;
        var v_status = document.getElementById('status').value;
        var v_bayar = document.getElementById('bayar').value;
        var v_tglawal = document.getElementById('tgl_awal').value;
        var v_tglakhir = document.getElementById('tgl_akhir').value;

        var jml = 0;
        if (v_nosp2d == '' && v_barsp2d == '' && v_kdsatker == '' && v_invoice == '' && v_vendor_name == '' && v_bank == '' && v_status == '' && v_bayar == '' && (v_tglawal == '' || v_tglakhir == '')) {
            $('#wsp2d').html('Harap isi salah satu parameter');
            $('#wsp2d').fadeIn();
            jml++;
        }

        if (v_tglawal == '' || v_tglakhir == '') {
            if (v_nosp2d == '' && v_barsp2d == '' && v_invoice == '' && v_vendor_name == '') {
                $('#wsp2d').html('Harap isi salah satu parameter');
                $('#wsp2d').fadeIn();
                $('#wbarsp2d').html('Harap isi salah satu parameter');
                $('#wbarsp2d').fadeIn();
                $('#winvoice').html('Harap isi salah satu parameter');
                $('#winvoice').fadeIn();
                $('#wvendor_name').html('Harap isi salah satu parameter');
                $('#wvendor_name').fadeIn();
                jml++;
            }
        }

        if (v_nosp2d != '' && v_nosp2d.length != 15) {
            $('#wsp2d').html('No. SP2D harus 15 digit');
            $('#wsp2d').fadeIn(200);
            jml++;
        }

        if (v_nosp2d != '' && !v_nosp2d.match(pattern)) {
            var wsp2d = 'No SP2D harus dalam bentuk angka!';
            $('#wsp2d').html(wsp2d);
            $('#wsp2d').fadeIn(200);
            jml++;
        }

        if (v_barsp2d != '' && v_barsp2d.length != 21) {
            $('#wbarsp2d').html('No. Transaksi harus 21 digit');
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }

        if (v_barsp2d != '' && !v_barsp2d.match(pattern)) {
            var wbarsp2d = 'No Transaksi harus dalam bentuk angka!';
            $('#wbarsp2d').html(wbarsp2d);
            $('#wbarsp2d').fadeIn(200);
            jml++;
        }

        if (v_kdsatker != '' && v_kdsatker.length != 6) {
            $('#wsatker').html('Kode Satker harus 6 digit');
            $('#wsatker').fadeIn(200);
            jml++;
        }

        if (v_kdsatker != '' && !v_kdsatker.match(pattern)) {
            var wsatker = 'Kode Satker harus dalam bentuk angka!';
            $('#wsatker').html(wsatker);
            $('#wsatker').fadeIn(200);
            jml++;
        }

        if (v_invoice != '' && v_invoice.length != 18) {
            $('#winvoice').html('No. invoice harus 18 digit');
            $('#winvoice').fadeIn(200);
            jml++;
        }



        if (jml > 0) {
            return false;
        }
    }

</script>


<div class="main-window-segment vertical-padded">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <b>Keterangan : </b></br>
                Sukses Overbooking = Dana sudah masuk ke Rekening Penerima </br>
                Sukses RTGS / SKN / Swift = Dana sudah ditransfer dari Bank Pembayar ke Bank Penerima, mekanisme transfer dana dari Bank Penerima ke Rekening Penerima tergantung pada Bank Penerima</br>
                Nomor Ref/SOR/BOR = Nomor bukti transaksi pada perbankan yang dapat digunakan untuk konfirmasi ke bank penerima
            </div>

        </div>
    </div>
</div>