<!-- Header -->
<div class="main-window-segment header-segment bottom-padded">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-10 col-md-6 col-sm-12">
                <h2>Realisasi Belanja Per Satker </h2>
            </div>
            
            <div class="col-lg-1 col-md-3 col-sm-12 top-padded">
                
                <?php
				//--------------------------------------
				//Development History.Revisi : 0 Kegiatan :1.mencetak hasil filter ke dalam pdf Dibuat oleh : Rifan Abdul Rachman Tanggal dibuat : 18-07-2014  File yang diubah : monitoringUser.php  
				if (Session::get('role') == ADMIN  || Session::get('role') == DJA) {
					if( isset($this->d_nama_kppn) || isset($this->satker_code1)){
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							}
						} else {
							$kdkppn = 'null';
						}
						if (isset($this->satker_code1)) {
							$kdsatker =$this->satker_code1;
						} else {
							$kdsatker = 'null';
						}
						
					?>
					<a href="<?php echo URL; ?>PDF/DataRealisasi_PDF/<?php echo $kdkppn . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
					<?php
					}
				}
				if (Session::get('role') == KANWIL) {
					if( isset($this->d_nama_kppn) && isset($this->satker_code1)){
						if (isset($this->d_nama_kppn)) {
							foreach ($this->d_nama_kppn as $kppn) {
								$kdkppn = $kppn->get_kd_satker();
							  }
						} else {
							$kdkppn = 'null';
						}
						if (isset($this->satker_code1)) {
							$kdsatker = $this->satker_code1;
						} else {
							$kdsatker = 'null';
						}							
						?>
						<a href="<?php echo URL; ?>PDF/DataRealisasi_PDF/<?php echo $kdkppn . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
						<?php
						}
				}
				if (Session::get('role') == KPPN) {
					if(isset($this->satker_code1)){
						if (isset($this->d_nama_kppn)) {
								$kdkppn = $this->d_kd_kppn;
						} else {
							$kdkppn = Session::get('id_user');
						}
						if (isset($this->satker_code1)) {
							$kdsatker = $this->satker_code1;
						} else {
							$kdsatker = 'null';
						}						
						?>
						<a href="<?php echo URL; ?>PDF/DataRealisasi_PDF/<?php echo $kdkppn . "/" . $kdsatker; ?>" style="width: 100%" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> PDF</a>
						<?php
					}	
				}
				//----------------------------------------------------		
?>                
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

                ?> | Sampai dengan <?php

                echo (date('d-m-Y'));

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

<!-- Blok Tabel -->
<div id="table-container" class="wrapper">
    <table class="footable">
            <!--baris pertama-->
            <thead>
                <tr>
                    <th id="0" rowspan=2 class='mid'>No.</th>
                    <!--th>KPPN</th-->
                    <!--th>Tanggal</th-->
                    <th id="1"  rowspan=2 class='mid'>Satker</th>

                    <th id="2"  rowspan=2 class='mid'> Nama Satker </th>
                    <th id="3"  rowspan=2 class='mid'> Pagu </th>


                    <th  colspan=9 class='mid'>Jenis Belanja</th>
                    <th id="13"  rowspan=2 class='mid'>Sisa Pagu</th>
                </tr>
                <tr>
                    <th id="4"  class='mid' >Pegawai</th>
                    <th id="5"  class='mid' >Barang</th>
                    <th id="6"  class='mid' >Modal</th>
                    <th id="7"  class='mid' >Beban Bunga</th>
                    <th id="8"  class='mid' >Subsidi</th>
                    <th id="9"  class='mid' >Hibah</th>
                    <th id="10"  class='mid' >BanSos</th>
                    <th id="11"  class='mid' >Lain lain</th>
                    <!--th >Pencadangan Dana</th-->
                    <th id="12"  class='mid' >Total</th>

                </tr>
            </thead>
            <tbody class='ratatengah'>
                <?php
                    $no = 1;
                    $tot_pot = 0;

                    //var_dump ($this->data);
                    if (isset($this->data)) {
                        if (empty($this->data)) {
                            echo '<td colspan=14 align="center" id="filter-first">Silahkan masukkan filter terlebih dahulu.</td>';
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
            
            <form id="filter-form" method="POST" action="DataRealisasi" enctype="multipart/form-data">

                <div class="modal-body">
                    
                    <!-- Paste Isi Fom mulai nangkene -->
                    <?php if (isset($this->kppn_list)) { ?>
                        <div id="wkdkppn" class="alert alert-danger" style="display:none;"></div>
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

                    <label class="isian">Kode Satker: </label>
                    <input class="form-control" type="text" name="kdsatker" id="kdsatker" value="<?php if (isset($this->kdsatker)) {
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


                    <input class="form-control" type="hidden" name="kd_satker" id="kd_satker" value="<?php echo $kode_satker; ?>">
                    <input class="form-control" type="hidden" name="kd_kppn" id="kd_kppn" value="<?php echo $kode_kppn; ?>">
                    <input class="form-control" type="hidden" name="kd_adk_name" id="kd_adk_name" value="<?php echo $_FILES['fupload']['name']; ?>">
                    <input class="form-control" type="hidden" name="kd_jml_pdf" id="kd_jml_pdf" value="<?php echo '10'; ?>">
                    <input class="form-control" type="hidden" name="kd_file_name" id="kd_file_name" value="<?php echo $kode_satker . "_" . $kode_kppn . "_" . date("d-m-y") . "_"; ?>">
                    <!--input id="submit" class="sukses" type="submit" name="submit_file" value="SIMPAN" onClick=""-->
                        

                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit_file" class="btn btn-primary" style="width: 100%" onClick="return cek_upload()">Kirim</button>
                </div>

            </form>

        </div>

    </div>

</div>

<!--Skrip-->
<script type="text/javascript" charset="utf-8">
    manualColumnMode = true;
    
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
</script>