<!-- Ndas -->
<div class="main-window-segment" style="padding-top: none; padding-bottom: 20px;">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Monitoring Perbandingan SP2D Gaji</h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12" style="padding-top: 20px;">
                
                <?php
                //----------------------------------------------------
                //Development history
                //Revisi : 0
                //Kegiatan :1.mencetak hasil filter ke dalam pdf
                //File yang diubah : isianKppn.php
                //Dibuat oleh : Rifan Abdul Rachman
                //Tanggal dibuat : 18-07-2014
                //----------------------------------------------------
                if( isset($this->d_nosp2d) || isset($this->d_barsp2d) || 
                isset($this->d_kdsatker) || isset($this->d_invoice) || 
                isset($this->d_bank) || isset($this->d_bank) || isset($this->d_status) ||
                isset($this->d_bayar) || isset($this->d_fxml) || isset($this->d_tgl_awal) ||
                isset($this->d_tgl_akhir)

                ){

                if (isset($this->d_nama_kppn)) {
					foreach ($this->d_nama_kppn as $kppn) {
							$kdkppn = $kppn->get_kd_satker();
						  }
					} else {
						$kdkppn = Session::get('id_user');
					}

                if (isset($this->d_nosp2d)) {
                    $kdnosp2d = $this->d_nosp2d;
                }else{
                    $kdnosp2d='null';
                }

                if (isset($this->d_barsp2d)) {
                    $kdbarsp2d = $this->d_barsp2d;
                }else{
                    $kdbarsp2d='null';
                }
                if (isset($this->d_kdsatker)) {
                    $kdsatker = $this->d_kdsatker;
                }else{
                    $kdsatker='null';
                }

                if (isset($this->d_invoice)) {
                    $kdnoinvoice = $this->d_invoice;
                }else{
                    $kdnoinvoice='null';
                }      

                if (isset($this->d_bank)) {
                    $kdbank = $this->d_bank;
                }else{
                    $kdbank='null';
                }
                if (isset($this->d_status)) {
                    $kdstatus = $this->d_status;
                }else{
                    $kdstatus='null';
                }

                if (isset($this->d_bayar)) {
                    $kdbayar = $this->d_bayar;
                }else{
                    $kdbayar='null';
                }

                if (isset($this->d_fxml)) {
                    $kdfxml = $this->d_fxml;
                }else{
                    $kdfxml='null';
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
                ?>
                <a href="<?php echo URL; ?>PDF/monitoringSp2d_PDF/<?php echo $kdkppn . "/" . $kdsatker . "/" . $kdtgl_awal . "/" . $kdtgl_akhir . "/" . $kdnosp2d . "/" . $kdnoinvoice . "/" . $kdbarsp2d . "/" . $kdstatus . "/" . $kdbayar . "/" . $kdfxml . "/" . $kdbank; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>

                <?php
                //----------------------------------------------------		


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
                    <th width="5%" rowspan="2" valign: "middle">No.</th>
                    <th width="35%" rowspan="2">BANK</th>
                    <th width="60%" colspan="12">Jumlah SP2D</th>
                </tr>
                <tr>
                    <th width="5%">Jan</th>
                    <th width="5%">Feb</th>
                    <th width="5%">Mar</th>
                    <th width="5%">Apr</th>
                    <th width="5%">Mei</th>
                    <th width="5%">Jun</th>
                    <th width="5%">Jul</th>
                    <th width="5%">Ags</th>
                    <th width="5%">Sep</th>
                    <th width="5%">Okt</th>
                    <th width="5%">Nov</th>
                    <th width="5%">Des</th>
                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                $no = 1;
                if (isset($this->data)) {
                    $jan = 0;
                    $feb = 0;
                    $mar = 0;
                    $apr = 0;
                    $mei = 0;
                    $jun = 0;
                    $jul = 0;
                    $ags = 0;
                    $sep = 0;
                    $okt = 0;
                    $nop = 0;
                    $des = 0;
                    foreach ($this->data as $value) {
                        echo "<tr> ";
                        echo "<td>" . $no++ . "</td>";
                        //filter bank
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_payment_date() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/all/" . $kode_kppn . " target='_blank'>" . $value->get_payment_date() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_payment_date() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . " target='_blank'>" . $value->get_payment_date() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter januari
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_invoice_num() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/01/" . $kode_kppn . " target='_blank'>" . $value->get_invoice_num() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_invoice_num() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/01 target='_blank'>" . $value->get_invoice_num() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter februari
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_check_date() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/02/" . $kode_kppn . " target='_blank'>" . $value->get_check_date() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_check_date() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/02 target='_blank'>" . $value->get_check_date() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter maret
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_creation_date() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/03/" . $kode_kppn . " target='_blank'>" . $value->get_creation_date() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_creation_date() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/03 target='_blank'>" . $value->get_creation_date() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter april
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_check_number() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/04/" . $kode_kppn . " target='_blank'>" . $value->get_check_number() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_check_number() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/04 target='_blank'>" . $value->get_check_number() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter mei
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_check_number_line_num() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/05/" . $kode_kppn . " target='_blank'>" . $value->get_check_number_line_num() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_check_number_line_num() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/05 target='_blank'>" . $value->get_check_number_line_num() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter juni
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_check_amount() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/06/" . $kode_kppn . " target='_blank'>" . $value->get_check_amount() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_check_amount() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/06 target='_blank'>" . $value->get_check_amount() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter juli
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_bank_account_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/07/" . $kode_kppn . " target='_blank'>" . $value->get_bank_account_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_bank_account_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/07 target='_blank'>" . $value->get_bank_account_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter agustus
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_bank_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/08/" . $kode_kppn . " target='_blank'>" . $value->get_bank_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_bank_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/08 target='_blank'>" . $value->get_bank_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter september
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_vendor_ext_bank_account_num() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/09/" . $kode_kppn . " target='_blank'>" . $value->get_vendor_ext_bank_account_num() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_vendor_ext_bank_account_num() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/09 target='_blank'>" . $value->get_vendor_ext_bank_account_num() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter oktober
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_vendor_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/10/" . $kode_kppn . " target='_blank'>" . $value->get_vendor_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_vendor_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/10 target='_blank'>" . $value->get_vendor_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter nopember
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_invoice_description() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/11/" . $kode_kppn . " target='_blank'>" . $value->get_invoice_description() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_invoice_description() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/11 target='_blank'>" . $value->get_invoice_description() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        //filter desember
                        if (isset($this->d_nama_kppn)) {
                            if ($value->get_ftp_file_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/12/" . $kode_kppn . " target='_blank'>" . $value->get_ftp_file_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        } else {
                            if ($value->get_ftp_file_name() != '') {
                                echo "<td><a href=" . URL . "dataKppn/detailSp2dGaji/" . $value->get_payment_date() . "/12 target='_blank'>" . $value->get_ftp_file_name() . "</a></td>";
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        echo "</tr> ";
                        $jan+=$value->get_invoice_num();
                        $feb+=$value->get_check_date();
                        $mar+=$value->get_creation_date();
                        $apr+=$value->get_check_number();
                        $mei+=$value->get_check_number_line_num();
                        $jun+=$value->get_check_amount();
                        $jul+=$value->get_bank_account_name();
                        $ags+=$value->get_bank_name();
                        $sep+=$value->get_vendor_ext_bank_account_num();
                        $okt+=$value->get_vendor_name();
                        $nop+=$value->get_invoice_description();
                        $des+=$value->get_ftp_file_name();
                    }
                    echo "<tr> ";
                    echo "<td></td>";
                    echo "<td><b>TOTAL</b></td>";
                    echo "<td><b>" . $jan . "</b></td>";
                    echo "<td><b>" . $feb . "</b></td>";
                    echo "<td><b>" . $mar . "</b></td>";
                    echo "<td><b>" . $apr . "</b></td>";
                    echo "<td><b>" . $mei . "</b></td>";
                    echo "<td><b>" . $jun . "</b></td>";
                    echo "<td><b>" . $jul . "</b></td>";
                    echo "<td><b>" . $ags . "</b></td>";
                    echo "<td><b>" . $sep . "</b></td>";
                    echo "<td><b>" . $okt . "</b></td>";
                    echo "<td><b>" . $nop . "</b></td>";
                    echo "<td><b>" . $des . "</b></td>";
                } else {
                    echo '<td colspan=15 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
                }
//			} 
                ?>
            </tbody>
    </table>
</div>

<?php if (isset($this->kppn_list)) { ?>	

<!-- Filter -->
<div class="modal fade" id="modal-app-filter" tabindex="-1" role="dialog" aria-labelledby="app-filter-label" aria-hidden="true">
        
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                <h4 class="modal-title" id="app-filter-label"><span class="glyphicon glyphicon-filter"></span> Filter Data</h4>

            </div>
            
            <form id="filter-form" method="POST" action="sp2dCompareGaji" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <div id="wkdkppn" class="alert alert-danger" style="display:none"></div>
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

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<?php } ?>



